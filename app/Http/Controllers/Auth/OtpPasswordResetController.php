<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetOtp;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\OtpMail;

class OtpPasswordResetController extends Controller
{
    /**
     * Display the OTP request form
     */
    public function showOtpForm(): View
    {
        return view('auth.forgot-password-otp');
    }

    /**
     * Send OTP to user's email
     */
    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $email = $request->email;
        
        // Check if user exists
        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No account found with this email address.']);
        }

        try {
            // Generate and store OTP
            $otpRecord = PasswordResetOtp::createOtp($email);
            
            // Send OTP via email
            Mail::to($email)->send(new OtpMail($otpRecord->otp));
            
            return redirect()->route('password.otp.verify')
                ->with('status', 'OTP has been sent to your email address.')
                ->with('email', $email);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }
    }

    /**
     * Show OTP verification form
     */
    public function showOtpVerification(): View
    {
        if (!session('email')) {
            return redirect()->route('password.otp.request');
        }

        return view('auth.verify-otp', ['email' => session('email')]);
    }

    /**
     * Verify OTP and show password reset form
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $email = $request->email;
        $otp = $request->otp;

        if (!PasswordResetOtp::validateOtp($email, $otp)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // Mark OTP as used
        $otpRecord = PasswordResetOtp::getValidOtp($email, $otp);
        $otpRecord->markAsUsed();

        return redirect()->route('password.otp.reset')
            ->with('email', $email)
            ->with('status', 'OTP verified successfully. Please enter your new password.');
    }

    /**
     * Show password reset form
     */
    public function showPasswordReset(): View
    {
        if (!session('email')) {
            return redirect()->route('password.otp.request');
        }

        return view('auth.reset-password-otp', ['email' => session('email')]);
    }

    /**
     * Reset password with OTP verification
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = $request->email;
        $password = $request->password;

        // Update user password
        $user = User::where('email', $email)->first();
        $user->update([
            'password' => Hash::make($password)
        ]);

        // Clear any existing OTPs for this email
        PasswordResetOtp::where('email', $email)->update(['used' => true]);

        return redirect()->route('home')
            ->with('status', 'Password has been reset successfully. You can now use your new password.');
    }
}

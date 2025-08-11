<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function sendOTP(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter a valid email address that exists in our system.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $email = $request->email;
            
            // Generate 6-digit OTP
            $otp = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
            
            // Delete any existing OTP for this email
            DB::table('password_resets')->where('email', $email)->delete();
            
            // Store OTP in database with expiration (15 minutes)
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $otp,
                'created_at' => Carbon::now(),
                'expires_at' => Carbon::now()->addMinutes(15)
            ]);

            // Send OTP email
            $this->sendOTPEmail($email, $otp);

            Log::info("OTP sent successfully to: {$email}");

            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully to your email address!'
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending OTP: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again later.'
            ], 500);
        }
    }

    public function verifyOTP(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'otp' => 'required|string|size:6',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid input provided.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $email = $request->email;
            $otp = $request->otp;

            // Check if OTP exists and is valid
            $resetRecord = DB::table('password_resets')
                ->where('email', $email)
                ->where('token', $otp)
                ->first();

            if (!$resetRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP code. Please check and try again.'
                ], 400);
            }

            // Check if OTP has expired
            if (Carbon::parse($resetRecord->expires_at)->isPast()) {
                // Delete expired OTP
                DB::table('password_resets')->where('email', $email)->delete();
                
                return response()->json([
                    'success' => false,
                    'message' => 'OTP has expired. Please request a new one.'
                ], 400);
            }

            Log::info("OTP verified successfully for: {$email}");

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Error verifying OTP: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to verify OTP. Please try again.'
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid input provided.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $email = $request->email;
            $password = $request->password;

            // Verify that OTP was verified (check if record exists and not expired)
            $resetRecord = DB::table('password_resets')
                ->where('email', $email)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if (!$resetRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid request. Please verify OTP first or request a new one.'
                ], 400);
            }

            // Update user password
            $user = User::where('email', $email)->first();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            $user->password = Hash::make($password);
            $user->save();

            // Delete used OTP
            DB::table('password_resets')->where('email', $email)->delete();

            Log::info("Password reset successfully for: {$email}");

            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully! You can now login with your new password.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error resetting password: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to reset password. Please try again.'
            ], 500);
        }
    }

    private function sendOTPEmail($email, $otp)
    {
        try {
            $subject = 'Password Reset OTP - DND COMPUTERS';
            $message = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;'>
                    <div style='background: linear-gradient(135deg, #ffc107 0%, #ffb400 100%); color: #000; padding: 30px; text-align: center; border-radius: 10px 10px 0 0;'>
                        <h1 style='margin: 0; font-size: 2rem; font-weight: 800;'>DND COMPUTERS</h1>
                        <p style='margin: 10px 0 0 0; font-size: 1.1rem;'>Password Reset Request</p>
                    </div>
                    
                    <div style='background: #f8f9fa; padding: 30px; border-radius: 0 0 10px 10px;'>
                        <h2 style='color: #333; margin-top: 0;'>Hello!</h2>
                        <p style='color: #666; line-height: 1.6;'>You have requested to reset your password. Please use the following OTP code to complete the process:</p>
                        
                        <div style='background: #fff; border: 2px solid #ffc107; border-radius: 10px; padding: 20px; text-align: center; margin: 20px 0; font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #000;'>
                            {$otp}
                        </div>
                        
                        <div style='background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px; padding: 15px; margin: 20px 0;'>
                            <p style='margin: 0; color: #856404; font-weight: bold;'>Important Security Information:</p>
                            <ul style='color: #856404; margin: 10px 0 0 0; padding-left: 20px;'>
                                <li>This OTP is valid for <strong>15 minutes only</strong></li>
                                <li>Never share this code with anyone</li>
                                <li>If you didn't request this, please ignore this email</li>
                                <li>For security, this OTP can only be used once</li>
                            </ul>
                        </div>
                        
                        <p style='color: #666; line-height: 1.6;'>If you have any questions or need assistance, please contact our support team.</p>
                        
                        <p style='color: #666; margin-bottom: 0;'>Best regards,<br><strong>DND COMPUTERS Team</strong></p>
                    </div>
                    
                    <div style='text-align: center; margin-top: 20px; color: #999; font-size: 12px;'>
                        <p>This is an automated email. Please do not reply to this message.</p>
                        <p>&copy; " . date('Y') . " DND COMPUTERS. All rights reserved.</p>
                    </div>
                </div>
            ";

            Mail::send([], [], function ($mail) use ($email, $subject, $message) {
                $mail->to($email)
                     ->subject($subject)
                     ->html($message);
            });

        } catch (\Exception $e) {
            Log::error('Error sending OTP email: ' . $e->getMessage());
            throw $e;
        }
    }
}
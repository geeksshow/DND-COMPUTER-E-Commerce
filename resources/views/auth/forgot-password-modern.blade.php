<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - DND COMPUTERS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .otp-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .step.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }
        
        .step.completed {
            background: #10b981;
            color: white;
        }
        
        .step.inactive {
            background: #f3f4f6;
            color: #9ca3af;
        }
        
        .step::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            width: 40px;
            height: 2px;
            background: #e5e7eb;
            transform: translateY(-50%);
        }
        
        .step:last-child::after {
            display: none;
        }
        
        .step.completed::after {
            background: #10b981;
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            top: 60%;
            right: 10%;
            animation-delay: -2s;
        }
        
        .shape:nth-child(3) {
            bottom: 20%;
            left: 20%;
            animation-delay: -4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .timer {
            color: #667eea;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .timer.expired {
            color: #ef4444;
        }
        
        .success-animation {
            animation: successPulse 0.6s ease-in-out;
        }
        
        @keyframes successPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .password-strength {
            margin-top: 0.5rem;
        }
        
        .strength-bar {
            height: 4px;
            border-radius: 2px;
            background: #e5e7eb;
            overflow: hidden;
        }
        
        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        
        .strength-weak { background: #ef4444; width: 25%; }
        .strength-fair { background: #f59e0b; width: 50%; }
        .strength-good { background: #10b981; width: 75%; }
        .strength-strong { background: #059669; width: 100%; }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape w-32 h-32 bg-white rounded-full"></div>
        <div class="shape w-24 h-24 bg-white rounded-full"></div>
        <div class="shape w-16 h-16 bg-white rounded-full"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                <i class="fas fa-key text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Reset Password</h1>
            <p class="text-white text-opacity-80">Don't worry, we'll help you get back in</p>
        </div>

        <!-- Main Form Container -->
        <div class="glass-effect rounded-2xl p-8">
            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step active" id="step1Indicator">1</div>
                <div class="step inactive" id="step2Indicator">2</div>
                <div class="step inactive" id="step3Indicator">3</div>
            </div>

            <!-- Step 1: Email Input -->
            <div id="step1" class="step-content">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Enter Your Email</h3>
                    <p class="text-gray-600">We'll send you a verification code</p>
                </div>

                <form id="emailForm" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2"></i>Email Address
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                               placeholder="Enter your email address">
                        <div id="emailError" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>

                    <button type="submit" 
                            id="sendOtpBtn"
                            class="w-full btn-gradient text-white font-semibold py-3 px-4 rounded-lg">
                        <span id="sendOtpText">
                            <i class="fas fa-paper-plane mr-2"></i>Send Verification Code
                        </span>
                        <span id="sendOtpLoading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Sending...
                        </span>
                    </button>
                </form>
            </div>

            <!-- Step 2: OTP Verification -->
            <div id="step2" class="step-content hidden">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Verify Your Email</h3>
                    <p class="text-gray-600">Enter the 6-digit code sent to</p>
                    <p class="text-blue-600 font-medium" id="emailDisplay"></p>
                </div>

                <form id="otpForm" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3 text-center">
                            <i class="fas fa-shield-alt mr-2"></i>Verification Code
                        </label>
                        <div class="flex justify-center space-x-2">
                            <input type="text" class="otp-input" maxlength="1" id="otp1">
                            <input type="text" class="otp-input" maxlength="1" id="otp2">
                            <input type="text" class="otp-input" maxlength="1" id="otp3">
                            <input type="text" class="otp-input" maxlength="1" id="otp4">
                            <input type="text" class="otp-input" maxlength="1" id="otp5">
                            <input type="text" class="otp-input" maxlength="1" id="otp6">
                        </div>
                        <div id="otpError" class="text-red-500 text-sm mt-2 text-center hidden"></div>
                    </div>

                    <div class="text-center">
                        <div class="timer mb-4" id="timer">Time remaining: <span id="timeLeft">10:00</span></div>
                        <button type="button" 
                                id="resendBtn" 
                                class="text-gray-600 hover:text-blue-600 transition-colors duration-300 disabled:opacity-50"
                                disabled>
                            <i class="fas fa-redo mr-2"></i>Resend Code
                        </button>
                    </div>

                    <button type="submit" 
                            id="verifyOtpBtn"
                            class="w-full btn-gradient text-white font-semibold py-3 px-4 rounded-lg">
                        <span id="verifyOtpText">
                            <i class="fas fa-check-circle mr-2"></i>Verify Code
                        </span>
                        <span id="verifyOtpLoading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Verifying...
                        </span>
                    </button>
                </form>
            </div>

            <!-- Step 3: New Password -->
            <div id="step3" class="step-content hidden">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Create New Password</h3>
                    <p class="text-gray-600">Choose a strong password for your account</p>
                </div>

                <form id="passwordForm" class="space-y-6">
                    <div>
                        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2"></i>New Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="newPassword" 
                                   name="password" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 pr-12"
                                   placeholder="Enter new password">
                            <button type="button" 
                                    id="toggleNewPassword"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-all duration-300">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar">
                                <div class="strength-fill" id="strengthFill"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1" id="strengthText">Password strength</p>
                        </div>
                        <div id="passwordError" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>

                    <div>
                        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2"></i>Confirm Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="confirmPassword" 
                                   name="password_confirmation" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 pr-12"
                                   placeholder="Confirm new password">
                            <button type="button" 
                                    id="toggleConfirmPassword"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-all duration-300">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="confirmPasswordError" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>

                    <button type="submit" 
                            id="resetPasswordBtn"
                            class="w-full btn-gradient text-white font-semibold py-3 px-4 rounded-lg">
                        <span id="resetPasswordText">
                            <i class="fas fa-key mr-2"></i>Reset Password
                        </span>
                        <span id="resetPasswordLoading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Resetting...
                        </span>
                    </button>
                </form>
            </div>

            <!-- Success Step -->
            <div id="successStep" class="step-content hidden text-center">
                <div class="success-animation">
                    <i class="fas fa-check-circle fa-4x text-green-500 mb-4"></i>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Password Reset Successful!</h3>
                    <p class="text-gray-600 mb-6">Your password has been successfully reset. You can now login with your new password.</p>
                    <a href="/jwt/login" class="btn-gradient text-white font-semibold py-3 px-6 rounded-lg inline-block text-decoration-none">
                        <i class="fas fa-sign-in-alt mr-2"></i>Go to Login
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <button id="backBtn" class="text-gray-600 hover:text-gray-800 transition-all duration-300 hidden">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </button>
                    <a href="/jwt/login" class="text-gray-600 hover:text-blue-600 transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;
        let userEmail = '';
        let otpTimer;
        let timeLeft = 600; // 10 minutes

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
        });

        function setupEventListeners() {
            // Email form
            document.getElementById('emailForm').addEventListener('submit', handleEmailSubmit);
            
            // OTP form
            document.getElementById('otpForm').addEventListener('submit', handleOtpSubmit);
            setupOtpInputs();
            
            // Password form
            document.getElementById('passwordForm').addEventListener('submit', handlePasswordSubmit);
            setupPasswordToggles();
            setupPasswordStrength();
            
            // Resend button
            document.getElementById('resendBtn').addEventListener('click', resendOtp);
            
            // Back button
            document.getElementById('backBtn').addEventListener('click', goBack);
        }

        // Step 1: Email submission
        async function handleEmailSubmit(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value.trim();
            if (!email || !isValidEmail(email)) {
                showError('emailError', 'Please enter a valid email address');
                return;
            }

            const btn = document.getElementById('sendOtpBtn');
            const btnText = document.getElementById('sendOtpText');
            const btnLoading = document.getElementById('sendOtpLoading');

            setButtonLoading(btn, btnText, btnLoading, true);
            clearError('emailError');

            try {
                const response = await fetch('/api/forgot-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email })
                });

                const data = await response.json();

                if (data.success) {
                    userEmail = email;
                    document.getElementById('emailDisplay').textContent = email;
                    goToStep(2);
                    startTimer();
                    showNotification('Verification code sent successfully!', 'success');
                } else {
                    showError('emailError', data.message || 'Failed to send verification code');
                }
            } catch (error) {
                console.error('Error:', error);
                showError('emailError', 'Network error. Please try again.');
            } finally {
                setButtonLoading(btn, btnText, btnLoading, false);
            }
        }

        // Step 2: OTP verification
        async function handleOtpSubmit(e) {
            e.preventDefault();
            
            const otp = getOtpValue();
            if (otp.length !== 6) {
                showError('otpError', 'Please enter the complete 6-digit code');
                return;
            }

            const btn = document.getElementById('verifyOtpBtn');
            const btnText = document.getElementById('verifyOtpText');
            const btnLoading = document.getElementById('verifyOtpLoading');

            setButtonLoading(btn, btnText, btnLoading, true);
            clearError('otpError');

            try {
                const response = await fetch('/api/verify-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: userEmail, otp })
                });

                const data = await response.json();

                if (data.success) {
                    clearInterval(otpTimer);
                    goToStep(3);
                    showNotification('Email verified successfully!', 'success');
                } else {
                    showError('otpError', data.message || 'Invalid verification code');
                    clearOtpInputs();
                }
            } catch (error) {
                console.error('Error:', error);
                showError('otpError', 'Network error. Please try again.');
            } finally {
                setButtonLoading(btn, btnText, btnLoading, false);
            }
        }

        // Step 3: Password reset
        async function handlePasswordSubmit(e) {
            e.preventDefault();
            
            const password = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Validation
            if (password.length < 8) {
                showError('passwordError', 'Password must be at least 8 characters long');
                return;
            }

            if (password !== confirmPassword) {
                showError('confirmPasswordError', 'Passwords do not match');
                return;
            }

            const btn = document.getElementById('resetPasswordBtn');
            const btnText = document.getElementById('resetPasswordText');
            const btnLoading = document.getElementById('resetPasswordLoading');

            setButtonLoading(btn, btnText, btnLoading, true);
            clearError('passwordError');
            clearError('confirmPasswordError');

            try {
                const response = await fetch('/api/reset-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        email: userEmail, 
                        password, 
                        password_confirmation: confirmPassword 
                    })
                });

                const data = await response.json();

                if (data.success) {
                    goToStep('success');
                    showNotification('Password reset successfully!', 'success');
                } else {
                    showError('passwordError', data.message || 'Failed to reset password');
                }
            } catch (error) {
                console.error('Error:', error);
                showError('passwordError', 'Network error. Please try again.');
            } finally {
                setButtonLoading(btn, btnText, btnLoading, false);
            }
        }

        // OTP input handling
        function setupOtpInputs() {
            const inputs = document.querySelectorAll('.otp-input');
            
            inputs.forEach((input, index) => {
                input.addEventListener('input', function(e) {
                    const value = e.target.value;
                    
                    // Only allow numbers
                    if (!/^\d*$/.test(value)) {
                        e.target.value = '';
                        return;
                    }
                    
                    // Move to next input
                    if (value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    
                    // Auto-submit when all filled
                    if (index === inputs.length - 1 && value) {
                        const otp = getOtpValue();
                        if (otp.length === 6) {
                            document.getElementById('otpForm').dispatchEvent(new Event('submit'));
                        }
                    }
                });
                
                input.addEventListener('keydown', function(e) {
                    // Handle backspace
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
                
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const paste = e.clipboardData.getData('text');
                    const digits = paste.replace(/\D/g, '').slice(0, 6);
                    
                    digits.split('').forEach((digit, i) => {
                        if (inputs[i]) {
                            inputs[i].value = digit;
                        }
                    });
                    
                    if (digits.length === 6) {
                        document.getElementById('otpForm').dispatchEvent(new Event('submit'));
                    }
                });
            });
        }

        function getOtpValue() {
            const inputs = document.querySelectorAll('.otp-input');
            return Array.from(inputs).map(input => input.value).join('');
        }

        function clearOtpInputs() {
            document.querySelectorAll('.otp-input').forEach(input => {
                input.value = '';
            });
            document.getElementById('otp1').focus();
        }

        // Password toggles
        function setupPasswordToggles() {
            document.getElementById('toggleNewPassword').addEventListener('click', function() {
                togglePasswordVisibility('newPassword', this);
            });
            
            document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
                togglePasswordVisibility('confirmPassword', this);
            });
        }

        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Password strength
        function setupPasswordStrength() {
            document.getElementById('newPassword').addEventListener('input', function() {
                const password = this.value;
                const strengthFill = document.getElementById('strengthFill');
                const strengthText = document.getElementById('strengthText');
                
                let strength = 0;
                let strengthLabel = '';
                
                if (password.length >= 8) strength++;
                if (password.match(/[a-z]/)) strength++;
                if (password.match(/[A-Z]/)) strength++;
                if (password.match(/[0-9]/)) strength++;
                if (password.match(/[^a-zA-Z0-9]/)) strength++;
                
                strengthFill.className = 'strength-fill';
                
                switch (strength) {
                    case 0:
                    case 1:
                        strengthFill.classList.add('strength-weak');
                        strengthLabel = 'Weak';
                        break;
                    case 2:
                        strengthFill.classList.add('strength-fair');
                        strengthLabel = 'Fair';
                        break;
                    case 3:
                    case 4:
                        strengthFill.classList.add('strength-good');
                        strengthLabel = 'Good';
                        break;
                    case 5:
                        strengthFill.classList.add('strength-strong');
                        strengthLabel = 'Strong';
                        break;
                }
                
                strengthText.textContent = password.length > 0 ? `Password strength: ${strengthLabel}` : 'Password strength';
            });
        }

        // Timer functions
        function startTimer() {
            timeLeft = 600; // 10 minutes
            document.getElementById('resendBtn').disabled = true;
            
            otpTimer = setInterval(() => {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                
                document.getElementById('timeLeft').textContent = 
                    `${minutes}:${seconds.toString().padStart(2, '0')}`;
                
                if (timeLeft <= 0) {
                    clearInterval(otpTimer);
                    document.getElementById('timer').classList.add('expired');
                    document.getElementById('timeLeft').textContent = 'Expired';
                    document.getElementById('resendBtn').disabled = false;
                    showError('otpError', 'Verification code has expired. Please request a new one.');
                }
                
                timeLeft--;
            }, 1000);
        }

        // Resend OTP
        async function resendOtp() {
            const btn = document.getElementById('resendBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sending...';
            
            try {
                const response = await fetch('/api/forgot-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: userEmail })
                });

                const data = await response.json();

                if (data.success) {
                    clearOtpInputs();
                    clearError('otpError');
                    document.getElementById('timer').classList.remove('expired');
                    startTimer();
                    showNotification('New verification code sent!', 'success');
                } else {
                    showError('otpError', data.message || 'Failed to resend code');
                }
            } catch (error) {
                console.error('Error:', error);
                showError('otpError', 'Network error. Please try again.');
            } finally {
                btn.innerHTML = '<i class="fas fa-redo mr-2"></i>Resend Code';
            }
        }

        // Navigation functions
        function goToStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
            
            // Update step indicators
            document.querySelectorAll('.step').forEach(el => {
                el.classList.remove('active', 'completed');
                el.classList.add('inactive');
            });
            
            if (step === 'success') {
                document.getElementById('successStep').classList.remove('hidden');
                document.querySelectorAll('.step').forEach(el => el.classList.add('completed'));
                document.getElementById('backBtn').classList.add('hidden');
            } else {
                currentStep = step;
                document.getElementById(`step${step}`).classList.remove('hidden');
                
                // Update indicators
                for (let i = 1; i <= 3; i++) {
                    const indicator = document.getElementById(`step${i}Indicator`);
                    if (i < step) {
                        indicator.classList.add('completed');
                    } else if (i === step) {
                        indicator.classList.add('active');
                    } else {
                        indicator.classList.add('inactive');
                    }
                }
                
                // Show/hide back button
                if (step > 1) {
                    document.getElementById('backBtn').classList.remove('hidden');
                } else {
                    document.getElementById('backBtn').classList.add('hidden');
                }
            }
        }

        function goBack() {
            if (currentStep > 1) {
                if (currentStep === 2) {
                    clearInterval(otpTimer);
                }
                goToStep(currentStep - 1);
            }
        }

        // Utility functions
        function setButtonLoading(btn, textEl, loadingEl, loading) {
            btn.disabled = loading;
            if (loading) {
                textEl.classList.add('hidden');
                loadingEl.classList.remove('hidden');
            } else {
                textEl.classList.remove('hidden');
                loadingEl.classList.add('hidden');
            }
        }

        function showError(elementId, message) {
            const errorEl = document.getElementById(elementId);
            errorEl.textContent = message;
            errorEl.classList.remove('hidden');
        }

        function clearError(elementId) {
            const errorEl = document.getElementById(elementId);
            errorEl.classList.add('hidden');
        }

        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm ${
                type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            } text-white`;
            
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} mr-2"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }
    </script>
</body>
</html>
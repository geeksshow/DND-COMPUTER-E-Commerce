<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - DND COMPUTERS</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffc107" stop-opacity="0.1"/><stop offset="100%" stop-color="%23000" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>');
            animation: float 20s ease-in-out infinite;
            z-index: 0;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 2;
        }
        
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.1);
            border-color: #ffc107;
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #ffc107 0%, #ffb400 100%);
            transition: all 0.3s ease;
            color: #000;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.3);
            color: #000;
        }
        
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .slide-in {
            animation: slideIn 0.8s ease-out;
            position: relative;
            z-index: 2;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .social-login-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-btn {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .social-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            color: #fff;
            transform: translateY(-2px);
        }

        .social-btn.google {
            background: rgba(219, 68, 55, 0.2);
            border-color: rgba(219, 68, 55, 0.3);
        }

        .social-btn.google:hover {
            background: rgba(219, 68, 55, 0.3);
            border-color: rgba(219, 68, 55, 0.5);
        }

        .social-btn.facebook {
            background: rgba(24, 119, 242, 0.2);
            border-color: rgba(24, 119, 242, 0.3);
        }

        .social-btn.facebook:hover {
            background: rgba(24, 119, 242, 0.3);
            border-color: rgba(24, 119, 242, 0.5);
        }

        .social-btn.apple {
            background: rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .social-btn.apple:hover {
            background: rgba(0, 0, 0, 0.5);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* Placeholder Text Color - Black */
        input::placeholder {
            color: #000 !important;
            opacity: 0.8 !important;
        }

        input::-webkit-input-placeholder {
            color: #000 !important;
            opacity: 0.8 !important;
        }

        input::-moz-placeholder {
            color: #000 !important;
            opacity: 0.8 !important;
        }

        input:-ms-input-placeholder {
            color: #000 !important;
            opacity: 0.8 !important;
        }

        input:-moz-placeholder {
            color: #000 !important;
            opacity: 0.8 !important;
        }

        /* Input Text Color - Black */
        input[type="email"],
        input[type="password"] {
            color: #000 !important;
        }

        /* Input Background - White */
        input[type="email"],
        input[type="password"] {
            background: rgba(255, 255, 255, 0.9) !important;
            border-color: rgba(0, 0, 0, 0.2) !important;
        }

        /* Checkbox styling */
        input[type="checkbox"] {
            accent-color: #ffc107;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <!-- Background Decorations -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white opacity-10 rounded-full floating-animation"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-white opacity-5 rounded-full floating-animation" style="animation-delay: -3s;"></div>
        <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-white opacity-10 rounded-full floating-animation" style="animation-delay: -1s;"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo Section -->
        <div class="text-center mb-8 slide-in">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                <i class="fas fa-laptop text-2xl text-white"></i>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">DND COMPUTERS</h1>
            <p class="text-white text-opacity-80">Welcome back! Please sign in to your account</p>
        </div>

        <!-- Login Form -->
        <div class="glass-effect rounded-2xl p-8 slide-in" style="animation-delay: 0.2s;">
            <form id="loginForm" class="space-y-6">
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-white mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required
                           class="w-full px-4 py-3 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-lg text-white placeholder-white placeholder-opacity-60 input-focus transition-all duration-300"
                           placeholder="Enter your email">
                    <div id="emailError" class="text-red-300 text-sm mt-1 hidden"></div>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-white mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="w-full px-4 py-3 bg-white bg-opacity-10 border border-white border-opacity-20 rounded-lg text-white placeholder-white placeholder-opacity-60 input-focus transition-all duration-300 pr-12"
                               placeholder="Enter your password">
                        <button type="button" 
                                id="togglePassword"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white text-opacity-60 hover:text-opacity-100 transition-all duration-300">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div id="passwordError" class="text-red-300 text-sm mt-1 hidden"></div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" class="w-4 h-4 text-indigo-600 bg-white bg-opacity-10 border-white border-opacity-20 rounded focus:ring-indigo-500 focus:ring-2">
                        <span class="ml-2 text-sm text-white text-opacity-80">Remember me</span>
                    </label>
                    <a href="/forgot-password" class="text-sm text-white text-opacity-80 hover:text-opacity-100 transition-all duration-300">
                        Forgot password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        id="loginBtn"
                        class="w-full btn-gradient text-white font-semibold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span id="loginBtnText">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </span>
                    <span id="loginBtnLoading" class="hidden">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Signing In...
                    </span>
                </button>

                <!-- Error Message -->
                <div id="errorMessage" class="hidden bg-red-500 bg-opacity-20 border border-red-500 border-opacity-30 text-red-200 px-4 py-3 rounded-lg">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span id="errorText"></span>
                </div>

                <!-- Success Message -->
                <div id="successMessage" class="hidden bg-green-500 bg-opacity-20 border border-green-500 border-opacity-30 text-green-200 px-4 py-3 rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span id="successText"></span>
                </div>
            </form>

            <!-- Social Login Section -->
            <div class="social-login-section">
                <p class="text-center text-white text-opacity-80 mb-3">Or continue with</p>
                
                <a href="#" class="social-btn google" onclick="loginWithGoogle()">
                    <i class="fab fa-google"></i>
                    Continue with Google
                </a>
                
                <a href="#" class="social-btn facebook" onclick="loginWithFacebook()">
                    <i class="fab fa-facebook-f"></i>
                    Continue with Facebook
                </a>
                
                <a href="#" class="social-btn apple" onclick="loginWithApple()">
                    <i class="fab fa-apple"></i>
                    Continue with Apple
                </a>
            </div>

            <!-- Divider -->
            <div class="mt-8 pt-6 border-t border-white border-opacity-20">
                <p class="text-center text-white text-opacity-80">
                    Don't have an account? 
                    <a href="{{ route('jwt.register') }}" class="text-white font-semibold hover:text-opacity-80 transition-all duration-300">
                        Sign up here
                    </a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="mt-4 text-center">
                <a href="/" class="inline-flex items-center text-white text-opacity-60 hover:text-opacity-100 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Home
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Form submission
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnText = document.getElementById('loginBtnText');
            const loginBtnLoading = document.getElementById('loginBtnLoading');
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');
            const errorText = document.getElementById('errorText');
            const successText = document.getElementById('successText');
            
            // Clear previous errors
            clearErrors();
            
            // Show loading state
            loginBtn.disabled = true;
            loginBtnText.classList.add('hidden');
            loginBtnLoading.classList.remove('hidden');
            
            const formData = new FormData(this);
            const data = {
                email: formData.get('email'),
                password: formData.get('password')
            };
            
            try {
                const response = await fetch('{{ route("jwt.login") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Store token
                    localStorage.setItem('jwt_token', result.token);
                    localStorage.setItem('user', JSON.stringify(result.user));
                    
                    // Show success message
                    successText.textContent = result.message;
                    successMessage.classList.remove('hidden');
                    
                    // Redirect after delay
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 1500);
                } else {
                    // Show error message
                    if (result.errors) {
                        showFieldErrors(result.errors);
                    } else {
                        errorText.textContent = result.message;
                        errorMessage.classList.remove('hidden');
                    }
                }
            } catch (error) {
                console.error('Login error:', error);
                errorText.textContent = 'An unexpected error occurred. Please try again.';
                errorMessage.classList.remove('hidden');
            } finally {
                // Reset button state
                loginBtn.disabled = false;
                loginBtnText.classList.remove('hidden');
                loginBtnLoading.classList.add('hidden');
            }
        });
        
        function clearErrors() {
            document.getElementById('errorMessage').classList.add('hidden');
            document.getElementById('successMessage').classList.add('hidden');
            document.getElementById('emailError').classList.add('hidden');
            document.getElementById('passwordError').classList.add('hidden');
        }
        
        function showFieldErrors(errors) {
            if (errors.email) {
                document.getElementById('emailError').textContent = errors.email[0];
                document.getElementById('emailError').classList.remove('hidden');
            }
            if (errors.password) {
                document.getElementById('passwordError').textContent = errors.password[0];
                document.getElementById('passwordError').classList.remove('hidden');
            }
        }
        
        // Social login functions
        function loginWithGoogle() {
            // Initialize Google Sign-In
            if (typeof google !== 'undefined') {
                google.accounts.id.initialize({
                    client_id: '{{ env("GOOGLE_CLIENT_ID", "your-google-client-id") }}',
                    callback: handleGoogleResponse
                });
                google.accounts.id.prompt();
            } else {
                // Load Google Sign-In script if not loaded
                loadGoogleScript();
            }
        }
        
        function loginWithFacebook() {
            // Initialize Facebook SDK
            if (typeof FB !== 'undefined') {
                FB.login(function(response) {
                    if (response.authResponse) {
                        handleFacebookResponse(response);
                    } else {
                        showNotification('Facebook login cancelled', 'error');
                    }
                }, {scope: 'email,public_profile'});
            } else {
                loadFacebookScript();
            }
        }
        
        function loginWithApple() {
            // Initialize Apple Sign-In
            if (typeof AppleID !== 'undefined') {
                AppleID.auth.signIn();
            } else {
                loadAppleScript();
            }
        }
        
        // Load Google Sign-In script
        function loadGoogleScript() {
            const script = document.createElement('script');
            script.src = 'https://accounts.google.com/gsi/client';
            script.onload = function() {
                google.accounts.id.initialize({
                    client_id: '{{ env("GOOGLE_CLIENT_ID", "your-google-client-id") }}',
                    callback: handleGoogleResponse
                });
                google.accounts.id.prompt();
            };
            document.head.appendChild(script);
        }
        
        // Load Facebook SDK
        function loadFacebookScript() {
            window.fbAsyncInit = function() {
                FB.init({
                    appId: '{{ env("FACEBOOK_APP_ID", "your-facebook-app-id") }}',
                    cookie: true,
                    xfbml: true,
                    version: 'v18.0'
                });
                
                FB.login(function(response) {
                    if (response.authResponse) {
                        handleFacebookResponse(response);
                    } else {
                        showNotification('Facebook login cancelled', 'error');
                    }
                }, {scope: 'email,public_profile'});
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        }
        
        // Load Apple Sign-In script
        function loadAppleScript() {
            const script = document.createElement('script');
            script.src = 'https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js';
            script.onload = function() {
                AppleID.auth.init({
                    clientId: '{{ env("APPLE_CLIENT_ID", "your-apple-client-id") }}',
                    scope: 'name email',
                    redirectURI: '{{ url("/auth/apple/callback") }}',
                    state: 'login',
                    usePopup: true
                });
                AppleID.auth.signIn();
            };
            document.head.appendChild(script);
        }
        
        // Handle Google response
        function handleGoogleResponse(response) {
            const credential = response.credential;
            const payload = JSON.parse(atob(credential.split('.')[1]));
            
            fetch('/auth/google', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    token: credential,
                    email: payload.email,
                    name: payload.name,
                    google_id: payload.sub,
                    avatar: payload.picture
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    localStorage.setItem('jwt_token', data.token);
                    localStorage.setItem('user', JSON.stringify(data.user));
                    showNotification('Google login successful!', 'success');
                    setTimeout(() => window.location.href = '/', 1500);
                } else {
                    showNotification(data.message || 'Google login failed', 'error');
                }
            })
            .catch(error => {
                console.error('Google login error:', error);
                showNotification('Google login failed', 'error');
            });
        }
        
        // Handle Facebook response
        function handleFacebookResponse(response) {
            FB.api('/me', {fields: 'name,email,picture'}, function(userInfo) {
                fetch('/auth/facebook', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        token: response.authResponse.accessToken,
                        email: userInfo.email,
                        name: userInfo.name,
                        facebook_id: userInfo.id,
                        avatar: userInfo.picture.data.url
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        localStorage.setItem('jwt_token', data.token);
                        localStorage.setItem('user', JSON.stringify(data.user));
                        showNotification('Facebook login successful!', 'success');
                        setTimeout(() => window.location.href = '/', 1500);
                    } else {
                        showNotification(data.message || 'Facebook login failed', 'error');
                    }
                })
                .catch(error => {
                    console.error('Facebook login error:', error);
                    showNotification('Facebook login failed', 'error');
                });
            });
        }
        
        // Handle Apple response (callback from redirect)
        document.addEventListener('AppleIDSignInOnSuccess', (event) => {
            const data = event.detail;
            
            fetch('/auth/apple', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    token: data.authorization.id_token,
                    email: data.user?.email,
                    name: data.user?.name ? `${data.user.name.firstName} ${data.user.name.lastName}` : null,
                    apple_id: data.authorization.code
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    localStorage.setItem('jwt_token', data.token);
                    localStorage.setItem('user', JSON.stringify(data.user));
                    showNotification('Apple login successful!', 'success');
                    setTimeout(() => window.location.href = '/', 1500);
                } else {
                    showNotification(data.message || 'Apple login failed', 'error');
                }
            })
            .catch(error => {
                console.error('Apple login error:', error);
                showNotification('Apple login failed', 'error');
            });
        });
        
        document.addEventListener('AppleIDSignInOnFailure', (event) => {
            console.error('Apple Sign-In failed:', event.detail);
            showNotification('Apple login failed', 'error');
        });
        
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `position-fixed alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'}`;
            notification.style.cssText = 'top: 100px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
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
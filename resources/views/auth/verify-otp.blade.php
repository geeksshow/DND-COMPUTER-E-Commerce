<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mb-6">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    Verify OTP
                </h2>
                <p class="text-gray-600 text-sm leading-relaxed">
                    We've sent a 6-digit OTP to <span class="font-semibold text-blue-600">{{ $email }}</span>
                </p>
                <p class="text-gray-500 text-xs mt-2">
                    Check your email and enter the code below
                </p>
            </div>

            <!-- Session Status -->
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <form method="POST" action="{{ route('password.otp.verify') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Hidden Email Field -->
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- OTP Input -->
                    <div>
                        <label for="otp" class="block text-sm font-medium text-gray-700 mb-3">
                            Enter OTP Code
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                id="otp" 
                                type="text" 
                                name="otp" 
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-gray-900 placeholder-gray-400 text-center text-lg font-mono tracking-widest" 
                                placeholder="000000" 
                                maxlength="6" 
                                required 
                                autofocus
                                pattern="[0-9]{6}"
                                inputmode="numeric"
                            />
                        </div>
                        @error('otp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">
                            Enter the 6-digit code sent to your email
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-green-300 group-hover:text-green-200 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                            {{ __('Verify OTP') }}
                        </button>
                    </div>
                </form>

                <!-- Resend OTP -->
                <div class="mt-6 text-center">
                    <form method="POST" action="{{ route('password.otp.send') }}" class="inline">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <button type="submit" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition-colors duration-200">
                            Didn't receive the code? Resend
                        </button>
                    </form>
                </div>

                <!-- Back to Forgot Password -->
                <div class="mt-4 text-center">
                    <a href="{{ route('password.otp.request') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-500 transition-colors duration-200 group">
                        <svg class="mr-2 h-4 w-4 text-gray-600 group-hover:text-gray-500 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('Back to Forgot Password') }}
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center text-xs text-gray-500">
                <p>OTP expires in 10 minutes for security</p>
            </div>
        </div>
    </div>

    <script>
        // Auto-format OTP input
        document.getElementById('otp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 6) value = value.slice(0, 6);
            e.target.value = value;
        });
    </script>
</x-guest-layout>

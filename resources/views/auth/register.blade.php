<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - NewsPortal</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .register-card {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <!-- Background Pattern -->
    <div class="fixed inset-0 bg-gradient-to-br from-blue-50 to-purple-50 opacity-50"></div>
    
    <!-- Register Container -->
    <div class="relative w-full max-w-md">
        <!-- Back to Home Button -->
        <a href="{{ route('home') }}" 
           class="absolute -top-12 left-0 text-gray-600 hover:text-blue-600 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to News
        </a>

        <!-- Register Card -->
        <div class="register-card bg-white rounded-2xl overflow-hidden">
            <!-- Header with Gradient -->
            <div class="gradient-bg p-8 text-center text-white">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-user-plus text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold mb-2">Join NewsPortal</h1>
                <p class="text-white/80">Create your free account</p>
            </div>

            <!-- Register Form -->
            <div class="p-8">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                            <div>
                                <p class="text-red-800 font-medium">Registration Failed</p>
                                @foreach($errors->all() as $error)
                                    <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2 text-gray-400"></i>Full Name
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   required 
                                   autofocus
                                   class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg 
                                          input-focus focus:outline-none focus:border-blue-500
                                          transition duration-200"
                                   placeholder="John Doe">
                            <div class="absolute left-4 top-3.5">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-gray-400"></i>Email Address
                        </label>
                        <div class="relative">
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg 
                                          input-focus focus:outline-none focus:border-blue-500
                                          transition duration-200"
                                   placeholder="you@example.com">
                            <div class="absolute left-4 top-3.5">
                                <i class="fas fa-at text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-gray-400"></i>Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   required
                                   class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg 
                                          input-focus focus:outline-none focus:border-blue-500
                                          transition duration-200"
                                   placeholder="••••••••">
                            <div class="absolute left-4 top-3.5">
                                <i class="fas fa-key text-gray-400"></i>
                            </div>
                            <button type="button" 
                                    class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600"
                                    onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-toggle"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Must be at least 8 characters</p>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-8">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2 text-gray-400"></i>Confirm Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   required
                                   class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg 
                                          input-focus focus:outline-none focus:border-blue-500
                                          transition duration-200"
                                   placeholder="••••••••">
                            <div class="absolute left-4 top-3.5">
                                <i class="fas fa-key text-gray-400"></i>
                            </div>
                            <button type="button" 
                                    class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600"
                                    onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye" id="password-confirm-toggle"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="mb-8 flex items-start">
                        <input type="checkbox" 
                               id="terms" 
                               name="terms"
                               required
                               class="h-4 w-4 mt-1 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="terms" class="ml-3 text-sm text-gray-600">
                            I agree to the 
                            <a href="#" class="text-blue-600 hover:text-blue-800">Terms of Service</a> 
                            and 
                            <a href="#" class="text-blue-600 hover:text-blue-800">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full gradient-bg text-white py-3.5 px-4 rounded-lg font-semibold
                                   hover:opacity-90 transition duration-200 transform hover:-translate-y-0.5
                                   shadow-lg">
                        <i class="fas fa-user-plus mr-2"></i>Create Account
                    </button>

                    <!-- Divider -->
                    <div class="flex items-center my-8">
                        <div class="flex-1 border-t border-gray-300"></div>
                        <span class="mx-4 text-sm text-gray-500">Already have an account?</span>
                        <div class="flex-1 border-t border-gray-300"></div>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center">
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                            <i class="fas fa-sign-in-alt mr-2"></i>Sign in to existing account
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="mt-8 bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-star text-yellow-500 mr-2"></i>Why Join NewsPortal?
            </h3>
            <ul class="space-y-3">
                <li class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span>Create and publish your own articles</span>
                </li>
                <li class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span>Save favorite articles for later</span>
                </li>
                <li class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span>Personalized news feed</span>
                </li>
                <li class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span>Comment and discuss with community</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleIcon = document.getElementById(fieldId + '-toggle');
            
            if (!toggleIcon) {
                toggleIcon = document.getElementById('password-confirm-toggle');
            }
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Password strength indicator (optional)
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            updateStrengthIndicator(strength);
        });

        function checkPasswordStrength(password) {
            let score = 0;
            if (password.length >= 8) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;
            return score;
        }

        function updateStrengthIndicator(score) {
            const indicator = document.getElementById('password-strength');
            if (!indicator) return;
            
            const colors = ['text-red-500', 'text-orange-500', 'text-yellow-500', 'text-green-500'];
            const texts = ['Very Weak', 'Weak', 'Good', 'Strong'];
            
            indicator.className = `text-sm font-medium ${colors[score - 1] || 'text-red-500'}`;
            indicator.textContent = `Strength: ${texts[score - 1] || 'Very Weak'}`;
        }
    </script>
</body>
</html>
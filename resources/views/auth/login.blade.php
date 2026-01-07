<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NewsPortal</title>
    
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
        .login-card {
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
    
    <!-- Login Container -->
    <div class="relative w-full max-w-md">
        <!-- Back to Home Button -->
        <a href="{{ route('home') }}" 
           class="absolute -top-12 left-0 text-gray-600 hover:text-blue-600 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to News
        </a>

        <!-- Login Card -->
        <div class="login-card bg-white rounded-2xl overflow-hidden">
            <!-- Header with Gradient -->
            <div class="gradient-bg p-8 text-center text-white">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-lock text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold mb-2">Welcome Back</h1>
                <p class="text-white/80">Sign in to your NewsPortal account</p>
            </div>

            <!-- Login Form -->
            <div class="p-8">
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                            <div>
                                <p class="text-red-800 font-medium">Login Failed</p>
                                @foreach($errors->all() as $error)
                                    <p class="text-red-600 text-sm mt-1">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

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
                                   autofocus
                                   class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg 
                                          input-focus focus:outline-none focus:border-blue-500
                                          transition duration-200"
                                   placeholder="you@example.com">
                            <div class="absolute left-4 top-3.5">
                                <i class="fas fa-user text-gray-400"></i>
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
                                    onclick="togglePassword()">
                                <i class="fas fa-eye" id="password-toggle"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="remember" 
                                   name="remember"
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 text-sm text-gray-600">
                                Remember me
                            </label>
                        </div>
                        
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full gradient-bg text-white py-3.5 px-4 rounded-lg font-semibold
                                   hover:opacity-90 transition duration-200 transform hover:-translate-y-0.5
                                   shadow-lg">
                        <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                    </button>

                    <!-- Divider -->
                    <div class="flex items-center my-8">
                        <div class="flex-1 border-t border-gray-300"></div>
                        <span class="mx-4 text-sm text-gray-500">Or continue with</span>
                        <div class="flex-1 border-t border-gray-300"></div>
                    </div>

                    <!-- Social Login (Optional) -->
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <button type="button" 
                                class="flex items-center justify-center py-3 border border-gray-300 
                                       rounded-lg hover:bg-gray-50 transition">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            <span class="text-sm font-medium">Google</span>
                        </button>
                        <button type="button" 
                                class="flex items-center justify-center py-3 border border-gray-300 
                                       rounded-lg hover:bg-gray-50 transition">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            <span class="text-sm font-medium">Facebook</span>
                        </button>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center pt-6 border-t border-gray-100">
                        <p class="text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" 
                               class="text-blue-600 hover:text-blue-800 font-semibold ml-1">
                                Sign up here
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Demo Accounts (for testing) -->
        <div class="mt-8 bg-blue-50 rounded-xl p-6 border border-blue-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                <i class="fas fa-vial text-blue-500 mr-2"></i>Test Accounts
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                    <div>
                        <span class="font-medium text-gray-700">Admin</span>
                        <p class="text-gray-500">admin@newsportal.com</p>
                    </div>
                    <code class="bg-gray-100 px-2 py-1 rounded text-xs">password</code>
                </div>
                <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                    <div>
                        <span class="font-medium text-gray-700">Editor</span>
                        <p class="text-gray-500">editor@newsportal.com</p>
                    </div>
                    <code class="bg-gray-100 px-2 py-1 rounded text-xs">password</code>
                </div>
                <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                    <div>
                        <span class="font-medium text-gray-700">Author</span>
                        <p class="text-gray-500">author@newsportal.com</p>
                    </div>
                    <code class="bg-gray-100 px-2 py-1 rounded text-xs">password</code>
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-4 text-center">
                <i class="fas fa-info-circle mr-1"></i>Use these accounts for testing purposes
            </p>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle');
            
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

        // Auto-fill demo accounts
        document.addEventListener('DOMContentLoaded', function() {
            // Add click handlers for demo accounts
            document.querySelectorAll('.demo-account').forEach(account => {
                account.addEventListener('click', function() {
                    const email = this.dataset.email;
                    const password = this.dataset.password;
                    
                    document.getElementById('email').value = email;
                    document.getElementById('password').value = password;
                    
                    // Show success message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'mb-6 p-4 bg-green-50 border border-green-200 rounded-lg';
                    alertDiv.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <p class="text-green-800 font-medium">Demo account credentials filled!</p>
                        </div>
                    `;
                    
                    const form = document.querySelector('form');
                    form.insertBefore(alertDiv, form.firstChild);
                    
                    // Auto-remove after 3 seconds
                    setTimeout(() => alertDiv.remove(), 3000);
                });
            });
        });
    </script>
</body>
</html>
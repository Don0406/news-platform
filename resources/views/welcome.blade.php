<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'NewsHub') }} - Latest News & Updates</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold text-gray-900">News<span class="text-red-600">Hub</span></span>
                    </a>
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden md:flex ml-10 space-x-8">
                        <a href="/" class="text-gray-700 hover:text-red-600 font-medium border-b-2 border-red-600 pb-1">Home</a>
                        <a href="#" class="text-gray-700 hover:text-red-600 font-medium">Politics</a>
                        <a href="#" class="text-gray-700 hover:text-red-600 font-medium">Technology</a>
                        <a href="#" class="text-gray-700 hover:text-red-600 font-medium">Business</a>
                        <a href="#" class="text-gray-700 hover:text-red-600 font-medium">Sports</a>
                        <a href="#" class="text-gray-700 hover:text-red-600 font-medium">Entertainment</a>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Search news..." 
                               class="pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent w-64">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>

                    <!-- Auth Links -->
                    @if(Auth::check())
                        <div class="relative group">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-red-600"></i>
                                </div>
                                <span class="hidden md:inline text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
                                <a href="/admin/articles" class="block px-4 py-2 text-gray-700 hover:bg-red-50">
                                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                </a>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-gray-900 to-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-16 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-block px-3 py-1 bg-red-600 rounded-full text-sm font-semibold mb-4">BREAKING NEWS</span>
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                        Global Summit Addresses Climate Change Challenges
                    </h1>
                    <p class="text-gray-300 text-lg mb-8">
                        World leaders gather to discuss urgent measures against rising global temperatures and environmental degradation.
                    </p>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-400"><i class="far fa-clock mr-2"></i>2 hours ago</span>
                        <span class="text-gray-400"><i class="far fa-eye mr-2"></i>15.2k views</span>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-red-500 to-orange-500 h-64 lg:h-96 rounded-2xl flex items-center justify-center">
                        <div class="text-center p-8">
                            <i class="fas fa-globe-americas text-6xl mb-4 opacity-80"></i>
                            <p class="text-xl font-semibold">Featured Story</p>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-blue-500 rounded-2xl rotate-12 opacity-20"></div>
                    <div class="absolute -top-6 -left-6 w-24 h-24 bg-green-500 rounded-full opacity-20"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Featured News -->
            <div class="lg:col-span-2">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Latest News</h2>
                    <div class="flex space-x-2">
                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium">All</button>
                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Trending</button>
                        <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Popular</button>
                    </div>
                </div>

                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                    <!-- News Card 1 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-r from-blue-500 to-cyan-400 relative">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-blue-700 text-sm font-semibold rounded">TECHNOLOGY</span>
                            </div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">AI Revolution Transforms Healthcare Industry</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">
                                Artificial intelligence is making breakthroughs in medical diagnosis and treatment planning...
                            </p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-md text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Dr. Sarah Chen</p>
                                        <p class="text-sm text-gray-500">Medical Correspondent</p>
                                    </div>
                                </div>
                                <span class="text-gray-500 text-sm">3 hours ago</span>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 2 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-r from-green-500 to-emerald-400 relative">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-green-700 text-sm font-semibold rounded">BUSINESS</span>
                            </div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">Stock Markets Reach Record Highs Amid Economic Recovery</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">
                                Global markets show strong performance as economic indicators point towards sustained growth...
                            </p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-chart-line text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">James Wilson</p>
                                        <p class="text-sm text-gray-500">Financial Analyst</p>
                                    </div>
                                </div>
                                <span class="text-gray-500 text-sm">5 hours ago</span>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 3 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-r from-purple-500 to-pink-400 relative">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-purple-700 text-sm font-semibold rounded">SPORTS</span>
                            </div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">National Team Advances to Championship Finals</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">
                                Dramatic last-minute goal secures victory in semi-finals, setting up historic championship match...
                            </p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-futbol text-purple-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Mike Johnson</p>
                                        <p class="text-sm text-gray-500">Sports Editor</p>
                                    </div>
                                </div>
                                <span class="text-gray-500 text-sm">7 hours ago</span>
                            </div>
                        </div>
                    </div>

                    <!-- News Card 4 -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-r from-orange-500 to-yellow-400 relative">
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-orange-700 text-sm font-semibold rounded">ENTERTAINMENT</span>
                            </div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="text-xl font-bold">Award Season Kicks Off with Stellar Performances</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-4">
                                Hollywood's biggest night saw surprise winners and memorable moments that captivated audiences worldwide...
                            </p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-film text-orange-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">Emma Roberts</p>
                                        <p class="text-sm text-gray-500">Entertainment Reporter</p>
                                    </div>
                                </div>
                                <span class="text-gray-500 text-sm">9 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Load More -->
                <div class="text-center">
                    <button class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                        <i class="fas fa-sync-alt mr-2"></i>Load More Stories
                    </button>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-8">
                <!-- Trending Now -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-fire text-red-500 mr-2"></i> Trending Now
                    </h3>
                    <div class="space-y-4">
                        @for($i = 1; $i <= 5; $i++)
                        <div class="flex items-start space-x-3 pb-4 border-b border-gray-100 last:border-0">
                            <span class="text-2xl font-bold text-gray-300">{{ $i }}</span>
                            <div>
                                <h4 class="font-semibold text-gray-900 hover:text-red-600 cursor-pointer">
                                    Breaking: {{ ['New Policy Impacts', 'Market Update', 'Tech Innovation', 'Sports Drama', 'Cultural Event'][$i-1] }}
                                </h4>
                                <p class="text-sm text-gray-500 mt-1">{{ ['Politics', 'Business', 'Technology', 'Sports', 'Culture'][$i-1] }} • {{ rand(1, 10) }}k views</p>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="bg-gradient-to-br from-red-600 to-orange-500 rounded-xl p-6 text-white">
                    <h3 class="text-xl font-bold mb-4">Stay Updated</h3>
                    <p class="mb-6">Get the latest news delivered directly to your inbox.</p>
                    <div class="space-y-3">
                        <input type="email" placeholder="Your email address" 
                               class="w-full px-4 py-3 rounded-lg bg-white/20 backdrop-blur-sm border border-white/30 placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white">
                        <button class="w-full px-4 py-3 bg-white text-red-600 rounded-lg font-semibold hover:bg-gray-100">
                            Subscribe Now
                        </button>
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Categories</h3>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach(['Politics', 'Technology', 'Business', 'Sports', 'Health', 'Entertainment', 'Science', 'Travel'] as $category)
                        <a href="#" class="px-4 py-3 bg-gray-50 hover:bg-red-50 text-gray-700 hover:text-red-600 rounded-lg font-medium text-center transition">
                            {{ $category }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo and Description -->
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-xl"></i>
                        </div>
                        <span class="text-2xl font-bold">News<span class="text-red-600">Hub</span></span>
                    </div>
                    <p class="text-gray-400 mb-6">
                        Delivering accurate, timely, and comprehensive news coverage from around the globe.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-red-600">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Advertise</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Categories</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white">World News</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Technology</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Business</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Sports</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Entertainment</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Contact Us</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-red-600"></i>
                            <span class="text-gray-400">123 News Street, Media City</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-red-600"></i>
                            <span class="text-gray-400">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-red-600"></i>
                            <span class="text-gray-400">contact@newshub.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} NewsHub. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Button (Hidden on desktop) -->
    <button id="mobileMenuButton" class="md:hidden fixed bottom-6 right-6 w-14 h-14 bg-red-600 text-white rounded-full shadow-lg flex items-center justify-center z-50">
        <i class="fas fa-bars text-xl"></i>
    </button>
</body>
</html>
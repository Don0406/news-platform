<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsPortal - Latest Breaking News</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .article-card {
            transition: all 0.3s ease;
        }
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .category-active {
            background-color: #3b82f6;
            color: white;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- TOP NAVIGATION -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <i class="fas fa-newspaper text-3xl text-blue-600 mr-3"></i>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">NewsPortal</h1>
                        <p class="text-xs text-gray-500">Trusted News Source</p>
                    </div>
                </div>

                <!-- Search Bar (Center) -->
                <div class="flex-1 max-w-2xl mx-8">
                    <form action="{{ route('home') }}" method="GET" class="relative">
                        <input type="text" 
                               name="search" 
                               placeholder="Search for news, articles, topics..."
                               value="{{ request('search') }}"
                               class="w-full px-6 py-3 pl-12 rounded-full border border-gray-300 
                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                                      shadow-sm">
                        <div class="absolute left-4 top-3.5">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <button type="submit" 
                                class="absolute right-2 top-2 bg-blue-600 text-white px-4 py-1.5 rounded-full 
                                       hover:bg-blue-700 transition">
                            Search
                        </button>
                    </form>
                </div>

                <!-- Right Side - Auth/Profile -->
                <div class="flex items-center space-x-6">
                    @auth
                        <!-- User Profile Dropdown -->
                        <div class="relative group">
                            <button class="flex items-center space-x-3 focus:outline-none">
                                <div class="w-10 h-10 gradient-bg rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="hidden md:block text-left">
                                    <p class="font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <i class="fas fa-chevron-down text-gray-500"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border 
                                        hidden group-hover:block z-50">
                                <div class="p-4 border-b">
                                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                                    <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                                </div>
                                <a href="{{ route('dashboard') }}" 
                                   class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                                </a>
                                <a href="{{ route('profile.edit') }}" 
                                   class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-user-cog mr-3"></i>Profile Settings
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-3 text-gray-700 
                                                   hover:bg-red-50 hover:text-red-600 border-t">
                                        <i class="fas fa-sign-out-alt mr-3"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Login/Register Buttons -->
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}" 
                               class="text-gray-700 hover:text-blue-600 font-medium">
                                <i class="fas fa-sign-in-alt mr-2"></i>Sign In
                            </a>
                            <a href="{{ route('register') }}" 
                               class="bg-blue-600 text-white px-5 py-2.5 rounded-full 
                                      hover:bg-blue-700 font-medium shadow-md">
                                Get Started
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- CATEGORY NAVIGATION -->
            <div class="flex items-center justify-between py-3 border-t">
                <div class="flex space-x-1 overflow-x-auto">
                    <a href="{{ route('home') }}" 
                       class="px-5 py-2.5 rounded-full text-sm font-medium whitespace-nowrap
                              {{ !request('category') ? 'category-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-home mr-2"></i>All News
                    </a>
                    <a href="{{ route('home', ['category' => 'business']) }}" 
                       class="px-5 py-2.5 rounded-full text-sm font-medium whitespace-nowrap
                              {{ request('category') == 'business' ? 'category-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-chart-line mr-2"></i>Business
                    </a>
                    <a href="{{ route('home', ['category' => 'sports']) }}" 
                       class="px-5 py-2.5 rounded-full text-sm font-medium whitespace-nowrap
                              {{ request('category') == 'sports' ? 'category-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-football-ball mr-2"></i>Sports
                    </a>
                    <a href="{{ route('home', ['category' => 'entertainment']) }}" 
                       class="px-5 py-2.5 rounded-full text-sm font-medium whitespace-nowrap
                              {{ request('category') == 'entertainment' ? 'category-active' : 'text-gray-700 hover:bg-gray-100' }}">
                        <i class="fas fa-film mr-2"></i>Entertainment
                    </a>
                    <div class="relative group">
                        <button class="px-5 py-2.5 rounded-full text-sm font-medium whitespace-nowrap
                                       text-gray-700 hover:bg-gray-100 flex items-center">
                            <i class="fas fa-ellipsis-h mr-2"></i>More
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute hidden group-hover:block bg-white shadow-xl rounded-lg 
                                    mt-1 w-48 z-40 border">
                            <a href="{{ route('home', ['category' => 'technology']) }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-blue-50">
                                <i class="fas fa-laptop-code mr-3"></i>Technology
                            </a>
                            <a href="{{ route('home', ['category' => 'health']) }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-blue-50">
                                <i class="fas fa-heartbeat mr-3"></i>Health
                            </a>
                            <a href="{{ route('home', ['category' => 'science']) }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-blue-50">
                                <i class="fas fa-flask mr-3"></i>Science
                            </a>
                            <a href="{{ route('home', ['category' => 'politics']) }}" 
                               class="block px-4 py-3 text-gray-700 hover:bg-blue-50">
                                <i class="fas fa-landmark mr-3"></i>Politics
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Date/Time -->
                <div class="hidden lg:block text-sm text-gray-500">
                    <i class="far fa-clock mr-2"></i>
                    {{ now()->format('l, F j, Y') }}
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- FEATURED ARTICLE (HEADLINE) -->
        @if($featuredArticle)
            <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl article-card">
                <div class="gradient-bg p-8 text-white">
                    <div class="max-w-4xl">
                        <!-- Category & Date -->
                        <div class="flex items-center mb-6">
                            <span class="bg-white/30 px-4 py-1.5 rounded-full text-sm font-semibold">
                                {{ $featuredArticle->category }}
                            </span>
                            <span class="mx-4">•</span>
                            <span class="text-white/90">
                                <i class="far fa-clock mr-1"></i>
                                {{ $featuredArticle->created_at->format('F d, Y') }}
                            </span>
                            <span class="mx-4">•</span>
                            <span class="text-white/90">
                                <i class="far fa-eye mr-1"></i>{{ $featuredArticle->views }} views
                            </span>
                        </div>
                        
                        <!-- Headline -->
                        <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                            <a href="{{ route('public.articles.show', $featuredArticle->slug) }}" 
                               class="hover:text-blue-200 transition">
                                {{ $featuredArticle->title }}
                            </a>
                        </h2>
                        
                        <!-- Excerpt -->
                        <p class="text-xl mb-8 text-white/90 leading-relaxed">
                            {{ $featuredArticle->excerpt }}
                        </p>
                        
                        <!-- Author & Read More -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center 
                                            justify-center text-white font-bold text-lg mr-4">
                                    {{ strtoupper(substr($featuredArticle->author->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $featuredArticle->author->name ?? 'Staff Reporter' }}</p>
                                    <p class="text-sm text-white/80">Senior News Writer</p>
                                </div>
                            </div>
                            <a href="{{ route('public.articles.show', $featuredArticle->slug) }}" 
                               class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold 
                                      hover:bg-gray-100 transition shadow-lg">
                                Read Full Story <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- LATEST NEWS SECTION -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    <i class="fas fa-bolt text-yellow-500 mr-3"></i>Latest News
                </h2>
                <div class="text-sm text-gray-500">
                    Showing {{ $articles->count() }} of {{ $articles->total() }} articles
                </div>
            </div>

            <!-- NEWS GRID -->
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $article)
                        <div class="article-card bg-white rounded-xl shadow-lg overflow-hidden 
                                    border border-gray-100">
                            <!-- Article Image/Placeholder -->
                            <div class="h-56 gradient-bg relative overflow-hidden">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white/30 text-8xl"></i>
                                </div>
                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/90 text-gray-800 px-3 py-1.5 rounded-full 
                                                text-xs font-bold">
                                        {{ $article->category }}
                                    </span>
                                </div>
                                <!-- Views/Likes -->
                                <div class="absolute bottom-4 right-4 flex space-x-3">
                                    <span class="bg-black/50 text-white px-2 py-1 rounded text-xs">
                                        <i class="far fa-eye mr-1"></i>{{ $article->views }}
                                    </span>
                                    <span class="bg-black/50 text-white px-2 py-1 rounded text-xs">
                                        <i class="far fa-heart mr-1"></i>{{ $article->likes }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Article Content -->
                            <div class="p-6">
                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 leading-snug">
                                    <a href="{{ route('public.articles.show', $article->slug) }}" 
                                       class="hover:text-blue-600 transition">
                                        {{ Str::limit($article->title, 80) }}
                                    </a>
                                </h3>
                                
                                <!-- Excerpt -->
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    {{ Str::limit($article->excerpt, 120) }}
                                </p>
                                
                                <!-- Meta Info -->
                                <div class="flex items-center justify-between border-t pt-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center 
                                                    justify-center text-blue-600 font-bold text-sm mr-3">
                                            {{ strtoupper(substr($article->author->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $article->author->name ?? 'Anonymous' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $article->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Read More -->
                                    <a href="{{ route('public.articles.show', $article->slug) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                        Read <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- PAGINATION -->
                @if($articles->hasPages())
                    <div class="mt-12 flex justify-center">
                        <div class="bg-white px-6 py-3 rounded-full shadow-lg">
                            {{ $articles->links() }}
                        </div>
                    </div>
                @endif
            @else
                <!-- NO ARTICLES MESSAGE -->
                <div class="text-center py-16 bg-white rounded-2xl shadow">
                    <i class="fas fa-newspaper text-gray-300 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-semibold text-gray-700 mb-3">No articles found</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">
                        We couldn't find any articles matching your criteria. Try a different search or browse by category.
                    </p>
                    <a href="{{ route('home') }}" 
                       class="bg-blue-600 text-white px-6 py-3 rounded-full font-medium 
                              hover:bg-blue-700 inline-flex items-center">
                        <i class="fas fa-home mr-2"></i> Back to Home
                    </a>
                </div>
            @endif
        </div>

        <!-- TRENDING & SIDEBAR -->
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            <div class="lg:col-span-3">
                <!-- Additional content can go here -->
            </div>
            
            <!-- TRENDING SIDEBAR -->
            @if(isset($trendingArticles) && $trendingArticles->count() > 0)
                <div class="mt-12 lg:mt-0">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b">
                            <i class="fas fa-fire text-orange-500 mr-2"></i>Trending Now
                        </h3>
                        <div class="space-y-6">
                            @foreach($trendingArticles as $index => $trending)
                                <div class="pb-6 {{ !$loop->last ? 'border-b' : '' }}">
                                    <div class="flex items-start">
                                        <!-- Trend Number -->
                                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center 
                                                    rounded-full bg-gray-100 text-gray-800 font-bold 
                                                    mr-4 text-sm">
                                            {{ $index + 1 }}
                                        </div>
                                        
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-2 hover:text-blue-600">
                                                <a href="{{ route('public.articles.show', $trending->slug) }}">
                                                    {{ Str::limit($trending->title, 60) }}
                                                </a>
                                            </h4>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <span class="bg-gray-100 text-gray-700 px-2 py-1 
                                                            rounded text-xs mr-3">
                                                    {{ $trending->category }}
                                                </span>
                                                <span><i class="far fa-eye mr-1"></i>{{ $trending->views }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- View All Trending -->
                        <div class="mt-6 pt-6 border-t">
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium 
                                               flex items-center justify-center">
                                View All Trending
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & Description -->
                <div>
                    <div class="flex items-center mb-6">
                        <i class="fas fa-newspaper text-3xl text-blue-400 mr-3"></i>
                        <h3 class="text-2xl font-bold">NewsPortal</h3>
                    </div>
                    <p class="text-gray-400 mb-6">
                        Your trusted source for breaking news, in-depth analysis, and the latest updates from around the world.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Categories</h4>
                    <ul class="space-y-3">
                        @foreach(['Business', 'Sports', 'Entertainment', 'Technology', 'Health', 'Science'] as $cat)
                            <li>
                                <a href="{{ route('home', ['category' => strtolower($cat)]) }}" 
                                   class="text-gray-400 hover:text-white flex items-center">
                                    <i class="fas fa-chevron-right text-xs mr-2"></i>{{ $cat }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Stay Updated</h4>
                    <p class="text-gray-400 mb-4">Subscribe to our newsletter for daily news updates.</p>
                    <form class="mt-4">
                        <div class="flex">
                            <input type="email" 
                                   placeholder="Your email" 
                                   class="flex-1 px-4 py-3 rounded-l-lg text-gray-900 focus:outline-none">
                            <button type="submit" 
                                    class="bg-blue-600 px-4 py-3 rounded-r-lg hover:bg-blue-700">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} NewsPortal. All rights reserved.</p>
                <p class="mt-2 text-sm">Designed with Laravel & Tailwind CSS</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for interactivity -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Like button functionality
            document.querySelectorAll('.like-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const articleId = this.dataset.articleId;
                    if (articleId) {
                        fetch(`/api/articles/${articleId}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const icon = this.querySelector('i');
                                if (icon.classList.contains('far')) {
                                    icon.classList.remove('far');
                                    icon.classList.add('fas', 'text-red-500');
                                } else {
                                    icon.classList.remove('fas', 'text-red-500');
                                    icon.classList.add('far');
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
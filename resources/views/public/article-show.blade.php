<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - NewsPortal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <!-- Simple Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">
                    <i class="fas fa-arrow-left mr-2"></i>NewsPortal
                </a>
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home mr-1"></i> Back to News
                </a>
            </div>
        </div>
    </nav>

    <!-- Article Content -->
    <main class="max-w-4xl mx-auto px-4 py-8">
        <article class="bg-white rounded-xl shadow-lg p-8">
            <!-- Article Header -->
            <div class="mb-8">
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                    {{ $article->category }}
                </span>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mt-4 mb-6">{{ $article->title }}</h1>
                
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                        {{ substr($article->author->name ?? 'A', 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">{{ $article->author->name ?? 'Anonymous' }}</p>
                        <p class="text-gray-600 text-sm">
                            <i class="far fa-clock mr-1"></i>{{ $article->created_at->format('F d, Y') }}
                            • <i class="far fa-eye mr-1"></i>{{ $article->views }} views
                            • <i class="far fa-heart mr-1"></i>{{ $article->likes }} likes
                        </p>
                    </div>
                </div>
            </div>

            <!-- Article Image/Placeholder -->
            <div class="mb-8 bg-gradient-to-r from-blue-400 to-blue-600 h-64 rounded-lg flex items-center justify-center">
                <i class="fas fa-newspaper text-white text-8xl opacity-50"></i>
            </div>

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none mb-8">
                <p class="text-gray-700 text-lg leading-relaxed">{{ $article->content }}</p>
            </div>

            <!-- Tags -->
            @if($article->tags)
                <div class="border-t pt-8">
                    <h3 class="text-lg font-semibold mb-4">
                        <i class="fas fa-tags mr-2"></i>Tags
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $article->tags) as $tag)
                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-hashtag mr-1"></i>{{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Article Stats -->
            <div class="border-t pt-8 mt-8 flex justify-between items-center text-gray-500">
                <div>
                    <button class="text-red-500 hover:text-red-600 mr-4">
                        <i class="far fa-heart text-lg"></i> Like
                    </button>
                    <button class="text-blue-500 hover:text-blue-600">
                        <i class="far fa-share-square text-lg"></i> Share
                    </button>
                </div>
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Back to News
                </a>
            </div>
        </article>

        <!-- Related Articles -->
        @if(isset($relatedArticles) && $relatedArticles->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                            <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded mb-3 inline-block">
                                {{ $related->category }}
                            </span>
                            <h3 class="font-bold text-gray-900 mb-2">
                                <a href="{{ route('public.articles.show', $related->slug) }}" class="hover:text-blue-600">
                                    {{ Str::limit($related->title, 60) }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm">
                                <i class="far fa-clock mr-1"></i>{{ $related->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12 py-8 text-center">
        <p>&copy; {{ date('Y') }} NewsPortal. All rights reserved.</p>
        <p class="text-gray-400 mt-2">Your trusted news source</p>
    </footer>
</body>
</html>
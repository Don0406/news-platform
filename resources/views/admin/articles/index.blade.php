<!DOCTYPE html>
<html>
<head>
    <title>Admin - Articles</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Admin Navigation -->
    @include('admin.partials.navigation')

    <div class="ml-64"> <!-- Offset for sidebar -->
        <div class="p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Article Management</h1>
                        <p class="text-gray-600">Create, edit, and manage your news articles</p>
                    </div>
                    <a href="{{ route('admin.articles.create') }}" 
                       class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold flex items-center">
                        <i class="fas fa-plus mr-2"></i> New Article
                    </a>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg mr-4">
                                <i class="fas fa-newspaper text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Articles</p>
                                <p class="text-2xl font-bold">{{ $articles->total() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg mr-4">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Published</p>
                                <p class="text-2xl font-bold">{{ \App\Models\Article::where('status', 'published')->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                                <i class="fas fa-edit text-yellow-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Drafts</p>
                                <p class="text-2xl font-bold">{{ \App\Models\Article::where('status', 'draft')->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg mr-4">
                                <i class="fas fa-eye text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Views</p>
                                <p class="text-2xl font-bold">{{ \App\Models\Article::sum('views') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Articles Table -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-semibold text-gray-800">All Articles</h2>
                            <div class="flex items-center space-x-4">
                                <div class="relative">
                                    <input type="text" placeholder="Search articles..." 
                                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                                <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                    <option>All Status</option>
                                    <option>Published</option>
                                    <option>Draft</option>
                                    <option>Archived</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Article
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Views
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Published
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($articles as $article)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-lg {{ $article->featured_image_url }} flex items-center justify-center mr-4">
                                                <i class="fas fa-newspaper text-white"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($article->title, 50) }}</div>
                                                <div class="text-sm text-gray-500">by {{ $article->author->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ ucfirst($article->category) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($article->status === 'published')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Published
                                        </span>
                                        @elseif($article->status === 'draft')
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-edit mr-1"></i> Draft
                                        </span>
                                        @else
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            <i class="fas fa-archive mr-1"></i> Archived
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <i class="fas fa-eye text-gray-400 mr-2"></i>
                                            <span class="text-sm text-gray-900">{{ number_format($article->views) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $article->published_at ? $article->published_at->format('M d, Y') : 'Not published' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.articles.edit', $article) }}" 
                                               class="text-blue-600 hover:text-blue-900 p-2 rounded-lg hover:bg-blue-50">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($article->status !== 'published')
                                            <form action="{{ route('admin.articles.publish', $article) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900 p-2 rounded-lg hover:bg-green-50">
                                                    <i class="fas fa-paper-plane"></i>
                                                </button>
                                            </form>
                                            @endif
                                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to delete this article?')"
                                                        class="text-red-600 hover:text-red-900 p-2 rounded-lg hover:bg-red-50">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="text-gray-400 mb-4">
                                            <i class="fas fa-newspaper text-4xl"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">No articles yet</h3>
                                        <p class="text-gray-500 mb-6">Get started by creating your first news article</p>
                                        <a href="{{ route('admin.articles.create') }}" 
                                           class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold inline-flex items-center">
                                            <i class="fas fa-plus mr-2"></i> Create First Article
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($articles->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $articles->links() }}
                    </div>
                    @endif
                </div>

                <!-- Quick Stats -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Top Categories</h3>
                        @php
                            $categories = \App\Models\Article::selectRaw('category, count(*) as count')
                                ->groupBy('category')
                                ->orderBy('count', 'desc')
                                ->take(5)
                                ->get();
                        @endphp
                        <div class="space-y-3">
                            @foreach($categories as $cat)
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700">{{ ucfirst($cat->category) }}</span>
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-sm font-semibold rounded">
                                    {{ $cat->count }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Most Viewed</h3>
                        @php
                            $popular = \App\Models\Article::orderBy('views', 'desc')->take(3)->get();
                        @endphp
                        <div class="space-y-4">
                            @foreach($popular as $pop)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-lg {{ $pop->featured_image_url }} flex items-center justify-center mr-3">
                                    <i class="fas fa-fire text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($pop->title, 40) }}</p>
                                    <p class="text-xs text-gray-500">{{ number_format($pop->views) }} views</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-plus text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-900">New article created</p>
                                    <p class="text-xs text-gray-500">2 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-edit text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-900">Article updated</p>
                                    <p class="text-xs text-gray-500">5 hours ago</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-paper-plane text-red-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-900">Article published</p>
                                    <p class="text-xs text-gray-500">Yesterday</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        {{ session('success') }}
        <button class="ml-4 text-white/80 hover:text-white" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span>Please check the form for errors</span>
            <button class="ml-4 text-white/80 hover:text-white" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif
</body>
</html>
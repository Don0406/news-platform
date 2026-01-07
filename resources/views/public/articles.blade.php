@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Latest News
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Search and Filter -->
        <div class="mb-8">
            <form action="{{ route('home') }}" method="GET" class="flex gap-4">
                <input type="text" name="search" placeholder="Search articles..." 
                       value="{{ request('search') }}"
                       class="flex-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <select name="category" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Categories</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Filter
                </button>
            </form>
        </div>

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow duration-300">
                    @if($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                             alt="{{ $article->title }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                {{ $article->category }}
                            </span>
                            <span class="mx-2">•</span>
                            <span>{{ $article->created_at->format('M d, Y') }}</span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            <a href="{{ route('public.articles.show', $article) }}" class="hover:text-blue-600">
                                {{ $article->title }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit($article->excerpt ?? $article->content, 150) }}
                        </p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($article->author->name, 0, 1) }}
                                </div>
                                <span class="ml-2 text-sm text-gray-700">{{ $article->author->name }}</span>
                            </div>
                            
                            <a href="{{ route('public.articles.show', $article) }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium">
                                Read more →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No articles found</h3>
                    <p class="text-gray-500">Check back later for new content!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

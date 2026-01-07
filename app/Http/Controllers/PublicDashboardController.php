<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicDashboardController extends Controller
{
    /**
     * Display the public dashboard/homepage
     */
    public function index(Request $request)
    {
        // Get featured article (most recent published)
        $featuredArticle = Article::where('status', 'published')
            ->latest()
            ->first();

        // Build articles query
        $query = Article::where('status', 'published')
            ->with('author')
            ->latest();

        // Filter by category
        if ($request->has('category') && $request->category && $request->category != 'all') {
            $query->where('category', ucfirst($request->category));
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%')
                  ->orWhere('excerpt', 'like', '%' . $search . '%');
            });
        }

        // Paginate articles
        $articles = $query->paginate(12);

        // Get trending articles (most viewed in last 7 days)
        $trendingArticles = Article::where('status', 'published')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // Get all categories for filter
        $categories = Article::where('status', 'published')
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('public.dashboard', [
            'featuredArticle' => $featuredArticle,
            'articles' => $articles,
            'trendingArticles' => $trendingArticles,
            'categories' => $categories,
        ]);
    }

    /**
     * Display articles by category
     */
    public function byCategory($category)
    {
        $articles = Article::where('status', 'published')
            ->where('category', ucfirst($category))
            ->with('author')
            ->latest()
            ->paginate(12);

        $trendingArticles = Article::where('status', 'published')
            ->where('category', ucfirst($category))
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        return view('public.dashboard', [
            'articles' => $articles,
            'trendingArticles' => $trendingArticles,
            'category' => $category,
        ]);
    }

    /**
     * Display a single article
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
        
        // Increment views
        $article->increment('views');
        
        // Get related articles
        $relatedArticles = Article::where('status', 'published')
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->take(3)
            ->get();
        
        return view('public.article-show', compact('article', 'relatedArticles'));
    }

    /**
     * Get popular articles (API)
     */
    public function getPopular()
    {
        $articles = Article::where('status', 'published')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->take(5)
            ->get();
        
        return response()->json($articles);
    }
}
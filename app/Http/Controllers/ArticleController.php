<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['publicIndex', 'publicShow', 'byCategory']);
    }
    
    /**
     * Display a listing of articles for management
     */
    public function index(Request $request)
    {
        $query = Article::query();
        $user = Auth::user();
        
        // Authors can only see their own articles
        if ($user->hasRole('author')) {
            $query->where('user_id', $user->id);
        }
        
        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        $articles = $query->latest()->paginate(10);
        
        return view('articles.index', compact('articles'));
    }
    
    /**
     * Show the form for creating a new article
     */
    public function create()
    {
        return view('articles.create');
    }
    
    /**
     * Store a newly created article
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'featured_image' => 'nullable|image|max:2048',
        ]);
        
        // Generate slug
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        
        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }
        
        // Set default status based on role
        $validated['status'] = 'draft';
        $validated['user_id'] = Auth::id();
        
        Article::create($validated);
        
        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }
    
    /**
     * Show the form for editing an article
     */
    public function edit(Article $article)
    {
        // Authorization check
        $this->authorize('update', $article);
        
        return view('articles.edit', compact('article'));
    }
    
    /**
     * Update the specified article
     */
    public function update(Request $request, Article $article)
    {
        // Authorization check
        $this->authorize('update', $article);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'nullable|in:draft,pending,published',
        ]);
        
        // Update slug if title changed
        if ($article->title != $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        }
        
        // Handle featured image update
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }
        
        // Only editors/admins can change status
        if (!Auth::user()->hasRole('editor') && !Auth::user()->hasRole('admin')) {
            unset($validated['status']);
        }
        
        $article->update($validated);
        
        return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    }
    
    /**
     * Remove the specified article
     */
    public function destroy(Article $article)
    {
        // Authorization check
        $this->authorize('delete', $article);
        
        // Delete featured image if exists
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }
        
        $article->delete();
        
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }
    
    /**
     * Publish an article
     */
    public function publish(Article $article)
    {
        // Only editors/admins can publish
        if (!Auth::user()->hasRole('editor') && !Auth::user()->hasRole('admin')) {
            abort(403);
        }
        
        $article->update(['status' => 'published']);
        
        return redirect()->back()->with('success', 'Article published successfully!');
    }
    
    /**
     * Like an article (API)
     */
    public function like(Article $article)
    {
        $user = Auth::user();
        
        // Toggle like
        if ($user->likedArticles()->where('article_id', $article->id)->exists()) {
            $user->likedArticles()->detach($article->id);
            $liked = false;
        } else {
            $user->likedArticles()->attach($article->id);
            $liked = true;
        }
        
        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $article->likes()->count()
        ]);
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
    
    /**
     * Show pending articles for editors
     */
    public function pending()
    {
        if (!Auth::user()->hasRole('editor') && !Auth::user()->hasRole('admin')) {
            abort(403);
        }
        
        $articles = Article::where('status', 'pending')->latest()->paginate(10);
        
        return view('articles.pending', compact('articles'));
    }
    
    /**
     * Approve an article
     */
    public function approve(Article $article)
    {
        if (!Auth::user()->hasRole('editor') && !Auth::user()->hasRole('admin')) {
            abort(403);
        }
        
        $article->update(['status' => 'published']);
        
        return redirect()->back()->with('success', 'Article approved and published!');
    }
    
    /**
     * Reject an article
     */
    public function reject(Article $article)
    {
        if (!Auth::user()->hasRole('editor') && !Auth::user()->hasRole('admin')) {
            abort(403);
        }
        
        $article->update(['status' => 'draft']);
        
        return redirect()->back()->with('success', 'Article rejected and moved to drafts.');
    }
}
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicDashboardController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =================== PUBLIC DASHBOARD ROUTES ===================
// Homepage - Public News Dashboard
Route::get('/', [PublicDashboardController::class, 'index'])->name('home');
Route::get('/home', [PublicDashboardController::class, 'index'])->name('public.dashboard');
Route::get('/news', [PublicDashboardController::class, 'index'])->name('public.articles.index');
// Category pages
Route::get('/category/{category}', [PublicDashboardController::class, 'byCategory'])->name('public.category');

// Single article view
Route::get('/articles/{slug}', [PublicDashboardController::class, 'show'])->name('public.articles.show');

// Test route - you can remove later
Route::get('/test-simple', function() {
    $articles = \App\Models\Article::paginate(6);
    $featuredArticle = \App\Models\Article::first();
    
    return view('public.dashboard', [
        'articles' => $articles,
        'featuredArticle' => $featuredArticle
    ]);
});

// =================== AUTHENTICATION ROUTES ===================
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    Route::get('register', function () {
        return view('auth.register');
    })->name('register');
    
    Route::post('register', [LoginController::class, 'register'])->name('register.post');
});

// =================== PROTECTED ROUTES (Logged in users) ===================
Route::middleware(['auth'])->group(function () {
    // User Dashboard (after login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Article Management (Create/Edit/Delete)
    Route::resource('articles', ArticleController::class)->except(['show']);
    Route::post('/articles/{article}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out successfully!');
    });
});

// =================== ADMIN ROUTES ===================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    
    // Admin Article Management
    Route::get('/articles/all', [AdminController::class, 'allArticles'])->name('articles.all');
});

// =================== EDITOR ROUTES ===================
Route::middleware(['auth', 'role:editor|admin'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/pending', [ArticleController::class, 'pending'])->name('articles.pending');
    Route::post('/articles/{article}/approve', [ArticleController::class, 'approve'])->name('articles.approve');
    Route::post('/articles/{article}/reject', [ArticleController::class, 'reject'])->name('articles.reject');
});

// =================== API ROUTES ===================
Route::prefix('api')->group(function () {
    // Public API routes
    Route::get('/articles/popular', [PublicDashboardController::class, 'getPopular'])->name('api.articles.popular');
    Route::get('/articles/latest', [PublicDashboardController::class, 'getLatest'])->name('api.articles.latest');
    
    // Protected API routes
    Route::middleware(['auth'])->group(function () {
        Route::post('/articles/{article}/like', [ArticleController::class, 'like'])->name('api.articles.like');
    });
});

// =================== FALLBACK ROUTE ===================
Route::fallback(function () {
    return redirect()->route('home')->with('error', 'Page not found.');
});

Route::get('/test-debug', function() {
    // Test if controller works
    $controller = new \App\Http\Controllers\PublicDashboardController();
    $request = new \Illuminate\Http\Request();
    
    try {
        $data = $controller->index($request)->getData();
        
        return response()->json([
            'success' => true,
            'articles_count' => $data['articles']->count(),
            'featured_article' => $data['featuredArticle'] ? $data['featuredArticle']->title : 'None',
            'trending_count' => $data['trendingArticles']->count(),
            'view_exists' => view()->exists('public.dashboard')
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
    }
});
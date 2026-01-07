<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard after login
     */
    public function index()
    {
        $user = Auth::user();
        $data = [];
        
        // Get user's articles count (using author_id since that's your column name)
        $data['userArticles'] = Article::where('author_id', $user->id)->count();
        
        // If admin, get total users
        if ($user->hasRole('admin') || $user->role === 'admin') {
            $data['totalUsers'] = User::count();
        }
        
        // If editor or admin, get pending articles
        if ($user->hasRole('editor') || $user->hasRole('admin') || 
            $user->role === 'editor' || $user->role === 'admin') {
            $data['pendingArticles'] = Article::where('status', 'pending')->count();
        }
        
        // Get recent user articles
        $data['recentArticles'] = Article::where('author_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        return view('dashboard', $data);
    }
}
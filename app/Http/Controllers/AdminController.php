<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    
    public function index()
    {
        $data = [
            'totalUsers' => User::count(),
            'totalArticles' => Article::count(),
            'pendingArticles' => Article::where('status', 'pending')->count(),
            'todayArticles' => Article::whereDate('created_at', today())->count(),
            'recentArticles' => Article::latest()->take(5)->get(),
            'recentUsers' => User::latest()->take(5)->get(),
        ];
        
        return view('admin.dashboard', $data);
    }
    
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }
    
    public function allArticles()
    {
        $articles = Article::latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }
}
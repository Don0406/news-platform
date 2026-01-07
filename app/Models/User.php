<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Add this if you have role column
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationship with articles (using author_id)
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    // Check if user has specific role
    public function hasRole($role)
    {
        // Simple role check - you can use Spatie package for more complex
        return $this->role === $role;
    }

    // Check if user can create articles
    public function canCreateArticle()
    {
        return in_array($this->role, ['admin', 'editor', 'author']);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'featured_image',
        'status',
        'tags',           // Added
        'views',          // Added
        'likes',          // Added
        'author_id',      // Changed from user_id
        'published_at',
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->slug = \Str::slug($article->title);
        });

        static::updating(function ($article) {
            $article->slug = \Str::slug($article->title);
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / 200);
        return $minutes . ' min read';
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        
        // Return gradient based on category
        $gradients = [
            'politics' => 'from-blue-500 to-cyan-400',
            'technology' => 'from-purple-500 to-pink-400',
            'business' => 'from-green-500 to-emerald-400',
            'sports' => 'from-orange-500 to-yellow-400',
            'entertainment' => 'from-red-500 to-pink-400',
            'health' => 'from-teal-500 to-cyan-400',
            'science' => 'from-indigo-500 to-purple-400',
            'world' => 'from-gray-500 to-blue-400',
        ];
        
        return $gradients[$this->category] ?? 'from-gray-500 to-gray-400';
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}
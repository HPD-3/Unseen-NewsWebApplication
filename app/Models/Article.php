<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'category',
        'type',
        'country',
        'continent',
        'language',
        'content',
        'author',
        'published_at',
        'is_trending',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_trending'  => 'boolean',
    ];

    /**
     * Scope: published articles only
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    /**
     * Increment article views safely
     */
    public function incrementViews()
    {
        $this->increment('views');
    }
}

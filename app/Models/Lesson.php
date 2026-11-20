<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $fillable = [
        'category_id',
        'playlist_id',
        'title',
        'slug',
        'description',
        'image_url',
        'youtube_url',
        'audio_url',
        'file_url',
        'body',
        'is_public',
    ];

    protected function casts(): array
    {
        return [
            'body' => 'array',
            'is_public' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function playlist(): BelongsTo
    {
        return $this->belongsTo(Playlist::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'lesson_tags');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }
}

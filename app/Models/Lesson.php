<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function mark()
    {
        return $this->hasMany(Mark::class);
    }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}

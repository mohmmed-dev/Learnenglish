<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function lessons()
    {
        return $this->hasMany(Category::class);
    }
    public function playlists()
    {
        return $this->hasMany(Category::class);
    }
}

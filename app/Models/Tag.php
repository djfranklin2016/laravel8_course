<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function blogPosts()
    {
        // return $this->belongsToMany('App\Models\BlogPost')->withTimestamps();    // Many-to-Many relationshp definition
        return $this->morphedByMany('App\Models\BlogPost', 'taggable')->withTimestamps()->as('tagged');    // Many-to-Many polymorphic relationshp definition
    }

    public function comments()
    {
        return $this->morphedByMany('App\Models\Comment', 'taggable')->withTimestamps()->as('tagged');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function blogPosts()
    {
        return $this->belongsToMany('App\Models\BlogPost')->withTimestamps();    // Many-to-Many relationshp definition
    }
    
}

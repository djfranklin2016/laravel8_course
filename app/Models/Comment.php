<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // NB Make function name = DB table field name ie blogPost => blog_post
    // Laravel deaults to 'id' on indexes so thus will look for blog_post_id
    public function blogPost()
    {
        return $this->belongsTo('App\Models\BlogPost');
    }
}

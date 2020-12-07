<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;   // when adding SoftDeletes to table structure

class Comment extends Model
{
    use HasFactory;

    use SoftDeletes;        // when adding SoftDeletes to table structure

    // NB Make function name = DB table field name ie blogPost => blog_post
    // Laravel deaults to 'id' on indexes so thus will look for blog_post_id
    public function blogPost()
    {
        return $this->belongsTo('App\Models\BlogPost');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $guarded=[];

    // protected $fillable = [
    //     'title',            // DB Table blog_posts column headings
    //     'content',
    //     'user_id'
    // ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function (BlogPost $blogPost) {
            
        });
    }
}

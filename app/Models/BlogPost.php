<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;   // when adding SoftDeletes to table structure

class BlogPost extends Model
{
    use HasFactory;

    use SoftDeletes;        // when adding SoftDeletes to table structure


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

    // How to delete blogposts that have coments associated thro' foreign key
    // works by being run immediately BEFORE deleting a blog post - it's called and then
    // deletes all associated comments first - THEN deletes blog post
    public static function boot()
    {
        parent::boot();

        static::deleting(function (BlogPost $blogPost) {
            $blogPost->comments()->delete();
        });
        // ABOVE works in tune with SoftDeletes to SoftDelete comments

        static::restoring(function(BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
        // ABOVE works in tune with SoftDeletes to Restore comments when Blog Restored
    }

}

<?php

namespace App\Models;

use App\Scopes\LatestScope;
use App\Traits\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;   // when adding SoftDeletes to table structure
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;

    use SoftDeletes, Taggable;        // when adding SoftDeletes to table structure

    // NB Make function name = DB table field name ie blogPost => blog_post
    // Laravel deaults to 'id' on indexes so thus will look for blog_post_id

    // protected $guarded=[];

    protected $fillable = ['user_id', 'content'];   // so these fields can be mass-assignable - see PostCommentController

    // public function blogPost()
    // {
    //     return $this->belongsTo('App\Models\BlogPost');
    // }

    public function commentable()     // morph comments to either Users or BlogPosts etc - see each Model
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // public function tags()      // Many-to-Many polymorphic relationshp definition for Comments -> Tags
    // {
    //     return $this->morphToMany('App\Models\Tag', 'taggable')->withTimestamps();
    // }    MOVED to Traits\Taggable - see "use" statement above

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     // static::addGlobalScope(new LatestScope);     // disable Global Scope - use LOCAL Scope above

    //     // When creating a Comment 'forget' the cache for blog post comments and most commented

    //     // MOVED TO COMMENT OBSERVER
    //     // static::creating(function (Comment $comment) {
    //     //     // dump($comment);
    //     //     // dd(BlogPost::class);

    //     //     if ($comment->commentable_type === BlogPost::class) {
    //     //     // Cache::tags(['blog-post'])->forget("blog-post-{$comment->blog_post_id}");
    //     //     Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
    //     //     Cache::tags(['blog-post'])->forget('mostCommented');
    //     //     }
    //     // });

    // }

}

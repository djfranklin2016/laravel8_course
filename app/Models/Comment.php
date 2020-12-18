<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;   // when adding SoftDeletes to table structure
use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use HasFactory;

    use SoftDeletes;        // when adding SoftDeletes to table structure

    // NB Make function name = DB table field name ie blogPost => blog_post
    // Laravel deaults to 'id' on indexes so thus will look for blog_post_id

    // protected $guarded=[];

    protected $fillable = ['user_id', 'content'];   // so these fields can be mass-assignable - see PostCommentController

    public function blogPost()
    {
        return $this->belongsTo('App\Models\BlogPost');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new LatestScope);     // disable Global Scope - use LOCAL Scope above

        // When creating a Comment 'forget' the cache for blog post comments and most commented
        static::creating(function (Comment $comment) {
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->blog_post_id}");
            Cache::tags(['blog-post'])->forget('mostCommented');
        });
    }

}

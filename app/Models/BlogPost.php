<?php

namespace App\Models;

use App\Scopes\DeletedAdminScope;
use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;   // when adding SoftDeletes to table structure
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
    use HasFactory;

    use SoftDeletes;        // when adding SoftDeletes to table structure


    // protected $guarded=[];

    protected $fillable = [
        'title',            // DB Table blog_posts column headings
        'content',
        'user_id'
    ];

    public function comments()
    {
        // return $this->hasMany('App\Models\Comment');
        return $this->hasMany('App\Models\Comment')->latest();  // use local scope Latest for this entire relationship
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();  // Many-to-Many relationshp definition
    }

    // local scope Latest()
    public function scopeLatest(Builder $query)     // LOCAL SCOPE created in the BlogPost Model
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    // local scope MostCommented()
    public function scopeMostCommented(Builder $query)
    {
        // withCount(var) produces a variable var_count which can then be ordered 'asc', 'desc' etc.
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }


    // How to delete blogposts that have coments associated thro' foreign key
    // works by being run immediately BEFORE deleting a blog post - it's called and then
    // deletes all associated comments first - THEN deletes blog post
    public static function boot()
    {
        static::addGlobalScope(new DeletedAdminScope);  // added above parent::boot() so as not to be overwritten by Laravel's standard loading of SoftDeletes

        parent::boot();

        // static::addGlobalScope(new LatestScope);     // changed to Local Scope - see above

        static::deleting(function (BlogPost $blogPost) {
            $blogPost->comments()->delete();
        });
        // ABOVE works in tune with SoftDeletes to SoftDelete comments

        static::updating(function (BlogPost $blogPost) {
            Cache::forget("blog-post-{$blogPost->id}");
        });

        static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
        // ABOVE works in tune with SoftDeletes to Restore comments when Blog Restored

    }

}

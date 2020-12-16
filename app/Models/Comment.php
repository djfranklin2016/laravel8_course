<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new LatestScope);     // disable Global Scope - use LOCAL Scope above
    }

}

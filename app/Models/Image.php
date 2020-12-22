<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    // protected $fillable = ['path', 'blog_post_id'];
    protected $fillable = ['path'];

    // public function blogPost()
    // {
    //     return $this->belongsTo('App\Models\BlogPost');
    // }

    public function imageable()     // morph images to either User profile pic or BlogPost pic - see each Model
    {
        return $this->morphTo();
    }

    public function url()
    {
        return Storage::url($this->path);       // return the image's url path
    }
}

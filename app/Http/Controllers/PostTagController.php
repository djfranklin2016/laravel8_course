<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;#
use App\Models\Tag;


class PostTagController extends Controller
{
    public function index($tag)
    {
        $tag = Tag::findOrFail($tag);

        // return view('posts.index', [
        //     'posts' => $tag->blogPosts,
        //     // 'mostCommented' => [],
        //     // 'mostActive' => [],
        //     // 'mostActiveLastMonth' => [],
        //     // now part of ViewComposer - Activity Composer
        // ]);

        // return view('posts.index', [
        //     'posts' => $tag->blogPosts()
        //         ->latest()
        //         ->withCount('comments')
        //         ->with('user')
        //         ->with('tags')
        //         ->get()
        // ]);

        return view('posts.index', [
            'posts' => $tag->blogPosts()
                ->LatestWithRelations()     // Query moved to local scope in BlogPost model so can be reused - see PostsController 
                ->get()
        ]);
    }
}

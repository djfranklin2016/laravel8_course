<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Mail\CommentPosted;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentPostedMarkdown;

class PostCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store']); // makes sure user is authorised to Store a Comment
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        // Comment::create()
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        // Mail::to($post->user)->send(                 // send NOW
        //     // new CommentPosted($comment)
        //     new CommentPostedMarkdown($comment)
        // );

        // Mail::to($post->user)->queue(                   // place into Queue and send asap
        //     new CommentPostedMarkdown($comment)
        // );

        $when = now()->addMinutes(1);

        Mail::to($post->user)->later(                       // place into Queue and send after Delay (When) has been met
            $when,
            new CommentPostedMarkdown($comment)
        );

        // $request->session()->flash('status', 'Comment added');
        // return redirect()->back();

        return redirect()->back()
            ->withStatus('Comment added');
    }
}

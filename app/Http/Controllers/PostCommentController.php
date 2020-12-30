<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted as EventsCommentPosted;
use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;
// use App\Mail\CommentPosted;      // NB BEWARE of same Names but Different Functions !!!
use App\Events\CommentPosted;
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

        // $when = now()->addMinutes(1);

        // Mail::to($post->user)->later(                       // place into Queue and send after Delay (When) has been met
        //     $when,
        //     new CommentPostedMarkdown($comment)
        // );

        // Mail::to($post->user)->queue(                       // place into Queue and send after Delay (When) has been met
        //     new CommentPostedMarkdown($comment)
        // );

        event(new CommentPosted($comment));       // this Event is in conjunction with NotifyUsers listener

        //ALL BELOW MOVED TO NOTIFYUSERSABOUTCOMMENT LISTENER
        // set when running php artisan queue:work --tries=3 --timeout==15 -- queue=high,default,low
        // ThrottledMail::dispatch(new CommentPostedMarkdown($comment), $post->user)
        //     ->onQueue('high');      // set queue priority as High 

        // // set when running php artisan queue:work --tries=3 --timeout==15 -- queue=high,default,low
        // NotifyUsersPostWasCommented::dispatch($comment)
        //     ->onQueue('low');       // set queue priority as Low

        // $request->session()->flash('status', 'Comment added');
        // return redirect()->back();

        return redirect()->back()
            ->withStatus('Comment added');
    }
}

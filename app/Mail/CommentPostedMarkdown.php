<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


// class CommentPostedMarkdown extends Mailable implements ShouldQueue
class CommentPostedMarkdown extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;    // we need a public variable to pass data to the markdown  construct and subsequent build

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "A new Comment was posted on your Blog Post - {$this->comment->commentable->title}";
        return $this->subject($subject)->markdown('emails.posts.commented-markdown');
    }
}

<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

// default email "Subject" would be "Comment Posted" - derived by splitting the Class name, unless specified below
class CommentPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;

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
        $subject = "A new Comment was posted on your {$this->comment->commentable->title} blog post";
        return $this
            // First Example with full path
            // ->attach(
            //     storage_path('app/public') . '/' . $this->comment->user->image->path,
            //     [
            //         'as' => 'profile_picture.jpg',
            //         'mime' => 'image/jpg'
            //     ]
            //     )
            // ->attachFromStorage($this->comment->user->image->path, 'profile_picture.jpg')
            // ->attachFromStorageDisk('public', $this->comment->user->image->path, 'profile_picture.jpg')
            // ->attachData(Storage::get($this->comment->user->image->path), 'profile_picture_from_data.jpg', [
            //     'mime' => 'image/jpg'
            //     ])
            ->subject($subject)
            ->view('emails.posts.commented');
    }
}

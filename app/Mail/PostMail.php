<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostMail extends Mailable
{
    use Queueable, SerializesModels;

    public $post;

    public function __construct(Post $post){
        $this->post = $post;
    }
    /**
     * Create a new message instance.
     */
   public function build(){
       return $this->view('emails.post')
           ->subject($this->post->title)
           ->with([
               'title' => $this->post->title,
               'content' => $this->post->content
           ]);
   }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $content;

    public function __construct($title, $content ){
        $this->title = $title;
        $this->content = $content;
    }
    /**
     * Create a new message instance.
     */
   public function build(){
       return $this->view('emails.post')
           ->subject($this->title)
           ->with([
               'title' => $this->title,
               'content' => $this->content
           ]);
   }
}

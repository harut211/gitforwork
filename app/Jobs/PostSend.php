<?php

namespace App\Jobs;

use App\Mail\PostMail;
use App\Models\EmailLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class PostSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    // public $user;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->data as $item) {
            $post = $item['post'];
            $user = $item['user'];
            Mail::to($user->email)->queue(new PostMail($post));
            EmailLog::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
        }
    }
}

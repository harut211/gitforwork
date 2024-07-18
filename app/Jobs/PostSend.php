<?php

namespace App\Jobs;

use App\Mail\PostMail;
use App\Models\EmailLog;
use App\Models\Post;
use App\Models\User;
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
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Post::chunk(500, function ($posts) {
            foreach ($posts as $post) {
                $users = User::all();

                foreach ($users as $user) {
                    $exists = EmailLog::where('user_id', $user->id)
                        ->where('post_id', $post->id)
                        ->exists();

                    if (!$exists) {
                        Mail::to($user->email)->queue(new PostMail($post));

                        EmailLog::create([
                            'user_id' => $user->id,
                            'post_id' => $post->id,
                        ]);
                    }
                }
            }
        });
    }
}

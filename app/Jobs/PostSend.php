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
            Mail::to($item['user_email'])->queue(new PostMail($item['post_title'], $item['post_content']));
            EmailLog::create([
                'user_id' => $item['id'],
                'post_id' => $item['post_id'],
            ]);
        }
    }
}

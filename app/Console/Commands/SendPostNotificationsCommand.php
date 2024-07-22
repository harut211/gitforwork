<?php

namespace App\Console\Commands;

use App\Jobs\PostSend;
use App\Models\EmailLog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

class SendPostNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-post-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Post::chunk(1000, function ($posts) {
            $data = [];
            foreach ($posts as $post) {
                $users = User::all();

                foreach ($users as $user) {
                    $exists = EmailLog::where('user_id', $user->id)
                        ->where('post_id', $post->id)
                        ->exists();

                    if (!$exists) {
                        $data[] = ['post' => $post, 'user' => $user];

                        EmailLog::create([
                            'user_id' => $user->id,
                            'post_id' => $post->id,
                        ]);
                    }
                }
            }
            dispatch(new PostSend($data));
        });
    }
}

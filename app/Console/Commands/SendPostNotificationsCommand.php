<?php

namespace App\Console\Commands;

use App\Jobs\PostSend;
use App\Models\EmailLog;
use App\Models\Post;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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

          Subscribe::join('websites','websites.id','=','subscribes.webs_id')
            ->join('posts','websites.id','=','posts.web_id')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('email_logs')
                    ->whereColumn('email_logs.user_id','subscribes.user_id')
                    ->whereColumn('email_logs.post_id','posts.id');
            })->select('subscribes.user_id as subscriber_id','posts.id as post_id')->chunk(100, function ($subscribers) {
              $data = [];
                foreach ($subscribers as $subscriber) {
                    $user = User::find($subscriber->subscriber_id);
                    $post = Post::find($subscriber->post_id);
                    $data[] = ['post' => $post, 'user' => $user];
                }
                  dispatch(new PostSend($data));
            });


//        Post::whereDoesntHave('emailLogs')
//            ->with('websites')
//            ->chunk(1000, function ($posts) {
//                $data = [];
//                foreach ($posts as $post) {
//                    $users = User::all();
//
//                    foreach ($users as $user) {
//                        $exists = EmailLog::where('user_id', $user->id)
//                            ->where('post_id', $post->id)
//                            ->exists();
//
//                        if (!$exists) {
//                            $data[] = ['post' => $post, 'user' => $user];
//
//                        }
//                    }
//                }
//                dispatch(new PostSend($data));
//            });
    }
}

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
            ->join('users','users.id','=','subscribes.user_id')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('email_logs')
                    ->whereColumn('email_logs.user_id','subscribes.user_id')
                    ->whereColumn('email_logs.post_id','posts.id');
            })->select('users.*', 'users.id as user_id' ,'posts.*', 'posts.id as post_id' )->chunk(1000, function ($subscribers) {
                $data = [];
                foreach ($subscribers as $subscriber) {
                    $data[] = [
                        'id' => $subscriber->user_id,
                        'user_email' => $subscriber->email,
                        'post_title' => $subscriber->title,
                        'post_content' => $subscriber->content,
                        'post_id' => $subscriber->post_id,
                    ];
                }
                  dispatch(new PostSend($data));
            });

    }
}

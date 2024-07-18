<?php

namespace App\Console\Commands;

use App\Mail\PostMail;
use App\Models\EmailLog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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

     $postID = Post::all('id');

         foreach ($postID as $post) {
             $id = $post->id;

             if ($id) {
                 $users = User::all();
                 $post = Post::find($id);

                 foreach ($users as $user) {
                     $exsist = EmailLog::where('user_id',$user->id)->where('post_id',$id)->exists();

                     if (!$exsist) {
                         Mail::to($user->email)->queue(new PostMail($post));
                         EmailLog::create([
                             'user_id' => $user->id,
                             'post_id' => $id,
                         ]);
                     }
                 }

             } else {
                 echo "No post found";
             }
         }

    }
}

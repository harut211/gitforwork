<?php

namespace App\Console\Commands;

use App\Jobs\PostSend;
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
        Queue::push(new PostSend());
    }
}

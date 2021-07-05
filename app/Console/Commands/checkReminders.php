<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post;
use App\User;
use App\Jobs\ReminderEmailJob;
use App\Jehona\ReminderJehona;

class checkReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:checkreminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if should send a reminder for an event which come';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date_create(date('Y-m-d')); // or your date as well
        date_add($date, date_interval_create_from_date_string('2 days'));

        $strDate = date_format($date, 'Y-m-d');

        $events = Post::where('datetime', 'LIKE', "%$strDate%")->get();

        foreach($events as $event) {
            $reminderJehona = new ReminderJehona($event);
            $reminderJehona->dispatch();
            
            // $emailJob = (new ReminderEmailJob($event, [
            //     'bccEmails'=> $toNotify->pluck('email'), 
            //     'bccNames' => $toNotify->pluck('name')
            // ]))->delay(now());

            // dispatch($emailJob);
        }
    }
}

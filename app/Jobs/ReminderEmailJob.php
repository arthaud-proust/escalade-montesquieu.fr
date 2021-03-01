<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ReminderNotification;
use Illuminate\Support\Facades\Mail;

class ReminderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;
    public $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event, $details)
    {
        $this->details = $details;
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ReminderNotification($this->event);
        Mail::bcc($this->details['bccEmails'], $this->details['bccNames'])
            ->send($email);
    }
}

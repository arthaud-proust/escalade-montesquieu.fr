<?php

namespace App\Jehona;

use App\Jehona\BaseModel;
use Illuminate\Support\Facades\Http;
use App\Mail\ReminderNotification;

use App\User;

class ReminderJehona extends BaseModel {


    public function __construct($event)
    {
        $this->event = $event;
        $this->details = [
            'recipients' => User::mailableFor('reminder')->pluck('email')->toArray()
        ];
    }

    public function getNotification($event) {
        return new ReminderNotification($event);
    }
}
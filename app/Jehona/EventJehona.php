<?php

namespace App\Jehona;

use App\Jehona\BaseModel;
use Illuminate\Support\Facades\Http;
use App\Mail\EventNotification;

use App\User;

class EventJehona extends BaseModel {


    public function __construct($event)
    {
        $this->event = $event;
        $this->details = [
            'recipients' => User::mailableFor('event')->pluck('email')->toArray()
        ];
    }

    public function getNotification($event) {
        return new EventNotification($event);
    }
}
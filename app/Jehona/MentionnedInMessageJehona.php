<?php

namespace App\Jehona;

use App\Jehona\BaseModel;
use Illuminate\Support\Facades\Http;
use App\Mail\MentionnedInMessage;

use App\User;

class MentionnedInMessageJehona extends BaseModel {

    public function getNotification($event) {
        return new MentionnedInMessage($event, $this->details['toAll'] || false);
    }
}
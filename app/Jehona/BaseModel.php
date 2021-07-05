<?php

namespace App\Jehona;

use Illuminate\Support\Facades\Http;


class BaseModel {

    public function __construct($event, $details)
    {
        $this->event = $event;
        $this->details = $details;
    }

    public function getParams() {
        return [
            'host' => config('services.jehona.host'),
            'port' => config('services.jehona.port'),
            'auth' => [
                'user' => config('services.jehona.user'),
                'pass' => config('services.jehona.pass')
            ]
        ];
    }

    public function getMailCoords() {
        return [
            'from' => 'Escalade Montesquieu '.config('services.jehona.user'),
            'bcc' => $this->getRecipients(),
            'subject' => $this->getSubject(),
            'html' => $this->notif->render()
        ];
    }

    public function getBody() {
        return [
            'apiKey' => config('services.jehona.key'),
            'noStatus' => true,
            
            'params' => $this->getParams(),
        
            'mail' => $this->getMailCoords()
        ];
    }





    // Modifiable
    public function getRecipients() {
        return implode(', ', $this->details['recipients']);
    }

    // Modifiable
    public function getSubject() {
        return $this->notif->build()->subject;
    }

    // Modifiable
    public function getNotification($event) {
        return;
    }

    public function dispatch() {
        $this->notif = $this->getNotification($this->event);
        
        $response = Http::post('https://jehona.arthaud.dev', $this->getBody());
    }
}
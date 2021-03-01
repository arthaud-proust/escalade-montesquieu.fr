<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $now = time(); // or your date as well
        $your_date = strtotime($this->event->datetime);
        $datediff = $now - $your_date;

        $diff = -round($datediff / (60 * 60 * 24));
        $days = $diff.($diff==1?' jour':' jours');

        return $this->markdown('vendor.notifications.base')
                    ->subject('Nouvel évènement: '.$this->event->title)
                    ->with([
                        'level' => 'success',
                        'actionText' => 'Voir sur le site (conseillé)',
                        'actionUrl' => 'https://escalade-montesquieu.fr/evenements-et-sorties/'.$this->event->blog,
                        'displayableActionUrl' => 'https://escalade-montesquieu.fr/evenements-et-sorties/'.$this->event->blog,
                        'greeting'=> 'Nouvel évènement: '.$this->event->title,
                        'introLines' =>[
                            'Dans la catégorie '.$this->event->blog,
                            'L\'évènement a lieu '.($diff==0?"aujourd'hui":'dans '.$days).($this->event->location?' à ['.$this->event->location.'](https://www.google.fr/maps/search/'.str_replace(' ', '+', $this->event->location).')':'')
                        ],
                        'outroLines' =>[]
                    ]);
    }
}

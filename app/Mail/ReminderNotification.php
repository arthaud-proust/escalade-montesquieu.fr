<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderNotification extends Mailable
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
        return $this->markdown('vendor.notifications.mentionned')
                    ->subject('Rappel: '.$this->event->title)
                    ->with([
                        'level' => 'success',
                        'actionText' => 'Voir sur le site',
                        'actionUrl' => 'https://escalade-montesquieu.fr/evenements-et-sorties/'.$this->event->blog,
                        'displayableActionUrl' => 'https://escalade-montesquieu.fr/evenements-et-sorties/'.$this->event->blog,
                        'greeting'=> 'Vous participez à '.$this->event->title,
                        'introLines' =>[
                            'Dans la catégorie '.$this->event->blog,
                            'L\'évènement a lieu dans 2 jours'.($this->event->location?' à ['.$this->event->location.'](https://www.google.fr/maps/search/'.str_replace(' ', '+', $this->event->location).')':'.')
                        ],
                        'outroLines' =>[]
                    ]);
    }
}

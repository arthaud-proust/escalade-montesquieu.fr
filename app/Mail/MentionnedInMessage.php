<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MentionnedInMessage extends Mailable
{
    use Queueable, SerializesModels;


    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $toAll=false)
    {
        $this->message = $message;
        $this->toAll = $toAll;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.notifications.mentionned')
                    ->subject($this->toAll==true?'Annonce à lire sur le forum':($this->message->author.' vous a mentionné dans un message'))
                    ->with([
                        'level' => 'primary',
                        'actionText' => 'Voir le message',
                        'actionUrl' => 'https://escalade-montesquieu.fr/forum/'.$this->message->forum,
                        'displayableActionUrl' =>'https://escalade-montesquieu.fr/forum/'.$this->message->forum,
                        'introLines' =>[$this->message->author.($this->toAll==true?' a mentionné tout le monde dans le forum ':' vous a mentionné dans le forum ').$this->message->forum],
                        'outroLines' =>[]
                    ]);
    }
}

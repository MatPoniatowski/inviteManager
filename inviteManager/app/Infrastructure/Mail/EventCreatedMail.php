<?php

namespace App\Infrastructure\Mail;


use App\Domain\Event\Entities\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Event $event) {}

    public function build()
    {
        return $this->subject('Potwierdzenie utworzenia eventu')
            ->markdown('emails.event.created');
    }
}

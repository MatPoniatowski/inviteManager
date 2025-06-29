<?php

declare(strict_types=1);

namespace App\Application\Jobs;

use App\Domain\Event\Entities\Event;
use App\Infrastructure\Mail\EventCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEventCreatedMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected Event $event)
    {
    }

    public function handle()
    {
        Mail::to($this->event->user->email)
            ->send(new EventCreatedMail($this->event));
    }
}

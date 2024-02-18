<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->subject('Event Subscription')->view('emails.event-subscription', ['event' => $this->event]);
    }
}

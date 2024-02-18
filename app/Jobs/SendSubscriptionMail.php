<?php

namespace App\Jobs;

use App\Mail\EventSubscriptionMail;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event;
    protected $userId;

    public function __construct(Event $event, $userId)
    {
        $this->event = $event;
        $this->userId = $userId;
    }

    public function handle()
    {
        // Retrieve the user's email
        $userEmail = auth()->user()->email;

        // Send the subscription email
        Mail::to($userEmail)->send(new EventSubscriptionMail($this->event));
    }
}

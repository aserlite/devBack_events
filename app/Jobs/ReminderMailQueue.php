<?php

namespace App\Jobs;

use App\Mail\ReminderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $event;
    
    public function __construct($user, $event)
    {
        $this->user = $user;
        $this->event = $event;
    }

    
    public function handle(): void
    {
        // you have to create and send a mail to some user
        $mail = new ReminderMail($this->user, $this->event);
        Mail::to($this->user->email)->send($mail);
    }
}

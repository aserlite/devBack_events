<?php

namespace App\Http\Controllers;

use App\Jobs\ReminderMailQueue;
use App\Jobs\SendSubscriptionMail;
use App\Models\Event;
use App\Models\Participants;
use Carbon\Carbon;
use App\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipateController extends Controller
{
    public function __invoke(Request $request, Event $event)
    {
        if ($event->participate->contains(Auth::id())) {
            $deleted = Participants::where('user_id', Auth::id())->where('event_id', $event->id)->delete();
        } else {
            $participate = Participants::firstOrCreate(['user_id' => Auth::id(), 'event_id' => $event->id]);

            SendSubscriptionMail::dispatch($event, Auth::id())->onQueue('emails');
            $startDate = Carbon::parse($event->start_date);
            $twoDaysBefore = $startDate->subDays(2);
            ReminderMailQueue::dispatch($event, Auth::id())->delay($twoDaysBefore)->onQueue('emails');
        }

        return redirect('/events/' . $event->id);
    }
}

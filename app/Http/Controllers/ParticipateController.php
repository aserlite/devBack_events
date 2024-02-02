<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participants;
use Illuminate\Http\Request;

class ParticipateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Event $event)
    {
        if ($event->participate->contains(auth()->id())){
            $deleted = Participants::where('user_id', auth()->id())->where('event_id',$event->id)->delete();
        }else{
            $participate = Participants::firstOrCreate(['user_id'=>auth()->id(),'event_id'=>$event->id]);
        }
        return redirect('/events/'.$event->id);
    }
}

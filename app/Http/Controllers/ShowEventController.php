<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ShowEventController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Event $event)
    {
        return Inertia::render('Events/Show', [
            'storage_path' => Storage::disk('public')->url(''),
            'event' => $event,
            'participating' => $event->participate->contains(auth()->id()),
            'nb_participants' => $event->participate->count(),
            'previousUrl' =>  url()->previous(),
            'categories' =>  $event->categories,
        ]) ;
    }
}

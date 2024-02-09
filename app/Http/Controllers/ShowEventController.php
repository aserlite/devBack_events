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
        $sameLocation = Event::where('location', $event->location)->where('id','!=',$event->id)->take(5)->get();
        $sameCategory = Event::whereHas('categories', function ($query) use ($event) {
            $query->whereIn('categories.id', $event->categories->pluck('id'));
        })
            ->where('id', '!=', $event->id)
            ->take(5)
            ->get();
        return Inertia::render('Events/Show', [
            'storage_path' => Storage::disk('public')->url(''),
            'event' => $event,
            'participating' => $event->participate->contains(auth()->id()),
            'nb_participants' => $event->participate->count(),
            'previousUrl' =>  url()->previous(),
            'categories' =>  $event->categories,
            'comments' => $event->comment,
            'outdated' => now()->greaterThan($event->end_date),
            'sameLocation' => $sameLocation,
            'sameCategory' => $sameCategory,
        ]) ;
    }
}

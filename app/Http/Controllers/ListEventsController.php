<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ListEventsController extends Controller
{
    public function __invoke(Request $request)
    {
        $events = Event::all();
        return Inertia::render('Events/Index', [
            'storage_path' => Storage::disk('public')->url(''),
            'events' => $events,
        ]) ;
    }
}

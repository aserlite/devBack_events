<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Event;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, int $eventId)
    {
        $request->validate([
            'title' => 'required|string',
            'grade' => 'required|numeric|min:0|max:5',
            'content' => 'required|string',
        ]);

        $comment = new Avis([
            'title' => $request->input('title'),
            'grade' => $request->input('grade'),
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'event_id' => $eventId,
        ]);

        $comment->save();

        return redirect()->back()->with('success', 'Comment submitted successfully.');
    }
}

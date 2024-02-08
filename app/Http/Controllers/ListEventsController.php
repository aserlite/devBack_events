<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ListEventsController extends Controller
{
    public function __invoke(Request $request)
    {
        $location = $request->input('location');
        $category = $request->input('category');
        $orderBy = $request->input('order_by', 'default');
        $startDate = $request->input('start_date');
        $maxPrice = $request->input('max_price');

        $eventsQuery = Event::query();

        if ($location) {
            $eventsQuery->where('location', 'like', "%$location%");
        }

        if ($category) {
            $eventsQuery->whereHas('categories', function ($query) use ($category) {
                $query->where('categories.name','like', "%$category%");
            });
        }

        if ($startDate) {
            $eventsQuery->whereDate('start_date', '>=', $startDate);
        }

        if ($maxPrice) {
            $eventsQuery->where('price', '<=',$maxPrice*100);
        }

        switch ($orderBy) {
            case 'price_asc':
                $eventsQuery->orderBy('price');
                break;
            case 'price_desc':
                $eventsQuery->orderByDesc('price');
                break;
            case 'location':
                $eventsQuery->orderBy('location');
                break;
            case 'start_date_asc':
                $eventsQuery->orderBy('start_date');
                break;
            case 'start_date_desc':
                $eventsQuery->orderByDesc('start_date');
                break;
            default:
        }

        $events = $eventsQuery->paginate(12);

        return Inertia::render('Events/Index', [
            'storage_path' => Storage::disk('public')->url(''),
            'events' => $events,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $upcomingEvents = Event::upcoming()->get();
        $popularCategories = Category::popular()->get();

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'upcomingEvents' => $upcomingEvents,
            'popularCategories' => $popularCategories,
        ]);
    }
}

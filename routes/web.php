<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Event;
use App\Http\Controllers\WelcomeController;

Route::get('/', WelcomeController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/events', \App\Http\Controllers\ListEventsController::class)->name('events');
    Route::get('/events/{event}', \App\Http\Controllers\ShowEventController::class)->name('events.show');
});


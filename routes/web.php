<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Event;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', WelcomeController::class)->name('home');
Route::get('/events', \App\Http\Controllers\ListEventsController::class)->name('events');
Route::get('/events/{event}', \App\Http\Controllers\ShowEventController::class)->name('events.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/events/{event}/participate', \App\Http\Controllers\ParticipateController::class);
    Route::post('/events/{eventId}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

});


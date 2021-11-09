<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Route::get('/n', function () {
    $notes = Auth::user()
        ->notes()
        ->whereNotNull('for_date')
        ->orderByDesc('for_date')
        ->get();

    return Inertia::render('Home', [
        'notes' => $notes,
        'last_daily_note_at' => $notes->first()->for_date ?? null
    ]);
})->middleware('auth')->name('notes.index');

Route::post('/n', [NoteController::class, 'store'])
    ->middleware(['auth'])
    ->name('notes.store');

Route::put('/n/{note}', [NoteController::class, 'update'])
    ->middleware(['auth'])
    ->name('notes.update');

require __DIR__.'/auth.php';

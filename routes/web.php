<?php

use App\Http\Controllers\DailyNoteController;
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

Route::get('/spa', function () {
    return Inertia::render('home/index', [
        'notes' => Auth::user()
            ->notes()
            ->whereNotNull('for_date')
            ->orderByDesc('for_date')
            ->get()
    ]);
})->middleware('auth');

Route::get('/n', [NoteController::class, 'index'])
    ->middleware(['auth'])
    ->name('notes.index');

Route::put('/n/{note}', [NoteController::class, 'update'])
    ->middleware(['auth'])
    ->name('notes.update');

Route::post('/notes/daily/create', [DailyNoteController::class, 'store'])
    ->middleware(['auth'])
    ->name('notes.daily.store');

require __DIR__.'/auth.php';

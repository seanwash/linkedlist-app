<?php

use App\Http\Controllers\DailyNoteController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/n', [NoteController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::post('/notes/daily/create', [DailyNoteController::class, 'store'])
    ->middleware(['auth'])
    ->name('notes.daily.store');

require __DIR__.'/auth.php';

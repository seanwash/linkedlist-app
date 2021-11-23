<?php

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
    ->name('notes.index')
    ->middleware('auth');

Route::get('/n/{note:uuid}', [NoteController::class, 'show'])
    ->name('notes.show')
    ->middleware('auth');

Route::post('/n', [NoteController::class, 'store'])
    ->name('notes.store')
    ->middleware('auth');

Route::put('/n/{note:uuid}', [NoteController::class, 'update'])
    ->name('notes.update')
    ->middleware('auth');

Route::delete('/n/{note:uuid}', [NoteController::class, 'delete'])
    ->name('notes.delete')
    ->middleware('auth');

require __DIR__.'/auth.php';

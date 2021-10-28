<?php

use App\Http\Controllers\NotesController;
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
});

Route::get('/dashboard', function () {
    $notes = Auth::user()->notes()->latest()->get();
    return view('dashboard', ['notes' => $notes]);
})->middleware(['auth'])->name('dashboard');

Route::put('/notes/{note:uuid}', [NotesController::class, 'update'])->middleware(['auth'])->name('notes.update');

require __DIR__.'/auth.php';

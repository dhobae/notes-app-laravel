<?php

use App\Http\Controllers\Auth\SocialLiteController;
use App\Http\Controllers\NotesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\Notes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->middleware('guest');

Route::get('/notes', [NotesController::class, 'index'])->middleware(['auth', 'verified'])->name('index');
Route::get('/note/add', [NotesController::class, 'create'])->middleware(['auth', 'verified'])->name('create-note');
Route::post('/note/add', [NotesController::class, 'store'])->middleware(['auth', 'verified'])->name('store-note');
Route::put('/notes', [NotesController::class, 'update'])->middleware(['auth', 'verified'])->name('update-note');

Route::delete('/note/delete', [NotesController::class, 'destroy'])->middleware(['auth', 'verified'])->name('destroy-note');


Route::middleware('auth',)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/auth/redirect', [SocialLiteController::class, 'redirect']);

Route::get('/auth/google/callback', [SocialLiteController::class, 'callback']);

// Route::get

Route::get('/test', [TestController::class, 'test']);
Route::post('/test', [TestController::class, 'add'])->name('add-note');

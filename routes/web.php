<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SoundController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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
    if (Auth::check()) {
        return Redirect::route('discover');
    } else {
        return Redirect::route('welcome');
    }
})->name('home');

//Route::inertia('/discover', 'Discover')->name('discover');
Route::get('/discover', [SoundController::class, 'index'])->name('discover');
Route::inertia('/welcome', 'Welcome')->name('welcome');

Route::group(['prefix' => 'sound', 'as' => 'sound.'], function () {
    Route::get('/create', [SoundController::class, 'create'])->name('create');
    Route::post('/', [SoundController::class, 'store'])->name('store');
    Route::get('/download/{id}', [SoundController::class, 'download'])->name('download');
});


require __DIR__ . '/auth.php';

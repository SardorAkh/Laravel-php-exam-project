<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SoundController;
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

Route::get('/discover', [SoundController::class, 'index'])->name('discover');
Route::inertia('/welcome', 'Welcome')->name('welcome');

Route::group(['prefix' => 'sound', 'as' => 'sound.'], function () {
    Route::group(['middleware'=> 'auth'], function() {
        Route::get('/create', [SoundController::class, 'create'])->name('create');
        Route::post('/', [SoundController::class, 'store'])->name('store');
    });
    Route::get('/download/{id}', [SoundController::class, 'download'])->name('download');

    Route::get('/categories/{category_id}', [CategoryController::class, 'show'])->name('category.show');

});


require __DIR__ . '/auth.php';

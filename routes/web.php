<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::group(['middleware' => 'is_user_block'], function() {
    Route::get('/', function () {
        if (Auth::check()) {
            return Redirect::route('discover');
        } else {
            return Redirect::route('welcome');
        }
    })->name('home');

    Route::get('/admin_panel', [AdminPanelController::class, 'index'])
        ->middleware('admin')
        ->name('admin_panel');

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

    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->middleware('guest')
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->middleware('guest')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('guest');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
     ->middleware('auth')
     ->name('logout');

Route::inertia('/blocked_page','BlockedPage')->name('blocked_page');

<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SoundController;
use Illuminate\Http\Request;
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


    Route::group(['prefix' => 'admin_panel', 'as' => 'admin_panel.', 'middleware' => 'admin'],function() {

        Route::get('/', [AdminPanelController::class, 'index'])->name('index');

        Route::group(['prefix' => 'users','as' => 'users.'], function() {
            Route::get('/',[AdminPanelController::class, 'user_index'])->name('index');
            Route::post('/',[AdminPanelController::class, 'user_store'])->name('store');
            Route::delete('/destroy/{id}',[AdminPanelController::class, 'user_destroy'])->name('destroy');
            Route::get('/block',[AdminPanelController::class, 'user_block'])->name('block');
            Route::get('/unblock',[AdminPanelController::class, 'user_unblock'])->name('unblock');
        });

        Route::group(['prefix' => 'sounds', 'as' => 'sounds.'], function() {
            Route::get('/', [AdminPanelController::class, 'sound_index'])->name('index');
            Route::put('/update/{id}', [AdminPanelController::class, 'sound_update'])->name('update');
            Route::get('/disapproved', [AdminPanelController::class, 'sound_disApproved'])->name('disApproved');
            Route::post('/approve/{id}', [AdminPanelController::class, 'sound_approve'])->name('approve');
        });
    });
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
     ->middleware('auth')
     ->name('logout');

Route::inertia('/blocked_page','BlockedPage')->name('blocked_page');

Route::get('/search', function(Request $request) {
    dd($request);
    return response()->json();
})->name('search');

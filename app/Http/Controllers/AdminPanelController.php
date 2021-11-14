<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sound;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminPanelController extends Controller
{
    public function index() {
        return Inertia::render('AdminPanel',[
            'users' =>  Inertia::lazy(fn () => User::all()),
            'sounds' =>  Inertia::lazy(fn () => Sound::all()),
            'categories' =>  Inertia::lazy(fn () => Category::all()),
        ]);
    }

}

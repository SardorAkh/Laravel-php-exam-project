<?php

namespace App\Http\Controllers;

use App\Models\Sound;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SoundController extends Controller
{
    public function index() {

        $sound = Sound::find(1)->getMedia();

        return Inertia::render('Discover', [
            'sounds' => $sound[0]->getUrl()
        ]);
    }

    public function create() {
        return Inertia::render('AddSound');
    }

    public function store(Request $request) {
        $sound = Sound::create([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id')
        ]);

        $sound
            ->addMedia($request->file('sound'))
            ->toMediaCollection();

        dd($sound->getMedia());
    }
}

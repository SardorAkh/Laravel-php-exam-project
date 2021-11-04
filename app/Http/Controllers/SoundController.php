<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoundResource;
use App\Models\Sound;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SoundController extends Controller
{
    public function index() {

        $collection = SoundResource::collection(Sound::with('User')->get());

        return Inertia::render('Discover', [
            'sounds' => $collection
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

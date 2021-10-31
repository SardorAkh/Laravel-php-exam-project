<?php

namespace App\Http\Controllers;

use App\Models\Sound;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SoundController extends Controller
{
    public function index() {

        $sounds = Sound::all();

        $mediaCollection = [];


        $mediaUrls = [];

        foreach($sounds as $sound) {
            $mediaCollection[] = $sound->getMedia();
        }
        for($i = 0; $i < count($mediaCollection); $i++) {
            for($k = 0; $k < count($mediaCollection[$i]); $k++) {
                $mediaUrls[] = ['id' => $i + $k, 'url' => $mediaCollection[$i][$k]->getUrl()];
            }
        }
        return Inertia::render('Discover', [
            'sounds' => $mediaUrls
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

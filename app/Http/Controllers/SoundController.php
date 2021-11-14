<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoundResource;
use App\Models\Category;
use App\Models\Sound;
use App\Models\SoundsCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SoundController extends Controller
{
    public function index(Request $request) {

        $collection = SoundResource::collection(
            Sound::with('User')
                ->orderBy('created_at','desc')
                ->get()
        );
        return Inertia::render('Discover', [
            'title' => 'Latest',
            'sounds' => $collection,
            'categories' => Category::all(),

        ]);
    }

    public function create() {

        return Inertia::render('AddSound',[
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'sound' => 'required|file|mimetypes:audio/mpeg,audio/ogg,audio/mp4',
        ]);
        $sound = Sound::create([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id')
        ]);
        // creating category for multiple instances
        SoundsCategories::create([
            'sound_id' => $sound->id,
            'category_id' => $request->input('category')
        ]);
        // Add to media folder (public/media)
        $sound
            ->addMedia($request->file('sound'))
            ->toMediaCollection('sound');

        return Redirect::route('discover');
    }


    public function download(Request $request) {
        return Sound::find($request->id)->getMedia('sound')[0];
    }

}

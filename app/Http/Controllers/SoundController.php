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
    public function index() {

        $collection = SoundResource::collection(
            Sound::with('User')
                ->orderBy('created_at','desc')
                ->get()
        );
        return Inertia::render('Discover', [
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
        $sound = Sound::create([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id')
        ]);

        SoundsCategories::create([
            'sound_id' => $sound->id,
            'category_id' => $request->input('category')
        ]);

        $sound
            ->addMedia($request->file('sound'))
            ->toMediaCollection('sound');

        return Redirect::route('discover');
    }

    public function download(Request $request) {
        return Sound::find($request->id)->getMedia('sound')[0];
    }

}

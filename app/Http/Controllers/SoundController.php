<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoundResource;
use App\Models\Category;
use App\Models\Sound;
use App\Models\SoundsCategories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SoundController extends Controller
{
    public function index(Request $request) {

        $collection = SoundResource::collection(
            Sound::with('User')
                ->orderBy('created_at','desc')
                ->where('is_approved',true)
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
            'description' => $request->input('description'),
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
            ->usingName(User::find($request->input('user_id'))->username . " - " . $request->input('title'))
            ->usingFileName(User::find($request->input('user_id'))->username .
                "-" .
                $request->input('title') .
                "." .
                $request->file('sound')->getClientOriginalExtension())
            ->toMediaCollection('sound');

        return Redirect::route('discover');
    }
    public function download(Request $request) {
        return Sound::find($request->id)->getFirstMedia('sound');
    }

}

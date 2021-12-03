<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoundResource;
use App\Models\Category;
use App\Models\Sound;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function destroy(Request $request) {
        Category::destroy($request->id);
        return back();
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);
        Category::create([
            'name' => $request->name
            ]
        );
        return back();
    }

    public function show(Request $request) {
        // Querying sounds by category
        $category = Category::where('id',$request->category_id)->first();
        $soundsByCategory = $category->sounds;
        $soundsids = [];

        foreach ($soundsByCategory as $sound) {
            $soundsids[] = $sound->id;
        }


        $collection = SoundResource::collection(
            Sound::with(['User','Categories'])
                ->whereIn('id',$soundsids)
                ->get()
        );
        $categories = Category::all();

        return Inertia::render('Discover', [
            'title' => $category->name,
            'sounds' => $collection,
            'categories' => $categories
        ]);
    }

}

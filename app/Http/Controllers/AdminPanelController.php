<?php

namespace App\Http\Controllers;

use App\Http\Resources\SoundResource;
use App\Models\Category;
use App\Models\Sound;
use App\Models\SoundsCategories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;


class AdminPanelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('show'))
            dd($request);

        return Inertia::render('AdminPanel', [
            'sounds' => Inertia::lazy(fn() => Sound::paginate(10)),
            'categories' => Inertia::lazy(fn() => Category::all()),
        ]);
    }

    //User controllers

    public function user_index()
    {
        return Inertia::render('AdminPanel', [
            'users' => User::paginate(10)
        ]);
    }

    public function user_store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|alpha_dash|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
        ]);
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return back();
    }

    public function user_destroy(Request $request)
    {
        User::destroy($request->id);
        return back();
    }

    public function user_block(Request $request)
    {
        $user = User::find($request->query('id'));
        $user->is_block = true;
        $user->save();
        return back();
    }

    public function user_unblock(Request $request)
    {
        $user = User::find($request->query('id'));
        $user->is_block = false;
        $user->save();
        return back();
    }

    // Sound Controllers

    public function sound_index()
    {
        return Inertia::render('AdminPanel', [
            'sounds' => Sound::with(['Categories', 'User'])->paginate(10),
            'categories' => Category::all()
        ]);
    }

    public function sound_update(Request $request)
    {
        $sound = SoundsCategories::find($request->id);
        $sound->category_id = $request->input('category_id');
        $sound->save();
        return back();
    }

    public function sound_disApproved()
    {
        return Inertia::render('AdminPanel', [
            'disApprovedSounds' => SoundResource::collection(
                Sound::with('User')
                    ->where('is_approved', '0')
                    ->orderBy('created_at', 'desc')
                    ->get())
        ]);
    }
    public function sound_approve(Request $request)
    {
        $sound = Sound::find($request->id);
        $sound->is_approved = true;
        $sound->save();
        return back();
    }

}

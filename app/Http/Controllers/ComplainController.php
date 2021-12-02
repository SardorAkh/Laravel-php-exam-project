<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;

class ComplainController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required',
            'description' => 'required',
        ]);

        Complain::create([
            'theme' => $request->input('theme'),
            'description' => $request->input('description'),
            'sound_id' => $request->input('sound_id'),
        ]);
    }
}

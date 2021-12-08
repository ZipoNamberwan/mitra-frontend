<?php

namespace App\Http\Controllers;

use App\Models\Mitras;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class ViewController extends Controller

{
    public function show()
    {
        $mitra = Mitras::where('email', Auth::user()->email)->first();
        return view('view', compact('mitra'));
    }

}

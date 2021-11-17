<?php

namespace App\Http\Controllers;

use App\Models\Mitras;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function register(Request $request)
    {
        //register logic here

    }

    public function show($id)
    {
        //mysurvei logic here
        $mitra = Mitras::where('email', $id)->first();
        return view('survey.mysurvey', compact('mitra'));
    }
}

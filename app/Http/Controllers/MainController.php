<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function register(Request $request)
    {
        //register logic here

    }

    public function index()
    {
        //mysurvei logic here
        return view('survey.mysurvey');
    }
}

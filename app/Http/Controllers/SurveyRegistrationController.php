<?php

namespace App\Http\Controllers;

use App\Models\Surveys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SurveyRegistrationController extends Controller
{
    public function registerNotAuthenticated(Request $request)
    {
        $key = 'hQQ3cyzRp3obvAnUa29woJ6MchjHawPg'; // 32 chars
        $iv = '8tgsqR86OSSUBC5t'; // 16 chars
        $method = 'aes-256-cbc';

        $survey = Surveys::find(openssl_decrypt(Str::replace('*', '/', $request->survey), $method, $key, 0, $iv));

        if ($survey == null) {
            return abort(404);
        } else {
            $request->session()->forget('survey-mitra-register');
            $request->session()->put('survey-mitra-register', $survey);
            if (Auth::user() == null) {
                return view('survey.survey-register', ['survey' => $survey]);
            } else {
                return redirect('/survey-register/auth/' . $survey->id);
            }
        }
    }

    public function registerAuthenticated(Request $request)
    {
        $survey = Surveys::find($request->survey);
        return view('survey.survey-register-auth', ['survey' => $survey]);
    }

    public function register()
    {
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Educations;
use App\Models\Mitras;
use App\Models\PhoneNumbers;
use App\Models\Subdistricts;
use App\Models\Surveys;
use App\Models\User;
use App\Models\Villages;
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
        $mitra = Mitras::find(Auth::user()->email);
        return view('survey.survey-register-auth', compact('mitra'), [
            'survey' => $survey, 'educations' => Educations::all(),
            'subdistricts' => Subdistricts::all()
        ]);
    }

    public function getVillage($id)
    {
        return json_encode(Villages::where('subdistrict', $id)->get());


        // Mitras::find(Auth::user()->email);
    }

    public function register()
    {
    }

    public function registerSurvey(Request $request, $survey)
    {
        $request->validate([
            'name' => 'required',
            'sex' => 'required',
            'education' => 'required',
            'birthdate' => 'required',
            'profession' => 'required',
            'address' => 'required',
            'village' => 'required',
            'subdistrict' => 'required'
        ]);

        $path = '';
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $path = $image->store('images', 'public');
        }

        $mitra = Mitras::find(Auth::user()->email);
        $data = ([
            'name' => $request->name,
            'nickname' => $request->nickname,
            'sex' => $request->sex,
            'photo' => $path == '' ? $mitra->photo : $path,
            'education' => $request->education,
            'birthdate' => $request->birthdate,
            'profession' => $request->profession,
            'address' => $request->address,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict
        ]);
        $mitra->update($data);

        PhoneNumbers::create([
            'phone' => $request->phone,
            'is_main' => true,
            'mitra_id' => $mitra->email
        ]);

        $mitra = Mitras::find(Auth::user()->email);
        $pivotarray = [];
        $data =  $request->id;
            $pivotarray[$data] = ['phone_survey' => $request->phone, 'status_id' => 1, 'survey_id' => $request->survey];
        $mitra->surveys()->syncWithoutDetaching($pivotarray);

        $user = User::where('email', Auth::user()->email)->first();
        if ($user == null) {
            $user = User::create([
                'name' => $request->name,
                'password' => '',
                'avatar' => $mitra->photo
            ]);
        } else {
            $data = ([
                'name' => $request->name,
                'avatar' => $mitra->photo,
            ]);
            $user->update($data);
        }
        return redirect('/survey/success');
    }

    public function registerSurveySuccess(Request $request)
    {
        return view('survey.survey-register-success');
       
    }
}

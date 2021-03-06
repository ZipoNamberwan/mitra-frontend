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
            $request->session()->put('survey-mitra-register', $request->survey);
            if (Auth::user() == null) {
                return view('survey.survey-register', ['survey' => $survey]);
            } else {
                return redirect('/survey-register/auth/' . $request->survey);
            }
        }
    }

    public function registerAuthenticated(Request $request)
    {
        $key = 'hQQ3cyzRp3obvAnUa29woJ6MchjHawPg'; // 32 chars
        $iv = '8tgsqR86OSSUBC5t'; // 16 chars
        $method = 'aes-256-cbc';

        $survey = Surveys::find(openssl_decrypt(Str::replace('*', '/', $request->survey), $method, $key, 0, $iv));

        if ($survey == null) {
            abort(404);
        } else {
            $mitra = Mitras::find(Auth::user()->email);
            if ($mitra->surveys()->where('surveys.id', $survey->id)->exists()) {
                return view('survey.survey-register-success', ['survey' => $survey]);
            } else {
                return view('survey.survey-register-auth', compact('mitra'), [
                    'survey' => $survey, 'educations' => Educations::all(),
                    'subdistricts' => Subdistricts::all()
                ]);
            }
        }
    }

    public function getVillage($id)
    {
        return json_encode(Villages::where('subdistrict', $id)->get());
    }

    public function registerSurvey(Request $request, $survey)
    {
        $mitra = Mitras::where('email', Auth::user()->email)->first();
        $survey = Surveys::find($survey);
        if ($mitra->surveys()->where('surveys.id', $request->survey)->exists()) {
            return view('survey.survey-register-success', ['survey' => $survey]);
        } else {

            $request->validate([
                'name' => 'required',
                'sex' => 'required',
                'education' => 'required',
                'birthdate' => 'required',
                'profession' => 'required',
                'address' => 'required',
                'village' => 'required',
                'subdistrict' => 'required',
                'phoneregistered' => 'required'
            ]);

            $path = '';
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $path = $image->store('images', 'public');
            }

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

            $user = User::where('email', Auth::user()->email)->first();
            $data = ([
                'name' => $request->name,
                'avatar' => $mitra->photo,
            ]);
            $user->update($data);

            if ($mitra->phonenumbers->where('phone', $request->phoneregistered)->first() == null) {
                PhoneNumbers::create([
                    'phone' => $request->phoneregistered,
                    'is_main' => true,
                    'mitra_id' => Auth::user()->email
                ]);
            }

            $mitra->surveys()->attach($survey, ['status_id' => 1, 'phone_survey' => $request->phoneregistered]);

            return view('survey.survey-register-success', ['survey' => $survey]);
        }
    }

    public function registerSurveySuccess()
    {
        return view('survey.survey-register-success');
    }
}

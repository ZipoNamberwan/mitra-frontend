<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Educations;
use App\Models\Mitras;
use App\Models\PhoneNumbers;
use App\Models\Subdistricts;
use App\Models\User;
use App\Models\Villages;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $user_google    = Socialite::driver('google')->user();
        $user           = User::where('email', $user_google->getEmail())->first();

        if ($user != null) {
            Auth::login($user, true);
            if (session()->has('survey-mitra-register')) {
                $survey = session()->get('survey-mitra-register');
                session()->forget('survey-mitra-register');
                return redirect('/survey-register/auth/' . $survey->id);
            } else {
                return redirect('/home');
            }
        } else {
            $key = 'hQQ3cyzRp3obvAnUa29woJ6MchjHawPg'; // 32 chars
            $iv = '8tgsqR86OSSUBC5t'; // 16 chars
            $method = 'aes-256-cbc';

            return redirect('/mitra-register/' .
                Str::replace('/', '*', openssl_encrypt($user_google->email, $method, $key, 0, $iv))
                . '/' .
                Str::replace('/', '*', openssl_encrypt($user_google->name, $method, $key, 0, $iv)));
        }
    }

    public function showRegistrationForm(Request $request)
    {
        $email = $request->email;
        $name = $request->name;

        $key = 'hQQ3cyzRp3obvAnUa29woJ6MchjHawPg'; // 32 chars
        $iv = '8tgsqR86OSSUBC5t'; // 16 chars
        $method = 'aes-256-cbc';

        return view('survey.mitra-register', [
            'email' => openssl_decrypt(Str::replace('*', '/', $email), $method, $key, 0, $iv),
            'name' => openssl_decrypt(Str::replace('*', '/', $name), $method, $key, 0, $iv),
            'educations' => Educations::all(),
            'subdistricts' => Subdistricts::all()
        ]);
    }

    public function getVillage($id)
    {
        return json_encode(Villages::where('subdistrict', $id)->get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:mitras,email|unique:users,email',
            'phone' => 'required',
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
        $mitracounter = DB::table('counter')->where('id', 'mitras_counter')->first()->value + 1;
        DB::table('counter')->where('id', 'mitras_counter')
            ->update(['value' => $mitracounter]);
        $mitra = Mitras::create([
            'email' => $request->email,
            'code' => sprintf("%05s", $mitracounter),
            'name' => $request->name,
            'nickname' => $request->nickname,
            'sex' => $request->sex,
            'photo' => $path,
            'education' => $request->education,
            'birthdate' => $request->birthdate,
            'profession' => $request->profession,
            'address' => $request->address,
            'village' => $request->village,
            'subdistrict' => $request->subdistrict
        ]);

        PhoneNumbers::create([
            'phone' => $request->phone,
            'is_main' => true,
            'mitra_id' => $mitra->email
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => '',
                'avatar' => $mitra->photo
            ]);
        }
        Auth::login($user, true);

        if (session()->has('survey-mitra-register')) {
            $survey = session()->get('survey-mitra-register');
            session()->forget('survey-mitra-register');
            return redirect('/survey-register/auth/' . $survey->id);
        } else {
            return redirect('/home');
        }
    }
}

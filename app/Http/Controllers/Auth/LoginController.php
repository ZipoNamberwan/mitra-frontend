<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
            return redirect('/home');
        } else {
            return redirect('/reg/' . $user_google->email . '/' . $user_google->name);
        }
    }
    public function register(Request $request)
    {
        
    }
}

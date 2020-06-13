<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\UserDetails;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


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

    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
            $create = User::firstOrCreate([
                'email' => $user->getEmail()
            ], [
                'provider_name' => $driver,
                'provider_id' => $user->getId(),
                'name' => $user->getName(),
                'role_id' => 1,
                'email_verified_at' => now()
            ]);
            $details =  UserDetails::firstOrCreate(
                [
                    'user_id' => $create->id
                ],
                ['photo' => $user->getAvatar()]
            );
            if (is_null($details->photo)) {
                $details->photo = $user->getAvatar();
                $details->save();
            }
            auth()->login($create, true);
            return redirect($this->redirectPath());
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('login');
        }
    }
}

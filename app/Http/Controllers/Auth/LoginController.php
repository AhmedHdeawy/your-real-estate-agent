<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Socialite;
use App\Http\Controllers\Controller;
use Image;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        // First, try get user details from provider
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        // the, try to fetch user from DB
        $existingUser = User::where('provider_name', $provider)
                                ->where('provider_id', $user->getId())->first();


        // If User Exist, then make User Authenticated
        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {

            $existInOtherProvider = User::where('email', $user->getEmail())->first();

            if($existInOtherProvider) {
                return redirect($this->redirectPath());
            }

            // Else, Create New User
            $newUser                    = new User;
            $newUser->provider_name     = $provider;
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->username          = $this->generateUsername();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->save();

            // Auth the User
            auth()->login($newUser, true);
        }

        return redirect($this->redirectPath());
    }


    /**
     * Generate Unique Username
     */
    private function generateUsername()
    {
        $username = random_int(100000, 100000000);

        // Check this username is Exist
        $check = User::where('username', $username)->first();

        if ($check) {
            $this->generateUsername();
        }

        return $username;
    }
}

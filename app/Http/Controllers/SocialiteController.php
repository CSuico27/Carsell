<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /** 
     * Function: googleLogin
     * Description: This function will redirect to google
     */
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    /** 
     * Function: googleLogin
     * Description: This function will redirect to google
     */
    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /** 
     * Function: googleAuthentication
     * Description: This function will authenticate the user through the Google Account
     */
    public function googleAuthentication()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                $userData = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make('Password@1234'),
                    'google_id' => $googleUser->id
                ]);

                if ($userData) {
                    Auth::login($userData);
                    return redirect()->route('dashboard');
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    /** 
     * Function: googleAuthentication
     * Description: This function will authenticate the user through the Google Account
     */
    public function facebookAuthentication()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $user = User::where('facebook_id', $facebookUser->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                $userData = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make('Password@1234'),
                    'facebook_id' => $facebookUser->id
                ]);

                if ($userData) {
                    Auth::login($userData);
                    return redirect()->route('dashboard');
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}

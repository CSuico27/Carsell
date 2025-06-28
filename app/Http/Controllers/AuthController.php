<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\PngEncoder;
use Laravolt\Avatar\Facade as Avatar; 

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['regex:/^[A-Za-z\s]+$/','max:255', 'required'],
            'email'=> ['email', 'required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', 'unique:users'],
            'phone' => ['required', 'regex:/^09\d{9}$/', 'unique:users'],
            'password'=> ['required','confirmed','min:6']
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);

        $avatarImage = Avatar::create($user->name)->getImageObject()->encode(new PngEncoder());
        $avatarPath = 'profiles/' . $user->id . '.png';

        Storage::disk('public')->put( $avatarPath, $avatarImage);
        $user->profile_pic = $user->id . '.png';
        $user->save();
        
        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=> ['email', 'required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password'=> ['required']
        ]);

        if(Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ], $request->has('remember'))){
            return redirect()->intended();
        }else{
            return back()->withErrors(['error'=> 'The provided credentials does not match our record']);
        }
    }

    //Email Verification Notice
    public function verifyNotice(){
        return view('auth.verify-email');
    }

    //Email Verification Handler
    public function verifyEmail(EmailVerificationRequest $request){
        $request->fulfill();

        return redirect()->route('dashboard');
    }

    //Resending the Verification Email
    public function verifyNotif(Request $request){
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}

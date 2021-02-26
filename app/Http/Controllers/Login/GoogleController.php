<?php

namespace App\Http\Controllers\Login;

use Auth;
use Socialite;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToGoogle()

    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()

    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/home');

            }else{

                $newUser = User::create([

                    'name' => $user->name,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')

                ]);
                Auth::login($newUser);

                return redirect('/home');
            }
        } catch (Exception $e) {
            
            dd($e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers\Login;

use Auth;
use Socialite;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacebookController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        try {    
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('login/facebook');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('/home');
    }

    private function findOrCreateUser($githubUser)
    {
        if($authUser = User::where('facebook_id', $githubUser->id)->first()){
        return $authUser;
    }

        return User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'facebook_id' => $githubUser->id,
            'avatar' => $githubUser->avatar,
            'password' => encrypt('12345dummy'),
        ]);
    }
}

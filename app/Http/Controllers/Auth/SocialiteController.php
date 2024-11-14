<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();

        $registeredUser = User::where('google_id', $socialUser->id)->first();

        if (!$registeredUser) {

            $user = User::updateOrCreate([
                'google_id' => $socialUser->id,
            ], [
                'name'                  => $socialUser->name,
                'username'              => str_replace(' ', '', $socialUser->name),
                'email'                 => $socialUser->email,
                'password'              => Hash::make($socialUser->token),
                'google_token'          => $socialUser->token,
                'google_refresh_token'  => $socialUser->refreshToken,
                'provider'              => 'google',
            ]);

            Auth::login($user);

            return redirect('/');
        }

        Auth::login($registeredUser);

        return redirect('/');
    }
}

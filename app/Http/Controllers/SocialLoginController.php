<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function google(){

        $user_google = Socialite::driver('google')->user();
        $user = User::where('email', $user_google->email)->first();
        if (! $user) {
            $user = new User;
            $user->google_id = $user_google->id;
            $user->name = $user_google->name;
            $user->email = $user_google->email;
            $user->password = Hash::make('123456');
            $user->google_token = Str::random(80);
            $user->save();
        } else {
            if (empty($user->google_id)) {
                $user->google_id = $user_google->id;
            }
            $user->update();
        }

        // login
        Auth::loginUsingId($user->id);
        return redirect('/dashboard');


//        $google_user = Socialite::driver('google')->user();
//        $user = User::where('email', $google_user->email)->first();
//
//        if ($user) {
//            $user->update([
//                'google_token' => $google_user->token,
//                'google_refresh_token' => $google_user->refreshToken,
//            ]);
//        } else {
//            $user = new User();
//            $user->name = $google_user->name;
//            $user->email = $google_user->email;
//            $user->password = Hash::make('123456');
//            $user->save();
//
//        }
//
//        Auth::login($user);
//        return redirect('/dashboard');


    }
}

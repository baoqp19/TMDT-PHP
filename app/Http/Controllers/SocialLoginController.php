<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect_to_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handle_login_google()
    {
        $social_user = Socialite::driver("google")->user();

        if (!$social_user) {
            return redirect()->route('user.signin_get');
        }

        $social_account = SocialAccount::where('social_id', $social_user->id)->first();
        if (!$social_account) {
            $social_account = new SocialAccount;
            $social_account->social_id = $social_user->id;
            $social_account->social_name = "google";

            $user = User::where('email', $social_user->email)->first();
            if (!$user) {
                $user = new User;
                $user->fill((array)$social_user);
                // $image = downloadImage($social_user->avatar, 'avatars');
                // $user->image = $image;
                $user->save();
            }

            $social_account->user()->associate($user);
            $social_account->save();
        }

        $user = $social_account->user;
        Auth::login($user);
        return redirect()->route('home.index')->with('signup-success', true);
    }
}

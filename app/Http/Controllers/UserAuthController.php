<?php

namespace App\Http\Controllers;

use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserAuthController extends Controller
{
    public function signin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home.index');
        }
        return view('user.signin');
    }

    public function signup(): View
    {
        return view('user.signup');
    }

    public function handleSignin(SigninRequest $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return back()->withInput()->withErrors([
                'email_or_pass' => __('auth.failed')
            ]);
        }

        $user = Auth::user();
        if ($user->block >= 5) {
            session(['block' => true]);
            return redirect()->route('user.blocked');
        }

        return redirect()->route('home.index');
    }

    public function handleSignup(SignUpRequest $request): RedirectResponse
    {
        $user = User::create([
            ...$request->validated(),
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user, true);

        return redirect()->route('home.index')->with('signup-success', true);
    }

    public function signout(): RedirectResponse
    {
        session()->forget('coupon');
        Auth::logout();
        return redirect()->route('home.index');
    }
}

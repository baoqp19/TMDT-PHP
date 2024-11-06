<?php

namespace App\Http\Controllers;

use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class UserAuthController extends Controller
{
    public function login(): View|RedirectResponse
    {
        // if (Auth::check()) {
        //     return redirect()->route('home.index');
        // }
        return view('user.login');
    }

    public function register(): View
    {
        return view('user.register');
    }

    public function handlelogin(SigninRequest $request): RedirectResponse
    {

        // Lấy thông tin đăng nhập từ request
        $credentials = $request->only(['email', 'password']);
        // Kiểm tra ghi nhớ đăng nhập

        $remember = $request->has('remember');


        // Thực hiện xác thực người dùng
        if (!Auth::attempt($credentials, $remember)) {
            // Nếu xác thực thất bại, trả về với lỗi
            Log::info('lỗi ở đây');
            return back()->withInput()->withErrors([

                'email_or_pass' => __('auth.failed')
            ]);
        }
        Log::info('Đang xử lý đăng nhập');
        // Lấy thông tin người dùng đã đăng nhập
        $user = Auth::user();

        // Kiểm tra nếu người dùng bị khóa (block >= 5)
        if ($user->block >= 5) {
            // Lưu trạng thái bị block vào session
            session(['block' => true]);

            // Chuyển hướng đến trang thông báo tài khoản bị khóa
            return redirect()->route('user.blocked');
        }

        // Đăng nhập thành công, chuyển hướng về trang chủ
        return redirect()->route('home.index');
    }


    public function handleSignup(SignUpRequest $request): RedirectResponse
    {
        $user = User::create([
            ...$request->validated(),
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user, true);

        return redirect()->route('user.login')->with('signup-success', true);
    }

    public function signout(): RedirectResponse
    {
        session()->forget('coupon');
        Auth::logout();
        return redirect()->route('home.index');
    }
}

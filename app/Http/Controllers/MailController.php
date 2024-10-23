<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send_coupon(Request $req)
    {
        $user = User::find($req->user_id);
        $coupon = Coupon::where('code', $req->coupon_code)->first();

        // Kiểm tra xem người dùng và coupon có tồn tại không
        if (!$user) {
            return back()->with(['error' => "Người dùng không tồn tại."]);
        }

        if (!$coupon) {
            return back()->with(['error' => "Mã khuyến mãi không tồn tại."]);
        }

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('m');
        $title_mail = "MW Store gửi tặng bạn mã khuyến mãi tháng " . $now;

        // Gửi email
        try {
            Mail::send('admin.mail.send-coupon', compact('coupon', 'user'), function ($message) use ($title_mail, $user) {
                $message->to($user->email)->subject($title_mail);
            });

            return back()->with(['success' => "Mã khuyến mãi đã được gửi thành công."]);
        } catch (\Exception $e) {
            return back()->with(['error' => "Gửi email thất bại: " . $e->getMessage()]);
        }
    }

    private function send_mail_reset_password($user)
    {
        $expired = Carbon::now('Asia/Ho_Chi_Minh')->addMinutes(15)->format('d-m-Y H:i:s');
        $forgot_password = md5($user->email . $expired);

        $user->expired = $expired;
        $user->forgot_password = $forgot_password;
        $user->save();

        $title_mail = "MW Store: Đặt lại mật khẩu tài khoản.";

        // Gửi email
        try {
            Mail::send('user.mail.forgot-password', compact('user', 'forgot_password'), function ($message) use ($title_mail, $user) {
                $message->to($user->email)->subject($title_mail);
            });

            session(['email' => $user->email]);
        } catch (\Exception $e) {
            return back()->with(['error' => "Gửi email thất bại: " . $e->getMessage()]);
        }
    }

    public function handle_mail_reset_password(Request $req)
    {
        $user = User::where('email', $req->email)->first();
        if (!$user) {
            return back()->with(['error' => "Địa chỉ email không tồn tại trong hệ thống"]);
        }
        $this->send_mail_reset_password($user);
        return back()->with(['success' => "Thành công, kiểm tra email để đặt lại mật khẩu"]);
    }
}

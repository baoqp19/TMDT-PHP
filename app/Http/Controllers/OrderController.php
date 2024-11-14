<?php

namespace App\Http\Controllers;

use App\Events\UserOrder;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shipping;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user'])
            ->where(['user_id' => Auth::user()->id])
            ->where('status', '<>', 3)
            ->latest('id')
            ->get();

        return view('user.order.order')->with(compact('orders'));
    }

    public  function manage()
    {
        $orders = Order::with(['user'])
            ->latest('id')
            ->get();

        return view('admin.order.manage')->with(compact(['orders']));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'shipping', 'orderDetails', 'feeship', 'coupon'])
            ->findOrFail($id);

        return view('user.order.detail')->with(compact(['order']));
    }

    public function delete($id)
    {
        Order::where('id', $id)->update(['status' => 3]);
        return back();
    }

    public function admin_delete($id)
    {
        Order::destroy($id);
        return \redirect()->route('order.manage');
    }

    public function admin_detail($id)
    {
        $order = Order::with(['user', 'shipping', 'orderDetails', 'feeship', 'coupon'])->findOrFail($id);
        return view('admin.order.detail')->with(compact(['order']));
    }

    private function insert_order($data_order)
    {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->code = $data_order['order_code'];
        $order->feeship_id = $data_order['feeship_id'];
        $order->coupon_code = $data_order['coupon_code'];
        $order->status = 1;
        $order->total_order = Cart::totalPrice();
        $order->save();
    }

    private function insert_shipping($data_order)
    {
        $shipping = new Shipping;
        $shipping->fill($data_order);
        $shipping->user_id = Auth::user()->id;
        $shipping->save();
    }

    private function insert_order_detail($order_code)
    {
        $carts = Auth::user()->carts;
        foreach ($carts as $cart) {
            OrderDetail::create([
                'order_code' => $order_code,
                'product_id' => $cart->product->id,
                'product_name' => $cart->product->name,
                'product_price' => $cart->product->price,
                'product_quantity' => $cart->quantity,
                'product_image' => $cart->product->image,
                'total_price' => $cart->price(),
            ]);
        }
    }

    private function use_coupon($coupon_code)
    {
        if ($coupon_code != "NO") {
            $coupon = Coupon::where('code', $coupon_code)->first();
            $coupon->used = $coupon->used . "," . Auth::user()->id;
            $coupon->decrement('quantity');
            $coupon->save();
        }
    }


    private function handle_order_shipping_coupon($data_order)
    {
        $this->insert_order($data_order);
        $this->insert_shipping($data_order);
        $this->insert_order_detail($data_order['order_code']);
        $this->use_coupon($data_order['coupon_code']);

        $order = Order::where('code', $data_order['order_code'])->first();
        event(new UserOrder($order));
        session()->forget(['data_order', 'coupon', 'feeship_id', 'address', 'feeship', 'total_money']);
    }

    public function confirm_order(OrderRequest $req)
    {

        if (!session('feeship')) {
            return back()->with('error_shipping', 'Vui lòng chọn địa chỉ nhận hàng.');
        }

        $data_order = [
            'order_code' => strtoupper(substr(md5(microtime()), rand(0, 26), 8)),
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'note' => $req->note,
            'method' => $req->payment,
            'coupon_code' =>  session('coupon.code', 'NO'),
            'feeship_id' => session('feeship_id'),
            'address' => session('address'),
        ];

        //cash payment
        if ($req->payment == 0) {
            $this->handle_order_shipping_coupon($data_order);
            Cart::where('user_id', Auth::user()->id)->delete();
            return redirect()->route('order.index');
        }

        $total_money =  session('total_money');
        session(['data_order' =>  $data_order]);

        //vnpay payment
        if ($req->payment == 1) {
            $vnp_OrderInfo = 'Thanh toán mua hàng tại hệ thống MW Store -' . Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
            $vnp_BankCode = $req->bank_code;

            $inputData = [
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => env('VPN_TMN_CODE'),
                "vnp_Amount" => $total_money * 100,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" =>  $_SERVER['REMOTE_ADDR'],
                "vnp_Locale" => 'vn',
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_ReturnUrl" => env('RETURN_URL_PAYMENT'),
                "vnp_TxnRef" => $data_order['order_code'],
            ];

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = env('VPN_URL') . "?" . $query;
            if (env('VPN_HASH_SERECT')) {
                $vnpSecureHash = hash('sha256', env('VPN_HASH_SERECT') . $hashdata);
                $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            return redirect($vnp_Url);
        }

        //  momo payment
        // if ($req->payment == 2) {
        //     $moMoConfig = config('payment.gateways.MoMoAIO');
        //     $response = \MoMoAIO::purchase([
        //         'amount' => $total_money,
        //         'returnUrl' => env('RETURN_URL_PAYMENT'),
        //         'notifyUrl' => 'http://localhost:8000/order/ipn/',
        //         'orderId' => $data_order['order_code'],
        //         'requestId' => $data_order['order_code'],
        //         'orderInfo' => 'Thanh toán mua hàng tại hệ thống MW Store -' . Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s'),
        //     ])->send();

        //     if ($response->isRedirect()) {
        //         $redirectUrl = $response->getRedirectUrl();

        //         return redirect($redirectUrl);
        //         // TODO: chuyển khách sang trang MoMo để thanh toán
        //     }
        // }
    }

    public function payment_callback(Request $req)
    {
        if ($req->has('vnp_ResponseCode') && $req->vnp_ResponseCode != '00') {
            return view('user.order.order-fail');
        }

        if ($req->has('errorCode') && $req->errorCode != 0) {
            return view('user.order.fail');
        }

        $data_order = session('data_order');
        $this->handle_order_shipping_coupon($data_order);

        Cart::where('user_id', Auth::user()->id)->delete();
        return redirect()->route('order.index');
    }

    public function delivery($id)
    {
        Order::where('id', $id)->update([
            'status' => 2,
        ]);

        return back();
    }


    function removeVietnameseAccents($str)
    {
        $accents_arr = [
            'a' => ['à', 'á', 'ả', 'ã', 'ạ', 'â', 'ầ', 'ấ', 'ẩ', 'ẫ', 'ậ', 'ă', 'ằ', 'ắ', 'ẳ', 'ẵ', 'ặ'],
            'e' => ['è', 'é', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ề', 'ế', 'ể', 'ễ', 'ệ'],
            'i' => ['ì', 'í', 'ỉ', 'ĩ', 'ị'],
            'o' => ['ò', 'ó', 'ỏ', 'õ', 'ọ', 'ô', 'ồ', 'ố', 'ổ', 'ỗ', 'ộ', 'ơ', 'ờ', 'ớ', 'ở', 'ỡ', 'ợ'],
            'u' => ['ù', 'ú', 'ủ', 'ũ', 'ụ', 'ư', 'ừ', 'ứ', 'ử', 'ữ', 'ự'],
            'y' => ['ỳ', 'ý', 'ỷ', 'ỹ', 'ỵ'],
            'd' => ['đ'],
            'A' => ['À', 'Á', 'Ả', 'Ã', 'Ạ', 'Â', 'Ầ', 'Ấ', 'Ẩ', 'Ẫ', 'Ậ', 'Ă', 'Ằ', 'Ắ', 'Ẳ', 'Ẵ', 'Ặ'],
            'E' => ['È', 'É', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê', 'Ề', 'Ế', 'Ể', 'Ễ', 'Ệ'],
            'I' => ['Ì', 'Í', 'Ỉ', 'Ĩ', 'Ị'],
            'O' => ['Ò', 'Ó', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ồ', 'Ố', 'Ổ', 'Ỗ', 'Ộ', 'Ơ', 'Ờ', 'Ớ', 'Ở', 'Ỡ', 'Ợ'],
            'U' => ['Ù', 'Ú', 'Ủ', 'Ũ', 'Ụ', 'Ư', 'Ừ', 'Ứ', 'Ử', 'Ữ', 'Ự'],
            'Y' => ['Ỳ', 'Ý', 'Ỷ', 'Ỹ', 'Ỵ'],
            'D' => ['Đ']
        ];

        foreach ($accents_arr as $nonAccent => $accents) {
            $str = str_replace($accents, $nonAccent, $str);
        }

        return $str;
    }


    public function print_order($order_code)
    {
        $order = Order::where('code', $order_code)->first();


        $pdf = FacadePdf::loadView('admin.order.print', compact('order'))->setPaper('a4', 'landscape')->setOption(
            [
                'fontDir' => public_path('/fonts'),
                'fontCache' => public_path('/fonts'),
                'defaultFont' => 'Poppins'
            ]
        );
        return $pdf->download('MW_Store_' . $order->code . '.pdf');
    }

    public function print_order_new($code)
    {
        $str = base64_decode($code);
        try {
            $key = explode("--", $str);
            $order = Order::where(['code' => $key[1], "id" => $key[0], "user_id" => $key[2]])->first();
            if ($order) {
                $pdf = FacadePdf::loadView('admin.order.print', compact('order'))->setPaper('a4', 'landscape')->setOption([
                    'fontDir' => public_path('/fonts'),
                    'fontCache' => public_path('/fonts'),
                    'defaultFont' => 'Poppins'
                ]);
                return $pdf->download('MW_Store_' . $order->code . '.pdf');
            }
        } catch (Exception $e) {
        }
        return abort(404);
    }
}

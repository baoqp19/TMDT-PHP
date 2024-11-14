<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = [];
        if (Auth::check()) {
            $carts = Auth::user()->carts;
        }

        // Kiểm tra nếu đây là một yêu cầu AJAX
        if ($request->ajax()) {
            // Render phần nội dung giỏ hàng
            $view = view('user.cart', compact('carts'))->render(); // Render HTML giỏ hàng
            return response()->json([
                'html' => $view
            ]);
        }

        return view('user.cart', compact('carts'));
    }


    public function store(CartRequest $req)
    {
        Cart::updateOrStore($req);
        return redirect()->route('cart.index');
    }

    public function update(CartRequest $req)
    {
        // Gọi phương thức updateOrStore trong model Cart
        $cart = Cart::updateOrStore($req);

        // Tính tổng giá trị giỏ hàng sau khi cập nhật
        $totalPrice = Cart::totalPrice(); // Gọi phương thức tổng giá trị giỏ hàng

        return response()->json([
            'totalPrice' => $totalPrice,
            'itemTotal' => $cart ? $cart->quantity * $cart->product->price : 0,
        ]);
    }


    public function delete(Request $req)
    {
        Cart::destroy($req->id);
    }
}

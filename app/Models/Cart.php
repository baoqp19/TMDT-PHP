<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getName()
    {
        return $this->product->name;
    }

    public function getPrice()
    {
        return $this->product->price;
    }

    public function price()
    {
        return $this->product->price * $this->quantity;
    }

    public static function updateOrStore($req)
    {
        Cart::updateOrCreate(
            // tham số tìm kiếm
            [
            'user_id'   =>  Auth::user()->id,
            'product_id'   =>  $req->product_id,
            ],
            // tham số cập nhật
            ['quantity' => $req->quantity]);
    }

    public static function totalPrice()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->quantity * $cart->product->price;
        }
        return $total;
    }

    public static function totalPriceChecked()
    {
        // checked: là đã chọn giỏ hàng
        $carts = Cart::where(['user_id' => Auth::user()->id, 'checked' => 1])->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->quantity * $cart->product->price;
        }
        return $total;
    }
}

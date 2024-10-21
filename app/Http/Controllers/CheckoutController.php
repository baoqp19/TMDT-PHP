<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Feeship;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Auth::user()->carts;
        $citys = City::all();
        $provinces = Province::all();
        $villages = Village::all();

        return view('user.checkout.checkout')->with(compact(['carts', 'citys', 'provinces', 'villages']));
    }

    private function getAddress($req)
    {
        $city = City::where('city_code', $req->city_code)->first();
        $province = Province::where('province_code', $req->province_code)->first();
        $village = Village::where('village_code', $req->village_code)->first();
        return $city->name . ", " . $province->name . ", " . $village->name;
    }

    public function calc_feeship(Request $req)
    {
        $address = $this->getAddress($req);
        $feeship = Feeship::where($req->all())->first();
    
        // Mặc định nếu không có phí ship thì lấy giá trị mặc định
        $feeship_value = 25000;
        $feeship_id = 'NO';
    
        if ($feeship) {
            $feeship_value = $feeship->feeship;
            $feeship_id = $feeship->id;
        }
    
        // Lưu vào session
        session(['feeship' => $feeship_value, 'feeship_id' =>  $feeship_id, 'address' => $address]);
    
        // Trả về JSON response để client có thể xử lý
        return response()->json([
            'feeship' => $feeship_value,
            'feeship_id' => $feeship_id,
            'address' => $address
        ]);
    }
}

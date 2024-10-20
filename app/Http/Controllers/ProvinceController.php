<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProvinceController extends Controller
{
    public function getVillages(Request $request)
    {
        $provinceCode = $request->get('province_code');

        // Lấy danh sách villages dựa trên province_code
        $villages = Village::where('province_code', $provinceCode)->get();
        Log::info($villages);
        // Trả về danh sách villages dưới dạng JSON
        return response()->json($villages);
    }
}

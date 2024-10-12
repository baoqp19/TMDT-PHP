<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cacheTime = 600; // 10 minutes
    
        $sliders = cache()->remember('sliders', $cacheTime, function () {
            return Slider::with(['product'])
                ->latest('id')   // Sắp xếp theo id giảm dần (tức là sliders mới nhất sẽ ở trên cùng).
                ->take(10)
                ->get();
        });
    
        $product_feathers = cache()->remember('product_feathers', $cacheTime, function () {
            return Product::where('feather', 1)
                ->latest('id')
                ->take(15)
                ->get();
        });
    
        $product_news = cache()->remember('product_news', $cacheTime, function () {
            return Product::latest('id')
                ->take(15)
                ->get();
        });
    
        $brands = cache()->remember('brands', $cacheTime, function () {
            return Brand::with(['products'])
                ->latest('id')
                ->get();
        });
    
        return view('user.index', compact('brands', 'sliders', 'product_feathers', 'product_news'));
    }
}

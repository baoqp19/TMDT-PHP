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

        // Cache sliders
        $sliders = cache()->remember('sliders', $cacheTime, function () {
            return Slider::with(['product'])
                ->latest('id')
                ->take(10)
                ->get();
        });

        // Không cache phân trang cho sản phẩm nổi bật
        $product_feathers = Product::where('feather', 1)
            ->latest('id')
            ->paginate(5)
            ->appends('page_news', request('page_news'));

        // Không cache phân trang cho sản phẩm mới
        $product_news = Product::latest('id')
            ->paginate(5)
            ->appends('page_feathers', request('page_feathers'));

        // Cache brands
        $brands = cache()->remember('brands', $cacheTime, function () {
            return Brand::with(['products'])
                ->latest('id')
                ->get();
        });

        return view('user.index', compact('brands', 'sliders', 'product_feathers', 'product_news'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $req)
    {
        $keyword = $req->keyword;
        $keyword == "" ? $products = [] : $products = Product::where('name', 'like', $keyword . '%')->get();
        return view('user.search')->with(compact(['keyword', 'products']));
    }

    public function search_live(Request $req)
    {
        $products = Product::where('name', 'like', '%' . $req->keyword . '%')->get();
        return response()->json($products);
    }
}

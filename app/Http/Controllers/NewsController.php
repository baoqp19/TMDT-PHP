<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $posts = cache()->remember('news', 600, function () {
            return  News::getNews();
        });
        return view('user.utils.news')->with(compact(['posts']));
    }
}

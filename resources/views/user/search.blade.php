@extends('user.layouts.master')
@section('title', 'Tìm kiếm')

@section('ContentPage')
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('home.index')}}">@lang('lang.home')</a></li>
                <li class="active"><a href="{{route('search')}}">@lang('lang.search')</a></li>
            </ul>
        </div>
    </div>
</div>

@if(count($products))
<div class="error404-area ptb-60 ptb-sm-60">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center align-items-center" style="gap: 30px;">
            <ul class="work-list d-flex justify-content-center align-items-center " style="list-style: none; padding: 0; ">
                @foreach($products as $product)
                <li class="work-item" style="flex: 0 1 30%; margin-bottom: 20px;">
                    <div class="single-product" style="border: 1px solid #eee; border-radius: 5px; overflow: hidden;">
                        <div class="pro-img" style="position: relative;">
                            <a href="{{route('product.detail', $product->slug)}}">
                                <img class="primary-img" style="height: 270px; object-fit: cover; width: 100%;" src="{{asset('admins/uploads/products/'.$product->image)}}" alt="{{$product->name}}">
                            </a>
                            <p class="quick_view product-text-view" title="Lượt xem" style="position: absolute; top: 10px; right: 10px; background-color: rgba(0,0,0,0.5); color: white; padding: 5px 10px; border-radius: 3px;">
                                <i class="fas fa-eye"></i> {{$product->visit}}
                            </p>
                        </div>
                        <div class="pro-content" style="padding: 15px;">
                            <div class="pro-info">
                                <h4><a href="{{route('product.detail', $product->slug)}}" style="color: #333;">{{$product->name}}</a></h4>
                                <p><span class="price" style="font-weight: bold; color: #B5292F;">{{ number_format($product->price, 0, ',', '.') . ' VND' }}</span></p>
                                <div class="rating">
                                    @for ($m = 0; $m < floor($product->star()); $m++) 
                                        <i class="fas fa-star" style="color: #ffcc00;"></i>
                                    @endfor
                                    @for ($n = floor($product->star()); $n < 5; $n++) 
                                        <i class="far fa-star" style="color: #ffcc00;"></i>
                                    @endfor
                                    <span style="font-size: 0.9rem; margin-left: 5px;">{{ number_format((float)$product->star(), 1, '.', '') }}</span>
                                </div>
                            </div>
                            <div class="pro-actions" style="margin-top: 10px;">
                                <div class="actions-primary" style="margin-bottom: 5px;">
                                    <a href="{{route('product.detail', $product->slug)}}" title="@lang('lang.view_detail_more')" style="color: white; background-color: #B5292F; padding: 8px 15px; border-radius: 3px; display: block; text-align: center;">
                                        @lang('lang.view_detail')
                                    </a>
                                </div>
                                <div class="actions-secondary d-flex justify-content-between ">
                                    <a class="compare" href="#" title="@lang('lang.add_compare')"><i class="fa-light fa-code-compare" style="color: #B5292F;"></i> <span>@lang('lang.add_compare')</span></a>
                                    <a class="compare" href="#" title=">@lang('lang.add_wishlist')"><i class="fa-regular fa-heart" style="color: #B5292F; "></i><span>@lang('lang.add_wishlist')</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@else
<h4 class="title-name title-search mt-20 text-center">@lang('lang.no_product_to_show')</h4>
@endif

@endsection

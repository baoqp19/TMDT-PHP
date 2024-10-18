
@extends('user.layouts.master')
@section('title', 'MW Store | Thương mại điện tử')
@section('meta_desc', 'MW Store website thương mại điện tử.')

@section('ContentPage')
@if(count($sliders) > 0)
<div class="slider_box">
    <div class="slider-wrapper theme-default">
        <div id="slider" class="nivoSlider">
            @foreach($sliders as $slider)
            <a href="{{route('product.detail', $slider->product->slug)}}"><img class="lazy" src="{{asset('admins/uploads/sliders/'.$slider->image)}}" alt="{{$slider->product->name}}" /></a>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="trendig-product mt-70">
    <div class="container">
        <div class="trending-box">
            <div class="">
                <p class="title-name">@lang('lang.feather')</p>
            </div>
            <div class="product-list-box">
                <div class="trending-pro-active owl-carousel">
                    @if(count(array($product_feathers)) > 0)
                    @foreach($product_feathers as $product_feather)
                    <div class="single-product">
                        <div class="pro-img">
                            <a href="{{route('product.detail', $product_feather->slug)}}">
                                <img class="primary-img lazy" style="height: 226px; object-fit: cover;" data-src="{{asset('admins/uploads/products/'.$product_feather->image)}}" alt="{{$product_feather->name}}">
                            </a>
                            <p class="quick_view product-text-view" title="Lượt xem"> <i class="fas fa-eye"></i>{{$product_feather->visit}}</p>
                        </div>
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="{{route('product.detail', $product_feather->slug)}}">{{$product_feather->name}}</a></h4>
                                <p>
                                    <span class="price">{{ number_format($product_feather->price, 0, ',', '.') . ' VND' }}
                                    </span>
                                </p>
                                <div class="rating">
                                    @for ($m = 0; $m < floor($product_feather->star()); $m++) <i class="fas fa-star"></i>
                                        @endfor

                                        @for ($n = floor($product_feather->star()); $n < 5; $n++) <i class="far fa-star"></i>
                                            @endfor
                                            {{ number_format((float)$product_feather->star(), 1, '.', '')}}
                                </div>
                            </div>
                            <div class="pro-actions">
                                <div class="actions-primary">
                                    <a href="{{route('product.detail', $product_feather->slug)}}" title="@lang('lang.view_detail_more')">@lang('lang.view_detail')</a>
                                </div>
                                <div class="actions-secondary">
                                    <a href="#" title="@lang('lang.add_compare')"><i class="lnr lnr-sync"></i> <span>@lang('lang.add_compare')</span></a>
                                    <a href="#" title=">@lang('lang.add_wishlist')"><i class="lnr lnr-heart"></i> <span>@lang('lang.add_wishlist')</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="trendig-product mt-70">
    <div class="container">
        <div class="trending-box">
            <div class="">
                <p class="title-name">@lang('lang.new_product')</p>
            </div>
            <div class="product-list-box">
                <div class="trending-pro-active owl-carousel">
                    @if(count(array($product_news)) > 0)
                    @foreach($product_news as $product_new)
                    <div class="single-product">
                        <div class="pro-img">
                            <a href="{{route('product.detail', $product_new->slug)}}">
                                <img class="primary-img lazy" style="height: 226px; object-fit: cover;" data-src="{{asset('admins/uploads/products/'.$product_new->image)}}" alt="{{$product_new->name}}">
                            </a>
                            <p class="quick_view product-text-view" title="Lượt xem"> <i class="fas fa-eye"></i>{{$product_new->visit}}</p>
                        </div>
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="{{route('product.detail', $product_new->slug)}}">{{$product_new->name}}</a></h4>
                                <p>
                                    <span class="price">{{number_format($product_new->price, 0, ',', '.') . ' VND'}}</span>
                                </p>
                                <div class="rating">
                                    @for ($m = 0; $m < floor($product_new->star()); $m++) <i class="fas fa-star"></i>
                                        @endfor

                                        @for ($n = floor($product_new->star()); $n < 5; $n++) <i class="far fa-star"></i>
                                            @endfor
                                            {{ number_format((float)$product_new->star(), 1, '.', '')}}
                                </div>
                            </div>
                            <div class="pro-actions">
                                <div class="actions-primary">
                                    <a href="{{route('product.detail', $product_new->slug)}}" title="@lang('lang.view_detail_more')">@lang('lang.view_detail')</a>
                                </div>
                                <div class="actions-secondary">
                                    <a href="#" title="@lang('lang.add_compare')"><i class="lnr lnr-sync"></i> <span>@lang('lang.add_compare')</span></a>
                                    <a href="#" title=">@lang('lang.add_wishlist')"><i class="lnr lnr-heart"></i> <span>@lang('lang.add_wishlist')</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="arrivals-product mt-70">
    <div class="container">
        <div class="main-product-tab-area">
            <div class="tab-menu mb-25 d-flex justify-content-center">
                {{-- <div class="">
                    <p class="title-name">@lang('lang.brand')</p>
                </div> --}}
                <ul class="nav tabs-area" role="tablist">
                    @if(count($brands) > 0)
                        <?php 
                        $hasActiveBrand = false;
                        $is_active = true; 
                        ?>
                        @foreach($brands as $brand)
                            @if($is_active)
                                <?php $hasActiveBrand = true; ?>
                            @endif
                            <li class="nav-item title-brand">
                                <a class="nav-link <?php if ($is_active) {
                                                        echo 'active';
                                                    }
                                                    $is_active = false; ?>" data-toggle="tab" href="#brand{{$brand->id}}">{{$brand->name}}</a>
                            </li>
                        @endforeach
                
                        {{-- Nếu không có brand nào active thì hiển thị thông báo --}}
                        @if(!$hasActiveBrand)
                            <p>Không có thương hiệu nào được kích hoạt.</p>
                        @endif
                    @else
                        <p>Không có thương hiệu nào để hiển thị.</p>
                    @endif
                </ul>
            </div>
            <div class="tab-content">
                <?php $is_active_brand = true; ?>
                @foreach($brands as $brand)
                <div id="brand{{$brand->id}}" class="tab-pane fade <?php if ($is_active_brand) {
                                                                        echo "show active";
                                                                    };
                                                                    $is_active_brand = false; ?>">
                    <div class="electronics-pro-active owl-carousel">
                        @php $products = $brand->products; @endphp
                        @foreach($products as $product)
                        <div class="single-product">
                            <div class="pro-img">
                                <a href="{{route('product.detail', $product->slug)}}">
                                    <img class="primary-img lazy" style="height: 381px; object-fit: cover;" data-src="{{asset('admins/uploads/products/'.$product->image)}}" alt="{{$product->name}}">
                                </a>
                                <p class="quick_view product-text-view" title="Lượt xem"> <i class="fas fa-eye"></i>{{$product->visit}}</p>
                            </div>
                            <div class="pro-content">
                                <div class="pro-info">
                                    <h4><a href="{{route('product.detail', $product->slug)}}">{{$product->name}}</a></h4>
                                    <p><span class="price">@money($product->price)</span></p>
                                    <div class="rating">
                                        @for ($m = 0; $m < floor($product->star()); $m++) <i class="fas fa-star"></i>
                                            @endfor

                                            @for ($n = floor($product->star()); $n < 5; $n++) <i class="far fa-star"></i>
                                                @endfor
                                                {{ number_format((float)$product->star(), 1, '.', '')}}
                                    </div>
                                    <div class="label-product l_sale"><span class="symbol-percent"></span></div>
                                </div>
                                <div class="pro-actions">
                                    <div class="actions-primary">
                                        <a href="{{route('product.detail', $product->slug)}}" ttitle="@lang('lang.view_detail_more')">@lang('lang.view_detail')</a>
                                    </div>
                                    <div class="actions-secondary">
                                        <a href="#" title="@lang('lang.add_compare')"><i class="lnr lnr-sync"></i> <span>@lang('lang.add_compare')</span></a>
                                        <a href="#" title=">@lang('lang.add_wishlist')"><i class="lnr lnr-heart"></i> <span>@lang('lang.add_wishlist')</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

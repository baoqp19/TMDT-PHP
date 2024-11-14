@extends('user.layouts.master')
@section('title', "Cart")

@push('styles')
    <style>
        .custom-btn{
            background: #294D81 !important;
            color: white !important; 
        }

        .card1{
            margin-left: 12px;
        }

        .totalPrice, .titlePrice{
            font-size: 16px;
        }

        .totalPrice{
            color: #B5292F;
        }

        .s3{
            background: #B5292F !important;
        }

        .s3{
            border: none !important;
            color: white !important; 
        }

        .input-quanlity{
            height: 100%;
        }

        .titleProduct{
            text-decoration: none !important;
        }

        .titleProduct:hover{
            color: #B5292F !important;
        }

        .input-quanlity {
            height: 100%;
            padding: 0; /* Loại bỏ padding của thẻ td nếu cần */
        }

        .input-quanlity .product-quantity-update {
            height: 100%; /* Đặt chiều cao của input bằng 100% của td */
        }

        .table-hover tbody tr:hover {
            color: white !important; /* Màu chữ khi hover */
        }

        /* Đảm bảo màu chữ của các ô trong hàng hover cũng thay đổi */
        .table-hover tbody tr:hover td {
            color: #333 !important; /* Màu chữ khi hover */
        }



    </style>
@endpush;

@section('ContentPage')
<div id="cart-container">

    <div class="container mt-5">
        {{-- TRANG CHỦ / CART --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home.index')}}">@lang('lang.home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('lang.cart')</li>
            </ol>
        </nav>
    
        @auth
        <div class="row">
            <div class="col-12">
                @if(count($carts))
    
                {{-- THÔNG TIN SẢN PHẨM TABLE  --}}
                <div class="card shadow-md mb-4">
                    <div class="card-body">
                        <h2 class="card-title mb-4">@lang('lang.cart')</h2>
                        <div class="table-responsive">
                            <table class="table table-hover"    >
                                <thead class="thead-light">
                                    <tr>
                                        <th>@lang('lang.image')</th>
                                        <th>@lang('lang.product_name')</th>
                                        <th>@lang('lang.price')</th>
                                        <th>@lang('lang.quantity')</th>
                                        <th>@lang('lang.total_money')</th>
                                        <th>@lang('lang.delete')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; @endphp
                                    @foreach($carts as $cart)
                                    @php $total += $cart->price(); @endphp
                                    <tr id="cart-item-{{ $cart->product->id }}">
                                        <td class="text-center" >
                                            <img src="{{asset('admins/uploads/products/'.$cart->product->image)}}" alt="{{$cart->getName()}}" class="img-thumbnail" style="max-height: 80px; object-fit: cover;">
                                        </td>
                                        <td class="text-center" ><a href="{{route('product.detail', $cart->product->slug)}}" class="titleProduct text-dark">{{$cart->getName()}}</a></td>
                                        <td class="text-center">{{ number_format($cart->getPrice(), 0, ',', '.') . ' VND' }}</td>
                                        <td class="input-quanlity text-center">
                                            <input type="number" class="form-control product-quantity-update h-100 w-100 mx-auto" style="max-width: 80px; text-align: center" data-id="{{$cart->product->id}}" min="1" value="{{$cart->quantity}}">
                                        </td>
                                        <td class="text-center item-total">{{ number_format($cart->price(), 0, ',', '.') . ' VND' }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-danger del-cart" data-id="{{$cart->id}}">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
                <div class="row">
    
                    {{-- THÊM SẢN PHẨM --}}
                    <div class="col-md-6 d-flex align-items-center">
                        <a id="add-product-cart" href="index.php" class="btn btn-outline-primary custom-btn">
                            <i class="fa-solid fa-house"></i>&nbsp Thêm sản phẩm
                        </a>
                    </div>
    
                    {{-- THANH TOÁN --}}
                    <div class="col-md-6 d-flex justify-content-end align-items-center">
                        <div class="card-body d-flex justify-content-end align-items-center">
                            <h5 class="card1 titlePrice card-title">@lang('lang.total_money'):</h5>
                            <p class="card1 totalPrice card-text">
                                <strong id="total-price" >{{ number_format($cart->totalPrice(), 0, ',', '.') . ' VND' }}</strong>
                            </p>
                            <a href="{{route('checkout.index')}}" class=" card1 s3 btn btn-primary btn-block">
                                <i class="fa-solid fa-bag-shopping"></i>&nbsp @lang('lang.checkout')</a>
                        </div>
                    </div>
    
    
                </div>
                {{-- KHÔNG CÓ SẢN PHẨM --}}
                @else
                <div class="alert alert-info text-center" role="alert">
                    @lang('lang.no_product_to_show')
                </div>
                @endif
    
            </div>
        </div>
        @endauth
    
    
        {{-- HIỂN THỊ LOGIN AND REGISTOR KHI CHƯA ĐĂNG NHẬP --}}
        @guest
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h4 class="card-title">@lang('lang.signup_to_continue')</h4>
                        <a href="{{route('user.signin_get')}}" class="btn btn-primary mt-3">@lang('lang.signup')</a>
                    </div>
                </div>
            </div>
        </div>
        @endguest
    </div>
</div>

@push('scripts')
<script>
   
</script>
@endpush
@endsection
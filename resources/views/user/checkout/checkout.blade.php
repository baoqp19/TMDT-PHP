@extends('user.layouts.master')
@section('title', 'Thanh Toán')

@section('ContentPage')

@push('styles')
    <style>
        .nameProduct{
            color: #333;
            text-decoration: none !important;
        }

        .nameProduct:hover{
            color: #B5292F !important;
        }

        .label-name-ship{
            font-weight: 600;
            margin-left: 2px;
            margin-bottom: 3px;
            margin-top: 5px;
        }

        .price-checkout{
            font-size: 13px;
            color: #B5292F;
        }
    </style>
@endpush
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('home.index')}}">@lang('lang.home')</a></li>
                <li class="active"><a href="{{route('checkout.index')}}">@lang('lang.checkout')</a></li>
            </ul>
        </div>
    </div>
</div>

@if(count($carts))
<div class="error404-area ptb-60 ptb-sm-60">
    <div class="container" >

        {{-- THÔNG TIN SẢN PHẨM --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box-both">
                    <table class="table " style=" width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th class="product-thumbnail">@lang('lang.image')</th>
                                <th class="product-name">@lang('lang.product_name')</th>
                                <th class="product-quantity">@lang('lang.quantity')</th>
                                <th class="product-price">@lang('lang.price')</th>
                                <th class="product-subtotal">@lang('lang.total_money')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($carts as $cart)
                            @php $total += $cart->price() ; @endphp
                            <tr>
                                <td class="align-middle text-center" scope="row"><a href="{{route('product.detail', $cart->product->slug)}}"><img style="border-radius: 10px; height: 50px; width: 50px; object-fit: cover;" src="{{asset('admins/uploads/products/'.$cart->product->image)}}" alt="cart-image"></a></td>
                                <td class="align-middle text-center"><a class="nameProduct" href="{{route('product.detail', $cart->product->id)}}">{{$cart->getName()}}</a></td>
                                <td class="align-middle text-center">{{$cart->quantity}}</td>
                                <td class="align-middle text-center" style="" >{{ number_format($cart->getPrice(), 0, ',', '.') . ' VND' }}</td>
                                <td class="align-middle text-center">{{ number_format($cart->price(), 0, ',', '.') . ' VND' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        {{-- TỔNG TIỀN --}}
        <div class="row mt-20">
            <div class="col-md-12">
                <div class="box-both text-right">
                    <p style="font-weight: 600; font-size: 16px;">@lang('lang.total'):
                        <span class="price-checkout" style="margin-left: 36px;" >{{ number_format($total, 0, ',', '.') . ' VND' }}</span>
                    </p>

                    @if(session('address'))
                    <p class="" style="font-weight: 600; font-size: 16px;" >@lang('lang.address'):
                        <span class="price-checkout address-delivery" style="color: #B5292F; margin-left: 67px;" >{{session('address')}}</span>
                    </p>
                    @endif

                    @if(session('feeship'))
                    <p style="font-weight: 600; font-size: 16px; ">@lang('lang.feeship'):
                        @php $money_feeship = session('feeship'); @endphp
                       <span class="price-checkout" style="margin-left: 2px;" >{{ number_format($money_feeship, 0, ',', '.') . ' VND' }}</span>
                    </p>
                    @endif

                    @if(session('coupon'))
                    @php $coupon = session('coupon'); @endphp
                    <p style="font-weight: 600; font-size: 16px; ">@lang('lang.coupon_code'): {{$coupon['code']}} - @lang('lang.value'):
                        {{$coupon['percent']}}%
                    </p>
                    <p style="font-weight: 600; font-size: 16px; ">@lang('lang.money_down'): 
                        @php $money_coupon = ($cart->totalPrice() * $coupon['percent'])/100; @endphp
                        <span class="price-checkout" >{{ number_format($money_coupon, 0, ',', '.') . ' VND' }}</span>
                    </p>
                    @endif

                    <?php
                    if (!session('feeship') && !session('coupon')) {
                        $total_money = $total;
                    } elseif (!session('feeship') && session('coupon')) {
                        $total_money = $total - $money_coupon;
                    } elseif (session('feeship') && session('coupon')) {
                        $total_money =  $total + $money_feeship - $money_coupon;
                    } elseif (session('feeship') && !session('coupon')) {
                        $total_money = $total + $money_feeship;
                    }
                    ?>
                    <p style="font-weight: 600; font-size: 16px; ">@lang('lang.total_money'):
                       <span class="price-checkout" style="margin-left: 50px;" > {{ number_format( $total_money, 0, ',', '.') . ' VND' }}</span>
                        @php Session::put('total_money', $total_money ) @endphp
                    </p>

                    <input type="hidden" id="vnd-to-usd" value="{{round($total_money / 23083, 2)}}" />
                </div>
            </div>
        </div>


        <div class="row mt-20">
            <div class="col-md-12">
                {{-- MÃ GIẢM GIÁ --}}
                <div class="form-row">
                    @csrf
                    <div class="row card-body box-coupon d-flex justify-content-end align-items-center">
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="col-md-4">
                                <input type="text" class="form-control coupon-code" placeholder="@lang('lang.coupon_code')..." required>
                            </div>
                            <div class="col-md-4">
                                <button  style="margin-left: 32px;"  class="btn btn-primary border-custom-1 check-coupon">@lang('lang.check')</button>
                            </div>
                        </div>
                        <div class="col-md-8" >
                            <input type="hidden">
                        </div>
                        @if(session('message'))
                        <p class="text text-success">{{session('message')}}</p>
                        @php session()->forget('message'); @endphp
                        @elseif(session('error'))
                        <p class="text text-danger"> {{session('error')}}</p>
                        @php session()->forget('error'); @endphp
                        @endif
                    </div>
                </div>

                {{-- DỊA CHỈ VẬN CHUYỂN AND NÚT VẬN CHUYỂN --}}
                <div class="card-body">
                    <h5 class="card-title">@lang('lang.feeship')</h5>
                    <div class="needs-validation">
                        @csrf
                        <div class="form-row row">
                            <div class="col-md-4 mb-3">
                                <label for="validationTooltip01" class="label-name-ship" >@lang('lang.city')</label>
                                <select class="mb-2 form-control choose city" id="city" name="city">
                                    <option value="">-- Select City --</option>
                                    @foreach($citys as $city)
                                    <option value="{{$city->city_code}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationTooltip01" class="label-name-ship">@lang('lang.province')</label>
                                <select class="mb-2 form-control choose province" id="province" name="province">
                                    <option value="">-- Select Province --</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->province_code}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="validationTooltip01" class="label-name-ship">@lang('lang.village')</label>
                                <select class="mb-2 form-control village" id="village" name="village">
                                    <option value="">-- Select Village --</option>
                                    
                                </select>
                            </div>
                            

                        </div>

                        <div class="form-row text-center">
                            <div class="col-md-12 mb-3 mt-2">                                                                               
                                <button class="btn btn-primary add-delivery border-custom" name="add-delivery" style="padding-left: 35px; padding-right:35px ; background: #B5292F; border: none !important; " type="button">@lang('lang.feeship')</button>
                            </div>
                        </div>


                    </div>
                </div>


                {{-- THÔNG TIN NGƯỜI MUA --}}
                <form id="order-form" action="{{route('order.confirm')}}" method="POST">
                    @csrf
                    <div class="box-both">
                        <div class="form-group row form-info" style="padding: 40px; padding-bottom: 4px;">
                            @php $user = Auth::user(); @endphp
                            <p style="margin-bottom: 20px; font-size: 30px; text-transform: uppercase;" class="text-center">@lang('lang.cus_info')</p>
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1" class="label-name-ship" style="text-align: center !important; " >@lang('lang.name')</label>
                                <input type="text" value="{{$user->name}}" name="name" class="ship_name form-control" aria-describedby="emailHelp" placeholder="@lang('lang.name')...">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1" class="label-name-ship">Email</label>
                                <input type="text" value="{{$user->email}}" name="email" class="ship_email form-control" aria-describedby="emailHelp" placeholder="Email...">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="exampleInputEmail1" class="label-name-ship">@lang('lang.phone')</label>
                                <input type="password" value="{{$user->phone}}" name="phone" class="ship_phone form-control" aria-describedby="emailHelp" placeholder="@lang('lang.phone')...">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>

                            <div class="form-group col-md-6 ">
                                <label for="exampleInputEmail1" class="label-name-ship">@lang('lang.note')</label>
                                <textarea class="ship_note form-control" name="note" placeholder="@lang('lang.note')..." rows="1"></textarea>
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group col-md-12 ">
                                <label for="exampleInputEmail1" class="label-name-ship">@lang('lang.payment_method')</label>
                                <select class="mb-2 form-control ship_payment" id="payment" name="payment">
                                    <option value="0">@lang('lang.cash')</option>
                                    <option value="1">VN Pay</option>
                                    <option value="2">Momo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="box-both mt-20 back-none">
                        @if(session('error_shipping'))
                        <p class="text text-center text-danger">{{session('error_shipping')}}</p>
                        @endif
                        <div class="form-group text-center mt-20">
                            <input type="submit" name="order" style="background: #B5292F; margin-bottom: 10px; border: none !important;" value="@lang('lang.order_now')" class="btn btn-primary order-btn" />
                            <div id="paypal-button"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- KHÔNG CÓ CART THÌ HIỆN THỊ THÔNG TIN --}}
@else
<div class="error404-area ptb-80 ptb-sm-80">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p style="text-align: center; color: #B5292F; font-size: 15px">@lang('lang.no_product_to_checkout')</p>
            </div>
        </div>
    </div>
</div>
@endif



<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    let usd = $("#vnd-to-usd").val();

    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'ASXfoCEQRQ-qKZRRpEZj_dNdgjbOOr7afjKIovaTvmDW4i2K3an-Wv5MgcMGfmhRgaeHg7xHu2orRzR5',
            production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: usd,
                        currency: 'USD'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                window.alert('Cảm ơn bạn đã mua hàng của chúng tôi.');
            });
        }
    }, '#paypal-button');



</script>
@endsection

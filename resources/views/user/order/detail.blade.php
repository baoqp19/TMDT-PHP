@extends('user.layouts.master')
@section('title', 'Đơn hàng')

@push('styles')
   <style>
         .printOrder{
            font-size: 18px;
            color: #B5292F !important;
            text-decoration: none !important;
            margin-left: 4px;
         }

         .printOrder:hover{
            width: 100%;
            text-decoration: underline !important;
         }

         .title-order{
            font-size: 16px;
            font-weight: 500;
            color: #B5292F !important;
         }

         .card-header{
            margin-bottom: 20px;
         }
   </style>

@endpush
@section('ContentPage')
<div class="breadcrumb-area mt-30">
  <div class="container">
    <div class="breadcrumb">
      <ul class="d-flex align-items-center">
        <li><a href="{{route('home.index')}}">@lang('lang.home')</a></li>
        <li class="active"><a href="{{route('order.index')}}">@lang('lang.order')</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="error404-area ptb-60 ptb-sm-60">
  <div class="container">

    <div class="card-header mt-3 mb-6"><p class="title-order text-center" >@lang('lang.receive_info')</p></div>
    <div class="table-responsive" style="padding-bottom: 10px;">
      <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
          <tr>
            <th class="text-center">@lang('lang.name')</th>
            <th class="text-center">Email</th>
            <th class="text-center">@lang('lang.phone')</th>
            <th class="text-center">@lang('lang.payment_method')</th>
            <th class="text-center">@lang('lang.note')</th>
            <th class="text-center">@lang('lang.address')</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @php $shipping = $order->shipping; @endphp
            <td class="text-center text-muted">{{$shipping->name}}</td>
            <td class="text-center text-muted">{{$shipping->email}}</td>
            <td class="text-center text-muted">{{ Str::limit($shipping->phone, 4)}}</td>
            <td class="text-center text-muted">
              @if($shipping->method == 0)
              @lang('lang.cash')
              @elseif($shipping->method == 1)
              VN Pay
              @elseif($shipping->method == 2)
              Momo
              @endif
            </td>
            <td class="text-center text-muted">{{$shipping->note}}</td>
            <td class="text-center text-muted">{{$shipping->address}}</td>

          </tr>
        </tbody>
      </table>
    </div>

    <div class="card-header mt-3"><p class="title-order text-center" >@lang('lang.product_order')</p></div>
    <div class="table-responsive" style="padding-bottom: 10px;">
      <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
          <tr>
            <th class="text-center">STT</th>
            <th class="text-center">@lang('lang.product_name')</th>
            <th class="text-center">@lang('lang.price')</th>
            <th class="text-center">@lang('lang.quantity')</th>
            <th class="text-center">@lang('lang.total_money')</th>
            <th class="text-center">@lang('lang.time')</th>
          </tr>
        </thead>
        <tbody>
          @php $products = $order->orderDetails; $i= 1; @endphp
          @foreach($products as $product)
          <tr>
            <td class="text-center text-muted">@php echo $i; $i++; @endphp</td>
            <td class="text-center text-muted">{{$product->product_name}}</td>
            <td class="text-center text-muted">{{ number_format($product->product_price, 0, ',', '.') . ' VND' }}</td>
            <td class="text-center text-muted">{{$product->product_quantity}}</td>
            <td class="text-center text-muted">{{ number_format($product->total_price, 0, ',', '.') . ' VND' }}</td>
            <td class="text-center text-muted">{{$product->created_at}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="card-header mt-3" class="title-order" ><p  class="title-order text-center">@lang('lang.checkout')</p></div>
    <div class="table-responsive" style="padding-bottom: 10px;">
      <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
          <tr>
            <th class="text-center">@lang('lang.total')</th>
            @if($order->coupon_code != "NO")
            <th class="text-center">@lang('lang.discout')</th>
            @endif
            <th class="text-center">@lang('lang.feeship')</th>
            <th class="text-center">@lang('lang.money_checkout')</th>
            <th class="text-center">@lang('lang.print_order')</th>
          </tr>
        </thead>
        <tbody>
          @php
          $coupon = 0;
          $total = $order->total_order;
          @endphp

          @if($order->feeship_id != "NO")
          @php $feeship = $order->feeship->feeship; @endphp
          @else
          @php $feeship = 25000; @endphp
          @endif

          @if($order->coupon_code != "NO")
          @php $coupon = $total * ($order->coupon->percent/100); @endphp
          @endif

          <tr>
            <td class="text-center text-muted">{{ number_format($total, 0, ',', '.') . ' VND' }}</td>
            @if($order->coupon_code != "NO")
            <td class="text-center text-muted">{{ number_format($coupon, 0, ',', '.') . ' VND' }}</td>
            @endif
            <td class="text-center text-muted">{{ number_format($feeship, 0, ',', '.') . ' VND' }}</td>
            <td class="text-center text-muted" style=" color: #B5292F !important;" >{{ number_format($total + $feeship - $coupon, 0, ',', '.') . ' VND' }}</td>
            <td class="text-center"><a class="printOrder" href="{{route('order.print', $order->code)}}">@lang('lang.print_order')</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

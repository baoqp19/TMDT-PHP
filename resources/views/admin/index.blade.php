@extends('admin.layouts.master')
@section('title', 'MW Store | Trang quản trị')
@section('title_page', 'Trang chủ')
@section('sub_title_page', 'Trang chủ quản trị')

@section('ContentPage')
<div class="row">
    <div class="col-12">
        <div class="index-home">
            <h3 class="text-center">Xin chào <b style="color: #B5292F" >{{Auth::guard('admin')->user()->name}}</b> đến với trang quản trị của <b  style="color: #B5292F" >MW Store</b></h3>
        </div>
    </div>
</div>
@endsection

@extends('user.layouts.master')
@section('title', 'MW Store | Liên hệ')

@section('ContentPage')

<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('home.index')}}">@lang('lang.home')</a></li>
                <li class="active"><a href="{{route('contact.index')}}">@lang('lang.contact')</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="contact-area ptb-60 ptb-sm-60">
    <div class="container">
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d245428.9873290105!2d108.32355716398558!3d16.022470568584687!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4sIMSQ4bqhaSBo4buNYyDEkMOgIE7hurVuZw!5e0!3m2!1svi!2s!4v1729523546093!5m2!1svi!2s" width="800" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <h3 class="info-info">@lang('lang.contact')</h3>
        <div class="info-contact">
            <div class="item-contact"><i class="fas fa-map-marked-alt"></i> @lang('lang.address'): 470 Đ. Trần Đại Nghĩa, Hoà Hải, Ngũ Hành Sơn, Đà Nẵng 550000, Việt Nam </div>
            <div class="item-contact"><i class="fas fa-mobile-alt"></i> @lang('lang.phone'): 123.456.7898</div>
            <div class="item-contact"><i class="fas fa-envelope"></i> Email: baoqp.23it@vku.udn.vn</div>
            <div class="item-contact"><i class="fab fa-facebook-f"></i> Facebook: fb.com/vku.danang</div>
        </div>
    </div>
</div>
@endsection

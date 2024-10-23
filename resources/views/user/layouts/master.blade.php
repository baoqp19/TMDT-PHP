@include('user.inc.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@yield('ContentPage')
@include('user.inc.footer') 
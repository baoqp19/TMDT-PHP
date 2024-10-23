<!doctype html>
<html lang="vn">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="@yield('canonical')" />
    <meta name="description" content="@yield('meta_desc')">
    <meta name="robots" content="INDEX,FOLLOW" />

    <meta property="og:site_name" content="{{url()->current()}}" />
    <meta property="og:image" content="@yield('img_og')" />
    <meta property="og:title" content="@yield('title_og')" />
    <meta property="og:description" content="@yield('desc_og')" />
    <meta property="og:url" content="@yield('canonical')" />
    <meta property="og:type" content="website" />
    



    {{-- B5292F: red --}}
    {{-- B5292F: cam --}}
    <link rel="shortcut icon" href="{{asset('users/img/favicon.ico')}}">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <!-- Ionicons css -->
    <link rel="stylesheet" href="{{asset('users/css/ionicons.min.css')}}" rel="stylesheet">
    <!-- linearicons css -->
    <link rel="stylesheet" href="{{asset('users/css/linearicons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('users/css/css.css')}}" rel="stylesheet">
    <!-- Nice select css -->
    <link rel="stylesheet" href="{{asset('users/css/nice-select.css')}}" rel="stylesheet">
    <!-- Jquery fancybox css -->
    <link rel="stylesheet" href="{{asset('users/css/jquery.fancybox.css')}}" rel="stylesheet">
    <!-- Jquery ui price slider css -->
    <link rel="stylesheet" href="{{asset('users/css/jquery-ui.min.css')}}" rel="stylesheet">
    <!-- Meanmenu css -->
    <link rel="stylesheet" href="{{asset('users/css/meanmenu.min.css')}}" rel="stylesheet">
    <!-- Nivo slider css -->
    <link rel="stylesheet" href="{{asset('users/css/nivo-slider.css')}}" rel="stylesheet">
    <!-- Owl carousel css -->
    <link rel="stylesheet" href="{{asset('users/css/owl.carousel.min.css')}}" rel="stylesheet">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{asset('users/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom css -->
    <link rel="stylesheet" href="{{asset('users/css/default.css')}}" rel="stylesheet">
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('users/css/style.css')}}" rel="stylesheet">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{asset('users/css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('users/css/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('users/css/sweetalert.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('users/css/custom-style.css')}}" rel="stylesheet">


    @stack('styles')
    <style>
        .header-full{
            
        }

        .header-bottom-list .active:hover{
            color: #B5292F !important;
        }

        .header-bottom-list .active {
            color: #B5292F; /* Màu khi có class active */
        }

        .header-bottom-list li:hover {
            color: inherit; /* Giữ nguyên màu khi hover nếu không có class active */
        }
        ::placeholder{
            color: #333;
        }

        .name{
            cursor: pointer !important; 
            font-weight: 500 !important;

        }
    </style>
</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0" nonce="ALfKIHiv"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="vxvABfyp"></script>

    <div class="wrapper">
        <header class="header-full" >
            <div class="header-middle ptb-15">
                <div class="container">
                    <div class="row align-items-center no-gutters">
                        
                        {{-- Main Logo --}}
                        <div class="col-lg-3 col-md-12">
                            <div class="logo mb-all-30 ">
                                <a href="{{route('home.index')}}"><img src="{{asset('users/img/onlineShop.png')}}" alt="logo-image" style="width: 120px;"></a>
                            </div>
                        </div>

                        {{-- Form Search --}}
                        <div class="col-lg-5 col-md-8 ml-auto mr-auto col-10">
                            <div class="categorie-search-box">
                                <form id="form-search" action="{{route('search')}}" method="POST">
                                    @csrf
                                    <input type="text" name="keyword" id="keyword" style="font-family: Popppins, sans-serif;" placeholder="@lang('lang.search')...">
                                    <div id="search-live">
                                    </div>
                                    <button style="color: #B5292F;" type="submit"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16 fa-fw">
                                            <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" class=""></path>
                                    </svg></button>
                                </form>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-12">
                            <div class="cart-box mt-all-30">
                                <ul class="d-flex justify-content-lg-end justify-content-center align-items-center">
                                    
                                    {{-- Cart --}}
                                    <li>
                                        <a href="{{route('cart.index')}}"><i class="fas fa-shopping-basket" style="color: #B5292F;" ></i><span class="my-cart"><span class="total-pro">
                                                    @if(Auth::check())
                                                    {{count(Auth::user()->carts)}}
                                                    @else
                                                    0
                                                    @endif
                                                </span><span style="font-family: Baloo, sans-serif; color: #B5292F;">@lang('lang.cart')</span></span>
                                        </a>
                                        @auth
                                        @php $carts = Auth::user()->carts; @endphp
                                        @if(count($carts))
                                        <ul class="ht-dropdown cart-box-width">
                                            <li>
                                                @php $total = 0; @endphp
                                                @foreach($carts as $cart)
                                                @php $total += $cart->price() ; @endphp
                                                <div class="single-cart-box">
                                                    <div class="cart-img">
                                                        <a href="{{route('product.detail', $cart->product->id)}}"><img style="height: 78px; width: 78px; object-fit: cover;" src="{{asset('admins/uploads/products/'.$cart->product->image)}}" alt="cart-image"></a>
                                                        <span class="pro-quantity">{{$cart->quantity}}</span>
                                                    </div>
                                                    <div class="cart-content">
                                                        <h6><a href="{{route('product.detail', $cart->product->id)}}">{{$cart->getName()}}</a></h6>
                                                        <span class="cart-price">@money($cart->getPrice())</span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="cart-footer">
                                                    <ul class="price-content">
                                                        <li>@lang('lang.total')<span>@money($total)</span></li>
                                                    </ul>
                                                    <div class="cart-actions text-center">
                                                        <a class="cart-checkout" href="{{route('checkout.index')}}">@lang('lang.checkout')</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        @endif
                                        @endauth
                                    </li>
                                    <li>
                                        @if(Auth::check())
                                        {{-- Hiển thị tên và  --}}
                                        <div class="logout-user">
                                            <img class="avatar-user align-middle" src="{{asset('admins/uploads/avatars/'.Auth::user()->image)}}" alt="">
                                            <span class="fullname-user align-middle">
                                                <?php
                                                $name = Auth::user()->name; // Lấy tên của người dùng
                                                $nameParts = explode(' ', $name); // Tách tên thành các từ
                                            
                                                // Lấy 2 từ cuối cùng
                                                $lastTwoWords = array_slice($nameParts, -2, 2);
                                            
                                                // Chuyển đổi mỗi từ thành chữ hoa đầu tiên
                                                $formattedName = array_map('ucfirst', $lastTwoWords);
                                            
                                                // Nối lại thành chuỗi
                                                echo implode(' ', $formattedName);
                                            ?><i class="fas fa-angle-down"></i></span>

                                            <ul class="ht-dropdown dropdown-style-two" style="width: 200px;">
                                                <li class="list-group-item list-group-item-action" style="border: none;"><a href="{{route('user.register')}}" style="color: #212529;">@lang('lang.signout')</a></li>
                                                <li class="list-group-item list-group-item-action" style="border: none;"><a href="{{route('user.index')}}" style="color: #212529;">@lang('lang.user_info')</a></li>
                                            </ul>
                                        </div>
                                        @else
                                        {{-- Icon Login Resigtor --}}
                                        <a href="#" class="align-middle">
                                            <i style="color:  #B5292F; font-size: 25px;" class="fa-light fa-user"></i>
                                            <div class="my-cart align-middle">
                                            </p>
                                                 <a href="{{route('user.login')}}" style="cursor:pointer; color: black;  font-family:  Poppins, sans-serif;">@lang('lang.signup')</a>
                                             </p>
                                               <p>
                                                    <a href="{{route('user.register')}}" style="cursor:pointer; color: black;  font-family:  Poppins, sans-serif;">@lang('lang.signin')</a>
                                                <p>
                                            </div>
                                        </a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="header-bottom  header-sticky mb-30">
                <div class="container">
                    <div class="row align-items-center"" >
                        <div class="col-xl-3 col-lg-4 col-md-6" ></div>

                        <div class="col-xl-7 col-lg-8 col-md-12 ">
                            {{-- MENU LAPTOP --}}
                            <nav class="d-none d-lg-block" >
                                <ul class="header-bottom-list d-flex">
                                    <li class="active"><a class="name" href="{{route('home.index')}}">@lang('lang.home')</a></li>
                                    <li class=""><a class="name" href="{{route('cart.index')}}">@lang('lang.cart')</a></li>
                                    <li class=""><a class="name" href="{{route('order.index')}}">@lang('lang.order')</a></li>
                                    <li class=""><a class="name" href="{{route('contact.index')}}">@lang('lang.contact')</a></li>

                                    <li class="name"><a class="name" >@lang('lang.more')<i class="fa-solid fa-angle-down"></i></a>
                                        <ul class="ht-dropdown dropdown-style-two">
                                            <li><a class="name" href="{{route('news.index')}}">@lang('lang.news')</a></li>
                                            <li><a class="name" href="{{route('weather.index')}}">@lang('lang.weather')</a></li>
                                            <li><a class="name" href="{{route('music.index')}}">@lang('lang.music')</a></li>
                                            <li><a class="name" href="{{route('covid.index')}}">@lang('lang.covid')</a></li>
                                        </ul>
                                    </li>

                                    <li class="name" ><a class="name" >@lang('lang.language')<i class="fa-solid fa-angle-down"></i></a>
                                        <ul class="ht-dropdown dropdown-style-two">
                                            <li><a class="name" href="{{route('lang', 'vi')}}">@lang('lang.vi')</a></li>
                                            <li><a class="name" href="{{route('lang', 'en')}}">@lang('lang.en')</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>

                            {{-- MENU MOBILE --}}
                            <div class="mobile-menu d-block d-lg-none">
                                <nav>
                                    <ul>
                                        <li class="active name"><a href="{{route('home.index')}}">@lang('lang.home')</a></li>
                                        <li><a href="{{route('cart.index')}}">@lang('lang.cart')</a></li>
                                        <li><a href="{{route('order.index')}}">@lang('lang.order')</a></li>
                                        <li><a href="{{route('contact.index')}}">@lang('lang.contact')</a></li>


                                        <li><a>@lang('lang.more')<i class="fa-solid fa-angle-down"></i></a>
                                            <ul class="ht-dropdown dropdown-style-two">
                                                <li><a href="{{route('news.index')}}">@lang('lang.news')</a></li>
                                                <li><a href="{{route('weather.index')}}">@lang('lang.weather')</a></li>
                                                <li><a href="{{route('music.index')}}">@lang('lang.music')</a></li>
                                                <li><a href="{{route('covid.index')}}">@lang('lang.covid')</a></li>
                                            </ul>
                                        </li>

                                        {{-- Ngôn ngữ --}}
                                        <li><a>@lang('lang.language')<i class="fa-solid fa-angle-down"></i></a>
                                            <ul class="ht-dropdown dropdown-style-two">
                                                <li><a href="{{route('lang', 'vi')}}">@lang('lang.vi')</a></li>
                                                <li><a href="{{route('lang', 'en')}}">@lang('lang.en')</a></li>
                                            </ul>
                                        </li>


                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </header>
    </div>
    @stack('scripts')

    <script src="{{asset('users/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('users/js/axios.js')}}"></script>
    <script src="{{asset('users/js/moment.js')}}"></script>
    <script src="{{asset('users/js/bootstrap.bundle.min.js')}}" ></script>
</body>

</html>
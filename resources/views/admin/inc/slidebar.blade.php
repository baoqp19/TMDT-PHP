
<div class="app-sidebar sidebar-shadow">

    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                   
                </span>
            </button>
        </span>
    </div>

    <!-- sidebar start -->
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">

                <li style="color: #B5292F "  class="app-sidebar__heading">Trang chủ</li>
                <li>
                    <a style= href="{{route('admin.index')}}" class="mm-active">
                        <i style=""  class="fa-solid fa-house"></i>
                        &nbsp; Trang chủ
                    </a>
                </li>

                <li style="color: #B5292F "  class="app-sidebar__heading">Admin & Phân Quyền</li>
                @can('ADMIN')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Admin</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.add')}}">
                                <i style="font-size: 17px;" class="fa-sharp-duotone fa-solid fa-plus"></i>
                                <span style="margin-left: 3px;">Thêm Admin</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.list')}}">
                                <i style="margin-right: 3px;" class="fa-regular fa-list-ul"></i>
                                <span style="padding-right: 2px;"> Danh sách Admin</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('ROLE')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                             <div class="d-flex justify-content-between align-items-center" >
                                <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                 <span style= >Vai trò</span>
                             </div>
                            <i class="fa-thin fa-caret-down"></i>
                        </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('role.create')}}">
                                <i style="font-size: 17px;" class="fa-sharp-duotone fa-solid fa-plus"></i>
                                <span style="margin-left: 3px;" >Thêm vai trò</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('role.index')}}">
                                <i style="margin-right: 3px;" class="fa-regular fa-list-ul"></i>
                                <span style="margin-left: 3px;" >Danh sách vai trò</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endcan
                <li style="color: #B5292F " class="app-sidebar__heading">Tính Năng Quản Trị</li>
                @can('BRAND')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style=>Thương hiệu</span>
                            </div>
                            <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('brand.create')}}">
                                <i style="font-size: 17px;" class="fa-sharp-duotone fa-solid fa-plus"></i>
                                <span style="margin-left: 3px;" >Thêm thương hiệu</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('brand.index')}}">
                                <i style="margin-right: 3px;" class="fa-regular fa-list-ul"></i>
                                <span style="margin-left: 3px;" >Danh sách thương hiệu</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('PRODUCT')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Sản phẩm</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('product.create')}}">
                                <i style="font-size: 17px;" class="fa-sharp-duotone fa-solid fa-plus"></i>
                                Thêm sản phẩm
                            </a>
                        </li>
                        <li>
                            <a href="{{route('product.index')}}">
                                <i style="margin-right: 3px;" class="fa-regular fa-list-ul"></i>
                                <span style="margin-left: 3px;" >Danh sách sản phẩm</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('product.reference')}}">
                                <i class="fa-regular fa-asterisk"></i>
                                <span style="margin-left: 3px;" >Tham khảo sản phẩm</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('POST')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Bài viết</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('post.create')}}">
                                <i style="font-size: 17px;" class="fa-sharp-duotone fa-solid fa-plus"></i>
                                <span style="margin-left: 3px;" >Thêm bài viết</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('post.index')}}">
                                <i style="margin-right: 3px;" class="fa-regular fa-list-ul"></i>
                                <span style="margin-left: 3px;" >Danh sách bài viết</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('SLIDER')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Slider</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('slider.create')}}">
                                <i style="font-size: 17px;" class="fa-sharp-duotone fa-solid fa-plus"></i>
                                <span style="margin-left: 3px;" >Thêm Slider</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('slider.index')}}">
                                <i style="margin-right: 3px;" class="fa-regular fa-list-ul"></i>
                                <span style="margin-left: 3px;" >Danh sách Slider</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('COUPON')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Giảm giá</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('coupon.create')}}">
                                <i style="font-size: 17px;" class="fa-sharp-duotone fa-solid fa-plus"></i>
                                <span style="margin-left: 3px;" >Thêm mã giảm giá</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('coupon.index')}}">
                                <i style="margin-right: 3px;" class="fa-regular fa-list-ul"></i>
                                <span style="margin-left: 3px;" >Danh sách mã giảm giá</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('ORDER')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Mua hàng</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('order.manage')}}">
                                <i style="margin-right: 3px;" class="fa-regular fa-list-ul"></i>
                                <span style="margin-left: 3px;" >Danh sách mua hàng</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
               
                @can('USER')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Người dùng</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('user.online')}}">
                                <i style="" class="fa-thin fa-head-side-headphones"></i>
                                <span style="margin-left: 3px;" >Người dùng online</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('user.list')}}">
                                <i style="margin-right: 3px;" class="fa-regular fa-list-ul"></i>
                                <span style="margin-left: 3px;" >Tất cả người dùng</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('COMMENT')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Bình luận</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('comment.not_confirm')}}">
                                <i class="fa-light fa-comment"></i>
                                <span style="margin-left: 3px;" >Bình luật phê duyệt</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('comment.index')}}">
                                <i class="fa-thin fa-comments"></i>
                                <span style="margin-left: 3px;" >Tất cả bình luật</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('INFO')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Thông tin</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('device.admin')}}">
                                <i class="fa-thin fa-circle-info"></i>
                                <span style="margin-left: 3px;" >Thông tin thiết bị</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('visitor.index')}}">
                                <i class="fa-light fa-computer-speaker"></i>
                                <span style="margin-left: 3px;" >Thiết bị truy cập</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('STATISTIC')
                <li>
                    <a href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center" >
                               <i style="margin-right: 12px;" class="fa-thin fa-sliders"></i>
                                <span style= >Thống kê</span>
                            </div>
                           <i class="fa-thin fa-caret-down"></i>
                       </div>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('static.index')}}">
                                <i class="fa-thin fa-chart-simple"></i>
                                 <span style="margin-left: 3px;" >Tổng quan</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
        </div>
    </div>
</div>

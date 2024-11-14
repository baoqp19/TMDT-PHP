@extends('user.layouts.master')
@section('title', 'Đơn hàng')

@push('styles')
    <style>
        .container-span-icon{
            margin-right: 5px;
        }

        .link-icon{
            background-color: #c9c2bf;
            border-radius: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right: 15px;
            padding-left: 15px;
            
        }
        
        .link-icon-1{
            background-color: #B5292F !important;
            border-radius: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-right: 15px;
            padding-left: 15px;
        }
        .link-icon-1 i{
            color: #f7f6f5;
        }
        .link-icon i {
            font-size: 14px;
            color: #333;
        }
        .confirmButton{
            margin-right: 7px;
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
        <div class="row">
            @if(count($orders))
            <div class="col-md-12">
                <div class="box-both">
                    <table class="table" style=" width: 100%;">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="">@lang('lang.name')</th>
                                <th class="text-center">@lang('lang.time')</th>
                                <th class="text-center">@lang('lang.status')</th>
                                <th class="text-center">@lang('lang.more')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($orders as $order)
                            <tr>
                                <td class="text-center text-muted">@php echo $i; $i++; @endphp</td>
                                <td class="text-center text-muted">{{$order->user->name}}</td>
                                <td class="text-center text-muted">{{$order->created_at}}</td>
                                <td class="text-center text-muted">
                                    @if($order->status == 1)
                                    @lang('lang.not_confirm')
                                    @else
                                    @lang('lang.deliveryed')
                                    @endif
                                </td>
                                <td class="text-center text-muted">
                                    @if($order->status == 2)
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span class="container-span-icon" >
                                            <a class="link-icon" class="icon-edit" href="{{route('order.show', $order->id)}}" class="">
                                                <i class="fa-light fa-pen-to-square"></i>
                                            </a>
                                        </span>
                                        <span>
                                            <a href="javascript:void(0);" onclick="confirmDelete('{{ route('order.delete', $order->id) }}')" class="link-icon-1 btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </span>
                                     </div>
                                     @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="text-center text-noti" style="margin: 0 auto;">@lang('lang.no_order')</div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger confirmButton"
        },
        buttonsStyling: false
    });

    function confirmDelete(url) {
        swalWithBootstrapButtons.fire({
            title: "Bạn có chắc chắn?",
            text: "Bạn sẽ không thể hoàn tác hành động này!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Có, xóa nó!",
            cancelButtonText: "Không, hủy!",
            reverseButtons: true,
            background: "#fff"
        }).then((result) => {
            if (result.isConfirmed) {
                // Nếu người dùng xác nhận xóa, điều hướng đến URL để thực hiện hành động xóa
            
                swalWithBootstrapButtons.fire({
                    title: "Đã xóa!",
                    text: "Dữ liệu của bạn đã được xóa.",
                    icon: "success",
                    background: "#fff"

                });

                setTimeout(() => {
                    window.location.href = url;
                }, 1000); // Thay đổi thời gian ở đây nếu cần

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Đã hủy",
                    text: "Dữ liệu của bạn an toàn!",
                    icon: "error",
                    background: "#fff"
                });
            }
        });
    }
    </script>
@endpush

@endsection

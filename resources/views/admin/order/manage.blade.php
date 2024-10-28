@extends('admin.layouts.master')
@section('title', 'Đơn hàng')
@section('title_page', 'Đơn hàng')
@section('sub_title_page', 'Danh sách đơn hàng')

@section('ContentPage')

@push('styles')
    <style>
        .confirmButton{
            margin-left: 7px;
        }
    </style>
@endpush

<div class="card-header">Danh sách đơn hàng</div>
<div class="table-responsive" style="padding-bottom: 10px;">
    @if(count($orders))
    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="">Tên khách hàng</th>
                <th class="text-center">Thời gian</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Tính năng</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($orders as $order)
            <tr>
                <td class="text-center text-muted">@php echo $i; $i++; @endphp</td>
                <td>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="widget-content-left">
                                    <img class="rounded-circle border-circle" src="{{asset('admins/uploads/avatars/'.$order->user->image)}}" alt="">
                                </div>
                            </div>
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">{{$order->user->name}}</div>
                                <div class="widget-subheading opacity-7">{{$order->user->status}}</div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center text-muted">{{$order->created_at}}</td>
                <td class="text-center text-muted">
                    @if($order->status ==1 )
                    Đơn hàng đang chờ xử lý
                    @else
                    Đã xử lý
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="container-span-icon" >
                            <a class="link-icon" class="icon-edit" href="{{route('order.admin_detail', $order->id)}}" class="">
                                <i class="fa-thin fa-circle-info"></i>
                            </a>
                        </span>
                        <span>
                            <a href="javascript:void(0);" onclick="confirmDelete('{{ route('order.admin_delete', $order->id) }}')" class="link-icon-1 btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                        </span>
                     </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="text-center text-noti">Không có đơn hàng nào để hiển thị</div>
    @endif
</div>

@push('scripts')
<script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
            confirmButton: "btn btn-success confirmButton",
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

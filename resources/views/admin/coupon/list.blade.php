@extends('admin.layouts.master')
@section('title', 'Danh sách mã giảm giá')
@section('title_page', 'Danh sách mã giảm giá')
@section('sub_title_page', 'Danh sách mã giảm giá')


<div class="modal fade" id="modal-coupon" style="display: none;" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content model-send-coupon" role="document">
            <div class="card-header d-flex justify-content-between align-items-center">Danh sách người dùng <div style="cursor: pointer; font-size: 17px;" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
            <div class="table-responsive" style="padding-bottom: 10px;">
                @if(count($users))
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Tên khách hàng</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Tính năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($users as $user)
                        <tr>
                            <td class="text-center text-muted">
                                <?php echo $i;
                                $i++;
                                ?>
                            </td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left <?php if ($user->isOnline()) {
                                                                                echo "user-on";
                                                                            } ?>" style="position: relative;">
                                                <img class="rounded-circle border-circle" src="{{asset('admins/uploads/avatars/'.$user->image)}}" alt="">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">{{$user->name}}</div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="text-center text-muted">{{$user->email}}</td>

                            <td class="text-center">
                                <button data-id="{{$user->id}}" class="btn btn-success btn-sm send-to-user">Gửi mã</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="text-center text-noti">Không có người dùng nào để hiển thị</div>
                @endif
            </div>
        </div>
    </div>
</div>

@section('ContentPage')

@push('styles')
    <style>
        .confirmButton{
            margin-left: 7px;
        }
    </style>
@endpush

<div class="card-header">Danh sách mã giảm giá</div>
<div class="table-responsive" style="padding-bottom: 10px;">
    @if(count($coupons) > 0)
    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th>Tên mã giảm giá</th>
                <th class="text-center">Mã mã giảm giá</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center">Phần trăm giảm giá</th>
                <th class="text-center">Ngày bắt đầu</th>
                <th class="text-center">Ngày kết thúc</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center">Tính năng</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($coupons as $coupon)
            <tr>
                <td class="text-center text-muted">
                    <?php
                    echo $i;
                    $i++;
                    ?></td>
                <td class="text-center text-muted">{{$coupon->name}}</td>
                <td class="text-center text-muted">{{$coupon->code}}</td>
                <td class="text-center text-muted">{{$coupon->quantity}} Mã</td>
                <td class="text-center text-muted">{{$coupon->percent}}%</td>
                @php
                    $startCoupon = \Carbon\Carbon::parse($coupon->start_coupon)->format('d/m/Y');
                @endphp
                <td class="text-center text-muted">{{$startCoupon}}</td>
                @php
                    $endCoupon = \Carbon\Carbon::parse($coupon->end_coupon)->format('d/m/Y');
                @endphp

                <td class="text-center text-muted">{{$endCoupon}}</td>
                <td class="text-center text-muted">
                    @php
                        $todayDate = \Carbon\Carbon::now('Asia/Ho_Chi_Minh');
                    @endphp
                    @if($coupon->end_coupon >= $todayDate)
                    Còn hạn
                    @else
                    Hết hạn
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span>
                            <button style="border-radius: 10px; margin-right: 4px;" data-toggle="modal" data-target="#modal-coupon" data-id="{{$coupon->code}}" class="btn btn-success btn-sm send-coupon"><i style="padding: 5px; margin-left: 3px; margin-right: 3px;" class="fa-thin fa-paper-plane-top"></i></button>
                        </span>
                        <span class="container-span-icon">
                            <a href="{{ route('coupon.edit', $coupon->id) }}" class="link-icon icon-edit">
                                <i class="fa-light fa-pen-to-square"></i>
                            </a>
                        </span>
                        <span>
                            <form class="link-icon-1" action="{{ route('coupon.destroy', $coupon->id) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete('{{ route('coupon.destroy', $coupon->id) }}',this);">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon">
                                    <i style="padding: 2px;" class="fa-light fa-trash"></i>
                                </button>
                            </form>
                        </span>
                        
                    </div>
                 </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="text-center text-noti">Không có mã giảm giá nào để hiển thị</div>
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

    function confirmDelete(url, form) {
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
                // Hiển thị thông báo "Đã xóa!" trước khi gửi form
                swalWithBootstrapButtons.fire({
                    title: "Đã xóa!",
                    text: "Dữ liệu của bạn đã được xóa.",
                    icon: "success",
                    background: "#fff"
                });

                // Gửi form sau 1 giây (1000 milliseconds)
                setTimeout(() => {
                    form.submit(); // Gửi form để thực hiện yêu cầu DELETE
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

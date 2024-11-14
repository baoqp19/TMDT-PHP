@extends('admin.layouts.master')
@section('title', 'Danh sách slider')
@section('title_page', 'Danh sách slider')
@section('sub_title_page', 'Danh sách slider')

@section('ContentPage')
@push('styles')
    <style>
         .confirmButton{
           margin-left: 7px;
        }
    </style>
@endpush
<div class="card-header">Danh sách slider</div>
<div class="table-responsive" style="padding-bottom: 10px;">
    @if(count($sliders) > 0)
    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th>Tên slider</th>
                <th class="text-center">Hiện/ Ẩn</th>
                <th class="text-center">Tính năng</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($sliders as $slider)
            <tr>
                <td class="text-center text-muted">
                    <?php
                    echo $i;
                    $i++;
                    ?></td>
                <td>
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="widget-content-left">
                                    <img class="border-circle" src="{{asset('admins/uploads/sliders/'.$slider->image)}}" alt="">
                                </div>
                            </div>
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">{{$slider->name}}</div>
                                <div class="widget-subheading opacity-7"></div>
                            </div>
                        </div>
                    </div>
                </td>

                <td class="text-center text-muted">
                    @if($slider->show_hide == 1)
                    Hiển thị
                    @else
                    Ẩn
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="container-span-icon">
                            <a href="{{ route('slider.edit', $slider->id) }}" class="link-icon icon-edit">
                                <i class="fa-light fa-pen-to-square"></i>
                            </a>
                        </span>
                        <span>
                            <form class="link-icon-1" action="{{ route('slider.destroy', $slider->id) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete('{{ route('slider.destroy', $slider->id) }}', this);">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon">
                                    <i class="fa-light fa-trash"></i>
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
    <div class="text-center text-noti">Không có slider nào để hiển thị</div>
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

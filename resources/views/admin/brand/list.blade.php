@extends('admin.layouts.master')
@section('title', 'Danh sách thương hiệu sản phẩm')
@section('title_page', 'Thương hiệu')
@section('sub_title_page', 'Danh sách thương hiệu')

@section('ContentPage')
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
        .link-icon-1 button {
        cursor: pointer;
           border: none;
           background: #B5292F;
           color: #fff;
        }
        .link-icon i {
            font-size: 14px;
            color: #333;
        }
        .confirmButton{
           margin-left: 7px;
        }

    </style>
@endpush;
<div class="card-header">Danh sách thương hiệu</div>
<div class="table-responsive" style="padding-bottom: 10px;">
    @if(count($brands) > 0)
    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Tên thương hiệu</th>
                <th class="text-center">Description</th>
                <th class="text-center">Tính năng</th>
            </tr>
        </thead>
        <tbody id="brand-list">
            <?php $i = 1; ?>
            @foreach ($brands as $brand)
            <tr id="{{$brand->id}}">
                <td class="text-center text-muted">
                    <?php
                    echo $i;
                    $i++;
                    ?>
                </td>
                <td class="text-center">
                    <div class="widget-heading">{{$brand->name}}</div>
                    <div class="widget-subheading opacity-7">{{$brand->description}}</div>
                    
                </td>
                <td class="text-center">
                    <div class="widget-subheading opacity-7">{{$brand->description}}</div>
                </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="container-span-icon">
                                <a href="{{ route('brand.edit', $brand->id) }}" class="link-icon icon-edit">
                                    <i class="fa-light fa-pen-to-square"></i>
                                </a>
                            </span>
                            <span>
                                <form class="link-icon-1" action="{{ route('brand.destroy', $brand->id) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete('{{ route('brand.destroy', $brand->id) }}', this);">
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
    <div class="text-center text-noti">Không có thương hiệu nào để hiển thị</div>
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

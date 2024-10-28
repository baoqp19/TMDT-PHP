@extends('admin.layouts.master')
@section('title', 'Danh sách sản phẩm')
@section('title_page', 'Sản phẩm')
@section('sub_title_page', 'Danh sách sản phẩm')

@section('ContentPage')

@push('styles')
    <style>
        .confirmButton{
            margin-left: 7px;
        }
    </style>
@endpush
<div class="card-header">Danh sách sản phẩm</div>
<div class="table-responsive" style="padding-bottom: 10px;">
    @if(count($products))
    <table id="product-table" class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th>Tên sản phẩm</th>
                <th class="text-center">Giá</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center">Thương hiệu</th>
                <th class="text-center">Nổi bật</th>
                <th class="text-center">Tính năng</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($products as $product)
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
                                    <img class="border-circle" src="{{asset('admins/uploads/products/'.$product->image)}}" alt="">
                                </div>
                            </div>
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">{{$product->name}}</div>
                                <div class="widget-subheading opacity-7">{{ Str::limit($product->description, 40) }}</div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center text-muted">@money($product->price)</td>
                <td class="text-center text-muted">{{$product->quantity}}</td>
                <td class="text-center text-muted">{{$product->brand->name}}</td>
                <td class="text-center text-muted">
                    @if($product->feather == 1)
                    Nổi bật
                    @else
                    Không
                    @endif
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="container-span-icon">
                            <a href="{{ route('product.edit', $product->id) }}" class="link-icon icon-edit" title="Chỉnh sửa sản phẩm">
                                <i class="fa-light fa-pen-to-square"></i>
                            </a>
                        </span>
                        <span style="margin-right: 4px;">
                            <a style="border-radius: 10px; padding-right: 14px; padding-left: 14px;" href="{{ route('product.gallery', $product->id) }}" class="btn btn-info btn-sm" title="Xem ảnh sản phẩm">
                                <i class="fa-thin fa-images"></i>
                            </a>
                        </span>
                        <span>
                            <form class="link-icon-1" action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete('{{ route('product.destroy', $product->id) }}', this);">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon" title="Xóa sản phẩm">
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
    <div class="text-center text-noti">Không có sản phẩm nào để hiển thị</div>
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

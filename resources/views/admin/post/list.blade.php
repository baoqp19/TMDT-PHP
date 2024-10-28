@extends('admin.layouts.master')
@section('title', 'Danh sách bài viết')
@section('title_page', 'Danh sách bài viết')
@section('sub_title_page', 'Danh sách bài viết')


@section('ContentPage')

@push('styles')
    <style>
        .confirmButton{
            margin-left: 7px;
        }
    </style>
@endpush

<div class="card-header">Danh sách bài viết</div>
<div class="table-responsive" style="padding-bottom: 10px;">
    @if(count($posts))
    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th>Tiêu đề</th>    
                <th class="text-center">Mô tả</th>
                <th class="text-center">Nội dung</th>
                <th class="text-center">Tính năng</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($posts as $post)
            <tr>
                <td class="text-center text-muted">
                    <?php
                    echo $i;
                    $i++;
                    ?>
                </td>

                <td class="text-center text-muted">{{$post->product->name}}</td>
                <td class="text-center text-muted">{{ Str::limit($post->title, 50) }} </td>
                <td class="text-center text-muted">{{ Str::limit($post->content, 50) }}</td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="container-span-icon">
                            <a href="{{ route('post.edit', $post->id) }}" class="link-icon icon-edit">
                                <i class="fa-light fa-pen-to-square"></i>
                            </a>
                        </span>
                        <span>
                            <form class="link-icon-1" action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="event.preventDefault(); confirmDelete('{{ route('post.destroy', $post->id) }}', this);">
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
    <div class="text-center text-noti">Không có bài viết nào để hiển thị</div>
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

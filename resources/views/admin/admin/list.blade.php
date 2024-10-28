@extends('admin.layouts.master')
@section('title', 'Danh sách admin')
@section('title_page', 'Danh sách admin')
@section('sub_title_page', 'Danh sách admin')

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

<div class="card-header">Danh sách admin</div>
<div class="table-responsive" style="padding-bottom: 10px;">
    @if(count($admins))

    <table class="align-middle mb-0 table table-borderless table-striped">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Tên admin</th>
                <th class="text-center">Email</th>
                <th class="text-center">Vai trò</th>
                <th class="text-center">Mô tả</th>
                <th class="text-center">Tính năng</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($admins as $admin)
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
                                <div class="widget-content-left" style="position: relative;">
                                    <img class="rounded-circle border-circle" src="{{asset('admins/img/avatars/'.$admin->image)}}" alt="">
                                </div>
                            </div>
                            <div class="widget-content-left flex2">
                                <div class="widget-heading">{{$admin->name}}</div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center text-muted">{{$admin->email}}</td>
                <td class="text-center text-muted">
                    @php $roles = $admin->roles; @endphp
                    @foreach($roles as $role)
                    {{$role->name}}
                    @endforeach
                </td>
                <td class="text-center text-muted">{{$admin->description}}</td>
                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="container-span-icon" >
                            <a class="link-icon" class="icon-edit" href="{{route('admin.edit', $admin->id)}}" class="">
                                <i class="fa-light fa-pen-to-square"></i>
                            </a>
                        </span>
                        <span>
                            <a href="javascript:void(0);" onclick="confirmDelete('{{ route('admin.delete', $admin->id) }}')" class="link-icon-1 btn btn-danger btn-sm">
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
    <div class="text-center text-noti">Không admin dùng nào để hiển thị</div>
    @endif
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

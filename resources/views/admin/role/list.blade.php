@extends('admin.layouts.master')
@section('title', 'Danh sách vai trò')
@section('title_page', 'Danh sách vai trò')
@section('sub_title_page', 'Danh sách vai trò')

@section('ContentPage')

<div class="card-header">Danh sách vai trò</div>
<div class="table-responsive" style="padding-bottom: 10px;">
    @if(count($roles) > 0)
    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Tên vai trò</th>
                <th class="text-center">Mô tả vai trò</th>
                <th class="text-center">Tính năng</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($roles as $role)
            <tr>
                <td class="text-center text-muted">
                    <?php
                    echo $i;
                    $i++;
                    ?>
                </td>
                <td class="text-center text-muted">{{$role->name}}</td>
                <td class="text-center text-muted">{{$role->description}}</td>

                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="container-span-icon">
                            <a href="{{route('role.edit', $role->id)}}" class="link-icon icon-edit">
                                <i class="fa-light fa-pen-to-square"></i>
                            </a>
                        </span>
                        <span>
                            <form class="link-icon-1" action="{{route('role.destroy', $role->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button style="" type="submit" class="btn-icon">
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
    <div class="text-center text-noti">Không có vai trò nào để hiển thị</div>
    @endif
</div>
@endsection

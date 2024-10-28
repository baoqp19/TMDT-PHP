<?php

use Illuminate\Support\Facades\File;

use Illuminate\Support\Str;

// vì nó không được định nghĩa trong phạm vi của controller. xuống composoer.json để thêm

function uploadImage($file, $position)
{
    // Đường dẫn lưu ảnh
    $path = 'admins/uploads/' . $position . '/';


    // Kiểm tra định dạng file
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_ext = $file->getClientOriginalExtension();

    if (!in_array(strtolower($file_ext), $allowedExtensions)) {
        throw new \Exception('File type is not supported');
    }

    // Tạo tên file duy nhất
    $img_name = Str::random(10) . time() . '.' . $file_ext;

    // Di chuyển file vào thư mục
    $file->move($path, $img_name);

    return $img_name;
}


function deleteImage($name_img, $position)
{
    $path = 'admins/uploads/' . $position . '/';
    if (File::exists($path . $name_img)) {
        File::delete($path . $name_img);
    };
}

function downloadImage($src, $position)
{
    $img_name =  substr(md5(time()), 0, 10) . rand(0, 99) . '.' . "png";
    $path = 'admins/uploads/' . $position . '/' . $img_name;
    file_put_contents($path, file_get_contents($src));
    return $img_name;
}

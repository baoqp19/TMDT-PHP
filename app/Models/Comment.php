<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'star',
        'comment',
    ];

    public function user()
    {
       // mỗi bình luận thuộc về một người dùng cụ thể.
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}

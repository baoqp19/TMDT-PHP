<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'product_id',
        'image'
    ];
    
    protected $table = 'gallerys';

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'brand_id');
    }

    public static function sort($brand_ids)
    {
        foreach ($brand_ids as $key =>  $brand_id) {
            // lấy brand_id gán cho id, và key gán cho brand_order => brand_id đứng trước thì key = 0,1,2,3......
            Brand::where('id', $brand_id)->update(['brand_order' =>  $key]);
        }
    }
}

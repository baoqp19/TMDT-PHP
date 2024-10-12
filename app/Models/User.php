<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     // các trường có thể gán giá trị khi create, update();
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'status',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'forgot_password',
    ];

    protected $table = 'users';
    public $remember_token = false;     // không sử dụng remember_me


    public function comments()
    {
        //  User có thể có nhiều Comment.
        //  Comment thuộc về một User.
        return $this->hasMany('App\Models\Comment', 'user_id');
    }

    
    public function activities()
    {
        return $this->hasMany('App\Models\Activity', 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'user_id');
    }

    public function device()
    {
        return $this->hasOne('App\Models\Device', 'user_id');
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart', 'user_id');
    }

    public function shippings()
    {
        return $this->hasMany('App\Models\Shipping', 'user_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'user_id');
    }


    // kiểm tra đang onlinle
    // bằng cách kiểm tra xem key trong Cache tồn tại hay không.
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    // lấy ra thông tin người dùng đang trực tuyến
    public static function userOnline()
    {
        $users = User::get(['id', 'name', 'image', 'phone', 'email', 'status', 'address']);

        $res = [];
        foreach ($users as $user) {
            if ($user->isOnline()) {
                $tmp = [];
                $tmp['id'] = $user->id;
                $tmp['name'] = $user->name;
                $tmp['image'] = $user->image;
                $tmp['phone'] = $user->phone;
                $tmp['email'] = $user->email;
                $tmp['status'] = $user->status;
                $tmp['address'] = $user->address;
                $res[] = $tmp;
            }
        }

        return $res;
    }

}

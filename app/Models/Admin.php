<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use  Notifiable, HasApiTokens;

    protected $table = 'admins';
    protected $guarded = ['admin'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        // Nhiều-Nhiều
        return $this->belongsToMany(Role::class);
    }
    

    public function checkPermissionAccess($pemission_check)
    {
        $admin = auth('admin')->user();
        if ($admin->role == config('role.FULL_PERMISSION')) return true;

        $roles = $admin->roles;

        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $pemission_check)) {
                return true;
            }
        }
    }
}

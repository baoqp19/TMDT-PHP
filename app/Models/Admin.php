<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'admins';
    protected $guarded = ['admin'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        // Nhiều-Nhiều
        return $this->belongsToMany(Role::class);
    }

    public function checkPermissionAccess($permission_check)
    {
        $admin = auth('admin')->user();
        if ($admin->role == config('role.FULL_PERMISSION')) return true;

        $roles = $admin->roles;

        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $permission_check)) {
                return true;
            }
        }
    }
}

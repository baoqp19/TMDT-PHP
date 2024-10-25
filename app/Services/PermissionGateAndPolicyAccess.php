<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess
{

    public function setGateAndPolicyAccess()
    {
        $this->defineGateAdmin();
    }

    public function defineGateAdmin()
    {
        Gate::define(config('role.ADMIN'), 'App\Policies\AdminPolicies@admin');
        Gate::define(config('role.ROLE'), 'App\Policies\AdminPolicies@role');
        Gate::define(config('role.BRAND'), 'App\Policies\AdminPolicies@brand');
        Gate::define(config('role.PRODUCT'), 'App\Policies\AdminPolicies@product');
        Gate::define(config('role.GALLERY'), 'App\Policies\AdminPolicies@gallery');
        Gate::define(config('role.POST'), 'App\Policies\AdminPolicies@post');
        Gate::define(config('role.SLIDER'), 'App\Policies\AdminPolicies@slider');
        Gate::define(config('role.COUPON'), 'App\Policies\AdminPolicies@coupon');
        Gate::define(config('role.ORDER'), 'App\Policies\AdminPolicies@order');
        Gate::define(config('role.FEESHIP'), 'App\Policies\AdminPolicies@feeship');
        Gate::define(config('role.USER'), 'App\Policies\AdminPolicies@user');
        Gate::define(config('role.NOTIFICATION'), 'App\Policies\AdminPolicies@notification');
        Gate::define(config('role.COMMENT'), 'App\Policies\AdminPolicies@comment');
        Gate::define(config('role.INFO'), 'App\Policies\AdminPolicies@info');
        Gate::define(config('role.STATISTIC'), 'App\Policies\AdminPolicies@static');
        Gate::define(config('role.VISITOR'), 'App\Policies\AdminPolicies@visitor');
    }
}

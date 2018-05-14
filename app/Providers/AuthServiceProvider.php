<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\AdminPermission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //启动的时候就会进来这里，所以才会有查表的情况
        $this->registerPolicies();
        
        
        $permissions = AdminPermission::all();
        //但是是怎么区分是前台还是后台的用户的？
        foreach($permissions as $permission){
            //定义了$gate
            Gate::define($permission->name, function ($user) use($permission){ //这是个闭包，要use
                return $user -> hasPermission($permission);
            });
            
        }
        
        // 
    }
}

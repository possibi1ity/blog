<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Topic;

//这个页面是每个页面都会经过的地方
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        \view()->composer('layout.sidebar', function ($view) {
            $topice = Topic::all();
            $view->with('topices',$topice);//其实这个$view对象就是调用view()的时候产生的?还是就是输出到view所有数据？好像也可以直接做一个服务容器类？
        });

        \DB::listen(function($query){
            $sql = $query->sql;
            $bindings = $query->bindings;
            $time = $query->time;
            if($time > 10){
                \Log::debug(var_export(compact('sql','bindings','time'),true));
            }
            

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

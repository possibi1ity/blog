<?php
Route::group(['prefix' => 'admin'], function () {
    // Route::get('/login',function(){
    //     return 'admin';
    // });
    Route::get('/','\App\Admin\Controllers\LoginController@index');
    Route::post('/login','\App\Admin\Controllers\LoginController@login');
    Route::get('/logout','\App\Admin\Controllers\LoginController@logout');

    Route::group(['middleware'=>'auth:admin'],function() {
        Route::get('/home','\App\Admin\Controllers\HomeController@index');

        Route::group(['middleware'=>'can:system'],function(){

            Route::get('/users','\App\Admin\Controllers\UserController@index'); //首页不写index?
            Route::get('/users/create','\App\Admin\Controllers\UserController@create');
            Route::post('/users/store','\App\Admin\Controllers\UserController@store');


        //用户角色
        Route::get('/users/{user}/role','\App\Admin\Controllers\UserController@role');
        Route::post('/users/{user}/role','\App\Admin\Controllers\UserController@roleStore'); //这个路由为什么用同名的？？

        //角色列表
        Route::get('/roles','\App\Admin\Controllers\RoleController@index');
        Route::get('/roles/create','\App\Admin\Controllers\RoleController@create');
        Route::post('/roles/store','\App\Admin\Controllers\RoleController@store');

        //角色权限
        Route::get('/roles/{role}/permission','\App\Admin\Controllers\RoleController@permission');
        Route::post('/roles/{role}/permission','\App\Admin\Controllers\RoleController@permissionStore');

        //权限列表
        Route::get('/permissions','\App\Admin\Controllers\PermissionController@index');
        Route::get('/permissions/create','\App\Admin\Controllers\PermissionController@create');
        Route::post('/permissions/store','\App\Admin\Controllers\PermissionController@store');

        });

        Route::group(['middleware'=>'can:post'],function(){
                
            //文章管理
                Route::get('/posts','\App\Admin\Controllers\PostController@index');
                Route::post('/posts/{post}/status','\App\Admin\Controllers\PostController@status');
        });

        Route::resource('topics', '\App\Admin\Controllers\TopicController',['only'=>['index','create','store','destroy']]);//destroy不要拼错

        Route::resource('notices', '\App\Admin\Controllers\NoticeController',['only'=>['index','create','store']]);
    
    });
    
});
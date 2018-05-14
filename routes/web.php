<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//带上命名空间会更好一些吧
Route::get('/test','\App\Http\Controllers\TestController@index');
Route::get('/test','\App\Http\Controllers\TestController@index');

//注册页面
Route::get('/register','\App\Http\Controllers\RegisterController@index');
//注册行为
Route::post('/register','\App\Http\Controllers\RegisterController@register');

//登陆页面
Route::get('/login','\App\Http\Controllers\LoginController@index')->name('login');
//登陆行为
Route::post('/login','\App\Http\Controllers\LoginController@login');

//登出行为
Route::get('/logout','\App\Http\Controllers\LoginController@logout');


//用户页面
Route::get('/user/{user}','\App\Http\Controllers\UserController@show'); //这个user前面不要加$符号

//个人设置页面
Route::get('/user/me/setting','\App\Http\Controllers\UserController@setting');
Route::post('/user/me/setting','\App\Http\Controllers\UserController@settingStore');

// 关注用户
Route::post('/user/{user}/fan','\App\Http\Controllers\UserController@fan');
Route::post('/user/{user}/unfan','\App\Http\Controllers\UserController@unfan');


//——————————————————————————————————————————————
Route::get('/','\App\Http\Controllers\PostController@index');
//文章列表页
Route::get('/posts','\App\Http\Controllers\PostController@index');



//专题详情页
// Route::get('/topice/{topice}/submit','\App\Http\Controllers\TopiceController@submit');//因为是某个专题的，所以用show
Route::get('/topic/{topic}','\App\Http\Controllers\TopicController@show');//因为是某个专题的，所以用show
Route::post('/topic/{topic}/submit','\App\Http\Controllers\TopicController@submit');//因为是某个专题的，所以用show

//需要登录验证的路由
Route::group(['middleware' => 'auth:web'], function () {


    //文章创建
    Route::get('/posts/create','\App\Http\Controllers\PostController@create');
    Route::post('/posts','\App\Http\Controllers\PostController@store');

    //搜索页面
    Route::get('/posts/search','\App\Http\Controllers\PostController@search');

   

    //文章更新
    Route::get('/posts/{post}/edit','\App\Http\Controllers\PostController@edit');
    Route::put('/posts/{post}','\App\Http\Controllers\PostController@update');

    //文章删除
    Route::get('/posts/{post}/delete','\App\Http\Controllers\PostController@delete');

    //文件上传
    Route::post('/posts/image/upload', '\App\Http\Controllers\PostController@imageUpload');

    //文章评论
    Route::post('/posts/{post}/comment','\App\Http\Controllers\PostController@comment');

    //赞和取消赞
    Route::get('/posts/{post}/zan','\App\Http\Controllers\PostController@zan');
    Route::get('/posts/{post}/unzan','\App\Http\Controllers\PostController@unzan');

    

    //通知页面
    Route::get('/notices','\App\Http\Controllers\NoticeController@index');

});

 //文章详情页面 //怎么用正则防止和文章创建的路由冲突
 Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');

include_once('admin.php');

//找回密码功能
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');;
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//QQ登录
Route::get('/auth/qq', 'Auth\SocialitesController@qq');
Route::get('/auth/qq/callback', 'Auth\SocialitesController@callback');




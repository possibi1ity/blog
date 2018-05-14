<?php
namespace App\Admin\Controllers;
use Illuminate\Http\Request;
class LoginController extends Controller{
    //首页
    public function index(){
        return view('admin/login/index');
    }
    //登陆页
    public function login(){
        $this->validate(request(),[
            'name'=>'required',
            'password' => 'required',
           ]);
        $user = request(['name','password']);
        if(\Auth::guard('admin')->attempt($user)){
            return redirect('/admin/home');
        }

        return redirect('/admin')->with('error','登陆失败，用户名或者密码错误');

    }

    public function logout(){
        \Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
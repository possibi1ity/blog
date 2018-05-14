<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginValidate;


class LoginController extends Controller
{
    //
    public function index(){
        return view("login/index");
    }
    public function login(LoginValidate $loginValidate){
        // $this->validate(request(),[
        //     'email'=>'required',
        //     'password' => 'required',
        //     'is_remember' => 'integer',
        //     'captcha' => 'required|captcha']);
        $user = request(['email','password']);
        $is_remember = request('is_remember');
        if(\Auth::attempt($user,$is_remember)){
            return redirect('/');
        }

        return back()->withErrors('登陆失败，用户名或者密码错误');
        //withErrors

        
    }
    public function logout(){
        \Auth::logout();
        return redirect('/login');
    }
}

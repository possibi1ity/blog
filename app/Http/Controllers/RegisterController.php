<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    //
    public function index(){
        return view("register/index");
    }

    public function register(){
        //考虑后期写一个验证器类，用AOP
        if(\Auth::check()){
            return redirect('/');
        }
        $this->validate(request(),[
            'name'=>'required|min:3|unique:users',
            'email'=>'required|unique:users|email',
            'password' => 'required|min:6|confirmed']);
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));
        $user = User::create(compact('name','email','password'));
        \Auth::login($user);
        // return redirect("/index")->with('success','创建用户成功');
        return redirect("/");
    }
}

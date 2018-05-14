<?php

namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use App\AdminUser;
use App\User;
use App\AdminRole;
class UserController extends Controller{
    public function index(){
        $users = AdminUser::paginate();  //没有连贯操作，用all和get是一样的，有连续操作用get
        // dd($users);
        return view('admin/user/index',compact('users'));
    }
    public function create(){
        return view('admin/user/create');
    }
    public function store(){
        $this->validate(request(),[
            'name'=>'required',
            'password' => 'required',
           ]);
        $name = request('name');
        $password = bcrypt(request('password'));  
        AdminUser::create(compact('name','password'));
        return redirect('admin/users');
    }

    public function role(\App\AdminUser $user){
        // return 'role';
        // dd($user);
        //查找出user的角色
     
        $myroles = $user->roles()->get();
        $roles = \App\AdminRole::get();
        return view('admin/user/role',compact('roles','myroles','user'));
    }

    public function roleStore(\App\AdminUser $user){
        $this->validate(request(),[
            'roles' => 'array'  //如果加require，取消全部权限的时候为空的时候就不行了
        ]);
        // dd(request()->all());
        $roles = AdminRole::findMany(request('roles')); //没必要用findmany,find也可以传数组的,错了，有必要用findMany,findMany就算为空，返回的也是一个集合，如果用find，为空，返回就是一个null
        //diff 方法将集合与其它集合或纯 PHP 数组进行值的比较，然后返回原集合中存在而给定集合中不存在的值：
        // dd($roles);
        $myroles = $user->roles()->get();
        // dd($roles);
        $addRoles = $roles->diff($myroles);
        $deleteRoles = $myroles->diff($roles);
        //添加
        foreach($addRoles as $addRole){
            $user->assignRole($addRole);
        }

        foreach($deleteRoles as $deleteRole){
            $user->deleteRole($deleteRole);
        }
        return back()->with('success','操作成功');
    }

}
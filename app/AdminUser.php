<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
//可以考虑继承User表
class AdminUser extends Authenticatable
{
    //
    protected $fillable = ['name','password'];
    protected $rememberTokenName = '';

    //和角色表的关联关系
    public function roles(){
        return $this->belongsToMany('\App\AdminRole','admin_role_user','user_id','role_id');//要写全表名admin_role_user
    }

    //判断是否有某些角色，某些角色
    public function isInRoles($roles){ 
        // return !! $this->$roles->intersect($roles)->count(); //判断是否有交集,这是个集合
        return !! $roles->intersect($this->roles)->count();
    }


    //添加某个角色
    public function assignRole($role){
        return $this->roles()->attach($role);  //attach是可以接收对象的
    }

    // 删除某个角色
    public function deleteRole($role){
        return $this->roles()->detach($role); //为什么这里不用delete,为会上面不用attach,detach可以传对象？ 不能用delete,delete会把roles表直接删了，但是关联表的却还在，上面用attach和save都一样的
    }

    //判断用户是否有某个权限
    public function hasPermission($permission){
        // dd($permission->roles);
        return $this->isInRoles($permission->roles);
    }


    

}

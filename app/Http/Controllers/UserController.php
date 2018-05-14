<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //
    public function setting(){
        return view("user/setting");
    }

    public function show(User $user){
        //为什么关联关系后不能用withCount??
        // return"1234";
        //不能直接用withCount,所以要构造一个查询
        //当前用户的文章，粉丝，关注数
        $user = User::withCount(['posts','fans','stars'])->find($user->id);
        //当前用户的文章内容,可以直接在上面加一个with
        $posts = $user->posts()->orderBy('created_at','desc')->limit(10)->get(); //take和limt都可以

        //当前用户的粉丝关注和粉丝具体信息
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['posts','fans','stars'])->get();
        $stars = $user->stars;
        // return $stars;
        //当前用户关注的用户的具体信息
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['posts','fans','stars'])->get();
        // dd(compact('user','posts','fuser','suser'));
        return view("user/show",compact('user','posts','fusers','susers'));
    }

    //关注某个用户
    public function fan(User $user){  //路由里面的参数也要和这个参数名一致的
        $me = \Auth::user(); //返回当前用户的对象，这个非常重要
        $me->dofan($user->id);
       
        return [
            'error' => 0,
            'msg'   =>'关注成功'
        ];
    }

    public function unfan(User $user){
        $me = \Auth::user(); 
        $me->doUnfan($user->id);
        return [
            'error' => 0,
            'msg'   =>'取消关注成功'
        ];
    }
}

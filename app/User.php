<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider', 'uid', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //用户文章关联
    public function posts(){
        return $this->hasMany('App\Post','user_id','id');
    }
    //粉丝关联
    public function fans(){
        return $this->hasMany('App\Fan','star_id','id');
    }
    public function stars(){
        return $this->hasMany('App\Fan','fan_id','id');
    }

    public function dofan($uid){
        $fan = new Fan();
        $fan->star_id = $uid;
        //是否要考虑一下可以多次关注的情况？
        return $this->stars()->save($fan);
    }
    public function doUnfan($uid){
        $fan = new Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);

    }
    //判断当前用户是否被uid关注了
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count(); //为什么用count，用first不行吗？
    }

    //判断当前用户是否关注了uid
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count(); 
    }

    //和消息notice的关联
    public function notices(){
        return $this->belongsToMany('\App\Notice','user_notice','user_id','notice_id');
    }

    //给用户添加notice
    public function addNotice($notice){
        return $this->notices()->attach($notice);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}

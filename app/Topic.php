<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Topic extends Model
{
    protected $table = "topics";
    protected $fillable = ['name'];
    //是多对多关系的，外键不是直接在posts表里面
    //获取这个专题的所有文章
    //第三个参数是当前模型在关系表里面的键名
    public function posts(){
        return $this->belongsToMany('\App\Post','post_topics','topic_id','post_id');
    }

    //意思是在posttopices表里面属于当前topice的文章数，好好理解，其实就是简化了关系，不用三个表这么麻烦
    public function postTopices(){
       return $this->hasMany('\App\PostTopic','topic_id','id');
    }

    
}

<?php

namespace App;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;




class Post extends Model
{
    
    //可以做一个基类继承
    protected $table = "posts";
    protected $fillable = ['title','content','user_id'];
    // protected $guarded = [];
    
    //搜索模块的设置来的
    // use Searchable;
    // /*
    //  * 搜索的type
    //  */
    // public function searchableAs()
    // {
    //     return 'posts';
    // }
    // //搜索的字段
    // public function toSearchableArray()
    // {
    //     return [
    //         'title' => $this->title,
    //         'content' => $this->content,
    //     ];
    // }


    //定义文章和用户的关联
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function comments(){
        return $this->hasMany('App\Comment','post_id','id'); //这个会根据命名空间解释类的位置的
    }
    
    //用户和赞关联
    public function zan(){
        return $this->hasOne('App\Zan','post_id','id')->where('user_id',\Auth::id());
    }
    //文章和赞的关联
    public function zans(){
        return $this->hasMany('App\Zan','post_id','id');
    }
    
    //属于某个作者的文章,这种作法只是把条件抽离出来而已，可以直接在连贯操作里面写也没有问题的
    //use Illuminate\Database\Eloquent\Model; 第一个参数都可以不填了
    //use Illuminate\Database\Query\Builder;
    // 这两个是不一样的
    public function scopeAuthorBy(Builder $query,$user_id){
        return $query->where('user_id','=',$user_id);
    }

    //文章和postTopics表的关联关系
    public function postTopics(){
        return $this->hasMany('\App\PostTopic','post_id','id');
    }

    //不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query,$topic_id){ //加不加builder有什么区别吗？
        return $query->doesntHave('postTopics','and',function($q) use($topic_id){
            $q->where('topic_id','=',$topic_id);
        });
    }

    //匿名的全局作用域,控制软删除的
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('available', function(Builder $builder) {
            $builder->whereIn('status', [0,1]);
        });
    }


}

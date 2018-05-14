<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Post;

class TopicController extends Controller
{
    //就算是依赖注入，也要引入topic的
    public function show(topic $topic){
        $topic = topic::withCount('postTopices')->find($topic->id);
        // $posts = $topic->posts()->withCount(['posttopics'])->get(); 错误，这个posttopics是定义在topic里面的，怎么可能在这里用呢
        
        $posts = $topic->posts()->get(); 

        //属于我但是没有投稿的文章
        $myposts = Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();  //是否是query查询默认会传递第一个对象呢？
        return view('topic/show',compact('topic','posts','myposts'));
    }
    public function submit(topic $topic){
        $post_ids = request('post_ids');
        // foreach($post_ids as $post_id)
        // {
        //     Post::firstOrCreate();
        // }
        // dd($post_ids);
        // $topic->posttopics()->create($post_ids);;
        // dd($topic);
        $topic->posts()->attach($post_ids);  //教程里面是foreach循环，然后用firstOrCreate的
        return back();
    }
}

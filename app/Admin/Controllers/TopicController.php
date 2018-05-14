<?php

namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use App\Topic;
class TopicController extends Controller{
    public function index(){
        $topics = Topic::all();
        return view('admin/topic/index',compact('topics'));
    }

    public function create(){
        return view('admin/topic/create');
    }

    public function store(){
        $this->validate(request(),[
            'name' => 'required|string'
        ]);
        
        $name = request('name');
        Topic::create(['name' => $name]); //create必须传数组
        return redirect('admin/topics');
    }

    public function destroy(Topic $topic){
        // dd($topic);
        // return request()->all();
        $topic->delete();
        return [
            'error'=>'0',
            'msg' => '删除成功'
        ];
    }

}
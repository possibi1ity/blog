<?php

namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use App\Notice;

class NoticeController extends Controller{
    public function index(){
        $notices = Notice::all();
        return view('admin/notice/index',compact('notices'));
    }

    public function create(){
        return view('admin/notice/create');
    }

    public function store(){
        $this->validate(request(),[
            'title' => 'required',
            'content' => 'required'
        ]);
        
        
        $notice = Notice::create(request(['title','content'])); //create必须传数组
        dispatch(new \App\Jobs\SendMessage($notice));
        return redirect('admin/notices');
    }


}
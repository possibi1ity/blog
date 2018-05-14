<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class NoticeController extends Controller
{
    //
    public function index(){
        $notices = \Auth::user()->notices;
        return view('/notice/index',compact('notices'));
    }
}

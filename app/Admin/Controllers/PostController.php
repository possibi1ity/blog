<?php
namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller{
    public function index(){
        $posts = Post::withoutGlobalScope('available')->where('status','=','0')->paginate();
        return view('admin/post/index',compact('posts'));
    }
    //1通过，-1拒绝，0未审核
    public function status(Post $post){
        // return request()->all();
        $post->status = request('status');
        $post->save();
        return [
            'error' => '0',
            'msg'   => '操作成功',
        ];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Zan;
use GrahamCampbell\Markdown\Facades\Markdown;


class PostController extends Controller
{
    //预加载可以用load也可以用with
    public function index(){
        $posts = Post::orderBy('created_at','desc')->with('user')->withCount(['comments','zans'])->paginate(6); //会产生一个comments_count字段
        // dd($posts);
        return view('post/index',compact('posts'));
    }

    public function show(Post $post){
        $post->load('comments'); //还有一种with 是要查询的时候用的

        // $post->content = Markdown::convertToHtml($post->content);
        // // dd($markdown);
        // $comments = $post->comments;
        // foreach($comments as $comment){
        //     $comment->content = Markdown::convertToHtml($comment->content);
        // }
        return view('post/show',compact('post'));
    }


    public function create(){
        return view('post/create');
    } 
    public function store(){
        // 传进去的应该是一个request对象
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'

        ]);
        // $user_id = \Auth::id();
        $params = array_merge(request(['title','content']),['user_id' => \Auth::id()]);
        $post = Post::create($params);
        // dd(request()->all());
        // 有很多种方法接收参数，也可以使用门脸类
        // 
        return redirect("/posts");
    }

    public function edit(Post $post){

        $this->authorize('update',$post);

        return view('post/edit',compact('post'));
    }

    public function update(Post $post){

        $this->authorize('update',$post);

        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10'

        ]);
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        return redirect("/posts/{$post->id}"); //这个花括号的作用是告诉PHP这是一个变量，不加也成功的
    }

    public function delete(Post $post){

        $this->authorize('delete',$post);
        
        $post->delete();
        $post->postTopics()->delete();
        return redirect("/");
    }

    public function imageUpload(Request $request){
        $path = $request->file('wangEditorH5File')->store(date("Y-m-d")); //store传的是文件夹名字
        // request()->file('wangEditorH5File')->storePublicly(md5(time()));
        // dd(request()->all());

        // if (!$request->hasFile('file')) {
        //     return response()->json(['message' => '没有上传文件'], 422);
        // }

        // if (!$request->file->isValid()) {
        //     return response()->json(['message' => '文件上传过程中出错了'], 422);
        // }

        // //上传格式验证
        // $allow = ['image/jpeg', 'image/png', 'image/gif'];
        // $type = $request->file->getMimeType();
        // //return $type;

        // if (!in_array($type, $allow)) {
        //     return response()->json(['message' => '文件类型错误，只能上传图片'], 422);
        // }

        // //文件大小验证
        // $max_size = 1024 * 1024 * 2;
        // $size = $request->file->getClientSize();
        // //return $size;

        // if ($size > $max_size) {
        //     return response()->json(['message' => '文件大小不能超过2M'], 422);
        // }

        // $path = $request->file->store('public/images');
        // $url = Storage::url($path);
        return(asset('storage/'.$path));
    }

    public function comment(Post $post){
        $this->validate(request(),[
            'content' => 'required|min:3'
        ]);

        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);
        // dd(request()->all());
        return redirect("/posts/{$post->id}");
    }

    public function zan(Post $post){
        //没登陆就跳转，这个看下能不能换中间件的方法
        if(!\Auth::check()){
            return redirect('/login');
        };
        $params = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];
        // dd($params);
        Zan::firstOrCreate($params);
        return back();
    }


    public function unzan(Post $post){

        $post->zan()->delete();
        return back();
    }
    public function search(){
        $this->validate(request(),[
            'query' => 'required'
        ]);
        $query = request('query');
        // 这个是elasticsearch方法的，但是主机内存可能不够，直接用模糊查询了
        $posts = Post::where('title','like',"%$query%")->orWhere('content','like',"%$query%")->paginate(2);
        // $posts = Post::search($query)->paginate(2);
        // dd($posts);
        return view('post/search',compact('posts'));
    }


    

}

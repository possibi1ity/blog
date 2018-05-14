<div class="blog-masthead">
    <div class="container">
    <form action="/posts/search" method="GET">
    <!-- {{csrf_field()}}get不用csrf的 -->
        <ul class="nav navbar-nav navbar-left">
            <li>
                <a class="blog-nav-item " href="/posts">首页</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/posts/create">写文章</a>
            </li>
            <li>
                <a class="blog-nav-item" href="/notices">通知</a>
            </li>
            <li>
                <input name="query" type="text" value="" class="form-control" style="margin-top:10px" placeholder="搜索词">
            </li>
            <li>
                <button class="btn btn-default" style="margin-top:10px" type="submit">Go!</button>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">

            @if(\Auth::check())
            <li class="dropdown">
                <div style="padding:5px">
                    <img src="/storage/53.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 30px">

                    <a href="#" class="blog-nav-item dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> {{\Auth::user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/user/{{\Auth::id()}}">我的主页</a></li>
                        <li><a href="/user/{{\Auth::id()}}/setting">个人设置</a></li>
                        <li><a href="/logout">登出</a></li>
                    </ul>
                    
                </div>
            </li>
            
            @else
            <li>
                <a href="\register" class="blog-nav-item ">注册</a>
            </li>
            <li>
                <a href="\login" class="blog-nav-item ">登陆</a>
            </li>
            @endif
        </ul>
        </form>
    </div>
</div>
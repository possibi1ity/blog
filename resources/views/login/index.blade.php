
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>登陆</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://v3.bootcss.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://v3.bootcss.com/examples/signin/signin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
  #inputCaptcha{
      width:180px;
  }
  #captcha{
    position:absolute; 
    top:0px;
    right:0px;
  }
  .captcha-container{
    position:relative;
   
  }
    </style>
</head>

<body>

<div class="container">

    <form class="form-signin" method="POST" action="/login">
        <!-- <input type="hidden" name="_token" value="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy"> -->
        {{csrf_field()}}
        <h2 class="form-signin-heading">请登录</h2>

        <label for="inputEmail" class="sr-only">邮箱</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>

        <label for="inputPassword" class="sr-only">密码</label>
        <input style="margin-bottom:0px;" type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <div class="captcha-container">
        <label for="inputCaptcha" class="sr-only">验证码</label>
        <input type="text" name="captcha" id="inputCaptcha" class="form-control" placeholder="验证码" required > 
        <img src="{{Captcha::src()}}" alt="验证码" onclick="this.src='{{captcha_src()}}'+ Math.random();"  id="captcha">
        </div>
        
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="is_remember"> 记住我
            </label>
            <span style="float:right">
            <a href="/password/reset">忘记密码</a>
            <span>
        </div>


        @include("layout.message")
                <button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button>
                <button class="btn btn-lg btn-info btn-block" type="button" id="QQLogin" onclick="window.location.href='/auth/qq'">QQ登录</button>
        <a href="/register" class="btn btn-lg btn-primary btn-block" type="submit">去注册>></a>
    </form>

</div> <!-- /container -->


<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>

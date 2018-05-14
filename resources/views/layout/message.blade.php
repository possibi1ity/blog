<!-- 成功提示框 -->
@if(Session::has("success"))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>成功!</strong> {{Session::get('success')}}
    </div>
@endif
<!-- 失败提示框 -->
@if(Session::has("errors"))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <!-- <strong>失败!</strong> {{Session::get('error')}} -->
  
        <!-- $errors是个对象，要查出来 -->
            @foreach($errors->all() as $error)  
            <li>{{$error}}</li>
            @endforeach

    </div>
@endif


<!--
/**
 * 4秒钟后，自动隐藏flash信息
 */
var hideFlash = function () {
    $(".am-alert").fadeOut("slow");
}
setTimeout(hideFlash, 4000);-->
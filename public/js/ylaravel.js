var editor = new wangEditor('content');
if(editor.config){
    editor.config.uploadImgUrl = '/posts/image/upload';

    // 设置 headers（举例）
    editor.config.uploadHeaders = {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    };
    
    editor.create();
}


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".like-button").on('click',function(){
    var like_value = $(this).attr('like-value');
    var user_id = $(this).attr('like-user');
    //判断点的是哪个按钮
    if(like_value == '1'){
        var url = '/user/'+ user_id +'/fan'
        var text = '取消关注';
        like_value = '0';
    }else{
        var url = '/user/'+ user_id +'/unfan'
        var text = '关注';
        like_value = '1';
    }
    var that = $(this);
    $.ajax({
        type: "POST",
        url: url,
        success: function (res) {
            if(res.error != 0){
                alert('操作失败');
                return;
            }
            
            that.text(text);
            that.attr('like-value',like_value);
        }
    });
});
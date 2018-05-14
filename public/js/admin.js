$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".post-audit").on('click',function(){

    var id = $(this).attr('post-id');
    var status = $(this).attr('post-action-status');
    var url = '/admin/posts/'+ id + '/status';
    var that = $(this);
    $.ajax({
        type: "POST",
        url: url,
        data: {"status":status},
        success: function (res) {
            // if(res.error != 0){
            //     alert('操作失败');
            //     return;
            // }

            console.log(res);
            if(res.error = '0'){
                that.parent().parent().remove();
            }
           
            
            
        }
    });
});

$(".resource-delete").on('click',function(event){
    var target = $(event.target);
    var url = target.attr('delete-url');
    // var id = $(this).attr('post-id');
    // var status = $(this).attr('post-action-status');
    // var url = '/admin/posts/'+ id + '/status';
    // var that = $(this);
    event.preventDefault(); //阻止默认动作
    $.ajax({
        type: "DELETE",
        url: url,
        // data: {"_method":"DELETE"},直接换DELETE方法好像也可以
        success: function (res) {
            // if(res.error != 0){
            //     alert('操作失败');
            //     return;
            // }

            if(res.error = '0'){
                window.location.reload();
            }
          
        }
    });
});


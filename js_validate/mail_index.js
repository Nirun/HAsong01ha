$(document).ready(function () {
    $('#btn_preview').bind('click', function () {
        $.ajax({
            url:'register/mail/preview_template',
            type:'POST',
            cache:false,
            data:$('#form_preview').serialize(),
            beforeSend:function () {
                $.fancybox.showLoading();
            },
            success:function (data) {
                $.fancybox({
                    type:'html',
                    minWidth:800,
                    minHeight:600,
                    content:data
                });
            },
            complete:function () {
                $.fancybox.hideLoading();
                //$('.fancybox-outer').css('text-align','left');
            }

        })
    });
    $('#group').prop('disabled',true);
    $('input[name="type"]').bind('click',function(){
       var val = $(this).val();
        if(val==0){
            $('#group').removeProp('disabled');
            $('input[name="to"]').prop('disabled',true);
            $('input[name="cc"]').prop('disabled',true);
            $('input[name="bcc"]').prop('disabled',true);
        }
        else{
            $('#group').prop('disabled',true);
            $('input[name="to"]').removeProp('disabled');
            $('input[name="cc"]').removeProp('disabled');
            $('input[name="bcc"]').removeProp('disabled');
        }
    });
});
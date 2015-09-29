/**
 * Created by Nirun on 29/9/2558.
 */
$(function () {
    $('#reserve_2').on('click', function () {
        if ($(this).attr('rev') == 3) {
            $.ajax({
                    url: 'register/user/register_group_course',
                    type: 'post',
                    data: {courseID: $(this).attr('rel')},
                    cache:false,

                    success: function (data) {
                       // alert(data);
                        if(data==1){
                            return true;
                        }
                        else{
                            alert('xxx');
                            return false
                        }
                    }
                }
            );
            return false
        }
        else {
            return true;
        }
    });
});
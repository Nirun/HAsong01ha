/**
 * Created by Nirun on 29/9/2558.
 */
$(function () {
    var ret = false;
    function callBack(ok){
        ret = ok;
    }
    $('#reserve_2').on('click', function () {
        if ($(this).attr('rev') == 3) {
            $.ajax({
                    url: 'register/user/register_group_course',
                    type: 'post',
                    data: {courseID: $(this).attr('rel')},
                    cache: false,
                    dataType: "json",
                    async:false,
                    success: function (data) {
                        if (data.response) {
                            callBack(true)
                        }
                        else {
                            alert(data.msg);
                            callBack(false)
                        }
                    }
                }
            );
            return ret
        }
        else {
            return true;
        }
    });
});
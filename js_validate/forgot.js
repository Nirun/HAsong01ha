/**
 * Created with JetBrains PhpStorm.
 * User: Nirun
 * Date: 17/1/2556
 * Time: 2:01 น.
 * To change this template use File | Settings | File Templates.
 */
$(function () {

    $('#frm_forgot').live('submit', function () {
        var ret;
        $.ajax({
            type:"GET",
            cache:false,
            url:"register/user/valid_user_email",
            data:$('#frm_forgot').serialize(),
            dataType:'json',
            async:false,
            success:function (data) {
                console.log(data["1"]);
                if (data["1"]) {
                    alert('ไม่พบอีเมล์นี้ในระบบโปรดตรวจสอบอีเมล์อีกครั้ง');
                    ret = false;
                }
                else {
                    alert('ระบบได้ทำงานส่งข้อมูลไปยังอีเมล์ของท่านแล้ว');
                    ret = true;
                }
            }
        });
        return ret;
    });
})

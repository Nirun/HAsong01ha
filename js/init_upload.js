/**
 * Created by Nirun on 21/9/2558.
 */
$(function () {
    var objCount = 0;
    function setCount(i){
        objCount = i;
    }
    $("#fileuploader").uploadFile({
        url: "register/course/upload_hostpital_course",
        multiple: false,
        fileName: "mycsv",
        onSuccess: function (file, data) {
            $('#cond_hospital').val(data);
            var o = 0;
            var txt = '';
            var objHos = jQuery.parseJSON(data);
            jQuery.each(objHos, function (i, e) {
                o++;
                console.log(e[1]);
                var hp = e[1];
                txt += "<p>"+o+". " + hp + "</p>";
            });
            $('#view-hospital').html(txt);
            var max =  $('#cond_total').val() * o;
            $('#limittrainees').val(max)
            setCount(o);
        }
    });
    $('#cond_total').on('blur',function(){
        //alert(objCount);
        var max1 =  $('#cond_total').val() * objCount;
        $('#limittrainees').val(max1)
    })
});
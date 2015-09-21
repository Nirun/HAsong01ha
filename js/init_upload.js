/**
 * Created by Nirun on 21/9/2558.
 */
$(function(){
    $("#fileuploader").uploadFile({
        url:"register/course/upload_hostpital_course",
        multiple:false,
        fileName:"mycsv",
        onSuccess:function(file,data){
            $('#cond_hospital').val(data);
            console.log(data);
        }
    });
});
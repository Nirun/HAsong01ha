$(document).ready(function() {
    $("a.inline").fancybox({
        minWidth:800,
        minHeight:400
    });

    $("#btn_save").click(function() {

        var items = [];
        $("input[name='precourses[]']:checked").each(function(){items.push($(this).val());});
        //alert(items);

        $.ajax({
            type	: "POST",
            cache	: false,
            url		: "register/course/saveprecourse",
            data    : "list="+ items,
            success: function(data) {
                //alert(data);
                $('#courselist').html(data);
            }
        });

        $('#precourseID').val(items);

        $.fancybox.close();
    });

    $("#btn_save_cond").click(function () {
        var items = [];
        var txtID = '';
        $("input[name='con_courses[]']:checked").each(function () {
            items.push($(this).val());
            txtID += $(this).val() + ','
        });
        $("#cond_course").val(txtID);
        $.fancybox.close();
    });


});

function TotalDate() {
    var d1  = $('#startdate').val();
    var d2  = $('#enddate').val();

    var x= d1.split("-");
    var y= d2.split("-");

    var date1 = new Date(x[0],(x[1]-1),x[2]);
    var date2=new Date(y[0],(y[1]-1),y[2]);

    //alert (x[2]+":"+ (x[1]-1)+":"+ x[0] );

    var t2 = date2.getTime();
    var t1 = date1.getTime();

    var num_days = parseInt((t2-t1)/(24*3600*1000));
    var totaldays = num_days +1;

    $('#days').val(totaldays);
}

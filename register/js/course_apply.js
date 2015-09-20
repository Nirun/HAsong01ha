
$(function(){
    ////////////////////
    $(".btn").click(function() {
        var cID = $("#courseID").val();

        var tID = [];
        var tarr = document.getElementsByName('traineeID');

        var fname =[];
        var farr = document.getElementsByName('changename');

        var lname =[];
        var larr = document.getElementsByName('changelastname');

        for(var i=0; i< farr.length; i++) {
            if ((farr[i].value != '') && (larr[i].value != '')) {
                fname.push(farr[i].value);
                lname.push(larr[i].value);
                tID.push(tarr[i].value);
            }
        }

        var dataString = 'fname=' + fname + '&lname=' + lname+ '&cID=' + cID+ '&tID=' + tID;
        //alert(dataString);

        $.ajax({
            type	: "POST",
            cache : false,
            url   : "register/course/changetrainee",
            data  :  dataString,
            success: function(data) {
//                alert('ajax');
//                console.log(data);
//                return false;
                if (data != 0){
                    //$('#tblView').html('').load('register/course/applylist/edit/'+cID);
                    $('#tblView').load('register/course/applylist/edit/'+cID);
                }else{
                    alert("ไม่พบชื่อผู้เข้าอบรมที่ต้องการเปลี่ยนในระบบ");
                }
                ClearVal();
            }
        });
    });

    function ClearVal(){
        //alert('Clear');
        var fname =[];
        var farr = document.getElementsByName('changename');
        var lname =[];
        var larr = document.getElementsByName('changelastname');

        for(var i=0; i< farr.length; i++) {
            farr[i].value ='' ;
            larr[i].value = '';
        }
    }
    var bobexample =new switchcontent("switchgroup1", "div") //Limit scanning of switch contents to just "div" elements
    bobexample.setColor('darkred', 'black')
    bobexample.setPersist(true)
    bobexample.collapsePrevious(true) //Only one content open at any given time
    bobexample.init()
});
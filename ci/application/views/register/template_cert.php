<div id="wrapper-tp">
    <div id="val-tp">
        <?php if (trim($template_cert) != ''): echo $template_cert; else: ?>
            <table border="0" cellspacing="1" cellpadding="1" align="left">
                <tr valign="top">
                    <td width="700" align="center">
                        <div id="container-tp" style="border: #000 0px solid; "><img
                                src="<?php echo setting::$BASE_URL ?>/images/blank.gif" alt="" width="1" height="250"
                                border="0">
                            <br>

                            <div id="draggable3" class="draggable ui-widget-content"
                                 style="padding: 2px;text-align: center;font-size:26px;font-weight:bold; width:600px; font-family:sarabun;">
                                #NAME-SURNAME
                            </div>
                            <img src="<?php echo setting::$BASE_URL ?>/images/blank.gif" alt="" width="1" height="50"
                                 border="0">
                            <br>

                            <div id="draggable6" class="draggable ui-widget-content"
                                 style="padding: 2px;text-align: center;font-size:22px; width:600px;font-family:sarabun;">
                                ได้เข้าร่วมอบรมหลักสูตร
                            </div>

                            <div id="draggable4" class="draggable ui-widget-content"
                                 style="padding: 2px;text-align: center;font-size:22px; width:600px;font-family:sarabun;">
                                #COURSE-NAME
                            </div>

                            <div id="draggable5" class="draggable ui-widget-content"
                                 style="padding: 2px;text-align: center;font-size:18px;width:600px;font-family:sarabun;">
                                ระหว่างวันที่ #DATE-TIME
                            </div>
                            <div id="draggable7" class="draggable ui-widget-content"
                                 style="padding: 2px;font-size:22px;font-family:sarabun;width: 200px;">
                                #COURSE-CODE
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        <?php endif; ?>
    </div>
 <div id="action"><strong>วิธีใช้งาน</strong>
 <br>
 ใช้ mouse ขยับขนาดของตัวหนังสือที่ต้องการ หรือเลื่อนตำแหน่ง <br>
 จากนั้นกดปุ่ม save และปิดหน้าต่างนี้
  <br>
 <p align="center">  <br>  <br>
  <strong>กำหนดขนาดของตัวหนังสือ</strong>
 <br><div class="wrapper-slide">
            <p>ชื่อ</p>

            <div id="slider-name" style="height:200px;margin: 0 auto"></div>
        </div>
        <div class="wrapper-slide">
            <p>ชื่อCourse</p>

            <div id="slider-course" style="height:200px;margin: 0 auto"></div>
        </div>
     <div class="wrapper-slide">
         <p>ร่วมอบรม</p>

         <div id="slider-6" style="height:200px;margin: 0 auto"></div>
     </div>
        <div class="wrapper-slide">
            <p>วันที่</p>

            <div id="slider-date" style="height:200px;margin: 0 auto"></div>
        </div>
     <div class="wrapper-slide">
         <p>Code</p>

         <div id="slider-7" style="height:200px;margin: 0 auto"></div>
     </div>
     </p>
        
<p align="center"><button id="btn_copy"> SAVE</button></p>
  </div>
    </div>
    <div id="msg">
        <textarea id="txt" rows="10" cols="100"></textarea>
    </div>
    


<script>
    $(function () {
        $("#draggable3").draggable({ containment: "#container-tp", scroll: false });
        $("#draggable4").draggable({ containment: "#container-tp", scroll: false });
        $("#draggable5").draggable({ containment: "#container-tp", scroll: false });
        $("#draggable6").draggable({ containment: "#container-tp", scroll: false });
        $("#draggable7").draggable({ containment: "#container-tp", scroll: false });
        //$("#draggable3").resizable({containment: "#container"});
        $("#slider-name").slider({
            orientation: "vertical",
            range: "min",
            min: 10,
            max: 60,
            value: 20,
            slide: function (event, ui) {
                $("#draggable3").css('font-size', ui.value);
            }
        });
        $("#slider-course").slider({
            orientation: "vertical",
            range: "min",
            min: 10,
            max: 60,
            value: 20,
            slide: function (event, ui) {
                $("#draggable4").css('font-size', ui.value);
            }
        });
        $("#slider-date").slider({
            orientation: "vertical",
            range: "min",
            min: 10,
            max: 60,
            value: 20,
            slide: function (event, ui) {
                $("#draggable5").css('font-size', ui.value);
            }
        });
        $("#slider-date").slider({
            orientation: "vertical",
            range: "min",
            min: 10,
            max: 60,
            value: 20,
            slide: function (event, ui) {
                $("#draggable5").css('font-size', ui.value);
            }
        }); $("#slider-6").slider({
            orientation: "vertical",
            range: "min",
            min: 10,
            max: 60,
            value: 20,
            slide: function (event, ui) {
                $("#draggable6").css('font-size', ui.value);
            }
        });
        $("#slider-7").slider({
            orientation: "vertical",
            range: "min",
            min: 10,
            max: 60,
            value: 20,
            slide: function (event, ui) {
                $("#draggable7").css('font-size', ui.value);
            }
        });
        $("#btn_copy").on("click", function () {
            var val = $("#val-tp").html();
            console.log(val);

            $.ajax({
                type: "POST",
                url: "manage/cert/save",
                data: { txt: val },
                dataType:'html',
                success: function (e) {
                    alert("Save complete");
                }
            });
        });

    })
</script>

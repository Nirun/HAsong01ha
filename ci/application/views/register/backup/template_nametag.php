<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>jQuery UI Example Page</title>
    <link href="<?= setting::$BASE_URL ?>/js_ui/jquery-ui.css" rel="stylesheet">


    <style type="text/css">
        #wrapper-tp { 
			background-color:#FFFFFF;
            /*position: absolute;*/
        }

        #container-tp {
	border: #000 1px solid;
	width: 340px;
	height: 207px;
	float: left;
	text-align:left;
	position: relative; 
	background-repeat: no-repeat;
	background-image: url(<?php echo setting::$BASE_URL?>/bgcard1.jpg);
	background-position:right;
	padding-left:0px;
	padding-right:0px;
	background-color:transparent;
        }
		#incard{
			padding-left:10px;}

        #action {
            position: relative;
            margin-left: 10px; 
            width: 300px;
            height: 400px;
            float: left;
            font: 12px Tahoma;
        }

        #draggable3, #draggable4, #draggable5, #draggable6, #draggable7 {
            /*display: inline-flex;*/
            cursor: pointer;
        }

        #msg {
            display: none;
            margin-top: 10px;
            float: left;
            position: relative;
        }

        .wrapper-slide {
            text-align: center;
            padding: 3px;
            display: inline-block; 

        }

        #btn_copy {
            padding: 3px;
        }
    </style>

</head>
<body>

<p></p>

<div id="wrapper-tp"> 
  <div id="val-tp" style="width:340px;">
 
        
        
    <div id="container-tp" style="width:340px;"> 
         <div id="incard">
<img src="<?php echo setting::$BASE_URL?>/images/blank.gif" alt="" width="1" height="60" border="0">
    <br> <span id="draggable3" class="draggable ui-widget-content"
                       style="padding: 2px;text-align: left;font-size:24px;font-weight:bold;z-index: 200;">
             <strong>   #NAME-SURNAME </strong>
            </span>
<br> 
            <span id="draggable6" class="draggable ui-widget-content"
                  style="padding: 2px;text-align: left;font-size:12px;z-index: 203;">
             สถานพยาบาลต้นสังกัด:
            </span>
            <br> 
            <span id="draggable5" class="draggable ui-widget-content"
                 style="padding: 2px;text-align: left;font-size:18px;z-index: 202;">
                #HOSPITAL-NAME
            </span>
            <br><br>
            <span id="draggable7" class="draggable ui-widget-content"
                  style="padding: 2px;text-align: left;font-size:12px;z-index: 204;">
                Course:
            </span>
            <br>
            <span id="draggable4" class="draggable ui-widget-content"
                  style="padding: 2px;text-align: left;font-size:18px; z-index: 201;">
                #COURSE-NAME
            </span> 
            
             </div> 
              
        </div> 
    </div> 

  
            
            
    
     
    
    
    
    <div id="action"><strong>วิธีใช้งาน</strong>
 <br>
 ใช้ mouse ขยับขนาดของตัวหนังสือที่ต้องการ หรือเลื่อนตำแหน่ง  (กดเลื่อนจากรูปด้านซ้าย)
 จากนั้นกดปุ่ม save และปิดหน้าต่างนี้
  <br>
 <p align="center">  <br>  <br>
  <strong>กำหนดขนาดของตัวหนังสือ</strong>
        <div class="wrapper-slide"> 
            <p>ชื่อ นามสกุล / Name </p>

            <div id="slider-name" style="width:200px;margin: 0 auto"></div>
        </div>
        <div class="wrapper-slide">
            <p>สถานพยาบาลต้นสังกัด / Hospital label</p>
            <div id="slider-hos" style="width:200px;margin: 0 auto"></div>
        </div>
        <div class="wrapper-slide">
            <p>ชื่อโรงพยาบาล / Hospital Name</p>
            <div id="slider-date" style="width:200px;margin: 0 auto"></div>
        </div>
        <div class="wrapper-slide">
            <p>รหัส Course lable</p>
            <div id="slider-course-txt" style="width:200px;margin: 0 auto"></div>
        </div>
        <div class="wrapper-slide">
            <p>Course Name</p>
            <div id="slider-course" style="width:200px;margin: 0 auto"></div>
        </div>


            <p align="center">
            <br>
<button id="btn_copy"> SAVE</button></p>

    </div>

    <div id="msg">
        <textarea id="txt" rows="10" cols="100"></textarea>
    </div>
</div>
</body>
<!--<script src="--><? //=setting::$BASE_URL?><!--/js_ui/external/jquery/jquery.js"></script>-->
<script src="<?= setting::$BASE_URL ?>/js_ui/jquery-ui.js"></script>
<script>
    $(function () {
        $("#draggable3").draggable({ containment: "#container-tp", scroll: false });
        $("#draggable4").draggable({ containment: "#container-tp", scroll: false });
        $("#draggable5").draggable({ containment: "#container-tp", scroll: false });
        $("#draggable6").draggable({ containment: "#container-tp", scroll: false });
        $("#draggable7").draggable({ containment: "#container-tp", scroll: false });
        //$("#draggable3").resizable({containment: "#container"});
        $("#slider-name").slider({
            orientation: "horizontal",
            range: "min",
            min: 10,
            max: 35,
            value: 20,
            slide: function (event, ui) {
                $("#draggable3").css('font-size', ui.value);
            }
        });
        $("#slider-course").slider({
            orientation: "horizontal",
            range: "min",
            min: 10,
            max: 35,
            value: 10,
            slide: function (event, ui) {
                $("#draggable4").css('font-size', ui.value);
            }
        });
        $("#slider-date").slider({
            orientation: "horizontal",
            range: "min",
            min: 10,
            max: 35,
            value: 10,
            slide: function (event, ui) {
                $("#draggable5").css('font-size', ui.value);
            }
        });
        $("#slider-hos").slider({
            orientation: "horizontal",
            range: "min",
            min: 10,
            max: 35,
            value: 10,
            slide: function (event, ui) {
                $("#draggable6").css('font-size', ui.value);
            }
        });
        $("#slider-course-txt").slider({
            orientation: "horizontal",
            range: "min",
            min: 10,
            max: 35,
            value: 10,
            slide: function (event, ui) {
                $("#draggable7").css('font-size', ui.value);
            }
        });
        $("#btn_copy").on("click", function () {
            var val = $("#val-tp").html();
            $.ajax({
                type: "POST",
                url: "manage/nametag/save",
                data: { txt: val },
                dataType:'html',
                success: function (e) {
                    alert("Save complete");
                }
            });
        });

    })
</script>
</html>
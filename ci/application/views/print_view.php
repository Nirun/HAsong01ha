<!doctype html>
<!--[if lt IE 7]> <html class="no-js bug-ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="no-js bug-ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="no-js bug-ie lt-ie9"> <![endif]-->
<!--[if IE 9]>    <html class="no-js bug-ie lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>
        <?php echo setting::$WINDOW_TITLE ?>
    </title>

    <META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=UTF-8">
    <base href="<?php echo setting::$BASE_URL?>/">
    <script language="javascript" src="js/lib/jquery-1.8.2.min.js"></script>
    <script>
        $(function(){
            $('#print').live('click',function(){
               window.print();
            });
        })
    </script>
    <style type="text/css">
        #wrapper {
            width: 100%;
            margin: 0 auto;
            position: absolute;
            display: block;
        }

        #content {
            width: 960px;
            margin: 0 auto;
            display: block;
            position: relative;
        }

        #print {
            color: #FFF;
            width: 35px;
            font: bold 14px arial;
            padding: 10px;
            /*display: block;*/
            background-color: #ceee6f;
            position: fixed;
            right: 10px;
            bottom: 10px;
            cursor: pointer;
            z-index: 100;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="content">

        <?php
        if ($is_show) {
            echo $content;
        } else {
            echo 'ไม่พบเอกสารที่คุณต้องการ';
        }
        ?>
    </div>
    <div id="print">
        Print
    </div>
</div>


</body>
</html>

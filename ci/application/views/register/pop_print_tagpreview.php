<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!--<LINK REL="stylesheet" HREF="<?php echo setting::$BASE_URL ?>/register/style.css" TYPE="text/css">-->
<title><?php echo setting::$WINDOW_TITLE ?></title>
    <style type="text/css">
 
	
 @font-face {
    font-family: "sarabun"; 
src:url('<?php echo setting::$BASE_URL?>/font/sarabun.eot');
 src:url('<?php echo setting::$BASE_URL?>/font/sarabun.eot?iefix') format('eot'),
     url('<?php echo setting::$BASE_URL?>/font/sarabun.woff') format('woff'),
     url('<?php echo setting::$BASE_URL?>/font/sarabun.ttf') format('truetype'),
     url('<?php echo setting::$BASE_URL?>/font/sarabun.svg') 
     format('svg');

}
        #bgcard {
	font-family: sarabun;
	width: 340px;
	height: 207px;
	background-image:url(<?php echo setting::$BASE_URL?>/bgcard1.jpg);
	background-repeat: no-repeat;
	margin-left: auto;
	margin-right: auto;
	background-position: top left; 
        }
		#incard{
			padding-left:10px;}
    </style>
</head>

<body><br/> 
<table  border="0" cellspacing="0" cellpadding="0"  align="center">
    <?php
    $total_row = count($data);
    $add_tr = 0;
    foreach ($data as $_data):

        //prefix
        if ($_data['prefix'] == 6) {
            $prefix = $_data['prefix_other'];
        } else {
            $prefix = $_data['title_th'];
        }

        //trainee name
        $trainee = $prefix . " " . $_data['name'] . " " . $_data['lastname'];

        //hospital name
        if ($_data['hospitalother'] != "") {
            $hospital = $_data['hospitalother'];
        } else {
            //$hospital = $_reglist['hospitalID'];
            $hospital = "รพ." . $_data['hospitalname'] . " " . $_data['province'];
        }

        //Course Date
        $sDate = $_data['startdate'];
        $eDate = $_data['enddate'];

        if ($sDate == "0000-00-00 00:00:00" or $sDate == "0000-00-00" or $sDate == ""
            or $eDate == "0000-00-00 00:00:00" or $eDate == "0000-00-00" or $eDate == ""
        ) {
            $CourseDate = "ไม่ได้ระบุวันที่อบรม";
        } else {
            $scDate = Thaidate::date($sDate, "DD MM YYYY");
            $ecDate = Thaidate::date($eDate, "DD MM YYYY");
            $CourseDate = $scDate . ' - ' . $ecDate;
        }

        $img = ($_data['photo'] != '') ? $_data['photo'] : 'default.jpg';

        //change name
        if (!empty($_data['cpother'])){
            $cpprefix = $_data['cpother'];
        }else{
            $cpprefix = $_data['cprefix'];
        }

        $changeimg = ($_data['cpphoto'] != '') ? $_data['cpphoto'] : 'default.jpg';

        if (!empty($_data['cpname']) && !empty($_data['cplastname'])){
            $changename = $cpprefix ." ". $_data['cpname']." ".$_data['cplastname'];
         }else{
            $changename = '';
        }

        if ($add_tr == 0) echo '<tr valign="top">';
        ?>
        <!-- <tr valign="top">-->
        <td > 
        <div id="bgcard">
         <div id="incard">
        <img src="<?php echo setting::$BASE_URL?>/blank.gif" width="330" height="1" border="0" />
 <?php
            $name = ($changename == '') ? $trainee : $changename;
            $_hospital = $hospital;
            $_course = $_data['coursecode'] . ":" . $_data['coursename'];
            $tp_nametag = $template;
            $tp_nametag = str_replace("#NAME-SURNAME", $name, $tp_nametag);
            $tp_nametag = str_replace("#HOSPITAL-NAME", $_hospital, $tp_nametag);
            $tp_nametag = str_replace("#COURSE-NAME", $_course, $tp_nametag);
            echo($tp_nametag);
            ?>
     </div></div>
           

        </td>
        <?php
        if ($add_tr == 1 || $total_row == 0) {
            echo '</tr>';
            $add_tr = 0;
        } else {
            $add_tr++;
        }
    endforeach;
    ?>
</table>
 
<br><br>
<table width="100%" border="0" bgcolor="#FFFFFF">
    <tr>
        <td>
            <p align="center"><br/>
                <input type="button" value="พิมพ์" onclick="window.print();"/>

                <button onclick="javascript:window.opener.location='<?=setting::$BASE_URL?>/manage/nametag';window.close();">
                    BACK
                </button>
            </p>
        </td>
    </tr>
</table>


</body>
</html>

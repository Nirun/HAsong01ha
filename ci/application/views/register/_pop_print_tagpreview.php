<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <LINK REL="stylesheet" HREF="<?php echo setting::$BASE_URL ?>/register/style.css" TYPE="text/css">
    <title><?php echo setting::$WINDOW_TITLE ?></title>
    <style type="text/css">
	#card{
	width: 340px;
	height: 260px;
	border: thin;
	border-width: 1px;
	border-color: #CCC;
		}

    </style>
</head>

<body><br/>
<table width="100%" border="0" cellspacing="5" cellpadding="5" bgcolor="#FFFFFF">
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
        <td align="left">
            <!--name tag-->
            <table border="0" cellspacing="0" cellpadding="0" height="260">
                <tr valign="top">
                    <td>
                     <div id="card">   <table border="0" cellspacing="1" cellpadding="1" width="340" height="260">
                            <tr valign="top">
                               <!-- <td align="center" width="120">
                                    <?php if( $changename == '') { ?>
                                    <img src="<?php echo Setting::$BASE_URL . "/" . Setting::$PATE_TRIANEE . $img ?>"
                                         width="120" border="0"/>
                                    <br/> 
                                    <?php
                                    $barcode = $_data['cardID'];
                                     if (!empty($barcode)){
                                        echo '<img src ="' . setting::$BASE_URL . '/register/user/barcode/' . $barcode . '">';
                                     }
                                    ?>
                                    <?php } else {?>
                                    <img src="<?php echo Setting::$BASE_URL . "/" . Setting::$PATE_TRIANEE . $changeimg ?>"
                                         width="120" border="0"/>
                                    <br/> 
                                    <?php
                                    $cpbarcode = $_data['cpcardID'];
                                    if (!empty($cpbarcode)){
                                        echo '<img src ="' . setting::$BASE_URL . '/register/user/barcode/' . $cpbarcode . '">';
                                    }
                                    ?>
                                    <?php } ?>
                                </td>-->
                                <td align="left" class="copy2"><h2> 
                                    <?php if($changename == ''){?>
                                        <?php echo $trainee; ?>
                                    <?php }else{?>
                                        <?php echo $changename; ?>
                                    <?php } ?> </h2>
                              
                                    <strong>สถานพยาบาลต้นสังกัด:</strong> <br/>
                                    <?php echo $hospital;?> <br/><br/>
                                    <strong> Course:</strong><br/>
                                    <?php echo $_data['coursecode'] . ":" . $_data['coursename']; ?><br/><br/>
                                   <!-- <strong>ระยะเวลาการอบรม</strong><br/>
                                    <?php echo $CourseDate;?><br/>
                                    <strong>สถานที่ </strong><br/>
                                    <?php echo $_data['place']; ?>-->
                                </td>
                            </tr>
                        </table>
                        </div>
                    </td>
                </tr>
            </table>
            <!--name tag-->
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
<table width="100%" border="0" bgcolor="#FFFFFF">
    <tr>
        <td><p align="center"><br/>
            <input type="button" value="พิมพ์" onclick="window.print();"/></p></td>
    </tr>
</table>


</body>
</html>

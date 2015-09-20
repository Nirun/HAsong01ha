
<div id="tblView">
<br />
<table  border="0" cellspacing="2" cellpadding="2">
<tr>
    <td colspan="9">
        <font class="title">List of people Apply to this Course <br />
            <strong><p valign="middle"><?php echo $data['coursecode'].":". $data['coursename']; ?></p></strong>
        </font>
    </td>
</tr>
<?php

$datetime = date('Y-m-d H:i:s');
$today =  Thaidate::date($datetime,"DD MM YYYY");

$sDate = $data['startdate'];
$eDate = $data['enddate'];
$ResDate = $data['registstartdate'];
$ReeDate = $data['registenddate'];


if ($sDate == "0000-00-00 00:00:00" or $sDate == "0000-00-00" or $sDate == ""
    or $eDate == "0000-00-00 00:00:00" or $eDate == "0000-00-00" or $eDate == ""
    or $ResDate == "0000-00-00 00:00:00" or $ResDate == "0000-00-00" or $ResDate == ""
    or $ReeDate == "0000-00-00 00:00:00" or $ReeDate == "0000-00-00" or $ReeDate == "")
{
    $CourseDate ="ไม่ได้ระบุวันที่อบรม";
    $RegisterDate ="ไม่ได้ระบุวันที่อบรม";
}else{

    //Course Date
    $scDate = Thaidate::date($sDate,"DD MM YYYY");
    $ecDate = Thaidate::date($eDate,"DD MM YYYY");
    $CourseDate = $scDate.' - '.$ecDate;

    //Registration Date
    $rsDate = Thaidate::date($ResDate,"DD MM YYYY");
    $reDate = Thaidate::date($ReeDate,"DD MM YYYY");
    $RegisterDate = $rsDate.' - '.$reDate;
}

//Optionals
$optlist = "";
foreach($optionallist as $_optional):
    $optlist .= $_optional['optional'] ." ";
endforeach;

?>
<tr>
    <td colspan="8" class="info"> <div  class="tab"><p valign="middle"><strong>Today Date: </strong> <?php echo $today; ?></p></div>
        <p align="right">
            <a href="register/course/applylist/show/<?php echo $data['courseID'];?>?height=550&width=980"  target="_blank">
                <img src="<?php echo setting::$BASE_URL; ?>/register/images/printname.gif" width="168" height="22" border="0" />
            </a>
            &nbsp;&nbsp;&nbsp;
            <a href="register/course/applylist/tag/<?php echo $data['courseID'];?>?height=550&width=980" class="thickbox" rel="thickbox_slide1">
                <img src="<?php echo setting::$BASE_URL; ?>/register/images/printtag.gif" width="129" height="22" border="0" />
            </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="register/course/applylist/certificate/<?php echo $data['courseID'];?>?height=550&width=980" class="thickbox" rel="thickbox_slide1">
                <img src="<?php echo setting::$BASE_URL; ?>/register/images/printcer.gif" width="129" height="22" border="0" /></a>
        </p>
        <font class="bottomtext"> รายละเอียดการอบรม</font><br />
        <strong>ระยะเวลาการอบรม</strong>
        <?php echo $CourseDate; ?>
        <br />
        <strong>วันที่รับสมัคร</strong>
        <?php echo $RegisterDate; ?><br />
        <strong>วิทยากร</strong>
        <?php echo $data['speaker']; ?>
        <br />
        <strong>สถานที่ </strong>
        <?php echo $data['place']; ?>
        <br />
        <strong>ค่าลงทะเบียน</strong>
        ท่านละ <?php echo $data['price']; ?> บาท ( <?php echo $optlist; ?>)
   <br />
         <!--  <strong>จำนวนผู้ลงทะเบียน</strong>
        <?php //echo $countRegister; ?> คน <br />-->
        <strong>จำนวนผู้ลงทะเบียน / จ่ายเงินแล้ว</strong>
        <?php echo $countPaid; ?>  คน<br /><br />
           <font class="bottomtext"> รายชื่อคนที่สมัครใน course นี้  (กรณี  เป็นบุคคลที่ผู้อื่นสมัครให้ รายชื่อผู้นั้นจะอยู่ภายใต้ ชื่อคนที่สมัครให้)- </font>
    </td>
</tr>
<tr valign="middle">
    <td align="left" width="15" ><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="10" height="5" border="0"></td>
    <td align="left" width="170"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="160" height="1" border="0"></td>
    <td align="left" ><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="150" height="1" border="0"></td>
    <td align="left" ><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="150" height="1" border="0"></td>
    <td align="left" ><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="90" height="1" border="0"></td>
    <td align="left" ><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="90" height="1" border="0"></td>
    <td align="left" ><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="90" height="1" border="0"></td>
    <td align="left" width="70" ><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="30" height="1" border="0"></td>
</tr>
<?php if ($countPaid == 0){?>
<tr valign="middle">
    <td align="left" class="tab" colspan="8">ไม่พบข้อมูลลงทะเบียนหลักสูตรนี้</td>
</tr>
    <?php }else{?>
<tr valign="middle" bgcolor="#a0cdf9">
    <td align="center" height="30"><p class="fronttext">ลำดับ</p> </td>
    <td align="center" height="30"><p class="fronttext">ชื่อ - นามสกุล</p> </td>
    <td align="center" height="30"><p class="fronttext">สถานพยาบาลต้นสังกัด</p> </td>
    <td align="center" height="30"><p class="fronttext">ประเภทการสมัคร</p> </td>
    <td align="center" height="30"><p class="fronttext">ประเภทอาหาร</p> </td>
    <td align="center" height="30"><p class="fronttext">วันที่สมัคร</p> </td>
    <td align="center" height="30"><p class="fronttext">วันชำระเงิน</p> </td>
    <td align="center" height="30"><p class="fronttext">ดูรายละเอียด</p> </td>
    <td align="center" height="30"><p class="fronttext">เปลียนชื่อ</p> </td>
</tr>
    <?php
    $i = 1;
    foreach ($reglist as $_reglist):

        //prefix
        if ($_reglist['prefix'] == 6 ){
            $prefix = $_reglist['prefix_other'];
        }else{
            $prefix = $_reglist['title_th'];
        }

        //trainee ID
        $traineeID = $_reglist['traineeID'];

        //trainee name
        $trainee = $prefix ." ". $_reglist['name']." ".$_reglist['lastname'];

        //hospital name
        if ($_reglist['hospitalother'] != ""){
            $hospital = $_reglist['hospitalother'];
        }else{
            $hospital = $_reglist['hospitalname'];
        }

        //register type
        $regType= $_reglist['type_name'];


        //register date
        $regDate = $_reglist['registerdatetime'];
        if ($regDate == "0000-00-00 00:00:00" or $regDate == "0000-00-00" or $regDate == ""){
            $registeredDate= "ยังไม่ได้ลงทะเบียน";
        }else{
            $registeredDate = Thaidate::date($regDate,"DD MM YY");
        }

        //Payment
        if($_reglist['IsPaid'] == 1 ){
            //payment date
            $pDate = $_reglist['receipt_date'];
            if ($pDate == "0000-00-00 00:00:00" or $pDate == "0000-00-00" or $pDate == "") {
                $paiddate = "รอชำระเงิน";
            } else {
                $paiddate = Thaidate::date($pDate, "DD MM YY");
            }
        } else {
            $paiddate = "รอชำระเงิน";
        }

        //change name
        if (!empty($_reglist['cpother'])){
            $cpprefix = $_reglist['cpother'];
        }else{
            $cpprefix = $_reglist['cprefix'];
        }

        if (!empty($_reglist['cpname']) && !empty($_reglist['cplastname'])){
            $changename = $cpprefix ." ". $_reglist['cpname']." ".$_reglist['cplastname'];
        }else{
            $changename = '';
        }

        ?>
    <tr valign="middle">
        <td align="left" class="info"><?php echo $i; ?></td>
        <td align="left" class="info">
          <?php if($changename == ''){?>
            <?php echo $trainee; ?>
          <?php }else{?>
            <?php echo $changename; ?>
          <?php } ?>
        </td>
        <td align="left" class="info"><?php echo $hospital; ?></td>
        <td align="left" class="info"><?php echo $regType; ?></td>
        <td align="left" class="info"><?php echo $_reglist['food']; ?></td>
        <td align="left" class="info"><?php echo $registeredDate; ?></td>
        <td align="left" class="info"><?php echo $paiddate; ?></td>
        <td align="left" class="info"><a href="register/course/traineedetails/<?php echo $traineeID;?>/<?php echo $data['courseID'];?>?height=550&width=980" class="thickbox" rel="thickbox_slide1">
            <img src="<?php echo setting::$BASE_URL; ?>/register/images/view.gif" width="92" height="21" border="0" /></a>
        </td>
        <td align="center" class="info">
            <a id="bobcontent<?php echo $i; ?>-title"  class="handcursor">
                <img src="<?php echo setting::$BASE_URL; ?>/register/images/edit.gif" width="34" height="24" border="0" />
            </a><br>
        </td>
    </tr>
    <tr>
        <td colspan="9">
            <?php //echo "bobcontent".$i;?>
            <div id="<?php echo "bobcontent".$i;?>" class="switchgroup1">
                <table  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left"  width="50" >
                            <img src="<?php echo setting::$BASE_URL ?>register/images/blank.gif" alt="" width="10" height="5" border="0">
                        </td>
                        <td width="160"class="info">ชื่อ<br /><input name="changename[]" id="changename" type="text" style="width:150px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></td>
                        <td width="160" class="info">นามสกุล<br /><input name="changelastname[]" id="changelastname" type="text"  style="width:150px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></td>
                        <td align="left"  width="50" >
                            <a href="javascript:bobexample.sweepToggle('contract')" class="btn"><img src="<?php echo setting::$BASE_URL ?>/register/images/save.gif" width="44" height="26" border="0" /></a>
                        </td>
                        <td align="left">*** ต้องเป็นชื่อที่มีอยู่ในฐานข้อมูลเท่านั้น ***</td>
                        <input type="hidden" id="traineeID" name="traineeID" value="<?php echo $traineeID;?>">
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <?php
        $i++;
    endforeach;
    ?>
    <tr valign="middle">
        <td colspan="9" class="info" align="left"><div  class="tab" valign="middle" >ประวัติการเปลียนชื่อผู้เข้าอบรม</div>
            <table  border="0" cellspacing="3" cellpadding="3" id="tblChange">
                <tr valign="top">
                    <td><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="60" height="1" border="0"></td>
                    <td><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="200" height="1" border="0"></td>
                    <td> <img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="200" height="1" border="0"></td>
                </tr>
                <tr valign="middle" bgcolor="#c8c8c8">
                    <td class="fronttext">&nbsp;&nbsp;  เมื่อวันที่ &nbsp;&nbsp;</td>
                    <td class="fronttext" height="30">&nbsp;&nbsp; เปลี่ยนชื่อลงทะเบียนเดิม &nbsp;&nbsp;</td>
                    <td class="fronttext">&nbsp;&nbsp;  เป็นชื่อคนปัจจุบัน &nbsp;&nbsp;</td>
                </tr>
                <?php
                foreach ($changelist as $_changelist):
                    //master trainee prefix
                    if ($_changelist['mprefix'] == 7 ){
                        $mprefix = $_changelist['mpreother'];
                    }else{
                        $mprefix = $_changelist['mtitle'];
                    }

                    //Change Date
                    $cDate = $_changelist['changedatetime'];
                    if ($cDate == "0000-00-00 00:00:00" or $cDate == "0000-00-00" or $cDate == ""){
                        $changeDate= "ไม่ได้ระบุวันที่";
                    }else{
                        $changeDate = Thaidate::date($cDate,"DD MM YYYY");
                    }

                    //master trainee name
                    $mastertrainee = $mprefix ." ". $_changelist['mname']." ".$_changelist['mlastname'];

                    //Changed trainee name
                    if ($_changelist['tcprefix'] == 7 ){
                        $tcprefix = $_changelist['tcpreother'];
                    }else{
                        $tcprefix = $_changelist['tctitle'];
                    }
                    $changetrainee =  $tcprefix ." ". $_changelist['name']." ".$_changelist['lastname'];

                    ?>
                    <tr valign="top">
                        <td><?php echo $changeDate; ?></td>
                        <td class="info"><?php echo $mastertrainee; ?> </td>
                        <td><?php echo $changetrainee; ?></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </table>
        </td>
    </tr>
    <?php } ?>
    <tr valign="middle">
    <td colspan="9" class="info" align="center">
        <?php //echo $data['courseID'];?>
        <input type="hidden" id="courseID" name="courseID" value="<?php echo($data['courseID']);?>">
        <!-- <br /><input type="button" value="Print this Page" onclick="window.print();"/>-->
    </td>
</tr>
</table>
</div>

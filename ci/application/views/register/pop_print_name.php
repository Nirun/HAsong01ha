<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <LINK REL="stylesheet" HREF="<?php echo setting::$BASE_URL ?>/register/style.css" TYPE="text/css">
    <title><?php echo setting::$WINDOW_TITLE ?></title>
</head>
<body>
<table border="0" cellspacing="3" cellpadding="3" bgcolor="#FFFFFF" width="100%">
<tr valign="top">
<td>
<br/>
<table border="0" cellspacing="2" cellpadding="2" width="98%" align="center">
    <?php

    //Course Date
    $sDate = $data['startdate'];
    $eDate = $data['enddate'];

    if ($sDate == "0000-00-00 00:00:00" or $sDate == "0000-00-00" or $sDate == ""
        or $eDate == "0000-00-00 00:00:00" or $eDate == "0000-00-00" or $eDate == ""
    ) {
        $CourseDate = "ไม่ได้ระบุวันที่อบรม";
    } else {
        $scDate = Thaidate::date($sDate, "DD MM YYYY");
        $ecDate = Thaidate::date($eDate, "DD MM YYYY");
        $CourseDate = $scDate . ' - ' . $ecDate;
    }

    //optinal
    $optlist = "";
    foreach ($optionallist as $_optional):
        $optlist .= $_optional['optional'] . " ";
    endforeach;

    //count paid trainees
    $cntPaid = count($reglist);
    //echo $cntPaid;

    ?>
    <tr valign="middle" bgcolor="#FFFFFF">
        <td colspan="4" class="info" align="left">
            <br/><br/>
            <div class="tab"><p valign="middle"><?php echo $data['coursecode'] . ":" . $data['coursename']; ?></p></div>
            <br/>
            <font class="bottomtext"> รายละเอียดการอบรม</font><br/>
            <strong>ระยะเวลาการอบรม</strong>
            <?php echo $CourseDate; ?>
            <br/>
            <strong>วิทยากร</strong>
            <?php echo $data['speaker']; ?>
            <br/>
            <strong>สถานที่ </strong>
            <?php echo $data['place']; ?>
            <br/>
            <strong>ค่าลงทะเบียน</strong>
            ท่านละ <?php echo $data['price']; ?> บาท ( <?php echo $optlist; ?>)
            <br/>
            <!-- <strong>จำนวนผู้ลงทะเบียน</strong>
            <?php //echo $countRegister; ?> คน <br />-->
            <strong>จำนวนผู้ลงทะเบียน</strong>
            <?php echo $countPaid; ?>  คน
            <br/><br>
            <!--<input name="" type="button" value="Export to Excel file" />-->
            <a target="_blank"
               href="<?php echo setting::$BASE_URL . '/register/course/applylist/namelist/' . $courseID;?>">
                <img src="<?php echo Setting::$BASE_URL;?>/register/images/excel.jpg" border="0">
            </a>
        </td>
    </tr>
</table>
<!--list--><br/>

<table border="0" cellspacing="2" cellpadding="2" width="98%" align="center">
<?php if ($cntPaid == 0) { ?>
    <tr valign="middle" bgcolor="#FFFFFF">
        <td align="center" class="tab" colspan="9">ไม่พบรายชื่อผู้ลงทะเบียนที่ชำระเงินแล้ว</td>
    </tr>
    <?php } else { ?>
    <tr valign="middle" bgcolor="#a0cdf9">
        <td align="center" height="30" width="50"><p class="fronttext">ลำดับ</p></td>
        <td align="center" height="30" width="50"><p class="fronttext">เลขที่นั่ง</p></td>
        <td align="center" height="30" width="50"><p class="fronttext">คำนำหน้า</p></td>
        <td align="center" height="30" width="100"><p class="fronttext">ชื่อ - นามสกุล</p></td>
        <td align="center" height="30" width="80"><p class="fronttext">วิชาชีพ</p></td>
        <td align="center" height="30" width="80"><p class="fronttext">ชื่อรพ.</p></td>
        <td align="center" height="30" width="200"><p class="fronttext">ที่อยู่</p></td>
        <td align="center" height="30" width="80"><p class="fronttext">เบอร์โทร</p></td>
        <td align="center" height="30" width="90"><p class="fronttext">Email</p></td>
        <td align="center" height="30" width="90"><p class="fronttext">อาหาร</p></td>
        <td align="center" height="30" width="30"><p class="fronttext">ลงชื่อ</p></td>
    </tr>
    <?php
    $i = 1;
    foreach ($reglist as $_reglist):

        //prefix
        if ($_reglist['prefix'] == 6) {
            $prefix = $_reglist['prefix_other'];
        } else {
            $prefix = $_reglist['title_th'];
        }

        //trainee name
        $trainee =  $_reglist['name'] . " " . $_reglist['lastname'];

        //hospital name
        if ($_reglist['hospitalother'] != "") {
            $hospital = $_reglist['hospitalother'];
        } else {
            //$hospital = $_reglist['hospitalID'];
            $hospital = $_reglist['hospitalname'];
        }

        //change name
        if (!empty($_reglist['cpother'])) {
            $cpprefix = $_reglist['cpother'];
        } else {
            $cpprefix = $_reglist['cprefix'];
        }

        if (!empty($_reglist['cpname']) && !empty($_reglist['cplastname'])) {
            $changename = $cpprefix . " " . $_reglist['cpname'] . " " . $_reglist['cplastname'];
        } else {
            $changename = '';
        }

        //phone no.
        if ($_reglist['tel'] != "") {
            $phone = $_reglist['tel'];
        } else {

            $phone = $_reglist['mobile'];
        }


        //occupation
        if ($_reglist['positionID'] == 7) {
            $occupation = $_reglist['positionother'];
        } else {
            $occupation = $_reglist['occupation'];
        }

        if ($i % 2 == 0) {
            $bgcolor = '#eeeeee';
        } else {
            $bgcolor = '';
        }

        ?>
        <tr valign="middle" bgcolor="<?php echo $bgcolor; ?>" class="info">
            <td align="center" height="50"><?php echo $i; ?></td>
            <td align="left" height="50">&nbsp;<?php echo $_reglist['seatno']; ?> </td>
            <td align="left" height="50">&nbsp;<?php echo $prefix; ?> </td>
            <td align="left" height="50">
                <?php if ($changename == '') { ?>
                <?php echo $trainee; ?>
                <?php } else { ?>
                <?php echo $changename; ?>
                <?php } ?>
            </td>
            <td align="left" height="50">&nbsp;<?php echo $occupation; ?> </td>
            <td align="left" height="50"><?php echo $hospital; ?></td>
            <td align="left" height="50">&nbsp;<?php echo $_reglist['address']; ?> </td>
            <td align="left" height="50">&nbsp;<?php echo $phone; ?> </td>
            <td align="left" height="50">&nbsp;<?php echo $_reglist['email']; ?> </td>
            <td align="left" height="50">&nbsp;<?php echo $_reglist['food']; ?> </td>
            <td align="left" height="50">&nbsp;</td>
        </tr>

        <?php
        $i++;
    endforeach;
    ?>
<!--
    <tr valign="middle" bgcolor="#FFFFFF">
        <td align="left" width="10"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt=""
                                         width="10" height="5" border="0"></td>
        <td align="left" width="100" height="20"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif"
                                                      alt="" width="100" height="1" border="0"></td>
        <td align="left" width="150" height="20"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif"
                                                      alt="" width="150" height="1" border="0"></td>
        <td align="left" width="100" height="20"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif"
                                                      alt="" width="100" height="1" border="0"></td>
        <td align="left" width="150" height="20"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif"
                                                      alt="" width="150" height="1" border="0"></td>
        <td align="left" width="150" height="20"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif"
                                                      alt="" width="150" height="1" border="0"></td>
        <td align="left" width="150" height="20"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif"
                                                      alt="" width="150" height="1" border="0"></td>
        <td align="left" width="150" height="20"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif"
                                                      alt="" width="150" height="1" border="0"></td>
        <td align="left" width="150" height="20"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif"
                                                      alt="" width="150" height="1" border="0"></td>
    </tr>
    -->
    </table>
            <table border="0" cellspacing="3" cellpadding="3" width="98%" align="center">
    <tr valign="middle" bgcolor="#FFFFFF">
        <td colspan="4" class="info" align="left"><br/>

            <div class="tab" valign="middle">ประวัติการเปลียนชื่อ คนอบรม</div>
            <table border="0" cellspacing="3" cellpadding="3" bgcolor="#FFFFFF" width="100%">
                <tr valign="middle" bgcolor="#c8c8c8">
                    <td class="fronttext">&nbsp;&nbsp; เมื่อวันที่ &nbsp;&nbsp;</td>
                    <td class="fronttext" height="30">&nbsp;&nbsp; เปลี่ยนชื่อลงทะเบียนเดิม &nbsp;&nbsp;</td>
                    <td class="fronttext">&nbsp;&nbsp; เป็นชื่อคนปัจจุบัน &nbsp;&nbsp;</td>
                </tr>
                <?php
                foreach ($changelist as $_changelist):
                    //master trainee prefix
                    if ($_changelist['mprefix'] == 7) {
                        $mprefix = $_changelist['mpreother'];
                    } else {
                        $mprefix = $_changelist['mtitle'];
                    }

                    //Change Date
                    $cDate = $_changelist['changedatetime'];
                    if ($cDate == "0000-00-00 00:00:00" or $cDate == "0000-00-00" or $cDate == "") {
                        $changeDate = "ไม่ได้ระบุวันที่";
                    } else {
                        $changeDate = Thaidate::date($cDate, "DD MM YYYY");
                    }

                    //master trainee name
                    $mastertrainee = $mprefix . " " . $_changelist['mname'] . " " . $_changelist['mlastname'];

                    //Changed trainee name
                    if ($_changelist['tcprefix'] == 7) {
                        $tcprefix = $_changelist['tcpreother'];
                    } else {
                        $tcprefix = $_changelist['tctitle'];
                    }
                    $changetrainee = $tcprefix . " " . $_changelist['name'] . " " . $_changelist['lastname'];

                    ?>
                    <tr valign="top" bgcolor="#FFFFFF">
                        <td><?php echo $changeDate; ?></td>
                        <td class="info"><?php echo $mastertrainee; ?> </td>
                        <td><?php echo $changetrainee; ?></td>
                    </tr>

                    <tr valign="top">
                        <td><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="60"
                                 height="1" border="0"></td>
                        <td><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="200"
                                 height="1" border="0"></td>
                        <td><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="200"
                                 height="1" border="0"></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </table>
        </td>
    </tr>
    <?php } ?><br/>
    <br/>
    &nbsp;
</table>
</td>
</tr>
</table>
</body>
</html>
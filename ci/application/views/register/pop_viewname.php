<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <LINK REL="stylesheet" HREF="<?php echo setting::$BASE_URL ?>/register/css/style.css" TYPE="text/css">
    <title><?php echo setting::$WINDOW_TITLE ?></title>
</head>

<body><br/>

<table border="0" cellspacing="2" cellpadding="2">
    <tr valign="top">
        <td colspan="3"><font class="title">รายละเอียดและประวัติผู้เข้าร่วมอบรม</font></td>
    </tr>
    <tr valign="top">
        <td width="450">
            <div class="tab">รายละเอียดผู้เข้าร่วมอบรม</div>
            <!--article1-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top">
                    <td class="info">
                        <table border="0" cellspacing="3" cellpadding="3">
                            <?php
                            $img = ($data['photo'] != '') ? $data['photo'] : 'default.jpg';
                            ?>
                            <tr valign="bottom">
                                <td><img src="<?php echo Setting::$PATE_TRIANEE . $img ?>" width="180" height="200"
                                         border="1"/></td>
                                <td> <?php
                                    $barcode = $data['cardID'];
                                    if ($barcode != ""){
                                        echo '<img src ="' . setting::$BASE_URL . '/register/user/barcode/' . $barcode . '">';
                                    }

                                    ?>
                                </td>
                            </tr>
                        </table>
                        <?php
                        if ($data['prefix'] == 6) {
                            $prefix = $data['prefix_other'];
                        } else {
                            $prefix = $data['title'];
                        }
                        ?>
                        <br/><br/>
                        <strong><?php echo $prefix . " " . $data['name'] . " " . $data['lastname'];?></strong>
                        <br/>
                        <strong>เลขบัตรประชาชน: </strong><?php echo $data['cardID']; ?><br/>
                        <strong>อีเมล์ :</strong> <?php echo $data['email']; ?>
                        <br/>
                        <a href="register/mail/"><img src="<?php echo setting::$BASE_URL ?>/images/senduseremail.jpg"
                                                      border="0"/></a>
                        <br/>
                        <br/>
                        <font class="bottomtext">สถานะการสมัคร: </font> <?php echo $data['typename']; ?><br/><br>
                        <?php if ($data['registrationtype'] == 3) { ?>
                        <strong>รายละเอียดผู้ประสานงาน </strong>
                        <br/>
                        <?php echo $data['cohosname'] . " " . $data['cohoslastname']; ?><br/>
                        <strong>เบอร์โทรศัพท์ :</strong><?php echo $data['cohostel'] ?><br/>
                        <strong>เบอร์โทรศัพท์มือถือ :</strong><?php echo $data['cohosmobile'] ?><br/>
                        <strong>เบอร์Fax :</strong><?php echo $data['cohosfax'] ?><br/>
                        <strong>อีเมล์ :</strong><?php echo $data['cohosemail'] ?>
                        <br/>
                        <br/>
                        <?php } ?>
                        <font class="bottomtext"> สถานะการทำงาน</font>
                        <br/>
                        <?php
                        if ($data['professiontypeID'] == 7) {
                            $occupation = $data['professionother'];
                        } else {
                            $occupation = $data['occupation'];
                        }
                        if ($data['positionID'] == 6) {
                            $position = $data['positionother'];
                        } else {
                            $position = $data['position'];
                        }

                        if ($data['hospitalother'] != "") {
                            $hospital = $data['hospitalother'];
                        } else {
                            $hospital = "รพ." . $data['hospitalname'] . " " . $data['province'];
                        }
                        ?><br>
                        <strong>วิชาชีพ: </strong><?php echo $occupation;?><br/>
                        <strong>สถานพยาบาลต้นสังกัด: </strong>
                        <?php echo $hospital;?><br/>
                        <br/>
                        <font class="bottomtext"> ตำแหน่งสายการบริหาร: </font>
                        <?php echo $position;?>
                        <br/> <br/>
                        <font class="bottomtext">ที่อยู่ส่งเอกสาร: <?php echo $data['address_type_name'];?> </font>
                        <br/>
                        <?php echo $data['taddress'] . " " . $data['tprovince'] . " " . $data['postcode'];?><br/>
                        <strong>เบอร์โทรศัพท์ :</strong> <?php echo $data['tel'];?><br/>
                        <strong>เบอร์โทรศัพท์มือถือ :</strong> <?php echo $data['mobile'];?><br/>
                        <strong>เบอร์Fax :</strong> <?php echo $data['fax'];?>
                    </td>
                </tr>
            </table>
            <!--article1--><br/>
            <input type="button" value="Print this Page" onclick="window.print();"/></td>
        <td align="left"><img src="images/blank.gif" alt="" width="5" height="1" border="0"></td>
        <td>
            <div class="tab">ประวัติการอบรม</div>
            <!--article-->
            <table width="250" border="0" cellspacing="2" cellpadding="2">
                <tr valign="top" bgcolor="#d4d4d4">
                    <td align="left" class="fronttext">no.</td>
                    <td align="left" class="fronttext" height="30">&nbsp;ระยะเวลา</td>
                    <td align="left" class="fronttext">&nbsp;หัวข้อหลักสูตร</td>
<!--                    <td align="center" class="fronttext">&nbsp;ประเภท<br/>การสมัคร</td>-->
                </tr>
                <?php
                $rowC = 0;
                foreach ($list_course as $keyC => $valC):
                    $rowC++;

                    //Course Date
                    $sDate = $valC['startdate'];
                    $eDate = $valC['enddate'];

                    if ($sDate == "0000-00-00 00:00:00" or $sDate == "0000-00-00" or $sDate == ""
                        or $eDate == "0000-00-00 00:00:00" or $eDate == "0000-00-00" or $eDate == ""
                    ) {
                        $CourseDate = "ไม่ได้ระบุวันที่อบรม";

                    } else {
                        $CourseDate = Thaidate::date($sDate, "DD MM YYYY") . ' - ' . Thaidate::date($eDate, "DD MM YYYY");
                    }

                    ?>
                    <tr valign="top">
                        <td align="left" bgcolor="#a0cdf9"><p class="fronttext"><?php echo $rowC; ?> </p></td>
                        <td align="left" class="info" height="30"><?php echo $CourseDate;?></td>
                        <td align="left" class="info"><?php echo $valC['coursecode'];?>
                            : <?php echo $valC['coursename'];?>
                            รุ่นที่ <?php echo $valC['generation'];?>
                        </td>
<!--                        <td align="center" class="info">--><?php //echo $valC['typename'];?><!--</td>-->
                    </tr>
<!--                    --><?php //if ($valC['paymentID'] != 0) { ?>
<!--                    <tr valign="top">-->
<!--                        <td align="left" class="info" colspan="4"><font-->
<!--                                class="bottomtext">วิธีการการชำระเงิน</font><br/>-->
<!--                            <strong> --><?php //echo $valC['paymenttype'];?><!--</strong><br>--><?php //echo $valC['detail'];?>
<!--                            --><?php //if ($valC['paymentID'] == 5) { ?>
<!--                                <strong> เช็ค</strong> เลขที่ --><?php //echo $valC['cheuqeno']; ?>
<!--                                ธนาคาร --><?php //echo $valC['bankname']; ?>
<!--                                --><?php //} ?>
<!--                        </td>-->
<!--                    </tr>-->
<!--                    --><?php //} else { ?>
<!--                    <tr valign="top">-->
<!--                        <td align="left" class="info" colspan="4"><font class="bottomtext">รอการชำระเงิน</font></td>-->
<!--                    </tr>-->
<!--                    --><?php //} ?>
                    <tr valign="top">
                        <td colspan="4">
                            <div class="hr dotted">&nbsp;</div>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
                <tr valign="top">
                    <td align="left"><img src="images/blank.gif" alt="" width="10" height="1" border="0"></td>
                    <td align="left"><img src="images/blank.gif" alt="" width="100" height="1" border="0"></td>
                    <td align="left"><img src="images/blank.gif" alt="" width="245" height="1" border="0"></td>
                    <td align="left"><img src="images/blank.gif" alt="" width="100" height="1" border="0"></td>
                </tr>
            </table>
            <br/>
            <!--<input type="button" value="Back" class="button">-->
            <div id="space"></div>
            <!--article-->
        </td>
    </tr>
</table>
</body>
</html>

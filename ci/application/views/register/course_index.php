<div id="container">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">
            <td align="left">
                <a href="register/course/form"><img src="register/images/addcourse.jpg" border="0"/></a>
            </td>
            <td align="right">
            <!--search-->
                <form name="frm" method="get" enctype="application/x-www-form-urlencoded" id="frm" action="<?php echo setting::$BASE_URL;?>/register/course/index/1/">
                    <font class="bottomtext">ค้นหาหลักสูตร</font><br>
                    <table cellspacing="2" cellpadding="2" border="0">
                        <tr valign="top">
                            <td align="right" class="info">รหัสหลักสูตร</td>
                            <td align="left" colspan="3">&nbsp;
                                <select name="course"  style="  width: 200px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;">
                                <option value="" selected="selected">เลือกรหัสหลักสูตร</option>
                                <?php // todo 2014
                                foreach ($course_list as $key => $valC):
                                    $c_name = $valC['coursecode']. ':'.' รุ่น '.$valC['generation'] ."/".Thaidate::date($valC['gen_year'],"YYYY");
                                ?>
<!--                                <option value="--><?php //echo $valC['coursecode']?><!--">--><?php //echo $c_name?><!--</option>-->
                                    <option value="<?php echo $valC['courseID']?>"><?php echo $c_name?></option>

                                <?php
                                endforeach;
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr valign="middle">
                            <td align="right" class="info">เดือนที่มีการอบรม</td>
                            <td align="left" colspan="3">&nbsp;
                                <?php
                                $thaimonth = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน",
                                    "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม",
                                    "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
                                //var_dump($thaimonth);
                                $cMonth = count($thaimonth);
                                //echo $cMonth;
                                ?>
                                <select name="month"  style="width: 150px;  border-top:1px solid #BEC4DC; border-left:1px solid
#BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px;
margin-top:2px; margin-bottom:2px;">
                                    <option value="0">.:: เลือก ::.</option>
                                    <?php
                                    $i = 1;
                                    foreach ($thaimonth as $month) {
                                        echo '<option value="' . $i . '">' . $month . '</option>';
                                        $i++;
                                    }
                                    ?>
                                </select>
                                <?php
                                $cYear = date('Y')+543;
                                $sYear = $cYear -10;
                                $eYear = $cYear+2;
                                //echo $cYear;
                                ?>
                                <select name="year" style="width: 70px;  border-top:1px solid #BEC4DC; border-left:1px solid
#BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px;
margin-top:2px; margin-bottom:2px;">
                                    <option value="0">.:: ปี ::.</option>
                                    <?php
                                        foreach (range ($eYear,$sYear) as $val) {
                                        $_val = $val - 543;
                                        ?>
                                    <option value="<?=$val?>"><?=$val?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="right" class="info">สถานะ</td>
                            <td align="left" colspan="3">&nbsp;
                                <select name="status"  style="  width: 100px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;">
                                    <option value="0" selected="selected">.:: สถานะ ::.</option>
                                    <option value="0">Active</option>
                                    <option value="1">Inactive</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">&nbsp;</td>
                            <td align="right">
                                <input type="submit" value="ค้นหา" class="button">
                            </td>
                        </tr>
                    </table>
                </form>
                <!--search-->
            </td>
        </tr>
    </table>
    <!--page-->
    <div class="hr dotted"></div>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr valign="middle">
            <td align="right" height="40">
                <?php
                echo $paging;
                ?>
            </td>
        </tr>
    </table>
    <!--page-->
    รายชื่อหัวข้อหลักสูตรทั้งหมด เรียงลำดับตามวันที่การอบรม - การอบรมที่ผ่านวันที่ปัจจุบันจะถูกเก็บไว้ในคลังข้อมูล
    ท่านสามารถค้นหาได้โดยการใช้ search function ด้านบน<br/>
    <br/>
    <!--article-->
    <?php //echo $cntCourse; ?>
    <?php if ($cntCourse == 0) { ?>
    <table border="0" cellspacing="2" cellpadding="2">
        <tr valign="top">
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="150"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="330"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="60"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="80"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="60"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="60"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="60"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="30"
                                  height="1" border="0"></td>
        </tr>
        <tr valign="top">
            <td align="center" class="tab" colspan="8" valign="middle">ไม่พบหัวข้อหลักสูตร</td>
        </tr>
    </table>
    <?php } else { ?>
    <table border="0" cellspacing="2" cellpadding="2">
        <tr valign="top">
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="150"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="330"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="60"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="80"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="60"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="60"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="30"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="30"
                                  height="1" border="0"></td>
            <td align="left"><img src="<?php echo setting::$BASE_URL; ?>register/images/blank.gif" alt="" width="30"
                                  height="1" border="0"></td>
        </tr>
        <tr valign="middle" bgcolor="#a0cdf9">
            <td align="center" height="30"><p class="fronttext"> ระยะเวลาการอบรม </p></td>
            <td align="center"><p class="fronttext">หัวข้อหลักสูตร </p></td>
            <td align="center"><p class="fronttext">เปิดลงทะเบียน </p></td>
            <td align="center"><p class="fronttext">ลงทะเบียน</p></td>
            <td align="center"><p class="fronttext">ดูรายละเอียด</p></td>
            <td align="center"><p class="fronttext">ส่ง email ไปยังกลุ่มนี้ </p></td>
            <td align="center"><p class="fronttext">แก้ไข</p></td>
            <td align="center"><p class="fronttext">สถานะ</p></td>
            <td align="center"><p class="fronttext">ลบ</p></td>
        </tr>
        <?php
        $i = 1;
        foreach ($data as $val):

            $sDate = $val['startdate'];
            $eDate = $val['enddate'];

            if ($sDate == "0000-00-00 00:00:00" or $sDate == "0000-00-00" or $sDate == ""
                or $eDate == "0000-00-00 00:00:00" or $eDate == "0000-00-00" or $eDate == ""
            ) {
                $date = "ไม่ได้ระบุวันที่อบรม";
            } else {
                $scDate = Thaidate::date($sDate, "DD MM YY");
                $ecDate = Thaidate::date($eDate, "DD MM YY");
                $date = $scDate .'-'. $ecDate;
            }

            $course = $val['coursecode'] . ':' . $val['coursename'];
            $generation = $val['generation'];
            $traninees = $val['limittrainees'];

            if (is_null($val['CntReg'])) {
                $registration = 0;
            } else {
                $registration = $val['CntReg'];
            }

            $courseID = $val['courseID'];

            if ($i % 2 == 0) {
                $bgcolor = '#eeeeee';
            } else {
                $bgcolor = '';
            }
            ?>
            <tr valign="middle" bgcolor="<?php echo $bgcolor; ?>">
                <td align="left" class="info"><?php echo $date; ?></td>
                <td align="left" class="info"><?php echo $course; ?><br/><b>รุ่นที่ <?php echo $generation; ?></b></td>
                <td align="center" class="info"><?php echo $traninees; ?></td>
                <td align="center" class="info"><?php echo $registration; ?></td>
                <td align="center" class="info"><?php //echo $courseID ?>
                    <a href="register/course/applylist/edit/<?php echo $courseID;?>">
                        <img src="images/view.gif" width="92" height="21" border="0"/></a>
                </td>
                <td align="center" class="info">
                    <a href="register/mail/"><img src="register/images/sendemail.jpg" border="0"/></a>
                </td>
                <td align="center" class="info">
                    <a href="register/course/edit/<?php echo $courseID; ?>"><img src="register/images/edit.gif" border="0"/></a>
                </td>
                <td align="center" class="info">
                    <?php if ($val['IsActive']==0) {?>
                        <a href="register/course/status/<?php echo $courseID; ?>/1"><img src="register/images/btActive.jpg" border="0"/>
                    <?php }else{ ?>
                        <a href="register/course/status/<?php echo $courseID; ?>/0"><img src="register/images/btInactive.jpg" border="0"/>
                    <?php }?>
                </td>
                <td align="center" class="info">
                    <a href="register/course/del/<?php echo $courseID; ?>"
                       onclick="return confirm('คุณต้องการจะลบข้อมูลนี้หรือไม่?')">
                        <img src="register/images/delete.gif" border="0"/></a>
                </td>
            </tr>
            <?php
            $i++;
        endforeach;
        ?>
    </table>
    <?php } ?>
    <!--article-->
    <div id="space"></div>
</div>


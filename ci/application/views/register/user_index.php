<div id="container"><font class="title">รายชื่อผู้เข้าร่วมสมัครอบรม</font>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top">
        <td align="left"><!--<input type="button" value="  เพิ่มรายชื่อผู้เข้าร่วมอบรม  " class="button"
                                onclick="location='<?php echo setting::$BASE_URL;?>/register/user/form'">--></td>
        <td align="right"><!--search-->
            <form name="form_search" method="get" enctype="application/x-www-form-urlencoded" id="form_search"
                  action="register/user/index/1/">

                <!--search--><font class="bottomtext">ค้นหารายชื่อผู้เข้าร่วมสมัครอบรม
                เลือกอย่างน้อยหนึ่งหัวข้อ</font><br>

                <table cellspacing="2" cellpadding="2" border="0">
                    <tr valign="top">
                        <td align="right" class="info"> ชื่อ</td>
                        <td align="left"><input name="name" id="name" type="text" value="<?php echo trim($g_name);?>"
                                                style="  width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                        </td>
                        <td align="right" class="info"> นามสกุล</td>
                        <td align="left"><input name="lastname" id="lastname" type="text"
                                                value="<?php echo trim($g_lastname);?>"
                                                style="  width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                        </td>
                    </tr>
                    <tr valign="top">
                        <td align="right" class="info">ประเภทการสมัคร</td>
                        <td align="left" colspan="3">
                            <table border="0" cellspacing="2" cellpadding="2">
                                <tr>
                                    <?php
                                    $register_type[] = array('type_name'=>'All','type_id'=>'');
                                    foreach ($register_type as $type) :
                                        $chk1 = ($type['type_id'] == $g_register_type) ? 'checked="checked"' : '';
                                        ?>
                                        <td>&nbsp;&nbsp;<input name="register_type" type="radio" <?php echo $chk1;?>
                                                               value="<?php echo $type['type_id']?>"/></td>
                                        <td><?php echo $type['type_name']?></td>
                                        <?php
                                    endforeach;
                                    ?>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr valign="top">
                        <td align="right" class="info">วิชาชีพ</td>
                        <td align="left" colspan="3"><select name="position" tabIndex="8"
                                                             style="  width: 150px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;">

                            <option value="">เลือกวิชาชีพ</option>
                            <?php
                            foreach ($occupation as $row) :
                                $chk2 = ($row['id'] == $g_occupation) ? 'selected="selected"' : '';
                                ?>
                                <option <?php echo $chk2;?>
                                        value="<?php echo $row['id']?>"><?php echo $row['title_th']?></option>
                                <?php
                            endforeach;
                            ?>
                        </select></td>
                    </tr>

                    <tr valign="top">
                        <td align="right" class="info"> สถานพยาบาลต้นสังกัด</td>
                        <td align="left" colspan="3"><select name="hospital" tabIndex="8"
                                                             style="  width: 320px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;">
                            <option value="" selected="selected">เลือกสถานพยาบาล</option>
                            <option value="AL">ไม่สังกัด สถานพยาบาล</option>
                            <?php
                            foreach ($hospital_list as $key => $valH):
                                $chk3 = ($valH['hospitalid'] == $g_hospital) ? 'selected="selected"' : '';
                                ?>
                                <option <?php echo $chk3;?>
                                        value="<?php echo $valH['hospitalid']?>"><?php echo $valH['name']?></option>
                                <?php
                            endforeach;
                            ?>
                        </select></td>
                    </tr>

                    <tr valign="top">
                        <td align="right" class="info">หัวข้อหลักสูตร</td>
                        <td align="left" colspan="3"><select name="course" tabIndex="8"
                                                             style="  width: 320px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;">
                            <option value="" selected="selected">เลือกหัวข้อหลักสูตร</option>
                            <?php
                            foreach ($course_list as $key => $valC):
                                $c_name = $valC['coursecode'] . ':' . $valC['coursename'] .' รุ่น '.$valC['generation'];
                                $chk4 = ($valC['courseID'] == $g_course) ? 'selected="selected"' : '';
                                ?>
                                <option <?php echo $chk4;?>
                                        value="<?php echo $valC['courseID']?>"><?php echo $c_name?></option>
                                <?php
                            endforeach;
                            ?>
                        </select></td>
                    </tr>
                    <tr valign="top">
                        <td align="right" class="info">&nbsp;</td>
                        <td align="left" colspan="3"><input type="submit" value="Search" class="button">
                        </td>
                    </tr>
                </table>
                <!--search--></form>
            <!--search--></td>
    </tr>
</table>

<!--page-->
รายชื่อผู้เข้าร่วมสมัครอบรมทั้งหมด เรียงลำดับการอบรมที่เปิดล่าสุด<br/>
การอบรมที่ผ่านวันที่ปัจจุบันจะถูกเก็บไว้ในคลังข้อมูล ท่านสามารถค้นหาได้โดยการใช้ search function ด้านบน
<div class="hr dotted"></div>
<table border="0" cellspacing="0" cellpadding="0" >
    <tr valign="middle">
        <td align="right" height="40">
            <!--            <strong>Page:</strong> <a href="#">1</a> &nbsp;&nbsp;|&nbsp;&nbsp;<a href="#">2</a>-->
            <?php
            echo $paging;
            ?>&nbsp;&nbsp;
        </td>
    </tr>

</table>
<!--page-->
<?php
if(!$showCourse):
    ?>
<font class="bottomtext"><strong><?php echo $last_course['coursecode']?>
    : <?php echo $last_course['coursename']?></strong><br/>
    <?php //echo $last_course['content']?></font><br/>


<strong>ระยะเวลาการอบรม</strong>
    <?php echo Thaidate::date($last_course['startdate'], "DD MM YYYY");?>
- <?php echo Thaidate::date($last_course['enddate'], "DD MM YYYY");?>
<br/>
<strong>วันที่รับสมัคร</strong>
    <?php echo Thaidate::date($last_course['registstartdate'], "DD MM YYYY");?>
- <?php echo Thaidate::date($last_course['registenddate'], "DD MM YYYY");?>
<br/>
<strong>วิทยากร</strong>
    <?php echo $last_course['speaker']?>
<br/>
<strong>สถานที่ </strong>
    <?php echo $last_course['place']?>
<br/>
<strong>ค่าลงทะเบียน</strong>
ท่านละ <?php echo $last_course['price']?> บาท <?php if (trim($optional != '')) echo '( ' . $optional . ')'; ?>
<br/>
<strong>จำนวนเปิดลงทะเบียน</strong>

    <?php echo($last_course['limittrainees']);?> คน <br/>
<strong>จำนวนผู้ร่วมสมัครอบรม</strong>
    <?php echo(strval($totalRegister)); ?> คน <br/>
<br/>
    <?php endif; ?>
<!--article-->
<table border="0" cellspacing="2" cellpadding="2">

    <tr valign="top" bgcolor="#0062a9">
        <td align="left"><img src="images/blank.gif" alt="" width="10" height="1" border="0"></td>
        <td align="left"><img src="images/blank.gif" alt="" width="250" height="1" border="0"></td>
        <td align="left"><img src="images/blank.gif" alt="" width="200" height="1" border="0"></td>
        <td align="left"><img src="images/blank.gif" alt="" width="150" height="1" border="0"></td>
        <td align="left"><img src="images/blank.gif" alt="" width="120" height="1" border="0"></td>
        <td align="left"><img src="images/blank.gif" alt="" width="80" height="1" border="0"></td>
        <td align="left"><img src="images/blank.gif" alt="" width="60" height="1" border="0"></td>
        <td align="left"><img src="images/blank.gif" alt="" width="30" height="1" border="0"></td>
    </tr>
    <tr valign="top" bgcolor="#a0cdf9">
        <td align="center" height="30"><p class="fronttext">ลำดับ</p> </td>
        <td align="center" height="30"><p class="fronttext">ชื่อ / นามสกุล</p> </td>
        <td align="center" height="30"><p class="fronttext">สถานพยาบาลต้นสังกัด</p> </td>
        <td align="center" height="30"><p class="fronttext">ประเภทการสมัคร</p> </td>
        <td align="center" height="30"><p class="fronttext">การชำระเงิน</p> </td>
        <td align="center" height="30"><p class="fronttext">ประวัติการสมัครอบรม</p> </td>
        <td align="center" height="30"><p class="fronttext">Status</p> </td>
        <td align="center" height="30"><p class="fronttext">ยกเลิก</p> </td>
    </tr>
    <?php
    if (count($data) > 0):
        $row = $_row;
        foreach ($data as $val):
            $row++;
            $name = ($val['prefix'] != '6') ? $val['title_th'] : $val['prefix_other'];
            $name .= $val['name'] . ' ' . $val['lastname'];
            $hospital = $val['hospitalName'];
            $visibleDel = true;
            switch ($val['isPaid']) {
                case 0:
                    $pay_status = 'Wait';
                    break;
                case 1:
                    $pay_status = 'Paid';
                    $visibleDel = false;
                    break;
                case 4:
                    $pay_status = 'Wait for Queue';
                    break;
                default:
                    $pay_status = 'Wait';
                    break;

            }
            $history = $val['total_course'];
            $type = $val['type_name'];
            $traineeID = $val['traineeID'];
            $registrationID = $val['registrationID'];

            ?>
            <tr valign="top">
                <td align="left" class="info"><?php echo $row ?></td>
                <td align="left" class="info"><?php echo $name ?></td>
                <td align="left" class="info"><?php echo $hospital ?></td>
                <td align="left" class="info"><?php echo $type ?></td>
                <td align="left" class="info"><?php echo $pay_status ?></td>
                <td align="center" class="info"><?php echo $history ?></td>
                <td align="center" class="info"><input type="button" value="View" class="button"
                                                       onclick='location="<?php echo setting::$BASE_URL;?>/register/user/edit/<?php echo $traineeID ?>"'>
                </td>
                <td align="center" class="info">
                    <?php if($visibleDel):?>
                    <input type="button" onClick="if(confirm('<?php echo Msg::$delete ?>')){location='<?php echo setting::$BASE_URL;?>/register/user/register_delete/<?php echo $registrationID ?>';}" value="Delete"/>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
        endforeach;
    else :
        ?>
        <tr valign="top">
            <td align="center" class="info" colspan="8"><?php echo Msg::$no_user_result ?></td>
        </tr>

        <?php
    endif;
    ?>

</table>
<!--article-->
<div id="space"></div>

</div>

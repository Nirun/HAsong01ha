<div id="container">
    <font class="title">หัวข้อหลักสูตร / แก้ไขหัวข้อหลักสูตร</font>

    <form id="form_course" name="form_course" action="register/course/save_edit" enctype="multipart/form-data"
          method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr valign="top">
                <td>
                    <!--row 1-->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#a0cdf9">
                        <tr>
                            <td height="30"><p class="fronttext"> รายละเอียดหลักสูตรอบรม</p></td>
                        </tr>
                    </table>
                    <!--article-->
                    <table border="0" cellspacing="2" cellpadding="2" align="center">
                        <tr valign="top">
                            <td align="left" class="info" width="40%">รหัสหลักสูตร<br/>
                                <input name="coursecode" id="coursecode" type="text"
                                       style="width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"
                                       value="<?php echo $data['coursecode']; ?>"><br/>
                                <font class="copy4"> เช่น HA605- ไม่ต้องมี space ระหว่างคำ </font>
                            </td>
                            <td align="left" class="info">หัวข้อหลักสูตร<br/>
                                <input name="coursename" id="coursename" type="text"
                                       style="width: 300px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"
                                       value="<?php echo $data['coursename']; ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="left" class="info">รุ่นที่<br/>
                                <input name="generation" id="generation" type="text"
                                       style=" width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"
                                       value="<?php echo $data['generation']; ?>">
                            </td>
                            <td align="left" class="info"> ประเภทของ course นี้<br/>
                                <select name="coursetype" id="coursetype">
                                    <?php

                                    foreach ($course_type as $val):
                                        $selCT = ($val['coursetypeID'] == $data['coursetypeID']) ? "selected='selected'" : "";
                                        ?>
                                        <option
                                            value="<?php echo($val['coursetypeID']); ?>" <?= $selCT ?>><?php echo($val['coursetype']); ?></option>
                                        <?php
                                    endforeach
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <?php
                                $cYear = date('Y');
                                $sYear = $cYear - 3;
                                $eYear = $cYear + 2;
                                ?>
                                ปีงบประมาณ &nbsp;&nbsp;<select name="gen_year" id="gen_year">
                                    <option value="0">.:: ปี ::.</option>
                                    <?php

                                    foreach (range($sYear, $eYear) as $valY) {
                                        $vYear = $valY + 543;
                                        $sel = ($valY == $data['gen_year']) ? "selected='selected'" : "";
                                        ?>
                                        <option value="<?= $valY ?>" <?= $sel ?>><?= $vYear ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="left" class="info" colspan="2">
                                <table border="0" cellspacing="2" cellpadding="2">
                                    <tr>
                                        <td>กดเลือกในกรณีที่ ข้อบังคับของหลักสูตรนี้ ต้องผ่านหลักสูตรอิ่น
                                            <font class="copy4">(Optional)</font></td>
                                    </tr>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td bgcolor="#a0cdf9">
                                            <p class="fronttext"><strong>ข้อบังคับของหลักสูตรนี้</strong></p>
                                        </td>
                                        <td bgcolor="#a0cdf9">
                                            <a class="inline" href="#data"><img src="register/images/open.gif"
                                                                                width="185" height="24"
                                                                                border="0"/></a><br/>

                                            <div style="display:none">
                                                <div id="data">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr valign="left">
                                                            <td colspan="2" align="left"><font class="title"><strong>All
                                                                        Course/Order by
                                                                        Alphabet</strong></font>
                                                            </td>
                                                        </tr>
                                                        <tr valign="left">
                                                            <td align="left"><img src="images/blank.gif" alt=""
                                                                                  width="10" height="1"
                                                                                  border="0"></td>
                                                            <td align="left"><img src="images/blank.gif" alt=""
                                                                                  width="350" height="1"
                                                                                  border="0"></td>
                                                        </tr>
                                                        <?php
                                                        $prelist = '';
                                                        $countCourse = count($courselist);
                                                        if ($countCourse != 0) {
                                                            foreach ($courselist as $val):
                                                                $courseID = $val['courseID'];
                                                                $precourse = $val['coursecode'] . ":" . $val['coursename'];
                                                                $checked = false;
                                                                foreach ($precourselist as $_precourselist):
                                                                    if ($courseID == $_precourselist['precourseID']) {
                                                                        $checked = true;
                                                                        $prelist .= $_precourselist['precourseID'] . ",";
                                                                    }
                                                                    ?>
                                                                    <input type="hidden" name="precourseID[]"
                                                                           value="<?php echo($_precourselist['precourseID']); ?>">
                                                                <?php endforeach; ?>
                                                                <tr valign="middle">
                                                                    <td width="20"><input name="precourses[]"
                                                                                          type="checkbox"
                                                                            <?php echo($checked ? 'checked="checked"' : ''); ?>
                                                                                          value="<?php echo $courseID; ?>"/>
                                                                    </td>
                                                                    <td class="info"
                                                                        align="left"><?php echo $precourse; ?></td>
                                                                </tr>
                                                                <?php
                                                            endforeach;
                                                            ?>
                                                            <tr valign="middle">
                                                                <td colspan="2" align="center">
                                                                    <input type="button" id="btn_save" value="Save">
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <tr valign="middle">
                                                                <td colspan="2" align="center">
                                                                    <strong>ไม่พบข้อมูลหลักสูตร</strong>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!--group course-->
                                    <tr>
                                        <td class="info">
                                            <p>
                                                เลือกให้อบรมเฉพาะวิชาชีพ
                                            </p>
                                            <ul class="course-position"
                                                style="list-style: none;width: 350px;margin-top: 20px">

                                                <?php
                                                foreach ($position as $k => $v) {
                                                    $chk = "";
                                                    if ($current_position != null && in_array($v['id'], $current_position)) {
                                                        $chk = "checked='checked'";
                                                    }
                                                    ?>
                                                    <li style="float: left;width: 175px">
                                                        <input id="pos_<?= $v['id'] ?>" type="checkbox"
                                                               name="cond_position[]"
                                                               value="<?= $v['id'] ?>" <?= $chk ?>>
                                                        <label
                                                            for="os_<?= $v['id'] ?>"><?= $v['title_th'] ?></label>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" height="80px" valign="top">
                                            <div id="courselist" class="info"><?php echo $precoursenamelist; ?></div>
                                            <input type="hidden" id="precourseID" name="precourseID"
                                                   value="<?php echo $prelist; ?>">
                                        </td>
                                    </tr>

                                </table>
                                <br>
                                <strong>คุณสมบัติของผู้เข้าอบรม</strong> <br/>
                                <font class="copy4">(สามารถใส่ html code ได้)</font><br/>
                <textarea name="qualification" id="qualification" rows="10"
                          style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"><?php echo $data['qualification']; ?></textarea>
                                <br/>
                                <strong>วัตถุประสงค์ เพื่อให้ผู้เข้าอบรม</strong> <br/>
                                <font class="copy4">(สามารถใส่ html code ได้)</font><br/>
                <textarea name="objective" id="objective" rows="20"
                          style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"><?php echo $data['objective']; ?></textarea>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="left" class="info" colspan="2">
                                <font class="info"><strong>เนื้อหา </strong></font><br/>
                                <font class="copy4">(สามารถใส่ html code ได้)</font><br/><textarea name="content"
                                                                                                   id="content"
                                                                                                   rows="40"
                                                                                                   style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"><?php echo $data['content']; ?></textarea>
                            </td>
                        </tr>
                    </table>
                    <!--article-->
                    <!--row 1-->
                </td>
                <td width="10" class="verticle"><img src="images/blank.gif" width="10" height="100" border="0"/></td>
                <td>
                    <!--row 2-->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td bgcolor="#a0cdf9">รายละเอียดการอบรม</td>
                        </tr>
                    </table>
                    <!-- group course-->
                    <table border="0" cellspacing="2" cellpadding="2" align="center" style="background-color: #fbcb09">
                        <tr>
                            <td>

                                <input type="text" name="cond_total" id="cond_total" maxlength="4" size="5"
                                       style="text-align: right" value="<?= $max_register ?>">
                                <label for="cond_total"> คน</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div id="fileuploader">Upload</div>
                                <input type="hidden" name="cond_hospital" id="cond_hospital"
                                       value='<?= $group_hospital ?>'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div id="view-hospital"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px">
                                <a class="inline" href="#data-con">
                    <span style="background-color: #888888;padding: 5px 10px;">
                                    กดเลือกกลุ่มของหลักสูตร</span>
                                </a>
                                <input type="hidden" id="cond_course" name="cond_course" value="<?= $group_course ?>">
                            </td>
                        </tr>
                    </table>
                    <div style="display:none">
                        <div id="data-con">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr valign="left">
                                    <td colspan="2" align="left"><font class="title"><strong>All
                                                Course/Order by
                                                Alphabet</strong></font>
                                    </td>
                                </tr>
                                <tr valign="left">
                                    <td align="left"><img src="images/blank.gif" alt=""
                                                          width="10" height="1"
                                                          border="0"></td>
                                    <td align="left"><img src="images/blank.gif" alt=""
                                                          width="350" height="1"
                                                          border="0"></td>
                                </tr>
                                <?php
                                $countCourse = count($courselist);
                                if ($countCourse != 0) {
                                    foreach ($courselist as $val):
                                        $courseID = $val['courseID'];
                                        $precourse = $val['coursecode'] . ":" . $val['coursename'];
                                        $chk2 = "";
                                        if ($raw_group_course != null && in_array($courseID, $raw_group_course)) {
                                            $chk2 = "checked='checked'";
                                        }
                                        ?>
                                        <tr valign="middle">
                                            <td width="20"><input name="con_courses[]"
                                                                  type="checkbox"
                                                                  value="<?php echo $courseID ?>" <?= $chk2 ?>/>
                                            </td>
                                            <td class="info"
                                                align="left"><?php echo $precourse ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr valign="middle">
                                        <td colspan="2" align="center">
                                            <input type="button" id="btn_save_cond" value="Save">
                                        </td>
                                    </tr>
                                    <?php
                                } else {
                                    ?>
                                    <tr valign="middle">
                                        <td colspan="2" align="center">
                                            <strong>ไม่พบข้อมูลหลักสูตร</strong>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </table>
                        </div>
                    </div>
                    <!-- / group course-->
                    <!--article-->
                    <table border="0" cellspacing="2" cellpadding="2" align="center">
                        <tr>
                            <td align="left" class="info" colspan="2">
                                <?php
                                echo $this->load->view('register/inc_calendar');

                                $startDate = $data['startdate'];
                                $endDate = $data['enddate'];
                                $regDate1 = $data['registstartdate'];
                                $regDate2 = $data['registenddate'];
                                $payendate = $data['payenddate'];

                                if ($startDate == "0000-00-00 00:00:00" or $startDate == "0000-00-00" or $startDate == ""
                                    or $endDate == "0000-00-00 00:00:00" or $endDate == "0000-00-00" or $endDate == ""
                                    or $regDate1 == "0000-00-00 00:00:00" or $regDate1 == "0000-00-00" or $regDate1 == ""
                                    or $regDate2 == "0000-00-00 00:00:00" or $regDate2 == "0000-00-00" or $regDate2 == ""
                                    or $payendate == "0000-00-00 00:00:00" or $payendate == "0000-00-00" or $payendate == ""
                                ) {
                                    $sDate = "";
                                    $eDate = "";
                                    $ResDate = "";
                                    $ReeDate = "";
                                    $PayeDate = "";
                                } else {
                                    $sDate = date('Y-m-d', strtotime($data['startdate']));
                                    $eDate = date('Y-m-d', strtotime($data['enddate']));
                                    $ResDate = date('Y-m-d', strtotime($data['registstartdate']));
                                    $ReeDate = date('Y-m-d', strtotime($data['registenddate']));
                                    $PayeDate = date('Y-m-d', strtotime($data['payenddate']));
                                }
                                ?>
                                <table border="0" cellspacing="3" cellpadding="3">
                                    <tr valign="middle">
                                        <td>วันที่อบรม ตั้งแต่วันที่:</td>
                                        <td><input onClick="ds_sh(this);" name="startdate" id="startdate"
                                                   readonly="readonly"
                                                   style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;"
                                                   value="<?php echo $sDate; ?>"></td>
                                        <td>ถึง:</td>
                                        <td><input onClick="ds_sh(this);" onkeydown="TotalDate();" name="enddate"
                                                   id="enddate"
                                                   readonly="readonly"
                                                   style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;"
                                                   value="<?php echo $eDate; ?>">
                                        </td>
                                    </tr>
                                    <tr valign="middle">
                                        <td>ระยะเวลาการอบรม</td>
                                        <td colspan="3"><input name="days" id="days" onClick="TotalDate();"
                                                               onkeypress="TotalDate();"
                                                               type="text"
                                                               style="  width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"
                                                               value="<?php echo $data['days']; ?>"> วัน
                                        </td>
                                    </tr>
                                    <tr valign="middle">
                                        <td>
                                            เปิดรับสมัครตั้งแต่วันที่:
                                        </td>
                                        <td><input onClick="ds_sh(this);" name="registstartdate" id="registstartdate"
                                                   readonly="readonly"
                                                   style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;"
                                                   value="<?php echo $ResDate; ?>"></td>
                                        <td>
                                            ถึง:
                                        </td>
                                        <td><input onClick="ds_sh(this);" name="registenddate" id="registenddate"
                                                   readonly="readonly"
                                                   style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;"
                                                   value="<?php echo $ReeDate; ?>">
                                        </td>
                                    </tr>
                                    <tr valign="middle">
                                        <td>ชำระเงินวันสุดท้ายวันที่:</td>
                                        <td colspan="3"><input onClick="ds_sh(this);" name="payenddate" id="payenddate"
                                                               readonly="readonly" value="<?php echo $PayeDate; ?>"
                                                               style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;">

                                        </td>
                                    </tr>
                                    <tr valign="middle">
                                        <td>จำนวนเปิดลงทะเบียน</td>
                                        <td colspan="3"><input name="limittrainees" id="limittrainees" type="text"
                                                               style="  width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"
                                                               value="<?php echo $data['limittrainees']; ?>"> คน
                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td>ค่าลงทะเบียน</td>
                                        <td colspan="3"><input name="price" id="price" type="text"
                                                               style="  width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"
                                                               value="<?php echo $data['price']; ?>"> บาท <br/><strong>ราคานี้รวม</strong><br/>
                                            <table border="0" cellspacing="2" cellpadding="2">
                                                <?php
                                                $total_row = count($optional);
                                                $add_tr = 0;
                                                foreach ($optional as $_optional):
                                                    $total_row--;
                                                    $checked = false;
                                                    foreach ($courseoptional as $_courseoptional):
                                                        if ($_optional['optionalID'] == $_courseoptional['optionalID']) $checked = true;
                                                        ?>
                                                        <input type="hidden" name="optionalID[]"
                                                               value="<?php echo($_courseoptional['optionalID']); ?>">
                                                        <?php

                                                    endforeach;
                                                    if ($add_tr == 0) echo '<tr>';
                                                    ?>
                                                    <td>&nbsp;&nbsp;&nbsp;<input name="optional[]" type="checkbox"
                                                            <?php echo($checked ? 'checked="checked"' : ''); ?>
                                                                                 value="<?php echo($_optional['optionalID']); ?>"/>
                                                    </td>
                                                    <td height="20"><?php echo($_optional['optional']); ?></td>
                                                    <?php
                                                    if ($total_row == 0) {
                                                        ?>
                                                        <td colspan="5"><input name="optionalother" type="text"
                                                                               style="  width:180px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"
                                                                               value="<?php echo($data['optionalother']); ?>">
                                                        </td>
                                                        <?php
                                                    }
                                                    if ($add_tr == 2 || $total_row == 0) {
                                                        echo '</tr>';
                                                        $add_tr = 0;
                                                    } else {
                                                        $add_tr++;
                                                    }
                                                endforeach;
                                                ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="left" class="info" colspan="2">
                                <strong>วิทยากร:</strong><br/>
                                <font class="copy4">(สามารถใส่ html code ได้)</font> <br/><textarea name="speaker"
                                                                                                    rows="6"
                                                                                                    style="  width: 220px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"><?php echo $data['speaker']; ?></textarea><br/>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="left" class="info" colspan="2">
                                <strong>สถานที่อบรม:</strong><br/>
                                <font class="copy4">(สามารถใส่ html code ได้)</font><br/><textarea name="place" rows="6"
                                                                                                   style="  width: 220px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"><?php echo $data['place']; ?></textarea>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="left" class="info" colspan="2">
                                <?php
                                $map = $data['map'];
                                $size = ($data['map'] != '') ? ' width="450" height="311"' : ' width="22" height="26"';
                                ?>
                                <strong>แผนที่สถานที่อบรม:</strong><br/>
                                <font class="copy4">(เช่น http://www.domain.com/map.jpg หรือ code จาก google map)</font><br/>
                                <input name="maplink" type="text"
                                       style="width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"
                                       value="<?php echo $data['maplink']; ?>">
                                <br>หรือ upload แผนที่ <br/><br/>
                                <?php if (!empty($map)) { ?>
                                    <img src="<?php echo Setting::$PATH_MAP . $map; ?>" <?php echo $size; ?> border="0">
                                    <br/>
                                <?php } ?>
                                <input type="hidden" id="oldmap" name="oldmap" value="<?php echo $map; ?>">
                                <input type="file" name="picture" id="picture" size="25"><br/>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td align="left" class="info">
                                <?php

                                $cntDocs = count($docslist);

                                //add array when docs less than 3
                                $arrDoc = array(
                                    'docID' => '',
                                    'courseID' => '',
                                    'title' => '',
                                    'filename' => '',
                                    'file' => '',
                                    'IsShow' => 0
                                );

                                if ($cntDocs < 3) {
                                    array_push($docslist, $arrDoc);
                                }

                                for ($i = 0; $i <= 2; $i++) {
                                    $j = 0;
                                    foreach ($docslist as $_docs):
                                        if ($i == $j) {
                                            if ($_docs['IsShow'] == 1) {
                                                $isShow = true;
                                            } else {
                                                $isShow = false;
                                            }
                                            $title = $_docs['title'];
                                            $filename = $_docs['filename'];
                                            $file = $_docs['file'];
                                            $docID = $_docs['docID'];
                                        }
                                        $j++;
                                    endforeach;
                                    ?>
                                    <!--doc-->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr align="left">
                                            <td bgcolor="#a0cdf9"><b>เอกสารประกอบการอบรม <?php echo $i + 1; ?></b></td>
                                        </tr>
                                        <tr align="left">
                                            <td class="copy4"><br>(.pdf, .doc, .docx)ขนาดของ file ไม่เกิน 5 MB.</td>
                                        </tr>
                                    </table>
                                    <table border="0" cellspacing="3" cellpadding="3">
                                        <tr align="left">
                                            <td class="info" style="display:none;"><input type="checkbox"
                                                                                          name="isShow[]" <?php echo($isShow ? 'checked="checked"' : ''); ?>/>
                                                &nbsp;Show document on download center page
                                            </td>
                                        </tr>
                                        <tr align="left">
                                            <td class="info"> หัวข้อเอกสาร : <input type="text" name="doctitle[]"
                                                                                    size="60"
                                                                                    value="<?php echo $title; ?>"></td>
                                        </tr>
                                        <tr align="left">
                                            <td class="info">
                                                <a href="<?php echo Setting::$PATH_PDF . $file; ?>" target="_blank">
                                                    <img src="register/images/file.gif" width="22" height="26"
                                                         border="0">
                                                    <font class="copy4"><?php echo $filename; ?></font>
                                                </a>
                                                <?php if ($docID != '') { ?>
                                                    <a href="register/course/deldocs/<?php echo($data['courseID']); ?>/<?php echo $docID; ?>"
                                                       onclick="return confirm('Are you sure you want to delete?')">
                                                        <img src="register/images/delete.gif" border="0"/>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr align="left">
                                            <td class="info">
                                                เอกสาร : <input type="file" name="fileToUpload[]" ize="30"/>
                                                <input type="hidden" name="oldfile[]" value="<?php echo $file; ?>">
                                                <input type="hidden" name="docID[]" value="<?php echo $docID; ?>">
                                            </td>
                                        </tr>
                                    </table>
                                    <!--doc-->
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <!--article-->
                    <!--row 2-->
                    <div class="hr dotted"></div>
                    <p align="center"><br/>
                        <input type="hidden" id="courseID" name="courseID" value="<?php echo($data['courseID']); ?>">
                        <?php //echo($data['courseID']);?>
                        <input type="submit" value="Save" class="button"></p>
                </td>
            </tr>
        </table>
    </form>
    <div id="space"></div>
</div>
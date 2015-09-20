<div id="container">
<font class="title">หัวข้อหลักสูตร / เพิ่มหัวข้อหลักสูตร</font>

<form id="form_course" name="form_course" action="register/course/save" enctype="multipart/form-data" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td>
    <!--row 1-->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="tab">รายละเอียดหลักสูตรอบรม</td>
        </tr>
    </table>
    <!--article-->
    <table border="0" cellspacing="2" cellpadding="2" align="center">
        <tr valign="top">
            <td align="left" class="info" width="40%">รหัสหลักสูตร<br/>
                <input name="coursecode" id="coursecode" type="text"
                       style="width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"><br/>
                <font class="copy4"> เช่น HA605- ไม่ต้องมี space ระหว่างคำ </font></td>
            <td align="left" class="info">หัวข้อหลักสูตร<br/>
                <input name="coursename" id="coursename" type="text"
                       style="width: 300px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
            </td>
        </tr>
        <tr valign="top">
            <td align="left" class="info">รุ่นที่<br/>
                <input name="generation" id="generation" type="text"
                       style=" width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
            </td>
        <td align="left" class="info"> ประเภทของ course นี้<br/>
            <select name="coursetype" id="coursetype">
            <?php
            foreach ($course_type as $val):
                ?>
                <option value="<?php echo($val['coursetypeID']); ?>"><?php echo($val['coursetype']);?></option>
<!--                <input name="coursetype" type="radio" value="--><?php //echo($val['coursetypeID']); ?><!--"/>&nbsp;-->
<!--                --><?php //echo($val['coursetype']); ?><!--&nbsp;&nbsp;&nbsp;&nbsp;-->
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
                $sYear = $cYear - 2;
                $eYear = $cYear + 2;
                ?>
ปีงบประมาณ &nbsp;&nbsp;<select name="gen_year" id="gen_year">
                    <option value="0">.:: ปี ::.</option>
                    <?php
                    foreach (range ($eYear,$sYear) as $val) {
                        $vYear = $val + 543;
                        ?>
                        <option value="<?=$val?>"><?=$vYear?></option>
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
                        <td class="tab">
                            <strong>ข้อบังคับของหลักสูตรนี้</strong>
                        </td>
                        <td class="tab">
                            <a id="inline" href="#data"><img src="register/images/open.gif" width="185" height="24"
                                                             border="0"/></a><br/>

                            <div style="display:none">
                                <div id="data">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr valign="left">
                                            <td colspan="2" align="left"><font class="title"><strong>All Course/Order by
                                                Alphabet</strong></font>
                                            </td>
                                        </tr>
                                        <tr valign="left">
                                            <td align="left"><img src="images/blank.gif" alt="" width="10" height="1"
                                                                  border="0"></td>
                                            <td align="left"><img src="images/blank.gif" alt="" width="350" height="1"
                                                                  border="0"></td>
                                        </tr>
                                        <?php
                                        $countCourse = count($data);
                                        if ($countCourse != 0) {
                                            foreach ($data as $val):
                                                $courseID = $val['courseID'];
                                                $precourse = $val['coursecode'] . ":" . $val['coursename'];
                                                ?>
                                                <tr valign="middle">
                                                    <td width="20"><input name="precourses[]" type="checkbox"
                                                                          value="<?php echo $courseID ?>"/></td>
                                                    <td class="info" align="left"><?php echo $precourse ?></td>
                                                </tr>
                                                <?php endforeach; ?>
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
                    <tr>
                        <td class="info">
                          <p>
                              เลือกให้อบรมเฉพาะวิชาชีพ
                            </p>
                            <ul class="course-position" style="list-style: none;width: 350px;margin-top: 20px">

                                <?php
                                    foreach($position as $k=>$v){
                                       ?>
                                    <li style="float: left;width: 175px">
                                        <input id="pos_<?=$v['positionID']?>" type="checkbox" name="position" value="<?=$v['positionID']?>">
                                        <label for="os_<?=$v['positionID']?>"><?=$v['position']?></label>
                                    </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" height="80px" valign="top">
                            <div id="courselist" class="info"></div>
                            <input type="hidden" id="precourseID" name="precourseID">
                        </td>
                    </tr>
                </table>
                <br>
                <font class="info"><b>คุณสมบัติของผู้เข้าอบรม</b></font> <br/>
                <font class="copy4">(สามารถใส่ html code ได้)</font><br/>
                <textarea name="qualification" id="qualification" rows="10"
                          style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></textarea>
                <br/>
                <font class="info"><b>วัตถุประสงค์ เพื่อให้ผู้เข้าอบรม</b></font><br/>
                <font class="copy4">(สามารถใส่ html code ได้)</font><br/>
                <textarea name="objective" id="objective" rows="20"
                          style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></textarea>
            </td>
        </tr>
        <tr valign="top">
            <td align="left" class="info" colspan="2">
                <font class="info"><b>เนื้อหา </b></font><br/>
                <font class="copy4">(สามารถใส่ html code ได้)</font><br/><textarea name="content" id="content" rows="40"
                                                                                   style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></textarea>
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
        <td class="tab">รายละเอียดการอบรม</td>
    </tr>
</table>
<!--article-->
<table border="0" cellspacing="2" cellpadding="2" align="center">
    <tr>
        <td align="left" class="info" colspan="2">
            <?php echo $this->load->view('register/inc_calendar'); ?>
            <table border="0" cellspacing="3" cellpadding="3">
                <tr valign="middle">
                    <td>วันที่อบรม ตั้งแต่วันที่:</td>
                    <td><input onClick="ds_sh(this);" name="startdate" id="startdate" readonly="readonly"
                               style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;">
                    </td>
                    <td>ถึง:</td>
                    <td><input onClick="ds_sh(this);" onkeydown="TotalDate();" name="enddate" id="enddate"
                               readonly="readonly"
                               style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;">
                    </td>
                </tr>
                <tr valign="middle">
                    <td>ระยะเวลาการอบรม</td>
                    <td colspan="3"><input name="days" id="days" onClick="TotalDate();" onkeypress="TotalDate();"
                                           type="text"
                                           style="width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                        วัน
                    </td>
                </tr>
                <tr valign="middle">
                    <td>
                        เปิดรับสมัครตั้งแต่วันที่:
                    </td>
                    <td><input onClick="ds_sh(this);" name="registstartdate" id="registstartdate"
                               readonly="readonly"
                               style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;">
                    </td>
                    <td>
                        ถึง:
                    </td>
                    <td><input onClick="ds_sh(this);" name="registenddate" id="registenddate" readonly="readonly"
                               style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;">
                    </td>
                </tr>
                <tr valign="middle">
                    <td>ชำระเงินวันสุดท้ายวันที่:</td>
                    <td colspan="3"><input onClick="ds_sh(this);" name="payenddate" id="payenddate" readonly="readonly"
                                           style=" width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;">

                    </td>
                </tr>
                <tr valign="middle">
                    <td>จำนวนเปิดลงทะเบียน</td>
                    <td colspan="3"><input name="limittrainees" id="limittrainees" type="text"
                                           style="  width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                        คน
                    </td>
                </tr>
                <tr valign="top">
                    <td>ค่าลงทะเบียน</td>
                    <td colspan="3"><input name="price" id="price" type="text"
                                           style="  width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                        บาท <br/><strong>ราคานี้รวม</strong><br/>
                        <table border="0" cellspacing="2" cellpadding="2">
                            <?php
                            $total_row = count($optional);
                            $add_tr = 0;
                            foreach ($optional as $_optional):
                                $total_row--;
                                if ($add_tr == 0) echo '<tr>';
                                ?>
                                <td>&nbsp;&nbsp;&nbsp;<input name="optional[]" type="checkbox"
                                                             value="<?php echo($_optional['optionalID']);?>"/>
                                </td>
                                <td height="20"><?php echo($_optional['optional']);?></td>
                                <?php
                                if ($total_row == 0) {
                                    ?>
                                    <td colspan="5"><input name="optionalother" type="text" style="input3"></td>
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
            <font class="info"> <b>วิทยากร:</b></font><br/>
            <font class="copy4">(สามารถใส่ html code ได้)</font> <br/><textarea name="speaker" rows="6"
                                                                                style="  width: 220px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></textarea><br/>
        </td>
    </tr>
    <tr valign="top">
        <td align="left" class="info" colspan="2">
            <font class="info"><b>สถานที่อบรม:</b></font><br/>
            <font class="copy4">(สามารถใส่ html code ได้)</font><br/><textarea name="place" rows="6"
                                                                               style="  width: 220px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></textarea>
        </td>
    </tr>
    <tr valign="top">
        <td align="left" class="info" colspan="2">
            <b>แผนที่สถานที่อบรม:</b><br/>
            <font class="copy4">(เช่น http://www.domain.com/map.jpg หรือ code จาก google map)</font><br/>
            <input name="maplink" type="text"
                   style="width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
            <br>หรือ upload แผนที่ <br/>
            <br/>
            <input type="file" name="picture" id="picture" size="25"><br/>
        </td>
    </tr>
    <tr valign="top">
        <td align="left" class="info"><br>
            <!--doc-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr align="left">
                    <td class="tab"><b>เอกสารประกอบการอบรม 1</b></td>
                </tr>
                <tr align="left">
                    <td class="copy4"><br>(.pdf, .doc, .docx)ขนาดของ file ไม่เกิน 5 MB.</td>
                </tr>
            </table>
            <table border="0" cellspacing="3" cellpadding="3">
                <tr align="left">
                    <td class="info" style="display:none;"><input type="checkbox" name="isShow[]">&nbsp;Show
                        document on download center page
                    </td>
                </tr>
                <tr align="left">
                    <td class="info"> หัวข้อเอกสาร : <input type="text" name="doctitle[]" size="60"></td>
                </tr>
                <tr align="left">
                    <td class="info">
                        เอกสาร : <input type="file" name="fileToUpload[]" ize="30"/>
                    </td>
                </tr>
            </table>
            <!--doc-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr align="left">
                    <td class="tab"><b>เอกสารประกอบการอบรม 2</b></td>
                </tr>
                <tr align="left">
                    <td class="copy4"><br>(.pdf, .doc, .docx)ขนาดของ file ไม่เกิน 5 MB.</td>
                </tr>
            </table>
            <table border="0" cellspacing="3" cellpadding="3">
                <tr align="left">
                    <td class="info" style="display:none;"><input type="checkbox" name="isShow[]">&nbsp;Show
                        document on download center page
                    </td>
                </tr>
                <tr align="left">
                    <td class="info"> หัวข้อเอกสาร : <input type="text" name="doctitle[]" size="60"></td>
                </tr>
                <tr align="left">
                    <td class="info">
                        เอกสาร : <input type="file" name="fileToUpload[]" ize="30"/>
                    </td>
                </tr>
            </table>
            <!--doc-->
            <!--doc-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr align="left">
                    <td class="tab"><b>เอกสารประกอบการอบรม 3</b></td>
                </tr>
                <tr align="left">
                    <td class="copy4"><br>(.pdf, .doc, .docx)ขนาดของ file ไม่เกิน 5 MB.</td>
                </tr>
            </table>
            <table border="0" cellspacing="3" cellpadding="3">
                <tr align="left">
                    <td class="info" style="display:none;"><input type="checkbox" name="isShow[]">&nbsp;Show
                        document on download center page
                    </td>
                </tr>
                <tr align="left">
                    <td class="info"> หัวข้อเอกสาร : <input type="text" name="doctitle[]" size="60"></td>
                </tr>
                <tr align="left">
                    <td class="info">
                        เอกสาร : <input type="file" name="fileToUpload[]" ize="30"/>
                    </td>
                </tr>
                <input type="hidden" name="oldfile[]" value="">
                <input type="hidden" name="docID[]" value="">
            </table>
            <!--doc-->
        </td>
    </tr>
</table>
<!--article-->
<!--row 2-->
<div class="hr dotted"></div>
<p align="center"><br/>
    <input type="submit" value="Save" class="button"></p></td>
</tr>
</table>
</form>
<div id="space"></div>
</div>
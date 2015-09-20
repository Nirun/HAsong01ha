<div id="container"><font class="title">รายชื่อผู้เข้าร่วมอบรม / เพิ่มรายชื่อผู้เข้าร่วมอบรม</font>

<form id="form_signup" name="form_signup" action="<?php echo setting::$BASE_URL;?>/register/user/save" enctype="multipart/form-data" method="post">


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td><!--row 1-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="tab">รายละเอียดผู้เข้าร่วมอบรม</td>
    </tr>
</table>
<!--article-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top">
        <td align="center"><br/>
            <img src="<?php echo setting::$BASE_URL ?>/register/profile/default.jpg" width="180" height="200"
                 border="1"/></td>
        <td><br/>
            <br/>Upload รูป (jpg file ขนาด 180x200 pixel)
            <br/>


            <input type="file" name="picture" id="picture" size="25"><br>
        </td>
    </tr>
</table>


<table border="0" cellspacing="2" cellpadding="2" align="center">
<tr valign="top">
    <td align="left" class="info" colspan="2">
        <table border="0" cellspacing="2" cellpadding="2">
            <tr>
                <td><strong>คำนำหน้าชื่อ</strong><span style="color: red;">*</span></td>
                <?php
                $total_row = count($prefix);
                foreach ($prefix as $_prefix):
                    $total_row--;
                    ?>
                    <td>&nbsp;&nbsp;&nbsp;<input name="prefix" class="validate[required] prefix" type="radio"
                                                 value="<?php echo($_prefix['id']);?>"/></td>
                    <td>
                        <?php
                        echo($_prefix['title_th']);
                        if ($total_row == 0):
                            echo '&nbsp;';
                            ?>
                            <input name="prefix_other" type="text"
                                   style="  width: 40px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            <?php
                        endif
                        ?>

                    </td>
                    <?php
                endforeach
                ?>
                </td>

            </tr>
        </table>
    </td>

</tr>
<tr valign="top">
    <td align="left" class="info">ชื่อ<span style="color: red;">*</span><br/>
        <input name="name" id="name" class="validate[required]" type="text"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">นามสกุล<span style="color: red;">*</span><br/>
        <input name="lastname" id="lastname" class="validate[required]" type="text"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>

<tr valign="top">
    <td align="left" class="info">เลขบัตรประชาชน<br/>
        <input name="idcard" id="idcard" class="validate[custom[number],minSize[13],maxSize[13]]" type="text"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">&nbsp;</td>
</tr>

<tr valign="top">
    <td align="left" class="info">Username<span style="color: red;">*</span><br/>
        <input name="user" id="user" class="validate[required,custom[onlyLetterNumber],minSize[6],ajax[ajaxUser]]"
               type="text"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">Password<span style="color: red;">*</span><br/>
        <input name="password" id="password" class="validate[required,custom[onlyLetterNumber],minSize[6]]"
               type="password"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>
<tr valign="top">
    <td align="left" class="info">Confirms Password<span style="color: red;">*</span><br/>
        <input name="cpassword" id="cpassword" class="validate[required,custom[onlyLetterNumber],equals[password]]"
               type="password"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">Email Address<span style="color: red;">*</span><br/>
        <input name="email" id="email" class="validate[required,custom[email],ajax[ajaxUserMail]]" type="text"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>


<tr valign="top">
    <td colspan="2">
        <div class="tab">ประเภทการสมัคร<span style="color: red;">*</span></div>
    </td>
</tr>
<tr valign="top">
    <td colspan="2">
        <table border="0" cellspacing="2" cellpadding="2">
            <tr>
                <?php
                foreach ($register_type as $val):
                    ?>
                    <td>&nbsp;&nbsp;&nbsp;<input name="register_type" class="validate[required] register_type"
                                                 type="radio" value="<?php echo($val['type_id']);?>"/></td>
                    <td><?php echo($val['type_name']);?></td>
                    <?php
                endforeach
                ?>
            </tr>
        </table>
    </td>
</tr>

<tr valign="top">
    <td colspan="2"><strong>รายละเอียดผู้ประสานงานสถานพยาบาลที่สมัครให้ </strong></td>
</tr>
<tr valign="top">
    <td align="left" class="info">ชื่อผู้ประสานงานสถานพยาบาล<br/>
        <input name="coname" id="coname" class="validate[required]" type="text"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">นามสกุล<br/>
        <input name="colastname" id="colastname" type="text"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>
<tr valign="top">
    <td align="left" class="info">เบอร์โทรศัพท์ :<br/>
        <input name="cotel" id="cotel" type="text"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">เบอร์โทรศัพท์มือถือ :<br/>
        <input name="comobile" id="comobile" class="validate[required,custom[number],minSize[10]]" type="text"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>
<tr valign="top">
    <td align="left" class="info">เบอร์ Fax :<br/>
        <input name="cofax" id="cofax" type="text"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">อีเมล์ :<br/>
        <input name="coemail" id="coemail" class="validate[required,custom[email]]" type="text"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>
<tr valign="top">
    <td colspan="2">
        <div class="tab">สถานะการทำงาน</div>
    </td>
</tr>

<tr valign="top">
    <td align="left" class="info" colspan="2"><strong>วิชาชีพ</strong><span style="color: red;">*</span><br/>
        <table border="0" cellspacing="1" cellpadding="1">

            <?php
            $total_row2 = count($occupation);
            $add_tr = 0;
            foreach ($occupation as $_occupation):
                $total_row2--;
                if ($add_tr == 0) echo '<tr>';
                ?>
                <td>&nbsp;&nbsp;&nbsp;<input name="occupation" class="validate[required] occupation" type="radio"
                                             value="<?php echo($_occupation['id']);?>"/>
                </td>
                <td height="20"><?php echo($_occupation['title_th']);?></td>
                <?php
                if ($total_row2 == 0) {
                    ?>
                    <td colspan="4"><input name="occupation_other" type="text"
                                           style="  width:180px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                    </td>

                    <?php
                }
                if ($add_tr == 2 || $total_row2 == 0) {
                    echo '</tr>';
                    $add_tr = 0;
                } else {
                    $add_tr++;
                }
            endforeach;
            ?>
            <tr>
                <td align="left" class="info" colspan="4">เลชประกอบวิชาชีพ :<br/>
                    <input name="profession_id" id="profession_id" class="" type="text"
                           style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                </td>
            </tr>
            <tr>
                <td align="left" class="info" colspan="4">เลชสมาชิกสภาการพยาบาล :<br/>
                    <input name="hospital_member_id" id="hospital_member_id" class="" type="text"
                           style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr valign="top">
    <td align="left" class="info" colspan="2"><strong>สถานพยาบาลต้นสังกัด</strong><br/>
        <select name="hospital_id"
                tabIndex="8"
                style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;">
            <option value="" selected="selected">เลือกสถานพยาบาล</option>
            <option value="AL">ไม่สังกัด สถานพยาบาล</option>
            <?php
            foreach ($hospital as $key => $val):
                ?>
                <option value="<?php echo $val['hospitalid']?>"><?php echo $val['name']?></option>
                <?php
            endforeach;
            ?>
        </select><br/>
        กรณีเลือกไม่สังกัด สถานพยาบาล โปรดใส่รายละเอียด<br/>
        <input name="hospital_other" type="text"
               style="  width:500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>

<tr valign="top">
    <td align="left" class="info" colspan="2"><strong>ตำแหน่งสายการบริหาร</strong><span style="color: red;">*</span><br/>
        <table border="0" cellspacing="2" cellpadding="2">
            <?php
            $row_position = 0;
            foreach ($position as $_position):
                $row_position++;
                if ($row_position <= 3):
                    if ($row_position == 1) :
                        echo '<tr>';
                    endif;
                    ?>
                    <td>&nbsp;&nbsp;&nbsp;<input name="position" class="validate[required] position" type="radio"
                                                 value="<?php echo($_position['positionID']);?>"/></td>
                    <td height="20"><?php echo($_position['position']);?></td>
                    <?php
                    if ($row_position == 3) :
                        echo '</tr>';
                    endif; elseif ($row_position == 4):
                    ?>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;<input name="position" class="validate[required] position" type="radio"
                                                     value="<?php echo($_position['positionID']);?>"/></td>
                        <td height="20"><?php echo($_position['position']);?></td>
                    </tr>
                    <?php else:
                    if ($row_position == 5) :
                        echo '<tr>';
                    endif;
                    ?>
                    <td>&nbsp;&nbsp;&nbsp;<input name="position" class="validate[required] position" type="radio"
                                                 value="<?php echo($_position['positionID']);?>"/></td>
                    <td height="20"  <?php if ($row_position == 6) {
                        echo 'colspan="3"';
                    }?>><?php echo($_position['position']); ?>


                    <?php
                    if ($row_position == 6) :
                        ?>
                        &nbsp;&nbsp;<input name="position_other" type="text"
                                           style="  width:180px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                        <?php
                        echo '</td>';
                        echo '</tr>'; else:
                        echo '</td>';
                    endif;
                endif;
            endforeach;
            ?>
        </table>
    </td>
</tr>


<tr valign="top">
    <td colspan="2">
        <div class="tab">ที่อยู่ส่งเอกสาร</div>
        <table border="0" cellspacing="2" cellpadding="2">
            <tr>
                <?php
                foreach ($sent_type as $val):

                    ?>
                    <td>&nbsp;&nbsp;&nbsp;<input name="placetype" class="validate[required] placetype" type="radio"
                                                 value="<?php echo($val['address_type_id']);?>"/></td>
                    <td><?php echo($val['address_type_name']);?></td>
                    <?php
                endforeach;
                ?>
        </table>
    </td>
</tr>

<tr valign="top">
    <td colspan="2">ที่อยู่<span style="color: red;">*</span>:<br/>
        <input name="address" id="address" class="validate[required]" type="text"
               style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>


<tr valign="top">
    <td>จังหวัด<span style="color: red;">*</span> :<br/><select name="province" class="validate[required]" id="province" style=" width: 200px;">
        <option value="">.:: เลือก ::.</option>
        <?php
        foreach ($province as $_province) {
            echo '<option value="' . $_province['PROVINCE_CODE'] . '">' . $_province['PROVINCE_NAME'] . '</option>';
        }
        ?>

    </select></td>

    <td>รหัสไปรษณีย์<span style="color: red;">*</span> :<br/>
        <input name="zip" type="text" id="zip" class="validate[required,custom[number]]"
               style="  width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>


<tr valign="top">
    <td>เบอร์โทรศัพท์ :<br/>
        <input name="tel" id="tel" class="validate[required]" type="text"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>

    <td>เบอร์โทรศัพท์มือถือ<span style="color: red;">*</span> :<br/>
        <input name="mobile" id="mobile" class="validate[required,custom[number],minSize[10]]" type="text"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>


<tr valign="top">
    <td>เบอร์ Fax :<br/>
        <input name="fax" type="text"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>

    <td>&nbsp;</td>
</tr>

</table>
<p align="center"><br/>


    <input type="submit" value="Save" class="button">
    <br/><br/>
    หมายเหตุ: หลังจากกดปุ่ม save โปรแกรมจะ Generate Bar Code สำหรับบุุคคลนี้</p>
<!--article--><!--row 1--></td>
<td width="10" class="verticle"><img src="images/blank.gif" width="10" height="100" border="0"/></td>
<td><!--row 2-->
    <div class="tab">ประวัติการอบรม</div>

    <!--article-->

    <!--article-->
    <img src="images/blank.gif" width="470" height="1" border="0"/><!--row 2-->  </td>
</tr>
</table>
</form>

<div id="space"></div>

</div>

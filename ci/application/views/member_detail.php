<form id="form_signup" name="form_signup" action="<?php echo setting::$BASE_URL;?>/member/save_edit" enctype="multipart/form-data" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr valign="top">
        <td align="left"><a href="javascript:history.back()"><img src="images/back.gif" width="78" height="25" border="0" /></a><br>
        <img src="images/des7.gif" width="825" height="130" border="0"/></td>
        <td align="right"><img src="images/mem_tab.gif" width="169" height="43" border="0" /></td>
    </tr>
</table>
<!--table--><table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr valign="top">

<td align="left">
<table border="0" cellspacing="2" cellpadding="2" width="100%">
                <tr valign="middle" bgcolor="#98c72a">
                    <td class="fronttext" height="30">&nbsp;&nbsp;&nbsp;  ข้อมูล / ประวัติของท่าน</td>
                        </tr>
</table>
<br />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td><!--row 1-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top">
        <td align="center"><br/>
            <?php

            $img = ($data['photo'] != '') ? $data['photo'] : 'default.jpg';
            ?>
            <img src="<?php echo Setting::$PATE_TRIANEE . $img ?>" width="180" height="200" border="1"/><br><br/>
        </td>
        <td><br/>
            <br/>Upload รูป (jpg file ขนาด 180x200 pixel)
            <br/>
            <input type="file" name="picture" id="picture" size="25"><br>
            <br/>
            <!--                       <img src="images/barcode.gif" width="143" height="61" border="0"/>-->
            <?php
            $barcode = $data['cardID'];
            echo '<img src ="'.setting::$BASE_URL.'/register/user/barcode/' . $barcode . '">';
            ?>
        </td>
    </tr>
</table>
<!--article--><table border="0" cellspacing="2" cellpadding="2" align="center">
<tr valign="top">
    <td align="left" class="info" colspan="2"><table  border="0" cellspacing="2" cellpadding="2">
        <tr>
            <td colspan="13"><strong>คำนำหน้าชื่อ</strong><span style="color: red;">*</span> </td>
        </tr>
        <tr>
            <?php
            $total_row = count($prefix);
            foreach ($prefix as $_prefix):
                $total_row--;
                $check_1 = ($data['prefix'] == $_prefix['id']) ? 'checked="checked" ' : '';
                ?>
                <td>&nbsp;&nbsp;&nbsp;<input name="prefix" class="validate[required] prefix" <?php echo $check_1 ?>
                                             type="radio"
                                             value="<?php echo($_prefix['id']);?>"/></td>
                <td>
                    <?php
                    echo($_prefix['title_th']);
                    if ($total_row == 0):
                        echo '&nbsp;';
                        ?>
                        <input name="prefix_other" type="text" value="<?php echo $data['prefix_other'] ?>"
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
    </table> </td>

</tr>
<tr valign="top">
    <td align="left" class="info">ชื่อ<span style="color: red;">*</span><br/>
        <input name="name" id="name" class="validate[required]" type="text" value="<?php echo $data['name'] ?>"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">นามสกุล<span style="color: red;">*</span><br/>
        <input name="lastname" id="lastname" class="validate[required]" type="text"
               value="<?php echo $data['lastname'] ?>"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>

<tr valign="top">
    <td align="left" class="info">เลขบัตรประชาชน<br/>
        <input name="idcard" id="idcard" class="validate[custom[number],minSize[13],maxSize[13]]" type="text"
               value="<?php echo $data['cardID'] ?>"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">&nbsp;</td>
</tr>

<tr valign="top">
    <td align="left" class="info">Username<span style="color: red;">*</span><br/>
        <input name="user" id="user" class="" disabled="disabled"
               type="text" value="<?php echo $data['username'] ?>"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">Password<span style="color: red;">*</span><br/>
        <input name="password" id="password" class="validate[custom[onlyLetterNumber],minSize[6]]" type="password"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>
<tr valign="top">
    <td align="left" class="info">Confirms Password<span style="color: red;">*</span><br/>
        <input name="cpassword" id="cpassword" class="validate[equals[password]]"
               type="password"
               style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
    <td align="left" class="info">Email Address<span style="color: red;">*</span><br/>
        <input name="email" id="email" class="validate[required,custom[email]]" type="text"
               value="<?php echo $data['email'] ?>"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>

<tr valign="top">
    <td colspan="2">  <div  class="title">ประเภทการสมัคร<span style="color: red;">*</span></div></td>
</tr>

<tr valign="top">
    <td colspan="2"><table  border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr valign="middle">
            <?php
            foreach ($register_type as $val):
                $check_2 = ($data['registrationtype'] == $val['type_id']) ? 'checked="checked" ' : '';
                ?>
                <td width="15"><input name="register_type"
                                             class="validate[required] register_type" <?php echo $check_2 ?>
                                             type="radio" value="<?php echo($val['type_id']);?>"/></td>
                <td><?php echo($val['type_name']);?></td>
                <?php
            endforeach
            ?>
        </tr>
    </table></td>
</tr>

<?php
if($data['registrationtype']!=1):
        ?>
<!--<tr valign="top">
    <td align="left" class="info" colspan="2"><strong>ชื่อผู้ประสานงานสถานพยาบาล</strong><br />
        นาย <?php echo $data['cohosname'] ?> <?php echo $data['cohoslastname'] ?><br />
        <strong>เบอร์โทรศัพท์ :</strong> <?php echo $data['cohostel'] ?><br />
        <strong>เบอร์โทรศัพท์มือถือ :</strong> <?php echo $data['cohosmobile'] ?><br />
        <strong>เบอร์Fax :</strong> <?php echo $data['cohosfax'] ?><br />
        <strong>อีเมล์ :</strong><?php echo $data['cohosemail'] ?> </td>

</tr>-->
<?php endif; ?>

<tr valign="top">
    <td colspan="2">  <div  class="title">สถานะการทำงาน</div></td>
</tr>

<tr valign="top">
    <td align="left" class="info" colspan="2"><strong>วิชาชีพ</strong><span style="color: red;">*</span><br />
        <table   border="0" cellspacing="1" cellpadding="1">
            <?php
            $total_row2 = count($occupation);
            $add_tr = 0;
            foreach ($occupation as $_occupation):
                $total_row2--;
                $check_3 = ($data['professiontypeID'] == $_occupation['id']) ? 'checked="checked" ' : '';
                if ($add_tr == 0) echo '<tr>';
                ?>
                <td>&nbsp;&nbsp;&nbsp;<input name="occupation" class="validate[required] occupation"
                                             type="radio"  <?php echo $check_3 ?>
                                             value="<?php echo($_occupation['id']);?>"/>
                </td>
                <td height="20"><?php echo($_occupation['title_th']);?></td>
                <?php
                if ($total_row2 == 0) {
                    ?>
                    <td colspan="4"><input name="occupation_other" type="text"
                                           value="<?php echo $data['professionother'] ?>"
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
                <td align="left" colspan="4">เลชประกอบวิชาชีพ :<br/>
                    <input name="profession_id" id="profession_id" class="" value="<?php echo $data['profession_id']?>" type="text"
                           style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                </td>
            </tr>
            <tr>
                <td align="left"  colspan="4">เลชสมาชิกสภาการพยาบาล :<br/>
                    <input name="hospital_member_id" id="hospital_member_id" class="" value="<?php echo $data['hospital_member_id']?>" type="text"
                           style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr valign="top">
    <td align="left" class="info" colspan="2"><strong>สถานพยาบาลต้นสังกัด</strong><br />
        <select id="hospital_id" name="hospital_id"  class="validate[required] hospital_id" tabIndex="8"  style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;">
        <option value="" selected="selected">เลือกสถานพยาบาล</option>
        <option value="0">ไม่สังกัด สถานพยาบาล</option>
        <?php
        foreach ($hospital as $key => $val):
            $chkHospital = ($data['hospitalID'] == $val['hospitalid']) ? 'selected="selected"' : '';
            ?>
            <option value="<?php echo $val['hospitalid']?>" <?php echo $chkHospital?>><?php echo $val['name']?></option>
            <?php
        endforeach;
        ?>
    </select><br />
        กรณีเลือกไม่สังกัด สถานพยาบาล โปรดใส่รายละเอียด<br />
        <input id="hospital_other" name="hospital_other" type="text" value="<?php echo $data['hospitalother'] ?>"
               style="  width:500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
</tr>

<tr valign="top">
    <td align="left" class="info" colspan="2"><strong>ตำแหน่งสายการบริหาร</strong><span style="color: red;">*</span><br />
        <table border="0" cellspacing="2" cellpadding="2">
            <?php
            $row_position = 0;
            foreach ($position as $_position):
                $check_4 = ($data['positionID'] == $_position['positionID']) ? 'checked="checked" ' : '';
                $row_position++;
                if ($row_position <= 3):
                    if ($row_position == 1) :
                        echo '<tr>';
                    endif;
                    ?>
                    <td>&nbsp;&nbsp;&nbsp;<input name="position" class="validate[required] position"
                                                 type="radio" <?php echo $check_4; ?>
                                                 value="<?php echo($_position['positionID']);?>"/></td>
                    <td height="20"><?php echo($_position['position']);?></td>
                    <?php
                    if ($row_position == 3) :
                        echo '</tr>';
                    endif; elseif ($row_position == 4):
                    ?>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;<input name="position" class="validate[required] position"
                                                     type="radio" <?php echo $check_4; ?>
                                                     value="<?php echo($_position['positionID']);?>"/></td>
                        <td height="20"><?php echo($_position['position']);?></td>
                    </tr>
                    <?php else:
                    if ($row_position == 5) :
                        echo '<tr>';
                    endif;
                    ?>
                    <td>&nbsp;&nbsp;&nbsp;<input name="position" class="validate[required] position"
                                                 type="radio" <?php echo $check_4; ?>
                                                 value="<?php echo($_position['positionID']);?>"/></td>
                    <td height="20"  <?php if ($row_position == 6) {
                        echo 'colspan="3"';
                    }?>><?php echo($_position['position']); ?>


                    <?php
                    if ($row_position == 6) :
                        ?>
                        &nbsp;&nbsp;<input name="position_other" type="text" value=" <?php echo $data['positionother']; ?>"
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
    <td colspan="2"><div  class="title">ที่อยู่ส่งเอกสาร<span style="color: red;">*</span>:</div>
        <table  border="0" cellspacing="2" cellpadding="2">
            <tr>
                <?php
                foreach ($sent_type as $val):
                    $check_5 = ($data['placetype'] == $val['address_type_id']) ? 'checked="checked" ' : '';
                    ?>
                    <td>&nbsp;&nbsp;&nbsp;<input name="placetype" class="validate[required] placetype"
                                                 type="radio" <?php echo $check_5; ?>
                                                 value="<?php echo($val['address_type_id']);?>"/></td>
                    <td><?php echo($val['address_type_name']);?></td>
                    <?php
                endforeach;
                ?>
            </tr>

        </table></td>
</tr>

<tr valign="top">
    <td colspan="2">เลขที่<span style="color: red;">*</span>:<br/>
        <input name="address" id="address" class="validate[required]" type="text"
               value="<?php echo($data['address']);?>"
               style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>
<tr valign="top">
    <td colspan="2">ซอย<span style="color: red;">*</span>:<br/>
        <input name="soi" id="soi" class="" type="text"
               value="<?php echo($data['soi']);?>"
               style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>
<tr valign="top">
    <td colspan="2">ถนน<span style="color: red;">*</span>:<br/>
        <input name="road" id="road" class="" type="text"
               value="<?php echo($data['road']);?>"
               style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>
<tr valign="top">
    <td colspan="2">เขต<span style="color: red;">*</span>:<br/>
        <input name="district" id="district" class="" type="text"
               value="<?php echo($data['district']);?>"
               style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>


<tr valign="top">
    <td>จังหวัด<span style="color: red;">*</span> :<br/><select name="province" class="validate[required]" id="province" style=" width: 200px;">
        <option value="">.:: เลือก ::.</option>
        <?php
        foreach ($province as $_province) {
            $sel = ($data['provinceID'] == $_province['PROVINCE_CODE']) ? 'selected = "selected"' : '';
            echo '<option value="' . $_province['PROVINCE_CODE'] . '" ' . $sel . '>' . $_province['PROVINCE_NAME'] . '</option>';
        }
        ?>

    </select></td>

    <td>รหัสไปรษณีย์<span style="color: red;">*</span> :<br/>
        <input name="zip" type="text" id="zip" class="validate[required,custom[number]]"
               value="<?php echo($data['postcode']);?>"
               style="  width: 90px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>


<tr valign="top">
    <td>เบอร์โทรศัพท์ :<br/>
        <input name="tel" id="tel" class="" type="text" value="<?php echo($data['tel']);?>"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>

    <td>เบอร์โทรศัพท์มือถือ<span style="color: red;">*</span> :<br/>
        <input name="mobile" id="mobile" class="validate[required,custom[number],minSize[10]]" type="text"
               value="<?php echo($data['mobile']);?>"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>
</tr>


<tr valign="top">
    <td>เบอร์ Fax :<br/>
        <input name="fax" type="text" value="<?php echo($data['fax']);?>"
               style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
    </td>

    <td>&nbsp;</td>
</tr>

</table><p align="center"><br />

    <input type="hidden" id="traineeid" name="traineeid" value="<?php echo($data['traineeID']);?>">
    <input type="hidden" id="addressid" name="addressid" value="<?php echo($data['addressID']);?>">
    <input type="submit" value="Save" class="button">
</p>
<!--article--><!--row 1--></td>
<td width="10" class="verticle"><img src="images/blank.gif" width="10" height="100" border="0" /></td>
<td><!--row 2-->  <div  class="title">ประวัติการสมัคร</div>

    <!--article--><table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr valign="top"  bgcolor="#d4d4d4">
            <td align="left" class="fronttext">no.</td>
            <td align="left" class="fronttext" height="30" >&nbsp;ระยะเวลา</td>
            <td align="left"class="fronttext" >&nbsp;หัวข้อหลักสูตร</td>
            <td align="center" class="fronttext" >&nbsp;ประเภท<br />
                การสมัคร</td>
        </tr>
        <?php
        $rowC = 0;
        foreach ($list_course as $keyC => $valC):
            $rowC++;
            ?>

            <tr valign="top">
                <td align="left" class="tab"><?php echo $rowC ; ?></td>
                <td align="left" class="info" height="30"><?php echo Thaidate::date($valC['startdate'],"DD MM YYYY");?> - <br /><?php echo Thaidate::date($valC['enddate'],"DD MM YYYY");?></td>
                <td align="left" class="info"><strong><?php echo $valC['coursecode']?>: </strong><br /><?php echo $valC['coursename']?><br />

                    รุ่นที่ <?php echo $valC['generation']?>
                </td>
                <td align="center" class="info"><?php echo $valC['typename']?></td>
            </tr>
            <!--     <tr valign="top">
                <td align="left" class="info" colspan="4"><font class="bottomtext">วิธีการการชำระเงิน</font><br/>
                    <strong> <?php echo $valC['paymenttype']?></strong> <?php echo $valC['detail']?>
                                   <strong> เช็ค</strong> เลขที่ xxxxxxxxxxx ธนาคาร xxxxxxxxxxxxxxxxx 
                </td>
            </tr>-->
            <tr valign="top">
                <td colspan="4">
                    <div class="hr dotted">&nbsp;</div>
                </td>
            </tr>
            <?php
        endforeach;
        if($rowC==0){
            echo('<tr valign="top">
                <td colspan="4" style="text-align: center;">
                 '.Msg::$no_course.'
                </td>
            </tr>');
        }
        ?>

        <tr valign="top" >
            <td align="left" ><img src="images/blank.gif" alt="" width="10" height="1" border="0"></td>
            <td align="left" ><img src="images/blank.gif" alt="" width="100" height="1" border="0"></td>
            <td align="left" ><img src="images/blank.gif" alt="" width="205" height="1" border="0"></td>
            <td align="left"><img src="images/blank.gif" alt="" width="100" height="1" border="0"></td>
        </tr>
    </table>
    <div id="space"></div>
<!--    <div  class="tab">ประวัติการแก้ไขรายละเอียดส่วนตัว</div>-->
<!--    <table width="100%" border="0" cellspacing="2" cellpadding="2">-->
<!--        <tr valign="top"  bgcolor="#d4d4d4">-->
<!--            <td class="fronttext" height="30">&nbsp;&nbsp;วันที่แก้ไข</td>-->
<!--            <td class="fronttext" height="30">&nbsp;&nbsp;รายละเอียดการแก้ไข</td>-->
<!--        </tr>-->
<!--        <tr valign="top" >-->
<!--            <td align="left" class="info" height="30" >5 สค. 2555</td>-->
<!--            <td align="left"class="info"><strong>รายละเอียดผู้เข้าร่วมอบรม</strong><br />-->
<!--                คำนำหน้าชื่อ<br />-->
<!---->
<!--                นส. &nbsp;&nbsp;เป็น&nbsp;&nbsp;นาง-->
<!--                <br />-->
<!--                <strong>สถานะการทำงาน</strong><br />-->
<!--                ตำแหน่งสายการบริหาร<br />-->
<!--                ผู้ช่วยผู้อำนวยการ &nbsp;&nbsp;เป็น&nbsp;&nbsp;ผู้อำนวยการ-->
<!--            </td>-->
<!--        </tr>-->
<!--    </table>-->

    <!--article-->
    <img src="images/blank.gif" width="470" height="1" border="0" /><!--row 2-->  </td>
</tr>
</table>




<!--row2-->
<!--row2--><br />
<img src="images/blank.gif" width="500" height="1" border="0" />
</td>
<td width="1"><img src="images/blank.gif" width="1" height="500" border="0" /></td>
</tr>
</table><!--table-->
</form>
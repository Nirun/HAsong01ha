<html>
<head>
    <title></title>
    <LINK REL="stylesheet" HREF="http://www.haregister.com/style2.css" TYPE="text/css">
    <LINK REL="stylesheet" HREF="http://www.haregister.com/member.css" TYPE="text/css">
</head>
<body>
<form name="form-change" id="form-change" enctype="application/x-www-form-urlencoded">
<table>
    <tr valign="top">
        <td class="title" style="text-align: left;">ประเภทการแก้ไขข้อมูลของท่าน ***</td>
    </tr>
    <tr valign="top">
        <td>
            <table border="0" cellspacing="2" cellpadding="2">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;<input name="changeType" type="radio" value="0" checked="checked"/></td>
                    <td>แก้ไขข้อมูลของท่าน</td>
                    <td><input name="changeType" type="radio" value="1"/></td>
                    <td>เปลี่ยนผู้เข้าอบรม</td>
                </tr>
            </table>
        </td>
    </tr>

    <tr valign="top">
        <td class="title" style="text-align: left;">โปรดกรอกรายละเอียดด้านล่าง
        </td>
    </tr>
    <tr valign="top">
        <td>

            <div id="space"></div>
        </td>
    </tr>
    <!--add name-->
    <tr valign="top">
        <td class="tab reserve">
            <table width="98%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                    <td align="left" class="info">
                    </td>
                    <td align="left" class="info"><!--คำนำหน้า--><br/>
                        <select id="prefix" name="prefix" class="info_enable">
                            <option value="0" selected="selected">เลือก</option>
                            <?php
                            foreach ($prefix as $_prefix) {
                                $chkPre = ($_prefix['id'] == $data['prefix']) ? 'selected = "selected"' : '';
                                echo '<option value="' . $_prefix['id'] . '" ' . $chkPre . '>' . $_prefix['title_th'] . '</option>';
                            }
                            ?>

                        </select>
                    </td>
                    <td align="left" class="info">ชื่อ<br/>
                        <input name="name" type="text" class="info_enable" value="<?php echo $data['name']?>">
                    </td>
                    <td align="left" class="info">นามสกุล<br/>
                        <input name="lastname" type="text" class="info_enable"  value="<?php echo $data['lastname']?>">
                    </td>
                    <!--
                    <td align="left" class="info">เลขบัตรประชาชน:<br/>
                        <input name="idcard[]" type="text" class="info_enable">
                    </td>
                    -->
                    <td align="left" class="info">Email Address:<br/>
                        <input name="email" type="text" class="info_enable" value="<?php echo $data['email']?>">
                    </td>
                    <td align="left" class="info">วิชาชีพ:<br/>
                        <select id="occupation" name="occupation" class="info_enable">
                            <option value="0" selected="selected">โปรดเลือกวิชาชีพ</option>
                            <?php
                            foreach ($occupation as $_occupation) {
                                $chkOcc = ($_occupation['id'] == $data['professiontypeID']) ? 'selected = "selected"' : '';
                                echo '<option value="' . $_occupation['id'] . '" '.$chkOcc.'>' . $_occupation['title_th'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td align="left" class="info">อาหารประเภท:<br/>
                        <select id="food" name="food" class="info_enable">
                            <?php
                            foreach ($food as $key => $val) {
                                $chkFood = ($val['food_id'] == $data['food_id']) ? 'selected = "selected"' : '';
                                echo '<option value="' . $val['food_id'] . '" '.$chkFood.'>' . $val['food'] . '</option>';
                            }
                            ?>

                        </select>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr valign="top">
        <td class="tab reserve">
            <table width="98%" border="0" cellspacing="2" cellpadding="2">

                <tr>
                    <td align="left" class="info">
                    </td>

                    <td colspan="5" align="left" class="info">ออกใบเสร็จในนาม<br/>
                        <input name="rc_name" type="text" class="info_enable" value="<?php echo $data['rc_name']?>">
                    </td>

                </tr>
                <tr>
                    <td align="left" class="info">
                    </td>

                    <td colspan="5" align="left" class="info">ที่อยู่<br/>
                        <textarea name="rc_address" rows="5" cols="80"><?php echo $data['rc_address']?></textarea>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
    <!--add name-->

    <tr valign="middle">
        <td class="info" align="center"><br/>
            <input type="hidden" name="traineeID" value="<?php echo $data['traineeID']?>">
            <input type="hidden" name="registrationID" value="<?php echo $data['registrationID']?>">
            <input type="hidden" name="receiptID" value="<?php echo $data['rc_id']?>">
            <input type="button" name="submit-change" value=" บันทึก ">

        </td>
    </tr>
</table>

</form><!-- inside text--></td>
</tr>
</table>
<br/>
<br/>
<br/>
</body>
</html>
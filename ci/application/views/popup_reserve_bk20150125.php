<!--<script type="text/javascript" language="javascript" src="js_validate/popup_reserve.js"></script>-->

            <form id="frm_reserve" name="frm_reserve"
                  action="<?php echo setting::$BASE_URL . '/member/register/save/' ?>" method="post"
                  enctype="application/x-www-form-urlencoded">
                  <table width="600" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top">
        <td width="1"><img src="images/blank.gif" width="1" height="1500" border="0"></td>
        <td>
                <!-- inside text-->
                <table border="0" cellspacing="1" cellpadding="1" width="98%" style="text-align: left!important;">
                    <tr valign="middle">
                        <td><font class="title">สำรองที่นั่งการประชุมหรืออบรม
                        </font>
                        </td>
                    </tr>
                    <tr valign="middle">
                        <td><font class="bottomtext">รายละเอียดของท่าน</font>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a
                                href="<?php echo setting::$BASE_URL . '/member/detail/' ?>" target="_parent">กดที่นี่
                            เพื่อแก้ไขข้อมูลของท่าน</a><br/>
                            <strong><?php echo  $data['prefix'] . ' ' . $data['prefix_other'] . ' ' . $data['name'] . ' ' . $data['lastname'] ?></strong>
                            <br/><strong>สถานะการทำงาน</strong> <?php echo $data['position'] . ' ' . $data['positionother']?>
                            <br/>

                            <strong> เบอร์โทรศัพท์ :</strong>  <?php echo $data['tel']?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                            <strong> เบอร์โทรศัพท์มือถือ :</strong>  <?php echo $data['mobile']?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                            <strong> เบอร์Fax :</strong>  <?php echo $data['fax']?><br/>
                            <strong> อีเมล์ :</strong>  <?php echo $data['email']?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td  align="left">  <img src="images/des2.gif" width="683" height="61"></td>
                    </tr>
                <!--    <tr valign="top">
                        <td class="title">ประเภทการสมัครของท่าน ***</td>
                    </tr>-->
                    <tr valign="top">
                        <td><!--type--><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td  bgcolor="#defb9d"><input name="registerBy" type="radio" value="1"/> สมัครเอง&nbsp;&nbsp;/&nbsp;&nbsp;อาหารประเภทการ &nbsp;&nbsp;&nbsp;<select id="own_food"
                                                                                                          name="own_food">
                                        <?php
                                        foreach ($food as $key => $val) {
                                            echo '<option value="' . $val['food_id'] . '">' . $val['food'] . '</option>';
                                        }
                                        ?></td>
  </tr>
  <tr>
    <td  bgcolor="#defb9d"><input name="registerBy" type="radio" value="3"
                                                                 checked="checked"/>&nbsp;&nbsp;&nbsp;ท่านเป็นผู้ประสานงานสถานพยาบาล ต้องการสมัครมากกว่าหนึ่งคน</td>
  </tr>
</table>

                                                     <!--type-->            
                        </td>
                    </tr>
                   <!-- <tr valign="top">
                        <td align="left">
                            <font class="bottomtext">*** กรณีเลือกปุ่มสมัครเอง
                                ให้กดเลือกปุ่มสำรองที่นั่งด้านล่างได้ทันที *** </font>
                        </td>
                    </tr>-->
                    <tr valign="top">
                        <td> <img src="images/des3.gif" width="683" height="72">
                        </td>
                    </tr>
                    <!--add name-->
                    <?php
                    /*
                     * course type :2 = forum
                     */
                   // $limitUser = ($courseType == 2) ? 20 : 5;
                    $limitUser = 20;
                    for ($i = 1; $i <= $limitUser; $i++):
                        ?>
                        <tr valign="top">
                            <td class="tab reserve">
                                <table width="98%" border="0" cellspacing="1" cellpadding="1">
                                    <tr>
                                        <td align="left" class="info"><!--คำนำหน้า--><?php echo $i?>.<br/>
                                            <select id="prefix_<?php echo $i?>" name="prefix[]" class="info_enable">
                                                <option value="0" selected="selected">เลือก</option>
                                                <?php
                                                foreach ($prefix as $_prefix) {
                                                    echo '<option value="' . $_prefix['id'] . '">' . $_prefix['title_th'] . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </td>
                                        <td align="left" class="info">ชื่อ<br/>
                                            <input name="name[]" type="text" class="info_enable"  width: "150px">
                                        </td>
                                        <td align="left" class="info">นามสกุล<br/>
                                            <input name="lastname[]" type="text" class="info_enable"  width: "150px;">
                                        </td>
                                        <td align="left" class="info">เลขบัตรประชาชน:<br/>
                                            <input name="idcard[]" type="text" class="info_enable">
                                        </td>
                                        <td align="left" class="info">Email:<br/>
                                            <input name="email[]" type="text" class="info_enable">
                                        </td>
                                        <td align="left" class="info">เลือกวิชาชีพ:<br/>
                                            <select id="occupation_<?php echo $i?>" name="occupation[]"
                                                    class="info_enable">
                                                <option value="0" selected="selected">วิชาชีพ</option>
                                                <?php
                                                foreach ($occupation as $_occupation) {
                                                    echo '<option value="' . $_occupation['id'] . '">' . $_occupation['title_th'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td align="left" class="info">อาหารประเภท:<br/>
                                            <select id="food" name="food[]" class="info_enable">
                                                <?php
                                                foreach ($food as $key => $val) {
                                                    echo '<option value="' . $val['food_id'] . '">' . $val['food'] . '</option>';
                                                }
                                                ?>

                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php
                    endfor;
                    ?>
                    <!--add name-->

                    <tr valign="middle">
                        <td class="info" align="center"><br/>
                            <input type="hidden" name="traineeID" value="<?php echo $traineeID ?>">
                            <input type="hidden" name="courseID" value="<?php echo $courseID ?>">
                            <input id="btn_reserve" type="image" src="images/b_reserve.gif" style="visibility:hidden;">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a id="payment" rel="<?php echo $courseID ?>"><img
                                    src="images/b_re2.gif" width="242" height="84" border="0"
                                    style="cursor: pointer;"/></a>
                            <!--            href="-->
                            <?php //echo setting::$BASE_URL.'/member/popup_payment/' ?><!--" class="various fancybox.iframe"-->
                        </td>
                    </tr>
                </table>
            <!-- inside text--></td>
    </tr>
</table>

            </form>
<br/>
<br/>
<br/>

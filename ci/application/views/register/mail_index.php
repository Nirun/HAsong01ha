<div id="container"><font class="title">ระบบส่งอีเมล์</font>

    <form method="post" id="form_preview" enctype="application/x-www-form-urlencoded">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr valign="top">
                <td><img src="images/blank.gif" width="1" height="450" border="0"/></td>
                <td align="center"><!--article--><br/>
                    <br/>
                    <font class="bottomtext">เลือกวิธีการส่งอีเมล์ ที่ต้องการ </font>
                    <table border="0" cellspacing="2" cellpadding="2">
                        <tr valign="top">
                            <td align="left"><input name="type" type="radio" value="0"/></td>
                            <td align="left">ส่งแบบกลุ่ม</td>
                            <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;<input name="type" type="radio" value="1" checked="checked"/></td>
                            <td align="left">ส่งแบบรายบุคคล</td>
                        </tr>
                    </table>
                    <table border="0" cellspacing="3" cellpadding="3" align="center">
                        <tr>
                            <td class="info" align="right"> เลือกรูปแบบ Email ที่ต้องการส่ง</td>
                            <td align="left">
                                <select name="template" tabIndex="8"
                                        style="  width: 200px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;">
                                    <option value="--" selected="selected">เลือกรูปแบบ Email</option>
                                    <?php
                                    foreach ($template as $row) :
                                        ?>
                                        <option value="<?php echo $row['tp_id']?>"><?php echo $row['tp_name']?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>&nbsp;&nbsp;&nbsp;&nbsp;
                                <!--                            <a href="pop_template_mail.php?height=650&width=980" class="thickbox" rel="thickbox_slide1">-->
                                <a href="<?php echo Setting::$BASE_URL ?>/register/mail/popup_template/?height=650&width=980"
                                   class="thickbox" rel="thickbox_slide1">
                                    <img src="register/images/emailadd.gif" width="145" height="24" border="0"/>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="info" align="right"><strong>ส่งแบบกลุ่ม</strong> / เลือกหัวข้อหลักสูตร
                                ที่ต้องการจะส่งให้คนในกลุ่ม
                            </td>
                            <td align="left"><select id="group" name="group" tabIndex="8"
                                                     style="  width: 500px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;">
                                <option value="">เลือกหัวข้อหลักสูตร</option>
                                <?php
                                foreach ($course_list as $key => $valC):
                                    $c_name = $valC['coursecode'] . ':' . $valC['coursename'];
                                    ?>
                                    <option
                                            value="<?php echo $valC['courseID']?>"><?php echo $c_name?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select></td>
                        </tr>
                        <tr>
                            <td class="info" align="right"><strong>ส่งแบบรายบุคคล</strong> / กรอก Email บุคคล
                                ที่ต้องการส่ง
                                &nbsp;To:
                            </td>
                            <td align="left"><input name="to" type="text"
                                                    style="  width: 400px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="info" align="right"><strong>ส่งแบบรายบุคคล</strong> / กรอก Email บุคคล
                                ที่ต้องการส่ง
                                &nbsp;CC:
                            </td>
                            <td align="left"><input name="cc" type="text"
                                                    style="  width: 400px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            </td>
                        </tr>
                        <tr>
                            <td class="info" align="right"><strong>ส่งแบบรายบุคคล</strong> / กรอก Email บุคคล
                                ที่ต้องการส่ง
                                &nbsp;BCC:
                            </td>
                            <td align="left"><input name="bcc" type="text"
                                                    style="  width: 400px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"><br/>
                                <font class="copy4">Use<strong> ;</strong> to seperate each Email address</font></td>
                        </tr>
                        <tr>
                            <td class="info" align="right"><strong>หัวข้อ Email</strong>
                                ที่ต้องการส่ง
                            </td>
                            <td align="left"><input name="subject" type="text"
                                                    style="  width: 400px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            </td>
                        </tr>
                        <tr valign="top">
                            <td class="info" align="right"><br/>
                                <strong>ข้อความที่ต้องการส่ง</strong> <br/>
                                <font class="copy4">(สามารถใส่ html code ได้)</font></td>
                            <td align="left"><br/><textarea name="desc" rows="30"
                                                            style="  width: 600px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></textarea>

                                <p align="left"><br/>
                                    <input id="btn_preview" name="btn_preview" type="button" value="Preview" style="padding: 2px 10px;" />
                                </p></td>
                        </tr>
                    </table>
                    <!--article-->


                </td>
            </tr>
        </table>
    </form>

    <div id="space"></div>

</div>

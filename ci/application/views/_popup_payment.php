<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<!--<head>-->
<!--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<!--    <LINK REL="stylesheet" HREF="style2.css" TYPE="text/css">-->
<!--    <title>สถาบันรับรองคุณภาพสถานพยาบาล (องค์การมหาชน) The Healthcare Accreditation Institute (Public Organization)</title>-->
<!--</head>-->
<!---->
<!--<body><br />-->
<form action="<?php echo setting::$BASE_URL ?>/member/register/paid/" method="post"
      enctype="application/x-www-form-urlencoded">
          <table border="0" cellspacing="1" cellpadding="1" width="100%" style="text-align: left;">
        <tr valign="middle">
            <td><font class="title">การชำระเงิน
            </font>
            </td>
        </tr>
        
</table>
        
      <table width="950" border="0" cellspacing="2" cellpadding="2">
  <tr valign="top">
    <td align="left" width="150"><!--text descrip--><font class="bottomtext"><strong>หมายเหตุ</strong></font><br/>
                            เมื่อท่านกดปุ่มตกลงแล้ว ทางโปรแกรมจะจัดส่งใบแจ้งชำระเงินให้ท่านทาง email ที่ท่านลงทะเบียนไว้
                            เพื่อให้ท่านนำไปชำระเงินที่ เคาเตอร์ธนาคารกรุงไทยทุกสาขา<br/>ทางสถาบันจะส่งใบยืนยันการรับชำระกับท่านอีกครั้งทาง
                            email เมื่อท่านชำระเงินเรียบร้อยแล้ว<br/><br/>การลงทะเบียนจะสมบรูณ์ต่อเมื่อสถาบันฯ
                            ได้รับการยืนยันชำระเงินจากทางธนาคาร<br/>
                            ทางสถาบันจะจัดส่งใบเสร็จรับเงินให้ท่านทางไปรษณีย์ <br/><br/>
                            <font class="bottomtext"><strong>โปรดชำระเงินภายใน 15 วันหลังจากที่ท่านได้สำรองที่นั่ง
                                เพื่อสำรองสิทธิ <br/>หากเกิน 15 วัน
                                ทางสถาบันจะยกเลิกการสำรองที่นั่งของท่านทันที</strong></font><br />
<br />
  <strong> สอบถามรายละเอียดเพ่มเติมได้ที่ </strong><br/>
                            <font class="bottomtext"><strong> สถาบันรับรองคุณภาพสถานพยาบาล
                                (องค์การมหาชน)</strong></font><br/>
                            The Healthcare Accreditation Institute (Public Organization)<br/>
                            88/39 กระทรวงสาธารณสุข ซอย 6 <br/>อาคารสุขภาพแห่งชาติ ชั้น 5 ถ.ติวานนท์ <br/>
                            ต.ตลาดขวัญ อ.เมือง จ.นนทบุรี 11000<br/>
                            โทรศัพท์ 0-2832-9461 - 65, 2-0832-9412-22 <br/>
                            โทรสาร 0-2832-9540<!--text descrip-->
</td>
    <td width="10" class="verticle"><img src="images/blank.gif" width="10" height="60" border="0"/></td>
                        <td width="5">&nbsp;</td>
    <td align="left" width="200"><!--payment type add-->  <table border="0" cellspacing="1" cellpadding="1" width="100%" style="text-align: left;">
             <tr valign="middle">
            <td>
                <font class="bottomtext">ต้องการให้ออกใบเสร็จในนาม</font><br/><br/>
                <table width="100%" border="0" cellpadding="1">
                    <tr valign="top">
                        <td width="20"><input name="receipt_type" type="radio" value="self" checked="checked"/></td>
                        <td align="left" width="180"><strong>ออกใบเสร็จในนามท่านเอง:</strong> <br/>
                            <?php
                            $user_name = $user_info['prefix'] . ' ' . $user_info['prefix_other'] . ' ' . $user_info['name'] . ' ' . $user_info['lastname'];
                            echo $user_name;
                            ?><input type="hidden" name="user_name" value="<?php echo $user_name;?>"><br/>
                            <strong>ที่อยู่:</strong> <br/>
                            <?php
                            $user_address = $user_info['address'] . ' ' . $user_info['PROVINCE_NAME'] . ' ' . $user_info['postcode'];
                            echo $user_address;
                            ?><input type="hidden" name="user_address" value="<?php echo $user_address;?>"><br/>
                            <strong>Email address: </strong><br/>
                            <a href="#"><?php echo $user_info['email'];?> </a></td>

                        <td width="10" class="verticle"><img src="images/blank.gif" width="10" height="60" border="0"/>                        </td>
                        <td width="5">&nbsp;</td>
                        <td width="20"><input name="receipt_type" type="radio" value="other"/></td>
                        <td align="left" width="180"><strong>ออกใบเสร็จในนามรพ. หรืออื่นๆ</strong><br/>
                            <input name="other_name" type="text"
                                   style="  width:150px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            <br/>ที่อยู่<br/>
                            <textarea name="other_address" rows="15"
                                      style="  width: 150px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></textarea>
                        </td>
                        <td width="10" class="verticle"><img src="images/blank.gif" width="10" height="60" border="0"/>
                        </td>
                        <td width="5">&nbsp;</td>
                        <td width="20"><input name="receipt_type" type="radio" value="separate" <?php if($regis_bill==false){?> disabled="disabled"<?php }?>/></td>
                        <td width="200"><strong>แยกออกใบเสร็จในนามบุคคลที่ท่านสมัครให้</strong><br/> <br/>

                            <?php
                            if ($regis_bill !== false):
                                $rbill = 0;
                                foreach ($regis_bill as $k => $v):
                                    $rbill++;
                                    $txtNameVal = $v['name'] . ' ' . $v['lastname'];
                                    $txtName = '';
                                    $txtName = $rbill . '. ' . $v['name'] . ' ' . $v['lastname'];
                                    $txtName .= ($rbill == 1) ? ' Default ' : '';

                                    ?>
                                    <strong><?php echo $txtName; ?><input type="hidden" name="separate_name[]"
                                                                          value="<?php echo $txtNameVal; ?>"></strong>
                                    <br/>ที่อยู่<br/>
                                    <textarea name="other_add_separate[]" rows="3"
                                              style="  width: 220px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></textarea>

                                    <?php if ($rbill == 1): ?>
                                    <br/>
                                    <input name="receipt_default_add" type="checkbox" value="1"/> ที่อยู่เดียวกันทั้งหมด
                                    <?php
                                endif;
                                    echo '<br>';
                                endforeach;
                            endif;
                            ?>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr valign="bottom">
            <td class="info" align="center" height="100"><br/>
                <input type="hidden" name="courseID" value='<?php echo $courseID?>'>
                <input type="hidden" name="register" value='<?php echo $data?>'>
                <input type="image" src="images/b_send.gif" width="107" height="24"><br/><br/>

               

            </td>
        </tr>
    </table>
</form><!--payment type add--></td>
  </tr>
</table>

      
      
      
  
<!--</body>-->
<!--</html>-->

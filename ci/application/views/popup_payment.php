
<form id="popup-paid" action="<?php echo setting::$BASE_URL ?>/member/register/paid/" method="post"
      enctype="application/x-www-form-urlencoded"><div id="leftcolumn1"> 
<div id="header">รายละเอียดการออกใบเสร็จ</div> 

<div id="warningtop">เลือกประเภทการออกใบเสร็จอย่างใดอย่างหนึ่ง </div> 
<br/> 
<!--payment type add1-->
  <div id="coursename"> 
<table  border="0" cellspacing="1" cellpadding="1">
  <tr valign="top">
    <td> <input name="receipt_type" type="radio" value="self" checked="checked"/></td>
    <td class="smtextplain"><font class="smtext">ออกใบเสร็จในนามท่านเอง </font> 
      <br/> <br/>
                          
                            <?php
                            $pf = ($user_info['prefix'] != 'อื่นๆ') ? $user_info['prefix'] : $user_info['prefix_other'];
                            $user_name = $pf . ' ' . $user_info['name'] . ' ' . $user_info['lastname'];
                            echo $user_name;
                            ?><input type="hidden" name="user_name" value="<?php echo $user_name;?>"><br/>
                            เลขบัตรประชาชนหรือ<br/>เลขผู้เสียภาษีสำหรับการออกใบเสร็จ
      <br/> <?= $user_info['cardID'];?>
      <br/> 
      ที่อยู่ <br/>
                            <?php
                            $user_address = $user_info['address'] . ' ' .$user_info['soi'] . ' ' .$user_info['road'] . ' ' .$user_info['district'] . ' ' . $user_info['PROVINCE_NAME'] . ' ' . $user_info['postcode'];
                            echo $user_address;
                            ?>
                            <input type="hidden" name="user_address" value="<?php echo $user_info['address'];?>">
                            <input type="hidden" name="user_soi" value="<?php echo $user_info['soi'];?>">
                            <input type="hidden" name="user_road" value="<?php echo $user_info['road'];?>">
                            <input type="hidden" name="user_district" value="<?php echo $user_info['district'];?>">
                            <input type="hidden" name="user_province" value="<?php echo $user_info['PROVINCE_NAME'];?>">
                            <input type="hidden" name="user_postcode" value="<?php echo $user_info['postcode'];?>">
                            <input type="hidden" name="user_taxID" value="<?php echo $user_info['cardID'];?>">
                            <br/>
                         Email address 
                            <a href="#"><?php echo $user_info['email'];?> </a></td>
  </tr>
</table>
</div> 


                <!--payment type add1-->
                
               </div> 
                
	<div id="rightcolumn">
<br/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table> 
<!--payment type add2-->
                <table  border="0" cellpadding="1" align="left">
                    <tr valign="top">
                        <td width="5"><input name="receipt_type" type="radio" value="other"/></td>
                        <td align="left" ><font class="smtext">ออกใบเสร็จในนามรพ. หรืออื่นๆ </font> <br/>
                        <font class="sm"> *** โปรดกรอกทุกหัวข้อ ***</font>
<br/><br/>
                            ชื่อ หรือ สถานที่ ที่ต้องการออกใบเสร็จ<br/>
                            <input disabled="disabled" name="other1_name" type="text"
                                   style="  width:250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            <br/>
                             เลขบัตรประชาชนหรือ<br/>เลขผู้เสียภาษีสำหรับการออกใบเสร็จ
 <br/><input disabled="disabled" type="text" name="other1_taxID" value="" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            <br/> 
                            เลขที่<br/><input disabled="disabled" type="text" name="other1_address" value="" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            <br/> 
                            ชอย<br><input disabled="disabled" type="text" name="other1_soi" value="" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            <br/> 
                            ถนน<br><input disabled="disabled" type="text" name="other1_road" value="" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            <br/> 
                            เขต /  อำเภอ <br><input disabled="disabled" type="text" name="other1_district" value="" style="  width: 150px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                            <br/> 
                            จังหวัด<br>
<!--                            <input disabled="disabled" type="text" name="other1_province" value="" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">-->
                            <select name="other1_province" disabled="disabled" id="province" style=" width: 200px;">
                                <option value="">.:: เลือก ::.</option>
                                <?php
                                foreach($province as $_province){
                                    echo '<option value="'.$_province['PROVINCE_NAME'].'">'.$_province['PROVINCE_NAME'].'</option>';
                                }
                                ?>

                            </select>
                            <br/>
                            รหัสไปรษณีย์<br><input disabled="disabled" type="text" name="other1_postcode" value="" style="  width: 150px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                        </td>
                    </tr>
                </table>
                <!--payment type add2--> 
                
                
              <!--payment type add3-->
                <table   border="0" cellpadding="1" align="left">
                    <tr valign="top">
                        <td width="5"><input name="receipt_type" type="radio"
                                             value="separate" <?php if ($regis_bill == false) { ?>
                                             disabled="disabled"<?php }?>/></td>
                        <td><font class="smtext"> แยกออกใบเสร็จในนามบุคคลที่ท่านสมัครให้</font> <br/>
                        <font class="sm"> *** โปรดกรอกทุกหัวข้อ ***</font>
                        <br/> <br/>

                            <?php
                            if ($regis_bill !== false):
                                $rbill = 0;
                                foreach ($regis_bill as $k => $v):
                                    $rbill++;
                                    $txtNameVal = util::getPrefixById($v['prefix']) . ' ' . $v['name'] . ' ' . $v['lastname'];
                                    $txtName = '';
                                    $txtName = $rbill . '. ' . util::getPrefixById($v['prefix']) . ' ' . $v['name'] . ' ' . $v['lastname'];
                                    //$txtName .= ($rbill == 1) ? ' Default ' : '';

                                    ?>
                                    <strong><?php echo $txtName; ?><input disabled="disabled" type="hidden"
                                                                          name="separate_name[]"
                                                                          value="<?php echo $txtNameVal; ?>"></strong>
                                                                           <br/>
                          เลขบัตรประชาชนหรือ<br/>เลขผู้เสียภาษีสำหรับการออกใบเสร็จ
 <br/><input disabled="disabled" type="text" name="other2_taxID_separate[]" value="<?php echo $v['idcard']; ?>" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
 
                                    <br/>ที่อยู่ เลขที่

                     <br/><input disabled="disabled" type="text" name="other2_add_separate[]" value="" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                                   <br> ชอย<br><input disabled="disabled" type="text" name="other2_soi_separate[]" value="" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                                   <br> ถนน<br><input disabled="disabled" type="text" name="other2_road_separate[]" value="" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
                                   <br> เขต /  อำเภอ <br><input disabled="disabled" type="text" name="other2_district_separate[]" value="" style="  width: 150px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">
<!--                                   <br> จังหวัด<br><input disabled="disabled" type="text" name="other2_province_separate[]" value="" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">-->
                                   <br> จังหวัด<br>
                                    <select name="other2_province_separate[]" disabled="disabled"  style=" width: 200px;">
                                        <option value="">.:: เลือก ::.</option>
                                        <?php
                                        foreach($province as $_province){
                                            echo '<option value="'.$_province['PROVINCE_NAME'].'">'.$_province['PROVINCE_NAME'].'</option>';
                                        }
                                        ?>

                                    </select>

                                   <br> รหัสไปรษณีย์<br><input disabled="disabled" type="text" name="other2_postcode_separate[]" value="" style="  width: 150px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;">


                                    <?php if ($rbill == 1): ?>
                                    <br/>
                                    <input disabled="disabled" name="receipt_default_add" type="checkbox" value="1"/>
                                    ทุกรายชื่อใช้ที่อยู่เดียวกันทั้งหมด
                                    <?php
                                endif;
                                    echo ' <br/><br>';
                                endforeach;
                            endif;
                            ?></td>
                    </tr>
                </table>
                <!--payment type add3-->   
<br clear="all">
                <p align="center"><span style="padding: 5px;background-color: #00CC00;cursor: pointer;" id="payment-btn-preview">Preview</span></p>
                <p align="center">
                
                <input type="hidden" name="courseID" value='<?php echo $courseID?>'>
                    <input type="hidden" name="register" value='<?php echo $data?>'>
                    <input id="submit-payment" type="image" src="imagenew/sendconfirms.gif" border="0"></p>

                <p id="paid-saving"></p>
                <div id="dialog" title="Preview" style="display: none;text-align: left;font-size: 14px;"></div>


</div> </form>
<!--</body>-->
<!--</html>-->

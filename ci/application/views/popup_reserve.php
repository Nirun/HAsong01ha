  
                   <form id="frm_reserve" name="frm_reserve"
                  action="<?php echo setting::$BASE_URL . '/member/popup_payment/'.$courseID ?>" method="post"
                  enctype="application/x-www-form-urlencoded">
                  
                  
               
                   <div id="leftcolumn1">
                      <div id="header">สำรองที่นั่งการประชุมหรืออบรม</div><div id="remarkbox"> 
                  <div id="warningtop">รายละเอียดของท่าน</div>  
                  <br/><font class="smtextplain">
     <?php echo  $data['prefix'] . ' ' . $data['prefix_other'] . ' ' . $data['name'] . ' ' . $data['lastname'] ?> 
          
   <br/>วิชาชีพ <?php echo $data['position'] . ' ' . $data['positionother']?>
                            <br/>
เบอร์โทรศัพท์</strong>  <?php echo $data['tel']?>
<br/>
 เบอร์โทรศัพท์มือถือ  <?php echo $data['mobile']?>
 <br/>เบอร์Fax <?php echo $data['fax']?>
 <br/>
 อีเมล์  <?php echo $data['email']?>   <br/>
เลขบัตรประชาชน
      <br/> <?=$data['cardID']?>
 </font>
  <div class="butt"> <a  href="<?php echo setting::$BASE_URL . '/member/detail/' ?>" target="_parent"   class="more2">กดที่นี่
                            เพื่อแก้ไขข้อมูลของท่าน</a></div>
                  </div></div>
                    <div id="rightcolumn1">
                    <br/><br/>
                    <table  border="0" cellspacing="0" cellpadding="3" align="center">
  <tr>
    <td> <div id="warningtop"> เอกสารที่ต้องเตรียมในการสำรองที่นั่ง</div>
 
<ul> 
 <font class="smtext">กรณีเป็นผู้ประสานงานสถานพยาบาล </font> 
  <li  class="smtextplain">รายละเอียดบุคคลที่ท่านจะสมัครให้พร้อมเลขบัตรประชาชน</li>
  <li  class="smtextplain"> ชื่อสถานพยาบาลต้นสังกัด</li>
  <li  class="smtextplain">ที่อยู่สำหรับการออกใบเสร็จ</li>
  <li  class="smtextplain"> เลขผู้เสียภาษีสำหรับการออกใบเสร็จ</li>

</ul>
</td>
  </tr>
</table>

                     
                   
                            
                    </div>
                    <br clear="all">
                  
                   <div id="alone">
            


  
<div id="warningtop">รายละเอียดการสมัครครั้งนี้
<br/>
ชื่อการอบรม <?=$course['coursename'];?> รุ่น <?=$course['generation'];?>
<br/>
วันที่อบรม:  <?=Thaidate::date($course['startdate'],"DD MM YYYY");?> ถึง: :  <?=Thaidate::date($course['enddate'],"DD MM YYYY");?>
<br/>
ระยะเวลาการอบรม  <?=$course['days'];?> วัน
<br/>
ค่าลงทะเบียน <?=$course['price'];?> บาท

</div>
<br> 
                          
           <!--type--><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td  bgcolor="#dfdfdf"> <input name="registerBy" type="radio" value="1"/> สมัครเอง&nbsp;&nbsp;/&nbsp;&nbsp;อาหารประเภทการ &nbsp;&nbsp;&nbsp;<select id="own_food" name="own_food">
                                        <?php
                                        foreach ($food as $key => $val) {
                                            echo '<option value="' . $val['food_id'] . '">' . $val['food'] . '</option>';
                                        }
                                        ?></td>
  </tr>
  <tr>
    <td  bgcolor="#dfdfdf"><input name="registerBy" type="radio" value="3"  checked="checked"/>ท่านเป็นผู้ประสานงานสถานพยาบาล ต้องการสมัครมากกว่าหนึ่งคน</td>
  </tr>
</table>
การลงทะเบียนในแต่ละครั้งสามารถลงทะเบียนได้ครั้งละ 20 ท่าน แต่ถ้า Internet ไม่เสถียรแนะนำให้ลงทะเบียนครั้งละ 5 ท่าน ต่อการลงทะเบียน 1 ครั้ง 
<br/><br/>
                                                     <!--type--> 
                                                  <?php
                    /*
                     * course type :2 = forum
                     */
                   // $limitUser = ($courseType == 2) ? 20 : 5;
                     $limitUser = ($maximum_register == 0) ? 20 : $maximum_register;
                    for ($i = 1; $i <= $limitUser; $i++):
                        ?>   <table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" >
  <tr>
    <td align="center" bgcolor="#eaf3ff"> 
<!--info--> 
<table border="0" cellspacing="1" cellpadding="1" align="left" width="100%">
  <tr>
    <td align="left"><strong><?php echo $i?>. </strong>  คำนำหน้าชื่อ 
                                            <select id="prefix_<?php echo $i?>" name="prefix[]" class="info_enable">
                                                <option value="0" selected="selected">เลือก</option>
                                                <?php
                                                foreach ($prefix as $_prefix) {
                                                    echo '<option value="' . $_prefix['id'] . '">' . $_prefix['title_th'] . '</option>';
                                                }
                                                ?>

                                            </select></td>
  </tr>
</table>

<table border="0" cellspacing="1" cellpadding="1" align="left">
  <tr> 
    <td>ชื่อ<br/>
                                            <input name="name[]" type="text" class="info_enable"  style="width:130px;"></td>
    <td>นามสกุล<br/>
                                            <input name="lastname[]" type="text" class="info_enable"   style="width:130px;"></td>
  </tr>
</table>

<table border="0" cellspacing="1" cellpadding="1" align="left">
  <tr>
    <td>เลขบัตรประชาชน:<br/>
                                            <input name="idcard[]" type="text" class="info_enable"  style="width:130px;"></td>
    <td>Email:<br/>
                                            <input name="email[]" type="text" class="info_enable"  style="width:130px;"></td>
  </tr>
</table>

<table border="0" cellspacing="1" cellpadding="1" align="left">
  <tr>
    <td>วิชาชีพ:<br/>
                                            <select id="occupation_<?php echo $i?>" name="occupation[]"
                                                    class="info_enable">
                                                <option value="0" selected="selected">วิชาชีพ</option>
                                                <?php
                                                foreach ($occupation as $_occupation) {
                                                    echo '<option value="' . $_occupation['id'] . '">' . $_occupation['title_th'] . '</option>';
                                                }
                                                ?>
                                            </select></td>
    <td>อาหารประเภท <br/>
                                            <select id="food" name="food[]" class="info_enable">
                                                <?php
                                                foreach ($food as $key => $val) {
                                                    echo '<option value="' . $val['food_id'] . '">' . $val['food'] . '</option>';
                                                }
                                                ?>

                                            </select></td>
  </tr>
</table> 
 </td>
  </tr>
</table>
<!--info--> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td> 
</td>
  </tr>
</table>
<br/> 
<?php
                    endfor;
                    ?>
    
                                                     
                    <br/>
                            <input type="hidden" name="traineeID" value="<?php echo $traineeID ?>">
                            <input type="hidden" name="courseID" value="<?php echo $courseID ?>">
                            <input id="btn_reserve" type="image" src="images/b_reserve.gif" style="visibility:hidden;">
                           <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">  <div class="butt" style="cursor:pointer;">  <a id="payment" rel="<?php echo $courseID ?>"  target="_parent"   class="more2">ส่งข้อมูลการลงทะเบียน</a></div> </td>
  </tr>
</table>

                          
                            <!--            href="-->
                            <?php //echo setting::$BASE_URL.'/member/popup_payment/' ?>           
                            
                            
       </div> 
            </form>
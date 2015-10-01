 
<div id="leftcolumn1"> <div id="imgdetails"></div>
<div id="header">รายละเอียดการประชุมและการอบรม </div>
<br> 
<div id="warningtop"><?php echo $data['coursecode'] . ":" . $data['coursename'] ." รุ่น ".$data['generation']; ?></div>
<br> 
<font class="smtext">วันที่อบรม:  </font> <?php echo Thaidate::date($data['startdate'], 'DD MM YYYY'); ?>  ถึง:  <?php echo Thaidate::date($data['enddate'], 'DD MM YYYY'); ?>
  <br> 
<font class="smtext">ระยะเวลาการอบรม </font> <?php echo $data['days']; ?>  วัน
<br> 
<font class="smtext">จำนวนเปิดลงทะเบียน </font>  <?php echo $data['limittrainees']; ?>  คน
<br>  
<font class="smtext">จำนวนคนลงทะเบียนแล้ว </font>  <?php echo $C_reg; ?>  คน
<br>  
<font class="smtext">จำนวนคนจ่ายเงินแล้ว </font> <?php echo $C_paid; ?>  คน
<br> 
<font class="smtext">ค่าลงทะเบียน</font>  <?php echo $data['price']; ?>  บาท
<br>  <br> 
<font class="smtext">ราคานี้รวม  </font>
  <ul class="optional">
                                                                <?php foreach ($optional as $key => $val) {
                                                                echo '<li>' . $val['optional'] . '</li>';
                                                            }
                                                                ?>

                                                            </ul>
   <!--doc-->
                                    <?php if (count($docs) != 0) { ?>
<font class="smtext">เอกสารประกอบการอบรม</font> <table border="0" cellspacing="3" cellpadding="3">
                                        <tr valign="top">
                                            <td>
                                                <?php
                                                $row = 0;
                                                foreach ($docs as $key => $val) {
                                                    $row++;
                                                    $doc = Setting::$PATH_PDF . $val['file'];
                                                    echo $row . '. ' . $val['title'] . ' ';
                                                    echo '<a href="' . $doc . '" target="_blank">click here</a>';
                                                    echo '<br>';
                                                }
                                                if ($row == 0) {
                                                    // echo Msg::$no_docs;
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php } ?>
                                    <!--doc--> 

<br>  
<font class="smtext">วิทยากร: </font><br>  
 <?php echo $data['speaker']; ?>
 
<br>  <br> 
<font class="smtext">สถานที่อบรม:</font><br> 
   <?php echo $data['place']; ?>

 <?php if ($data['maplink'] != '') { ?>
                                       <font class="smtext"> แผนที่:</font><br> 
                                        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0"
                                                marginwidth="0"
                                                src="<?php echo $data['maplink']; ?>">
                                        </iframe><br/>
                                        <small>
                                            <a href="<?php echo $data['maplink']; ?>"
                                               style="color:#0000FF;text-align:left">ดูแผนที่ขนาดใหญ่ขึ้น</a>
                                        </small>
                                        <?php } ?>
                                    <br><br/>
                                    <?php
                                    if ($data['map'] != '') {
                                        ?>
                                      <font class="smtext"> แผนที่:</font><br> 
                                        <a href="<?php echo Setting::$PATH_MAP . $data['map']; ?>" target="_blank">
                                            <img src="<?php echo Setting::$PATH_MAP . $data['map']; ?>"border="0">
                                        </a>
                                        <?php } ?>
                                        
 <div class="butt"><a href="<?php echo Setting::$PATH_MAP . $data['map']; ?>" target="_blank"  class="more2" >กดดูแผนที่</a></div>
 </div>
        
	<div id="rightcolumn">
 
<div id="subheader">คุณสมบัติของผู้เข้าอบรม</div>
 <?php echo $data['qualification']; ?>
<br> 

<div id="subheader">วัตถุประสงค์ เพื่อให้ผู้เข้าอบรม</div>
 <?php echo $data['objective']; ?>

<br> 

<div id="subheader">เนื้อหา</div>
 <?php echo $data['content']; ?>
        <?php
//        var_dump($data); exit;
        if($data['coursetypeID']==3){
            echo 'xxx 333';
        }
        ?>

<br> 
<br> 
<font class="smtext">หากท่านไม่เห็นปุ่มกดลงทะเบียนด้านล่าง
 หมายถึงหลักสูตรการอบรมนี้ได้หมดเขตการสมัครแล้ว</font><br>  <br/>
        <?php if ($btn_status == 1): ?>
            <a id="reserve_2" rel="<?php echo $courseID ?>"
               href="<?= setting::$BASE_URL ?>/member/popup_reserve/<?php echo $courseID ?>" rev="<?=$coursetypeID?>">
                <img src="imagenew/b_re.gif" border="0" style="cursor: pointer;"/>
            </a>
        <?php elseif ($btn_status == 2): ?>
            <img src="imagenew/b_re2.gif" border="0" style="cursor: pointer;"/>
        <?php
        elseif ($btn_status == 3): ?>
            <a id="reserve_2" rel="<?php echo $courseID ?>"  href="<?= setting::$BASE_URL ?>/member/popup_reserve/<?php echo $courseID ?>" rev="<?=$coursetypeID?>">
            <img src="imagenew/b_re3.gif" border="0" style="cursor: pointer;"/>
            </a>
        <?php endif; ?>



 </div> 
        
  
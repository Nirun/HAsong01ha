
<div id="leftcolumnhome"> 
<div id="welcomeimg"> <img src="imagenew/welcome.gif" border="0"></div>
<div id="welcomeimg2"> <img src="imagenew/welcome2.gif" border="0"></div>
<br>
<div id="header">หน้าแรกสมาชิก </div>

การลงทะเบียนในแต่ละครั้งสามารถลงทะเบียนได้ครั้งละ 20 ท่าน  แต่ถ้า Internet ไม่เสถียรแนะนำให้ลงทะเบียนครั้งละ 5 ท่าน ต่อการลงทะเบียน 1 ครั้ง 
<br><br>
 <font class="smtext">โปรดชำระเงินผ่านทางธนาคารกรุงไทย ทุกสาขา ภายใน 15 วัน เพื่อยืนยันการเข้าร่วมประชุมหรืออบรม หากเลยเวลาดังกล่าว โปรแกรมจะยกเลิกการสำรองที่นั่งของท่านโดยอัตโนมัติ </font>
<br><br>
<div id="warningtop2"> รายละเอียดและสถานะการสมัคร ของท่าน </div> 
<!--course-->
   <?php
                if (count($data) > 0) :
                    foreach ($data as $key => $val):
                        ?>
                        <!--1--> 
                        <div id="coursename"> 
                                <table border="0" cellspacing="2" cellpadding="2"  width="100%">
                                    <tr valign="top">
                                        <td align="left" > <div id="warningtop">
 <?php echo $val['coursecode']?> 
                                            <?php echo $val['coursename']?> &nbsp;/&nbsp;
                                            รุ่นที่ <?php echo $val['generation']?>  </div>
                                            <br/>
                                            <a href="<?php echo setting::$BASE_URL . '/member/course/' . $val['courseID']?>"><img
                                                    src="imagenew/b_coursedetails.png" border="0"/></a>
                                            <br/> <strong>ระยะเวลาการอบรม</strong> 
                                            <?php echo Thaidate::date($val['startdate'], 'DD MM YYYY') ?>
                                            - <?php echo Thaidate::date($val['enddate'], 'DD MM YYYY') ?><br/>

                                            <!--<strong>ตำแหน่งว่าง</strong> 6 คน<br/>-->
                                          <strong>  เปิดรับสมัครตั้งแต่วันที่:</strong>  <?php echo Thaidate::date($val['registstartdate'], 'DD MM YYYY') ?>
                                         <strong>    ถึง: </strong><?php echo Thaidate::date($val['registenddate'], 'DD MM YYYY')?>
                                            <br/>
                                           <strong>  วันที่สมัคร </strong><?php echo Thaidate::date($val['registerdatetime'], 'DD MM YYYY');?>
                                            <br/>

                                       <strong>  สถานะการชำระเงิน: </strong>

                                            <?php if ($val['IsPaid'] == 1):
                                                //echo 'ชำระเรียบร้อย  |  ใบเสร็จ ';
                                                echo '<font color="#FF0000"><strong>ชำระเงินเรียบร้อยแล้ว</strong> </font> <br> <strong>ได้รับเงินวันที่:</strong>  ';
                                                //echo $val['coursecode']; else:
                                                echo Thaidate::date($val['paiddatetime'], 'DD MM YYYY');

                                                if ($val['registerBy'] == 1):
                                                    $dataSeats = util::getSeat($val['registrationID']);
                                                    if (count($dataSeats) > 0) :
                                                       // var_dump($dataSeats);
                                                        echo ' <br><strong>เลขที่นั่ง: </strong>   ' . $dataSeats[0]['seatNo'];
                                                   endif;
                                                else :
                                                    $dataRepresent1 = util::getRepresentiveList($val['registrationID']);
                                                    $arrSeat = array();
                                                    foreach($dataRepresent1 as $k1=>$v1){
                                                        $dataSeats1 = util::getSeat($v1['registrationID']);
                                                        $arrSeat[] = $dataSeats1[0]['seatNo'];
                                                    }
                                                    $txtSeat = implode(", ",$arrSeat);
                                                    echo ' <br><strong>เลขที่นั่ง: </strong>   ' . $txtSeat;
                                                   // var_dump($dataRepresent1,$val['registrationID']);
                                               endif;

                                            elseif ($val['IsPaid'] == 4):
                                                echo '<font color="#FF0000"><strong>รอการติดต่อกลับ</strong> </font>';
                                            else:
                                                echo '<font color="#FF0000"><strong>สำรองที่นั่ง รอการชำระเงิน</strong> </font>';
                                            endif;
                                            ?>
                                            <br> <br>
 <font class="smtext">รายชื่อคนสมัครในใบเสร็จนี้  กดชื่อด้านล่างเพื่อแก้ไขรายละเอียด (แก้ไขได้เฉพาะผู้ที่ยังไม่ได้ชำระเงิน) </font>
 <br/>
                                            <table width="100%" border="0" cellspacing="2" cellpadding="2"
                                                   bgcolor="#FFFFFF">
                                                <tr>
                                                    <td>
                                                     <?php
                                                        $arrRegID = array();
                                                        if ($val['registerBy'] == 1):
                                                             $txt_name = ($val['prefix'] == 6) ? $val['prefix_other'] : $val['title_th'] . ' ';
                                                        $txt_name .= $val['name'] . ' ' . $val['lastname'] ;
                                                            // echo $val['typename'];
                                                            echo $txt_name;
                                                        $arrRegID[] = $val['registrationID'];
                                                        else:
                                                            $dataRepresent = util::getRepresentiveList($val['registrationID']);
                                                            $dataSeats = util::getSeat($val['registrationID']);
                                                            $rowSeat = 0;
                                                            foreach ($dataRepresent as $keyP => $valP) {
                                                                //var_dump($valP);
                                                                $arrRegID[] = $valP['registrationID'];
                                                                $seatNo = '';
                                                                if (count($dataSeats) > 0) {
                                                                    $seatNo = $dataSeats[$rowSeat]['seatNo'];
                                                                    $rowSeat++;
                                                                }
                                                               // var_dump($seatNo);
                                                                $pf = ($valP['prefix']!=6)?$valP['title_th']:$valP['prefix_other'];
                                                                if(($val['IsPaid'] != 1)){
                                                                echo '<a href="#" class="change-name" rel="' . $seatNo . '" title="' . $valP['registrationID'] . '">
															 ' .$pf.' '. $valP['name'] . ' ' . $valP['lastname'] . '</a>,&nbsp;&nbsp;&nbsp;&nbsp;';
                                                                }else{
                                                                    echo $pf.' '. $valP['name'] . ' ' . $valP['lastname'].',&nbsp;&nbsp;&nbsp;&nbsp;';
                                                                }
                                                            }
                                                        endif;
                                                        ?></td>
                                                </tr>
                                            </table>

 <table  border="0" cellspacing="2" cellpadding="2" align="center">
  <tr>
    <td align="right"> <?php if ($val['IsPaid'] !== '1'): ?>

                                                <?php if ($val['IsPaid'] == '2') : ?>

                                                  <div class="butt"><a target="_blank"  href="<?php echo setting::$BASE_URL . '/member/course_receipt/' . str_replace("=", "", util::haEncrypt(trim($val['registrationID'])))?>"  class="more4">พิมพ์เอกสารชำระเงิน</a></div> 
                                                    <?php elseif ($val['IsPaid'] == '4'): ?>
                                                   <div class="butt"><a href="javascript:void(0);" class="more3">รอพิมพ์เอกสารชำระเงิน</a></div>
                                                    <?php endif; ?></td>
    <td align="left"><div class="butt"><a href="<?php echo setting::$BASE_URL . '/member/course_remove/' . str_replace("=", "", util::haEncrypt(trim($val['registrationID'])))?>"
                                                   onclick="return confirm('<?php echo Msg::$delete; ?>');"  class="more3" >ยกเลิกรายการนี้</a></div>
</td>
<tr>
<td colspan="2">
                            <strong>โปรดตรวจสอบที่อยู่ออกใบเสร็จของท่าน จากปุ่มพิมพ์เอกสารชำระเงิน (ปุ่มสีเขียว)  </strong><br> <font class="copy5"> <strong>หมายเหตุ หากที่อยู่ออกใบเสร็จไม่ถูกต้องโปรดติดต่อ สถาบันรับรองคุณภาพสถานพยาบาล
(องค์การมหาชน)   ทันที </strong> </font>
                                                <?php endif; ?>
                                            <?php if ($val['IsPaid'] == 0): ?>
                                                <!--  <a class="payment2" rel="<?php echo $val['courseID'] . ',' . $val['registrationID']?>"> <img src="images/b_pay.png" width="120"
                                                                                  height="17" border="0"/></a>-->
                                                <?php endif; ?></td>
  </tr>
</table>
  </td>
                                    </tr>
                                </table><br><br>
 <font class="smtext">รายละเอียดการออกใบเสร็จ</font><br>
                            <?php
                                foreach($arrRegID as $key=>$valRC):
                                    $dataRC = util::getReceiptByRegisID($valRC);
                                    $dataRC = $dataRC[0];
                            ?>
                            <div>
                              <?=$dataRC['rc_name'].' <br> '.$dataRC['rc_address'].' '.$dataRC['rc_soi'].' '.$dataRC['rc_road'].' '.$dataRC['rc_district'].'<br> '.$dataRC['rc_province'].' '.$dataRC['rc_postcode'].' <br>เลขผู้เสียภาษี '.$dataRC['rc_tax_id']?><br><br>
                            </div>
                            <?php endforeach;?>
                           </div> 
<!--course-->


                        <?php
                    endforeach; else :
                    echo '<p>' . Msg::$no_course . '</p>';

                endif;
                ?>

<br> <br><div id="remarkbox"> 
สถาบันรับรองคุณภาพสถานพยาบาล (องค์การมหาชน) จะส่งใบยืนยันการชำระเงิน พร้อมเลขที่นั่ง ไปยัง Email ที่ท่านลงทะเบียนไว้ ภายในสามวันทำการ หลังจากได้รับการยืนยันการชำระเงินของท่านจากทางธนาคาร
<br><br>
<strong>หมายเหตุ :</strong>
<br><br>รายละเอียดเกี่ยวกับชำระค่าลงทะเบียน, กำหนดการอบรม, สถานที่อบรม ทางสถาบันฯ จะแจ้งจดหมายตอบรับให้ทราบล่วงหน้าก่อนการอบรมประมาณ 3 สัปดาห์
<br><br>กรณีผู้สมัครไม่สามารถเข้าร่วมประชุมหรืออบรมได้ (กรณีชำระเงินแล้ว) กรุณาแจ้งยกเลิก ก่อนวันเข้าอบรมอย่างน้อย 1 สัปดาห์ (โปรดติดต่อเจ้าหน้าที่โดยตรง) มิฉะนั้นทางสถาบันฯ ขอสงวนสิทธิ์ในการคืนค่าลงทะเบียน
<br><br>ผู้สมัครที่มีความประสงค์จะรับประทานอาหารเฉพาะเช่น อาหารอิสลาม หรือมังสวิรัติ กรุณาระบุเพิ่มเติมในใบสมัคร
<br><br>กรณีที่ท่านอยู่ในสถานะ สำรองที่นั่ง หากมีผู้ที่สำรองที่นั่งก่อนท่านยกเลิกการประชุมหรืออบรม ทางสรพ. จะติดต่อท่านทาง email เพื่อให้ท่านรับสิทธิการประชุมหรืออบรมก่อนวันเข้าอบรมอย่างน้อย 1 สัปดาห์
<br><br>กรณีต้องการเปลี่ยนรายชื่อผู้เข้าร่วมการประชุมหรืออบรม สามารถทำได้กรณีที่ท่านชำระเงินแล้วเท่านั้น  
<br><br>
สถาบันขอสงวนสิทธิ์สำหรับการเปลี่ยนผู้เข้าอบรม ก่อนมีการอบรมล่วงหน้า 3 วันทำการ
<br><br> <font class="smtext">ติดปัญหาการในงานหน้า web ติดต่อ 02-832-9400 ต่อ 9505 </font>
 </div>
 </div>
        
<div id="rightcolumnhome"> <?php include("include/latest_course.php");?>
 </div> 
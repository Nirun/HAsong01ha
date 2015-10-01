
<div id="leftcolumnhome"> 
<div id="header">ผลการค้นหาการประชุม และการอบรม</div> 
<div id="warningtop">โปรดตรวจสอบวันหมดเขตการสมัคร บางหลักสูตรได้หมดเขตการสมัคร หรือเต็มแล้ว  </div> 
<br>
<!--course-->
 <table border="0" cellspacing="2" cellpadding="2"  width="100%">
 
                                <tr valign="middle" bgcolor="#417dd6">
                                    <td align="left" class="smtextwhite" height="30"><p>&nbsp;&nbsp; วันเปิดรับสมัคร </p></td>
                                    <td align="left" class="smtextwhite"><p>&nbsp;&nbsp; หัวข้อหลักสูตร </p></td> 
                                </tr>
                                <?php
                                $bg=false;
                                foreach ($data as $key => $val):
                                  if($bg){
                                      $bgcolor='bgcolor="#eeeeee"';
                                      $bg=false;
                                  }
                                    else{
                                        $bgcolor='';
                                        $bg=true;
                                    }

                                    ?>
                                <tr valign="top" <?php echo ($bgcolor);?>>
                                    <td align="left"  style="padding-top:5px; padding-bottom:5px; padding-right:5px; padding-left:5px;"><?php echo(Thaidate::date($val['registstartdate'],"DD MM YYYY") . ' - ' . Thaidate::date($val['registenddate'],"DD MM YYYY"))?></td>
                                    <td align="left"   style="padding-top:5px; padding-bottom:5px; padding-right:5px; padding-left:5px;"> &nbsp;&nbsp;<a href="<?php echo setting::$BASE_URL.'/member/course_detail/'.$val['courseID']?>"><?php echo($val['coursecode'] . ': ' . $val['coursename'])?></a> <br>
                                        &nbsp;&nbsp;รุ่นที่ <?php echo($val['generation'])?>
                                        <?php
                                        if($val['coursetypeID']==3){
                                            echo Msg::$group_course_msg;
                                        }
                                        ?>
                                    </td> 
                                </tr>
                                <?php endforeach; ?>


                            </table>
<!--course-->

 </div>
        
<div id="rightcolumnhome"><?php include("include/latest_course.php");?>
 </div> 
        
      
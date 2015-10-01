 
 <div id="searchimage"> </div> 
  <!--search course-->
                        <form action="<?php echo setting::$BASE_URL.'/member/course_result/' ?>" method="get" enctype="application/x-www-form-urlencoded">
<div id="searchdropdown"><table border="0" cellspacing="2" cellpadding="2" width="200">
                                <tr valign="top">
                                    <td><select name="month" tabIndex="8"
                                                style="  width: 160px;"  >
                                        <option value="0" selected="selected">เลือกเดือน</option>
                                        <?php
                                        foreach(util::listMonth() as $keyM=>$valM):
                                            ?>
                                            <option value="<?php echo $keyM ;?>"><?php echo $valM;?></option>
                                            <?php endforeach; ?>

                                    </select></td>
                                    <td>
                                        <input type="image" src="images/b_search.png" width="22" height="23">
                                    </td>
                                </tr>
                            </table> </div> 
                        </form>
                        <!--search course--> 
                        
    <div id="headerwhite">รายละเอียดการประชุม และการอบรมล่าสุด </div> 
โปรดตรวจสอบวันหมดเขตการสมัคร
 <?php
$last_row = count($course);
$rowCourse = 0;
foreach ($course as $key => $val):
    $rowCourse++;
    ?><br>
<!--course-->
<div id="coursename1" <?php if ($val['coursetypeID']==2):?>style="background-color: #cccccc"<?php endif; ?>>
<h1><?php echo($val['coursecode'] . ': ' . $val['coursename'])?> 
 </h1>
 <strong>ลงทะเบียนได้ตั้งแต่วันที่</strong><br>

 <?php echo (Thaidate::date($val['registstartdate'],'DD MM YYYY') . ' - ' . Thaidate::date($val['registenddate'],'DD MM YYYY'))?> 
  <?php
  if($val['coursetypeID']==3) {
      echo Msg::$group_course_msg;
  }
  ?>
<br>
<div class="butt"><a href="<?php echo setting::$BASE_URL.'/member/course_detail/'.$val['courseID']?>"  class="more2">ดูรายละเอียด และลงทะเบียน</a></div>
</div>
<!--course-->
 
 
<?php if ($last_row != $rowCourse): ?>
<div class="hr dotted"></div>
<?php
endif;
endforeach;?>

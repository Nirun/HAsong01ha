<!--search-->
<table width="242" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#a1c55b">
    <tr valign="top">
        <td align="left"><img src="images/toptrain.gif" width="242" height="76" border="0"/></td>
    </tr>
    <tr valign="top">
        <td align="left"><!--search-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="25"><img src="images/blank.gif" width="25" height="1" border="0"/></td>
                    <td>   <!--search course-->
                        <form action="<?php echo setting::$BASE_URL.'/member/course_result/' ?>" method="get" enctype="application/x-www-form-urlencoded">
                            <table border="0" cellspacing="2" cellpadding="2">
                                <tr valign="top">
                                    <td><select name="month" tabIndex="8"
                                                style="  width: 160px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:2px; margin-bottom:2px;"
                                                class="formfield">
                                        <option value="0" selected="selected">Select Month</option>
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
                            </table>
                        </form>
                        <!--search course--></td>
                </tr>
            </table>
            <!--search-->

        </td>
    </tr>
    <tr valign="top">
        <td align="left"><img src="images/activity_tab2.gif" width="242" height="10" border="0"/></td>
    </tr>
</table><!--search-->
<div id="space"></div>
<table width="242" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top">
        <td align="left" bgcolor="#78684e"><img src="images/tab_course.gif" width="242" height="47" border="0"/></td>
    </tr>
</table>


<?php
$last_row = count($course);
$rowCourse = 0;
foreach ($course as $key => $val):
//    var_dump($val);
    $rowCourse++;
    ?><br>
<table width="240" border="0" cellspacing="0" cellpadding="0" <?php if ($val['coursetypeID']==2){ echo "bgcolor=red";}?>>

    <tr valign="top">
        <td align="left">
          <a href="<?php echo setting::$BASE_URL.'/member/course_detail/'.$val['courseID']?>" class="sidemenu"><?php echo($val['coursecode'] . ': ' . $val['coursename'])?></a>
          <strong>  ลงทะเบียนได้ตั้งแต่วันที่</strong><br>
          <font class="sm2"><b><?php echo (Thaidate::date($val['registstartdate'],'DD MM YYYY') . ' - ' . Thaidate::date($val['registenddate'],'DD MM YYYY'))?></b>  </font>
<a href="<?php echo setting::$BASE_URL.'/member/course_detail/'.$val['courseID']?>"><img src="images/b_viewcourse.gif"  width="188" border="0"/></a></td>
    </tr>
</table>
<?php if ($last_row != $rowCourse): ?>
<div class="hr dotted"></div>
<?php
endif;
endforeach;?>

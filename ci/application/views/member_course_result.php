<div id="container">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
        <td align="left"><a href="javascript:history.back()"><img src="images/back.gif" width="78" height="25" border="0" /></a></td>
            <td align="right"><img src="images/mem_tab.gif" width="169" height="43"
                                                             border="0"/></td>
        </tr>
    </table>
    <!--table-->
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr valign="top">

            <td align="left">
                <!--article-->
                <table width="100%" border="0" cellspacing="2" cellpadding="2">
                    <tr valign="top">
                        <td><?php include("include/latest_course.php");?><br/>
                            <img src="images/blank.gif" alt="" width="250" height="1" border="0"></td>

                        <td width="10" class="verticle"><img src="images/blank.gif" width="10" height="100" border="0"/>
                        </td>
                        <td>
                            <font class="title">ผลการค้นหา หลักสูตรการอบรม</font><!--course detail-->
                            <table border="0" cellspacing="2" cellpadding="2">

                                <tr valign="top" bgcolor="#FFFFFF">
                                    <td align="left"><img src="images/blank.gif" alt="" width="150" height="1"
                                                          border="0"></td>
                                    <td align="left"><img src="images/blank.gif" alt="" width="400" height="1"
                                                          border="0"></td>
                                    <td align="left"><img src="images/blank.gif" alt="" width="150" height="1"
                                                          border="0"></td>
                                </tr>
                                <tr valign="middle" bgcolor="#e9e9e9">
                                    <td align="left" class="tab" height="30"><p>&nbsp;&nbsp;<strong>วันเปิดรับสมัคร</strong></p></td>
                                    <td align="left" class="tab"><p>&nbsp;&nbsp;<strong>หัวข้อหลักสูตร</strong></p></td>
                                    <td align="center" class="tab"><p>&nbsp;&nbsp;<strong>ดูรายละเอียด</strong></p></td>
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
                                    <td align="left" class="info"><?php echo(Thaidate::date($val['registstartdate'],"DD MM YYYY") . ' - ' . Thaidate::date($val['registenddate'],"DD MM YYYY"))?></td>
                                    <td align="left" class="info">&nbsp;&nbsp;<?php echo($val['coursecode'] . ': ' . $val['coursename'])?>&nbsp;&nbsp;|&nbsp;&nbsp;
                                        รุ่นที่ <?php echo($val['generation'])?>
                                    </td>
                                    <td align="center" class="info"><a href="<?php echo setting::$BASE_URL.'/member/course_detail/'.$val['courseID']?>"><img
                                            src="images/view.gif" width="92" height="21" border="0"/></a></td>
                                </tr>
                                <?php endforeach; ?>


                            </table>
                            <br/>
                            <img src="images/blank.gif" width="500" height="1" border="0"/>
                        </td>
                        <td width="1"><img src="images/blank.gif" width="1" height="500" border="0"/></td>
                    </tr>
                </table>
                <!--course detail--></td>
        </tr>
    </table>


    <!--table-->
</div>
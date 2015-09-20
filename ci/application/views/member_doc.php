<div id="container">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
            <td align="right"><a href="member_main.php"><img src="images/mem_tab.gif" width="169" height="43"
                                                             border="0"/></a></td>
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
                        <td align="left">
                            <font class="title">

                                หลักสูตรและเอกสารประกอบการอบรมที่ท่านเคยสมัครไว้แล้ว</font>
                            <br/><strong>หมายเหตุ: </strong>จะแสดงผลเฉพาะหลักสูตรการอบรม ที่ท่านผ่านการอบรมแล้วเท่านั้น


                            <!--article-->
                            <table border="0" cellspacing="2" cellpadding="2">

                                <tr valign="top" bgcolor="#0062a9">
                                    <td align="left"><img src="images/blank.gif" alt="" width="150" height="1"
                                                          border="0"></td>
                                    <td align="left"><img src="images/blank.gif" alt="" width="400" height="1"
                                                          border="0"></td>
                                    <td align="left"><img src="images/blank.gif" alt="" width="150" height="1"
                                                          border="0"></td>
                                </tr>
                                <tr valign="top">
                                    <td align="left" class="tab">ระยะเวลาการอบรม</td>
                                    <td align="left" class="tab">หัวข้อหลักสูตร</td>
                                    <td align="center" class="tab">ดูรายละเอียด</td>
                                </tr>
                                <?php
                                foreach ($list_course as $key => $val):
                                    $date = Thaidate::date($val['startdate'], 'DD MM') . ' - ' . Thaidate::date($val['enddate'], 'DD MM YYYY');
                                    $courseName = $val['coursecode'] . ': ' . $val['coursename'];
                                    $gen = $val['generation'];

                                    ?>
                                    <tr valign="top">
                                        <td align="left" class="info"><?php echo $date?></td>
                                        <td align="left" class="info"><?php echo $courseName?><br/>
                                            รุ่นที่ <?php $gen?>
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
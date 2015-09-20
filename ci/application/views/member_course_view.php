<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
        <td align="left"><a href="javascript:history.back()"><img src="images/back.gif" width="78" height="25" border="0" /></a></td>
        <td align="right"><img src="images/mem_tab.gif" width="169" height="43"
                                                         border="0"/></td>
    </tr>
</table><!--table-->
<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr valign="top">

        <td align="left">
            <font class="title">
                รายละเอียดหลักสูตรที่ท่านสมัคร หรือ เคยสมัครไว้แล้ว</font>
            <br/>
            <!--row2-->
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr valign="top">
                    <td><!--row 1-->
                        
                        <!--article-->
                        <table border="0" cellspacing="2" cellpadding="2" align="center">
                            <tr valign="top">
                                <td align="left" class="info" colspan="2" 
                                    <strong><?php echo $data['coursecode'] . ":" . $data['coursename']; ?></strong><br><br>
                                  
                                    <div class="title">คุณสมบัติของผู้เข้าอบรม</div>
                                    <br/>
                                    <?php echo $data['qualification']; ?>
                                    <br/><br/>

                                    <div class="title">วัตถุประสงค์  </div>
                                    <br/>
                                    <?php echo $data['objective']; ?>
                                    <br/>
                                    <br/>

                                    <div class="title">เนื้อหา</div>
                                    <br/>
                                    <?php echo $data['content']; ?>
                                </td>
                            </tr>

                        </table>
                        <!--article--><!--row 1--></td>
                    <td width="10" class="verticle"><img src="images/blank.gif" width="10" height="100" border="0"/>
                    </td>
                    <td><img src="images/blank.gif" width="300" height="1" border="0"/><!--row 2-->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="title">รายละเอียดการอบรม</td>
                            </tr>
                        </table>
                        <!--article-->
                        <table border="0" cellspacing="2" cellpadding="2" align="center">
                            <tr>
                                <td align="left" class="info" colspan="2">

                                    <table border="0" cellspacing="3" cellpadding="3">
                                        <tr valign="middle">
                                            <td class="info">
                                                <strong>วันที่อบรม: </strong>
                                            </td>
                                            <td colspan="2"><?php echo Thaidate::date($data['startdate'],"DD MM YYYY"); ?>&nbsp;   <strong>ถึง:</strong>&nbsp;<?php echo Thaidate::date($data['enddate'],"DD MM YYYY"); ?></td>
                                            <td>
                                             </td>
                                        </tr>
                                        <tr valign="middle">
                                            <td class="info"><strong>ระยะเวลาการอบรม</strong></td>
                                            <td colspan="3"><?php echo $data['days']; ?>  วัน</td>

                                        </tr>
                                        <tr valign="middle">
                                            <td class="info"><strong>จำนวนเปิดลงทะเบียน</strong></td>
                                            <td colspan="3">  <?php echo $data['limittrainees']; ?>  คน</td>

                                        </tr>
                                        <tr valign="top">
                                            <td class="info"><strong>ค่าลงทะเบียน</strong></td>
                                            <td colspan="3"><?php echo $data['price']; ?>  บาท </td>

                                        </tr>
                                        <tr>
                                        <td colspan="4"> <strong>ราคานี้รวม</strong>
                                                <table border="0" cellspacing="2" cellpadding="2">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td><ul class="optional">
                                                                <?php foreach ($optional as $key => $val) {
                                                                echo '<li>' . $val['optional'] . '</li>';
                                                            }
                                                                ?>

                                                            </ul>

                                                        </td>
                                                    </tr>

                                                </table></td>
                                        </tr>
                                    </table>
                                    </form> </td>
                            </tr>
                            <tr valign="top">
                                <td align="left" class="info" colspan="2"><br/>

                                    <strong>วิทยากร:</strong><br/>
                                    <?php echo $data['speaker']; ?>
                                    <br/>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td align="left" class="info" colspan="2"><br/>
                                    <strong>สถานที่อบรม:</strong><br/>
                                    <?php echo $data['place']; ?>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td align="left" class="info" colspan="2"><br/>
                                    <?php if ($data['maplink'] != ''){?>
                                        <strong>แผนที่สถานที่อบรม:</strong><br/><br/>
                                        <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                                src="<?php echo $data['maplink']; ?>">
                                        </iframe><br />
                                        <small>
                                            <a href="<?php echo $data['maplink']; ?>" style="color:#0000FF;text-align:left">ดูแผนที่ขนาดใหญ่ขึ้น</a>
                                        </small>
                                    <?php } ?>
                                    <br><br/>
                                    <?php
                                    if ($data['map'] != ''){
                                    ?>
                                   <div class="title">              แผนที่ </div><br/><br/>
                               <a href="<?php echo Setting::$PATH_MAP . $data['map']; ?>" target="_blank">
                                            <img src="<?php echo Setting::$PATH_MAP . $data['map']; ?>" width="449" height="311"  border="0">
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td align="left" class="info">
                                    <!--doc-->
                                    <?php if (count($docs) != 0){ ?>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td  class="title"><strong>เอกสารประกอบการอบรม</strong></td>
                                        </tr>
                                    </table>
                                    <table border="0" cellspacing="3" cellpadding="3">
                                        <tr valign="top">
                                            <td>
                                                <?php
                                                $row = 0;
                                                foreach ($docs as $key => $val) {
                                                    $row++;
                                                    $doc = Setting::$PATH_PDF .$val['file'];
                                                    echo $row . '. ' . $val['title'] . ' ';
                                                    echo '<a href="'.$doc.'" target="_blank">click here</a>';
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
                                </td>
                            </tr>
                        </table>
                        <!--article--><!--row 2-->
                        <div class="hr dotted"></div>
                        <p align="center"><br/>
                            <input type="button" value="    Back    " class="button" onClick="location='<?php echo setting::$BASE_URL.'/member/main/'?>'"></p></td>
                </tr>
            </table>

            <!--row2-->
        </td>
        <td width="1"><img src="images/blank.gif" width="1" height="500" border="0"/></td>
    </tr>
</table><!--table-->

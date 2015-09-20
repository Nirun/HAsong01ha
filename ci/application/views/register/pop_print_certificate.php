<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <LINK REL="stylesheet" HREF="<?php echo setting::$BASE_URL ?>/register/style.css" TYPE="text/css">
    <title><?php echo setting::$WINDOW_TITLE ?></title>
    <script type="text/javascript">
        $(document).ready(function () {

            // add multiple select / deselect functionality

            $("#selectall").click(function () {
                $('.case').attr('checked', this.checked);
            });

            // if all checkbox are selected, check the selectall checkbox
            // and viceversa
            $(".case").click(function () {
                if ($(".case").length == $(".case:checked").length) {
                    $("#selectall").attr("checked", "checked");
                } else {
                    $("#selectall").removeAttr("checked");
                }
            });

            $(".btn").click(function () {

                var cID = $("#courseID").val();

                var checkall = "off";
                $checkedCheckboxes = $("input:checkbox[name=checkall]:checked");
                $checkedCheckboxes.each(function () {
                    checkall = $(this).val();
                });


                var selectedID = [];
                $("input:checkbox[name='selectedID[]']:checked").each(function () {
                    selectedID.push($(this).val());
                });

                var dataString = selectedID.join(" ");
                //alert(dataString);


                if (dataString != " "){
                    var url = "<?php echo setting::$BASE_URL ?>/register/course/preview/certificate/" + cID + "/" + dataString + "/" + checkall;
                    window.open(url, "HA", "height=550,width=980,scrollbars=yes,resizable=yes");
                }else{
                    alert("ไม่ได้เลือกรายชื่อที่ต้องการพิมพ์");
                }
            });


        })
    </script>
</head>
<body><br/>

<table border="0" cellspacing="2" cellpadding="2">
    <tr valign="middle">
        <td colspan="4"><font class="title">พิมพ์ใบประกาศนียบัตรผู้เข้าอบรม
        </font>

        </td>
    </tr>
    <tr valign="middle">
        <td colspan="4" class="info"><br/>
            List of people Apply to this Course <br/>
            <strong></strong>
        </td>
    </tr>
    <?php
    //Course Date
    $sDate = $data['startdate'];
    $eDate = $data['enddate'];

    if ($sDate == "0000-00-00 00:00:00" or $sDate == "0000-00-00" or $sDate == ""
        or $eDate == "0000-00-00 00:00:00" or $eDate == "0000-00-00" or $eDate == ""
    ) {
        $CourseDate = "ไม่ได้ระบุวันที่อบรม";
    } else {
        $scDate = Thaidate::date($sDate, "DD MM YYYY");
        $ecDate = Thaidate::date($eDate, "DD MM YYYY");
        $CourseDate = $scDate . ' - ' . $ecDate;
    }

    //optionals
    $optlist = "";
    foreach ($optionallist as $_optional):
        $optlist .= $_optional['optional'] . " ";
    endforeach;

    //count paid trainees
    $cntPaid = count($reglist);
    //echo $cntPaid;

    ?>
    <tr valign="middle">
        <td colspan="4" class="info">
            <div class="tab"><p valign="middle"><?php echo $data['coursecode'] . ":" . $data['coursename']; ?></p></div>

            <font class="bottomtext"> รายละเอียดการอบรม</font><br/>

            <strong>ระยะเวลาการอบรม</strong>
            <?php echo $CourseDate; ?>
            <br/>

            <strong>วิทยากร</strong>
            <?php echo $data['speaker']; ?>
            <br/>
            <strong>สถานที่ </strong>
            <?php echo $data['place']; ?>
            <br/>
            <strong>ค่าลงทะเบียน</strong>
            ท่านละ <?php echo $data['price']; ?> บาท ( <?php echo $optlist; ?>)
            <br/>
<!--            <strong>จำนวนผู้ลงทะเบียน</strong>-->
<!--            --><?php //echo $countRegister; ?><!-- คน <br />-->
            <strong>จำนวนผู้ลงทะเบียนแล้ว</strong>
            <?php echo $countPaid; ?>  คน<br />
            <br /><br>
            <a target="_blank" href="<?php echo setting::$BASE_URL.'/register/course/applylist/certificatelist/'.$courseID;?>">
                <img src="<?php echo Setting::$BASE_URL;?>/register/images/excel.jpg" border="0">
            </a>
            <br /><br>
            <label for="sel_template">เลือกรูปแบบใบประกาศ</label>
            <select name="sel_template" id="sel_template">
                <?php foreach($template_cert as $keyCert=>$valCert):?>
                    <option value="<?=$valCert['id']?>"><?=$valCert['template_name']?></option>
                <?php endforeach;?>
            </select>
        </td>
    </tr>
    <tr valign="middle">
        <td colspan="3"><br></td>
    </tr>
    <?php if ($cntPaid == 0) { ?>
    <tr valign="middle">
        <td align="center" class="tab" colspan="3">ไม่พบรายชื่อผู้ลงทะเบียนที่ชำระเงินแล้ว</td>
    </tr>
    <?php } else { ?>
    <tr valign="middle">
        <td align="left" width="10"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt=""
                                         width="10" height="5" border="0"></td>
        <td align="left"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="400"
                              height="1" border="0"></td>
        <td align="left"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="400"
                              height="1" border="0"></td>
        <td align="left"><img src="<?php echo setting::$BASE_URL; ?>/register/images/blank.gif" alt="" width="50"
                              height="1" border="0"></td>
    </tr>
    <form id="form_cer" name="form_cer" action="register/course/previewcertificate" method="post">
    <tr valign="middle">
        <td colspan="4" align="right" class="info">
        
            
<p align="left">  <strong>***********  กรณีต้องการพิมพ์ใบประกาศนียบัตรผู้เข้าอบรม <br /> โปรด set up  การพิมพ์ โดยเลือก<font color="#FF0000"><strong>ขนาดกระดาษ A4 - Layout Portrait - และไม่ให้พิมพ์ background  <br />ไม่ให้พิมพ์ Header และ Footer <br />พร้อมทั้งปรัปขนาด margin (เลือก none)  ก่อนการพิมพ์   </strong></font>*********** <br /></strong><br />
  หากต้องการขยับ หรือ แก้ไขขนาดตัวหนังสือ โปรดเลือก พิมพ์ใบประกาศนียบัตรผู้เข้าอบรมจากเมนูด้านบน จากนั้นเลือก จัดการใบประกาศนียบัตรผู้เข้าอบรม แนะนำให้เปิดสองหน้าต่างพร้อมกันและ refresh  หน้า preview  เมื่อทำการ save ในหน้า edit   </p>
  
  
            <!--<input type="checkbox" name="checkall" id="selectall"/> เลือกทั้งหมด--><br /><br />
        </td>
    </tr>
    <tr valign="middle" bgcolor="#a0cdf9">
        <td align="center" height="30"><p class="fronttext">ลำดับ</p></td>
        <td align="center" height="30"><p class="fronttext">ชื่อ - นามสกุล</p></td>
        <td align="center" height="30"><p class="fronttext">สถานพยาบาลต้นสังกัด </p></td>
        <td align="center" height="30"><p class="fronttext">เลือก</p></td>
    </tr>
    <?php
    $i = 1;
    foreach ($reglist as $_reglist):

        //trainee ID
        $traineeID = $_reglist['traineeID'];
        $registerD = $_reglist['registrationID'];

        //prefix
        if ($_reglist['prefix'] == 6) {
            $prefix = $_reglist['prefix_other'];
        } else {
            $prefix = $_reglist['title_th'];
        }

        //trainee name
        $trainee = $prefix . " " . $_reglist['name'] . " " . $_reglist['lastname'];

        //hospital name
        if ($_reglist['hospitalother'] != "") {
            $hospital = $_reglist['hospitalother'];
        } else {
            //$hospital = $_reglist['hospitalID'];
            $hospital =   $_reglist['hospitalname'] ;
        }

        //change name
        if (!empty($_reglist['cpother'])){
            $cpprefix = $_reglist['cpother'];
        }else{
            $cpprefix = $_reglist['cprefix'];
        }

        if (!empty($_reglist['cpname']) && !empty($_reglist['cplastname'])){
            $changename = $cpprefix ." ". $_reglist['cpname']." ".$_reglist['cplastname'];
        }else{
            $changename = '';
        }

        if($i % 2 == 0){
            $bgcolor  ='#eeeeee';
        }else{
            $bgcolor  ='';
        }
        ?>
        <tr valign="middle" bgcolor="<?php echo $bgcolor; ?>">
            <td align="left" class="info"><?php echo $i; ?></td>
            <td align="left" class="info">
                <?php if($changename == ''){?>
                    <?php echo $trainee; ?>
                <?php }else{?>
                    <?php echo $changename; ?>
                <?php } ?>
            </td>
            <td align="left" class="info"><?php echo $hospital; ?></td>
            <td align="center" class="info"><input name="selectedID[]" class="case" type="checkbox" value="<?php echo $registerD; ?>"/></td>
        </tr>
        <?php
        $i++;
    endforeach;
    ?>
    <tr valign="middle">
        <td colspan="5" align="right" class="info">
            <input type="hidden" id="courseID" name="courseID" value="<?php echo($course['courseID']);?>">
            <input type="button" value="แสดงตัวอย่าง" class="btn">
        </td>
    </tr>
    <?php } ?>
    </form>
</table>
</body>
</html>

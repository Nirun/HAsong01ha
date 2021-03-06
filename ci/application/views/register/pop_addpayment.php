<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <LINK REL="stylesheet" HREF="<?php echo setting::$BASE_URL ?>/register/css/style.css" TYPE="text/css">
    <title><?php echo setting::$WINDOW_TITLE ?></title>

    <script type="text/javascript">

        $(document).ready(function () {
            $(".btn").click(function () {

                var regID = $("#regID").val();
                var courseID = $("#courseID").val();
                var receiptdate = $("#receiptdate").val();
                var traineeID = $("#traineeID").val();
                var payID = $("#paymentID").val();
                var regType = $("#regType").val();
                var digit = $("#digit").val();
                var rID = $("#rID").val();

                var dataString = "rID="+regID+"&tID="+traineeID+"&pID="+payID+"&rType="+regType+"&cID="+courseID+"&date="+receiptdate+"&digit="+digit+"&regID="+rID;

                //alert(dataString);

                 if (receiptdate != "") {

                     $("#div2").hide();
                     $("#div3").show();
                     $("#receiptdate").prop('disabled',true)

                     $.ajax({
                         type:"POST",
                         cache:false,
                         url:"register/payment/addreceipt",
                         data:dataString,
                         complete: function(){
                             alert('บันทึกข้อมูลสำเร็จ');
                         },
                         success:function (data) {
                             //alert(data);
                             /*if (data == 1) {
                                 self.parent.location.reload();
                             }else{
                                 alert('บันทึกข้อมูล');
                             }
                            */

                             self.parent.location.reload();
                         }
                     });

                } else {
                    alert('ยังไม่ได้ระบุวันที่');
                }
            });

            $(".btnCancel").click(function () {
                self.parent.location.reload();
            });

        })
    </script>
</head>

<body><br/>

<?php
//echo $regID;
//var_dump($recinfo);
//exit;

$currentDate = date("Y-m-d");

if (!empty($data)) {

    $receiptname = str_replace("อื่นๆ  ","",trim($data[0]['name']));
    $receiptaddr = $data[0]['address'];
    $ref1 = $data[0]['billing_ref1'];
    $ref2 = $data[0]['billing_ref2'];
    $pID = $data[0]['paymentid'];

    $receipt = "";
    foreach ($data as $val):
      $receipt .= str_replace("อื่นๆ  ","",trim($data[0]['name']))."<br>".$data[0]['address']."<br><br>";
    endforeach;

} else {
    $receiptname = "";
    $receiptaddr = "";
    $ref1 = "";
    $ref2 = "";
    $pID = 0;
}
?>
<?php echo $this->load->view('register/inc_calendar'); ?>
<table border="0" cellspacing="1" cellpadding="1">
    <tr valign="middle" align="left">
        <td><font class="title">สถานะการชำระเงิน/ใส่ข้อมูลการชำระเงิน</font></td>
    </tr>
    <tr valign="middle" align="left">
    </tr>
    <tr valign="middle" align="left">
        <td><font class="bottomtext">วันที่รับชำระ : </font> <br>
            <input onClick="ds_sh(this);" name="receiptdate" id="receiptdate" readonly="readonly" value="<?php echo $currentDate;?>"
                   style="width: 120px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;cursor: text;">
        </td>
    </tr>
    <tr valign="middle">
        <td class="info">
            <font class="bottomtext">ออกใบเสร็จในนาม:</font><br/>
            <?php //echo $receiptname;?>
            <?php //echo $receiptaddr;?>
            <?php
               $j = 1;
               foreach($recinfo as $recval):
                     echo $recval['name']."<br>".$recval['address']."<br><br>";
            ?>
            <?php
               $j++;
               endforeach;
            ?>
            <br/>
            <div class="tab">รายละเอียดการชำระเงิน</div>
            <table border="0" cellspacing="2" cellpadding="2">
                <tr valign="top">
                    <td><font class="bottomtext">Billing Ref1:&nbsp;</font><?php echo $ref1;?> </td>
                </tr>
                <tr valign="top">
                    <td><font class="bottomtext">Billing Ref2:&nbsp;</font><?php echo $ref2;?> </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr valign="middle">
        <td class="info"><br/>
           <div class="tab">รายชื่อผู้เข้าอบรม:</div><br/>
            <table border="0" cellspacing="2" cellpadding="2">
                <?php
                   $i = 1;
                   $reglist = "";
                   foreach ($replist as $val):
                       $reglist .= $val['registrationid'].",";
                       //prefix
                       if ($val['prefix'] == 6) {
                           $prefix = $val['prefix_other'];
                       } else {
                           $prefix = $val['title_th'];
                       }
                ?>
                <tr valign="top">
                    <td><?php echo $i.'.'; ?>&nbsp;</td>
                    <td><?php echo $prefix.' '.$val['name'].' '.$val['lastname']; ?>&nbsp; </td>
                </tr>
                <?php
                       $i++;
                   endforeach;
                ?>
                <?php //print_r($regArr);?>
            </table>
        </td>
    </tr>
    <tr valign="middle">
        <td class="info" align="center"><br/>
            <div id="div2">
                <input type="hidden" name="paymentID" id="paymentID" value="<?php echo $pID; ?>">
                <input type="hidden" name="regType" id="regType" value="<?php echo $regType; ?>">
                <input type="hidden" name="digit" id="digit" value="<?php echo $digit; ?>">
                <input type="hidden" name="regID" id="regID" value="<?php echo $reglist; ?>">
                <input type="hidden" name="courseID" id="courseID" value="<?php echo $courseid; ?>">
                <input type="hidden" name="traineeID" id="traineeID" value="<?php echo $traineeid; ?>">
                <input type="hidden" name="rID" id="rID" value="<?php echo $regID; ?>">
                <a class="btn">
                    <img src="images/save.gif" width="44" height="26" border="0"/>
                </a>&nbsp;&nbsp;&nbsp;
                <a class="btnCancel">
                <img src="images/b_cancelthis.gif" width="54" height="26" border="0"/>
                </a>
                <br/>
                <br/>
                หลังจากกด ปุ่ม Save 
                โปรแกรมจะส่งอีเมลไปที่ผู้สมัครเพื่อบอกสถานะการชำระเงิน
                <br>
            </div>
            <div id="div3" style="display:none;">
                <h2><font color="red">กำลังบันทึกข้อมูล กรุณารอสักครู่</font></h2>
            </div>
        </td>
    </tr>
</table>
</body>
</html>

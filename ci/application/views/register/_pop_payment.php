<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <LINK REL="stylesheet" HREF="<?php echo setting::$BASE_URL ?>/register/css/style.css" TYPE="text/css">
    <title><?php echo setting::$WINDOW_TITLE ?></title>
</head>

<body><br/>
<?php
if (!empty($data)) {
    $receiptname = trim($data[0]['name']);
    $receiptaddr = $data[0]['address'];
    $ref1 = $data[0]['billing_ref1'];
    $ref2 = $data[0]['billing_ref2'];
    $pID = $data[0]['paymentid'];
    $receipt_date= Thaidate::date($data[0]['receipt_date'], "DD MM YYYY");
} else {
    $receiptname = "";
    $receiptaddr = "";
    $ref1 = "";
    $ref2 = "";
    $pID = 0;
    $receipt_date= "";}
?>
<table border="0" cellspacing="1" cellpadding="1">
    <tr valign="middle" align="left">
        <td class="info"><font class="title">สถานะการชำระเงิน</font></td>
    </tr>
    <tr valign="middle" align="left">
         <td class="info"><font class="bottomtext">วันที่รับชำระ :&nbsp;</font><?php echo $receipt_date;?> </td>
    </tr>
    <tr valign="middle" align="left">
        <td class="info">
            <font class="bottomtext">ออกใบเสร็จในนาม:</font><br/>
            <?php echo $receiptname;?><br/>
            <?php echo $receiptaddr;?>
            <br/><br/>
           <div class="tab"> รายละเอียดการชำระเงิน</div>
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
                    ?>
                    <tr valign="top">
                        <td><?php echo $i.'.'; ?>&nbsp;</td>
                        <td><?php echo $val['title_th'].' '.$val['name'].' '.$val['lastname']; ?>&nbsp;เลขที่นั่ง :&nbsp;<?php echo $val['seatno']; ?> </td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
                <?php //print_r($regArr);?>
            </table>
        </td>
    </tr>
</table>
</body>
</html>

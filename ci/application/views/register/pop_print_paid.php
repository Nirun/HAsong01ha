<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$coursename."_paid.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Report</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<body>
<table width="95%" border="1" cellspacing="1" cellpadding="1"align="center" x:str>
    <tr valign="top">
    <td colspan="14">
        <h1>Report :รายละเอียดออกใบเสร็จ</h1>
        <?php if (!empty($coursename)){?>
        <h3><?php echo $coursename; ?></h3>
        <?php } ?>
        พิมพ์วันที่&nbsp;&nbsp;
        <?php
        echo Thaidate::date(date("Y-m-d H:i:s"),'DD MM YYYY');
        ?>

    </td>
    </tr>
    <tr valign="top">
        <td align="center" width="20"><strong>ลำดับ</strong></td>
        <td align="center" width="20"><strong>คำนำหน้า</strong></td>
        <td align="center"><strong>ชื่อ</strong></td>
        <td align="center"><strong>สกุล</strong></td>
        <td align="center" width="150"><strong>รพ.</strong></td>
        <td align="center" width="150"><strong>ประเภทการสมัคร</strong></td>
        <td align="center"><strong>ออกใบเสร็จในนาม</strong></td>
        <td align="center" width="170"><strong>ที่อยู่</strong></td>
        <td width="170" align="center"><strong>ซอย</strong></td>
        <td width="170" align="center"><strong>ถนน</strong></td>
        <td width="170" align="center"><strong>เขต</strong></td>
        <td width="170" align="center"><strong>จังหวัด</strong></td>
        <td width="170" align="center"><strong>รหัสไปรษณีย์</strong></td>
        <td align="center"><strong>Ref no.1</strong></td>
        <td align="center"><strong>Ref no.2</strong></td>
        <td align="center"><strong>วันโอนเงิน</strong></td>
        <td align="center"><strong>จำนวนเงิน</strong></td>
        <td align="center"><strong>เลขที่นั่ง</strong></td>
    </tr>
    <?php
    $row = 0;
    if ($data != false):
        foreach ($data as $val2):
            $row++;
            ?>

            <tr valign="top">
                <td align="center"><?php echo $row; ?></td>
                <td align="left"><?php echo $val2['title']; ?></td>
                <td align="left"><?php echo $val2['name']; ?></td>
                <td align="left"><?php echo $val2['lastname']; ?></td>
                <td align="left"><?php echo $val2['hospital']; ?></td>
                <td align="left"><?php echo $val2['registerype']; ?></td>
                <td align="left"><?php echo $val2['receiptname']; ?></td>
                <td align="left"><?php echo $val2['receiptaddress']; ?></td>
                <td align="left"><?php echo util::prefixAddr($val2['soi'],'soi'); ?></td>
                <td align="left"><?php echo util::prefixAddr($val2['road'],'rd'); ?></td>
                <td align="left"><?php echo util::prefixAddr($val2['district'],'district'); ?></td>
                <td align="left"><?php echo util::prefixAddr($val2['province'],'province'); ?></td>
                <td align="left"><?php echo $val2['postcode']; ?></td>
                <td align="left"><?php echo "'".$val2['Ref1']; ?></td>
                <td align="left"><?php echo "'".$val2['Ref2']; ?></td>
                <td align="left"><?php echo Thaidate::date($val2['receiptdate'], 'DD MM YYYY'); ?></td>
                <td align="right"><?php echo $val2['price']; ?></td>
                <td align="center">
                    <?php echo "'".$val2['seatNo']; ?>
                </td>
            </tr>

            <?php endforeach;
    endif; ?>
</table>
<br>
<br>
<br>
&nbsp;
</body>
</html>

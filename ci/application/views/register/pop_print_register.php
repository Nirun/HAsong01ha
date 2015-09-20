<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$coursename."_register.xls");
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
<table width="95%" border="1" cellspacing="1" cellpadding="1"align="center">
    <tr valign="top">
    <td colspan="8">
        <h1>Report : ออกใบเสร็จ</h1>
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
        <td align="left" width="60"><strong>ลำดับที่</strong></td>
        <td align="left" width="60"><strong>เลขที่นั่ง</strong></td>
        <td width="60" align="left"><strong>คำนำหน้า</strong></td>
        <td width="200" align="left"><strong>ชื่อ</strong></td>
        <td width="200" align="left"><strong>สกุล</strong></td>
        <td width="200" align="left"><strong>ชื่อรพ.</strong></td>
        <td width="200" align="left"><strong>วิชาชีพ</strong></td>
        <td width="70" align="left"><strong>Ref2</strong></td>
    </tr>
    <?php
    $row = 0;
    if ($data != false):
        foreach ($data as $val2):
            $row++;
            ?>
            <tr valign="top">
                <td align="left"><strong><?php echo $row; ?></strong></td>
                <td align="left"><?php echo "'".$val2['seatNo']; ?></td>
                <td align="left"><?php echo $val2['title']; ?></td>
                <td align="left"><?php echo $val2['name']; ?></td>
                <td align="left"><?php echo $val2['lastname']; ?></td>
                <td align="left"><?php echo $val2['hospital']; ?></td>
                <td align="left"><?php echo $val2['occupation']; ?></td>
                <td align="left"><?php echo $val2['Ref2']; ?></td>
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

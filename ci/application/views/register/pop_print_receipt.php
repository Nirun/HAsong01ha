<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$coursename."_receipt.xls");
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
<table width="95%" border="1" cellspacing="1" cellpadding="1" align="center" x:str>
    <tr valign="top">
    <td colspan="9">
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
    <?php
    if ($typeID == 1){
        $typename = "สำหรับออกใบเสร็จในนามรายบุคคล";
    }elseif ($typeID == 3){
        $typename = "สำหรับออกใบเสร็จในนามโรงพยาบาล";
    }else{
        $typename = "สำหรับออกใบเสร็จ";
    }
    ?>
    <tr valign="middle">
        <td align="left" colspan="10"><br><h4><?php echo $typename;?></h4></td>
    </tr>
    <tr valign="middle">
        <td width="60" align="left"><strong>ลำดับที่</strong></td>
        <td width="60" align="left"><strong>ลำดับที่นั่ง</strong></td>
        <td width="60" align="left"><strong>คำนำหน้า</strong></td>
        <td width="150" align="left"><strong>ชื่อ</strong></td>
        <td width="150" align="left"><strong>สกุล</strong></td>
        <td width="180" align="left"><strong>ชื่อรพ.</strong></td>
        <td width="250" align="left"><strong>ที่อยู่</strong></td>
        <td width="250" align="left"><strong>ซอย</strong></td>
        <td width="250" align="left"><strong>ถนน</strong></td>
        <td width="250" align="left"><strong>เขต</strong></td>
        <td width="250" align="left"><strong>จังหวัด</strong></td>
        <td width="250" align="left"><strong>รหัสไปรษณีย์</strong></td>
        <td width="50" align="center"><strong>Ref1</strong></td>
        <td width="60" align="center"><strong>Ref2</strong></td>
        <td width="60" align="right"><strong>จำนวนเงิน</strong></td>
    </tr>
    <?php
    $row = 0;
    if ($data != false):
        foreach ($data as $val2):
            $row++;
            ?>
            <tr valign="middle">
                <td align="left"> <?php echo $row; ?></td>
                <td align="left"> <?php echo "'".$val2['seatNo']; ?></td>
                <td align="left"><?php echo $val2['title']; ?></td>
                <td align="left"><?php echo $val2['name']; ?></td>
                <td align="left"><?php echo $val2['lastname']; ?></td>
                <td align="left"><?php echo $val2['hospital']; ?></td>
                <td align="left"><?php echo $val2['receiptaddress']; ?></td>
                <td align="left"><?php echo util::prefixAddr($val2['soi'],'soi'); ?></td>
                <td align="left"><?php echo util::prefixAddr($val2['road'],'rd'); ?></td>
                <td align="left"><?php echo util::prefixAddr($val2['district'],'district'); ?></td>
                <td align="left"><?php echo util::prefixAddr($val2['province'],'province'); ?></td>
                <td align="left"><?php echo $val2['postcode']; ?></td>
                <td align="right" ><?php echo "'".$val2['Ref1']; ?></td>
                <td align="right"><?php echo "'".$val2['Ref2']; ?></td>
                <td align="right"><?php echo $val2['price']; ?></td>
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

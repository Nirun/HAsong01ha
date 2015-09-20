<?php

$coursename = $data['coursecode'];
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$coursename."_namelist.xls");
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
    <td colspan="9">
        <h1><?php echo $data['coursecode'].":". $data['coursename']; ?></h1>
    </td>
    </tr>
    <tr valign="top">
        <td align="center" height="30" width="50" ><p class="fronttext">ลำดับ</p> </td>
        <td align="center" height="30" width="50"><p class="fronttext">เลขที่นั่ง</p></td>
        <td align="center" height="30" width="50"><p class="fronttext">คำนำหน้า</p></td>
        <td align="center" height="30" width="100"><p class="fronttext">ชื่อ - นามสกุล </p> </td>
        <td align="center" height="30" width="80"><p class="fronttext">วิชาชีพ</p> </td>
        <td align="center" height="30" width="80"><p class="fronttext">ชื่อรพ.</p> </td>
        <td align="center" height="30" width="280"><p class="fronttext">ที่อยู่</p> </td>
        <td align="center" height="30" width="90"><p class="fronttext">เบอร์โทร</p> </td>
        <td align="center" height="30" width="200"><p class="fronttext">Email</p> </td>
        <td align="center" height="30" width="50"><p class="fronttext">อาหาร</p> </td>
        <td align="center" height="30" width="50"><p class="fronttext">ลงชื่อ</p> </td>
    </tr>
    <?php
    $i = 1;
    foreach ($reglist as $_reglist):

        //prefix
        if ($_reglist['prefix'] == 6){
            $prefix = $_reglist['prefix_other'];
        }else{
            $prefix = $_reglist['title_th'];
        }

        //trainee name
        $trainee =  $_reglist['name']." ".$_reglist['lastname'];

        //hospital name
        if ($_reglist['hospitalother'] != ""){
            $hospital = $_reglist['hospitalother'];
        }else{
            //$hospital = $_reglist['hospitalID'];
            $hospital = $_reglist['hospitalname'];
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

        //phone no.
        if ($_reglist['tel'] != ""){
            $phone = $_reglist['tel'];
        }else{

            $phone = $_reglist['mobile'];
        }

        //occupation
        if ($_reglist['positionID'] == 7){
            $occupation = $_reglist['positionother'];
        }else{
            $occupation = $_reglist['occupation'];
        }

        ?>
        <tr valign="middle" class="info">
            <td align="center" height="50"><?php echo $i; ?></td>
            <td align="left" height="50">&nbsp;<?php echo $_reglist['seatno']; ?> </td>
            <td align="left" height="50">&nbsp;<?php echo $prefix; ?> </td>
            <td align="left" height="50">
                <?php if($changename == ''){?>
                <?php echo $trainee; ?>
                <?php }else{?>
                <?php echo $changename; ?>
                <?php } ?>
            </td>
            <td align="left" height="50" >&nbsp;<?php echo $occupation; ?> </td>
            <td align="left" height="50"><?php echo $hospital; ?></td>
            <td align="left" height="50" >&nbsp;<?php echo $_reglist['address']; ?> </td>
            <td align="left" height="50">&nbsp;<?php echo $phone; ?> </td>
            <td align="left" height="50">&nbsp;<?php echo $_reglist['email']; ?> </td>
            <td align="left" height="50"><?php echo $_reglist['food']; ?></td>
            <td align="left" height="50">&nbsp;</td>
        </tr>
        <?php
        $i++;
    endforeach;
    ?>
</table>
<br>
<br>
<br>
&nbsp;
</body>
</html>

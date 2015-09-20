<?php
$coursename = $data['coursecode'];
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$coursename."_cerlist.xls");
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
    <td colspan="3">
        <h1><?php echo $data['coursecode'].":". $data['coursename']; ?></h1>
    </td>
    </tr>
    <tr valign="top">
        <td align="center" height="30"><p class="fronttext">ลำดับ</p></td>
        <td align="center" height="30"><p class="fronttext">ชื่อ - นามสกุล</p></td>
        <td align="center" height="30"><p class="fronttext">สถานพยาบาลต้นสังกัด </p></td>
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
        ?>
        <tr valign="middle">
            <td align="left" class="info"><?php echo $i; ?></td>
            <td align="left" class="info">
                <?php if($changename == ''){?>
                <?php echo $trainee; ?>
                <?php }else{?>
                <?php echo $changename; ?>
                <?php } ?>
            </td>
            <td align="left" class="info"><?php echo $hospital; ?></td>
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

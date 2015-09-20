<html>
<head>
    <title>Report</title>
    <base href="<?php print setting::$BASE_URL; ?>/">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="js_validate/jquery.js" type="text/javascript"></script>
    <style type="text/css">
        body
        {  	margin-left: 0px;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
            background-color: #e5e6d8;
            SCROLLBAR-FACE-COLOR: #DFDFDF;
            SCROLLBAR-HIGHLIGHT-COLOR: #333333;
            SCROLLBAR-SHADOW-COLOR: #666666;
            SCROLLBAR-3DLIGHT-COLOR: #666666;
            SCROLLBAR-ARROW-COLOR: #333333;
            SCROLLBAR-TRACK-COLOR: #EDECEC;
            SCROLLBAR-DARKSHADOW-COLOR: #eeeeee;}


        Font,td,tr,textarea {
            font-family: Tahoma, Helvetica, sans-serif, Verdana, Arial,  sans-serif;
            color: #494949;
            font-size:12px;
            line-height: 14px;
        }
        a:link 							{ color: #2b3b92; font-weight: none;	 text-decoration: none}
        a:visited						{ color: #2b3b92; font-weight: none;	 text-decoration: none}
        a:active 						{ color: #2b3b92; font-weight: none;	text-decoration: none}
        a:hover 						{ color: #78684e;  text-decoration: none}

        h3{
            font-family: Tahoma, Helvetica, sans-serif, Verdana, Arial,  sans-serif;
            color: #fa4100;
            font-size:18px;
            line-height: 14px;
        }
        h1{
            font-family: Tahoma, Helvetica, sans-serif, Verdana, Arial,  sans-serif;
            color: #000000;
            font-size:16px;
            line-height: 14px;
        }
    </style>
    <script>
        function checkvalue() {
            mystring= document.getElementById('courseid').value;
            if(mystring == 0){
                alert ('กรุณาเลือกหลักสูตร');
                return false;
            }else{
                return true;
            }
        }
        $(function () {
            $('#gen_year').on('change', function () {
                var val = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "report/filter/course/year",
                    data: {year: val},
                    dataType: "json",
                    success: function (data) {
                        $('#courseid').empty().append('<option value="0">เลือกหัวข้อหลักสูตร</option>');
                        $.each(data, function(i, item) {
                            var newOption = $('<option value="'+item.val+'">'+item.text+'</option>');
                            $('#courseid').append(newOption);
                        });

                    }
                });
            })
        });
    </script>
</head>
<body bgcolor="#FFFFFF">
<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center">
    <tr valign="top">
        <td align="left"><br><img src="http://www.haregister.com/register/images/logo.png" width="131" height="95"
                                  border="0" align="left"><img src="http://www.haregister.com/register/images/name.png"
                                                               width="438" height="70" border="0"></td>
        <td align="right"><br>
            <h1>Report : ออกใบเสร็จ</h1>
            <?php if (!empty($coursename)){?>
                <h3><?php echo $coursename; ?></h3>
                <?php } ?>
            พิมพ์วันที่&nbsp;&nbsp;
            <?php
            echo Thaidate::date(date("Y-m-d H:i:s"),'DD MM YYYY');
            ?>
            <?php
            if (!empty($courseID)){
                $cID = $courseID;
                $typeID = $typeID;
                if ($typeID == 1){
                    $typename = "สำหรับออกใบเสร็จในนามรายบุคคล";
                }elseif ($typeID == 3){
                    $typename = "สำหรับออกใบเสร็จในนามโรงพยาบาล";
                }else{
                    $typename = "สำหรับออกใบเสร็จ";
                }
            } else{
                $cID = 0;
                $typeID = 0;
                $typename ="";
            }
            ?>
        </td>
    </tr>
</table>

<table width="95%" border="0" cellspacing="1" cellpadding="1" align="center">
    <tr valign="top" >
        <td align="right">
            <form name="frm" method="post" action="<?php echo setting::$BASE_URL ?>/register/reports/receipt"
                  enctype="application/x-www-form-urlencoded" onsubmit="return checkvalue(this)">
                <hr align="center" width="95%">
                เลื่อกปี
                <?php
                $cYear = date('Y')+543;
                $sYear = $cYear -10;
                $eYear = $cYear+2;
                //echo $cYear;
                ?>
                <select name="gen_year" id="gen_year" style="width: 70px;  border-top:1px solid #BEC4DC; border-left:1px solid
#BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px;
margin-top:2px; margin-bottom:2px;">
                    <option value="0">.:: ปี ::.</option>
                    <?php foreach (range ($eYear,$sYear) as $val) { ?>
                        <option value="<?=$val?>"><?=$val?></option>
                    <?php } ?>
                </select>
                &nbsp;&nbsp;&nbsp;
                Select course from dropdown menu
                <select id="courseid" name="courseid">
                    <option value="0">เลือกหัวข้อหลักสูตร</option>
                    <?php
                    foreach ($course_list as $val):
                        echo "<option value='" . $val["courseID"] . "'>" . $val['coursecode'] . " " . $val['coursename'] ." รุ่นที่ " . $val['generation']. " </option>";
                    endforeach;
                    ?>
                </select>
                &nbsp;&nbsp;&nbsp;
                <select id="typeid" name="typeid">
                    <option value="0">เลือกประเภท</option>
                    <option value="1">ออกใบเสร็จในนามรายบุคคล</option>
                    <option value="3">ออกใบเสร็จในนามโรงพยาบาล </option>
                </select>
                <input type="submit" value="go">
                <hr align="center" width="95%">
                <a target="_blank" href="<?php echo setting::$BASE_URL.'/register/reports/preview/receipt/'.$cID.'/'.$typeID;?>">
                    <img src="<?php echo Setting::$BASE_URL;?>/register/images/excel.jpg" border="0"></a>
            </form>
        </td>
    </tr>
</table>
<br>
<table width="95%" border="0" cellspacing="1" cellpadding="1"align="center">
    <tr valign="middle">
        <td align="left" colspan="10"><br><h4><?php echo $typename;?></h4></td>
    </tr>
</table>
<table width="95%" border="0" cellspacing="1" cellpadding="1" bgcolor="#b0b0b0" align="center">
    <tr valign="middle" bgcolor="#f3f4e8">
        <td width="60" align="center"><strong>ลำดับที่</strong></td>
        <td width="60" align="center"><strong>ลำดับที่นั่ง</strong></td>
        <td width="60" align="left"><strong>คำนำหน้า</strong></td>
        <td width="100" align="left"><strong>ชื่อ</strong></td>
        <td width="100" align="left"><strong>สกุล</strong></td>
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
    <tr valign="middle" bgcolor="#FFFFFF">
        <td align="center"><?php echo $row; ?></td>
        <td align="center"><?php echo $val2['seatNo']; ?></td>
        <td align="left"><?php echo $val2['title']; ?></td>
        <td align="left"><?php echo $val2['name']; ?></td>
        <td align="left"><?php echo $val2['lastname']; ?></td>
        <td align="left"><?php echo $val2['hospital']; ?></td>
        <td align="left"><?php echo $val2['receiptaddress']; ?></td>
        <td align="left"><?php echo $val2['soi']; ?></td>
        <td align="left"><?php echo $val2['road']; ?></td>
        <td align="left"><?php echo $val2['district']; ?></td>
        <td align="left"><?php echo $val2['province']; ?></td>
        <td align="left"><?php echo $val2['postcode']; ?></td>
        <td align="right"><?php echo $val2['Ref1']; ?></td>
        <td align="right"><?php echo $val2['Ref2']; ?></td>
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

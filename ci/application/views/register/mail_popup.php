<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <base href="<?php echo base_url(); ?>">

    <LINK REL="stylesheet" HREF="register/style.css" TYPE="text/css">
    <LINK REL="stylesheet" HREF="css/validationEngine.jquery.css" TYPE="text/css">
    <LINK REL="stylesheet" HREF="css/template.css" TYPE="text/css">
    <script src="js_validate/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="js_validate/languages/jquery.validationEngine-en.js" language="javascript"></script>
    <script type="text/javascript" src="js_validate/jquery.validationEngine.js" language="javascript"></script>
    <script type="text/javascript" src="js_validate/valid_mail.js" language="javascript"></script>

    <title>Untitled Document</title>
</head>

<body><br />
<!--article1-->
<form action="<?php echo setting::$BASE_URL ?>/register/mail/save_form/" method="post" id="frm_template" enctype="application/x-www-form-urlencoded">

<table  border="0" cellspacing="2" cellpadding="2" width="640" align="center">
    <tr>
        <td align="left" colspan="2"><font class="title">ระบบส่งอีเมล์ / เพิ่มรูปแบบ Email</font></td>
    </tr>

    <tr valign="top">
        <td align="right" class="info">ชื่อ email</td>
        <td align="left">
            <input name="name" id="name" type="text" class="validate[required]" style="  width:600px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></td>
    </tr>

    <tr valign="top">
        <td align="right" class="info">ใส่html code<br />
            <font class="copy4">Full path สำหรับ image เช่น http://www/domainname.com/image.jpg<br />
                บริเวณที่จะให้แสดงข้อความใส่ <br />
                < !--message-- ></font>
        </td>
        <td align="left"><textarea name="detail" id="detail" class="validate[required]" rows="30"  style="  width: 600px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"></textarea></td>
    </tr>

    <tr>
        <td  align="center" colspan="2"><br />
            <input type="submit" value="Save" class="button"></td>
    </tr>
</table>
</form>
<!--article-->
</body>
</html>

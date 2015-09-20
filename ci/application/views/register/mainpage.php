<table style="width: 400px; margin: 0 auto;" border="0" cellspacing="5" cellpadding="5">
    <tr>
        <td colspan="2" style="vertical-align: top; text-align: center; color: red;">
            <?php echo $error_msg; ?>
        </td>
    </tr>
</table>
<?php
if ($isLogin):
    ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr valign="top">
        <td width="1"><img src="<?php echo base_url(); ?>/register/images/blank.gif" width="1" height="400"
                           border="0"/></td>
        <td valign="middle" align="right"><img src="<?php echo base_url();?>/register/images/welcome.gif"
                                               width="616" height="102" border="0"/><br /><br />
<a href="http://www.haregister.com/register/mail/remind" target="_blank">click to remind user</a>: automatic mail to remind user for payment</td>
    </tr>
</table>
<?php else:
    ?><p align="center"><img src="<?php echo base_url(); ?>/register/images/bestview.gif"  height="131"
                           border="0"/></p>
<form action="<?php echo setting::$BASE_URL;?>/register/admin/login" method="post" enctype="application/x-www-form-urlencoded">
    <table style="width: 400px; margin: 0 auto;" border="0" cellspacing="5" cellpadding="5">
        <tr valign="top">
            <td align="right">user :</td>
            <td><input type="text" name="user" id="user"></td>
        </tr>
        <tr valign="top">
            <td align="right">password :</td>
            <td><input type="password" name="password" id="password"></td>
        </tr>
        <tr valign="top">
            <td colspan="2" style="text-align: center;"><input type="submit" id="submit" name="submit" value="Login">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="height:300px;vertical-align: top; text-align: center; color: red;">

            </td>
        </tr>
    </table>
</form>

<?php
endif;
?>

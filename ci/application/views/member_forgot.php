<div id="container"> <font class="bottomtext">Forgot Password</font>
    <form id="frm_forgot" action="<?php echo setting::$BASE_URL?>/member/forgot/send/" method="post" enctype="application/x-www-form-urlencoded">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr valign="middle">
                <td align="right"  width="1"><img src="images/blank.gif" width="1" height="300" border="0" /></td>
                <td align="right"><img src="images/mem_forgot.gif" width="711" height="141" border="0" /><br />
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right">
                                Email Address ที่ใช้ในการลงทะเบียน<br />
                                ทางโปรแกรมจะจัดส่งข้อมูลในการ login ของท่านไปยัง Email ที่ท่านได้ลงทะเบียนไว้ <br />    <br />
                                <input id="email" name="email" type="text" style="  width: 250px;  border-top:1px solid #BEC4DC; border-left:1px solid #BEC4DC; border-right:1px solid #7984B6; border-bottom:1px solid #9197B5; background:#ffffff;   padding-top:1px; padding-bottom:1px; margin-top:3px; margin-bottom:3px;"><br /><br />
                                <input type="image" src="images/b_send.gif">

                            </td>
                            <td width="153">&nbsp;</td>
                        </tr>
                    </table>
                    <br />

                </td>
            </tr>
        </table>
    </form>

</div>
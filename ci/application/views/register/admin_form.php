<div id="container"><font class="title">กำหนดผู้ควมคุม / Add User</font>

    <div id="space"></div>
    <!--article-->
    <form id="form_signup" action="<?php echo setting::$BASE_URL;?>/register/admin/save" method="post" enctype="application/x-www-form-urlencoded">
        <table border="0" cellspacing="2" cellpadding="2" align="center">
            <tr valign="top">
                <td bgcolor="#f5f5f5" class="info">First Name</td>
                <td align="left"><input type="text" id="name" name="name" class="validate[required]" size="20"></td>
                <td bgcolor="#f5f5f5" class="info">Last Name</td>
                <td align="left"><input type="text" size="20" id="lname" name="lname" class="validate[required]"></td>
            </tr>
            <tr valign="top">
                <td bgcolor="#f5f5f5" class="info">Position</td>
                <td align="left" colspan="3"><input type="text" size="60" id="position" name="position" class="validate[required]"></td>
            </tr>
            <tr valign="top">
                <td bgcolor="#f5f5f5" class="info">User</td>
                <td align="left" colspan="3"><input type="text" id="user" name="user"
                                                    class="validate[required,custom[onlyLetterNumber],minSize[6],ajax[ajaxAdmin]]"
                                                    size="60"></td>
            </tr>
            <tr valign="top">
                <td bgcolor="#f5f5f5" class="info">Password</td>
                <td align="left"><input type="password" id="password" name="password" size="20" class="validate[required,custom[onlyLetterNumber],minSize[6]]"></td>
                <td bgcolor="#f5f5f5" class="info">Confirm password</td>
                <td align="left"><input type="password" size="20" id="cpassword" name="cpassword"
                                        class="validate[required,custom[onlyLetterNumber],equals[password]]"></td>
            </tr>
            <tr valign="top">
                <td colspan="4" class="tab"><strong>Permission Access
                </strong></td>
            </tr>
            <tr valign="top">
                <td colspan="4"><!--history-->
                    <table border="0" cellspacing="3" cellpadding="3" width="100%">
                        <?php
                        foreach ($permission as $key => $val) :
                            ?>
                            <tr>
                                <td width="15"><input name="permission[]" type="checkbox" class="validate[minCheckbox[1]]"
                                                      value="<?php echo $val['permissionID']?>"></td>
                                <td bgcolor="#e9f4ff" class="info"><?php echo $val['permission']?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </table>
                    <!--history--></td>
            </tr>
        </table>
        <p align="center">
            <input type="button" value="Back" class="button" onClick="history.back()">&nbsp;&nbsp;&nbsp;<input
                type="submit" value="Save" class="button"></p>
        <!--article-->
    </form>
    <div id="space"></div>

</div>
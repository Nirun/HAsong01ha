<div id="container">
    <font class="title">กำหนดผู้ควมคุม</font>
    <input type="button" value="เพิ่มผู้ควมคุม" class="button" onclick="location='<?php echo setting::$BASE_URL;?>/register/admin/form'">
    <div id="space"></div>
    รายชื่อผู้ดูแลระบบและขอบเขตของการดูแล<br/>

    <!--article-->
    <table width="100%" border="0" cellspacing="2" cellpadding="2">

        <tr valign="top" >
            <td align="left"><img src="images/blank.gif" alt="" width="120" height="1" border="0"></td>
            <td align="left"><img src="images/blank.gif" alt="" width="180" height="1" border="0"></td>
            <td align="left"><img src="images/blank.gif" alt="" width="200" height="1" border="0"></td>
            <td align="left"><img src="images/blank.gif" alt="" width="60" height="1" border="0"></td>
            <td align="left"><img src="images/blank.gif" alt="" width="30" height="1" border="0"></td>
        </tr>
        <tr valign="middle" bgcolor="#a0cdf9">
            <td align="left" height="30"><p class="fronttext"> First / Last Name</p></td>
            <td align="left"><p class="fronttext">Position</p></td>
            <td align="left" ><p class="fronttext">Permission Access</p></td>
            <td align="center" ><p class="fronttext">Status</p></td>
            <td align="center"><p class="fronttext">Delete</p></td>
        </tr>
        <?php
        foreach ($user as $key => $val):
            ?>

            <tr valign="top">
                <td align="left" class="info"><?php echo($val['name'])?></td>
                <td align="left" class="info"><?php echo($val['position'])?></td>
                <td align="left" class="info"><?php echo($val['permission'])?></td>
                <td align="center" class="info"><input type="button" value="View" class="button"
                                                       onclick='location="<?php echo setting::$BASE_URL;?>/register/admin/edit/<?php echo $val['id'] ?>"'>
                </td>
                <td align="center" class="info"><input type="button"
                                                       onClick="if(confirm('<?php echo Msg::$delete ?>')){location='<?php echo setting::$BASE_URL;?>/register/admin/admin_delete/<?php echo $val['id'] ?>';}"
                                                       value="Delete"/></td>
            </tr>
            <?php
        endforeach;
        ?>

    </table>
    <!--article-->
    <div id="space"></div>

</div>
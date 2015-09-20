<!--table-->
<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
        <td align="right"><a href="member_main.php"><img src="images/mem_tab.gif" width="169" height="43"
                                                         border="0"/></a></td>
    </tr>
</table>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
    <?php
    $inbox_id = 0;
    if (count($data) == 1):
        $title = $data[0]['title'];
        $detail = $data[0]['detail'];
        $date = $data[0]['dateCreate'];
        $inbox_id = $data[0]['inbox_id'];
        ?>
        <tr valign="top">

            <td align="left">
                <font class="title">
                    กล่องจดหมาย </font><br/>

                <div class="tab">
                    Subject  <?php echo $title?>
                </div>
                <font class="copy4">
                    <?php echo $date?>
                </font>
                <br/><br/>
                <?php echo $detail?>
                <br/><br/>
                <!--row2-->
                <!--row2--><br/>
                <img src="images/blank.gif" width="500" height="1" border="0"/>
            </td>
            <td width="1"><img src="images/blank.gif" width="1" height="500" border="0"/></td>
        </tr>
        <?php else:
        ?>
        <tr>
            <td colspan="2">
                <?php echo Msg::$no_email?>
            </td>
        </tr>
        <?php
    endif;
    ?>
    <tr>
        <td colspan="2">
            <p align="center"><input type="button" value="Back" class="button" onClick="location='<?php echo setting::$BASE_URL.'/member/mail/'?>'">&nbsp;&nbsp;&nbsp;
                <input type="button" onClick="if(confirm('<?php echo Msg::$delete?>')){location='<?php echo setting::$BASE_URL.'/member/mail/delete/'.$inbox_id?>'}" value="Delete"/></p>
        </td>
    </tr>
</table><!--table-->

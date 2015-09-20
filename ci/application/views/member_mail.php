<!--table--><table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr>
        <td align="left"><a href="javascript:history.back()"><img src="images/back.gif" width="78" height="25" border="0" /></a></td>
        <td align="right"><img src="images/mem_tab.gif" width="169" height="43" border="0" /></td>
    </tr>
</table><table width="100%" border="0" cellspacing="2" cellpadding="2">
    <tr valign="top">

        <td width="161"><img src="/images/mailimg.gif" width="161" height="183" border="0" /></td>
        <td align="left">
            <table border="0" cellspacing="2" cellpadding="2"align="center">
                <tr valign="middle" bgcolor="#98c72a">
                    <td class="fronttext" height="30">&nbsp;&nbsp;&nbsp;วันที่รับ</td>
                    <td class="fronttext">&nbsp;&nbsp;&nbsp;หัวเรื่อง</td>
                    <td class="fronttext" align="center">&nbsp;&nbsp;&nbsp;สถานะ&nbsp;&nbsp;&nbsp;</td>
                    <td class="fronttext" align="center">&nbsp;</td>
                </tr>
                <tr valign="top">
                    <td align="left" ><img src="images/blank.gif" alt="" width="150" height="1" border="0"></td>
                    <td align="left" ><img src="images/blank.gif" alt="" width="500" height="1" border="0"></td>
                    <td align="left" ><img src="images/blank.gif" alt="" width="60" height="1" border="0"></td>
                    <td align="left" ><img src="images/blank.gif" alt="" width="60" height="1" border="0"></td>
                </tr>
                <?php
                    $odd = true;
                    foreach($data as $key=>$val):
                        $img = ($val['is_read']==0)?'mail_close.gif':'mail_open.gif';
                        if($odd){
                            $bg='';
                            $odd=false;
                        }
                        else{
                            $bg='bgcolor="#fcfcfc"';
                            $odd=true;
                        }
                ?>
                <tr valign="top" <?php echo $bg?>>
                    <td class="info"><?php echo $val['dateCreate']?></td>
                    <td class="info"><?php echo $val['title']?></td>
                    <td class="info" align="center"> <a href="<?php echo setting::$BASE_URL.'/member/mail/view/'.$val['inbox_id']?>">
                        <img src="<?php echo setting::$BASE_URL.'/images/'.$img?>" width="36" height="32" border="0" /></a></td>
                    <td class="info" align="center"><input type="button" onClick="if(confirm('<?php echo Msg::$delete?>')){location='<?php echo setting::$BASE_URL.'/member/mail/delete/'.$val['inbox_id']?>'}" value="Delete" /></td>
                </tr>
                    <?php
                        endforeach;
                        ?>

            </table>





            <!--row2-->
            <!--row2--><br />
            <img src="images/blank.gif" width="500" height="1" border="0" />
        </td>
    </tr>
</table><!--table-->

<div id="topmenu">
    <div id="space"></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">
            <td width="10"><img src="register/images/blank.gif" width="10" height="105" border="0"/></td>
            <td><!--top1-->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr valign="top">
                        <td align="left" width="135">
                            <a href="index.php"><img src="register/images/logo.png" width="131" height="95" border="0"/></a>
                        </td>
                        <td align="left">
                            <a href="index.php"><img src="register/images/name.png" width="438" height="70" border="0"/></a>
                        </td>
                        <td align="right"><a href="index.php"> <img src="register/images/slogan.png" width="216"
                                                                    height="34" border="0"/></a><br/>
                            <img src="register/images/mem.png" width="152" height="14" border="0"/>

                            <div id="space"></div>
                            <?php
                            if ($this->session->userdata('isLogin')):
                                ?>
                                <a href="<?php echo setting::$BASE_URL?>/register/admin/logout"><img src="register/images/logoff.png" width="60" height="17"
                                                         border="0"/></a>
                                <?php
                            endif;
                            ?>

                        </td>
                        <td width="10"><img src="register/images/blank.gif" width="10" height="1" border="0"/></td>
                    </tr>
                </table>
                <!--top1--></td>
        </tr>

        <tr>
            <td colspan="3" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                   border="0"></td>
        </tr>
        <td colspan="3" bgcolor="#e8e8e8"><!--top2-->
            <?php
             //var_dump($isLogin);
                if($this->session->userdata('isLogin')):

            ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr valign="middle">
                    <td width="1"><img src="register/images/blank.gif" alt="" width="1" height="30" border="0"></td>
                    <td align="center"><?php echo anchor('register/admin', 'กำหนดผู้ควบคุม', 'class="submenu"'); ?> </td>
                    <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                         border="0"></td>
                    <td align="center"><?php echo anchor('register/user/all_members', 'รายชื่อสมาชิกทั้งหมด', 'class="submenu"'); ?> </td>
                    <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                         border="0"></td>
                    <td align="center"><?php echo anchor('register/course', 'หัวข้อหลักสูตร', 'class="submenu"'); ?> </td>
                    <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                         border="0"></td>
                    <td align="center"><?php echo anchor('register/user', 'รายชื่อผู้เข้าร่วมอบรม', 'class="submenu"'); ?> </td>
                    <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                         border="0"></td>
                    <td align="center"><?php echo anchor('register/payment', 'สถานะการชำระเงิน', 'class="submenu"'); ?> </td>
                    <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                         border="0"></td>
                    <td align="center"><?php echo anchor('register/nametag', 'ป้ายชื่อผู้เข้าอบรม', 'class="submenu"'); ?> </td>
                    <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                         border="0"></td>
                    <td align="center"><?php echo anchor('register/certificate', 'พิมพ์ใบประกาศนียบัตร', 'class="submenu"'); ?> </td>
                    <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                         border="0"></td>
                    <td align="center"><?php echo anchor('register/mail', 'ระบบส่งอีเมล์', 'class="submenu"'); ?> </td>
                    <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                         border="0"></td>
                    <td align="center"><?php echo anchor('register/reports', 'ระบบรายงาน', 'class="submenu"'); ?> </td>
                </tr>
            </table>
            <?php endif; ?>
            <!--top2--></td>
        </tr>
        <tr>
            <td colspan="3" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="2"
                                                   border="0"></td>
        </tr>
    <!--    <tr>
            <td colspan="3" bgcolor="#2b3b92" align="right"> 
                <table border="0" cellspacing="0" cellpadding="0" bgcolor="#cadef4">
                    <tr valign="middle">
                        <td align="center" width="130" bgcolor="#2b3b92"><img src="register/images/forum.gif" width="65"
                                                                              height="17"/></td>
                        <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                             border="0"></td>
                        <td align="center" width="130"><?php echo anchor('register/admin', 'กำหนดผู้ควบคุม', 'class="submenu"'); ?></td>
                        <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                             border="0"></td>
                        <td align="center" width="130"><?php echo anchor('register/course', 'หัวข้อหลักสูตร', 'class="submenu"'); ?> </td>
                        <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                             border="0"></td>
                        <td align="center" width="130"><?php echo anchor('register/user', 'รายชื่อผู้เข้าร่วมอบรม', 'class="submenu"'); ?></td>
                        <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                             border="0"></td>
                        <td align="center" width="130"><?php echo anchor('register/payment', 'สถานะการชำระเงิน', 'class="submenu"'); ?></td>
                        <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                             border="0"></td>
                        <td align="center" width="130"><?php echo anchor('register/nametag', 'ป้ายชื่อผู้เข้าอบรม', 'class="submenu"'); ?> </td>
                        <td width="1" bgcolor="#FFFFFF"><img src="register/images/blank.gif" alt="" width="1" height="1"
                                                             border="0"></td>
                        <td align="center" width="130"><?php echo anchor('register/certificate', 'พิมพ์ใบประกาศนียบัตร', 'class="submenu"'); ?></td>
                    </tr>
                </table>-->
                <!--top1--></td>
        </tr>
    </table>
    <div id="endmenu"></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr valign="middle">
            <td align="left"><img src="register/images/blank.gif" width="20" height="15" border="0"/></td>
            <td align="right"><span id="clock"></span></td>
            <td align="left" width="20"><img src="register/images/blank.gif" width="20" height="15" border="0"/></td>
        </tr>
    </table>
    <div id="startbottom2"></div>
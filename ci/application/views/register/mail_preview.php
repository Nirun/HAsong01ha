<html>
<head>
    <style>
        #preview{
            text-align: left;
            min-height: 400px;
            width: auto;
        }
        #form{
            bottom: 10px;
            position: absolute;
            text-align: center;
            width: 100%;
        }
        #form input[type="submit"]{
            padding: 5px 10px;
        }
    </style>
</head>

<body>
<div id="preview">
    <?php
    $tp = str_ireplace('< !--message-- >',$desc,$form);
    echo $tp;
    ?>
</div>
<div id="form">
    <form id="frm_send" name="frm_send" action="<?php echo setting::$BASE_URL ?>/register/mail/send" method="post" enctype="application/x-www-form-urlencoded">
        <input type="hidden" name="group" value="<?php echo $group ?>">
        <input type="hidden" name="to" value="<?php echo $to ?>">
        <input type="hidden" name="cc" value="<?php echo $cc ?>">
        <input type="hidden" name="bcc" value="<?php echo $bcc ?>">
        <input type="hidden" name="tp_id" value="<?php echo $tp_id ?>">
        <input type="hidden" name="type" value="<?php echo $type ?>">
        <input type="hidden" name="subject" value="<?php echo $subject ?>">
        <input type="hidden" name="desc" value="<?php echo $desc ?>">
        <input type="submit" name="btn_submit" value="send">
    </form>
</div>
</body>
</html>
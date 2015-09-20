<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php print $title; ?></title>
    <base href="<?php print setting::$BASE_URL; ?>/">
    <LINK REL="stylesheet" HREF="style2.css" TYPE="text/css">
    <?php print $_styles ; ?>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <?php print $_scripts; ?>
</head>

<body >
<?php

    include("include/top_member.php");
?>
<div id="maincontainer">
    <div id="container">
        <?php
            print $content;
        ?>
    </div>
    <div id="endtop"></div>
    <?php include("include/footer_register.php");?>

</body>
</html>
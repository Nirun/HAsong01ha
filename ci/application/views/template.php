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

    include("include/top_register.php");
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
 <?php exit(); ?>
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<!--<head>-->
<!--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<!--    <title>--><?php //print $title; ?><!--</title>-->
<!--    <base href="--><?php //print setting::$BASE_URL; ?><!--/">-->
<!--<!--    <LINK REL="stylesheet" HREF="style.css" TYPE="text/css">-->-->
<!--    <LINK REL="stylesheet" HREF="style2.css" TYPE="text/css">-->
<!--    <script src="spryassets/sprymenubar.js" type="text/javascript"></script>-->
<!--    <link href="spryassets/sprymenubarhorizontal.css" rel="stylesheet" type="text/css" />-->
<!--    <script src="scripts/jquery-latest.js" type="text/javascript"></script>-->
<!--    <script src="scripts/thickbox.js" type="text/javascript"></script>-->
<!--    <script type="text/javascript" src="js/tabcontent.js"></script>-->
<!---->
<!--    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<!--    --><?php //print $_scripts; ?>
<!--    --><?php //print $_styles ; ?>
<!---->
<!--</head>-->
<!---->
<!--<body>-->
<?php //include("include/top.php");?>
<!--<div id="maincontainer">-->
<!--    <div id="container">-->
<!--        --><?php
//            print $content;
//        ?>
<!--    </div>-->
<!--</div>-->
<?php //include("include/bottomtab.php");?>
<?php //include("include/footer.php");?>
<!---->
<!---->
<!--</body>-->
<!--</html>-->
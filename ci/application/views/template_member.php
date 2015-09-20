<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php print $title; ?></title>
    <base href="<?php print setting::$BASE_URL; ?>/">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    
    	<link rel="stylesheet" media="" href="<?=setting::$BASE_URL?>/screen.css" />
           
    <LINK REL="stylesheet" HREF="style2.css" TYPE="text/css">
    <?php print $_styles ; ?>
    	<script type="text/javascript" src="<?=setting::$BASE_URL?>/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="<?=setting::$BASE_URL?>/script.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <?php print $_scripts; ?>
</head>

<body >
<div id="mainwrap">
<div id="container">
<?php

    include("include/top_member.php");
?>


        <?php
            print $content;
        ?>

           <br clear="all">
<?php include("include/footer.php");?> 
            </div>
            </div>
            

</body>
</html>
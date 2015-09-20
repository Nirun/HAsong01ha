<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="<?php echo base_url(); ?>">
<title><?php echo $title; ?></title>
<LINK REL="stylesheet" HREF="register/style.css" TYPE="text/css">
<link href="register/css/thickbox.css" rel="stylesheet" type="text/css" />
<?php print $_styles ; ?>
<!--<script src="register/scripts/jquery-latest.js" type="text/javascript"></script>-->
<script src="js_validate/jquery.js" type="text/javascript"></script>
<script src="register/scripts/thickbox.js" type="text/javascript"></script>



<!--<script type="register/text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<script src="register/js/clock.js"></script>
<?php print $_scripts; ?>
</head>

<body onLoad="goforit();"> 
<?php echo $this->load->view('register/inc_top'); ?>
<div id="maincontainer">
<div id="container">
  <?php
       echo $content;
  ?>
</div>
</div>
<?php echo $this->load->view('register/inc_footer'); ?> 
</body>
</html>
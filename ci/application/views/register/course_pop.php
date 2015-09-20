<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<LINK REL="stylesheet" HREF="register/style.css" TYPE="text/css"> 
<title>Courses List</title>
</head>
<body><br />
<form id="form_courselist" name="form_courselist" method="post">
<table width="480" border="0" cellspacing="0" cellpadding="0">
   <tr valign="left">
    <td colspan="2" align="left"><font class="title"><strong>All Course/Order by Alphabet</strong></font> 
</td>
</tr>
   <tr valign="left">
    <td align="left" ><img src="images/blank.gif" alt="" width="10" height="1" border="0"></td>
    <td align="left" ><img src="images/blank.gif" alt="" width="350" height="1" border="0"></td>
</tr>
<?php
foreach ($data as $val): 
	$courseID = $val['courseID']; 
	$courseCode =  $val['coursecode'];
	$courseName =  $val['coursename'];	
?>
</tr>
   <tr valign="middle">
    <td width="20"><input name="isSelected[]" type="checkbox" value="<?php echo $courseID ?>" /></td>
    <td class="info" align="left"><?php echo $courseCode ?> : <?php echo $courseName ?></td>
</tr>
<?php endforeach; ?> 
<tr valign="middle">
    <td colspan="2" align="center">
        <input id="btn_save" name="btn_save" type="button" value="Save"  class="button"/>
	</td>
</tr>
</table>
</form>
</body>
</html>

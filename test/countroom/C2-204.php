<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?
	mysql_connect("localhost","dayofdog","rj4x39ca") or die("Error Connect to Database");
	mysql_select_db("dayofdog_ha2");
	mysql_query("SET character_set_results=UTF8");
	
	$strSQL = "SELECT b.total , (SELECT count(*)  FROM ha_workshop c  WHERE  c.room = 'C1,C2-204' and c.dateroom = '14/03/2557' and c.timeroom = '08:30') as reg  FROM ha_roomtotal b WHERE b.total <> (SELECT count(*)  FROM ha_workshop a  WHERE  a.room = 'C1,C2-204' and a.dateroom = '14/03/2557' and a.timeroom = '08:30') and   b.room = 'C1,C2-204' and b.dateroom = '14/03/2557' and b.timeroom = '08:30'";

	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);

?>
<p>รับสมัครผู้ลงทั้งหมด :: <? echo $objResult['total']; ?> ท่าน</p>
<p>สมัครแล้ว :: <? echo $objResult['reg']; ?> ท่าน</p>


</body>
</html>
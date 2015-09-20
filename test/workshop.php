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
	
	$strSQL = "SELECT b.total , (SELECT count(*)  FROM ha_workshop c  WHERE  c.room = '".$_GET['id']."' and c.dateroom = '".$_GET['dateroom']."' and c.timeroom = '".$_GET['timeroom']."') as reg  FROM ha_roomtotal b WHERE b.total <> (SELECT count(*)  FROM ha_workshop a  WHERE  a.room = '".$_GET['id']."' and a.dateroom = '".$_GET['dateroom']."' and a.timeroom = '".$_GET['timeroom']."') and   b.room = '".$_GET['id']."' and b.dateroom = '".$_GET['dateroom']."' and b.timeroom = '".$_GET['timeroom']."'";

	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);

?>
<p>รับสมัครผู้ลงทั้งหมด :: <? echo $objResult['total']; ?> ท่าน</p>
<p>สมัครแล้ว :: <? echo $objResult['reg']; ?> ท่าน</p>

<form id="form1" name="form1" method="post" action="regworkshop.php">
  <p>ลงทะเบียนห้อง workshop ห้องที่ <? echo $_GET['id']; ?></p>
  <p>วันที่ :: <? echo $_GET['dateroom']; ?></p>
  <p>เวลา :: <? echo $_GET['timeroom']; ?></p>
  <p>กรุณากรอกเลขที่นั่ง และเลือกประเภทการสมัคร</p>
  <p>
    <label>
      <input type="radio" name="register" id="register" value="90" checked="checked" />
      ประเภท Forum 15
      <input type="radio" name="register" id="register" value="95" />
    </label>
  ประเภท Oral &amp; Poster </p>
<p>
  <label>
    <input name="number" type="text" id="number" size="4" maxlength="4" />
    <input type="hidden" name="room" id="room" value="<? echo $_GET['id']; ?>" />
    <input type="hidden" name="dateroom" id="dateroom" value="<? echo $_GET['dateroom']; ?>" />
    <input type="hidden" name="timeroom" id="timeroom" value="<? echo $_GET['timeroom']; ?>" />
  </label>
  </p>
<p>
  <label>
    <input type="submit" name="ตกลง" id="ตกลง" value="Submit" />
    </label>
  </p>
</form>
</body>
</html>

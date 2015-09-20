<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<p>
  <?
  
  
	$seatno = $_POST['seatno'];
	$name= $_POST['name'];
	$occupation = $_POST['occupation'];
	$hospital = $_POST['hospital'];
	$roomworkshop = $_POST['roomworkshop'];
	$dateroom = $_POST['dateroom'];
	$timeroom = $_POST['timeroom'];

	mysql_connect("localhost","dayofdog","rj4x39ca") or die("Error Connect to Database");
	mysql_select_db("dayofdog_ha2");
	//mysql_query("SET character_set_results=UTF8");
	mysql_query("SET NAMES UTF8");
	$strSQL = "INSERT INTO ha_workshop (room, name, seatno, occupation, hospital,dateroom,timeroom) VALUES ('$roomworkshop', '$name', '$seatno', '$occupation', '$hospital','$dateroom','$timeroom'); ";

	$objQuery = mysql_query($strSQL);

echo "ลงทะเบียนเรียบร้อยแล้วครับ";

?>
</p>
<p>&nbsp;</p>
<p><a href="http://www.ha.or.th/haweb/index.php/home-forum15">
  <input type="submit" name="button" id="button" value="กลับไปที่ เว็บ" />
</a></p>
<p>&nbsp;</p>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<p>
  <?
	mysql_connect("localhost","dayofdog","rj4x39ca") or die("Error Connect to Database");
	mysql_select_db("dayofdog_ha2");
	mysql_query("SET character_set_results=UTF8");
	
	$strSQL = "select case when prefix= 6  then  prefix_other else p.title_th end as title, t.name,t.lastname, o.title_th  as occupation,     coalesce(h.name,t.hospitalother) as hospital, concat(d.address,' ',coalesce(d.address,pv.PROVINCE_NAME),' ',d.postcode) as address,   coalesce(t.email,t.cohosemail) as email, d.tel, coalesce(d.mobile,t.cohosmobile) as mobile, se.seatNo as seatNo from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID left join tbl_occupation  as o on  o.id =t.professiontypeID join tbl_register_type as tr on  r.registerBy = tr.type_id left join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID left join tbl_seats as se on  se.registrationID = i.register_id where r.courseID = ".$_POST['register']." and r.isdelete = 0 and r.registrationID not in ( select registrationID from tbl_registration where courseID = ".$_POST['register']." and (refID =0 and reftype=1 and registerby =3) and isDelete = 0 ) and r.Ispaid = 1 and se.seatNo = ".$_POST['number'];

	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	$num = mysql_num_rows($objQuery);
	$strSQL3 = "SELECT b.total  , (SELECT count(*)  FROM ha_workshop c  WHERE  c.room = '".$_POST['room']."' and c.dateroom = '".$_POST['dateroom']."' and c.timeroom = '".$_POST['timeroom']."') as reg  FROM ha_roomtotal b WHERE b.total <> (SELECT count(*)  FROM ha_workshop a  WHERE  a.room = '".$_POST['room']."' and a.dateroom = '".$_POST['dateroom']."' and a.timeroom = '".$_POST['timeroom']."') and   b.room = '".$_POST['room']."' and b.dateroom = '".$_POST['dateroom']."' and b.timeroom = '".$_POST['timeroom']."'";
	
	$objQuery3 = mysql_query($strSQL3);
	$objResult3 = mysql_fetch_array($objQuery3);
$total = $objResult3['total'];
$reg = $objResult3['reg'];
	if($num <> 0){
	
	
	$strSQL2 = "SELECT count(*) as countroom FROM ha_workshop WHERE seatno = '".$_POST['number']."' and room ='".$_POST['room']."' and dateroom = '".$_POST['dateroom']."' and timeroom = '".$_POST['timeroom']."'";

	$objQuery2 = mysql_query($strSQL2);
	$objResult2 = mysql_fetch_array($objQuery2);


?>
</p>

<p>รับสมัครผู้ลงทั้งหมด :: <? echo $total; ?> ท่าน</p>
<p>สมัครแล้ว :: <? echo $reg ; ?> ท่าน</p>



<form id="form1" name="form1" method="post" action="insertworkshop.php">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="10%">เลขที่นั่ง</td>
      <td width="90%"><input name="seatno" type="text" readonly="readonly" value="<? echo $objResult['seatNo']; ?>" /></td>
    </tr>
    <tr>
      <td><p>ชื่อ-นามสกุล</p></td>
      <td><input name="name" type="text" readonly="readonly" value="<? echo $objResult['title'].$objResult['name']." ".$objResult['lastname']; ?>" /></td>
    </tr>
    <tr>
      <td>วิชาชีพ</td>
      <td><input name="occupation" type="text" readonly="readonly" value="<? echo $objResult['occupation']; ?>" /></td>
    </tr>
    <tr>
      <td>โรงพยาบาล</td>
      <td><input name="hospital" type="text" readonly="readonly" value="<? echo $objResult['hospital']; ?>" /></td>
    </tr>
    <tr>
      <td>ห้อง workshop</td>
      <td><input name="roomworkshop" type="text" readonly="readonly" value="<? echo $_POST['room']; ?>" /></td>
    </tr>
    <tr>
      <td>วันที่</td>
      <td><input name="dateroom" type="text" readonly="readonly" value="<? echo $_POST['dateroom']; ?>" /></td>
    </tr>
    <tr>
      <td>เวลา</td>
      <td><input name="timeroom" type="text" readonly="readonly" value="<? echo $_POST['timeroom']; ?>" /></td>
    </tr>
  </table>
  <?
  if( $total == $reg ){
	  echo "<br/><br/><br/>จำนวนผู้ลงทะเบียนครบตามที่กำหนดไว้แล้วครับ จึงขออภัยด้วยครับ ยังมีห้องอื่นให้เรียนรู้ครับ <a href='http://www.haregister.com/'>http://www.haregister.com/</a>";
	  } else if( $total <> $reg ) {
	  if( $objResult2['countroom'] == 0){?>
		<input  name="" type="submit" value="Submit" />
	  <? }else { 
	  echo "ท่านได้ทำการลงทะเบียนไปแล้วครับ";
	  ?>
	  <br/>
		<a href="http://www.ha.or.th/haweb/index.php/home-forum15"><input type="button" name="button" id="button" value="กลับไปที่ เว็บ" /></a>
	  <? }?>
	</form>
	<p>&nbsp;</p>
	
	<? 
		}else if($num == 0){ echo "กรุณาลงทะเบียนหรือชำระเพื่อให้ได้เลขที่นั่งได้ที่ <a href='http://www.haregister.com/'>http://www.haregister.com/</a> ก่อนครับ";}
	}
?>
</body>

</html>
<!--<chart palette='1' xaxisname='Continent' yaxisname='Export' numdivlines='9' caption='Global Cereal Export' subcaption='In Millions Tonnes per annum per Hectare' >
	<categories font='Arial' >
		<category label='N. America' toolText='North America'/>
		<category label='Asia' />
		<category label='Europe' />
		<category label='Australia' />
		<category label='Africa' />

	</categories>
	<dataset seriesname='บาดเจ็บเล็กน้อย' color='8BBA00' >
		<set value='30' />
		<set value='26' />
		<set value='29' />
		<set value='31' /> 
		<set value='34' />
	</dataset>

	<dataset seriesname='บาดเจ็บสาหัส' color='A66EDD' >
		<set value='67' />
		<set value='98' />
		<set value='79' />
		<set value='73' />
		<set value='80' />
	</dataset>

</chart>-->

<chart palette='1' xaxisname='วันที่' yaxisname='จำนวน' numdivlines='9' caption='จำนวนผู้ลงทะเบียนและจ่ายเงิน HA Forum ครั้งที่ 15' subcaption='' >

<?
	mysql_connect("localhost","dayofdog","rj4x39ca") or die("Error Connect to Database");
	mysql_select_db("dayofdog_ha2");
	mysql_query("SET character_set_results=UTF8");
	
		$strSQL2 = "select date(r.registerdatetime) as datereg,count(*)  as countpp from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID left join tbl_occupation  as o on  o.id =t.professiontypeID join tbl_register_type as tr on  r.registerBy = tr.type_id left join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID where r.courseID = 90 and r.isdelete = 0 and r.registrationID not in ( select registrationID from tbl_registration where courseID = 90 and (refID =0 and reftype=1 and registerby =3) and isDelete = 0 ) group by DATE(r.registerdatetime);";	
	
	$objQuery2 = mysql_query($strSQL2);
?>


<categories font='Arial' >

<?
	while($objResult2 = mysql_fetch_array($objQuery2))
{

?>

		<category label='<?=$objResult2["datereg"]; ?>'></category>
<?
}
?>		
</categories>

<?

		$strSQL3 = "select date(r.registerdatetime) as datereg,count(*)  as countpp from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID left join tbl_occupation  as o on  o.id =t.professiontypeID join tbl_register_type as tr on  r.registerBy = tr.type_id left join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID where r.courseID = 90 and r.isdelete = 0 and r.registrationID not in ( select registrationID from tbl_registration where courseID = 90 and (refID =0 and reftype=1 and registerby =3) and isDelete = 0 ) group by DATE(r.registerdatetime);";	
	
	$objQuery3 = mysql_query($strSQL3);

?>


	<dataset seriesname='ผู้ลงทะเบียน' color='8BBA00' >
    
<?
	while($objResult3 = mysql_fetch_array($objQuery3))
{

?>   
		<set value='<?=$objResult3["countpp"]; ?>'></set>
        
<?
}
?>
	</dataset>
    
    
    <dataset seriesname='ผู้จ่ายเงิน' color='A66EDD' >
<?
		$strSQL4 = "select date(r.registerdatetime) as datereg,count(*)  as countpp from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID left join tbl_occupation  as o on  o.id =t.professiontypeID join tbl_register_type as tr on  r.registerBy = tr.type_id left join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID where r.courseID = 90 and r.isdelete = 0 and r.registrationID not in ( select registrationID from tbl_registration where courseID = 90 and (refID =0 and reftype=1 and registerby =3) and isDelete = 0 ) group by DATE(r.registerdatetime);";	

	$objQuery4 = mysql_query($strSQL4);
	while($objResult4 = mysql_fetch_array($objQuery4))
{
    
	$strSQL5 = "select date(r.registerdatetime) as datereg,count(*)  as countpp from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID left join tbl_occupation  as o on  o.id =t.professiontypeID join tbl_register_type as tr on  r.registerBy = tr.type_id left join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID where r.courseID = 90 and r.isdelete = 0 and r.registrationID not in ( select registrationID from tbl_registration where courseID = 90 and (refID =0 and reftype=1 and registerby =3) and isDelete = 0 )and r.Ispaid = 1 and date(r.registerdatetime) = '".$objResult4["datereg"]."' group by DATE(r.registerdatetime) ;";
	
	$objQuery5 = mysql_query($strSQL5);	
    $num_rows = mysql_num_rows($objQuery5);

	while($objResult5 = mysql_fetch_array($objQuery5))
{
?>	
 		<set value='<?=$objResult5["countpp"]; ?>'></set>

 <?
}

if($num_rows == 0)
{
?>   
    <set value='0'></set>
<?
}
}
?> 
	</dataset>
</chart>
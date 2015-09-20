<?
	mysql_connect("localhost","dayofdog","rj4x39ca") or die("Error Connect to Database");
	mysql_select_db("dayofdog_ha2");
	mysql_query("SET character_set_results=UTF8");
	
	/*$strSQL1 = "select date(r.registerdatetime) as datereg,count(*)  as countpp from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID  and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID join tbl_register_type as tr on  r.registerBy = tr.type_id join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID and c.isdelete= 0 join ( select ts.hospitalID,ts.traineeID,hh.name hospitalname,ts.hospitalother from tbl_trainees ts join tbl_registration rr on rr.traineeID = ts.traineeID  and ts.isdelete= 0 and rr.isdelete = 0 left join hospital hh on ts.hospitalID = hh.hospitalID where rr.IsPaid =1 and rr.courseID = 90 group by ts.hospitalID,ts.traineeID,hh.name,ts.hospitalother ) hs  on hs.traineeID = r.billing_ref1 left join tbl_occupation  as o on  o.id =t.professiontypeID where r.IsPaid =1 and r.isdelete = 0 and r.courseID = 90 group by DATE(r.registerdatetime);";
	$objQuery1 = mysql_query($strSQL1);
	
		$strSQL1 = "select selected_date da from (select adddate('1970-01-01',t4*10000 + t3*1000 + t2*100 + t1*10 + t0) selected_date from (select 0 t0 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0, (select 0 t1 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1, (select 0 t2 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2, (select 0 t3 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3, (select 0 t4 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v where selected_date between '2013-12-16' and '2014-02-13';";
	$objQuery1 = mysql_query($strSQL1);	
	
	
		
	
	$strSQL2 = "select date(r.registerdatetime) as datereg,count(*)  as countpp from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID  and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID join tbl_register_type as tr on  r.registerBy = tr.type_id join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID and c.isdelete= 0 join ( select ts.hospitalID,ts.traineeID,hh.name hospitalname,ts.hospitalother from tbl_trainees ts join tbl_registration rr on rr.traineeID = ts.traineeID  and ts.isdelete= 0 and rr.isdelete = 0 left join hospital hh on ts.hospitalID = hh.hospitalID where rr.courseID = 90 group by ts.hospitalID,ts.traineeID,hh.name,ts.hospitalother ) hs  on hs.traineeID = r.billing_ref1 left join tbl_occupation  as o on  o.id =t.professiontypeID where r.isdelete = 0 and r.courseID = 90 group by DATE(r.registerdatetime);";	
	*/
		$strSQL2 = "select date(r.registerdatetime) as datereg,count(*)  as countpp from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID left join tbl_occupation  as o on  o.id =t.professiontypeID join tbl_register_type as tr on  r.registerBy = tr.type_id left join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID where r.courseID = 90 and r.isdelete = 0 and r.registrationID not in ( select registrationID from tbl_registration where courseID = 90 and (refID =0 and reftype=1 and registerby =3) and isDelete = 0 ) group by DATE(r.registerdatetime);";	
	
	$objQuery2 = mysql_query($strSQL2);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="900">
<title>Untitled Document</title>

 		<script type="text/javascript" src="SWF/Charts/FusionCharts.js"></script>
        <!--<script type="text/javascript" src="includes/FusionMaps.js"></script>
        <script type="text/javascript" src="includes/dataGen.js"></script>
        <script type="text/javascript" src="Data/stateSWF.js"></script>
        <script type="text/javascript" src="Data/Warehouses.js"></script>
        <script type="text/javascript" src="includes/mapHelper.js"></script>-->
		<!--<script type="text/javascript" src="/lib/js/flash_detect.js"></script>-->



</head>

<body>

<!--<table width="30%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="44%">วันที่</td>
    <td width="56%">จำนวน</td>
  </tr>  -->
  
<?
/*
	while($objResult1 = mysql_fetch_array($objQuery1))
{
	
?>
  <tr>
    <td><?=$objResult1["da"]; ?></td>
    <td><?=$objResult1["countpp"]; ?></td>
  </tr>
<?
}
*/
?>  

<!--</table>  -->


<br/>


<table width="180%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="16%">
    
        <table width="100%" border="1" cellspacing="0" cellpadding="0" >
          <tr>
            <td width="36%">วันที่</td>
            <td width="29%">จำนวนผู้ลงทะเบียน</td>
            <td width="35%">จำนวนผู้จ่ายเงิน</td>
          </tr>
          
        <?
        $sum1 = 0 ;
        $sum2 = 0;
        
            while($objResult2 = mysql_fetch_array($objQuery2))
        {
            
        ?>
          <tr>
            <td><?=$objResult2["datereg"]; ?></td>
            <td><? echo $countpp1 = $objResult2["countpp"];
            $sum1 = $sum1 + $countpp1; ?></td>
        <?    
            
            /*	$strSQL3 = "select count(*)  as countpp from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID  and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID join tbl_register_type as tr on  r.registerBy = tr.type_id join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID and c.isdelete= 0 join ( select ts.hospitalID,ts.traineeID,hh.name hospitalname,ts.hospitalother from tbl_trainees ts join tbl_registration rr on rr.traineeID = ts.traineeID  and ts.isdelete= 0 and rr.isdelete = 0 left join hospital hh on ts.hospitalID = hh.hospitalID where rr.IsPaid =1 and rr.courseID = 90 group by ts.hospitalID,ts.traineeID,hh.name,ts.hospitalother ) hs  on hs.traineeID = r.billing_ref1 left join tbl_occupation  as o on  o.id =t.professiontypeID where r.IsPaid =1 and r.isdelete = 0 and r.courseID = 90 and date(r.registerdatetime) = '".$objResult2["datereg"]."' group by DATE(r.registerdatetime);";*/
            
            $strSQL3 = "select date(r.registerdatetime) as datereg,count(*)  as countpp from tbl_registration r inner join tbl_trainees as t on r.traineeID = t.traineeID and t.isdelete= 0 left join tbl_prefix_name as p on  t.prefix = p.id left join hospital as h on  h.hospitalID = t.hospitalID left join province as pv on h.provinceid = pv.PROVINCE_ID left join tbl_address as d on  d.traineeID = t.traineeID left join tbl_occupation  as o on  o.id =t.professiontypeID join tbl_register_type as tr on  r.registerBy = tr.type_id left join tbl_receipt_info as i on r.registrationID = i.register_id join tbl_courses as c  on c.courseID = r.courseID where r.courseID = 90 and r.isdelete = 0 and r.registrationID not in ( select registrationID from tbl_registration where courseID = 90 and (refID =0 and reftype=1 and registerby =3) and isDelete = 0 )and r.Ispaid = 1 and date(r.registerdatetime) = '".$objResult2["datereg"]."' group by DATE(r.registerdatetime) ;";
            
            $objQuery3 = mysql_query($strSQL3);	
            $num_rows = mysql_num_rows($objQuery3);
        
            while($objResult3 = mysql_fetch_array($objQuery3))
        {
            
        ?> 
            <td><? echo $countpp2 = $objResult3["countpp"]; 
            
            $sum2 = $sum2 + $countpp2;
            
            ?></td>
        
        <?
        }
        
        if($num_rows == 0)
        {
        ?>   
            <td>0</td>
        <?
        }
        ?>
          </tr>
        <?
        }
        ?> 
        
          <tr>
            <td width="36%">รวม</td>
            <td width="29%"><?=$sum1?></td>
            <td width="35%"><?=$sum2?></td>
          </tr>
        
        </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td width="84%">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="100%" align="left" valign="middle" class="lightblueborder"><div align="center"  id="chartContainer">FusionCharts will load here</div>
         
         <script type="text/javascript"><!--

                           //var myChart = new FusionCharts("SWF/Charts/Column3D.swf","top10rev","500","320","0","1");
						   var myChart = new FusionCharts("SWF/Charts/MSColumn3D.swf","top10rev","1500","1000","0","1");
                            myChart.setXMLUrl( "Data3.php" );
                            myChart.render( "chartContainer" );
							
							
							myChart.addEventListener( "nodatatodisplay", function() { 
								if ( window.windowIsReady ){
									notifyLocalAJAXSecurityRestriction(); 
								}else
								{
									$(document).ready (function(){
										notifyLocalAJAXSecurityRestriction();
									});
								}
							});
							
                            // -->
                        </script></td>
     </tr>
     <tr>
       <td height="800" align="left" valign="middle" class="lightblueborder"><p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p>
         <p>&nbsp;</p></td>
     </tr>
   </table>
    
    </td>
  </tr>
</table>
<br/>
<br/>
<br/>
<br/>

</body>
</html>
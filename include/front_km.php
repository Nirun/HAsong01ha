<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<ul id="countrytabs" class="shadetabs" >
<li><a href="javascript:onClick=showHint('km_multimedia.php');"  class="selected"><img src="images/t_km.gif" name="image1" width="325" height="27" border="0" id="image1" onclick="MM_swapImage('image1','','images/t_km.gif','image2','','images/t_km2off.gif','image3','','images/t_km3off.gif',1)" /></a></li>
<li><a href="javascript:onClick=showHint('km_publication.php');"  class="selected"><img src="images/t_km2off.gif"  width="325" height="27" border="0"  id="image2"  onClick="MM_swapImage('image2','','images/t_km2.gif','image1','','images/t_kmoff.gif','image3','','images/t_km3off.gif',0)"></a></li>
<li><a href="javascript:onClick=showHint('km_research.php');"  class="selected"><img src="images/t_km3off.gif"  width="325" height="27"  border="0"  id="image3" onClick="MM_swapImage('image3','','images/t_km3.gif','image2','','images/t_km2off.gif','image1','','images/t_kmoff.gif',0)"></a></li>
</ul>

<!--content--><script src="js/clienthint2.js"></script><span id="txtHint"><?php include("km_multimedia.php");?></span><!--content-->

<script type="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>
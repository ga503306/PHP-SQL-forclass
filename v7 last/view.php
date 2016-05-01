<?php
include("global.php");

$link=mysql_pconnect($HOST,$USER,$PASS);
mysql_select_db($DB);
$str="select * from gbook";
$result=mysql_query($str);
?>


<!DOCTYPE html>
<html>
  <meta charset="utf-8" />
    <head>
      
        <title>zzz網路書局</title>
        <meta name="keywords" content="homepage, Web" />
        <meta name="description" content="Web site homepage" />
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>    
    <body>
	<DIV ID="SHOW" style="position:absolute;">
<TABLE CELLSPACING=0 CELLPADDING=3 BORDER=1 BGCOLOR="Silver">
<TH><A HREF="#" onClick="moveOnMenu();moveOffShow();"><SMALL>顯示</SMALL></A></TH>
</TABLE></DIV>
<DIV ID="MENU" style="position:absolute;">
<TABLE CELLSPACING=0 CELLPADDING=3 BORDER=1 BGCOLOR="Silver">
<TR><TH><A HREF="#" onClick="moveOffMenu();moveOnShow();"><SMALL>隱藏</SMALL></A></TH></TR>
<TR><TD><UL>
<LI><A HREF="team.php"><SMALL>組員貢獻度</SMALL></A>
<LI><A HREF="view.php"><SMALL>客戶留言板</SMALL></A>	
</UL></TD></TR></TABLE></DIV>
<SCRIPT LANGUAGE="JavaScript">
<!--
var OffX = -150;
var PosX = 10;
var PosY = 100;
var speed = 1;
var increment = 1;
var is_NS = navigator.appName=="Netscape";
var is_Ver = parseInt(navigator.appVersion);
var is_NS4 = is_NS&&is_Ver>=4&&is_Ver<5;
var is_NS5up = is_NS&&is_Ver>=5;
//var sPosX = OffX;
//var sOffX = PosX;
//var MenuX = sOffX;
//var SelX = sPosX;
var MenuX = OffX;
var SelX = PosX;
var sPosX = PosX;
var sOffX = OffX;

if (is_NS4) {
  increment = 5;
  Lq = "document.layers.";
  Sq = "";
  eval(Lq+'SHOW'+Sq+'.left=sPosX');
  eval(Lq+'MENU'+Sq+'.left=sOffX');
  eval(Lq+'SHOW'+Sq+'.top=PosY');
  eval(Lq+'MENU'+Sq+'.top=PosY');
} else {
  Lq = "document.all.";
  Sq = ".style";
  document.getElementById('SHOW').style.left = sPosX+"px";
  document.getElementById('MENU').style.left = sOffX+"px";
  document.getElementById('SHOW').style.top = PosY+"px";
  document.getElementById('MENU').style.top = PosY+"px";
}  
function moveOnMenu() {
  if (MenuX < PosX) { 
    MenuX = MenuX + increment;
    if (is_NS5up) document.getElementById('MENU').style.left = MenuX+"px";
    else eval(Lq+'MENU'+Sq+'.left=MenuX');
    setTimeout('moveOnMenu()',speed);
  }
}
function moveOffMenu() {
  if (MenuX > OffX) { 
    MenuX = MenuX - increment;
    if (is_NS5up) document.getElementById('MENU').style.left = MenuX+"px";
    else eval(Lq+'MENU'+Sq+'.left=MenuX');
    setTimeout('moveOffMenu()',speed);
  }
}
function moveOffShow() {
  if (SelX > OffX) { 
    SelX = SelX - increment;
    if (is_NS5up) {
      document.getElementById('SHOW').style.left = SelX+"px";
    } else {
      eval(Lq+'SHOW'+Sq+'.left=SelX');
    }
    setTimeout('moveOffShow()',speed);
  }
}
function moveOnShow() {
  if (SelX < PosX) { 
    SelX = SelX + increment;
    if (is_NS5up) document.getElementById('SHOW').style.left = SelX+"px";
    else eval(Lq+'SHOW'+Sq+'.left=SelX');
    setTimeout('moveOnShow()',speed);
  }
}
// -->
</SCRIPT>

<!--霓虹文字_開始-->
<script language="JavaScript">

<!--
<!--在此修改文字本身的顏色-->
neonBaseColor = "#FFFF00";
<!--修改文字變化的顏色-->
neonColor = "#ff0000";
num = 0;
num2 = 0;
num3 = 0;
num4 = neonColor;
function startNeon() {
message = neon.innerText;
neon.innerText = "";
for(i = 0; i != message.length; i++) {
neon.innerHTML += "<span id=\"neond\" style=\"color:"+neonBaseColor+"\">"+message.charAt(i)+"<\/span>"};
neon2();
}
function neon2() {
if(num != message.length) {
document.all.neond[num].style.color = neonColor;
num++;
setTimeout("neon2()", 100);
}
else {
num = 0;
num2 = message.length;
setTimeout("neon4onev()", 2000);
   }
}
function neon4onev() {
document.all.neond[num].style.color = neonBaseColor;
document.all.neond[num2-1].style.color = neonBaseColor;
if(Math.floor(message.length / 2) + 1 != num2) {
num++;
num2--;
setTimeout("neon4onev()", 50);
}
else {
setTimeout("neon5()", 50);
   }
}
function neon5() {
if(num3 != message.length && num3 != message.length+1) {
document.all.neond[num3].style.color = neonColor;
num3 = num3 + 2;
setTimeout("neon5()",100);
}
else {
setTimeout("neon52()", 50);
   }
}
function neon52() {
if(num3 == message.length) {
num3++;
neon52a();
}
else {
num3--;
neon52a();
   }
}
function neon52a() {
if(num3 != 1) {
num3 = num3 - 2;
document.all.neond[num3].style.color = neonColor;
setTimeout("neon52a()", 100);
}
else {
if(num4 == neonColor) {
num3 = 0;
neonColor = neonBaseColor;
setTimeout("neon5()", 2000);
}
else {
neonColor = num4;
num3 = 0;
setTimeout("neon4onev2()", 50);
      }
   }
}
function neon4onev2() {
document.all.neond[num].style.color = neonColor;
document.all.neond[num2 - 1].style.color = neonColor;
if(message.length != num2) {
num--;
num2++;
setTimeout("neon4onev2()", 50);
}
else {
num = 0;
num2 = 0;
setTimeout("neon3()", 2000);
   }
}
function neon3() {
if(num != message.length) {
document.all.neond[num].style.color = neonBaseColor;
num++;
setTimeout("neon3()", 100);
}
else {
num = 0;
neon2();
   }
}	
-->
</script>
<body onLoad="startNeon()">
<!--修改文字的內容、字體、大小-->
<center><span id="neon"><font face="細明體" size="1">~~~歡迎光臨~~~</font></span></center>
<!--霓虹文字_結束-->
        <div id="wrapper">

        <?php include 'include/header.php'; ?>
            <!-- end div#header -->	
			  
            <div id="page">
                <div id="content">
                    <div id="welcome">
					<strong><font size="5"color='AA2808'>顯示留言板</font></strong>
                        <br><br><br><br><br>
                        <!--body-->
				<H1>留言板</H1><a href="add.php">新增留言</a>
<TABLE border=0>
<?php
while(list($id,$name,$email,$face,$ip,$ctime,$title,$content)=mysql_fetch_row($result)){
$FACE[0]="（´・ω・）";
$FACE[1]="o'_'o";
$FACE[2]="_(:3 」L)_";
$FACE[3]="(੭ ◕㉨◕)੭";

echo "<TR>";
echo "<TD>";
echo "<a href=delete.php?delid=" . $id .">刪除</a> <a href=fix.php?fixid=" . $id ."></a><br>";
echo "留言者： ".$name."<br>";
echo "電子郵件： ".$email."<br>";
echo "表情： ".$FACE[$face]."<br>";
echo "日期： ".$ctime."<br>";
echo "IP： ".$ip."<br>";
echo "主旨： ".$title."<br>";
echo "內容 :".nl2br($content)."<br>";
echo "<hr>";
echo "</TD></TR>";

}
?>
</TABLE>
						
                        <!--body ends-->
                    </div>          					
                    <!-- end div#welcome -->		                    
                </div>
                <!-- end div#content -->
                <div id="sidebar">
				
                    <ul>
                    <?php include 'include/nav.php'; ?>
                        <!-- end navigation -->
                        <?php include 'include/updates.php'; ?>
                        <!-- end updates -->
                    </ul>
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
            <?php include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>



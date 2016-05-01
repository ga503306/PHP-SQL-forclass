<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
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
					<strong><font size="10"color='AA2808'>組員貢獻度la</font></strong>
                        <br><br><br><br><br>
                        <!--body-->
						<table border="0">
  <table style="border: 5px double rgb(109, 2, 107); height: 150px; background-color: rgb(255, 255, 255); width: 300px;" align="center" cellpadding="5" cellspacing="5" frame="border" rules="all">
   <tbody>
    <tr>
       <td>組員名稱</td>
       <td>貢獻度</td>
     </tr>
     <tr>
       <td>蔣鎮宇</td>
       <td>49%</td>
     </tr>
     <tr>
       <td>黃子庭</td>
	  
       <td>51%</td>
     </tr>
   </tbody>
 </table>
				
						
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
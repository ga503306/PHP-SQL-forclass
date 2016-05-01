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
                        <h1>歡迎進入zzz 網路書局</h1>
                        <!--body-->
                        <p>
						   讀書，可以增廣見聞、開拓視野。古人云 ：『秀才不出門，亦能知天下之事』，就是在講述讀書的好處。

						 
                        </p>
						<p>
						
						根據調查，有閱讀習慣的人年年減少，但其實我們可以從讀書中獲得各式各樣的好處。
前一陣子，根據英美大學的調查顯示：「讀書對身體健康有正向的影響」。
						   
                        </p>
						<p>
						小時候培養讀書習慣，可以提升能力，久而能訓練集中力；甚至，還能陶冶性情、降低壓力。

                        </p>
						<p>
						網路書局，是現在很普遍受歡迎的平台。因為不用像逛一般書局，逛來逛去還不見得能找到想要的書。
                        </p>
						<p>
						ZZ網路書局就是一個不錯的選擇。有良善的尋找書籍的功能，使你可以不用費盡心力的逛書局，
                        </p>
						<p>
						所有書籍一目了然、應有盡有。還有方便的線上訂書功能，讓你可以無時無刻，不管你身在何處都可以如你所願的訂到你所想要的書。
                        </p>
						<p>
						假使你不小心訂錯了書，沒關係，我們ZZ書局也開放了取消訂書的功能，可以不用擔心下錯決定，隨時想取消就取消。
                        </p>
						<p>
						最後，本書局還有查詢是否出貨的功能，假如顧客們有未收到貨(書)的情況，也可來本站查看；或有問題，也可寄信給本站站長。
                        </p>
						<p>
						還不馬上來買書!!!~~~   再不買，你就來不及囉。
                        </p>
                        <p>
                            感謝您使用zzz網路書局 
                        </p>   
						    
  <p>
　　　　	　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　本站站長				
 </p>	
  
                          
				
						
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
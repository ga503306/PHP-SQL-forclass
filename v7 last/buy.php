<meta charset="utf-8" />
<?php
if(! isset($_SESSION['sectors'])){
    session_start();
    include("conf/conf.php");
    // 建立AAConf物件取得資料庫連接資訊
    $dbConf = new AAConf();
    $databaseURL = $dbConf->get_databaseURL();
    $databaseUName = $dbConf->get_databaseUName();
    $databasePWord = $dbConf->get_databasePWord();
    $databaseName = $dbConf->get_databaseName();
        
    // 指定資料庫連接資訊的Session變數
    $_SESSION['databaseURL']=$databaseURL; 
    $_SESSION['databaseUName']=$databaseUName; 
    $_SESSION['databasePWord']=$databasePWord; 
    $_SESSION['databaseName']=$databaseName;
	
    $connection = mysql_connect($databaseURL,$databaseUName,$databasePWord)
                  or die ("錯誤: 連接伺服器錯誤!");
    $db = mysql_select_db($databaseName,$connection)
          or die ("錯誤: 連接資料庫錯誤!");
	
    // 送出utf8編碼與校對     
    mysql_query('SET CHARACTER SET utf8');
    mysql_query("SET collation_connection = 'utf8_general_ci'");
    
    $rowArray;
    $rowID = 1;
    $query = "SELECT * FROM sectors";
    $result = mysql_query($query);
    while($row = mysql_fetch_array($result)){    
            $rowArray[$rowID] = $row['Sector'];   
            $rowID = $rowID + 1;
        }  
        
    // 更新航點資訊的Session變數
    $_SESSION['sectors'] = $rowArray;  
    mysql_close($connection);
}

$rowArray2 = $_SESSION['sectors']; 

?>
<?php
    include("itinerarymanager.php");    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>處理線上訂書</title>
        <meta name="keywords" content="itinerary, list" />
        <meta name="description" content="This page provides a list of all itineraries" />
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
<LI><A HREF="連結2"><SMALL>文字2</SMALL></A>
<LI><A HREF="連結3"><SMALL>文字3</SMALL></A>
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
            <?php            
            $fname;
            $lname;
            $sourcelist;
          
						// 取得客戶名          
            if(isset($_REQUEST["fname"])){
                $fname = $_REQUEST["fname"];
            }
            // 取得客戶姓
            if(isset($_REQUEST["lname"])){
                $lname = $_REQUEST["lname"];
            }
            
            if(isset($_REQUEST["sourcelist"])){
                $sourcelist = $_REQUEST["sourcelist"];
            }
          
          
            // 取得書名
            if(isset($_REQUEST["sdate"])){
                $sdate = $_REQUEST["sdate"];
            }            
            ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">                    
                    <h1>提供訂書資料</h1>
                    <!--body-->
            <?php
            // 有輸入客名姓名, 進行表單處理
            if(isset($_REQUEST["fname"]) && !isset($_REQUEST["confirmed"])){                                
               // 取得資料來進行訂書
             
            ?>
                    <form action="buy.php" method="POST">                        
                        <?php
                            // 找出書籍
                            $flightsArray = getAvailableFlights($sourcelist);
                            if( count($flightsArray) < 1 ){  // 沒有書籍
                                echo "<h3>書籍目前沒有販賣</h3>";
                                echo "<h4>重新確認書名後, 請重新選擇</h4><br><br>";
														  	echo "<a href='buy.php'>返回</a> | <a href='bookinfo.php'>本書局有販賣的書籍</a><br>";                                
                            }
                            else {  
                                echo "<form action='buy.php' method='POST'>";
                                echo "<h3>完成訂書手續</h3>";
                                echo "<h4>下列是同樣書名 及語言 之間的 不同出版社, 請選擇要訂的 一個出版社後 繼續</h4><br>";
                                for($index=0;$index < count($flightsArray);$index++){                                        
                                    
                                    echo "<input class='form_tfield' type='radio' name='flight' value='".$flightsArray[$index+1]."' /> ".$flightsArray[$index+1]."<br>";
                                }
                                echo "<br>";
                                
                                echo "<input type='hidden' name='fname' value='".$fname."'>";
                                echo "<input type='hidden' name='lname' value='".$lname."'>";
                                echo "<input type='hidden' name='sourcelist' value='".$sourcelist."'>";
                               
                                echo "<input type='hidden' name='sdate' value='".$sdate."'>";
                                echo "<input type='hidden' name='confirmed' value='yes'>";
                         ?>
                                
                        <input class="form_submitb" type="submit" value="處理訂書" />
                    </form>                     
                    <?php
                    }
            }
            elseif(isset($_REQUEST["confirmed"])){
                // 確認訂書, 建立訂書資料
                $flight;
                if(isset($_REQUEST["flight"])){
                   $flight = $_REQUEST["flight"];
                }  
                $IID = processReservation($fname,$lname,$sourcelist,$flight,$sdate);
                if ( $IID != -1 ){
                    echo "<h2> - 訂書成功 - </h2>";
                    echo "<p>你的訂書編號是 : ".$IID.". 請使用此訂書編號來進行之後的處理.";
                    echo "<br><br><a href='list.php'>顯示所有訂書</a>";
                }
                else{
                    echo "<h2> - 訂書失敗 - </h2>";
                    echo "<p>在我們的記錄中已經有相似的訂書資料, 因為輸入的姓名, 資訊相同.";
                    echo "<br><br><a href='list.php'>顯示所有訂書</a>";                    
                }
            }
            else {            
            ?>
                <form action="buy.php">
                    <div id="UILabel">客戶姓: </div><input class="form_tfield" type="text" name="lname" value="" /><br/><br/>	
                    <div id="UILabel">客戶名: </div><input class="form_tfield" type="text" name="fname" value="" /><br/><br/>
                    <div id="UILabel">書籍語言: </div><select class="form_tfield" name="sourcelist"><br/><br/>
                        <?php
                            echo "<option selected>".$rowArray2[1]."</option>"; 
                            for ( $index=2;$index < count($rowArray2);$index++){
                               echo "<option>".$rowArray2[$index]."</option>";  
                            }
                        ?>             
			
                    </select>
                  
                   
                    </select>
						
                    <br/><br/>
                    <div id="UILabel">書名: </div><input class="form_tfield" type="text" name="sdate" value="" /><br/>
                    <div id="note">
                        <p>請確認書名輸入無誤</p>
                    </div>
                    <input class="form_submitb" type="submit" value="訂書囉~" />
                </form>
            <?php
            }
            ?>            
			
                    <!--body ends-->                    
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
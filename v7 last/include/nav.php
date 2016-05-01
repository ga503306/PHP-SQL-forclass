<!-- 網站導覽列 -->
<?php session_start()?>
<?php
$fo=fopen("css/images/visitor2.txt","r");
$no=fgets($fo,20);
fclose($fo);

if($_SESSION['visted']!="yes"){
$fo=fopen("css/images/visitor2.txt","w");
$no++;
fwrite($fo,$no);
fclose($fo);
$_SESSION['visted']="yes";
}

echo "<font size=\"4\" color=\"xxxx\">　瀏覽人數： </font>";

?>
<?php 
for($i=1;$i<=strlen($no);$i++){
echo "<img src=css/images/".substr($no,$i-1,1).".gif width=37 height=53 />";
}
?>
<li id="submenu">



	<h2>選擇功能</h2>
	
	
	
    <ul>
	 <li><a href="buy.php">　線上訂書　</a></li>
        <li><a href="list.php">所有訂書清單</a></li>
		  <li><a href="goornot.php">查詢是否出貨</a></li>
       
        <li><a href="recheck.php">　確認訂書　</a></li>
		<li><a href="bookinfo.php">　查詢書籍　</a></li>        
    </ul>
</li>
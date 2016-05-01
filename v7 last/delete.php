<?php
include("global.php");

$link=@mysqli_connect("localhost","nhu1421","TSVQD355") 
         or die("無法開啟MySQL資料庫連接!<br/>");
 mysqli_select_db($link, "nhu1421");

$sql =  "DELETE FROM `gbook` WHERE `gbook`.`id` = '" .$_GET[delid]."'";
mysqli_query($link, 'SET NAMES utf8'); 
   if ( mysqli_query($link, $sql) ) // 執行SQL指令
      echo "資料庫刪除記錄成功, 影響記錄數: ". 
           mysqli_affected_rows($link) . "<br/>";
   else
      die("資料庫刪除記錄失敗<br/>");   
   mysqli_close($link);      // 關閉資料庫連接
header("Location: http://203.72.0.26/~nhu1421/view.php"); 
?>

<HTML>
<HEAD><TITLE>顯示留言板</TITLE></HEAD>
<BODY  bgcolor="FFFFFF"><H1>留言板</H1><a href="view.php">觀看留言</a>
</BODY>
</HTML>
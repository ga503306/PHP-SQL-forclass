<?php
include("global.php");

$link=@mysqli_connect("localhost","nhu1421","TSVQD355") 
         or die("�L�k�}��MySQL��Ʈw�s��!<br/>");
 mysqli_select_db($link, "nhu1421");

$sql =  "DELETE FROM `gbook` WHERE `gbook`.`id` = '" .$_GET[delid]."'";
mysqli_query($link, 'SET NAMES utf8'); 
   if ( mysqli_query($link, $sql) ) // ����SQL���O
      echo "��Ʈw�R���O�����\, �v�T�O����: ". 
           mysqli_affected_rows($link) . "<br/>";
   else
      die("��Ʈw�R���O������<br/>");   
   mysqli_close($link);      // ������Ʈw�s��
header("Location: http://203.72.0.26/~nhu1421/view.php"); 
?>

<HTML>
<HEAD><TITLE>��ܯd���O</TITLE></HEAD>
<BODY  bgcolor="FFFFFF"><H1>�d���O</H1><a href="view.php">�[�ݯd��</a>
</BODY>
</HTML>
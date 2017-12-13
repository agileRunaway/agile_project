<?php 
	//資料庫主機設定
	header("Content-Type:text/html; charset=utf-8");
  $db_host = "localhost";
	$db_username = "root";
	$db_password = "11064159";
	$db = 'agile';
 //	$port ="3306";
	//連線伺服器
	$db_link = mysqli_connect($db_host, $db_username, $db_password) or die("資料連結失敗！");
	mysqli_set_charset($db_link, 'utf8');
	//mysqli_select_db($db_link, $db_username);
?>
<?php
	header("Content-Type:text/html; charset=utf-8");
	session_start();
	include "conn.php";
	$_SESSION['uID'] = "";
	$uid = addslashes($_POST['uid']);
	$pwd = addslashes($_POST['pwd']);
	echo $uid;
	echo $pwd;
	$sql_query = "SELECT * FROM `member` WHERE `mem_id`='".$uid."' AND `password`='".$pwd."';";
    /*$result = mysqli_query($db_link,$sql_query) or die("Query Fail! ".mysqli_error($db_link));
	$numRow = mysqli_num_rows($result);
	if ($numRow ==0) 
	  $msg = "Login fail!";
	else {
	  $row=mysqli_fetch_assoc($result);
	  $msg = "Dear ".$row['name'].", You are welcome!";
	  }*/
	echo "hi";
	if ($result = mysqli_query($db_link,$sql_query)) {
		echo "h2";
		if ($row=mysqli_fetch_array($result)) {
			echo "h3";
			$_SESSION['uID'] = $row['mem_id'];
			$_SESSION['name'] = $row['name']; 
			echo $_SESSION['uID'];
			header("Location: shopping.php");
			echo "<a href='shopping.php'>go</a>";
			exit(0);
		} else 	{
			echo "h8";
			header("Location: login.html");
			echo "Invalid Username or Password - Please try again <br />";
		}
	}
	echo "h6";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Login</title>
<!-- <link href="mycss.css" rel="stylesheet" type="text/css" /> -->
<style type="text/css">
#cont {
width: 800px;
margin: 20px auto;
background-color:#2e8b57;
padding: 40px;
color:ivory;
font-size:14pt;
}
#msg {
font-size:35pt;
font-weight: bold;
color:red;
}
</style>
</head>
<body>
<div id="cont">
<span id="msg"><?php echo $msg; ?></span><br/>
</div>
</body>
</html>
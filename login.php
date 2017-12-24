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
	 //mysql_num_rows 
	if ($result = mysqli_query($db_link,$sql_query)) {
		if ($row=mysqli_fetch_array($result)) {
			$_SESSION['uID'] = $row['mem_id'];
			$_SESSION['name'] = $row['name']; 
			echo $_SESSION['uID'];
			if($row['id_state']=='3'){//rd
				header("Location: rd_main.php");
				echo "<a href='rd.php'>go</a>";
			}
			else{
				header("Location: homepage.html");
				echo "<a href='homepage.html'>go</a>";}
			exit(0);
		} else 	{
			header("Location: login.html");
			echo "Invalid Username or Password - Please try again <br />";
		}
	}
?>

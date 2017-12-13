<?php 
	session_start();
    if (!isset($_SESSION["uID"])){
		header("Location: login.html");
        echo "helloff22";
    }
	else if ( $_SESSION["uID"] == "" ){
		header("Location: login.html");
        echo "hello22";
    }
    else
        echo $_SESSION['name'];
        echo "      ";
        echo "<a href='logout.php'>登出</a>"
?>
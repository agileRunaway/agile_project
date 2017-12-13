<?php
if(isset($_POST["action"])&&($_POST["action"]=="add")){
	include("connMysql.php");
	$sql_query = "INSERT INTO `project_data` (`PName` ,`A_member` ,`Startdate` ,`Enddate` ,`Content` ) VALUES (";
	$sql_query .= "'".$_POST["PName"]."',";
	$sql_query .= "'".$_POST["YourMember"]."',";
	$sql_query .= "'".$_POST["sday"]."',";
	$sql_query .= "'".$_POST["eday"]."',";
	$sql_query .= "'".$_POST["textbar"]."')";
	mysqli_query($db_link, $sql_query);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>功能分派</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}
body {margin-left:10px;}
.sidenav {height: 100%;width: 400px;position: fixed;z-index: 1;top: 100;
    left: 0;background-color: #e6ffff;overflow-x: hidden;padding: 20px;line-height: 30px;}
.content {margin-left: 400px;}
table th {background-color: #b3f0ff;}
table td, th{border-bottom: 1px solid #b3f0ff;padding: 10px;text-align: left;}
.input-title {float: left;width: 25%;margin-right: 20px;}
.input-data {float: left;width: 25%;}
.AlignRight {text-align: right;}
label{font-weight:bold;}
</style>
</head>
<body>
<div class="header">
	<p style="color:#4d79ff; padding-left:40px; font-size"><b>敏捷開發專案</b></p>
	<h2><img src="contract.png" width="40" height="40"><b style="padding-top: 8px">功能分派
	<a style="padding-left:100px; font-size:15px" href="data.php">回主畫面</a></b></h2>
  </div>
<div class="sidenav">
	<form action="" method="post" name="formAdd" id="formAdd">
		<div class="AlignRight">
			<div class="input-title"> 
				<label for="PName">名稱:</label> <br/>
				<label for="YourMember">員工指派:</lable><br/>
				<label for="sday">開始日期:</label><br/>
				<label for="eday">截止日期:</label><br/>
				<label for="textbar">文字說明:</label><br/>
			</div>
		</div>
		<div class="input-data">
			<input type="text" name="PName"><br>
			<select name="YourMember">
			　<option value="陳曉照">陳曉照</option>
			　<option value="戴郁佳">戴郁佳</option>
			　<option value="鍾大宣">鍾大宣</option>
			　<option value="夜來香">夜來香</option>
			</select>
			<input type="date" name="sday"><br>
			<input type="date" name="eday"><br>
		</div>
		<div style="padding:20px">
			<textarea name="textbar" cols="45" rows="10">輸入你想要寫的內容...</textarea>
			<input name="action" type="hidden" value="add">
			<input type="submit" name="button" id="button" value="新增">
		</div>
	</form>
</div>
<div class="content">
  <table>
  <tr>
    <th>名稱</th>
    <th>員工指派</th>
    <th>開始日期</th>
	<th>截止日期</th>
	<th>文字說明</th>
  </tr>
  <?php
	include("connMysql.php");
	$sql2 = "SELECT* FROM `project_data` ";
	$result = mysqli_query($db_link, $sql2);
	while($row_result=mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".$row_result["PName"]."</td>";
		echo "<td>".$row_result["A_member"]."</td>";
		echo "<td>".$row_result["Startdate"]."</td>";
		echo "<td>".$row_result["Enddate"]."</td>";
		echo "<td>".$row_result["Content"]."</td>";
		echo "<td><a href='update.php?id=".$row_result["id"]."'><img src='pencil.png' width='50' height='50></a> ";
		echo "<a href='delete.php?id=".$row_result["id"]."'><img src='delete.png'width='50' height='50'</a></td>";
		echo "</tr>";
	}
  ?>
  <table>
</div>
</body>
</html>

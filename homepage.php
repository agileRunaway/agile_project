<?php
	include("conn.php");
	session_start();
	
	$uID=$_SESSION["uID"];
	
	$obj=(int)$_POST['obj'];
	$state=$_SESSION["state"];
	if($obj==1){
		if($state==3){
			$sql = 'SELECT * FROM `project` where `pro_owner` ="' .$uID. '"';
		}
		else{
			$sql = 'SELECT * FROM `project_member` INNER JOIN `project` ON project_member.pro_id = project.pro_id WHERE mem_id ="' .$uID. '"';
			
		}
			$result = mysqli_query($db_link, $sql);
			$count=3;
		
			echo mysqli_errno($db_link) . ": " . mysqli_error($db_link) . "\n";
	
			while($row_result=mysqli_fetch_assoc($result)){
				if($count%3==0){
					echo('<div class="container"><div class="row">');
				}
				if($row_result['status']==0){
					$pro_status="未完成";
					echo('<div class="col-sm-4" onclick="gantt('.$row_result["pro_id"].');"><div class="panel panel-primary">');
				}
				else {
					$pro_status="已完成";
					echo('<div class="col-sm-4" onclick="gantt('.$row_result["pro_id"].');"><div class="panel panel-success">');
				}
				//echo('<div class="col-sm-4" onclick="gantt('.$row_result["pro_id"].');"><div class="panel panel-primary">');
				echo('<div class="panel-heading">'.$row_result["name"].'<br/>開始日期:'.$row_result["s_time"].'<br/>截至日期:'.$row_result["e_time"].'</div>');
				echo('</div></div>');
				
				if($count%3==2){
					echo('</div></div><br>');
				}
				$count++;
				
					
				//echo("<div class='check' onclick="gantt('.$row_result["pro_id"].');"></div><br/>");
			}
			echo("|&|");
			echo($state);
		
	}
		
	
	else if($obj==3){
		
		if($state==3){
			$sql = 'SELECT * FROM `project` where `pro_owner` ="' .$uID. '" AND status = 0';
		}
		else{
			$sql = 'SELECT * FROM `project_member` INNER JOIN `project` ON project_member.pro_id = project.pro_id WHERE mem_id ="' .$uID. '" AND project.status = "0"';
			
		}
		$result = mysqli_query($db_link, $sql);
		$count=3;
		
		echo mysqli_errno($db_link) . ": " . mysqli_error($db_link) . "\n";
		while($row_result=mysqli_fetch_assoc($result)){
			
			
				
			if($count%3==0){
				echo('<div class="container"><div class="row">');
			}
			if($row_result['status']==0){
				$pro_status="未完成";
				echo('<div class="col-sm-4" onclick="gantt('.$row_result["pro_id"].');"><div class="panel panel-primary">');
			}
			else {
				$pro_status="已完成";
				echo('<div class="col-sm-4" onclick="gantt('.$row_result["pro_id"].');"><div class="panel panel-success">');
			}
			//echo('<div class="col-sm-4" onclick="gantt('.$row_result["pro_id"].');"><div class="panel panel-primary">');
			echo('<div class="panel-heading">'.$row_result["name"].'<br/>開始日期:'.$row_result["s_time"].'<br/>截至日期:'.$row_result["e_time"].'</div>');
			echo('</div></div>');
			
			if($count%3==2){
				echo('</div></div><br>');
			}
			$count++;
			
				
			//echo("<div class='check' onclick="gantt('.$row_result["pro_id"].');"></div><br/>");
		}
	}
	else if($obj==4){
		if($state==3){
			$sql = 'SELECT * FROM `project` where `pro_owner` ="' .$uID. '" AND status = 1';
		}
		else{
			$sql = 'SELECT * FROM `project_member` INNER JOIN `project` ON project_member.pro_id = project.pro_id WHERE mem_id ="' .$uID. '" AND project.status = 1';
			
		}
		$result = mysqli_query($db_link, $sql);
		$count=3;
		while($row_result=mysqli_fetch_assoc($result)){
			if($count%3==0){
				echo('<div class="container"><div class="row">');
			}
			if($row_result['status']==0){
				$pro_status="未完成";
				echo('<div class="col-sm-4" onclick="gantt('.$row_result["pro_id"].');"><div class="panel panel-primary">');
			}
			else {
				$pro_status="已完成";
				echo('<div class="col-sm-4" onclick="gantt('.$row_result["pro_id"].');"><div class="panel panel-success">');
			}
			//echo('<div class="col-sm-4" onclick="gantt('.$row_result["pro_id"].');"><div class="panel panel-primary">');
			echo('<div class="panel-heading">'.$row_result["name"].'<br/>開始日期:'.$row_result["s_time"].'<br/>截至日期:'.$row_result["e_time"].'</div>');
			echo('</div></div>');
			
			if($count%3==2){
				echo('</div></div><br>');
			}
			$count++;
			
				
			//echo("<div class='check' onclick="gantt('.$row_result["pro_id"].');"></div><br/>");
		}
	}
	else if($obj==5){
		$today=$_POST['today'];
		$sql='INSERT INTO `project` (pro_owner,s_time) VALUES ("'.$uID.'" ,"'.$today.'")';
		$result = mysqli_query($db_link, $sql);
		$pID=mysqli_insert_id($db_link);
		$_SESSION["pID"]=$pID;
		
	}
	else{
		$pID=$_POST['pID'];
		$_SESSION["pID"]=$pID;
	}
	
?>
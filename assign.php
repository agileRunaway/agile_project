<?php
	session_start();
	include("conn.php");
	//需要的session
	//$_SESSION["pID"]="1";
	$_SESSION["dep_id"]="106";
	//$_SESSION["state"]="1";
	
	
	$pro_mem_id=$_SESSION["uID"];
	$pID=$_SESSION["pID"];
	$state=$_SESSION["state"];
	$dep_id=$_SESSION["dep_id"];
	
	$obj=(int)$_POST['obj'];
	
	//init
	if($obj==0){
	
		//顯示step or task
		//state=1 是pm
		if($state==3){
			$sql2 = 'SELECT * FROM `step` where `pro_id` ="' .$pID. '"';
			
			$result = mysqli_query($db_link, $sql2);

			while($row_result=mysqli_fetch_assoc($result)){
				echo "<tr id='step_".$row_result['step_id']."'>";
				echo("<td>".$row_result['name']."</td>");
				$sql3='SELECT department.name FROM `step` INNER JOIN `department` ON step.dep_id=department.dep_id where department.dep_id="'.$row_result['dep_id'].'"';
				$result1 = mysqli_query($db_link, $sql3);
				$row_result1=mysqli_fetch_assoc($result1);
				echo("<td>".$row_result1['name']."</td>");
				echo("<td>".$row_result['s_time']."</td>");
				echo("<td>".$row_result['e_time']."</td>");
				echo("<td>".$row_result['description']."</td>");
				echo("<td><input type='button' onclick='delstep(".$row_result['step_id'].",".$row_result['owner_id'].");' value='刪除'></td>");
				echo "</tr>";
				
			}
			//分割字元
			echo("|&|");
			
			$sql='SELECT * FROM `department` where `man_dep` IS NULL';
			$dep_result = mysqli_query($db_link, $sql);
			while($row_result=mysqli_fetch_assoc($dep_result)){
				echo('<option value=dep_"'.$row_result['dep_id'].'">'.$row_result['name'].'</option>');
			}
			//echo("|&|");
			
			
			//echo("<p style='color:#4d79ff; padding-left:40px; font-size'><b>".$_SESSION["PName"]."</b></p>");
			echo("|&|");
			echo($state);
			
		}
		// state=2 經理
		else if($state==2){
			$sql2 = 'SELECT step_id,name FROM `step` where `pro_id` ="' .$pID. '" AND owner_id ="' .$pro_mem_id. '"';
			$result = mysqli_query($db_link, $sql2);
			while($row_result=mysqli_fetch_assoc($result)){
				//echo($row_result['step_id']);
				$sql3 = 'SELECT * FROM `task` where `step_id` ="' .$row_result['step_id']. '"';
				$result1 = mysqli_query($db_link, $sql3);
				while($row_result1=mysqli_fetch_assoc($result1)){
					echo "<tr id='task_".$row_result1['task_id']."'>";
					echo("<td>".$row_result1['name']."</td>");
					echo("<td>");
					$sql4 = 'SELECT mem_name FROM `task_mem` where `task_id` ="' .$row_result1['task_id']. '"';
					$result2 = mysqli_query($db_link, $sql4);
					while($row_result2=mysqli_fetch_assoc($result2)){
						echo(" ".$row_result2['mem_name']." ");
						//$num=mysql_num_rows($result2);
						//echo(" & ");
					}
					echo("</td>");
					echo("<td>".$row_result1['s_time']."</td>");
					echo("<td>".$row_result1['e_time']."</td>");
					echo("<td>".$row_result1['description']."</td>");
					echo("<td><input type='button' onclick='deltask(".$row_result1['task_id'].");' value='刪除'></td>");
					echo "</tr>";
				}
			}
			echo("|&|");
			//找出在該project裡經理負責的step
			$sql2 = 'SELECT step_id,name FROM `step` where `pro_id` ="' .$pID. '" AND owner_id ="' .$pro_mem_id. '"';
			$result = mysqli_query($db_link, $sql2);
			while($row_result=mysqli_fetch_assoc($result)){
				
				echo('<option value="step_'.$row_result['step_id'].'">'.$row_result['name'].'</option>');
			}
			echo("|&|");
			
			//找出這經理底下的員工
			$sql='SELECT * FROM `member` where `dep_id` = '.$dep_id.'';
			$mem_result = mysqli_query($db_link, $sql);
			while($row_result=mysqli_fetch_assoc($mem_result)){
				echo('<option value="'.$row_result['mem_id'].'_'.$row_result['name'].'">'.$row_result['name'].'</option>');
			}
			echo("|&|");
			echo($state);
			
		}
	}
	//obj=1 find main_department
	else if($obj==1){
		
		$dep_sel=$_POST['dep_sel'];
		echo($dep_sel);
		$sql='SELECT * FROM `department` where `man_dep` = '.$dep_sel.'';
		$dep_result = mysqli_query($db_link, $sql);
		while($row_result=mysqli_fetch_assoc($dep_result)){
			$depid=$row_result['dep_id'];
			$manager=$row_result['manager'];
			echo('<option value="'.$row_result['name'].'_'.$depid.'_'.$manager.'">'.$row_result['name'].'</option>');
		}
	}
	//obj=2 insert task
	else if($obj==2){
		$PName=$_POST['PName'];
		$sday=$_POST['sday'];
		$eday=$_POST['eday'];
		$text_content=$_POST['text_content'];
		$memid=$_POST['memid'];
		$memname=$_POST['memname'];
		$stepid=$_POST['stepid'];
		
		
		$sql='INSERT INTO `task` (name , s_time , e_time , status , description , step_id) VALUES ("'.$PName.'","'.$sday.'","'.$eday.'","0","'.$text_content.'","'.$stepid.'")';
		$result = mysqli_query($db_link, $sql);
		
		$task_id=mysqli_insert_id($db_link);
		
		$sql2='INSERT INTO `task_mem` (task_id , s_time , e_time , status , mem_id , mem_name) VALUES ("'.$task_id.'","'.$sday.'","'.$eday.'","0","'.$memid.'","'.$memname.'")';
		$result2 = mysqli_query($db_link, $sql2);
		echo($result2);
		echo("|&|");
		echo($task_id);
		
	}
	//obj=3 insert step
	else if($obj==3){
		$PName=$_POST['PName'];
		$sday=$_POST['sday'];
		$eday=$_POST['eday'];
		$text_content=$_POST['text_content'];
		$depid=$_POST['depid'];
		$manager=$_POST['manager'];
		$sql0='SELECT pro_mem_id FROM project_member WHERE pro_id = "'.$pID.'" AND mem_id = "'.$manager.'"' ;
		$result0 = mysqli_query($db_link, $sql0);
		$num_rows = mysqli_num_rows($result0);
		if($num_rows==0){
			$sql1='INSERT INTO `project_member` (pro_id , mem_id  , s_time , e_time , status , Permission) VALUES ("'.$pID.'" ,"'.$manager.'" , "'.$sday.'","'.$eday.'","0","2")';
			$result1 = mysqli_query($db_link, $sql1);
		}
		$sql='INSERT INTO `step` (owner_id , name , dep_id , s_time , e_time , pro_id , seq, description) VALUES ("'.$manager.'" ,"'.$PName.'" , '.$depid.',"'.$sday.'","'.$eday.'","'.$pID.'","1","'.$text_content.'")';
		$result = mysqli_query($db_link, $sql);
		echo($result);
		$step_id=mysqli_insert_id($db_link);
		echo("|&|");
		echo($step_id);
	}
	//delete task
	else if($obj==4){
		$task_id=$_POST['task_id'];
		$sql='DELETE FROM task WHERE task_id = '.$task_id.'';
		$result = mysqli_query($db_link, $sql);
		$sql1='DELETE FROM task_mem WHERE task_id = '.$task_id.'';
		$result1 = mysqli_query($db_link, $sql1);
		echo($result1);
		
	}
	//delete step
	else if($obj==5){
		$step_id=$_POST['step_id'];
		$owner_id=$_POST['owner_id'];
		$sql='SELECT * FROM task where step_id ='.$step_id.'';
		$result = mysqli_query($db_link, $sql);
		
		$num_rows = mysqli_num_rows($result);
		if($num_rows==0){
			$sql1='DELETE FROM step WHERE step_id = '.$step_id.'';
			$result1 = mysqli_query($db_link, $sql1);
			echo($result1);
		}
		else{
			echo('0');
		}
		
		$sql2='SELECT name FROM step WHERE pro_id ='.$pID.' AND owner_id = '.$owner_id.'';
		$result2 = mysqli_query($db_link, $sql2);
		$num_rows2 = mysqli_num_rows($result2);
		if($num_rows2 == 0){
			$sql3='DELETE FROM project_member WHERE pro_id ='.$pID.' AND mem_id = '.$owner_id.'';
			$result3 = mysqli_query($db_link, $sql3);
			
		}
	}
	//build gantt
	else if($obj==6){
		$sql = 'SELECT * FROM `step` where `pro_id` ="' .$pID. '"';
		$result = mysqli_query($db_link, $sql);
		while($row_result=mysqli_fetch_assoc($result)){
			//echo('{id:'.$row_result['step_id'].' ,name:"'.$row_result['name'].'", series: [');
			echo($row_result['step_id']);
			echo("|&$|");
			echo($row_result['name']);
			echo("*&*");
			
			$stime=str_replace("-",",",$row_result['s_time']);
			$etime=str_replace("-",",",$row_result['e_time']);
			echo("all");
			echo("|&$|");
			echo($stime);
			echo("|&$|");
			echo($etime);
			echo("*&*");
			
			$sql2 = 'SELECT * FROM `task` where `step_id` ="' .$row_result['step_id']. '"';
			$result2 = mysqli_query($db_link, $sql2);
			
			while($row_result2=mysqli_fetch_assoc($result2)){
				$stime=str_replace("-",",",$row_result2['s_time']);
				$etime=str_replace("-",",",$row_result2['e_time']);
				//echo('{name:"'.$row_result2['name'].'", start:new Date('.$stime.'), end:new Date('.$etime.')},');
				echo($row_result2['name']);
				echo("|&$|");
				echo($stime);
				echo("|&$|");
				echo($etime);
				echo("|&$|");
				if($row_result2['status']==0){
					
					echo("green");
				}
				else if($row_result2['status']==1){
					
					echo("yellow");
					
				}
				else{
					echo("#f0f0f0");
				}
				echo("|&$|");
				echo($row_result2['task_id']);
				echo("*&*");
				
			}
			echo("|&|");
		}
		echo('$$#$$');
		echo($state);
		
	}
	
	else if($obj==7){
		$tID=$_POST['taskid'];
		$_SESSION["tID"]=$tID;
	}
	else if($obj==8){
		$sql = 'SELECT * FROM `project` where `pro_id` ="' .$pID. '" ';
		$result = mysqli_query($db_link, $sql);
		
		while($row_result=mysqli_fetch_assoc($result)){
			echo('<p>專案名稱:'.$row_result["name"].'  截至日期:'.$row_result["e_time"].'  spec:'.$row_result["spec"].'</p>');
			echo('<input type="button" id="up_but" onclick="update_but(\''.$row_result["name"].'\',\''.$row_result["e_time"].'\',\''.$row_result["spec"].'\');" value="修改">');
			$_SESSION["PName"]=$row_result["name"];
			/*
			echo('<p>截至日期:'.$row_result["e_time"].'</p>');
			echo('<p>spec:</p><a>'.$row_result["spec"].'</a>');*/
		}
	}
	else if($obj==9){
		$PName=$_POST['PName'];
		$eday=$_POST['eday'];
		$spec=$_POST['spec'];
		$sql = 'UPDATE project SET name = "'.$PName.'",e_time = "'.$eday.'",spec = "'.$spec.'" WHERE pro_id = '.$pID.'';
		$result = mysqli_query($db_link, $sql);
		//echo mysqli_errno($db_link) . ": " . mysqli_error($db_link) . "\n";
	}
	
	
	
  ?>


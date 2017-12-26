<?php
    require("conn.php");
    if (!isset($_POST['content']) || empty($_POST['content'])){
        echo "請輸入留言訊息！";
        return;
    }
    $sql_query = "SELECT pm.pro_mem_id FROM task t,step s,project p,project_member pm,member m 
    where t.task_id=".$_POST['tid']." and t.step_id=s.step_id and 
    s.pro_id=pm.pro_id and pm.mem_id=m.mem_id and m.mem_id=".$_POST['uid']."";
    $result = mysqli_query($db_link,$sql_query);
    //$numRow = mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    //echo $row['pro_mem_id'];
   // VALUES ('Cardinal', 'Tom B. Erichsen', 'Skagen 21', 'Stavanger', '4006', 'Norway');
    $sql_query = "insert into chat(content,time,pro_mem_id,task_id)VALUES('".$_POST['content']."','".$_POST['date']."','".$row['pro_mem_id']."','".$_POST['tid']."');";
    if( mysqli_query($db_link,$sql_query)){
        echo "1";    
        return;
    }
    else{
        echo "2";
        return;
    }
?>

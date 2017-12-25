<?php
    include("Member_menu.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">  
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>Sort a HTML Table Alphabetically</title>
    <style>
        .t{
            border-spacing: 0;
            width: 90%;
            border: 1px solid #ddd;
            text-align: center;
            position:relative;
            left:5%;
        }

        th, td {
            text-align: center;
            padding: 16px;
            align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #DCDCDC
        }
        .btn-group{
            position:relative;
            left:70%;
            text-align: center;
            display:inline;
        }
        .f{
            position:relative;
            left:-5%; 
            display:inline; 
            font-size : 30px;  
        }
        .b{
            position:relative;
            left:-3%; 
            display:inline; 
            font-size : 20px;       
        }
</style>
</head>
    <body>
    <content>
    </br>
        <select class="f" name="number" id="number">
         <option selected value='1'>專案名稱</option>
        <option value='2'>任務名稱</option>
         <option value='3'>起始日期</option>
          <option value='4'>到期日期</option>
          <option value='5'>狀態</option>
        </select>
        <button class="b btn btn-warning" onclick="sortTable()">Sort</button>
        <div class="btn-group">
            <button type="button" class="btn btn-success btn-filter" data-target="未完成">未完成</button>
            <button type="button" class="btn btn-warning btn-filter" data-target="審核中">審核中</button>
            <button type="button" class="btn btn-danger btn-filter" data-target="已完成">已完成</button>
            <button type="button" class="btn btn-default btn-filter" data-target="全部">全部</button>
        </div>
        <table id="myTable" class="t">
          <tr>
            <th>專案名稱</th>
            <th>任務名稱</th>
            <th>起始日期</th>
            <th>到期日期</th>
            <th>回報進度</th>
            <th>任務連結</th>
            <th>狀態</th>
        </tr>
        <?php
            require("conn.php");
            $sql_query = "SELECT t.name as n,p.name as pn,tm.status as a,tm.s_time,tm.e_time,t.space,t.task_id FROM task t,task_mem tm,step s,project p where t.task_id=tm.task_id and tm.mem_id=".$_SESSION['uID']." and s.step_id=t.step_id and s.pro_id=p.pro_id";
            //$sql_query = "SELECT * FROM task where task_id IN (select `task_id` from `task_mem` WHERE `mem_id`='".$_SESSION['uID']."');";
            $result = mysqli_query($db_link,$sql_query);
            $numRow = mysqli_num_rows($result);
            foreach ($result as $row ){
                //$state=$row['a']=='1' ? "未完成": $row['a']=='2' ? "審核中" : "已完成";
               if($row['a']=='1')
                   $state="未完成";
                else if($row['a']=='2')
                    $state="審核中";
                else
                    $state="審核中";
                echo "<tr><td>".$row['pn']."</td><td>".$row['n']."</td><td>".$row['s_time']."</td><td>".$row['e_time']."</td><td><button style ='color: blue' onclick=window.location.href='detail.php?id=".$row['task_id']."'>回報進度</button></td><td><button style ='color: red; blackgroud-color : #DCDCDC'onclick=window.location.href='".$row['space']."'>連結網址</button></td><td>".$state."</td></tr>";
            }
        ?>
        </table>
    </content>
<script type="text/Javascript">

    function sortTable() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("myTable");
        switching = true;
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.getElementsByTagName("TR");
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[document.getElementById("number").value];
            y = rows[i + 1].getElementsByTagName("TD")[document.getElementById("number").value];
            //check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch= true;
                break;
            }
            }
            if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            }
        }
    };
</script>
 <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/Javascript">
$(document).ready(function() {
    $('.btn-filter').on('click', function () {
         var $target = $(this).data('target');
         if ($target != '全部') {
            $('.table tr').css('display', 'none');
            $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
        } else {
            $('.table tr').css('display', 'none').fadeIn('slow');
         }
    });
  }
 </script>

</body>
</html>

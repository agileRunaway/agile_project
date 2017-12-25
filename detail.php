<?php
    include("Member_menu.php");
?>
<html lang="en">
     <link rel="stylesheet" href="watch.css">
     <meta charset="utf-8">
    <style type="text/css">
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
            height :20px;
        }

        .a tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .a tr:nth-child(odd) {
            background-color: #DCDCDC
        }
    </style>    
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
    require("conn.php");
    echo "</br>";
    $task_ID = htmlspecialchars($_GET['id']);
    echo "<table id='myTable' class='t'>";
    $sql_query = "SELECT t.name as n,p.name as pn,t.status as a,tm.s_time,t.e_time,t.space FROM task t,task_mem tm,step s,project p where t.task_id=tm.task_id and tm.mem_id=".$_SESSION['uID']." and s.step_id=t.step_id and s.pro_id=p.pro_id and t.task_id=".$task_ID."";
    $result = mysqli_query($db_link,$sql_query);
    $row=mysqli_fetch_array($result);
    echo "<tr><td class 'a'>專案名稱 :</td><td>".$row['pn']."</td></tr>";
    echo "<tr><td class 'a'>任務名稱： </td><td>".$row['n']."</td></tr>";
    echo "<tr><td class 'a'>開始日期 </td><td>".$row['e_time']."</td></tr>";
    echo "<tr><td class 'a'>截止日期：</td><td>".$row['s_time']."</td></tr>";
    echo "<tr><td class 'a'>程式資料夾：</td><td>".$row['space']."</td></tr>";
    echo "<tr><td>主管姓名</td><td>".$row['pn']."</td></tr>";
    echo "</table>";

    echo "<table class='table'><tr>";
    echo "<td class='td'>文章作者:</td>";
    echo "<td class='user'>jeff</td></tr><tr>";
    echo "<td rowspan='3'></td>";
    echo "<td class='time'>"."留言日期 ：2017-12-21<br/><hr style='border-color: #BDB76B'/></td></tr><tr>";
    echo "<td class='content'>期末大爆炸</td></tr>";
    echo "<br/><br/>";
?>
<script type="text/Javascript">
         $(document).ready(function() {
        $("#save").click(function() {
          var d=new Date();
          var YMD=d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
          //$("#insert").html("<hr style='border-color: #BDB76B'/>");
                    $.ajax({
                        url: "get_chat.php",
                        data: {
                            state: '4',
                            content : $("#text").val(),
              star : $("select[name='point']").val(),
              date : YMD,
              pid : $("#pid").val(),
              uid : $("#uid").val()
                        },
                        type:"POST",
                        dataType:'json',
                        success: function(data) {
              if(data.msg=="1")
                  $("#insert").html("<table class='table'><tr><td class='td'>使用者:</td><td class='user'>"+$("#name").val()+"</td></tr><tr><td rowspan='3'></td><td class='time'>評論日期 ："+YMD+"<br/><hr style='border-color: #BDB76B'/></td></tr><tr><td class='content'>"+$("#text").val()+"</td></tr><br/><br/>");
              else if(data.msg=="2")
                 $("#error").html("寫入資料庫錯"); 	
              else 
                $("#error").html(data.msg); 	
                        },
                        error: function(jqXHR) {
                            document.write("發生錯誤: " + jqXHR.status);
                        }
                    })
                })
      })
    </script>
</body>
</html>
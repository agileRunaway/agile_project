<html>
<head>
    <style>
        .m{
            width: 100%;
        }
        .m table{
            width: 100%;
            border-collapse: collapse;
        }
        .m .btner:hover{
            background-color: #5194c8;
        }
        .m td{
            background-color: #2a5d84;
            font-family: "Arial", "微軟正黑體";
            padding: 10px;
            color: white;
            text-align: center;
            border: 0px;
            width: 120px;
            height:40px;
        }
        .m a{
            /*padding: 10px;*/
            padding-top: 10px;
            padding-bottom: 10px;
            color: #ffffff;
            text-decoration: white underline;
            height:27px;
        }
    </style>
</head>
<body style="margin: 0px; background-color: #d8e7f3">


<?php


include("session.php");
echo "<div class='m'>";
echo "<table class='c'>";
echo "<td class='btner'><a href='rd_main.php'>主畫面</a></td>";
echo "<td class='btner'><a href='homePage.html'>專案版面</a></td>";
echo "<td style='width: 20px'>||</td>";
echo "<td style='width: 180px'>你好，<p id='usename' class='btn'>".$_SESSION['name']."</p></td>";
echo "<td class='btner' style='width: 50px'><a href='logout.php'>登出</a></td>";
echo "</table>";
echo "</div>";

?>
</body>

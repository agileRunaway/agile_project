<?php
// 設置資料類型 json，編碼格式 utf-8
//header("Content-Type:text/html; charset=utf-8");
// 判斷如果是 GET 請求，則進行搜尋；如果是 POST 請求，則進行新建
// $_SERVER['REQUEST_METHOD'] 返回訪問頁面使用的請求方法
if ($_POST['state']=='1'){
    search();
}
if($_POST['state']=='2'){
    create();
}
function search(){
    // 檢查是否有員工編號的參數
    // isset() 方法檢測變數是否設置；empty() 方法判斷值是否為空
    // 超全域變數 $_GET 和 $_POST 用於收集表單資料
    if (!isset($_POST['number']) || empty($_POST['number'])) {
        echo "沒有輸入員工編號";
        return;
    }
    else {
        //$GET['number']='1';
       $sql_query = "SELECT * FROM `member` WHERE `mem_id`='".$_POST['number']."';";
       include "conn.php";
       if ($result = mysqli_query($db_link,$sql_query)) {
            if ($row=mysqli_fetch_array($result)) {
                $_POST['name']=$row['name'];
                $n='員工姓名 ：';
                $b=$row['name'];
                echo $n.$b;
                return;
            }
        }
    }
    echo "沒有該員工"; 
}
function create() {
    // 如果員工資料未填寫完全
    if (!isset($_POST['name']) || empty($_POST['name']) ||
        !isset($_POST['supervisor']) || empty($_POST['supervisor']) ||
        !isset($_POST['password']) || empty($_POST['password']) ||
        !isset($_POST['confirm']) || empty($_POST['confirm']) ||
        !isset($_POST['role']) || empty($_POST['role']) ||
        !isset($_POST['dep']) || empty($_POST['dep'])) {
            echo "員工資料未填寫完全";
            return;
        }
    elseif($_POST['password'] != $_POST['confirm']){
        echo "密碼與確認不相同";
        return;
    }
    else{
        include "conn.php";
        $name=mysqli_real_escape_string($db_link,$_POST['name'] );
        $visor=mysqli_real_escape_string($db_link,$_POST['supervisor']);
        $pwd=mysqli_real_escape_string($db_link,$_POST['password']);
        $state=mysqli_real_escape_string($db_link,$_POST['role']);
        $dep=mysqli_real_escape_string($db_link,$_POST['dep']);
        $sql="select max(mem_id)+1 as s from member";
        $tmp = mysqli_query($db_link,$sql);
        $row=mysqli_fetch_array($tmp);
        $id=$row['s'];
        $sql="insert into member(mem_id,name,Supervisor,password,id_state,dep_id)values('$id','$name','$visor','$pwd','$state','$dep');";
        if ($result = mysqli_query($db_link,$sql)) {//成功
            echo "s";
            return;
        }
        else{
            echo "f";
            return;
        }
    }
    //echo json_encode(array('name' => $_POST['name']));
}
?>
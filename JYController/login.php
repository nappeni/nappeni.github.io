<?php
//로그인
require_once("../lib_inc.php");
//로그인 값 받아오기
$id = $_POST["id"];
$password = $_POST["passwdBlind"];
//db
$sql_query = "SELECT idx, mt_id, mt_level, mt_name FROM member_t WHERE mt_id = '".$id."' AND mt_pwd = PASSWORD('".$password."') ";
$DB = new DB();
$DB -> __construct();
$result = $DB -> select_query($sql_query,0);
$DB ->close();
if($result){
    foreach($result as $row);
    if($row['mt_level']!=1){
        $_SESSION['mt_idx'] = $row['idx'];
        $_SESSION['mt_id'] = $row['mt_id'];
        $_SESSION['mt_name'] = $row['mt_name'];

        if($_POST['url']){
            p_gotourl($_POST['url']);
        }else{
            p_gotourl("../index.php");
        }

    }else{
        p_alert("탈퇴한 회원입니다.","../login.php");
    }
}else{
    $_SESSION['test'] = 0;
    p_gotourl("../login.php");
}
?>
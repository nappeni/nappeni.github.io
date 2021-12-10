<?php 
//회원 탈퇴
require_once("../lib_inc.php");
$secessionArr = array(
    mt_level => 1,
    mt_rdate => 'now()'
);
$query = "mt_id='".$_SESSION['mt_id']."'";
$DB = new DB;
$DB -> __construct();
$updateResult = $DB -> update_query('member_t',$secessionArr,$query,0);
$DB -> close();
if($updateResult == ture){
    session_unset();
    session_destroy();
    unset($_SESSION);
    $result['success'] = 1;
    echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}else{
    $result['success'] = 0;
    echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>
<?php
require_once("../lib_inc.php");

$userId = $_SESSION['changpw_id'];
unset($_SESSION['changpw_id']);
$changePasswd = $_POST['passwdBlind'];
$sql_query = "UPDATE member_t SET mt_pwd = PASSWORD('".$changePasswd."') WHERE mt_id = '".$userId."'";
$DB = new DB();
$DB-> __construct();
$SqlResult = $DB->db_query($sql_query,0);
$DB->close();
if($SqlResult){
    $result['success'] = 1;
    echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>
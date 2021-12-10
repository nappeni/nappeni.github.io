<?php
include "../lib_inc.php";

$qstr = $_POST['qstr'];
$cate1 = $_POST['cate1'];
$strcode = $_POST['code_register1'];
$txt_memo = nl2br($_POST['txt_memo']);
$txt_memo = str_replace("'","\'",$txt_memo);
$txt_memo = str_replace('"','\"',$txt_memo);
$d_datetime = date("Y-m-d H:i:s");

$sql_common = "cate1 = '{$cate1}', ";
$sql_common .= "strcode = '{$strcode}', ";
$sql_common .= "txt_memo = '{$txt_memo}', ";
$sql_common .= "d_datetime = '{$d_datetime}' ";

if($_POST['w']==""){
    $sql = "insert into d_refunt set ";
    $sql .= $sql_common;
    $DB->db_query($sql);
    $idx = $DB->insert_id();
}else{
    $idx = $_POST['idx'];
    $sql = "update d_refunt set ";
    $sql .= $sql_common;
    $sql .= "where idx = '{$idx}' ";
    $DB->db_query($sql);
}
//echo $idx;
gotourl('./refund_form_domestic.php?w=u&idx='.$idx."&".$qstr);
?>
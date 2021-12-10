<?php
include "../lib_inc.php";
$idx = $_POST['idx'];
$qstr = $_POST['qstr'];

$od_status = $_POST['od_status'];
$ot_memo = nl2br($_POST['ot_memo']);
$ot_memo = str_replace("'","\'",$ot_memo);
$ot_memo = str_replace('"','\"',$ot_memo);

$ot_updatedt = date("Y.m.d H:i:s");

$sql = "update order_domestic set ";
$sql .= "od_status = '{$od_status}', ";
$sql .= "ot_memo = '{$ot_memo}', ";
$sql .= "ot_updatedt = '{$ot_updatedt}' ";
$sql .= "where idx = '{$idx}' ";
$DB->db_query($sql);

p_gotourl("./order_form.php?"."idx=".$idx."&".$qstr);
?>
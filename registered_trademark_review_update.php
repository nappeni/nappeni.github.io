<?php
include "./lib_inc.php";
$idx = $_POST['idx'];
$pg = $_POST['pg'];

$rv_subject = str_replace("'","\'",$_POST['rv_subject']);
$rv_subject = str_replace('"','\"',$rv_subject);
$rv_subject = nl2br($rv_subject);

$rv_content = str_replace("'","\'",$_POST['rv_content']);
$rv_content = str_replace('"','\"',$rv_content);
$rv_content = nl2br($rv_content);

$sql = "update d_app_domestic_item set ";
$sql .= "rv_subject = '{$rv_subject}', ";
$sql .= "rv_content = '{$rv_content}' ";
$sql .= "where idx = '{$idx}' ";
$DB->db_query($sql);

alert("상표 등록 후기가 등록되었습니다.","./registered_trademark_list.php?pg=".$pg);
?>
<?php
include "./lib_inc.php";

$app_idx = $_POST['app_idx'];
$app_item_idx = $_POST['app_item_idx'];
$d_status = $_POST['d_status'];
$pg = $_POST['pg'];
$code_sale = $_POST['code_sale'];

if($d_status==4){
    $sql = "update d_app_domestic_item set ";
    $sql .= "d_status = '5' ";
    $sql .= "where app_idx = '{$app_idx}' and idx = '{$app_item_idx}' ";
    $DB->db_query($sql);
}else if($d_status==6){
    $sql = "update d_app_domestic_item set ";
    $sql .= "d_status = '7' ";
    $sql .= "where app_idx = '{$app_idx}' and idx = '{$app_item_idx}' ";
    $DB->db_query($sql);
}else if($d_status==8){
    $sql = "update d_app_domestic_item set ";
    $sql .= "d_status = '7' ";
    $sql .= "where app_idx = '{$app_idx}' and idx = '{$app_item_idx}' ";
    $DB->db_query($sql);
}else if($d_status==13){

}

if($code_sale){
    $sqla = "select * from discount_code_t where d_code_name = '{$code_sale}' ";
    $rowa = $DB->fetch_assoc($sqla);
    if($rowa['idx']){
        $d_num = $rowa['d_num']-1;
        $sqla = "update discount_code_t set d_num = '{$d_num}' where idx = '{$rowa['idx']}' ";
        $DB->db_query($sqla);

        $sqla = "update d_app_domestic_item set code_sale = '{$code_sale}' where idx = '{$app_item_idx}' ";
        $DB->db_query($sqla);
    }
}

gotourl("./completed_application_view.php?idx=".$app_item_idx."&pg=".$pg);
?>
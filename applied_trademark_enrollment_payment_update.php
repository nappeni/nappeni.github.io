<?php
include "./lib_inc.php";
$app_idx = $_POST['app_idx'];
$app_item_idx = $_POST['app_item_idx'];
$ot_mode = $_POST['ot_mode'];
$pg = $_POST['pg'];
if($ot_mode==8){
    $sale_price_point = $_POST['sale_price_point'];
    $sale_price_sum = $_POST['sale_price_sum'];
    $sum_price = $_POST['sum_price'];
    $pay_price = $_POST['pay_price'];
    $price_sdb1 = $_POST['price_sdb1'];
    $price_sdb2 = $_POST['price_sdb2'];
    $price_period1 = $_POST['price_period1'];
    $price_period2 = $_POST['price_period2'];
    $ot_use_point = $_POST['ot_use_point'];

    $period = $_POST['period'];
    $dt_register_complete = $_POST['dt_register_complete'];

    $regit_mt_name = $_POST['regit_mt_name'];
    $regit_mt_addr1 = $_POST['regit_mt_addr1'];
    $regit_mt_addr2 = $_POST['regit_mt_addr2'];
    $regit_mt_addr3 = $_POST['regit_mt_addr3'];
    $regit_mt_hp = str_replace("-","",$_POST['regit_mt_hp']);

    $regit_pay_method = $_POST['regit_pay_method'];


    $sql = "update d_app_domestic_item set ";
    $sql .= "period = '{$period}', ";
    $sql .= "price_period1 = '{$price_period1}', ";
    $sql .= "price_period2 = '{$price_period2}', ";
    $sql .= "price_sdb1 = '{$price_sdb1}', ";
    $sql .= "price_sdb2 = '{$price_sdb2}', ";
    $sql .= "regit_mt_name = '{$regit_mt_name}', ";
    $sql .= "regit_mt_addr1 = '{$regit_mt_addr1}', ";
    $sql .= "regit_mt_addr2 = '{$regit_mt_addr2}', ";
    $sql .= "regit_mt_addr3 = '{$regit_mt_addr3}', ";
    $sql .= "regit_mt_hp = '{$regit_mt_hp}', ";
    $sql .= "regit_pay_method = '{$regit_pay_method}', ";
    $sql .= "dt_register_complete = '{$dt_register_complete}' ";
    $sql .= "where idx = '{$app_item_idx}'  ";
    $DB->db_query($sql);

    gotourl("./completed_application_view.php?idx=".$app_item_idx."&pg=".$pg);


}else{
    alert("잘못된 접근입니다. ot_mode");
}
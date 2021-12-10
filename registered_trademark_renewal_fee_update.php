<?php
include "./lib_inc.php";
$app_idx = $_POST['app_idx'];
$app_item_idx = $_POST['app_item_idx'];
$ot_mode = $_POST['ot_mode'];
$pg = $_POST['pg'];

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

$dt_renewal = date("Y.m.d");

$sql = "update d_app_domestic_item set ";
$sql .= "period_renewal = '{$period}', ";
$sql .= "price_renewal = '{$pay_price}', ";
$sql .= "use_point = '{$ot_use_point}', ";
$sql .= "paymethod_renewal = '{$regit_pay_method}', ";
$sql .= "dt_renewal = '{$dt_renewal}' ";
$sql .= "where idx = '{$app_item_idx}'  ";
$DB->db_query($sql);

gotourl("./completed_application_view.php?idx=".$app_item_idx."&pg=".$pg);
?>

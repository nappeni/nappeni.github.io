<?php
include "../lib_inc.php";

$chk = $_POST['chk'];
for ($i=0; $i<count($chk); $i++){
    $k = $_POST['chk'][$i];
    $sql = "delete from d_app_domestic where idx = '{$_POST['idx'][$k]}' ";
    $DB->db_query($sql);
    $sql = "select count(*) as cnt from d_app_domestic";
    $row = $DB->fetch_assoc($sql);
    $sql = "ALTER TABLE d_app_domestic AUTO_INCREMENT={$row['cnt']} ";
    $DB->db_query($sql);

    $sql = "delete from d_app_domestic_item where app_idx = '{$_POST['idx'][$k]}' ";
    $DB->db_query($sql);
    $sql = "select count(*) as cnt from d_app_domestic_item";
    $row = $DB->fetch_assoc($sql);
    $sql = "ALTER TABLE d_app_domestic_item AUTO_INCREMENT={$row['cnt']} ";
    $DB->db_query($sql);

    $sql = "delete from d_app_domestic_history where app_idx = '{$_POST['idx'][$k]}' ";
    $DB->db_query($sql);
    $sql = "select count(*) as cnt from d_app_domestic_history";
    $row = $DB->fetch_assoc($sql);
    $sql = "ALTER TABLE d_app_domestic_history AUTO_INCREMENT={$row['cnt']} ";
    $DB->db_query($sql);

    $sql = "delete from order_domestic where app_idx = '{$_POST['idx'][$k]}' ";
    $DB->db_query($sql);
    $sql = "select count(*) as cnt from order_domestic";
    $row = $DB->fetch_assoc($sql);
    $sql = "ALTER TABLE order_domestic AUTO_INCREMENT={$row['cnt']} ";
    $DB->db_query($sql);
}
gotourl("./app_domestic_list.php");
?>
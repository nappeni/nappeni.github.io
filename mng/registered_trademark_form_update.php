<?php
include "../lib_inc.php";
$dt_renewal = str_replace("-",".",$_POST['dt_renewal']);
$sql = "update d_app_domestic_item set ";
$sql .= "dt_renewal = '{$dt_renewal}' ";
$sql .= "where idx = '{$_POST['app_item_idx']}' ";
$DB->db_query($sql);

gotourl('./registered_trademark_form.php?'.$_POST['qstr2'].$_POST['pg2']);
?>
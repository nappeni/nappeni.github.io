<?php
include "./lib_inc.php";
$result_num = 0;

$sql = "select * from d_app_domestic where mt_idx = '{$_SESSION['mt_idx']}' and app_status < 1 and d_datetime = '' ";
$dad = $DB->fetch_assoc($sql);

$app_idx = $dad['idx'];
$cate_ps1 = $_POST['cate_ps1'];
$cate_ps2_arr = $_POST['cate_ps2'];
$cate_s = $_POST['cate_s'];
if(count($cate_ps2_arr)>0){
    for($a=0; $a<count($cate_ps2_arr); $a++){
        $cate_ps2 = $cate_ps2_arr[$a];

        $sql = "insert into d_app_domestic_item set ";
        $sql .= "app_idx = '{$app_idx}', ";
        $sql .= "cate_ps1 = '{$cate_ps1}', ";
        $sql .= "cate_ps2 = '{$cate_ps2}', ";
        $sql .= "cate_s = '{$cate_s}' ";
        $DB->db_query($sql);

    }
}
$result_num = 1;
echo $result_num;
?>

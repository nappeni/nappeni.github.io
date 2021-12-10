<?php
include "../lib_inc.php";
$arr_idx = $_POST['idx'];
$arr_txt_cate = $_POST['txt_cate'];
$arr_price = $_POST['price'];
if(count($arr_idx)>0){
    for($a=0;$a<count($arr_idx);$a++){
        $sql = "update d_price_service set price = '{$arr_price[$a]}' where idx = '{$arr_idx[$a]}' ";
        $DB->db_query($sql);
    }
   p_gotourl("./priceofservice_list.php");
}else{
    p_alert("잘못된 접근입니다.","./priceofservice_list.php");
}
?>
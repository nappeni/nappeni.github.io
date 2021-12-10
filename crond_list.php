<?php
include "./lib_inc.php";
// 크론탭 이용


// -----------------------------------------
// 출원완료된지 하루 지난 국내 출원 상태값을 "심사중"으로 변경 (상품류별)
$sql = "select * from d_app_domestic where app_status = 6 and datediff(date_add(dt_complete,interval 1 day),date_format(now(),'%Y-%m-%d')) <= 0 ";
$dad_list = $DB->select_query($sql);
if(count($dad_list)>0){
    foreach ($dad_list as $dad){
        $sql = "select * from d_app_domestic_item where app_idx = '{$dad['idx']}' ";
        $dadi_list = $DB->select_query($sql);
        if(count($dadi_list)>0){
            foreach ($dadi_list as $dadi) {
                if($dadi['d_status']==1){
                    $sql = "update d_app_domestic_item set d_status = 2 ";
                    $DB->db_query($sql);

                    $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$dad['idx']}' and app_item_idx = '{$dadi['idx']}' and d_content = '심사중' ";
                    $row = $DB->fetch_assoc($sql);
                    $d_date = date("Y.m.d");
                    if($row['idx']){
                        $sql_h = "update d_app_domestic_history2 set ";
                        $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
                        $sql_h .= "app_idx = '{$dad['idx']}', ";
                        $sql_h .= "app_item_idx = '{$dadi['idx']}', ";
                        $sql_h .= "d_date = '{$d_date}', ";
                        $sql_h .= "d_content = '심사중' ";
                        $sql_h .= "where idx = '{$row['idx']}' ";
                        $DB->db_query($sql_h);
                    }else{
                        $sql_h = "insert into d_app_domestic_history2 set ";
                        $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
                        $sql_h .= "app_idx = '{$dad['idx']}', ";
                        $sql_h .= "app_item_idx = '{$dadi['idx']}', ";
                        $sql_h .= "d_date = '{$d_date}', ";
                        $sql_h .= "d_content = '심사중' ";
                        $DB->db_query($sql_h);
                    }
                }
            }
        }



    }
}
// -----------------------------------------


?>
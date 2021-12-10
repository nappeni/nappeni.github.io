<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
    if($_POST['act']=="input"){
        //할인코드 추가 
        $insertArr = array(
            'd_code_name' => $_POST['d_code_name'],
            'd_rate' => $_POST['d_rate'],
            'ct_sdate' => $_POST['stx_dt1'],
            'ct_edate' => $_POST['stx_dt2'],
            'd_num' => $_POST['d_num']
        );
        $result = $DB -> insert_query("discount_code_t",$insertArr,0);
        if($result){
            p_alert("추가되었습니다.","./discount_code_list.php");
        }
    }else if($_POST['act'] == "update"){
        $updateArr = array(
            'd_code_name' => $_POST['d_code_name'],
            'd_rate' => $_POST['d_rate'],
            'ct_sdate' => $_POST['stx_dt1'],
            'ct_edate' => $_POST['stx_dt2'],
            'd_num' => $_POST['d_num']
        );
        $where_query = "idx= '".$_POST['dc_idx']."'";
        $result = $DB -> update_query("discount_code_t",$updateArr, $where_query,0);
        if($result){
            p_alert("수정되었습니다.","./discount_code_list.php");
        }

    }else if($_POST['act'] == "select"){
        $select_query = "select d_code_name, ct_sdate, ct_edate, d_rate, d_num from discount_code_t where idx='".$_POST['idx']."'";
        $result = $DB -> select_query($select_query, 0);
        if($result){
            foreach($result as $row);
            $result['success'] = 1;
            $result['d_code_name'] = $row['d_code_name'];
            $result['d_rate'] = $row['d_rate'];
            $result['ct_sdate'] = $row['ct_sdate'];
            $result['ct_edate'] = $row['ct_edate'];
            $result['d_num'] = $row['d_num'];
        }else{
            $result['success'] = 0;
        }
        echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }else if($_POST['act']=="delete") {
        $delete_query = "idx='".$_POST['idx']."'";
        $result = $DB -> del_query("discount_code_t",$delete_query,0);
        if($result){
            echo "Y";
        }else{
            echo "N";
        }
    }else if($_POST['act']=="deletes"){
        $result = $_REQUEST['idx'];
        for($i=0; $i<count($result); $i++){
            $DB->del_query('discount_code_t', " idx = '".$result[$i]."'");
        }
        echo "Y";
    }
    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
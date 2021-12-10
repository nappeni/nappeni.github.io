<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
	$bt_file_num = 2;
	if($_POST['bt_show']=="") $_POST['bt_show'] = 'N';
    if($_POST['act']=="input") {
        $count = $DB->count_query("select COUNT(*) as ctn from banner_t where bt_show ='Y' and bt_type = 2",0);
        if((int)$count<8||$_POST['bt_show']=='N'){
            $insertArr = Array(
                "bt_type" => 2,
                "code_register1" => $_POST['code_register1'],
                "code_register2" => $_POST['code_register2'],
                "dt_register_complete" => $_POST['dt_register_complete'],
                "bt_file1" => $_POST['bt_file1'],
                "bt_rank" => $_POST['bt_rank'],
                "bt_txt" => $_POST['bt_txt'],
                "bt_show" => $_POST['bt_show']
            );
            $result = $DB->insert_query("banner_t",$insertArr,0);
            if($result){
                p_alert("등록되었습니다.","./success_list.php");
            }else{
                p_alert("등록에 실패하였습니다.","./success_form.php");
            }
        }else {
            p_alert("출력가능한 성공사례가 8개가 넘었습니다.","./success_form.php");
        }
	} else if($_POST['act']=="update"){
        $count = $DB->count_query("select COUNT(*) as ctn from banner_t where bt_show ='Y' and bt_type = 2",0);
        $bt_show = $DB->select_query("SELECT bt_show FROM banner_t WHERE idx = ".$_POST['bt_idx']."",0);
        foreach($bt_show as $row);
        if((int)$count<8||$_POST['bt_show']=='N'|| $row['bt_show']=='Y'){
            $updateArr = Array(
                "bt_rank" => $_POST['bt_rank'],
                "bt_txt" => $_POST['bt_txt'],
                "bt_show" => $_POST['bt_show']
            );
            $where_query = "idx=".$_POST['bt_idx'];
            $result = $DB->update_query("banner_t",$updateArr,$where_query,0);
            if($result){
                p_alert("수정되었습니다.","./success_list.php");
            }else{
                p_alert("수정에 실패하였습니다.","./success_list.php");
            }
        }else {
            p_alert("출력가능한 성공사례가 8개가 넘었습니다.","./success_list.php");
        }
	} else if($_POST['act']=="delete") {
        $DB->del_query('banner_t', " idx = '".$_POST['idx']."'");
        echo "Y";
    }else if($_POST['act']=="delete_those"){
        $result = $_REQUEST['idx'];
        for($i=0; $i<count($result); $i++){
            $DB->del_query('banner_t', " idx = '".$result[$i]."'");
        }
        echo "Y";
    } else if($_POST['act']=="getInfo"){
        $code_register1 = $_POST['code_register1'];
        $query = "SELECT app_idx, code_register2, dt_register_complete FROM d_app_domestic_item WHERE code_register1 = '".$code_register1."'";
        $results[] = $DB -> select_query($query,0);
        foreach($results[0] as $row);
        $query = "SELECT img_mark FROM d_app_domestic WHERE idx = '".$row['app_idx']."'";
        $results[] = $DB -> select_query($query,0);
        foreach($results[1] as $row1);
        if($results){
            $result['success'] = 1;
            $result['code_register2'] = $row['code_register2'];
            $result['dt_register_complete'] = $row['dt_register_complete'];
            $result['img_mark'] = $row1['img_mark'];
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }else{
            $result['success'] = 0;
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
    }

    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
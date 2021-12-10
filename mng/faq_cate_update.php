<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=="input") {
		unset($arr_query);
        $fc_name = str_replace("'","\'",$_POST['fc_name']);
        $fc_name = str_replace('"','\"',$fc_name);
		$arr_query = array(
			'fc_name' => $fc_name
		);

		$result = $DB->insert_query('cate_faq_t', $arr_query);
		if($result){
            echo 'Y';
        }
	} else if($_POST['act']=="select"){
        $sql = "select * from cate_faq_t where idx='".$_POST['idx']."'";
        $cate = $DB->fetch_query($sql);
        if($cate){
            $result['fc_idx'] = $cate['idx'];
            $result['success'] = 1;
            $result['fc_name'] = $cate['fc_name'];
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }else{
            $result['success'] = 0;
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
    } else if($_POST['act']=="update"){
        unset($arr_query);
        $fc_name = str_replace("'","\'",$_POST['fc_name']);
        $fc_name = str_replace('"','\"',$fc_name);
		$arr_query = array(
			'fc_name' => $fc_name
		);
		$where_query = "idx = '".$_POST['fc_idx']."'";

		$result = $DB->update_query('cate_faq_t', $arr_query, $where_query);

		if($result){
            echo 'Y';
        }
	} else if($_POST['act']=="delete") {
		$result = $DB->del_query('cate_faq_t', " idx = '".$_POST['idx']."'");
        if($result){
            echo "Y";
        }
	} else if($_POST['act']=="deleteThows"){
        $detArr = $_REQUEST['idx'];
        for($i=0; $i<count($detArr); $i++){
           $result = $DB -> del_query('cate_faq_t',"idx='".$detArr[$i]."'");
        }
        if($result){
            echo "Y";
        }

    }

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
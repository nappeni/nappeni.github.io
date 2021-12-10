<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=="input") {
		unset($arr_query);
        $fc_title = str_replace("'","\'",$_POST['fc_title']);
        $fc_title = str_replace('"','\"',$fc_title);
        $fc_content = str_replace("'","\'",$_POST['fc_content']);
        $fc_content = str_replace('"','\"',$fc_content);
		$arr_query = array(
			'fc_idx' => $_POST['fc_idx'],
            'ft_best' => $_POST['fc_best'],
            'ft_title' => $fc_title,
            'ft_content' => $fc_content
		);

		$result = $DB->insert_query('faq_t', $arr_query);
		if($result){
            echo 'Y';
        }
	} else if($_POST['act']=="select"){
        $sql = "select * from faq_t where idx='".$_POST['idx']."'";
        $cate = $DB->fetch_query($sql);
        if($cate){
            $result['success'] = 1;
            $result['idx'] = $cate['idx'];
            $result['fc_idx'] = $cate['fc_idx'];
            $result['ft_title'] = $cate['ft_title'];
            $result['ft_best'] = $cate['ft_best'];
            $result['ft_content'] = $cate['ft_content'];
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }else{
            $result['success'] = 0;
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
    } else if($_POST['act']=="update"){
		unset($arr_query);
		$arr_query = array(
			'fc_idx' => $_POST['fc_idx'],
			'ft_best' => $_POST['fc_best'],
			'ft_title' => $_POST['fc_title'],
			'ft_content' => $_POST['fc_content'],
		);

		$where_query = "idx = '".$_POST['idx']."'";

		$result = $DB->update_query('faq_t', $arr_query, $where_query);
        if($result){
            echo "Y";
        }
	} else if($_POST['act']=="delete") {
		$result = $DB->del_query('faq_t', " idx = '".$_POST['idx']."'");
        if($result){
            echo "Y";
        }
	} else if($_POST['act']=="deleteThows"){
        $detArr = $_REQUEST['idx'];
        for($i=0; $i<count($detArr); $i++){
           $result = $DB -> del_query('faq_t',"idx='".$detArr[$i]."'");
        }
        if($result){
            echo "Y";
        }

    }

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
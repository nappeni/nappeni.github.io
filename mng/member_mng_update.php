<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

    if($_POST['act']=="delete") {
		unset($arr_query);
		$arr_query = array(
			"mt_level" => 1,
		);
		$where_query = "idx = '".$_POST['mt_idx']."'";
		$DB->update_query('member_t', $arr_query, $where_query);
		echo "Y";
    }else if($_POST['act']=="deleteThows"){
        $result = $_REQUEST['idx'];
        unset($arr_query);
		$arr_query = array(
			"mt_level" => 1,
		);
        for($i=0; $i<count($result); $i++){
            $DB->update_query('member_t', $arr_query," idx = '".$result[$i]."'");
        }
        echo "Y";
    }else if($_POST['act']=="update"){
        unset($arr_query);
        $arr_query = array(
			"ad_msg" => $_POST['ad_msg'],
		);
		$where_query = "idx = '".$_POST['mt_idx']."'";
		$result = $DB->update_query('member_t', $arr_query, $where_query);
       if($result){
           p_alert("저장되었습니다.","./member_mng.php");
       }
    }
    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
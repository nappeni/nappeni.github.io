<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=='update') {
		unset($arr_query);
		$arr_query = array(
			"st_agree1" => $_POST['st_agree1'],
			"st_agree2" => $_POST['st_agree2'],
			"st_agree3" => $_POST['st_agree3'],
			"st_kakao_channel" => $_POST['st_kakao_channel'],
			"st_kakao_channel_time" => $_POST['st_kakao_channel_time'],
		);

		$where_query = "idx = '1'";

		$DB->update_query('setup_t', $arr_query, $where_query);

		p_alert("수정되었습니다.");
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
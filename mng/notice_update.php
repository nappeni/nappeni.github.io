<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['nt_hit']=="") $_POST['nt_hit'] = 0;
	if($_POST['nt_show']=="") $_POST['nt_show'] = 'N';

	if($_POST['act']=="input") {
		unset($arr_query);
		$arr_query = array(
			'nt_title' => $_POST['nt_title'],
			'nt_content' => $_POST['nt_content'],
			'nt_show' => $_POST['nt_show'],
			'nt_hit' => $_POST['nt_hit'],
			'nt_wdate' => "now()",
		);

		$DB->insert_query('notice_t', $arr_query);
		$_last_idx = $DB->insert_id();

		p_alert("등록되었습니다.", "./notice_list.php");
	} else if($_POST['act']=="update"){
		unset($arr_query);
		$arr_query = array(
			'nt_title' => $_POST['nt_title'],
			'nt_content' => $_POST['nt_content'],
			'nt_show' => $_POST['nt_show'],
			'nt_hit' => $_POST['nt_hit'],
		);

		$where_query = "idx = '".$_POST['nt_idx']."'";

		$DB->update_query('notice_t', $arr_query, $where_query);

		p_alert("수정되었습니다.");
	} else if($_POST['act']=="delete") {
		$DB->del_query('notice_t', " idx = '".$_POST['idx']."'");

		echo "Y";
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['mt_id']=="") p_alert("잘못된 접근입니다.");
	if($_POST['mt_pass']=="") p_alert("잘못된 접근입니다.");

	$query = "select * from member_t where mt_id = '".$_POST['mt_id']."' and mt_level > 8 and mt_status = 'Y'";
	$cnt = $DB->count_query($query);

	if($cnt<1) {
		p_alert("잘못된 접근입니다.");
	} else {
		$row = $DB->fetch_query($query);

		$query2 = "select password('".$_POST['mt_pass']."') as ps";
		$row2 = $DB->fetch_query($query2);

		if($row['mt_pwd'] != $row2['ps']) {
			p_alert("아이디 및 비밀번호가 올바르지 않습니다.\\n\\n아이디, 비밀번호는 대문자, 소문자를 구분합니다.\\n\\n<Caps Lock>키가 켜져 있는지 확인하시고 다시 입력하십시오.");
		}

		unset($arr_query);
		$arr_query = array(
			'mt_ldate' => "now()",
		);

		$where_query = "idx = '".$row['idx']."'";

		$DB->update_query('member_t', $arr_query, $where_query);

		$_mt_idx = $_SESSION['mt_idx'] = $row['idx'];
		$_mt_id = $_SESSION['mt_id'] = $row['mt_id'];
		$_mt_name = $_SESSION['mt_name'] = $row['mt_name'];
		$_mt_level = $_SESSION['mt_level'] = $row['mt_level'];

		p_gotourl("./");
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
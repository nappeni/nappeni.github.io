<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=='update') {
		unset($arr_query);
		$arr_query = array(
			"mt_name" => $_POST['mt_name'],
			"mt_hp" => $_POST['mt_hp'],
			"mt_tel" => $_POST['mt_tel'],
			"mt_smsing" => $_POST['mt_smsing'],
			"mt_mailing" => $_POST['mt_mailing'],
			"mt_status" => $_POST['mt_status'],
			"mt_admin_memo" => $_POST['mt_admin_memo'],
		);

		if($_POST['mt_pwd'] && $_POST['mt_pwd_re']) {
			if($_POST['mt_pwd']==$_POST['mt_pwd_re']) {
				$query2 = "select password('".$_POST['mt_pwd']."') as ps";
				$row2 = $DB->fetch_query($query2);

				$arr_query['mt_pwd'] = $row2['ps'];
			}
		}

		$where_query = "idx = '".$_POST['mt_idx']."'";

		$DB->update_query('member_t', $arr_query, $where_query);

		p_alert("수정되었습니다.");
	} else if($_POST['act']=='retire') {
		unset($arr_query);
		$arr_query = array(
			"mt_level" => '1',
			"mt_status" => 'N',
			"mt_rdate" => "now()",
			"mt_retire_memo" => "관리자 권한 회원탈퇴 처리",
		);

		$where_query = "idx = '".$_POST['mt_idx_t']."'";

		$DB->update_query('member_t', $arr_query, $where_query);

		echo "Y";
	} else if($_POST['act']=='return') {
		$query = "select * from member_t where idx = '".$_POST['mt_idx_t']."'";
		$row = $DB->fetch_query($query);

		if($row['mt_company']) {
			$mt_level_t = '5';
		} else {
			$mt_level_t = '2';
		}

		unset($arr_query);
		$arr_query = array(
			"mt_level" => $mt_level_t,
			"mt_status" => 'Y',
			"mt_rdate" => "0000-00-00 00:00:00",
			"mt_retire_memo" => "",
		);

		$where_query = "idx = '".$_POST['mt_idx_t']."'";

		$DB->update_query('member_t', $arr_query, $where_query);

		echo "Y";
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
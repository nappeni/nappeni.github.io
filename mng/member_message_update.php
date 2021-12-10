<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=="input") {
		$_POST['mmt_content'] = cut_str($_POST['mmt_content'], 0, 45);

		unset($arr_query);
		$arr_query = array(
			'mmt_title' => $_POST['mmt_title'],
			'mmt_content' => $_POST['mmt_content'],
			'mmt_mt_idx' => implode(',', $_POST['mmt_mt_idx']),
			'mmt_send' => $_POST['mmt_send'],
			'mmt_wdate' => "now()",
		);

		$DB->insert_query('member_message_t', $arr_query);
		$_last_idx = $DB->insert_id();

		if($_POST['mmt_send']=='Y') {
			$arr_mt_hp = array();
			if($_POST['mmt_mt_idx']) {
				foreach($_POST['mmt_mt_idx'] as $key => $val) {
					$mt_info = get_mem_info($val);

					if($mt_info['idx']) {
						$arr_mt_hp[] = $mt_info['mt_hp'];
					}
				}
			}

			$rtn = f_bizmsg_sms_batch_send($arr_mt_hp, $_POST['mmt_content']);
		}

		if($_POST['mmt_send']=='Y') {
			$arr_mt_hp = array();
			if($_POST['mmt_mt_idx']) {
				foreach($_POST['mmt_mt_idx'] as $key => $val) {
					$mt_info = get_mem_info($val);

					if($mt_info['idx']) {
						$arr_mt_hp[] = $mt_info['mt_hp'];
					}
				}
			}

			$rtn = f_bizmsg_sms_batch_send($arr_mt_hp, $_POST['mmt_content']);
		}

		if($rtn->status!='SMS_00') {
			p_alert("문자전송에 오류가 있습니다.");
		} else {
			p_alert("수정되었습니다.");
		}
	} else if($_POST['act']=="update"){
		$_POST['mmt_content'] = cut_str($_POST['mmt_content'], 0, 45);

		unset($arr_query);
		$arr_query = array(
			'mmt_title' => $_POST['mmt_title'],
			'mmt_content' => $_POST['mmt_content'],
			'mmt_send' => $_POST['mmt_send'],
			'mmt_mt_idx' => implode(',', $_POST['mmt_mt_idx']),
		);

		$where_query = "idx = '".$_POST['mmt_idx']."'";

		$DB->update_query('member_message_t', $arr_query, $where_query);

		if($_POST['mmt_send']=='Y') {
			$arr_mt_hp = array();
			if($_POST['mmt_mt_idx']) {
				foreach($_POST['mmt_mt_idx'] as $key => $val) {
					$mt_info = get_mem_info($val);

					if($mt_info['idx']) {
						$arr_mt_hp[] = $mt_info['mt_hp'];
					}
				}
			}

			$rtn = f_bizmsg_sms_batch_send($arr_mt_hp, $_POST['mmt_content']);
		}

		if($rtn->status!='SMS_00') {
			p_alert("문자전송에 오류가 있습니다.");
		} else {
			p_alert("수정되었습니다.");
		}
	} else if($_POST['act']=="delete") {
		$DB->del_query('member_message_t', " idx = '".$_POST['idx']."'");

		echo "Y";
	} else if($_POST['act']=="search_member") {
		if($_POST['stxt']) {
			unset($list);
			$query = "select * from member_t where mt_status = 'Y' and mt_level in (2, 5) and (instr(mt_id, '".$_POST['stxt']."') or instr(mt_name, '".$_POST['stxt']."')) order by mt_id asc, mt_name asc";
			$list = $DB->select_query($query);

			if($list) {
				foreach($list as $row) {
?>
			<li class="list-group-item d-flex justify-content-between align-items-center cursor-pointer" onclick="f_search_member_selected('<?=$row['idx']?>', '<?=$row['mt_name']?>', '<?=$row['mt_hp']?>');">
				<span class="pl-2 pb-2"><?=$row['mt_id']?> <?=$row['mt_name']?> (<?=$row['mt_hp']?>)</span>
			</li>
<?
				}
			}
		} else {
?>
			<li class="list-group-item d-flex justify-content-between align-items-center">
				<span class="pl-2 pb-2">검색어를 입력바랍니다.</span>
			</li>
<?
		}
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
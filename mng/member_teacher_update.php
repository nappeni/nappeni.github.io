<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	$mt_photo_num = 1;

	if($_POST['act']=='input') {
		if($_POST['mt_pwd']!=$_POST['mt_pwd_re']) {
			p_alert("비밀번호가 동일하지 않습니다. 확인바랍니다.");
			exit;
		}

		$query_s = "select password('".$_POST['mt_pwd']."') as ps";
		$row_s = $DB->fetch_query($query_s);

		unset($arr_query);
		$arr_query = array(
			'mt_id' => $_POST['mt_id'],
			'mt_name' => $_POST['mt_name'],
			'mt_level' => 5,
			'mt_iscom' => $_POST['mt_iscom'],
			'mt_teacher' => 'Y',
			'mt_status' => 'Y',
			'mt_pwd' => $row_s['ps'],
			'mt_hp' => $_POST['mt_hp'],
			'mt_company' => $_POST['mt_company'],
			'mt_profile' => $_POST['mt_profile'],
			'mt_company_info' => $_POST['mt_company_info'],
			'mt_wdate' => "now()",
		);

		$DB->insert_query('member_t', $arr_query);
		$_last_idx = $DB->insert_id();

		unset($arr_query);
		for($q=1;$q<=1;$q++) {
			$temp_img_txt = "mt_photo".$q;
			$temp_img_on_txt = "mt_photo".$q."_on";
			$temp_img_temp_on_txt = "mt_photo".$q."_temp_on";
			$temp_img_del_txt = "mt_photo".$q."_del";

			if($_FILES[$temp_img_txt]['name']) {
				$mt_photo = $_FILES[$temp_img_txt]['tmp_name'];
				$mt_photo_name = $_FILES[$temp_img_txt]['name'];
				$mt_photo_size = $_FILES[$temp_img_txt]['size'];
				$mt_photo_type = $_FILES[$temp_img_txt]['type'];

				if($mt_photo_name!="") {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
					$_POST[$temp_img_on_txt] = "mt_photo_".$_SESSION['_mt_idx_join']."_".$q.".".get_file_ext($mt_photo_name);
					upload_file($mt_photo, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
					$img_width_t = '1000';
					$img_height_t = '1000';
					thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", $img_width_t, $img_height_t);
				}
			} else {
				if($_POST[$temp_img_del_txt]) {
					unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
				}
			}

			$arr_query['mt_photo'.$q] = $_POST['mt_photo'.$q.'_on'];
		}

		if($arr_query) {
			$where_query = "idx = '".$_last_idx."'";

			$DB->update_query('member_t', $arr_query, $where_query);
		}

		p_alert("등록되었습니다.");
	} else if($_POST['act']=='update') {
		unset($arr_query);
		$arr_query = array(
			"mt_name" => $_POST['mt_name'],
			"mt_hp" => $_POST['mt_hp'],
			"mt_tel" => $_POST['mt_tel'],
			"mt_smsing" => $_POST['mt_smsing'],
			"mt_mailing" => $_POST['mt_mailing'],
			"mt_status" => $_POST['mt_status'],
			"mt_admin_memo" => $_POST['mt_admin_memo'],
			"mt_teacher" => $_POST['mt_teacher'],
			"mt_teacher_decline" => $_POST['mt_teacher_decline'],
			"mt_profile" => $_POST['mt_profile'],
			"mt_company" => $_POST['mt_company'],
			"mt_company_info" => $_POST['mt_company_info'],
		);

		if($_POST['mt_pwd'] && $_POST['mt_pwd_re']) {
			if($_POST['mt_pwd']==$_POST['mt_pwd_re']) {
				$query2 = "select password('".$_POST['mt_pwd']."') as ps";
				$row2 = $DB->fetch_query($query2);

				$arr_query['mt_pwd'] = $row2['ps'];
			}
		}

		if($_POST['mt_teacher']=='Y') {
			$arr_query['mt_status'] = 'Y';
		} else {
			$arr_query['mt_status'] = 'N';
		}

		$where_query = "idx = '".$_POST['mt_idx']."'";

		$DB->update_query('member_t', $arr_query, $where_query);
		$_last_idx = $_POST['mt_idx'];

		unset($arr_query_img);
		$arr_query_img = array();
		for($q=1;$q<=$mt_photo_num;$q++) {
			$temp_img_txt = "mt_photo".$q;
			$temp_img_on_txt = "mt_photo".$q."_on";
			$temp_img_temp_on_txt = "mt_photo".$q."_temp_on";
			$temp_img_del_txt = "mt_photo".$q."_del";

			if($_FILES[$temp_img_txt]['name']) {
				$mt_photo = $_FILES[$temp_img_txt]['tmp_name'];
				$mt_photo_name = $_FILES[$temp_img_txt]['name'];
				$mt_photo_size = $_FILES[$temp_img_txt]['size'];
				$mt_photo_type = $_FILES[$temp_img_txt]['type'];

				if($mt_photo_name!="") {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
					$_POST[$temp_img_on_txt] = "mt_photo_".$_last_idx."_".$q.".".get_file_ext($mt_photo_name);
					upload_file($mt_photo, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
					$img_width_t = '1000';
					$img_height_t = '1000';
					thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", $img_width_t, $img_height_t);
				}
			} else {
				if($_POST[$temp_img_del_txt]) {
					unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
				}
			}

			$arr_query_img['mt_photo'.$q] = $_POST['mt_photo'.$q.'_on'];
		}

		if($arr_query_img) {
			$where_query = "idx = '".$_last_idx."'";

			$DB->update_query('member_t', $arr_query_img, $where_query);
		}

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
		unset($arr_query);
		$arr_query = array(
			"mt_level" => '2',
			"mt_status" => 'Y',
			"mt_rdate" => "0000-00-00 00:00:00",
			"mt_retire_memo" => "",
		);

		$where_query = "idx = '".$_POST['mt_idx_t']."'";

		$DB->update_query('member_t', $arr_query, $where_query);

		echo "Y";
	} else if($_POST['act']=='mt_id_chk') {
		if($_POST['mt_id']=="") p_alert("잘못된 접근입니다. mt_id");

		$query = "select idx from member_t where mt_id = '".$_POST['mt_id']."'";
		$row = $DB->fetch_query($query);

		if($row['idx']) {
			echo "N";
		} else {
			echo "Y";
		}
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
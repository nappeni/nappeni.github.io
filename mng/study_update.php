<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	$st_file_num = 1;
	$st_data_num = 1;

	$chk_save_temp = false;
	if($_POST['st_status']=='1') {
		if($_POST['st_idx']=="") {
			$_POST['act'] = 'input';
		} else {
			$_POST['act'] = 'update';
		}
		$chk_save_temp = true;
	}

    if($_POST['act']=="input") {
		unset($arr_query);
		$arr_query = array(
			"mt_idx" => $_POST['mt_idx'],
			"mt_id" => $_POST['mt_id'],
			"mt_name" => $_POST['mt_name'],
			"mt_company" => $_POST['mt_company'],
			"mt_company_type" => $_POST['mt_company_type'],
			"st_status" => $_POST['st_status'],
			"st_type" => $_POST['st_type'],
			"st_title" => $_POST['st_title'],
			"st_ct_id" => $_POST['st_ct_id'],
			"st_ct_pid" => $_POST['st_ct_pid'],
			"st_time" => $_POST['st_time'],
			"st_price" => $_POST['st_price'],
			"st_round" => $_POST['st_round'],
			"st_zoom_link" => $_POST['st_zoom_link'],
			"st_zoom_info" => $_POST['st_zoom_info'],
			"st_delivery" => $_POST['st_delivery'],
			"st_age_min" => $_POST['st_age_min'],
			"st_age_max" => $_POST['st_age_max'],
			"st_attendance_min" => $_POST['st_attendance_min'],
			"st_attendance_max" => $_POST['st_attendance_max'],
			"st_memo" => $_POST['st_memo'],
			"st_content" => $_POST['st_content'],
			"st_caution" => $_POST['st_caution'],
			"st_contents_sdate" => $_POST['st_contents_sdate'],
			"st_contents_edate" => $_POST['st_contents_edate'],
			"st_contents_link" => $_POST['st_contents_link'],
			"st_contents_jaego" => $_POST['st_contents_jaego'],
			"st_contents_link_memo" => $_POST['st_contents_link_memo'],
			"st_data1_memo" => $_POST['st_data1_memo'],
			"st_web_url" => $_POST['st_web_url'],
			"st_web_url_memo" => $_POST['st_web_url_memo'],
			"st_youtube1" => $_POST['st_youtube1'],
			"st_youtube2" => $_POST['st_youtube2'],
			"st_youtube3" => $_POST['st_youtube3'],
			"st_youtube4" => $_POST['st_youtube4'],
			"st_youtube1_memo" => $_POST['st_youtube1_memo'],
			"st_youtube2_memo" => $_POST['st_youtube2_memo'],
			"st_youtube3_memo" => $_POST['st_youtube3_memo'],
			"st_youtube4_memo" => $_POST['st_youtube4_memo'],
			"st_open" => $_POST['st_open'],
			"st_wdate" => "now()",
		);

		$DB->insert_query('study_t', $arr_query);
		$_last_idx = $DB->insert_id();

		unset($arr_query_img);
		$arr_query_img = array();
		for($q=1;$q<=$st_file_num;$q++) {
			$temp_img_txt = "st_file".$q;
			$temp_img_on_txt = "st_file".$q."_on";
			$temp_img_temp_on_txt = "st_file".$q."_temp_on";
			$temp_img_del_txt = "st_file".$q."_del";

			if($_FILES[$temp_img_txt]['name']) {
				$st_file = $_FILES[$temp_img_txt]['tmp_name'];
				$st_file_name = $_FILES[$temp_img_txt]['name'];
				$st_file_size = $_FILES[$temp_img_txt]['size'];
				$st_file_type = $_FILES[$temp_img_txt]['type'];

				if($st_file_name!="") {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
					$_POST[$temp_img_on_txt] = "st_file_".$_last_idx."_".$q.".".get_file_ext($st_file_name);
					upload_file($st_file, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
					$img_width_t = 1000;
					$img_height_t = 858;
					thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", $img_width_t, $img_height_t);
				}
			} else {
				if($_POST[$temp_img_del_txt]) {
					unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
				}
			}

			$arr_query_img['st_file'.$q] = $_POST['st_file'.$q.'_on'];
		}

		if($arr_query_img) {
			$where_query = "idx = '".$_last_idx."'";

			$DB->update_query('study_t', $arr_query_img, $where_query);
		}

		unset($arr_query_img);
		$arr_query_img = array();
		for($q=1;$q<=$st_data_num;$q++) {
			$temp_img_txt = "st_data".$q;
			$temp_img_on_txt = "st_data".$q."_on";
			$temp_img_temp_on_txt = "st_data".$q."_temp_on";
			$temp_img_del_txt = "st_data".$q."_del";

			if($_FILES[$temp_img_txt]['name']) {
				$st_data = $_FILES[$temp_img_txt]['tmp_name'];
				$st_data_name = $_FILES[$temp_img_txt]['name'];
				$st_data_size = $_FILES[$temp_img_txt]['size'];
				$st_data_type = $_FILES[$temp_img_txt]['type'];

				if($st_data_name!="") {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
					$_POST[$temp_img_on_txt] = "st_data_".$_last_idx."_".$q.".".get_file_ext($st_data_name);
					upload_file($st_data, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
				}
			} else {
				if($_POST[$temp_img_del_txt]) {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
					$arr_query_img['st_data'.$q] = '';
					$arr_query_img['st_data'.$q.'_origin'] = '';
				}
			}

			if($st_data_name) {
				$arr_query_img['st_data'.$q] = $_POST['st_data'.$q.'_on'];
				$arr_query_img['st_data'.$q.'_origin'] = $st_data_name;
			}
		}

		if($arr_query_img) {
			$where_query = "idx = '".$_last_idx."'";

			$DB->update_query('study_t', $arr_query_img, $where_query);
		}

		if($_POST['st_type']=='1') { //라이브
			if($_POST['w']) {
				foreach($_POST['w'] as $key => $val) {
					if($val) {
						$query_slt = "select idx from study_live_t where st_idx = '".$_last_idx."'";
						$row_slt = $DB->fetch_query($query_slt);

						unset($arr_query);
						$arr_query = array(
							"st_idx" => $_last_idx,
							"slt_sdate1" => $_POST['slt_sdate'.$val.'_1'],
							"slt_sdate2" => $_POST['slt_sdate'.$val.'_2'],
							"slt_sdate3" => $_POST['slt_sdate'.$val.'_3'],
							"slt_sdate4" => $_POST['slt_sdate'.$val.'_4'],
							"slt_zoom_link1" => $_POST['slt_zoom_link'.$val.'_1'],
							"slt_zoom_link2" => $_POST['slt_zoom_link'.$val.'_2'],
							"slt_zoom_link3" => $_POST['slt_zoom_link'.$val.'_3'],
							"slt_zoom_link4" => $_POST['slt_zoom_link'.$val.'_4'],
							"slt_zoom_info1" => $_POST['slt_zoom_info'.$val.'_1'],
							"slt_zoom_info2" => $_POST['slt_zoom_info'.$val.'_2'],
							"slt_zoom_info3" => $_POST['slt_zoom_info'.$val.'_3'],
							"slt_zoom_info4" => $_POST['slt_zoom_info'.$val.'_4'],
							"slt_round1_teacher" => $_POST['slt_round'.$val.'_1_teacher'],
							"slt_round2_teacher" => $_POST['slt_round'.$val.'_2_teacher'],
							"slt_round3_teacher" => $_POST['slt_round'.$val.'_3_teacher'],
							"slt_round4_teacher" => $_POST['slt_round'.$val.'_4_teacher'],
							"slt_round1_teacher_hp" => $_POST['slt_round'.$val.'_1_teacher_hp'],
							"slt_round2_teacher_hp" => $_POST['slt_round'.$val.'_2_teacher_hp'],
							"slt_round3_teacher_hp" => $_POST['slt_round'.$val.'_3_teacher_hp'],
							"slt_round4_teacher_hp" => $_POST['slt_round'.$val.'_4_teacher_hp'],
							"slt_reserve_chk" => $_POST['slt_reserve_chk'.$val],
							"slt_odate" => $_POST['slt_odate'.$val],
						);

						if($row_slt['idx']=='') {
							$arr_query['slt_show'] = 'Y';
							$arr_query['slt_wdate'] = "now()";

							$DB->insert_query('study_live_t', $arr_query);
						} else {
							$where_query = "idx = '".$row_slt['idx']."'";

							$DB->update_query('study_live_t', $arr_query, $where_query);
						}
					}
				}
			}
		} else if($_POST['st_type']=='2') { //콘텐츠 이용권
			if($_POST['e']) {
				foreach($_POST['e'] as $key => $val) {
					if($val) {
						$query_sct = "select idx from study_contents_t where st_idx = '".$_last_idx."' and sct_no = '".$val."'";
						$row_sct = $DB->fetch_query($query_sct);

						unset($arr_query);
						$arr_query = array(
							"st_idx" => $_last_idx,
							"sct_no" => $val,
							"sct_id" => $_POST['sct_id'.$val],
							"sct_pwd" => $_POST['sct_pwd'.$val],
						);

						if($row_sct['idx']=='') {
							$arr_query['sct_show'] = 'Y';
							$arr_query['sct_wdate'] = "now()";

							$DB->insert_query('study_contents_t', $arr_query);
						} else {
							$arr_query['sct_show'] = 'Y';

							$where_query = "idx = '".$row_sct['idx']."'";

							$DB->update_query('study_contents_t', $arr_query, $where_query);
						}
					}
				}
			}
		}

		if($chk_save_temp) {
			p_alert("임시저장되었습니다.", "./study_form.php?act=update&st_idx=".$_last_idx);
		} else {
			p_alert("등록되었습니다.", "./study_list.php");
		}
	} else if($_POST['act']=="update"){
		unset($arr_query);
		$arr_query = array(
			"mt_idx" => $_POST['mt_idx'],
			"mt_id" => $_POST['mt_id'],
			"mt_name" => $_POST['mt_name'],
			"mt_company" => $_POST['mt_company'],
			"mt_company_type" => $_POST['mt_company_type'],
			"st_status" => $_POST['st_status'],
			"st_type" => $_POST['st_type'],
			"st_title" => $_POST['st_title'],
			"st_ct_id" => $_POST['st_ct_id'],
			"st_ct_pid" => $_POST['st_ct_pid'],
			"st_time" => $_POST['st_time'],
			"st_price" => $_POST['st_price'],
			"st_round" => $_POST['st_round'],
			"st_zoom_link" => $_POST['st_zoom_link'],
			"st_zoom_info" => $_POST['st_zoom_info'],
			"st_delivery" => $_POST['st_delivery'],
			"st_age_min" => $_POST['st_age_min'],
			"st_age_max" => $_POST['st_age_max'],
			"st_attendance_min" => $_POST['st_attendance_min'],
			"st_attendance_max" => $_POST['st_attendance_max'],
			"st_memo" => $_POST['st_memo'],
			"st_content" => $_POST['st_content'],
			"st_caution" => $_POST['st_caution'],
			"st_contents_sdate" => $_POST['st_contents_sdate'],
			"st_contents_edate" => $_POST['st_contents_edate'],
			"st_contents_link" => $_POST['st_contents_link'],
			"st_contents_link_memo" => $_POST['st_contents_link_memo'],
			"st_contents_jaego" => $_POST['st_contents_jaego'],
			"st_data1_memo" => $_POST['st_data1_memo'],
			"st_web_url" => $_POST['st_web_url'],
			"st_web_url_memo" => $_POST['st_web_url_memo'],
			"st_youtube1" => $_POST['st_youtube1'],
			"st_youtube2" => $_POST['st_youtube2'],
			"st_youtube3" => $_POST['st_youtube3'],
			"st_youtube4" => $_POST['st_youtube4'],
			"st_youtube1_memo" => $_POST['st_youtube1_memo'],
			"st_youtube2_memo" => $_POST['st_youtube2_memo'],
			"st_youtube3_memo" => $_POST['st_youtube3_memo'],
			"st_youtube4_memo" => $_POST['st_youtube4_memo'],
			"st_open" => $_POST['st_open'],
		);


		if($_POST['st_status']=='2') {
			$arr_query['st_udate'] = "now()";
		} else {
			$arr_query['st_udate'] = '';
		}

		$where_query = "idx = '".$_POST['st_idx']."'";

		$DB->update_query('study_t', $arr_query, $where_query);
		$_last_idx = $_POST['st_idx'];

		unset($arr_query_img);
		$arr_query_img = array();
		for($q=1;$q<=$st_file_num;$q++) {
			$temp_img_txt = "st_file".$q;
			$temp_img_on_txt = "st_file".$q."_on";
			$temp_img_temp_on_txt = "st_file".$q."_temp_on";
			$temp_img_del_txt = "st_file".$q."_del";

			if($_FILES[$temp_img_txt]['name']) {
				$st_file = $_FILES[$temp_img_txt]['tmp_name'];
				$st_file_name = $_FILES[$temp_img_txt]['name'];
				$st_file_size = $_FILES[$temp_img_txt]['size'];
				$st_file_type = $_FILES[$temp_img_txt]['type'];

				if($st_file_name!="") {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
					$_POST[$temp_img_on_txt] = "st_file_".$_last_idx."_".$q.".".get_file_ext($st_file_name);
					upload_file($st_file, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
					$img_width_t = 1000;
					$img_height_t = 858;
					thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", $img_width_t, $img_height_t);
				}
			} else {
				if($_POST[$temp_img_del_txt]) {
					unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
				}
			}

			$arr_query_img['st_file'.$q] = $_POST['st_file'.$q.'_on'];
		}

		if($arr_query_img) {
			$where_query = "idx = '".$_last_idx."'";

			$DB->update_query('study_t', $arr_query_img, $where_query);
		}

		unset($arr_query_img);
		$arr_query_img = array();
		for($q=1;$q<=$st_data_num;$q++) {
			$temp_img_txt = "st_data".$q;
			$temp_img_on_txt = "st_data".$q."_on";
			$temp_img_temp_on_txt = "st_data".$q."_temp_on";
			$temp_img_del_txt = "st_data".$q."_del";

			if($_FILES[$temp_img_txt]['name']) {
				$st_data = $_FILES[$temp_img_txt]['tmp_name'];
				$st_data_name = $_FILES[$temp_img_txt]['name'];
				$st_data_size = $_FILES[$temp_img_txt]['size'];
				$st_data_type = $_FILES[$temp_img_txt]['type'];

				if($st_data_name!="") {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
					$_POST[$temp_img_on_txt] = "st_data_".$_last_idx."_".$q.".".get_file_ext($st_data_name);
					upload_file($st_data, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
				}
			} else {
				if($_POST[$temp_img_del_txt]) {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
					$arr_query_img['st_data'.$q] = '';
					$arr_query_img['st_data'.$q.'_origin'] = '';
				}
			}

			if($st_data_name) {
				$arr_query_img['st_data'.$q] = $_POST['st_data'.$q.'_on'];
				$arr_query_img['st_data'.$q.'_origin'] = $st_data_name;
			}
		}

		if($arr_query_img) {
			$where_query = "idx = '".$_last_idx."'";

			$DB->update_query('study_t', $arr_query_img, $where_query);
		}

		//printr($_POST);exit;

		if($_POST['st_type']=='1') { //라이브
			if($_POST['w']) {
				foreach($_POST['w'] as $key => $val) {
					if($val) {
						$query_slt = "select idx from study_live_t where idx = '".$_POST['slt_idx'.$val]."'";
						$row_slt = $DB->fetch_query($query_slt);

						unset($arr_query);
						$arr_query = array(
							"st_idx" => $_last_idx,
							"slt_sdate1" => $_POST['slt_sdate'.$val.'_1'],
							"slt_sdate2" => $_POST['slt_sdate'.$val.'_2'],
							"slt_sdate3" => $_POST['slt_sdate'.$val.'_3'],
							"slt_sdate4" => $_POST['slt_sdate'.$val.'_4'],
							"slt_zoom_link1" => $_POST['slt_zoom_link'.$val.'_1'],
							"slt_zoom_link2" => $_POST['slt_zoom_link'.$val.'_2'],
							"slt_zoom_link3" => $_POST['slt_zoom_link'.$val.'_3'],
							"slt_zoom_link4" => $_POST['slt_zoom_link'.$val.'_4'],
							"slt_zoom_info1" => $_POST['slt_zoom_info'.$val.'_1'],
							"slt_zoom_info2" => $_POST['slt_zoom_info'.$val.'_2'],
							"slt_zoom_info3" => $_POST['slt_zoom_info'.$val.'_3'],
							"slt_zoom_info4" => $_POST['slt_zoom_info'.$val.'_4'],
							"slt_round1_teacher" => $_POST['slt_round'.$val.'_1_teacher'],
							"slt_round2_teacher" => $_POST['slt_round'.$val.'_2_teacher'],
							"slt_round3_teacher" => $_POST['slt_round'.$val.'_3_teacher'],
							"slt_round4_teacher" => $_POST['slt_round'.$val.'_4_teacher'],
							"slt_round1_teacher_hp" => $_POST['slt_round'.$val.'_1_teacher_hp'],
							"slt_round2_teacher_hp" => $_POST['slt_round'.$val.'_2_teacher_hp'],
							"slt_round3_teacher_hp" => $_POST['slt_round'.$val.'_3_teacher_hp'],
							"slt_round4_teacher_hp" => $_POST['slt_round'.$val.'_4_teacher_hp'],
							"slt_reserve_chk" => $_POST['slt_reserve_chk'.$val],
							"slt_odate" => $_POST['slt_odate'.$val],
						);

						if($row_slt['idx']=='') {
							$arr_query['slt_show'] = 'Y';
							$arr_query['slt_wdate'] = "now()";

							$DB->insert_query('study_live_t', $arr_query);
						} else {
							$where_query = "idx = '".$row_slt['idx']."'";

							$DB->update_query('study_live_t', $arr_query, $where_query);
						}
					}
				}
			}
		} else if($_POST['st_type']=='2') { //콘텐츠 이용권
			if($_POST['e']) {
				foreach($_POST['e'] as $key => $val) {
					if($val) {
						$query_sct = "select idx from study_contents_t where st_idx = '".$_last_idx."' and sct_no = '".$val."'";
						$row_sct = $DB->fetch_query($query_sct);

						unset($arr_query);
						$arr_query = array(
							"st_idx" => $_last_idx,
							"sct_no" => $val,
							"sct_id" => $_POST['sct_id'.$val],
							"sct_pwd" => $_POST['sct_pwd'.$val],
						);

						if($row_sct['idx']=='') {
							$arr_query['sct_show'] = 'Y';
							$arr_query['sct_wdate'] = "now()";

							$DB->insert_query('study_contents_t', $arr_query);
						} else {
							$arr_query['sct_show'] = 'Y';

							$where_query = "idx = '".$row_sct['idx']."'";

							$DB->update_query('study_contents_t', $arr_query, $where_query);
						}
					}
				}
			}
		}

		if($chk_save_temp) {
			p_alert("임시저장되었습니다.");
		} else {
			p_alert("수정되었습니다.");
		}
	} else if($_POST['act']=="delete") {
		unset($arr_query);
		$arr_query = array(
			"st_show" => "N",
		);

		$where_query = "idx = '".$_POST['idx']."'";

		$DB->update_query('study_t', $arr_query, $where_query);

		echo "Y";
	} else if($_POST['act']=="search_member") {
		if($_POST['stxt']) {
			unset($list);
			if($_POST['mt_company_type']=='1') { //교육업체
				$query = "select * from member_t where mt_status = 'Y' and mt_level = '5' and mt_iscom = '1' and (instr(mt_id, '".$_POST['stxt']."') or instr(mt_name, '".$_POST['stxt']."')) order by mt_id asc, mt_name asc";
			} else {
				$query = "select * from member_t where mt_status = 'Y' and mt_level = '5' and mt_iscom = '2' and (instr(mt_id, '".$_POST['stxt']."') or instr(mt_name, '".$_POST['stxt']."')) order by mt_id asc, mt_name asc";
			}
			$list = $DB->select_query($query);

			if($list) {
				foreach($list as $row) {
					$mt_company_t = '';
					if($row['mt_company']) {
						$mt_company_type = '교육업체';
						$mt_company_t = $mt_company_type .', '.$row['mt_company'].', '.$row['mt_name'].' ('.$row['mt_id'].')';
					} else {
						$mt_company_type = '프리랜서';
						$mt_company_t = $mt_company_type .', '.$row['mt_name'].' ('.$row['mt_id'].')';
					}
?>
			<li class="list-group-item d-flex justify-content-between align-items-center cursor-pointer" onclick="f_search_member_selected('<?=$row['idx']?>', '<?=$row['mt_id']?>', '<?=$row['mt_name']?>', '<?=$row['mt_company']?>', '<?=$mt_company_t?>');">
				<span class="pl-2 pb-2"><?=$mt_company_t?></span>
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
	} else if($_POST['act']=="schedule_append") {
		$w = ($_POST['w']+1);
		$r = $_POST['r'];
?>
	<li class="list-group-item" id="schedule_box_li<?=$w?>">
		<input type="hidden" name="w[]" id="w<?=$w?>" value="<?=$w?>">
		<input type="hidden" name="slt_idx<?=$w?>" id="slt_idx<?=$w?>" value="<?=$row_slt['idx']?>">

		<h5 class="mb-2">스케쥴 <?=$w?></h5>

		<div class="form-group">
			<table class="table table-bordered">
				<thead class="thead-dark">
				<tr>
					<?
						for($q=1;$q<=$r;$q++) {
					?>
					<th class="text-center" style="width:80px;">
						<?=$q?>회차
					</th>
					<?
						}
					?>
				</tr>
				</thead>
				<tbody>
				<tr>
					<?
						for($q=1;$q<=$r;$q++) {
					?>
					<td>
						<div class="form-group">
							<label for="slt_sdate<?=$w?>_<?=$q?>">수업시작일시</label>
							<input type="text" name="slt_sdate<?=$w?>_<?=$q?>" id="slt_sdate<?=$w?>_<?=$q?>" value="<?=$row_slt['slt_sdate'.$q]?>" onclick="date_time_picker('slt_sdate<?=$w?>_<?=$q?>')" readonly class="form-control form-control-sm" />
						</div>
						<div class="form-group">
							<label for="slt_zoom_link<?=$w?>_<?=$q?>">화상수업링크</label>
							<input type="text" name="slt_zoom_link<?=$w?>_<?=$q?>" id="slt_zoom_link<?=$w?>_<?=$q?>" value="<?=$row_slt['slt_zoom_link'.$q]?>" class="form-control form-control-sm" placeholder="http:// 를 포함하여 입력바랍니다." />
						</div>
						<div class="form-group">
							<label for="slt_zoom_info<?=$w?>_<?=$q?>">ID/비번</label>
							<input type="text" name="slt_zoom_info<?=$w?>_<?=$q?>" id="slt_zoom_info<?=$w?>_<?=$q?>" value="<?=$row_slt['slt_zoom_info'.$q]?>" class="form-control form-control-sm" />
						</div>
						<div class="form-group">
							<label for="slt_round<?=$w?>_<?=$q?>_teacher">선생님 이름</label>
							<input type="text" name="slt_round<?=$w?>_<?=$q?>_teacher" id="slt_round<?=$w?>_<?=$q?>_teacher" value="<?=$row_slt['slt_round'.$q.'_teacher']?>" class="form-control form-control-sm" />
						</div>
						<div class="form-group">
							<label for="slt_round<?=$w?>_<?=$q?>_teacher_hp">선생님 연락처</label>
							<input type="text" name="slt_round<?=$w?>_<?=$q?>_teacher_hp" id="slt_round<?=$w?>_<?=$q?>_teacher_hp" value="<?=$row_slt['slt_round'.$q.'_teacher_hp']?>" numberOnly class="form-control form-control-sm" />
						</div>
					</td>
					<?
						}
					?>
				</tr>
				</tbody>
			</table>
		</div>

		<div class="form-group">
			<label for="slt_odate<?=$w?>">예약오픈일</label>
			<div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="slt_reserve_chk<?=$w?>_1" name="slt_reserve_chk<?=$w?>" class="custom-control-input" value="1"<? if($row_slt['slt_reserve_chk']=='1' || $row_slt['slt_reserve_chk']=='') { ?> checked<? } ?> />
					<label class="custom-control-label" for="slt_reserve_chk<?=$w?>_1">즉시</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="slt_reserve_chk<?=$w?>_2" name="slt_reserve_chk<?=$w?>" class="custom-control-input" value="2"<? if($row_slt['slt_reserve_chk']=='2') { ?> checked<? } ?> />
					<label class="custom-control-label" for="slt_reserve_chk<?=$w?>_2">날짜선택</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="text" name="slt_odate<?=$w?>" id="slt_odate<?=$w?>" value="<?=$row_slt['slt_odate']?>" onclick="date_picker('slt_odate<?=$w?>')" readonly class="form-control form-control-sm" readonly />
				</div>
			</div>
		</div>

		<div class="form-group text-right">
			<input type="button" value="스케줄 삭제" onclick="f_del_schedule('<?=$w?>', '<?=$row_slt['idx']?>');" class="btn btn-danger btn-sm">
		</div>
	</li>
<?
	} else if($_POST['act']=="slt_round_add") {
		$w = $_POST['w'];
		$r = $_POST['r'];

		for($q=0;$q<$r;$q++) {
?>
		<li>
			<div class="form-group row m-0 p-0">
				<label for="slt_round_teacher<?=$w?>_<?=$q?>" class="col-sm-2 col-form-label">선생님 이름</label>
				<div class="col-sm-3">
					<input type="text" name="slt_round<?=$w?>_teacher[]" id="slt_round_teacher<?=$w?>_<?=$q?>" value="" class="form-control form-control-sm" />
				</div>
				<label for="slt_round_teacher_hp<?=$w?>_<?=$q?>" class="col-sm-2 col-form-label">선생님 연락처</label>
				<div class="col-sm-3">
					<input type="text" name="slt_round<?=$w?>_teacher_hp[]" id="slt_round_teacher_hp<?=$w?>_<?=$q?>" value="" class="form-control form-control-sm" />
				</div>
			</div>
		</li>
<?
		}
	} else if($_POST['act']=="schedule_delete") {
		unset($arr_query);
		$arr_query = array(
			"slt_show" => "N",
		);

		$where_query = "idx = '".$_POST['slt_idx']."'";

		$DB->update_query('study_live_t', $arr_query, $where_query);

		echo "Y";
	} else if($_POST['act']=="contents_append") {
		$w = $_POST['w'];

		unset($list_sct);
		$query_sct = "select * from study_contents_t where st_idx = '".$_POST['st_idx']."' and sct_show = 'Y'";
		$list_sct = $DB->select_query($query_sct);

		if($list_sct) {
			$l = 1;
			foreach($list_sct as $row_sct) {
?>
		<li id="contents_box_li<?=$l?>" class="list-group-item">
			<input type="hidden" name="e[]" id="e<?=$l?>" value="<?=$l?>">
			<input type="hidden" name="sct_idx[]" id="sct_idx<?=$l?>" value="<?=$row_sct['idx']?>">
			<div class="form-group row align-items-center mb-0 pb-0">
				<label for="sct_id<?=$l?>" class="col-sm-2 col-form-label">아이디</label>
				<div class="col-sm-3">
					<input type="text" name="sct_id<?=$l?>" id="sct_id<?=$l?>" value="<?=$row_sct['sct_id']?>" class="form-control form-control-sm" />
				</div>
				<label for="sct_pwd<?=$l?>" class="col-sm-2 col-form-label">비밀번호</label>
				<div class="col-sm-3">
					<input type="text" name="sct_pwd<?=$l?>" id="sct_pwd<?=$l?>" value="<?=$row_sct['sct_pwd']?>" class="form-control form-control-sm" />
				</div>
				<label for="sct_pwd<?=$l?>" class="col-sm-1 col-form-label"><input type="button" value="삭제" onclick="f_del_contents('<?=$l?>', '<?=$row_sct['idx']?>');" class="btn btn-danger btn-xs"></label>
			</div>
		</li>
<?
				$l++;
			}
		}

		if($l>0) {
			$ql = $l;
		} else {
			$ql = 1;
		}

		for($q=$ql;$q<=$w;$q++) {
?>
		<li id="contents_box_li<?=$q?>" class="list-group-item">
			<input type="hidden" name="e[]" id="e<?=$q?>" value="<?=$q?>">
			<div class="form-group row align-items-center mb-0 pb-0">
				<label for="sct_id<?=$q?>" class="col-sm-2 col-form-label">아이디</label>
				<div class="col-sm-3">
					<input type="text" name="sct_id<?=$q?>" id="sct_id<?=$q?>" value="" class="form-control form-control-sm" />
				</div>
				<label for="sct_pwd<?=$q?>" class="col-sm-2 col-form-label">비밀번호</label>
				<div class="col-sm-3">
					<input type="text" name="sct_pwd<?=$q?>" id="sct_pwd<?=$q?>" value="" class="form-control form-control-sm" />
				</div>
				<label for="sct_pwd<?=$q?>" class="col-sm-2 col-form-label"><input type="button" value="삭제" onclick="f_del_contents('<?=$q?>', '');" class="btn btn-danger btn-sm"></label>
			</div>
		</li>
<?
		}
	} else if($_POST['act']=="contents_delete") {
		unset($arr_query);
		$arr_query = array(
			"sct_show" => "N",
		);

		$where_query = "idx = '".$_POST['sct_idx']."'";

		$DB->update_query('study_contents_t', $arr_query, $where_query);

		echo "Y";
    }

    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
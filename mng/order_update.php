<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=='study_live') {
?>
	<div class="modal-header">
		<h5 class="modal-title" id="staticBackdropLabel">신청학생명단</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
			<thead class="thead-dark">
			<tr>
				<th class="text-center" style="width:100px;">
					번호
				</th>
				<th class="text-center" style="width:140px;">
					신청상태
				</th>
				<th class="text-center" style="width:140px;">
					부모이름
				</th>
				<th class="text-center" style="width:140px;">
					자녀이름
				</th>
				<th class="text-center" style="width:120px;">
					학년
				</th>
				<th class="text-center" style="width:120px;">
					성별
				</th>
				<th class="text-center" style="width:180px;">
					결제일시
				</th>
				<th class="text-center" style="width:400px;">
					배송정보
				</th>
			</tr>
			</thead>
			<tbody>
			<?
				unset($list);
				$query = "select * from order_t a1 where a1.slt_idx = '".$_POST['slt_idx']."' and a1.st_type = '1' and a1.ot_status in (2,3,4,5) and a1.st_mt_idx = '".$_POST['st_mt_idx']."'";
				$list = $DB->select_query($query);

				if($list) {
					$q = 1;
					foreach($list as $row) {
						$mct_info = get_member_child_info($row['mct_idx']);

						if($row['ot_status']==5 || $row['ot_status']==6 || $row['ot_status']==90) {
							$tr_class_t = ' class="table-danger"';
						} else {
							$tr_class_t = '';
						}
			?>
			<tr<?=$tr_class_t?>>
				<td class="text-center"><?=$q?></td>
				<td class="text-center">
					<?=$arr_ot_status[$row['ot_status']]?>
					<? if($row['ot_status']=='6') { ?>
					<input type="button" value="취소완료" onclick="f_ot_cancel('<?=$row['idx']?>', '<?=$_POST['slt_idx']?>');" class="btn btn-danger btn-sm mt-2">
					<? } ?>
				</td>
				<td class="text-center"><?=$row['mt_name']?></td>
				<td class="text-center"><?=$row['mct_name']?></td>
				<td class="text-center"><?=$arr_mct_grade[$mct_info['mct_grade']]?></td>
				<td class="text-center"><?=$arr_mct_gender[$mct_info['mct_gender']]?></td>
				<td class="text-center"><?=DateType($row['ot_pdate'], 6)?></td>
				<td>
					<p><?=$row['ot_rname']?> / <?=$row['ot_rhp']?></p>
					<p>[<?=$row['ot_rzip']?>]<?=$row['ot_radd1']?> <?=$row['ot_radd2']?></p>
					<p>(<?=$row['ot_rmemo']?>)</p>
				</td>
			</tr>
			<?
						$q++;
					}
				}
			?>
			</tbody>
		</table>
		</div>
	</div>
<?
	} else if($_POST['act']=='zoom_info') {
		$slt_info = get_study_live_t_info($_POST['slt_idx']);
?>
	<div class="modal-header">
		<h5 class="modal-title" id="staticBackdropLabel">화상수업링크</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<table class="table table-bordered">
			<thead class="thead-dark">
			<tr>
				<?
					for($q=1;$q<=4;$q++) {
						if($slt_info['slt_round'.$q.'_teacher']) {
				?>
				<th class="text-center" style="width:80px;">
					<?=$q?>회차
				</th>
				<?
						}
					}
				?>
			</tr>
			</thead>
			<tbody>
			<tr>
				<?
					for($q=1;$q<=4;$q++) {
						if($slt_info['slt_round'.$q.'_teacher']) {
				?>
				<td>
					<div class="form-group">
						<label for="slt_sdate<?=$w?>_<?=$q?>">수업시작일시</label>
						<p><?=$slt_info['slt_sdate'.$q]?></p>
					</div>
					<div class="form-group">
						<label for="slt_zoom_link<?=$w?>_<?=$q?>">화상수업링크</label>
						<p><?=$slt_info['slt_zoom_link'.$q]?></p>
					</div>
					<div class="form-group">
						<label for="slt_zoom_info<?=$w?>_<?=$q?>">ID/비번</label>
						<p><?=$slt_info['slt_zoom_info'.$q]?></p>
					</div>
					<div class="form-group">
						<label for="slt_round<?=$w?>_<?=$q?>_teacher">선생님 이름</label>
						<p><?=$slt_info['slt_round'.$q.'_teacher']?></p>
					</div>
					<div class="form-group">
						<label for="slt_round<?=$w?>_<?=$q?>_teacher_hp">선생님 연락처</label>
						<p><?=$slt_info['slt_round'.$q.'_teacher_hp']?></p>
					</div>
				</td>
				<?
						}
					}
				?>
			</tr>
			</tbody>
		</table>
	</div>
<?
	} else if($_POST['act']=='order_cancel') {
		unset($arr_query);
		$arr_query = array(
			"ot_status" => "90",
		);

		$where_query = "idx = '".$_POST['ot_idx']."'";

		$DB->update_query('order_t', $arr_query, $where_query);

		echo "Y";
	} else if($_POST['act']=='study_contents') {
?>
	<div class="modal-header">
		<h5 class="modal-title" id="staticBackdropLabel">신청학생명단</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="table-responsive">
		<table class="table table-striped table-hover table-bordered">
			<thead class="thead-dark">
			<tr>
				<th class="text-center" style="width:100px;">
					번호
				</th>
				<th class="text-center" style="width:140px;">
					신청상태
				</th>
				<th class="text-center" style="width:140px;">
					이용권정보
				</th>
				<th class="text-center" style="width:140px;">
					부모이름
				</th>
				<th class="text-center" style="width:140px;">
					자녀이름
				</th>
				<th class="text-center" style="width:120px;">
					학년
				</th>
				<th class="text-center" style="width:120px;">
					성별
				</th>
				<th class="text-center" style="width:180px;">
					결제일시
				</th>
			</tr>
			</thead>
			<tbody>
			<?
				unset($list);
				$query = "select * from order_t a1 where a1.st_idx = '".$_POST['st_idx']."' and a1.st_type = '2' and a1.ot_status in (2,3,4,5) and a1.st_mt_idx = '".$_POST['st_mt_idx']."'";
				$list = $DB->select_query($query);

				if($list) {
					$q = 1;
					foreach($list as $row) {
						$mct_info = get_member_child_info($row['mct_idx']);
						$sct_info = get_study_contents_t_info($row['sct_idx']);

						if($row['ot_status']==5 || $row['ot_status']==6 || $row['ot_status']==90) {
							$tr_class_t = ' class="table-danger"';
						} else {
							$tr_class_t = '';
						}
			?>
			<tr<?=$tr_class_t?>>
				<td class="text-center"><?=$q?></td>
				<td class="text-center">
					<?=$arr_ot_status[$row['ot_status']]?>
					<? if($row['ot_status']=='6') { ?>
					<input type="button" value="취소완료" onclick="f_ot_cancel('<?=$row['idx']?>');" class="btn btn-danger btn-sm mt-2">
					<? } ?>
				</td>
				<td class="text-center"><?=$sct_info['sct_id']?> / <?=$sct_info['sct_pwd']?></td>
				<td class="text-center"><?=$row['mt_name']?></td>
				<td class="text-center"><?=$row['mct_name']?></td>
				<td class="text-center"><?=$arr_mct_grade[$mct_info['mct_grade']]?></td>
				<td class="text-center"><?=$arr_mct_gender[$mct_info['mct_gender']]?></td>
				<td class="text-center"><?=DateType($row['ot_pdate'], 6)?></td>
			</tr>
			<?
						$q++;
					}
				}
			?>
			</tbody>
		</table>
		</div>
	</div>
<?
	}

    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
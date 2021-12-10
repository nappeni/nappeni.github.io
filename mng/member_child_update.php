<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=='update') {
		unset($arr_query);
		$arr_query = array(
			"mct_name" => $_POST['mct_name'],
			"mct_gender" => $_POST['mct_gender'],
			"mct_grade" => $_POST['mct_grade'],
			"mct_birth" => $_POST['mct_birth'],
			"mct_memo" => $_POST['mct_memo'],
		);

		$where_query = "idx = '".$_POST['mct_idx']."'";

		$DB->update_query('member_child_t', $arr_query, $where_query);

		p_alert("수정되었습니다.");
	} else if($_POST['act']=="point_input") {
		unset($arr_query);
		$arr_query = array(
			"mt_idx" => $_POST['mt_idx'],
			"mct_idx" => $_POST['mct_idx'],
			"pt_type" => $_POST['pt_type'],
			"pt_point" => $_POST['pt_point'],
			"pt_content" => $_POST['pt_content'],
			"pt_wdate" => "now()",
		);

		$DB->insert_query('point_t', $arr_query);

		echo "Y";
	} else if($_POST['act']=="point_delete") {
		$DB->del_query('point_t', " idx = '".$_POST['pt_idx']."'");

		echo "Y";
	} else if($_POST['act']=="delete") {
		$DB->del_query('member_child_t', " idx = '".$_POST['idx']."'");

		echo "Y";
	} else if($_POST['act']=="point_all") {
		unset($list);
		$query = "select *, a1.idx as mct_idx from member_child_t a1 where mct_show = 'Y'";
		$list = $DB->select_query($query);

		if($list) {
			foreach($list as $row) {
				unset($arr_query);
				$arr_query = array(
					"mt_idx" => $row['mt_idx'],
					"mct_idx" => $row['mct_idx'],
					"pt_type" => 'P',
					"pt_class" => '1',
					"pt_point" => $_POST['mct_point_all'],
					"pt_content" => '관리자에 의한 일괄지급',
					"pt_wdate" => "now()",
				);

				$DB->insert_query('point_t', $arr_query);
			}
		}

		p_alert('지급되었습니다.');
	} else if($_POST['act']=="point_request_modal") {
		$query_rp = "select * from member_point_request_t where idx = '".$_POST['mprt_idx']."'";
		$row_rp = $DB->fetch_query($query_rp);
?>
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">포인트 신청</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<form method="post" name="frm_form" id="frm_form" action="./member_child_update.php" onsubmit="return f_point_request(this);" target="hidden_ifrm">
		<input type="hidden" name="act" id="act" value="point_request" />
		<input type="hidden" name="mprt_idx" id="mprt_idx" value="<?=$row_rp['idx']?>" />

		<div class="form-group row justify-content-start align-items-center">
			<label for="mprt_point" class="col-sm-3 col-form-label">신청포인트</label>
			<div class="col-sm-9">
				<b class="text-danger"><?=$arr_point_all[$row_rp['mprt_point']]?></b>
				<small id="mprt_point_help" class="form-text text-muted">* 신청 포인트를 지급하시면 '확인'을 눌러주세요.</small>
			</div>
		</div>

		<p class="p-3 text-center">
			<input type="submit" value="확인" class="btn btn-outline-primary" />
			<input type="button" value="취소" data-dismiss="modal" aria-label="Close" class="btn btn-outline-danger ml-2" />
		</p>
		</form>
	</div>
<?
	} else if($_POST['act']=="point_request") {
		$query_rp = "select * from member_point_request_t where idx = '".$_POST['mprt_idx']."'";
		$row_rp = $DB->fetch_query($query_rp);

		if($row_rp['mprt_status']=='1') {
			unset($arr_query);
			$arr_query = array(
				"mt_idx" => $row_rp['mt_idx'],
				"mct_idx" => $row_rp['mct_idx'],
				"pt_type" => 'P',
				"pt_class" => '1',
				"pt_point" => $row_rp['mprt_point'],
				"pt_content" => '자녀회원 신청에 의한 지급',
				"pt_wdate" => "now()",
			);

			$DB->insert_query('point_t', $arr_query);

			unset($arr_query);
			$arr_query = array(
				"mprt_status" => '2',
				"mprt_udate" => "now()",
			);

			$where_query = "idx = '".$_POST['mprt_idx']."'";

			$DB->update_query('member_point_request_t', $arr_query, $where_query);

			p_alert('지급되었습니다.');
		} else {
			p_alert('잘못된 접근입니다.');
		}
	} else if($_POST['act']=="child_top_stat1") {
		$query1 = "select count(*) as cnt from member_child_t where mct_show = 'Y'";
		$row1 = $DB->fetch_query($query1);

		$cnt1 = $row1['cnt'];

		$query2 = "select count(*) as cnt from member_child_t where mct_show = 'Y' and mct_klat_type1 = 'Y'";
		$row2 = $DB->fetch_query($query2);

		$cnt2 = $row2['cnt'];

		$cnt3 = ($cnt2/$cnt1)*100;
?>
	<h5>누적 등록 수 <?=number_format($cnt1)?> 명</h5>
	<h5>학습 유형 검사 <?=number_format($cnt2)?> 명</h5>
	<h5>검사 전환율 <?=round($cnt3, 2)?> %</h5>
<?
	} else if($_POST['act']=="child_top_stat2") {
		$query1 = "select count(*) as cnt from member_child_t where mct_show = 'Y'";
		$row1 = $DB->fetch_query($query1);

		$cnt1 = $row1['cnt'];

		$query2 = "select sum(if(mct_gender='F', 1, 0)) as cnt2, sum(if(mct_gender='M', 1, 0)) as cnt3 from member_child_t where mct_show = 'Y' group by mct_gender";
		$row2 = $DB->fetch_query($query2);

		$cnt2 = ($row2['cnt2']/$cnt1)*100;
		$cnt3 = ($row2['cnt3']/$cnt1)*100;

?>
		<p>
			<span class="h5 mr-2">남자 <?=round($cnt3, 2)?> %</span>
			<span class="h5 mr-2">여자 <?=round($cnt2, 2)?> %</span>
		</p>
<?
	} else if($_POST['act']=="child_top_stat3") {
		$query1 = "select count(*) as cnt from member_child_t where mct_show = 'Y'";
		$row1 = $DB->fetch_query($query1);

		$cnt1 = $row1['cnt'];

		$query2 = "select sum(if(mct_grade='1', 1, 0)) as cnt2, sum(if(mct_grade='2', 1, 0)) as cnt3, sum(if(mct_grade='3', 1, 0)) as cnt4, sum(if(mct_grade='4', 1, 0)) as cnt5, sum(if(mct_grade='5', 1, 0)) as cnt6, sum(if(mct_grade='6', 1, 0)) as cnt7 from member_child_t where mct_show = 'Y'";
		$row2 = $DB->fetch_query($query2);

		$cnt2 = ($row2['cnt2']/$cnt1)*100;
		$cnt3 = ($row2['cnt3']/$cnt1)*100;
		$cnt4 = ($row2['cnt4']/$cnt1)*100;
		$cnt5 = ($row2['cnt5']/$cnt1)*100;
		$cnt6 = ($row2['cnt6']/$cnt1)*100;
		$cnt7 = ($row2['cnt7']/$cnt1)*100;
		$sum = ($row2['cnt2']+$row2['cnt3']+$row2['cnt4']+$row2['cnt5']+$row2['cnt6']+$row2['cnt7']);
		$cnt8 = (($cnt1-$sum)/$cnt1)*100;
?>
		<p>
			<span class="h5 mr-2">6학년 <?=round($cnt7, 2)?> %</span>
			<span class="h5 mr-2">5학년 <?=round($cnt6, 2)?> %</span>
			<span class="h5 mr-2">4학년 <?=round($cnt5, 2)?> %</span>
		</p>
		<p>
			<span class="h5 mr-2">3학년 <?=round($cnt4, 2)?> %</span>
			<span class="h5 mr-2">2학년 <?=round($cnt3, 2)?> %</span>
			<span class="h5 mr-2">1학년 <?=round($cnt2, 2)?> %</span>
		</p>
		<p>
			<span class="h5 mr-2">기타 <?=round($cnt8, 2)?> %</span>
		</p>
<?
	} else if($_POST['act']=="child_top_stat4") {
		$query1 = "select count(*) as cnt from member_child_t where mct_show = 'Y'";
		$row1 = $DB->fetch_query($query1);

		$cnt1 = $row1['cnt'];

		$query2 = "select count(*) as cnt from member_child_t where mct_show = 'Y' and mct_klat_type1 = 'Y'";
		$row2 = $DB->fetch_query($query2);

		$cnt2 = $row2['cnt'];

		$cnt3 = ($cnt2/$cnt1)*100;
?>
		<p>
			<span class="h5 mr-2">체험학습형 14%</span>
			<span class="h5 mr-2">생각학습형 14%</span>
		</p>
		<p>
			<span class="h5 mr-2">실험학습형 14%</span>
			<span class="h5 mr-2">개념학습형 14%</span>
		</p>
<?
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
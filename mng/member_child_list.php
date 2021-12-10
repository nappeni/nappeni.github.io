<?
	include "./head_inc.php";
	$chk_menu = '1';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "12";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-6 col-xl-3 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<div>
							<p>등록 자녀 수</p>
							<h2>&nbsp;</h2>
						</div>
						<div>
							<div class="icon-box-primary icon-box-lg"><i class="mdi mdi-account-child-outline"></i></div>
						</div>
					</div>
					<div id="member_child_top_stat1"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xl-3 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<div>
							<p>성별 분포</p>
							<h2>&nbsp;</h2>
						</div>
						<div>
							<div class="icon-box-warning icon-box-lg"><i class="mdi mdi-gender-male-female"></i></div>
						</div>
					</div>
					<div id="member_child_top_stat2"></div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xl-3 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<div>
							<p>학년 분포</p>
							<h2>&nbsp;</h2>
						</div>
						<div>
							<div class="icon-box-info icon-box-lg"> <i class="mdi mdi-school-outline"></i></div>
						</div>
					</div>
					<div id="member_child_top_stat3">
						<p>
							<span class="h5 mr-2">6학년 14%</span>
							<span class="h5 mr-2">5학년 14%</span>
							<span class="h5 mr-2">4학년 14%</span>
						</p>
						<p>
							<span class="h5 mr-2">3학년 14%</span>
							<span class="h5 mr-2">2학년 14%</span>
							<span class="h5 mr-2">1학년 14%</span>
						</p>
						<p>
							<span class="h5 mr-2">기타 14%</span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xl-3 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between mb-3">
						<div>
							<p>학습 유형 분포</p>
							<h2>&nbsp;</h2>
						</div>
						<div>
							<div class="icon-box-success icon-box-lg"><i class="mdi mdi-google-classroom"></i></div>
						</div>
					</div>
					<div id="member_child_top_stat4">
						<p>
							<span class="h5 mr-2">체험학습형 14%</span>
							<span class="h5 mr-2">생각학습형 14%</span>
						</p>
						<p>
							<span class="h5 mr-2">실험학습형 14%</span>
							<span class="h5 mr-2">개념학습형 14%</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	<!--
		function get_member_child_top_stat(tt) {
			$('#member_child_top_stat'+tt).html('<div class="dot-opacity-loader"><span></span><span></span><span></span></div>');

			if(tt) {
				$.post('./member_child_update.php', {act: 'child_top_stat'+tt, tt: tt}, function (data) {
					if(data) {
						$('#member_child_top_stat'+tt).html(data);
					} else {
						console.log(data);
					}
				});
			}

			return false;
		}

		$(document).ready(function () {
			get_member_child_top_stat('1');
			get_member_child_top_stat('2');
			get_member_child_top_stat('3');
			get_member_child_top_stat('4');
		});
	//-->
	</script>

	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">자녀회원</h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
							<div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
									<div class="form-group mx-sm-1">
										<select name="sel_search" id="sel_search" class="form-control form-control-sm">
											<option value="all">통합검색</option>
											<option value="a1.mct_code">자녀코드</option>
											<option value="a1.mt_name">자녀이름</option>
											<option value="a1.mt_parent_name">학부모명</option>
										</select>
									</div>

									<div class="form-group mx-sm-1">
										<input type="text" class="form-control form-control-sm" style="width:200px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="submit" class="btn btn-primary" value="검색" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-secondary" value="초기화" onclick="location.href='./member_child_list.php'" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-outline-danger" value="포인트" onclick="$('#modal-point-all').modal();" />
									</div>
								</form>
								<script type="text/javascript">
								<!--
									function frm_search_chk(f) {
										if(f.search_txt.value=="") {
											alert("검색어를 입력바랍니다.");
											f.search_txt.focus();
											return false;
										}

										return true;
									}

									function f_point_all(f) {
										if(f.mct_point_all.value=="") {
											alert("포인트를 선택바랍니다.");
											f.mct_point_all.focus();
											return false;
										}

										$('#splinner_modal').modal('toggle');

										return true;
									}

									function f_point_request_modal(mprt_idx) {
										$.post('./member_child_update.php', {act: 'point_request_modal', mprt_idx: mprt_idx}, function (data) {
											if(data) {
												$('#modal-point-content').html(data);
												$('#modal-point-all').modal();
											}
										});

										return false;
									}

									function f_point_request(f) {
										if(f.mprt_idx.value=="") {
											alert("신청내역을 확인바랍니다.");
											f.mprt_idx.focus();
											return false;
										}

										$('#splinner_modal').modal('toggle');

										return true;
									}

									<? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
								//-->
								</script>
							</div>
						</div>
					</div>

					<div class="modal fade" id="modal-point-all" tabindex="-1" role="dialog" aria-labelledby="modal-default-Label" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content" id="modal-point-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">포인트 지급</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form method="post" name="frm_form" id="frm_form" action="./member_child_update.php" onsubmit="return f_point_all(this);" target="hidden_ifrm">
									<input type="hidden" name="act" id="act" value="point_all" />

									<div class="form-group row">
										<label for="mct_point_all" class="col-sm-2 col-form-label">포인트</label>
										<div class="col-sm-10">
											<select name="mct_point_all" id="mct_point_all" class="form-control form-control-sm">
												<option value="">선택</option>
												<?=$arr_point_all_option?>
											</select>
											<small id="mct_point_all_help" class="form-text text-muted">* 모든 자녀회원에서 일괄지급됩니다.</small>
										</div>
									</div>

									<p class="p-3 text-center">
										<input type="submit" value="확인" class="btn btn-outline-primary" />
									</p>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead class="thead-dark">
						<tr>
							<th class="text-center" style="width:80px;">
								번호
							</th>
							<th class="text-center" style="width:120px;">
								자녀코드
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
							<th class="text-center" style="width:120px;">
								학부모명
							</th>
							<th class="text-center" style="width:140px;">
								학습유형검사
							</th>
							<th class="text-center" style="width:140px;">
								수업예약개수
							</th>

							<th class="text-center" style="width:140px;">
								수업참여횟수
							</th>
							<th class="text-center" style="width:140px;">
								자녀포인트
							</th>
							<th class="text-center" style="width:140px;">
								포인트신청
							</th>
							<th class="text-center" style="width:120px;">
								노출
							</th>
							<th class="text-center" style="width:180px;">
								관리
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$_where = " where ";
							$query = "
								select *, a1.idx as mct_idx from member_child_t a1
							";
							$query_count = "
								select count(*) from member_child_t a1
							";

							$where_query .= $_where."mct_show = 'Y'";
							$_where = " and ";

							if($_GET['search_txt']) {
								if($_GET['sel_search']=="all") {
									$where_query .= $_where."(instr(a1.mct_code, '".$_GET['search_txt']."') or instr(a1.mct_name, '".$_GET['search_txt']."') or instr(a1.mt_parent_name, '".$_GET['search_txt']."'))";
								} else {
									$where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
								}
								$_where = " and ";
							}

							$row_cnt = $DB->fetch_query($query_count.$where_query);
							$couwt_query = $row_cnt[0];
							$counts = $couwt_query;
							$n_page = ceil($couwt_query / $n_limit_num);
							if($pg=="") $pg = 1;
							$n_from = ($pg - 1) * $n_limit;
							$counts = $counts - (($pg - 1) * $n_limit_num);

							unset($list);
							$sql_query = $query.$where_query." order by a1.idx desc limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);

							if($list) {
								foreach($list as $row) {
									$query_rp = "select *, idx as mprt_idx from member_point_request_t where mct_idx = '".$row['mct_idx']."' and mprt_status = '1' order by idx desc limit 0, 1";
									$row_rp = $DB->fetch_query($query_rp);
						?>
						<tr>
							<td class="text-center">
								<?=$counts?>
							</td>
							<td class="text-center">
								<?=$row['mct_code']?>
							</td>
							<td class="text-center">
								<?=$row['mct_name']?>
							</td>
							<td class="text-center">
								<?=$arr_mct_grade[$row['mct_grade']]?>
							</td>
							<td class="text-center">
								<?=$arr_mct_gender[$row['mct_gender']]?>
							</td>
							<td class="text-center">
								<?=$row['mt_parent_name']?>
							</td>
							<td class="text-center">
								<?=$arr_mct_klat_type1[$row['mct_klat_type1']]?>
							</td>
							<td class="text-center">
								<?=number_format($row['mt_review_cash'])?>
							</td>
							<td class="text-center">
								<?=number_format($row['mt_review_cash'])?>
							</td>
							<td class="text-center">
								<?=number_format(get_mct_point($row['mct_idx']))?>
							</td>
							<td class="text-center">
								<? if($row_rp['mprt_idx']) { ?>
								<a href="javascript:;" onclick="f_point_request_modal('<?=$row_rp['mprt_idx']?>')" class="btn btn-sm btn-outline-danger"><?=$arr_point_all[$row_rp['mprt_point']]?></a>
								<? } else { ?>
								없음
								<? } ?>
							</td>
							<td class="text-center">
								<?=$row['mct_show']?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="location.href='./member_child_form.php?act=update&mct_idx=<?=$row['mct_idx']?>&<?=$_get_txt.$_GET['pg']?>'" /> <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="f_post_del('./member_child_update.php', '<?=$row['mct_idx']?>');" />
							</td>
						</tr>
						<?
									$counts--;
								}
							} else {
						?>
						<tr>
							<td colspan="<?=$_colspan_txt?>" class="text-center"><b>자료가 없습니다.</b></td>
						</tr>
						<?
							}
						?>
						</tbody>
					</table>
					</div>
					<?
						if($n_page>1) {
							echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
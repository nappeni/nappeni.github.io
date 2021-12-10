<?
	include "./head_inc.php";
	$chk_menu = '1';
	$chk_sub_menu = '3';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "11";
	$_get_txt = "sel_search=".$_GET['sel_search']."&sel_order=".$_GET['sel_order']."&sel_status=".$_GET['sel_status']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">교육업체/선생님 회원</h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
							<div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
									<div class="form-group mx-sm-1">
										<select name="sel_order" id="sel_order" class="form-control form-control-sm">
											<option value="">정렬필터</option>
											<option value="1">개설수업수</option>
											<option value="2">누적진행건수</option>
											<option value="3">만족도평점</option>
										</select>
									</div>

									<div class="form-group mx-sm-1">
										<select name="sel_status" id="sel_status" class="form-control form-control-sm">
											<option value="">승인상태</option>
											<?=$arr_mt_teacher_option?>
										</select>
									</div>

									<div class="form-group mx-sm-1">
										<select name="sel_search" id="sel_search" class="form-control form-control-sm">
											<option value="all">통합검색</option>
											<option value="a1.mt_name">이름</option>
										</select>
									</div>

									<div class="form-group mx-sm-1">
										<input type="text" class="form-control form-control-sm" style="width:200px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="submit" class="btn btn-info" value="검색" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-secondary" value="초기화" onclick="location.href='./member_teacher_list.php'" />
									</div>

									<div class="form-group ml-1">
										<input type="button" class="btn btn-primary" value="신규등록" onclick="location.href='./member_teacher_form.php'" />
									</div>
								</form>
								<script type="text/javascript">
								<!--
									function frm_search_chk(f) {
										/*
										if(f.search_txt.value=="") {
											alert("검색어를 입력바랍니다.");
											f.search_txt.focus();
											return false;
										}
										*/

										return true;
									}

									<? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
									<? if($_GET['sel_status']) { ?>$('#sel_status').val('<?=$_GET['sel_status']?>');<? } ?>
									<? if($_GET['sel_order']) { ?>$('#sel_order').val('<?=$_GET['sel_order']?>');<? } ?>
								//-->
								</script>
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
								회원유형
							</th>
							<th class="text-center" style="width:120px;">
								이름
							</th>
							<th class="text-center" style="width:140px;">
								가입일시
							</th>
							<th class="text-center" style="width:120px;">
								승인상태
							</th>
							<th class="text-center" style="width:120px;">
								개설수업수
							</th>
							<th class="text-center" style="width:120px;">
								수업확정수
							</th>
							<th class="text-center" style="width:120px;">
								누적진행횟수
							</th>
							<th class="text-center" style="width:120px;">
								누적수강자수
							</th>
							<th class="text-center" style="width:120px;">
								만족도
							</th>
							<th class="text-center" style="width:140px;">
								관리
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$_where = " where ";
							$query = "
								select *, a1.idx as mt_idx from member_t a1
							";
							$query_count = "
								select count(*) from member_t a1
							";

							$where_query .= $_where."mt_level = '5'";
							$_where = " and ";

							if($_GET['search_txt']) {
								if($_GET['sel_search']=="all") {
									$where_query .= $_where."(instr(a1.mt_name, '".$_GET['search_txt']."'))";
								} else {
									$where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
								}
								$_where = " and ";
							}

							if($_GET['sel_status']) {
								$where_query .= $_where."mt_teacher = '".$_GET['sel_status']."'";
								$_where = " and ";
							}

							$row_cnt = $DB->fetch_query($query_count.$where_query);
							$couwt_query = $row_cnt[0];
							$counts = $couwt_query;
							$n_page = ceil($couwt_query / $n_limit_num);
							if($pg=="") $pg = 1;
							$n_from = ($pg - 1) * $n_limit;
							$counts = $counts - (($pg - 1) * $n_limit_num);

							if($_GET['sel_order']) {
								if($_GET['sel_order']=='1') {
									$order_by_t = 'order by a1.idx desc';
								} else if($_GET['sel_order']=='2') {
									$order_by_t = 'order by a1.idx desc';
								} else if($_GET['sel_order']=='3') {
									$order_by_t = 'order by a1.idx desc';
								}
							} else {
								$order_by_t = 'order by a1.idx desc';
							}

							unset($list);
							$sql_query = $query.$where_query." ".$order_by_t." limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);

							if($list) {
								foreach($list as $row) {
						?>
						<tr>
							<td class="text-center">
								<?=$counts?>
							</td>
							<td class="text-center">
								<?=$arr_mt_iscom[$row['mt_iscom']]?>
							</td>
							<td class="text-center">
								<?=$row['mt_name']?>
							</td>
							<td class="text-center">
								<?=DateType($row['mt_wdate'], 6)?>
							</td>
							<td class="text-center">
								<?=$arr_mt_teacher[$row['mt_teacher']]?>
							</td>
							<td class="text-center">
								<?=number_format($row['mt_review_cash'])?> 개
							</td>
							<td class="text-center">
								<?=number_format($row['mt_review_cash'])?> 건
							</td>
							<td class="text-center">
								<?=number_format($row['mt_review_cash'])?> 회
							</td>
							<td class="text-center">
								<?=number_format($row['mt_review_cash'])?> 명
							</td>
							<td class="text-center">
								<?=$row['mt_review_cash']?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="location.href='./member_teacher_form.php?act=update&mt_idx=<?=$row['mt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" /> <input type="button" class="btn btn-outline-danger btn-sm" value="탈퇴" onclick="f_retire_mem('<?=$row['mt_idx']?>');" />
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
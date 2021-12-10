<?
	include "./head_inc.php";
	$chk_menu = '1';
	$chk_sub_menu = '1';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "11";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">부모회원</h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
							<div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
									<div class="form-group mx-sm-1">
										<select name="sel_search" id="sel_search" class="form-control form-control-sm">
											<option value="all">통합검색</option>
											<option value="a1.mt_id">아이디</option>
											<option value="a1.mt_name">성명</option>
											<option value="a1.mt_hp">연락처</option>
											<option value="a1.mt_tel">보조연락처</option>
										</select>
									</div>

									<div class="form-group mx-sm-1">
										<input type="text" class="form-control form-control-sm" style="width:200px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="submit" class="btn btn-primary" value="검색" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-secondary" value="초기화" onclick="location.href='./member_list.php'" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-success" value="엑셀" onclick="f_excel_down();" />
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

									function f_excel_down() {
										$('#splinner_modal').modal('toggle');

										hidden_ifrm.document.location.href = './member_excel_down.php';

										setTimeout(function() {
											$('#splinner_modal').modal('toggle');
										}, 1000);

										return false;
									}

									<? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
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
								이름
							</th>
							<th class="text-center" style="width:200px;">
								아이디
							</th>
							<th class="text-center" style="width:120px;">
								연락처
							</th>
							<th class="text-center" style="width:120px;">
								보조연락처
							</th>
							<th class="text-center" style="width:120px;">
								임직원관계
							</th>
							<th class="text-center" style="width:140px;">
								자녀와의관계
							</th>
							<th class="text-center" style="width:140px;">
								가입일시
							</th>
							<th class="text-center" style="width:140px;">
								누적구매횟수
							</th>
							<th class="text-center" style="width:140px;">
								만족도 평가횟수
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

							$where_query .= $_where."mt_level = '2'";
							$_where = " and ";

							if($_GET['search_txt']) {
								if($_GET['sel_search']=="all") {
									$where_query .= $_where."(instr(a1.mt_id, '".$_GET['search_txt']."') or instr(a1.mt_name, '".$_GET['search_txt']."') or instr(a1.mt_hp, '".$_GET['search_txt']."') or instr(a1.mt_tel, '".$_GET['search_txt']."'))";
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
						?>
						<tr>
							<td class="text-center">
								<?=$counts?>
							</td>
							<td class="text-center">
								<?=$row['mt_name']?>
							</td>
							<td>
								<?=$row['mt_id']?>
							</td>
							<td class="text-center">
								<?=$row['mt_hp']?>
							</td>
							<td class="text-center">
								<?=$row['mt_tel']?>
							</td>
							<td class="text-center">
								<?=$arr_mt_executives_chk[$row['mt_executives_chk']]?>
							</td>
							<td class="text-center">
								<?=$arr_mt_child_chk[$row['mt_child_chk']]?>
							</td>
							<td class="text-center">
								<?=DateType($row['mt_wdate'], 6)?>
							</td>
							<td class="text-center">
								<?=number_format($row['mt_review_cash'])?>
							</td>
							<td class="text-center">
								<?=number_format($row['mt_review_cash'])?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="location.href='./member_form.php?act=update&mt_idx=<?=$row['mt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" /> <input type="button" class="btn btn-outline-danger btn-sm" value="탈퇴" onclick="f_retire_mem('<?=$row['mt_idx']?>');" />
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
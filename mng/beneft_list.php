<?
	include "./head_inc.php";
	$chk_menu = '8';
	$chk_sub_menu = '1';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "8";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">혜택관리</h4>
					<p class="card-description">
						혜택관리 등록, 수정, 삭제 할 수 있습니다.
					</p>

					<div class="p-3 float-right">
						<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
							<div class="form-group mx-sm-1">
								<select name="sel_search" id="sel_search" class="form-control form-control-sm">
									<option value="all">통합검색</option>
									<option value="a1.mt_name">성명</option>
									<option value="a1.mt_jumin">주민번호</option>
									<option value="a1.mt_hp">연락처</option>
								</select>
							</div>

							<div class="form-group mx-sm-1">
								<input type="text" class="form-control form-control-sm" style="width:200px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" />
							</div>

							<div class="form-group mx-sm-1">
								<input type="submit" class="btn btn-info" value="검색" />
							</div>

							<div class="form-group mx-sm-1">
								<input type="button" class="btn btn-secondary" value="초기화" onclick="location.href='./member_list.php'" />
							</div>
							<div class="form-group mx-sm-1">
								<input type="button" class="btn btn-primary" value="신규등록" onclick="f_modal_view('input_view', '')" />
							</div>
							<div class="form-group mx-sm-1">
								<input type="button" class="btn btn-success" value="엑셀" onclick="f_excel_down('excel_member_list')" />
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

							function f_excel_down(act) {
								$('#splinner_modal').modal({
									backdrop: 'static',
									keyboard: false
								});

								hidden_ifrm.location.href='./member_update.php?act='+act;

								setTimeout(function(){
									$('#splinner_modal').modal('hide');
								}, 1000);

								return false;
							}

							function frm_form_chk(f) {
								if(f.mt_name.value=="") {
									alert("성명을 입력해주세요.");
									f.mt_name.focus();
									return false;
								}
								if(f.mt_jumin.value=="") {
									alert("주민번호를 입력해주세요.");
									f.mt_jumin.focus();
									return false;
								}
								if(f.mt_hp.value=="") {
									alert("연락처를 입력해주세요.");
									f.mt_hp.focus();
									return false;
								}

								return true;
							}

							function f_modal_view(act, mt_idx) {
								if(act=='input_view') {
									$.post('./member_update.php', {act: act}, function (data) {
										if(data) {
											$('#modal-default-size').removeClass('modal-xl');
											$('#modal-default-content').html(data);
											$('#modal-default').modal();
										}
									});
								} else if(act=='update_view') {
									$.post('./member_update.php', {act: act, mt_idx: mt_idx}, function (data) {
										if(data) {
											$('#modal-default-size').addClass('modal-xl');
											$('#modal-default-content').html(data);
											$('#modal-default').modal();
										}
									});
								}

								return false;
							}

							function frm_point_chk(f) {
								if(f.pt_pay_price.value=="" && f.pt_point_num.value=="") {
									alert("결제금액 또는 적립금 중 한가지를 입력바랍니다.");
									f.pt_pay_price.focus();
									return false;
								}

								return true;
							}

							<? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
						//-->
						</script>
					</div>

					<table class="table table-striped table-hover">
					<thead>
					<tr>
						<th class="text-center" style="width:80px;">
							번호
						</th>
						<th class="text-center">
							성명
						</th>
						<th class="text-center">
							주민번호
						</th>
						<th class="text-center">
							연락처
						</th>
						<th class="text-center">
							결제금액(누적)
						</th>
						<th class="text-center">
							적립금(현재)
						</th>
						<th class="text-center">
							메모
						</th>
						<th class="text-center">
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

						if($_GET['search_txt']) {
							if($_GET['sel_search']=="all") {
								$where_query .= $_where."(instr(a1.mt_name, '".$_GET['search_txt']."') or instr(a1.mt_jumin, '".$_GET['search_txt']."') or instr(a1.mt_hp, '".$_GET['search_txt']."'))";
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
						<td>
							<?=$row['mt_name']?>
						</td>
						<td class="text-center">
							<?=$row['mt_jumin']?>
						</td>
						<td class="text-center">
							<?=$row['mt_hp']?>
						</td>
						<td class="text-center">
							<?=number_format($row['mt_sum_price'])?>
						</td>
						<td class="text-center">
							<?=number_format($row['mt_sum_point'])?>
						</td>
						<td class="text-center">
							<div class="form-inline">
								<input type="text" name="met_content_<?=$row['mt_idx']?>" id="met_content_<?=$row['mt_idx']?>" value="" class="form-control form-control-sm" />
								<input type="button" class="btn btn-primary btn-sm ml-2" value="메모" onclick="f_memo_input('<?=$row['mt_idx']?>')" />
							</div>
						</td>
						<td class="text-center">
							<input type="button" class="btn btn-outline-secondary btn-sm" value="상세보기" onclick="location.href='./member_form.php?act=update&mt_idx=<?=$row['mt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" /> <input type="button" class="btn btn-outline-primary btn-sm" value="적립금등록" onclick="f_point_input('<?=$row['mt_idx']?>')" /> <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="del('./member_update.php?act=del&mt_idx=<?=$row['mt_idx']?>');" />
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
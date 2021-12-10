<?
	include "./head_inc.php";
	$chk_menu = '3';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "7";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">컨텐츠 이용권</h4>

					<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<div class="form-group row align-items-center mb-0">
								<label for="sel_search_date" class="col-sm-2 col-form-label">결제일</label>
								<div class="col-sm-2">
									<div class="btn-group" role="group" aria-label="sel_search_date">
										<button type="button" onclick="f_order_search_date_range('1', '<?=date('Y-m-d')?>', '<?=date('Y-m-d', strtotime("+2 days"))?>');" id="f_order_search_date_range1" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">3일</button>
										<button type="button" onclick="f_order_search_date_range('3', '<?=date('Y-m-d')?>', '<?=date('Y-m-d', strtotime("+6 days"))?>');" id="f_order_search_date_range3" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">7일</button>
										<button type="button" onclick="f_order_search_date_range('5', '<?=date('Y-m-d')?>', '<?=date('Y-m-d', strtotime("+29 days"))?>');" id="f_order_search_date_range5" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">30일</button>
										<button type="button" onclick="f_order_search_date_range('6', '<?=date('Y-m-d')?>', '<?=date('Y-m-d', strtotime("+59 days"))?>');" id="f_order_search_date_range6" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">60일</button>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="input-group">
										<input type="text" name="sel_search_sdate" id="sel_search_sdate" value="<?=$_GET['sel_search_sdate']?>" class="form-control" readonly /> <span class="m-2">~</span> <input type="text" name="sel_search_edate" id="sel_search_edate" value="<?=$_GET['sel_search_edate']?>" class="form-control" readonly />
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="form-group row align-items-center mb-0">
								<label for="sel_search" class="col-sm-2 col-form-label">검색어</label>
								<div class="col-sm-2">
									<div class="input-group">
										<select name="sel_search" id="sel_search" class="form-control form-control-sm">
											<option value="all">통합검색</option>
											<option value="a1.st_title">수업명</option>
											<option value="a1.mt_id">아이디</option>
											<option value="a1.mt_name">부모이름</option>
											<option value="a1.mt_hp">부모연락처</option>
											<option value="a1.mt_tel">보조연락처</option>
											<option value="a1.mct_name">자녀이름</option>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="input-group">
										<input type="text" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" class="form-control form-control-sm" />
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item">
							<div class="form-group row align-items-center mb-0">
								<div class="col-sm-12 text-center">
									<input type="submit" class="btn btn-primary" value="검색" />
									<input type="button" class="btn btn-secondary ml-2" value="초기화" onclick="location.href='./order_contents_list.php'" />
								</div>
							</div>
						</li>
					</ul>
					<p>&nbsp;</p>
					</form>
					<script type="text/javascript">
					<!--
						(function($) {
							'use strict';
							$(function() {
								jQuery.datetimepicker.setLocale('ko');

								jQuery(function () {
									jQuery('#sel_search_sdate').datetimepicker({
										format: 'Y-m-d',
										onShow: function (ct) {
											this.setOptions({
												maxDate: jQuery('#sel_search_edate').val() ? jQuery('#sel_search_edate').val() : false
											})
										},
										timepicker: false
									});
									jQuery('#sel_search_edate').datetimepicker({
										format: 'Y-m-d',
										onShow: function (ct) {
											this.setOptions({
												minDate: jQuery('#sel_search_sdate').val() ? jQuery('#sel_search_sdate').val() : false
											})
										},
										timepicker: false
									});
								});
							});
						})(jQuery);

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

						function f_excel_down(act_t) {
							var f = document.frm_search;

							if(f.sel_search_sdate.value=="") {
								alert("조회기간을 입력바랍니다.");
								f.sel_search_sdate.focus();
								return false;
							}
							if(f.sel_search_edate.value=="") {
								alert("조회기간을 입력바랍니다.");
								f.sel_search_edate.focus();
								return false;
							}

							hidden_ifrm.document.location.href = './order_excel.php?act='+act_t+'&search_date='+f.sel_search_date.value+'&sdate='+f.sel_search_sdate.value+'&edate='+f.sel_search_edate.value;

							return false;
						}

						<? if($_GET['sel_search_date']) { ?>$('#sel_search_date').val('<?=$_GET['sel_search_date']?>');<? } ?>
						<? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
					//-->
					</script>

					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead class="thead-dark">
						<tr>
							<th class="text-center" style="width:140px;">
								결제일
							</th>
							<th class="text-center" style="width:140px;">
								신청상태
							</th>
							<th class="text-center" style="width:400px;">
								수업정보
							</th>
							<th class="text-center" style="width:200px;">
								부모/자녀
							</th>
							<th class="text-center" style="width:140px;">
								대상연령
							</th>
							<th class="text-center" style="width:140px;">
								결제금액
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$_where = " where ";
							$query = "
								select *, a1.idx as ot_idx from order_t a1
							";
							$query_count = "
								select count(*) from order_t a1
							";

							$where_query .= $_where."a1.st_type = '2'";
							$_where = " and ";

							if($_GET['search_txt']) {
								if($_GET['sel_search']=="all") {
									$where_query .= $_where."(instr(a1.ot_code, '".$_GET['search_txt']."') or instr(a1.st_title, '".$_GET['search_txt']."') or instr(a1.mt_id, '".$_GET['search_txt']."') or instr(a1.mt_name, '".$_GET['search_txt']."') or instr(a1.mt_hp, '".$_GET['search_txt']."') or instr(a1.mt_tel, '".$_GET['search_txt']."') or instr(a1.mct_name, '".$_GET['search_txt']."'))";
								} else {
									$where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
								}
								$_where = " and ";
							}

							if($_GET['sel_search_sdate'] && $_GET['sel_search_edate']) {
								$where_query .= $_where."a1.ot_pdate between '".$_GET['sel_search_sdate']." 00:00:00' and '".$_GET['sel_search_edate']." 23:59:59'";
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
							$sql_query = $query.$where_query." group by st_idx order by a1.idx desc limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);

							if($list) {
								foreach($list as $row) {
									$st_info = get_study_t_info($row['st_idx']);

									$query_sctc = "select count(*) as cnt from order_t a1 where a1.st_idx = '".$row['st_idx']."' and a1.st_type = '2' and a1.ot_status in (2,3,4,5) and a1.st_mt_idx = '".$row['st_mt_idx']."'";
									$row_sctc = $DB->fetch_query($query_sctc);
						?>
						<tr>
							<td class="text-center">
								<?=DateType($row['ot_pdate'], 12)?>
							</td>
							<td class="text-center">
								<?=$arr_ot_status[$row['ot_status']]?>
							</td>
							<td>
								<div class="media product_list_media">
									<a href="../" target="_blank"><img src="<?=$ct_img_url."/".$st_info['st_file1']?>" onerror="this.src='<?=$ct_no_img_url?>'" class="align-self-center mr-3" alt="<?=$st_info['st_title']?>"></a>
									<div class="media-body">
										<h5 class="font-weight-bold"><?=$st_info['st_title']?></h5>
										<h5>이용기간 : <?=DateType($st_info['st_contents_sdate'], 12)?> ~ <?=DateType($st_info['st_contents_edate'], 12)?></h5>
									</div>
								</div>
							</td>
							<td class="text-center">
								<p>이용권 : <?=number_format($row_sctc['cnt'])?>/<?=$st_info['st_contents_jaego']?></p>
								<input type="button" class="btn btn-outline-secondary btn-sm" value="신청학생명단" onclick="f_view_study_contents('<?=$row['st_idx']?>', '<?=$row['st_mt_idx']?>')" />
							</td>
							<td class="text-center">
								<?=$arr_st_age[$st_info['st_age_min']]?>~<?=$arr_st_age[$st_info['st_age_max']]?>
							</td>
							<td class="text-center">
								<?=number_format($row['ot_price'])?>원
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

				<script type="text/javascript">
				<!--
					function f_view_study_contents(st_idx, st_mt_idx) {
						$.post('./order_update.php', {act: 'study_contents', st_idx: st_idx, st_mt_idx: st_mt_idx}, function (data) {
							if(data) {
								$('#modal-default-content').html(data);
								$('#modal-default-size').css('max-width', '800px');
								$('#modal-default').modal();
							}
						});

						return false;
					}

					function f_ot_cancel(ot_idx) {
						if(confirm("정말 취소 처리하겠습니까?")) {
							$.post('./order_update.php', {act: 'order_cancel', ot_idx: ot_idx}, function (data) {
								if(data=='Y') {
									alert("처리되었습니다.");
									document.location.reload();
								}
							});
						}

						return false;
					}
				//-->
				</script>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
<?
	include "./head_inc.php";
	$chk_menu = '2';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "8";
	$_get_txt = "sel_search=".$_GET['sel_search']."&sel_status=".$_GET['sel_status']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">수업관리</h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
							<div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
									<div class="form-group mx-sm-1">
										<select name="sel_status" id="sel_status" class="form-control form-control-sm">
											<option value="">개설상태</option>
											<?=$arr_st_status_option?>
										</select>
									</div>

									<div class="form-group mx-sm-1">
										<select name="sel_search" id="sel_search" class="form-control form-control-sm">
											<option value="all">통합검색</option>
											<option value="a1.st_title">수업명</option>
											<option value="a1.mt_company">업체명</option>
											<option value="a1.mt_name">이름</option>
											<option value="a1.mt_id">아이디</option>
										</select>
									</div>

									<div class="form-group mx-sm-1">
										<input type="text" class="form-control form-control-sm" style="width:200px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="submit" class="btn btn-info" value="검색" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-secondary" value="초기화" onclick="location.href='./study_list.php'" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-primary" value="수업개설" onclick="location.href='./study_form.php'" />
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
							<th class="text-center" style="width:140px;">
								수업노출
							</th>
							<th class="text-center" style="width:140px;">
								개설상태
							</th>
							<th class="text-center" style="width:140px;">
								수업구분
							</th>
							<th class="text-center" style="width:200px;">
								업체/선생님
							</th>
							<th class="text-center" style="width:140px;">
								개설일시
							</th>
							<th class="text-center" style="width:400px;">
								수업정보
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
								select *, a1.idx as st_idx from study_t a1
							";
							$query_count = "
								select count(*) from study_t a1
							";

							$where_query .= $_where."st_show = 'Y'";
							$_where = " and ";

							if($_GET['search_txt']) {
								if($_GET['sel_search']=="all") {
									$where_query .= $_where."(instr(a1.st_title, '".$_GET['search_txt']."') or instr(a1.mt_company, '".$_GET['search_txt']."') or instr(a1.mt_name, '".$_GET['search_txt']."') or instr(a1.mt_id, '".$_GET['search_txt']."'))";
								} else {
									$where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
								}
								$_where = " and ";
							}

							if($_GET['sel_status']) {
								$where_query .= $_where."st_status = '".$_GET['sel_status']."'";
								$_where = " and ";
							}

							$row_cnt = $DB->fetch_query($query_count.$where_query);
							$couwt_query = $row_cnt[0];
							$counts = $couwt_query;
							$n_page = ceil($couwt_query / $n_limit_num);
							if($pg=="") $pg = 1;
							$n_from = ($pg - 1) * $n_limit;
							$counts = $counts - (($pg - 1) * $n_limit_num);

							$order_by_t = 'order by a1.idx desc';

							unset($list);
							$sql_query = $query.$where_query." ".$order_by_t." limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);

							if($list) {
								foreach($list as $row) {
									if($row['mt_company_type']=='1') { //교육업체
										$mt_info_t = '교육업체, '.$row['mt_company'].', '.$row['mt_name'].' ('.$row['mt_id'].')';
									} else { //프리랜서
										$mt_info_t = '프리랜서, '.$row['mt_name'].' ('.$row['mt_id'].')';
									}

									if($row['st_ct_id']) $ca_name_breadcrumb_t = get_ca_name_breadcrumb($row['st_ct_id']);
						?>
						<tr>
							<td class="text-center">
								<?=$counts?>
							</td>
							<td class="text-center">
								<?=$row['st_open']?>
							</td>
							<td class="text-center">
								<?=$arr_st_status[$row['st_status']]?>
							</td>
							<td class="text-center">
								<?=$arr_st_type[$row['st_type']]?>
								<? if($row['st_type']=='1') { ?>
								<br/>(<?=$row['st_round']?>회)
								<? } ?>
							</td>
							<td class="text-center">
								<?=$mt_info_t?>
							</td>
							<td class="text-center">
								<?=DateType($row['st_udate'], 6)?>
							</td>
							<td>
								<div class="media product_list_media">
									<a href="../study_detail.php?st_idx=<?=$row['st_idx']?>&ct_id=<?=$row['st_ct_pid']?>" target="_blank"><img src="<?=$ct_img_url."/".$row['st_file1']?>" onerror="this.src='<?=$ct_no_img_url?>'" class="align-self-center mr-3" alt="<?=$row['st_title']?>" /></a>
									<div class="media-body">
										<small class="mt-2"><?=$ca_name_breadcrumb_t?></small>
										<h5 class="mt-2 font-weight-bold"><?=$row['st_title']?></h5>
										<span class="text-info"><?=number_format($row['st_price'])?>원</span>
									</div>
								</div>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="location.href='./study_form.php?act=update&st_idx=<?=$row['st_idx']?>&<?=$_get_txt.$_GET['pg']?>'" /> <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="f_post_del('./study_update.php', '<?=$row['st_idx']?>');" />
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
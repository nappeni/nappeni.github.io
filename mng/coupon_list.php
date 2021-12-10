<?
	include "./head_inc.php";
	$chk_menu = '7';
	$chk_sub_menu = '3';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "6";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">쿠폰관리</h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
							<div class="float-right">
							<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
								<div class="form-group ml-1">
									<select name="sel_search" id="sel_search" class="form-control form-control-sm">
										<option value="all">통합검색</option>
										<option value="a1.ct_title">제목</option>
									</select>
								</div>

								<div class="form-group ml-1">
									<input type="text" class="form-control form-control-sm" style="width:200px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" placeholder="검색어를 입력바랍니다." />
								</div>

								<div class="form-group ml-1">
									<input type="submit" class="btn btn-info" value="검색" />
								</div>

								<div class="form-group ml-1">
									<input type="button" class="btn btn-secondary" value="초기화" onclick="location.href='./coupon_list.php'" />
								</div>
								<div class="form-group ml-1">
									<input type="button" class="btn btn-primary" value="신규등록" onclick="location.href='./coupon_form.php'" />
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
							<th class="text-center" style="width:400px;">
								제목
							</th>
							<th class="text-center" style="width:80px;">
								노출
							</th>
							<th class="text-center" style="width:100px;">
								조회수
							</th>
							<th class="text-center" style="width:140px;">
								등록일시
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
								select *, a1.idx as ct_idx from coupon_t a1
							";
							$query_count = "
								select count(*) from coupon_t a1
							";

							if($_GET['search_txt']) {
								if($_GET['sel_search']=="all") {
									$where_query .= $_where."(instr(a1.ct_title, '".$_GET['search_txt']."'))";
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
								<p class="text-truncate" style="max-width: 600px;"><?=$row['ct_title']?></p>
							</td>
							<td class="text-center">
								<?=$row['ct_show']?>
							</td>
							<td class="text-center">
								<?=number_format($row['nt_hit'])?>
							</td>
							<td class="text-center">
								<?=DateType($row['ct_wdate'], 6)?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="location.href='./coupon_form.php?act=update&ct_idx=<?=$row['ct_idx']?>&<?=$_get_txt.$_GET['pg']?>'" /> <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="f_post_del('./coupon_update.php', '<?=$row['ct_idx']?>');" />
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
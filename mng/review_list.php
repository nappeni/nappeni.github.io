<?
	include "./head_inc.php";
	$chk_menu = '6';
	$chk_sub_menu = '1';
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
					<h4 class="card-title">리뷰관리</h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
							<div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
									<div class="form-group mx-sm-1">
										<select name="sel_search" id="sel_search" class="form-control form-control-sm">
											<option value="all">통합검색</option>
											<option value="a1.mt_name">회원명</option>
											<option value="a1.pt_title">상품명</option>
											<option value="a1.ot_code">주문번호</option>
											<option value="a1.ot_pcode">상품주문번호</option>
											<option value="a1.rt_content">내용</option>
										</select>
									</div>

									<div class="form-group mx-sm-1">
										<input type="text" class="form-control form-control-sm" style="width:200px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="submit" class="btn btn-info" value="검색" />
									</div>

									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-secondary" value="초기화" onclick="location.href='./review_list.php'" />
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
							<th class="text-center" style="width:120px;">
								회원명
							</th>
							<th class="text-center" style="width:280px;">
								상품명
							</th>
							<th class="text-center" style="width:180px;">
								주문정보
							</th>
							<th class="text-center" style="width:300px;">
								내용
							</th>
							<th class="text-center" style="width:80px;">
								점수
							</th>
							<th class="text-center" style="width:180px;">
								등록일시
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
								select *, a1.idx as rt_idx from review_t a1
							";
							$query_count = "
								select count(*) from review_t a1
							";

							if($_GET['search_txt']) {
								if($_GET['sel_search']=="all") {
									$where_query .= $_where."(instr(a1.mt_name, '".$_GET['search_txt']."') or instr(a1.pt_title, '".$_GET['search_txt']."') or instr(a1.ot_code, '".$_GET['search_txt']."') or instr(a1.ot_pcode, '".$_GET['search_txt']."') or instr(a1.rt_content, '".$_GET['search_txt']."'))";
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
									$pt_info = get_product_t_info($row['pt_idx']);
									if($pt_info['ct_id']) $ca_name_breadcrumb_t = get_ca_name_breadcrumb($pt_info['ct_id']);
						?>
						<tr>
							<td class="text-center">
								<?=$counts?>
							</td>
							<td>
								<?=$row['mt_name']?>
							</td>
							<td>
								<div class="media product_list_media">
									<a href="javascript:;" onclick="f_swipe_image('<?=$row['pt_idx']?>')"><img src="<?=$ct_img_url."/".$pt_info['pt_image1']?>" onerror="this.src='<?=$ct_no_img_url?>'" class="align-self-center mr-3" alt="<?=$pt_info['pt_title']?>"></a>
									<div class="media-body">
										<small class="mt-2"><?=$ca_name_breadcrumb_t?></small>
										<h5 class="mt-2 font-weight-bold"><?=$pt_info['pt_title']?></h5>
										<span class="text-info"><?=number_format($pt_info['pt_price'])?>원</span>
									</div>
								</div>
							</td>
							<td>
								<div class="media">
									<div class="media-body">
										<h5 class="mt-2 font-weight-bold"><?=$row['ot_code']?></h5>
										<h5 class="mt-2 font-weight-bold"><?=$row['ot_pcode']?></h5>
									</div>
								</div>
							</td>
							<td>
								<div class="media product_list_media">
									<a href="javascript:;" onclick="f_review_swipe_image('<?=$row['rt_idx']?>')"><img src="<?=$ct_img_url."/".$row['rt_img1']?>" onerror="this.src='<?=$ct_no_img_url?>'" class="align-self-center mr-3" alt="<?=$row['pt_title']?>"></a>
									<div class="media-body">
										<?=cut_str(get_text($row['rt_content']), 0, 80, '...')?>
									</div>
								</div>
							</td>
							<td class="text-center">
								<?=$row['rt_score']?>
							</td>
							<td class="text-center">
								<?=DateType($row['rt_wdate'], 6)?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-secondary btn-sm" value="상세보기" onclick="f_review_content('<?=$row['rt_idx']?>')" /> <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="f_post_del('./review_update.php', '<?=$row['rt_idx']?>');" />
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
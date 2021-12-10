<?
	include "./head_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "6";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="top_pd">
	<div class="sub_pg sub_bg">
		<div class="container-lg">
			<div class="tit text-center">
				<strong class="ff_sr fc_gr222 fs_40 mb-2 mb-lg-3">커뮤니티</strong>
				<p class="fw_300 fc_gr666 fs_20">플라이스쿨 커뮤니티에서 다양한 정보를 얻어 보세요</p>
			</div>
			<div class="bo_cate d-flex justify-content-left justify-content-lg-center align-self-center pl-4 m_mx_0">
				<a class="btn btn-lg btn-primary mr-2" href="./notice_list.php" role="button"><span>공지사항</span></a>
				<a class="btn btn-lg btn-light fc_graaa mr-2" href="./qna_list.php?qt_type=1" role="button"><span>문의사항</span></a>
				<a class="btn btn-lg btn-light fc_graaa mr-2" href="./qna_list.php?qt_type=2" role="button"><span>개선/건의사항</span></a>
			</div>
			<ul class="list-unstyled bo_list mt-5">
				<li class="bo_list_hd text-center d-none d-md-block">
					<div class="row justify-content-between align-items-center py-5">
						<div class="col-md-1">번호</div>
						<div class="col-md-6">제목</div>
						<div class="col-md-5 row">
							<div class="col-md-4">작성자</div>
							<div class="col-md-4">작성날짜</div>
							<div class="col-md-4">조회수</div>
						</div>
					</div>
				</li>
				<?
					$_where = " where ";
					$query = "
						select *, a1.idx as nt_idx from notice_t a1
					";
					$query_count = "
						select count(*) from notice_t a1
					";

					if($_GET['search_txt']) {
						if($_GET['sel_search']=="all") {
							$where_query .= $_where."(instr(a1.nt_title, '".$_GET['search_txt']."') or instr(a1.nt_content, '".$_GET['search_txt']."'))";
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
				<li class="text-center">
					<a href="./notice_view.php?nt_idx=<?=$row['nt_idx']?>&<?=$_get_txt.$_GET['pg']?>">
					<div class="row justify-content-between align-items-center py-4 fc_gr666">
						<div class="col-md-1 d-none d-md-block"><?=$counts?></div>
						<div class="col-md-6 text-left fc_gr222"><span class="line_text"><?=$row['nt_title']?></span></div>
						<div class="col-md-5 row justify-content-start align-items-center">
							<div class="col-auto col-md-4"><?=ADMIN_NAME?></div>
							<div class="col-4 col-md-4"><?=DateType($row['nt_wdate'], 12)?></div>
							<div class="col-2 col-md-4"><i class="xi xi-eye-o d-inline-block d-lg-none"></i><span><?=number_format($row['nt_hit'])?></span></div>
						</div>
					</div>
					</a>
				</li>
				<?
							$counts--;
						}
					} else {
				?>
				<li class="text-center py-5">
					<b>자료가 없습니다.</b>
				</li>
				<?
					}
				?>
			</ul>
			<?
				if($n_page>1) {
					echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
				}
			?>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
<?
	include "./head_inc.php";

	if($_GET['nt_idx']) {
		$query = "
			select *, a1.idx as nt_idx from notice_t a1
			where a1.idx = '".$_GET['nt_idx']."'
		";
		$row = $DB->fetch_query($query);
	} else {
		alert('잘못된 접근입니다.');
	}

	if($_COOKIE['nt_idx_chk']!=$row['nt_idx']) {
		unset($arr_query);
		$arr_query = array(
			'nt_hit' => ($row['nt_hit']+1),
		);

		$where_query = "idx = '".$row['nt_idx']."'";

		$DB->update_query("notice_t", $arr_query, $where_query);

		setcookie('nt_idx_chk', $row['nt_idx'], time()+3600);
	}

	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=".$_GET['pg'];
?>
<div class="top_pd">
	<div class="sub_pg sub_bg">
		<div class="container-lg">
			<div class="tit text-center">
				<strong class="ff_sr fc_gr222 fs_40 mb-2 mb-lg-3">커뮤니티</strong>
				<p class="fw_300 fc_gr666 fs_20">플라이스쿨 커뮤니티에서 다양한 정보를 얻어 보세요</p>
			</div>
			<div class="bo_view">
				<div class="bo_head text-center"><?=$row['nt_title']?></div>
				<ul class="bo_info d-flex flex-wrap justify-content-left justify-content-lg-end">
					<li class="px-3 py-1"><span class="fc_gr222 d-inline-block">글쓴이</span><?=ADMIN_NAME?></li>
					<li class="px-3 py-1"><span class="fc_gr222 d-inline-block">작성날짜</span><?=DateType($row['nt_wdate'], 6)?></li>
					<li class="px-3 py-1"><span class="fc_gr222 d-inline-block">조회수</span><?=number_format($row['nt_hit'])?></li>
				</ul>
				<div class="bo_v_body">
					<?=$row['nt_content']?>
					<?
						$query_clt = "select count(*) as cnt from community_like_t where clt_type = '1' and clt_pidx = '".$row['nt_idx']."'";
						$row_clt = $DB->fetch_query($query_clt);

						$query_clt2 = "select idx from community_like_t where clt_type = '1' and clt_pidx = '".$row['nt_idx']."' and mt_idx = '".$_SESSION['_mt_idx']."'";
						$row_clt2 = $DB->fetch_query($query_clt2);
					?>
					<div class="d-flex justify-content-center pt-2 pt-lg-5">
						<button type="button" id="btn_like<?=$row['nt_idx']?>" class="btn link_btn<? if($row_clt2['idx']) { ?> on<? } ?>"<? if($_SESSION['_mt_idx']) { ?> onclick="f_like_togggle('<?=$row['nt_idx']?>');"<? } ?>>좋아요 <span class="fc_bl" id="btn_like<?=$row['nt_idx']?>_cnt"><?=number_format($row_clt['cnt'])?></span></button>
					</div>
				</div>
			</div>

			<script type="text/javascript">
			<!--
				function f_reply_input(rt_pidx, rt_pid, obj) {
					if($('#'+obj).val()=='') {
						alert('댓글 내용을 입력바랍니다.');
						$('#'+obj).focus();
						return false;
					}

					$.post('./reply_update.php', {act: 'input', rt_type: '1', rt_pidx: rt_pidx, rt_pid: rt_pid, rt_content: $('#'+obj).val()}, function (data) {
						if(data=='Y') {
							alert('등록되었습니다.');
							$('#'+obj).val('');
							f_reply_list(rt_pidx);
						}
					});

					return false;
				}

				function f_reply_list(rt_pidx) {
					$.post('./reply_update.php', {act: 'list', rt_type: '1', rt_pidx: rt_pidx}, function (data) {
						if(data) {
							$('#reply_box').html(data);
						}
					});

					return false;
				}

				function f_reply_delete(rt_pidx, rt_idx) {
					if(confirm("정말 삭제하시겠습니까?")) {
						$.post('./reply_update.php', {act: 'delete', rt_idx: rt_idx}, function (data) {
							if(data) {
								alert('삭제되었습니다.');
								f_reply_list(rt_pidx);
							}
						});
					}

					return false;
				}

				function f_like_togggle(clt_pidx) {
					$.post('./reply_update.php', {act: 'like_input', clt_type: '1', clt_pidx: clt_pidx}, function (data) {
						var json_data = JSON.parse(data);

						if(json_data.btn=='Y') {
							$('#btn_like'+clt_pidx).addClass('on');
						} else {
							$('#btn_like'+clt_pidx).removeClass('on');
						}
						if(json_data.cnt) {
							$('#btn_like'+clt_pidx+'_cnt').html(json_data.cnt);
						}
					});

					return false;
				}

				function f_reply_open(k) {
					$('#rt_input_box'+k).show();

					return false;
				}

				function f_reply_close(k) {
					$('#rt_input_box'+k).hide();

					return false;
				}

				$(document).ready(function () {
					f_reply_list('<?=$row['nt_idx']?>');
				});
			//-->
			</script>
			<?
				$query_rc = "select count(*) as cnt from reply_t a1 where a1.rt_type = '1' and a1.rt_pidx = '".$row['nt_idx']."'";
				$row_rc = $DB->fetch_query($query_rc);
			?>
			<div class="bo_cmt pb-2">
				<div class="cmt_tit pt-5 pb-3">
					댓글 <span class="fc_bl"><?=number_format($row_rc['cnt'])?></span>
				</div>
				<? if($_SESSION['_mt_idx']) { ?>
				<div class="ip_wr m-0">
					<div class="input-group ip_textarea position-relative d-block">
						<textarea class="form-control border-0" name="rt_content" id="rt_content" placeholder="내용을 입력해 주세요"></textarea>
						<div class="d-flex justify-content-end">
							<button type="button" class="btn fc_bl fw_600" onclick="f_reply_input('<?=$row['nt_idx']?>', '', 'rt_content');">댓글 쓰기</button>
						</div>
					</div>
				</div>
				<? } ?>
				<div id="reply_box" class="pre-scrollable mt-3"></div>
			</div>
			<div class="d-flex justify-content-center align-items-center pt-5">
				<a href="./notice_list.php?<?=$_get_txt?>" class="btn btn-outline-secondary btn-lg">목록으로</a>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
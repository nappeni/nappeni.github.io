<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	$_act = $_REQUEST['act'];

	if($_POST['act']=='content_view') {
		$query = "
			select * from qna_t
			where idx = '".$_POST['qt_idx']."'
		";
		$row = $DB->fetch_query($query);
?>
	<div class="modal-header">
		<h5 class="modal-title" id="staticBackdropLabel"><?=$arr_qt_type[$row['qt_type']]?> 상세보기</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<p><?=nl2br($row['qt_content'])?></p>

		<hr/>

		<form method="post" name="frm_form" id="frm_form" action="./qna_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm">
		<input type="hidden" name="act" id="act" value="answer" />
		<input type="hidden" name="qt_idx" id="qt_idx" value="<?=$row['idx']?>" />
			<div class="form-group">
				<label for="qt_answer">답변</label>
				<textarea name="qt_answer" id="qt_answer" style="height: 200px;" class="form-control"><?=$row['qt_answer']?></textarea>
			</div>
			<div class="form-group">
				<label for="qt_answer">상태</label>
				<select class="form-control" name="qt_status" id="qt_status">
					<?=$arr_qt_status_option?>
				</select>
			</div>
			<div class="form-group">
				<label for="qt_adate">답변일시 : <?=DateType($row['qt_adate'], 6)?></label>
			</div>
			<button type="submit" class="btn btn-primary">확인</button>
		</form>

		<script type="text/javascript">
		<!--
			function frm_form_chk(f) {
				if(f.qt_answer.value=="") {
					alert("내용을 입력해주세요.");
					f.qt_answer.focus();
					return false;
				}

				$('#splinner_modal').modal('toggle');

				return true;
			}

			<? if($row['qt_status']) { ?>$('#qt_status').val('<?=$row['qt_status']?>');<? } ?>
		//-->
		</script>
	</div>
<?
    } else if($_POST['act']=='answer') {
		unset($arr_query);
		$arr_query = array(
			"qt_answer" => $_POST['qt_answer'],
			"qt_status" => $_POST['qt_status'],
			"qt_adate" => "now()",
		);

		$where_query = "idx = '".$_POST['qt_idx']."'";

		$DB->update_query('qna_t', $arr_query, $where_query);

		p_alert('등록되었습니다.');
    } else if($_POST['act']=='delete') {
		$DB->del_query('qna_t', " idx = '".$_POST['idx']."'");

		echo "Y";
	}

    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
<?
	include "./head_inc.php";
	$chk_menu = '10';
	$chk_sub_menu = '1';
	$chk_ckeditor = 'Y'; //CKEDITOR
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as nt_idx from notice_t a1
			where a1.idx = '".$_GET['nt_idx']."'
		";
		$row = $DB->fetch_query($query);

		$_act = "update";
		$_act_txt = " 수정";
	} else {
		$_act = "input";
		$_act_txt = " 입력";
	}

	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=".$_GET['pg'];
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">공지사항</h4>

					<form method="post" name="frm_form" id="frm_form" action="./notice_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="nt_idx" id="nt_idx" value="<?=$row['nt_idx']?>" />

					<div class="form-group row">
						<label for="nt_title" class="col-sm-2 col-form-label">제목</label>
						<div class="col-sm-10">
							<input type="text" name="nt_title" id="nt_title" value="<?=$row['nt_title']?>" class="form-control form-control-sm" />
						</div>
					</div>
					<div class="form-group row">
						<label for="nt_content" class="col-sm-2 col-form-label">내용</label>
						<div class="col-sm-10">
							<textarea name="nt_content" id="nt_content" class="form-control form-control-sm"><?=$row['nt_content']?></textarea>
							<script type="text/javascript">
							<!--
								CKEDITOR.replace('nt_content', {
									extraPlugins: 'uploadimage, image2',
									height : '300px',
									filebrowserImageBrowseUrl : '',
									filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=notice',
									enterMode : CKEDITOR.ENTER_BR,
								});
							//-->
							</script>
						</div>
					</div>
					<div class="form-group row">
						<label for="nt_title" class="col-sm-2 col-form-label">노출여부</label>
						<div class="col-sm-2">
							<select name="nt_show" id="nt_show" class="form-control form-control-sm">
								<option value="Y">Y</option>
								<option value="N">N</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="nt_title" class="col-sm-2 col-form-label">조회수</label>
						<div class="col-sm-2">
							<input type="text" name="nt_hit" id="nt_hit" value="<?=$row['nt_hit']?>" class="form-control form-control-sm" />
						</div>
					</div>
					<? if($_GET['act']=="update") { ?>
					<div class="form-group row">
						<label for="nt_title" class="col-sm-2 col-form-label">일시</label>
						<div class="col-sm-10">
							<?=DateType($row['nt_wdate'], 6)?>
						</div>
					</div>
					<? } ?>

					<p class="p-3 text-center">
						<input type="submit" value="확인" class="btn btn-outline-primary" />
						<input type="button" value="목록" onclick="location.href='./notice_list.php?<?=$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
					</p>

					</form>
					<script type="text/javascript">
						<? if($row['nt_show']) { ?>$('#nt_show').val('<?=$row['nt_show']?>');<? } ?>

						function frm_form_chk(f) {
							var oEditor = CKEDITOR.instances.nt_content;

							if(f.nt_title.value=="") {
								alert("제목을 입력해주세요.");
								f.nt_title.focus();
								return false;
							}
							if(oEditor.getData()=="") {
								alert("내용을 입력해주세요.");
								oEditor.focus();
								return false;
							}

							$('#splinner_modal').modal('toggle');

							return true;
						}
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
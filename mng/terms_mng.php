<?
	include "./head_inc.php";
	$chk_menu = '8';
	$chk_sub_menu = '5';
	$chk_ckeditor = 'Y'; //CKEDITOR
	include "./head_menu_inc.php";

	$query = "
		select * from setup_t
	";
	$row = $DB->fetch_query($query);
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">이용약관 관리</h4>

					<form method="post" name="frm_form" id="frm_form" action="./setup_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="update" />

					<div class="form-group row">
						<label for="st_agree1" class="col-sm-2 col-form-label">이용약관</label>
						<div class="col-sm-10">
							<textarea name="st_agree1" id="st_agree1" class="form-control form-control-sm"><?=$row['st_agree1']?></textarea>
							<script type="text/javascript">
							<!--
								CKEDITOR.replace('st_agree1', {
									extraPlugins: 'uploadimage, image2',
									height : '300px',
									filebrowserImageBrowseUrl : '',
									filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=st_agree1',
									enterMode : CKEDITOR.ENTER_BR,
								});
							//-->
							</script>
						</div>
					</div>

					<div class="form-group row">
						<label for="nt_title" class="col-sm-2 col-form-label">개인정보 활용 동의</label>
						<div class="col-sm-10">
							<textarea name="st_agree2" id="st_agree2" class="form-control form-control-sm"><?=$row['st_agree2']?></textarea>
							<script type="text/javascript">
							<!--
								CKEDITOR.replace('st_agree2', {
									extraPlugins: 'uploadimage, image2',
									height : '300px',
									filebrowserImageBrowseUrl : '',
									filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=st_agree2',
									enterMode : CKEDITOR.ENTER_BR,
								});
							//-->
							</script>
						</div>
					</div>

					<div class="form-group row">
						<label for="nt_title" class="col-sm-2 col-form-label">마케팅 정보 활용 동의</label>
						<div class="col-sm-10">
							<textarea name="st_agree3" id="st_agree3" class="form-control form-control-sm"><?=$row['st_agree3']?></textarea>
							<script type="text/javascript">
							<!--
								CKEDITOR.replace('st_agree3', {
									extraPlugins: 'uploadimage, image2',
									height : '300px',
									filebrowserImageBrowseUrl : '',
									filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=st_agree3',
									enterMode : CKEDITOR.ENTER_BR,
								});
							//-->
							</script>
						</div>
					</div>

					<!-- <div class="form-group row">
						<label for="st_kakao_channel" class="col-sm-2 col-form-label">고객센터 카카오채널</label>
						<div class="col-sm-3">
							<div class="input-group">
								<input type="text" name="st_kakao_channel" id="st_kakao_channel" value="<?=$row['st_kakao_channel']?>" class="form-control" />
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="st_kakao_channel_time" class="col-sm-2 col-form-label">고객센터 시간</label>
						<div class="col-sm-6">
							<div class="input-group">
								<input type="text" name="st_kakao_channel_time" id="st_kakao_channel_time" value="<?=$row['st_kakao_channel_time']?>" class="form-control" />
							</div>
						</div>
					</div> -->

					<p class="p-3 text-center">
						<input type="submit" value="수정" class="btn btn-outline-primary" />
					</p>

					</form>
					<script type="text/javascript">
						function frm_form_chk(f) {
							var oEditor1 = CKEDITOR.instances.st_agree1;
							var oEditor2 = CKEDITOR.instances.st_agree2;
							var oEditor3 = CKEDITOR.instances.st_agree3;

							if(oEditor1.getData()=="") {
								alert("내용을 입력해주세요.");
								oEditor1.focus();
								return false;
							}
							if(oEditor2.getData()=="") {
								alert("내용을 입력해주세요.");
								oEditor2.focus();
								return false;
							}
							if(oEditor3.getData()=="") {
								alert("내용을 입력해주세요.");
								oEditor3.focus();
								return false;
							}

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
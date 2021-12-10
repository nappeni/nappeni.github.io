<?
	include "./head_inc.php";
	$chk_menu = '4';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as bt_idx from banner_t a1
			where a1.idx = '".$_GET['bt_idx']."'
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
					<h4 class="card-title">배너관리</h4>

					<form method="post" name="frm_form" id="frm_form" action="./banner_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="bt_idx" id="bt_idx" value="<?=$row['bt_idx']?>" />
					<input type="hidden" name="bt_type" id="bt_type" value="1" />

					<div class="form-group row">
						<label for="bt_title" class="col-sm-2 col-form-label">제목</label>
						<div class="col-sm-10">
							<input type="text" name="bt_title" id="bt_title" value="<?=$row['bt_title']?>" class="form-control form-control-sm" />
						</div>
					</div>
					<div class="form-group row">
						<?
							$q = 1;
						?>
						<label for="bt_file<?=$q?>" class="col-sm-2 col-form-label">웹배너이미지</label>
						<div class="col-sm-10">
							<input type="file" name="bt_file<?=$q?>" id="bt_file<?=$q?>" value="<?=$row['bt_file'.$q]?>" accept=".gif, .jpg, .jpeg, .png, .gif, .bmp" class="d-none" />
							<input type="hidden" name="bt_file<?=$q?>_on" id="bt_file<?=$q?>_on" value="<?=$row['bt_file'.$q]?>" class="form-control" />

							<div class="float-left mr-3 mb-3">
								<a href="javascript:;" onclick="f_preview_image_delete('<?=$q?>', 'bt_file')"><label class="image_del" id="bt_file<?=$q?>_del"><i class="mdi mdi-close"></i></label></a>
								<label for="bt_file<?=$q?>" class="plus-input" id="bt_file<?=$q?>_box"><i class="mdi mdi-plus"></i></label>
							</div>
							<script type="text/javascript">
							<!--
								$('#bt_file<?=$q?>').on('change', function(e) {
									f_preview_image_selected(e, '<?=$q?>', 'bt_file');
								});

								<? if($row['bt_file'.$q]) { ?>
								$('#bt_file<?=$q?>_del').show();
								$("#bt_file<?=$q?>_box").css('border', 'none');
								$("#bt_file<?=$q?>_box").html('<img src="<?=$ct_img_url.'/'.$row['bt_file'.$q]?>?v=<?=time()?>" onerror="this.src=\'../images/noimg.png\'" />');
								<? } ?>
							//-->
							</script>

							<div class="clearfix"></div>

							<small id="bt_file<?=$q?>_help" class="form-text text-muted">권장크기 : 1920px X 780px (파일확장자 PNG로 등록)</small>
						</div>
					</div>
					<div class="form-group row">
						<?
							$q = 2;
						?>
						<label for="bt_file<?=$q?>" class="col-sm-2 col-form-label">모바일배너</label>
						<div class="col-sm-10">
							<input type="file" name="bt_file<?=$q?>" id="bt_file<?=$q?>" value="<?=$row['bt_file'.$q]?>" accept=".gif, .jpg, .jpeg, .png, .gif, .bmp" class="d-none" />
							<input type="hidden" name="bt_file<?=$q?>_on" id="bt_file<?=$q?>_on" value="<?=$row['bt_file'.$q]?>" class="form-control" />

							<div class="float-left mr-3 mb-3">
								<a href="javascript:;" onclick="f_preview_image_delete('<?=$q?>', 'bt_file')"><label class="image_del" id="bt_file<?=$q?>_del"><i class="mdi mdi-close"></i></label></a>
								<label for="bt_file<?=$q?>" class="plus-input" id="bt_file<?=$q?>_box"><i class="mdi mdi-plus"></i></label>
							</div>
							<script type="text/javascript">
							<!--
								$('#bt_file<?=$q?>').on('change', function(e) {
									f_preview_image_selected(e, '<?=$q?>', 'bt_file');
								});

								<? if($row['bt_file'.$q]) { ?>
								$('#bt_file<?=$q?>_del').show();
								$("#bt_file<?=$q?>_box").css('border', 'none');
								$("#bt_file<?=$q?>_box").html('<img src="<?=$ct_img_url.'/'.$row['bt_file'.$q]?>?v=<?=time()?>" onerror="this.src=\'../images/noimg.png\'" />');
								<? } ?>
							//-->
							</script>

							<div class="clearfix"></div>

							<small id="bt_file<?=$q?>_help" class="form-text text-muted">권장크기 : 1648px X 1920px (파일확장자 PNG로 등록)</small>
						</div>
					</div>
					<div class="form-group row">
						<label for="bt_link1" class="col-sm-2 col-form-label">웹URL</label>
						<div class="col-sm-10">
							<input type="text" name="bt_link1" id="bt_link1" value="<?=$row['bt_link1']?>" class="form-control form-control-sm" />
							<small id="select_category_help" class="form-text text-muted">
							* http:// 또는 https:// 를 포함한 url 을 등록바랍니다.
							</small>
						</div>
					</div>
					<div class="form-group row">
						<label for="bt_link1" class="col-sm-2 col-form-label">URL타겟</label>
						<div class="col-sm-2">
							<select name="bt_target1" id="bt_target1" class="form-control form-control-sm">
								<?=$arr_bt_target_option?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="bt_rank" class="col-sm-2 col-form-label">노출순서</label>
						<div class="col-sm-3">
							<input type="text" name="bt_rank" id="bt_rank" value="<?=$row['bt_rank']?>" class="form-control form-control-sm" numberOnly />

							<small id="select_category_help" class="form-text text-muted">
							* 낮을수록 먼저 노출 됩니다.
							</small>
						</div>
					</div>
					<div class="form-group row">
						<label for="bt_show" class="col-sm-2 col-form-label">노출여부</label>
						<div class="col-sm-2">
							<select name="bt_show" id="bt_show" class="form-control form-control-sm">
								<option value="Y">Y</option>
								<option value="N">N</option>
							</select>
						</div>
					</div>

					<p class="p-3 text-center">
						<input type="submit" value="확인" class="btn btn-outline-primary" />
						<input type="button" value="목록" onclick="location.href='./banner_list.php?<?=$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
					</p>

					</form>
					<script type="text/javascript">
						<? if($row['bt_show']) { ?>$('#bt_show').val('<?=$row['bt_show']?>');<? } ?>
						<? if($row['bt_type']) { ?>$('#bt_type').val('<?=$row['bt_type']?>');<? } ?>

						function frm_form_chk(f) {
							if(f.bt_title.value=="") {
								alert("제목을 입력해주세요.");
								f.bt_title.focus();
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
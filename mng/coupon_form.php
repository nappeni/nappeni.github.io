<?
	include "./head_inc.php";
	$chk_menu = '7';
	$chk_sub_menu = '3';
	$chk_ckeditor = 'N'; //CKEDITOR
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as ct_idx from coupon_t a1
			where a1.idx = '".$_GET['ct_idx']."'
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

					<form method="post" name="frm_form" id="frm_form" action="./coupon_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="ct_idx" id="ct_idx" value="<?=$row['ct_idx']?>" />

					<div class="form-group row">
						<label for="ct_title" class="col-sm-2 col-form-label">쿠폰명</label>
						<div class="col-sm-10">
							<input type="text" name="ct_title" id="ct_title" value="<?=$row['ct_title']?>" class="form-control form-control-sm" />
						</div>
					</div>
					<div class="form-group row">
						<label for="ct_type1" class="col-sm-2 col-form-label">쿠폰기간</label>
						<div class="col-sm-2">
							<select name="ct_type1" id="ct_type1" class="form-control form-control-sm" onchange="f_chg_type('1', this.value);">
								<option value="1">기간</option>
								<option value="2">발급일기준</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="ct_sdate" class="col-sm-2 col-form-label">기간</label>
						<div class="col-sm-4">
							<div class="input-group">
								<input type="text" name="ct_sdate" id="ct_sdate" value="<?=$row['ct_sdate']?>" class="form-control" readonly /> <span class="m-2">~</span> <input type="text" name="ct_edate" id="ct_edate" value="<?=$row['ct_edate']?>" class="form-control" readonly />
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="ct_days" class="col-sm-2 col-form-label">발급일기준</label>
						<div class="col-sm-2">
							<div class="input-group">
								<input type="text" name="ct_days" id="ct_days" value="<?=$row['ct_days']?>" class="form-control" numberOnly disabled />
								<div class="input-group-append">
									<span class="input-group-text" id="ct_days_add">일 까지</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="ct_discount1" class="col-sm-2 col-form-label">할인설정</label>
						<div class="col-sm-6">
							<div class="input-group">
								<input type="text" name="ct_discount1" id="ct_discount1" value="<?=$row['ct_discount1']?>" class="form-control" numberOnly />
								<select name="ct_type2" id="ct_type2" class="form-control ml-2" onchange="f_chg_type('2', this.value);">
									<option value="1">%</option>
									<option value="2">원</option>
								</select>
								<div class="input-group-append ml-2">
									<span class="input-group-text" id="ct_discount2_add1">최대</span>
								</div>
								<input type="text" name="ct_discount2" id="ct_discount2" value="<?=$row['ct_discount2']?>" class="form-control" numberOnly />
								<div class="input-group-append">
									<span class="input-group-text" id="ct_discount2_add2">원</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="ct_title" class="col-sm-2 col-form-label">노출여부</label>
						<div class="col-sm-2">
							<select name="ct_show" id="ct_show" class="form-control form-control-sm">
								<option value="Y">Y</option>
								<option value="N">N</option>
							</select>
						</div>
					</div>
					<? if($_GET['act']=="update") { ?>
					<div class="form-group row">
						<label for="ct_wdate" class="col-sm-2 col-form-label">일시</label>
						<div class="col-sm-10">
							<?=DateType($row['ct_wdate'], 6)?>
						</div>
					</div>
					<? } ?>

					<p class="p-3 text-center">
						<input type="submit" value="확인" class="btn btn-outline-primary" />
						<input type="button" value="목록" onclick="location.href='./coupon_list.php?<?=$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
					</p>

					</form>
					<script type="text/javascript">
						<? if($row['ct_type1']) { ?>$('#ct_type1').val('<?=$row['ct_type1']?>');<? } ?>
						<? if($row['ct_type2']) { ?>$('#ct_type2').val('<?=$row['ct_type2']?>');<? } ?>
						<? if($row['ct_show']) { ?>$('#ct_show').val('<?=$row['ct_show']?>');<? } ?>

						function frm_form_chk(f) {
							if(f.ct_title.value=="") {
								alert("제목을 입력해주세요.");
								f.ct_title.focus();
								return false;
							}

							$('#splinner_modal').modal('toggle');

							return true;
						}

						(function($) {
							'use strict';
							$(function() {
								jQuery.datetimepicker.setLocale('ko');

								jQuery(function () {
									jQuery('#ct_sdate').datetimepicker({
										format: 'Y-m-d',
										onShow: function (ct) {
											this.setOptions({
												maxDate: jQuery('#ct_edate').val() ? jQuery('#ct_edate').val() : false
											})
										},
										timepicker: false
									});
									jQuery('#ct_edate').datetimepicker({
										format: 'Y-m-d',
										onShow: function (ct) {
											this.setOptions({
												minDate: jQuery('#ct_sdate').val() ? jQuery('#ct_sdate').val() : false
											})
										},
										timepicker: false
									});
								});

								<? if($row['ct_type1']=='2') { ?>
								$('#ct_sdate').attr("disabled", true);
								$('#ct_edate').attr("disabled", true);
								$('#ct_days').removeAttr("disabled");
								$('#ct_sdate').val('');
								$('#ct_edate').val('');
								<? } else { ?>
								$('#ct_sdate').removeAttr("disabled");
								$('#ct_edate').removeAttr("disabled");
								$('#ct_days').attr("disabled", true);
								$('#ct_days').val('');
								<? } ?>
								<? if($row['ct_type2']=='2') { ?>
								$('#ct_discount2').attr("disabled", true);
								$('#ct_discount2').val('');
								<? } ?>
							});
						})(jQuery);


						function f_chg_type(type_t, val_t) {
							if(type_t=='1') {
								if(val_t=='2') {
									$('#ct_sdate').attr("disabled", true);
									$('#ct_edate').attr("disabled", true);
									$('#ct_days').removeAttr("disabled");
								} else {
									$('#ct_sdate').removeAttr("disabled");
									$('#ct_edate').removeAttr("disabled");
									$('#ct_days').attr("disabled", true);
								}
							} else if(type_t=='2') {
								if(val_t=='2') {
									$('#ct_discount2').attr("disabled", true);
								} else {
									$('#ct_discount2').removeAttr("disabled");
								}
							}

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
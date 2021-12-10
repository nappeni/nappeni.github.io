<?
	include "./head_inc.php";
	$chk_menu = "12";
	$chk_sub_menu = "2";
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select * from category_t a1
			where a1.ct_id = '".$_GET['ct_idx']."'
		";
		$row = $DB->fetch_query($query);

		$_act = "update";
		$_act_txt = " 수정";
	} else if($_GET['act']=="add") {
		$_act = "add";
		$_act_txt = " 추가";
	} else {
		$_act = "input";
		$_act_txt = " 입력";
	}
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">카테고리 설정</h4>

					<form method="post" name="frm_form" id="frm_form" action="./category_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="ct_id" id="ct_id" value="<?=$_GET['ct_idx']?>" />
					<input type="hidden" name="ct_level" id="ct_level" value="<?=($_GET['ct_level']+1)?>" />

					<div class="form-group row">
						<label for="ct_name" class="col-sm-2 col-form-label">분류명</label>
						<div class="col-sm-5">
							<input type="text" name="ct_name" id="ct_name" value="<?=$row['ct_name']?>" class="form-control form-control-sm" />
						</div>
					</div>
					<div class="form-group row">
						<label for="ct_rank" class="col-sm-2 col-form-label">출력순위</label>
						<div class="col-sm-3">
							<input type="text" name="ct_rank" id="ct_rank" value="<?=$row['ct_rank']?>" class="form-control form-control-sm" numberOnly />
							<small class="text-muted">숫자가 낮을수록 상위로 노출됩니다.</small>
						</div>
					</div>

					<p class="p-3 text-center">
						<input type="submit" value="확인" class="btn btn-info" />
						<input type="button" value="목록" onclick="location.href='./category_list.php'" class="btn btn-outline-secondary mx-2" />
					</p>

					</form>
					<script type="text/javascript">
						function frm_form_chk(f) {
							if(f.ct_name.value=="") {
								alert("분류명을 입력해주세요.");
								f.ct_name.focus();
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
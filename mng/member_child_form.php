<?
	include "./head_inc.php";
	$chk_menu = "1";
	$chk_sub_menu = "2";
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as mct_idx from member_child_t a1
			where a1.idx = '".$_GET['mct_idx']."'
		";
		$row = $DB->fetch_query($query);

		$_act = "update";
		$_act_txt = " 수정";
	}

	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=".$_GET['pg'];
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">자녀회원 <?=$_act_txt?></h4>

					<form method="post" name="frm_form" id="frm_form" action="./member_child_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="mct_idx" id="mct_idx" value="<?=$row['mct_idx']?>" />

					<ul class="nav nav-tabs" id="mct_tabs" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="tab_tab1" data-toggle="tab" href="#con_tab1" role="tab" aria-controls="con_tab1" aria-selected="false">기본정보</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="tab_tab2" data-toggle="tab" href="#con_tab2" role="tab" aria-controls="con_tab2" aria-selected="false">포인트정보</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="con_tab1" role="tabpanel" aria-labelledby="tab_tab1">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group row align-items-center">
										<label for="mct_code" class="col-sm-3 col-form-label">자녀코드</label>
										<div class="col-sm-9">
											<b><?=$row['mct_code']?></b>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mct_name" class="col-sm-3 col-form-label">자녀이름 <b class="text-danger">*</b></label>
										<div class="col-sm-4">
											<input type="text" name="mct_name" id="mct_name" value="<?=$row['mct_name']?>" class="form-control form-control-sm" />
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mct_grade" class="col-sm-3 col-form-label">학년 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<select name="mct_grade" id="mct_grade" class="custom-select" style="width: 100px;">
												<?=$arr_mct_grade_option?>
											</select>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mct_gender" class="col-sm-3 col-form-label">성별 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<select name="mct_gender" id="mct_gender" class="custom-select" style="width: 100px;">
												<?=$arr_mct_gender_option?>
											</select>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mct_birth" class="col-sm-3 col-form-label">생년월일 <b class="text-danger">*</b></label>
										<div class="col-sm-4">
											<input type="date" name="mct_birth" id="mct_birth" value="<?=$row['mct_birth']?>" class="form-control form-control-sm" />
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group row align-items-center">
										<label for="mt_parent_name" class="col-sm-3 col-form-label">학부모명</label>
										<div class="col-sm-9">
											<b><?=$row['mt_parent_name']?></b>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mct_klat_type1" class="col-sm-3 col-form-label">학습유형검사</label>
										<div class="col-sm-9">
											<?=$arr_mct_klat_type1[$row['mct_klat_type1']]?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mct_klat_type2" class="col-sm-3 col-form-label">인지능력검사</label>
										<div class="col-sm-9">
											<?=$arr_mct_klat_type2[$row['mct_klat_type2']]?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mct_memo" class="col-sm-3 col-form-label">자녀특징</label>
										<div class="col-sm-9">
											<?=nl2br($row['mct_memo'])?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mct_wdate" class="col-sm-3 col-form-label">등록일시</label>
										<div class="col-sm-9">
											<?=DateType($row['mct_wdate'], 4)?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="con_tab2" role="tabpanel" aria-labelledby="tab_tab2">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group row align-items-center">
										<label for="mct_point" class="col-sm-3 col-form-label">자녀포인트</label>
										<div class="col-sm-9">
											<?=number_format(get_mct_point($row['mct_idx']))?>
										</div>
									</div>
									<table class="table table-sm table-striped table-hover table-bordered">
										<thead class="thead-dark">
											<tr>
												<th scope="col" class="text-center">구분</th>
												<th scope="col" class="text-center">포인트</th>
												<th scope="col" class="text-center">내용</th>
												<th scope="col" class="text-center">일시</th>
												<th scope="col" class="text-center">삭제</th>
											</tr>
										</thead>
										<tbody>
											<?
												unset($list_pt);
												$query_pt = "select * from point_t where mct_idx = '".$row['mct_idx']."' order by idx desc";
												$list_pt = $DB->select_query($query_pt);

												if($list_pt) {
													foreach($list_pt as $row_pt) {
														if($row_pt['pt_type']=='P') {
															$pt_point_t = '+'.number_format($row_pt['pt_point']);
														} else if($row_pt['pt_type']=='M') {
															$pt_point_t = '-'.number_format($row_pt['pt_point']);
														}
											?>
											<tr>
												<td class="text-center"><?=$arr_pt_type[$row_pt['pt_type']]?></td>
												<td class="text-right pr-3"><?=$pt_point_t?></td>
												<td class="text-center"><?=$row_pt['pt_content']?></td>
												<td class="text-center"><?=DateType($row_pt['pt_wdate'], 6)?></td>
												<td class="text-center"><input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="f_point_del('<?=$row_pt['idx']?>');" /></td>
											</tr>
											<?
													}
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col-sm-6">
									<? if($chk_admin) { ?>
									<div class="form-group row align-items-center">
										<label for="pt_type" class="col-sm-3 col-form-label">포인트방식 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<select name="pt_type" id="pt_type" class="custom-select" style="width: 100px;">
												<?=$arr_pt_type_option?>
											</select>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="pt_point" class="col-sm-3 col-form-label">포인트 <b class="text-danger">*</b></label>
										<div class="col-sm-3">
											<input type="text" name="pt_point" id="pt_point" value="" class="form-control form-control-sm" placeholder="숫자만 입력바랍니다." maxlength="10" numberOnly />
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="pt_content" class="col-sm-3 col-form-label">내용 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<input type="text" name="pt_content" id="pt_content" value="" class="form-control form-control-sm" placeholder="포인트 내용을 간단히 기재바랍니다.(20자내외)" maxlength="50" />
										</div>
									</div>

									<div class="form-group row align-items-center">
										<div class="col-sm-12 text-center">
											<input type="button" onclick="f_point_input();" value="포인트 처리" class="btn btn-warning text-white" />
										</div>
									</div>
									<? } ?>
								</div>
							</div>
						</div>
					</div>

					<p class="p-3 mt-3 text-center">
						<input type="submit" value="수정" class="btn btn-info" />
						<input type="button" value="목록" onclick="location.href='./member_child_list.php?<?=$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
					</p>

					</form>
					<script type="text/javascript">
						$('#mem_tab a').on('click', function (e) {
							e.preventDefault()
							$(this).tab('show')
						});

						$(document).ready(function () {
							<? if($_GET['tabs']) { ?>
							$('#tab_tab<?=$_GET['tabs']?>').trigger('click');
							<? } ?>
						});

						function frm_form_chk(f) {
							if(f.mct_name.value=="") {
								alert("자녀이름을 입력해주세요.");
								f.mct_name.focus();
								return false;
							}
							if(f.mct_birth.value=="") {
								alert("생년월일을 입력해주세요.");
								f.mct_birth.focus();
								return false;
							}

							$('#splinner_modal').modal('toggle');

							return true;
						}

						function f_point_input() {
							var pt_type_t = $('#pt_type').val();
							var pt_point_t = $('#pt_point').val();
							var pt_content_t = $('#pt_content').val();

							if(pt_point_t=='') {
								alert('포인트를 입력바랍니다.');
								$('#pt_point').focus();
								return false;
							}
							if(pt_content_t=='') {
								alert('내용을 입력바랍니다.');
								$('#pt_content').focus();
								return false;
							}

							$('#splinner_modal').modal('toggle');

							$.post('./member_child_update.php', {act: 'point_input', mt_idx: '<?=$row['mt_idx']?>', mct_idx: '<?=$row['mct_idx']?>', pt_type: pt_type_t, pt_point: pt_point_t, pt_content: pt_content_t}, function (data) {
								if(data=='Y') {
									alert('등록되었습니다.');
									document.location.href = './member_child_form.php?act=update&mct_idx=<?=$row['mct_idx']?>&<?=$_get_txt?>&tabs=2';
								} else {
									console.log(data);
								}
							});

							return false;
						}

						function f_point_del(pt_idx) {
							if(confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.")) {
								$.post('./member_child_update.php', {act: 'point_delete', pt_idx: pt_idx}, function (data) {
									if(data=='Y') {
										alert('삭제되었습니다.');
										document.location.href = './member_child_form.php?act=update&mct_idx=<?=$row['mct_idx']?>&<?=$_get_txt?>&tabs=2';
									} else {
										console.log(data);
									}
								});
							}

							return false;
						}

						<? if($row['mct_grade']) { ?>$('#mct_grade').val('<?=$row['mct_grade']?>');<? } ?>
						<? if($row['mct_gender']) { ?>$('#mct_gender').val('<?=$row['mct_gender']?>');<? } ?>
						<? if($row['mct_klat_type1']) { ?>$('#mct_klat_type1').val('<?=$row['mct_klat_type1']?>');<? } ?>
						<? if($row['mct_klat_type2']) { ?>$('#mct_klat_type2').val('<?=$row['mct_klat_type2']?>');<? } ?>
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
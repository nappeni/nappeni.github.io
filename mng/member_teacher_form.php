<?
	include "./head_inc.php";
	$chk_menu = "1";
	$list_url_t = "member_teacher_list.php";
	$chk_sub_menu = "3";
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as mt_idx from member_t a1
			where a1.idx = '".$_GET['mt_idx']."'
		";
		$row = $DB->fetch_query($query);

		$_act = "update";
		$_act_txt = " 수정";
	} else {
		$_act = "input";
		$_act_txt = " 등록";
	}

	$_get_txt = "sel_search=".$_GET['sel_search']."&sel_order=".$_GET['sel_order']."&sel_status=".$_GET['sel_status']."&search_txt=".$_GET['search_txt']."&pg=".$_GET['pg'];
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">교육업체/선생님 회원<?=$_act_txt?></h4>

					<form method="post" name="frm_form" id="frm_form" action="./member_teacher_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="mt_idx" id="mt_idx" value="<?=$row['mt_idx']?>" />
					<input type="hidden" name="mt_id_chk" id="mt_id_chk" value="N" />

					<ul class="nav nav-tabs" id="mem_tab" role="tablist">

						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="tab_tab1" data-toggle="tab" href="#con_tab1" role="tab" aria-controls="con_tab1" aria-selected="false">기본정보</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="tab_tab3" data-toggle="tab" href="#con_tab3" role="tab" aria-controls="con_tab3" aria-selected="false"><? if($_act=='update') { ?>승인관리<? } else { ?>프로필<? } ?></a>
						</li>
						<? if($_act=='update') { ?>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="tab_tab2" data-toggle="tab" href="#con_tab2" role="tab" aria-controls="con_tab2" aria-selected="false">접속정보</a>
						</li>
						<? } ?>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="con_tab1" role="tabpanel" aria-labelledby="tab_tab1">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group row align-items-center">
										<label for="mt_id" class="col-sm-3 col-form-label">아이디</label>
										<div class="col-sm-9">
											<? if($_act=='input') { ?>
											<div class="form-inline">
												<input type="text" name="mt_id" id="mt_id" value="" class="form-control form-control-sm" />
												<input type="button" class="btn btn-primary ml-2" id="mt_id_chk_btn" value="아이디 중복확인" onclick="f_chk_mt_id();" />
											</div>
											<? } else { ?>
											<b><?=$row['mt_id']?></b>
											<? } ?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_pwd" class="col-sm-3 col-form-label">비밀번호 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<input type="password" name="mt_pwd" id="mt_pwd" value="" class="form-control form-control-sm" />
											<small id="mt_pwd_help" class="form-text text-muted">* 비밀번호 변경시에는 비밀번호 확인까지 입력바랍니다.</small>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_pwd_re" class="col-sm-3 col-form-label">비밀번호 확인 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<input type="password" name="mt_pwd_re" id="mt_pwd_re" value="" class="form-control form-control-sm" />
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group row align-items-center">
										<label for="mt_name" class="col-sm-3 col-form-label">이름 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<input type="text" name="mt_name" id="mt_name" value="<?=$row['mt_name']?>" class="form-control form-control-sm" />
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_hp" class="col-sm-3 col-form-label">연락처 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<input type="text" name="mt_hp" id="mt_hp" value="<?=$row['mt_hp']?>" numberOnly class="form-control form-control-sm" placeholder="- 없이 입력바랍니다." />
										</div>
									</div>
									<? if($_act=='update') { ?>
									<div class="form-group row align-items-center">
										<label for="mt_point" class="col-sm-3 col-form-label">수업정보</label>
										<div class="col-sm-9">
											<table class="table table-striped table-hover table-bordered">
												<tbody>
													<tr>
														<th class="text-center">수업개설수</td>
														<td class="text-center">0 개</td>
													</tr>
													<tr>
														<th class="text-center">누적수업진행횟수</td>
														<td class="text-center">0 건</td>
													</tr>
													<tr>
														<th class="text-center">누적수업확정개수</td>
														<td class="text-center">0 회</td>
													</tr>
													<tr>
														<th class="text-center">누적수강자수</td>
														<td class="text-center">0 명</td>
													</tr>
													<tr>
														<th class="text-center">만족도평점</td>
														<td class="text-center">4.0</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<? } ?>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="con_tab2" role="tabpanel" aria-labelledby="tab_tab2">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group row align-items-center">
										<label for="mt_status" class="col-sm-3 col-form-label">로그인가능</label>
										<div class="col-sm-9">
											<select name="mt_status" id="mt_status" class="custom-select" style="width: 100px;">
												<?=$arr_mt_status_option?>
											</select>
											<small id="mt_status_help" class="form-text text-muted">* 'N'으로 선택시 로그인이 차단됩니다.</small>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_smsing" class="col-sm-3 col-form-label">문자수신</label>
										<div class="col-sm-9">
											<select name="mt_smsing" id="mt_smsing" class="custom-select" style="width: 100px;">
												<option value="Y">Y</option>
												<option value="N">N</option>
											</select>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_mailing" class="col-sm-3 col-form-label">메일수신</label>
										<div class="col-sm-9">
											<select name="mt_mailing" id="mt_mailing" class="custom-select" style="width: 100px;">
												<option value="Y">Y</option>
												<option value="N">N</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group row align-items-center">
										<label for="mt_wdate" class="col-sm-3 col-form-label">가입일시</label>
										<div class="col-sm-9">
											<?=DateType($row['mt_wdate'], 4)?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_ldate" class="col-sm-3 col-form-label">로그인일시</label>
										<div class="col-sm-9">
											<?=DateType($row['mt_ldate'], 4)?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_lgdate" class="col-sm-3 col-form-label">로그아웃일시</label>
										<div class="col-sm-9">
											<?=DateType($row['mt_lgdate'], 4)?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="con_tab3" role="tabpanel" aria-labelledby="tab_tab3">
							<div class="row">
								<? if($_act=='update') { ?>
								<div class="col-sm-6">
									<div class="form-group row align-items-center">
										<label for="mt_status" class="col-sm-3 col-form-label">승인일시</label>
										<div class="col-sm-9">
											<?=DateType($row['mt_tdate'], 4)?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_teacher" class="col-sm-3 col-form-label">승인관리 <b class="text-danger">*</b></label>
										<div class="col-sm-3">
											<select name="mt_teacher" id="mt_teacher" class="custom-select" style="width: 100px;">
												<?=$arr_mt_teacher_option?>
											</select>
										</div>
										<div class="col-sm-6">
											<input type="text" name="mt_teacher_decline" id="mt_teacher_decline" value="<?=$row['mt_teacher_decline']?>" placeholder="승인거절사유를 입력바랍니다." class="form-control form-control-sm" />
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_point" class="col-sm-3 col-form-label">회원유형</label>
										<div class="col-sm-9">
											<?=$arr_mt_iscom[$row['mt_iscom']]?>
										</div>
									</div>
								</div>
								<? } ?>
								<div class="col-sm-6">
									<? if($_act=='input') { ?>
									<div class="form-group row align-items-center">
										<label for="mt_iscom" class="col-sm-3 col-form-label">업체유형</label>
										<div class="col-sm-9">
											<select name="mt_iscom" id="mt_iscom" class="custom-select" style="width: 100px;">
												<option value="">선택</option>
												<?=$arr_mt_iscom_option?>
											</select>
										</div>
									</div>
									<? } ?>

									<div class="form-group row align-items-center">
										<label for="mt_company" class="col-sm-3 col-form-label">업체명 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<input type="text" name="mt_company" id="mt_company" value="<?=$row['mt_company']?>" class="form-control form-control-sm" />
											<small id="mt_company_help" class="form-text text-muted">* 업체명 입력시 회원유형이 교육업체로 등록됩니다.</small>
										</div>
									</div>

									<div class="form-group row">
										<label for="mt_photo1" class="col-sm-3 col-form-label">프로필이미지 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<?
												$q = 1;
											?>
											<input type="file" name="mt_photo<?=$q?>" id="mt_photo<?=$q?>" value="<?=$row['mt_photo'.$q]?>" accept=".gif, .jpg, .jpeg, .png, .gif, .bmp" class="d-none" />
											<input type="hidden" name="mt_photo<?=$q?>_on" id="mt_photo<?=$q?>_on" value="<?=$row['mt_photo'.$q]?>" class="form-control" />

											<div class="float-left mr-3 mb-3">
												<a href="javascript:;" onclick="f_preview_image_delete('<?=$q?>', 'mt_photo')"><label class="image_del" id="mt_photo<?=$q?>_del"><i class="mdi mdi-close"></i></label></a>
												<label for="mt_photo<?=$q?>" class="plus-input" id="mt_photo<?=$q?>_box"><i class="mdi mdi-plus"></i></label>
											</div>
											<script type="text/javascript">
											<!--
												$('#mt_photo<?=$q?>').on('change', function(e) {
													f_preview_image_selected(e, '<?=$q?>', 'mt_photo');
												});

												<? if($row['mt_photo'.$q]) { ?>
												$('#mt_photo<?=$q?>_del').show();
												$("#mt_photo<?=$q?>_box").css('border', 'none');
												$("#mt_photo<?=$q?>_box").html('<img src="<?=$ct_img_url.'/'.$row['mt_photo'.$q]?>?v=<?=time()?>" onerror="this.src=\'../images/noimg.png\'" />');
												<? } ?>
											//-->
											</script>

											<div class="clearfix"></div>

											<small id="select_category_help" class="form-text text-muted">
											권장 크기 : 1,000px x 1,000px<br/>
											jpg,jpeg,gif,png,bmp 형식의 정지 이미지만 등록됩니다.
											</small>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_profile" class="col-sm-3 col-form-label">요약소개 <b class="text-danger">*</b></label>
										<div class="col-sm-9">
											<input type="text" name="mt_profile" id="mt_profile" value="<?=$row['mt_profile']?>" class="form-control form-control-sm" />
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_company_info" class="col-sm-3 col-form-label">상세소개</label>
										<div class="col-sm-9">
											<textarea name="mt_company_info" id="mt_company_info" class="form-control form-control-sm" style="height: 10vh"><?=$row['mt_company_info']?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<p class="p-3 mt-3 text-center">
						<input type="submit" value="<? if($_act=='update') { ?>수정<? } else { ?>신규등록<? } ?>" class="btn btn-info" />
						<input type="button" value="목록" onclick="location.href='./<?=$list_url_t?>?<?=$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
						<? if($_act=='update') { ?>
						<? if($_GET['form_type']!='R') { ?>
						<input type="button" value="탈퇴" onclick="f_retire_mem('<?=$row['mt_idx']?>')" class="btn btn-outline-danger" />
						<? } ?>
						<? } ?>
					</p>

					</form>
					<script type="text/javascript">
						$('#mem_tab a').on('click', function (e) {
							e.preventDefault()
							$(this).tab('show')
						})

						function frm_form_chk(f) {
							<? if($_act) { ?>
							if(f.mt_id.value=="") {
								alert("아이디를 입력해주세요.");
								f.mt_id.focus();
								return false;
							}
							if(f.mt_id_chk.value!="Y") {
								alert("아이디 중복확인을 해주세요.");
								f.mt_id.focus();
								return false;
							}
							if(f.mt_pwd.value=="") {
								alert("비밀번호를 입력해주세요.");
								f.mt_pwd.focus();
								return false;
							}
							if(f.mt_pwd_re.value=="") {
								alert("비밀번호 확인을 입력해주세요.");
								f.mt_pwd_re.focus();
								return false;
							}
							if(f.mt_pwd.value!=f.mt_pwd_re.value) {
								alert("비밀번호가 동일하지 않습니다.");
								f.mt_pwd.focus();
								return false;
							}
							if(f.mt_name.value=="") {
								alert("이름을 입력해주세요.");
								f.mt_name.focus();
								return false;
							}
							if(f.mt_hp.value=="") {
								alert("연락처를 입력해주세요.");
								f.mt_hp.focus();
								return false;
							}
							if(f.mt_company.value=="") {
								alert("업체명을 입력해주세요.");
								f.mt_company.focus();
								return false;
							}
							if(f.mt_profile.value=="") {
								alert("요약소개를 입력해주세요.");
								f.mt_profile.focus();
								return false;
							}
							<? } else { ?>
							if(f.mt_name.value=="") {
								alert("이름을 입력해주세요.");
								f.mt_name.focus();
								return false;
							}
							if(f.mt_hp.value=="") {
								alert("연락처를 입력해주세요.");
								f.mt_hp.focus();
								return false;
							}
							if(f.mt_pwd.value!="" && f.mt_pwd_re.value=="") {
								alert("비밀번호 변경시 비밀번호 확인까지 입력해주세요.");
								f.mt_pwd_re.focus();
								return false;
							}
							if(f.mt_pwd.value=="" && f.mt_pwd_re.value!="") {
								alert("비밀번호 변경시 비밀번호 확인까지 입력해주세요.");
								f.mt_pwd.focus();
								return false;
							}
							if(f.mt_profile.value=="") {
								alert("요약소개를 입력해주세요.");
								f.mt_profile.focus();
								return false;
							}
							<? } ?>

							$('#splinner_modal').modal('toggle');

							return true;
						}

						function f_chk_mt_id() {
							if($('#mt_id').val()=="") {
								alert("아이디를 입력해주세요.");
								$('#mt_id').focus();
								return false;
							}

							$.post('./member_teacher_update.php', {act: 'mt_id_chk', mt_id: $('#mt_id').val()}, function (data) {
								if(data=='Y') {
									alert('등록가능한 아이디입니다.');
									$('#mt_id_chk').val('Y');
									$("#mt_id").prop("readonly", true);
									$("#mt_id").css("background-color", "#e9ecef");
									$("#mt_id_chk_btn").hide();
								} else {
									alert('중복된 아이디가 존재합니다.');
									$('#mt_id_chk').val('N');
									$('#mt_id').val('');
									$('#mt_id').focus();
								}
							});
						}

						<? if($row['mt_status']) { ?>$('#mt_status').val('<?=$row['mt_status']?>');<? } ?>
						<? if($row['mt_smsing']) { ?>$('#mt_smsing').val('<?=$row['mt_smsing']?>');<? } ?>
						<? if($row['mt_mailing']) { ?>$('#mt_mailing').val('<?=$row['mt_mailing']?>');<? } ?>
						<? if($row['mt_teacher']) { ?>$('#mt_teacher').val('<?=$row['mt_teacher']?>');<? } ?>
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
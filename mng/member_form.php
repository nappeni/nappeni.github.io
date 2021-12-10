<?
	include "./head_inc.php";
	$chk_menu = "1";
	if($_GET['form_type']=='R') {
		$cart_title_t = "탈퇴회원";
		$list_url_t = "member_retire_list.php";
		$chk_sub_menu = "5";
	} else {
		$cart_title_t = "부모회원";
		$list_url_t = "member_list.php";
		$chk_sub_menu = "1";
	}
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

	if($row['mt_level']=='5') {
		$seller_info = true;
	} else {
		$seller_info = true;
	}

	if($row['mt_seller']=='D') {
		$seller_info = true;
	}

	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=".$_GET['pg'];
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><?=$cart_title_t?><?=$_act_txt?></h4>

					<form method="post" name="frm_form" id="frm_form" action="./member_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="mt_idx" id="mt_idx" value="<?=$row['mt_idx']?>" />

					<ul class="nav nav-tabs" id="mem_tab" role="tablist">

						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="tab_tab1" data-toggle="tab" href="#con_tab1" role="tab" aria-controls="con_tab1" aria-selected="false">기본정보</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="tab_tab2" data-toggle="tab" href="#con_tab2" role="tab" aria-controls="con_tab2" aria-selected="false">접속정보</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="con_tab1" role="tabpanel" aria-labelledby="tab_tab1">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group row align-items-center">
										<label for="mt_id" class="col-sm-3 col-form-label">아이디</label>
										<div class="col-sm-9">
											<b><?=$row['mt_id']?></b>
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

									<div class="form-group row align-items-center">
										<label for="mt_point" class="col-sm-3 col-form-label">임직원관계</label>
										<div class="col-sm-9">
											<?=$arr_mt_executives_chk[$row['mt_executives_chk']]?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_point" class="col-sm-3 col-form-label">자녀와의 관계</label>
										<div class="col-sm-9">
											<?=$arr_mt_child_chk[$row['mt_child_chk']]?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_point" class="col-sm-3 col-form-label">등록자녀</label>
										<div class="col-sm-9">
											<table class="table table-striped table-hover table-bordered">
												<thead class="thead-dark">
													<tr>
														<th scope="col" class="text-center">이름</th>
														<th scope="col" class="text-center">학년</th>
														<th scope="col" class="text-center">학습유형</th>
														<th scope="col" class="text-center">인지능력</th>
													</tr>
												</thead>
												<tbody>
													<?
														unset($list_mct);
														$query_mct = "select * from member_child_t where mt_idx = '".$row['mt_idx']."' order by idx desc";
														$list_mct = $DB->select_query($query_mct);

														if($list_mct) {
															foreach($list_mct as $row_mct) {
													?>
													<tr>
														<td class="text-center"><a href="./member_child_form.php?act=update&mct_idx=<?=$row_mct['idx']?>" target="_blank"><?=$row_mct['mct_name']?></a></td>
														<td class="text-center"><?=$arr_mct_grade[$row_mct['mct_grade']]?></td>
														<td class="text-center"><?=$arr_mct_klat_type1[$row_mct['mct_klat_type1']]?></td>
														<td class="text-center"><?=$arr_mct_klat_type1[$row_mct['mct_klat_type2']]?></td>
													</tr>
													<?
															}
														}
													?>
												</tbody>
											</table>
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
											<input type="text" name="mt_hp" id="mt_hp" value="<?=$row['mt_hp']?>" class="form-control form-control-sm" />
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_tel" class="col-sm-3 col-form-label">보조연락처</label>
										<div class="col-sm-9">
											<input type="text" name="mt_tel" id="mt_tel" value="<?=$row['mt_tel']?>" class="form-control form-control-sm" />
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_point" class="col-sm-3 col-form-label">현재포인트</label>
										<div class="col-sm-9">
											<?=number_format(get_mt_point($row['mt_idx']))?>
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_tel" class="col-sm-3 col-form-label">누적구매횟수</label>
										<div class="col-sm-9">
											<?=number_format($row['mt_point'])?> 회
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_tel" class="col-sm-3 col-form-label">만족도평가횟수</label>
										<div class="col-sm-9">
											<?=number_format($row['mt_point'])?> 회
										</div>
									</div>

									<div class="form-group row align-items-center">
										<label for="mt_tel" class="col-sm-3 col-form-label">누적금액</label>
										<div class="col-sm-9">
											<?=number_format($row['mt_point'])?>
										</div>
									</div>
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
					</div>

					<p class="p-3 mt-3 text-center">
						<input type="submit" value="수정" class="btn btn-info" />
						<input type="button" value="목록" onclick="location.href='./<?=$list_url_t?>?<?=$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
						<? if($_GET['form_type']!='R') { ?>
						<input type="button" value="탈퇴" onclick="f_retire_mem('<?=$row['mt_idx']?>')" class="btn btn-outline-danger" />
						<? } ?>
					</p>

					</form>
					<script type="text/javascript">
						$('#mem_tab a').on('click', function (e) {
							e.preventDefault()
							$(this).tab('show')
						})

						function frm_form_chk(f) {
							if(f.mt_name.value=="") {
								alert("성명을 입력해주세요.");
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

							$('#splinner_modal').modal('toggle');

							return true;
						}

						<? if($row['mt_status']) { ?>$('#mt_status').val('<?=$row['mt_status']?>');<? } ?>
						<? if($row['mt_smsing']) { ?>$('#mt_smsing').val('<?=$row['mt_smsing']?>');<? } ?>
						<? if($row['mt_mailing']) { ?>$('#mt_mailing').val('<?=$row['mt_mailing']?>');<? } ?>
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
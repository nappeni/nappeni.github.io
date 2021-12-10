<?
	include "./head_inc.php";
	$chk_menu = '10';
	$chk_sub_menu = '1';
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as mmt_idx from member_message_t a1
			where a1.idx = '".$_GET['mmt_idx']."'
		";
		$row = $DB->fetch_query($query);

		$_act = "update";
		$_act_txt = " 수정";

		$mmt_content_byte = mb_strwidth($row['mmt_content']);
	} else {
		$_act = "input";
		$_act_txt = " 입력";
	}

	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=".$_GET['pg'];
?>
<style type="text/css">
.phone_box {
	width:222px;
	height:336px;
	background: url("<?=CDN_HTTP?>/images/bg_phone.png") no-repeat left top;
}
.phone_box .sms {
	background: transparent;
	font-size: 13px;
	color: #666;
	border: 0;
	width: 162px;
	height: 177px;
	margin: 55px 30px 0px 30px;
}
.phone_box p span {
	color: #666;
}
</style>
<script type="text/javascript">
<!--
	function countBytes(msgObj) {
		var chr = "",
			chrLength = 0,
			validMsgLength = 0,
			validChrLength = 0,
			validMsg = "",
			bytesVal = "",
			maxBytes = 0;
		var orgMsg = msgObj.value;

		maxBytes = 90;

		for (var i = 0; i < msgObj.value.length; i++) {
			chr = msgObj.value.charAt(i);
			if (escape(chr).length > 4) {
				chrLength += 2;
			} else if (chr != "\r") {
				chrLength++;
			}
			if (chrLength <= maxBytes) {
				validMsgLength = i + 1;
				validChrLength = chrLength;
			}
		}

		if (chrLength > maxBytes ) {
			var confirm_mode = confirm(maxBytes + "바이트가 초과되었습니다. 초과된 문자는 발송되지 않습니다.");
			if (confirm_mode == true) {
				validMsg = msgObj.value.substr(0, validMsgLength);
				msgObj.value = validMsg;
				bytesVal = validChrLength;
			} else {
				return false;
			}
		} else {
			bytesVal = validChrLength;
		}

		$("#typing_sms").html(bytesVal + "/90 byte");
	}
//-->
</script>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">메세지 발송</h4>

					<form method="post" name="frm_form" id="frm_form" action="./member_message_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="mmt_idx" id="mmt_idx" value="<?=$row['mmt_idx']?>" />

					<div class="form-group row">
						<label for="mmt_title" class="col-sm-2 col-form-label">제목</label>
						<div class="col-sm-10">
							<input type="text" name="mmt_title" id="mmt_title" value="<?=$row['mmt_title']?>" class="form-control form-control-sm" />
						</div>
					</div>
					<div class="form-group row">
						<label for="mmt_content" class="col-sm-2 col-form-label">내용</label>
						<div class="col-sm-5">
							<div class="phone_box">
								<textarea id="mmt_content" name="mmt_content" class="sms" onchange="countBytes(this);" onkeyup="countBytes(this);" onclick="countBytes(this);"><?=$row['mmt_content']?></textarea>
								<p class="text-center">
									<span id="typing_sms"><?=$mmt_content_byte?>/90 byte</span>
								</p>
							</div>
							<small id="mmt_content_help" class="form-text text-muted">* 90바이트 까지만 전송됩니다.<br/>* SMS 문자로만 전송됩니다.</small>
						</div>
					</div>
					<div class="form-group row">
						<label for="search_member" class="col-sm-2 col-form-label">회원</label>
						<div class="col-sm-4">
							<input type="text" name="search_member" id="search_member" value="" class="form-control form-control-sm" onkeyup="f_search_member(this.value);" autocomplete="off" placeholder="아이디 또는 이름을 입력해주세요." />
							<div class="pre-scrollable"><ul class="pt-2 list-group" id="search_member_box"></ul></div>
						</div>
						<div class="col-sm-4">
							<div class="pre-scrollable">
								<ul class="list-group" id="selected_member_box">
									<?
										$mmt_mt_idx_ex = explode(',', $row['mmt_mt_idx']);

										if($mmt_mt_idx_ex) {
											foreach($mmt_mt_idx_ex as $key => $val) {
												$mt_info = get_mem_info($val);

												if($mt_info['idx']) {
									?>
									<li id="selected_mt_idx_<?=$mt_info['idx']?>" class="list-group-item d-flex justify-content-between align-items-center"><?=$mt_info['mt_name']?>(<?=$mt_info['mt_hp']?>)<input type="hidden" name="mmt_mt_idx[]" value="<?=$mt_info['idx']?>"><a href="javascript:;" onclick="f_search_member_delete('selected_mt_idx_<?=$mt_info['idx']?>')"><span class="badge badge-danger badge-pill">삭제</span></a></li>
									<?
												}
											}
										}
									?>
								</ul>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="mmt_send" class="col-sm-2 col-form-label">발송체크</label>
						<div class="col-sm-3">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="mmt_send" name="mmt_send" value="Y"<? if($row['mmt_send']=='Y') { ?> checked<? } ?> />
								<label class="custom-control-label" for="mmt_send">발송을 원하시면 체크바랍니다.</label>
							</div>
						</div>
					</div>
					<? if($_GET['act']=="update") { ?>
					<div class="form-group row">
						<label for="mmt_wdate" class="col-sm-2 col-form-label">일시</label>
						<div class="col-sm-10">
							<?=DateType($row['mmt_wdate'], 6)?>
						</div>
					</div>
					<? } ?>

					<p class="p-3 text-center">
						<input type="submit" value="확인" class="btn btn-outline-primary" />
						<input type="button" value="목록" onclick="location.href='./member_message_list.php?<?=$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
					</p>

					</form>
					<script type="text/javascript">
						function frm_form_chk(f) {
							if(f.mmt_title.value=="") {
								alert("제목을 입력해주세요.");
								f.mmt_title.focus();
								return false;
							}
							if(f.mmt_content.value=="") {
								alert("내용을 입력해주세요.");
								f.mmt_content.focus();
								return false;
							}
							if($('input[name="mmt_mt_idx[]"]').length<1) {
								alert("발송될 회원을 검색해주세요.");
								f.search_member.focus();
								return false;
							}

							$('#splinner_modal').modal('toggle');

							return true;
						}

						function f_search_member(stxt) {
							$('#search_member_box').show();
							$.post('./member_message_update.php', {act: 'search_member', stxt: stxt}, function (data) {
								if(data) {
									$('#search_member_box').html(data);
								}
							});

							return false;
						}

						function f_search_member_selected(mt_idx, mt_name, mt_hp) {
							var chk_append = false;

							if($('input[name="mmt_mt_idx[]"]').length<1) {
								chk_append = true;
							} else {
								var chk_mt_idx = 0;
								$('input[name="mmt_mt_idx[]"]').each(function() {
									if($(this).val()==mt_idx) {
										chk_mt_idx++;
									}
								});

								if(chk_mt_idx<1) {
									chk_append = true;
								} else {
									chk_append = false;
								}
							}

							if(chk_append==true) {
								$('#selected_member_box').append('<li id="selected_mt_idx_'+mt_idx+'" class="list-group-item d-flex justify-content-between align-items-center">'+mt_name+'('+mt_hp+')<input type="hidden" name="mmt_mt_idx[]" value="'+mt_idx+'"><a href="javascript:;" onclick="f_search_member_delete(\'selected_mt_idx_'+mt_idx+'\')"><span class="badge badge-danger badge-pill">삭제</span></a></li>');
							}

							return false;
						}

						function f_search_member_delete(obj) {
							$('#'+obj).remove();

							return false;
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
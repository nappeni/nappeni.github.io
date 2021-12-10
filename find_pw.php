<?
	include "./head_inc.php";
?>
<div class="top_pd">
	<div class="sub_pg sub_bg">
		<div class="container-sm">
			<div class="mx_480 mx-auto">
				<div class="tit text-center">
					<strong class="ff_sr fc_gr222 fs_40 mb-2 mb-lg-3">비밀번호찾기</strong>
					<p class="fw_300 fc_gr666 fs_20">플라이스쿨에 오신것을 환영합니다.</p>
				</div>
				<form role="form" method="post" name="frm_findpw" id="frm_findpw" action="./join_update.php" onsubmit="return frm_findpw_chk(this);" target="hidden_ifrm">
					<input type="hidden" name="act" id="act" value="find_pw" />
					<div class="input-group mb-3">
						<input type="email" class="form-control" name="mt_id" id="mt_id" value="" placeholder="아이디(이메일)를 입력해 주세요" />
					</div>
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="mt_name" id="mt_name" value="" placeholder="부모님 이름을 입력해 주세요" />
					</div>
					<button type="submit" class="btn btn-primary btn-lg btn-block">비밀번호찾기</button>
					<div class="mt_20">
						<span class="text-muted">* 요청된 비밀번호는 임의로 변경하여 이메일로 전송됩니다.</span>
					</div>
				</form>
			</div>

			<script type="text/javascript">
			<!--
				function frm_findpw_chk(f) {
					if(f.mt_id.value=="") {
						alert("아이디를 등록해주세요.");
						f.mt_id.focus();
						return false;
					}
					if(f.mt_name.value=="") {
						alert("부모 이름을 등록해주세요.");
						f.mt_name.focus();
						return false;
					}

					$('#splinner_modal').modal('show');

					return true;
				}
			//-->
			</script>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
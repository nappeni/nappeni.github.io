<?
	include "./head_inc.php";
	include "./head_menu_inc.php";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">일반 회원</h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3">
                            <input name="u_status" type="radio" value="A"> <label>전체</label>
                            <input name="u_status" type="radio" value="Y"> <label>정상</label>
                            <input name="u_status" type="radio" value="S"> <label>휴먼</label>
                            <input name="u_status" type="radio" value="N"> <label>탈퇴</label>
                        </div>
						<div class="col-xl-9">
							<div class="float-right">
							<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
								<p>날짜</p>
                                <div class="form-group ml-1">
									<select name="sel_search" id="sel_search" class="form-control form-control-sm">
										<option value="all">이름</option>
										<option value="a1.nt_title">아이디</option>
										<option value="a1.nt_content">휴대전화</option>
									</select>
								</div>

								<div class="form-group ml-1">
									<input type="text" class="form-control form-control-sm" style="width:200px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" placeholder="검색어를 입력바랍니다." />
								</div>

								<div class="form-group ml-1">
									<input type="submit" class="btn btn-info" value="검색" />
								</div>
							</form>
							<script type="text/javascript">
								function frm_search_chk(f) {
									if(f.search_txt.value=="") {
										alert("검색어를 입력바랍니다.");
										f.search_txt.focus();
										return false;
									}

									return true;
								}
							</script>
							</div>
						</div>
					</div>

					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead class="thead-dark">
						<tr>
                            <th class="text-center" style="width:50px;">
								<input name="userList" type="checkBox">
							</th>
							<th class="text-center" style="width:80px;">
								번호
							</th>
							<th class="text-center" style="width:150px;">
								이름
							</th>
							<th class="text-center" style="width:300px;">
								아이디
							</th>
							<th class="text-center" style="width:200px;">
								휴대전화
							</th>
							<th class="text-center" style="width:140px;">
								가입 날짜
							</th>
                            <th class="text-center" style="width:90px;">
								가입 형태
							</th>
                            <th class="text-center" style="width:90px;">
                                상태
							</th>
							<th class="text-center" style="width:140px;">
								관리
							</th>
						</tr>
						</thead>
						<tbody>
						<tr>
                            <td class="text-center">
                                <input name="userList" type="checkBox">
                            </td>
							<td class="text-center">
							</td>
							<td>
								<p class="text-truncate" style="max-width: 600px;"></p>
							</td>
							<td class="text-center">
							</td>
							<td class="text-center">
							</td>
							</td>
                            <td>

                            </td>
                            <td>
                                
                            </td>
                            <td>
                                
                            </td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="location.href='./notice_form.php?act=update&nt_idx=<?=$row['nt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" /> <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="f_post_del('./notice_update.php', '<?=$row['nt_idx']?>');" />
							</td>
						</tr>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
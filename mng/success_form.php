<?
	include "./head_inc.php";
	$chk_menu = '8';
	$chk_sub_menu = '4';
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
					<h4 class="card-title">성공사례 관리</h4>
					<form method="post" name="frm_form" id="frm_form" action="./success_update.php" onsubmit="return frm_form_chk(this);" target="hidden_ifrm" enctype="multipart/form-data">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="bt_idx" id="bt_idx" value="<?=$row['bt_idx']?>" />
					<input type="hidden" name="bt_type" id="bt_type" value="1" />
					<div class="form-group row">
						<label for="code_register1" class="col-sm-2 col-form-label">접수번호</label>
						<div class="col-sm-3">
							<input type="text" name="code_register1" id="code_register1" value="<?=$row['code_register1']?>" class="form-control form-control-sm" style="display: inline-block" <?php if($_act=="update"){echo disabled;}?>/>
						</div>
                        <?php if($_act!="update"){?>
                        <input type="button" value="확인" class="btn btn-outline-primary" style=" display: inline-block; height:41.19px;" onclick="getInfo()"/>
                        <?php }?>
                    </div>
                    <div class="form-group row">
						<label for="code_register2" class="col-sm-2 col-form-label">등록번호</label>
						<div class="col-sm-3">
							<input type="text" name="code_register2" id="code_register2" value="<?=$row['code_register2']?>" class="form-control form-control-sm" disabled/>
						</div>
					</div>
                    <div class="form-group row">
						<label for="dt_register_complete" class="col-sm-2 col-form-label">등록일</label>
						<div class="col-sm-3">
							<input type="text" name="dt_register_complete" id="dt_register_complete" value="<?= $row['dt_register_complete']?>" class="form-control form-control-sm" disabled/>
						</div>
					</div>
                    <div class="form-group row">
					    <label for="bt_file1" class="col-sm-2 col-form-label">상표</label>
                        <input name="bt_file1" id="bt_file1" type="hidden" value="<?= $row['bt_file1']?>">
                        <label class="plus-input" style="width:250px; border:none;" name="bt_file1_box" id="bt_file1_box">
                        <?php if($_act=='update'){?>
                            <img id="bt_file1_img" style="object-fit:contain; width:250px;" src="<?= "https://dmonster1705.cafe24.com/data/app_domestic/".$row['bt_file1']?>" />
                        <?php }?>
                        </label>
					</div>
                    <div class="form-group row">
						<label for="bt_rank" class="col-sm-2 col-form-label">출력순서</label>
						<div class="col-sm-3">
							<input type="text" name="bt_rank" id="bt_rank" value="<?=$row['bt_rank']?>" class="form-control form-control-sm" numberOnly />

							<small id="select_category_help" class="form-text text-muted" style="width: 350px">
							배너를 출력할 때 순서를 정합니다. 숫자가 작을수록 먼저 출력됩니다.
							</small>
						</div>
					</div>
                    <div class="form-group row">
						<label for="bt_txt" class="col-sm-2 col-form-label">지정상품</label>
						<div class="col-sm-10">
							<input type="text" name="bt_txt" id="bt_txt" value="<?=$row['bt_txt']?>" class="form-control form-control-sm" maxlength="50"/>
						</div>
					</div>
                    <div class="form-group row">
						<label for="bt_show" class="col-sm-2 col-form-label">노출여부</label>
						<div class="col-sm-2">
							<select name="bt_show" id="bt_show" class="form-control form-control-sm">
								<option value="Y" <?php if($row['bt_show']=='Y') echo "SELECTED";?>>Y</option>
								<option value="N" <?php if($row['bt_show']=='N') echo "SELECTED";?>>N</option>
							</select>
						</div>
					</div>

					<p class="p-3 text-center">
                        <?php if($_act=='update'){?>
						    <input type="button" value="삭제" class="btn btn-outline-danger" onclick="delBanner('./success_update.php', <?= $row['bt_idx']?>)" />
                        <?php }?>
						<input type="button" value="목록" onclick="location.href='./success_list.php?<?=$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
                        <input type="submit" value="확인" class="btn btn-outline-primary" />
					</p>
					</form>
					<script type="text/javascript">
						function frm_form_chk(f) {
                            if(f.code_register1.value == ''){
                                alert("접수번호를 입력해주세요");
                                return false;
                            }else if(f.bt_rank.value == ''){
                                alert("출력 순서를 입력해주세요.");
                                return false;
                            }else if(f.bt_txt.value == ''){
                                alert("지정 상품에 대해 입력해주세요.");
                                return false;
                            }
                            return true;
						}
                        function delBanner(url, idx){
                            var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
                            if(result){
                                $.post(url, {act: 'delete', idx: idx}, 
                                function (data) {
                                    if(data=='Y') {
                                        alert('삭제되었습니다.');
                                        location.href="./success_list.php";
                                    }else{
                                        alert("삭제에 실패하였습니다.");
                                    }
                                });
                            }
                        }
                        function getInfo(){
                            if(document.getElementById('code_register1').value!=''){
                                $.ajax({
                                    url: "./success_update.php",
                                    type: "post",
                                    dataType: "json",
                                    data:{
                                        act: 'getInfo',
                                        code_register1: document.frm_form.code_register1.value,
                                    },
                                    success: function(result){
                                        if(result['success']==1){
                                            // if(result['code_register2']==' '||result['dt_register_complete']==''){
                                            //     alert("아직 등록되지 않은 접수번호입니다.");
                                            //     location.href="./success_list.php";
                                            // }else{
                                                document.frm_form.code_register2.value = result['code_register2'];
                                                document.frm_form.dt_register_complete.value = result['dt_register_complete'];
                                                document.getElementById('bt_file1').value = result['img_mark'];
                                                document.getElementById('bt_file1_box').innerHTML = "<img id='bt_file1_img' style='object-fit:contain; width:250px;' src='"+imgRoute+result['img_mark']+"'/>"
                                           // }
                                        }else if(result['success']==0){
                                            alert("접수번호를 제대로 입력해주세요.");
                                        }
                                    }
                                });
                            }else{
                                alert("접수번호를 입력해주세요.");
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
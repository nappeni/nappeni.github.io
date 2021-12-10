<?
	include "./head_inc.php";
	$chk_menu = '7';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "6";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">할인코드 관리</h4>
					    <div class="row no-gutters mb-2">
						    <div class="col-xl-4">
                            <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
                                <select name="sel_search" id="sel_search" class="form-control form-control-sm" style="display: inline-block; width: 100px; margin-right : 4px;">
                                    <option value="a1.d_code_name">이름</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" style="width:200px; display: inline-block; margin-right : 4px; height:41px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" placeholder="검색어를 입력바랍니다." />
                                <input type="image" class="btn btn-info" style="background-color: white; padding: 8px; display: inline-block;" src="../images/search.png"/>
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

                                <? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
                            </script>
                            </div>
						    <div class="col-xl-8">
                                <div class="float-right">
                                        <input type="button" class="btn btn-primary" value="추가" onclick="onInputModal()"/>
                                        <input type="button" class="btn btn-primary" value="삭제" onclick="ondeletes()" />
                                </div>
                            </div>
                        </div>

					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead class="thead-dark">
						<tr>
                            <th class="text-center" style="width: 30px;">
                                <input class="bannerCheck" name="bannerCheck" type="checkBox" onclick="allCheck()">
                            </th>
                            <script>
                                function allCheck(){
                                    if(document.getElementsByName('bannerCheck')[0].checked == true){
                                        for(var i=0; i<document.getElementsByName('bannerCheck').length; i++){
                                            document.getElementsByName('bannerCheck')[i].checked = true;
                                        }
                                    }else{
                                        for(var i=0; i<document.getElementsByName('bannerCheck').length; i++){
                                            document.getElementsByName('bannerCheck')[i].checked = false;
                                        }
                                    }
                                }
                            </script>
							<th class="text-center" style="width:200px;">
								할인코드 이름
							</th>
							<th class="text-center" style="width:200px;">
								사용기한
							</th>
							<th class="text-center" style="width:100px;">
								사용횟수
							</th>
							<th class="text-center" style="width:100px;">
								한정 수량
							</th>
							<th class="text-center" style="width:100px;">
								관리
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$_where = " where ";
							$query = "
								select *, a1.idx as dc_idx from discount_code_t a1
							";
							$query_count = "
								select count(*) from discount_code_t a1
							";
                            
							if($_GET['search_txt']) {
                                $search_txt = str_replace("'","\'",$_GET['search_txt']);
                                $where_query .= $_where."instr(".$_GET['sel_search'].", '".$search_txt."')";
                                $_where = " and ";
                                
							}
                             
							$row_cnt = $DB->fetch_query($query_count.$where_query);
							$couwt_query = $row_cnt[0];
							$counts = $couwt_query;
							$n_page = ceil($couwt_query / $n_limit_num);
							if($pg=="") $pg = 1;
							$n_from = ($pg - 1) * $n_limit;
							$counts = $counts - (($pg - 1) * $n_limit_num);

							unset($list);
							$sql_query = $query.$where_query." order by a1.idx desc limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);
							if($list) {
							foreach($list as $row) {
						?>
						<tr>
                            <td class="text-center">
                                <input class="bannerCheck" value="<?=$row['dc_idx']?>" name="bannerCheck" type="checkBox">
                            </td>
							<td class="text-center">
								<?=$row['d_code_name']?>
							</td>
							<td class="text-center">
                                <?= $row['ct_sdate']." ~ ".$row['ct_edate']?>
							</td>
							<td class="text-center">
								<?php 
                                    $count = $DB -> select_query("SELECT count(code_sale) as count FROM d_app_domestic WHERE code_sale = '".$row['d_code_name']."'");
                                    foreach($count as $value);
                                    echo $value['count'];
                                ?>
							</td>
							<td class="text-center">
								<?=$row['d_num']?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="onUpdateModal(<?= $row['dc_idx']?>)" /> 
                                <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="ondelete(<?= $row['dc_idx']?>)"/>
							</td>
						</tr>
						<?
									$counts--;
								}
							} else {
						?>
						<tr>
							<td colspan="<?=$_colspan_txt?>" class="text-center"><b>자료가 없습니다.</b></td>
						</tr>
						<?
							}
						?>
						</tbody>
					</table>
					</div>
					<div class="wrap_pagination">
					<?
                        if($n_page>0) {
                            echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
                        }
                    ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="d_code_input" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form method="post" action="./discount_code_update.php" onsubmit="return checkValue()">
            <div class="modal-content">
                <input type="hidden" name="act" id="act" value="">
                <input type="hidden" name="dc_idx" id="dc_idx" value="">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">할인코드</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span> 
                    <i class="xi-close fs_36 fc_grccc"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <table class="table table-bordered">
                        <tr>
                            <td class="nation-td">할인코드 이름</td>
                            <td>
                                <input name="d_code_name" id="d_code_name" class="nation-input" type="text" maxlength="10" placeholder = "10글자 이하 영문 및 숫자" autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td class="nation-td">사용 시작일</td>
                            <td>
                                <input type="text" name="stx_dt1" id="stx_dt1" class="form-control form-control-sm wd-100 datepicker" placeholder="사용 시작일" autocomplete="off"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="nation-td">사용 종료일</td>
                            <td>
                                <input type="text" name="stx_dt2" id="stx_dt2" class="form-control form-control-sm wd-100 datepicker" placeholder="사용 종료일" autocomplete="off"/>
                            </td>
                        </tr>
                        <tr>
                            <td class="nation-td">할인률</td>
                            <td>
                                <input name="d_rate" id="d_rate" class="nation-input" type="text" placeholder="%"  numberOnly>
                            </td>
                        </tr>
                        <tr>
                            <td class="nation-td">한정 수량</td>
                            <td>
                                <input name="d_num" id="d_num" class="nation-input" type='text' placeholder="개" numberOnly>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                        <button id="nt_button" type="submit" class="btn btn-outline-primary btn-lg btn-block" >저장</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal 끝-->
<script>
    //저장하기 전 값 확인
    function checkValue(){
        var code_check = /^[a-zA-Z0-9]*$/;
        var d_code = document.getElementById('d_code_name').value;
        if(d_code == ''|| code_check.test(d_code)==false){
            alert("할인코드 이름을 제대로 입력해주세요.");
            return false;
        }else if(document.getElementById('stx_dt1').value == ''){
            alert("시작 일을 입력해주세요.");
            return false;
        }else if(document.getElementById('stx_dt2').value == ''){
            alert("종료 일을 입력해주세요.");
            return false;
        }else if(document.getElementById('d_rate').value == ''){
            alert("할인률을 입력해주세요.");
            return false;
        }else if(document.getElementById('d_num').value == ''){
            alert("한정 수량을 입력해주세요.");
            return false;
        }
        return true;
    }
    //추가 모달
    function onInputModal(){
        $('#d_code_name').val('');
        $('#stx_dt1').val('');
        $('#stx_dt2').val('');
        $('#d_rate').val('');
        $('#d_num').val('');
        $('#act').val('input');
        $('#d_code_input').modal();
    }
    //수정 모달
    function onUpdateModal(idx){
        $.ajax({
            url : "./discount_code_update.php",
            type : "post",
            dataType: "json",
            data: {
                act: "select",
                idx: idx
            }, success: function(result){
                if(result['success']==0){
                    alert("값을 가져오다가 문제가 생겼습니다.");
                }else if(result['success']==1){
                    $('#d_code_name').val(result['d_code_name']);
                    $('#stx_dt1').val(result['ct_sdate']);
                    $('#stx_dt2').val(result['ct_edate']);
                    $('#d_rate').val(result['d_rate']);
                    $('#d_num').val(result['d_num']);
                    $('#act').val("update");
                    $('#dc_idx').val(idx);
                    $('#d_code_input').modal();
                }
            }
        });
    }
    //삭제 단일 삭제
    function ondelete(idx){
        var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
        if(result){
            $.post(
                {url:"./discount_code_update.php"},
                {
                    act: "delete",
                    idx: idx
                },
                function (data){
                    if(data == 'Y'){
                        alert("삭제되었습니다.");
                        location.reload();
                    }else{
                        alert("해당 할인코드를 삭제하지 못했습니다.");
                    }
                }
            );
        }
    }
    //여러개 삭제
    function ondeletes(){
        var indexArr = new Array;
        for(var i=1; i<document.getElementsByName('bannerCheck').length; i++){
            if(document.getElementsByName('bannerCheck')[i].checked==true){
                 indexArr[i-1] = document.getElementsByName('bannerCheck')[i].value;
            }
        }
        if(indexArr.length==0){
            alert("삭제 할 배너를 선택해주세요.");
        }else{
            var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
            if(result){
                $.post(
                {url:"./discount_code_update.php"},
                {
                    act: "deletes",
                    idx: indexArr
                },
                function (data){
                    if(data == 'Y'){
                        alert("삭제되었습니다.");
                        location.reload();
                    }else{
                        alert("해당 할인코드를 삭제하지 못했습니다.");
                    }
                }
            );
            }
        }
    }
</script>
<?
	include "./foot_inc.php";
?>
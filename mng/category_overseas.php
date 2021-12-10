<?
	include "./head_inc.php";
	$chk_menu = '5';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "5";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
    <div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"></h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3">국제 카테고리 관리</div>
						<div class="col-xl-9">
                            <div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-primary" value="추가" onclick="inputModal()" />
									</div>
                                    <div class="form-group mx-sm-1">
										<input type="button" class="btn btn-primary" value="삭제" onclick="deletModals()" />
									</div>
								</form>
							</div>
                        </div>
					</div>

					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead class="thead-dark">
						<tr>
							<th class="text-center" style="width:30px;">
                                <input class="bannerCheck" name="bannerCheck" type="checkBox" onclick="allCheck()">
							</th>
							<th class="text-center" style="width:50px;">
                                출력 순서
							</th>
							<th class="text-center" style="width:80px;">
                                상품류 명
							</th>
							<th class="text-center" style="width:170px;">
                                카테고리 설명
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
								select *, a1.idx as co_idx from cate_overseas_t a1
							";
							$query_count = "
								select count(*) from cate_overseas_t a1
							";

							if($_GET['search_txt']) {
								if($_GET['sel_search']=="all") {
									$where_query .= $_where."(instr(a1.nt_title, '".$_GET['search_txt']."') or instr(a1.nt_content, '".$_GET['search_txt']."'))";
								} else {
									$where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
								}
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
							$sql_query = $query.$where_query." order by co_rank limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);

							if($list) {
								foreach($list as $row) {
						?>
						<tr>
                            <td class="text-center">
                                <input class="bannerCheck" value="<?= $row['co_idx']?>" name="bannerCheck" type="checkBox">
							</td>
							<td class="text-center">
								<?= $row['co_rank']?>
							</td>
							<td class="text-center">
								<?= $row['co_name']?>
							</td>
							<td class="text-center">
                                <?= $row['co_txt']?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="updateModal(<?=$row['co_idx']?>)" />
                                <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="deletModal(<?=$row['co_idx']?>)" />
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
<div class="modal fade" id="inputOverseas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <input type="hidden" id="co_idx" value="">
             <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">카테고리 추가/수정</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                   <i class="xi-close fs_36 fc_grccc"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <table class="table table-bordered">
                    <tr>
                        <td class="nation-td co_td">출력 순서</td>
                        <td>
                            <select id="co_rank" class="nationn-select">
                               <script>
                                   for(var i=1; i<=45; i++){
                                    document.write("<option value='"+i+"'>"+i+"</option>");
                                   }
                               </script>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="nation-td co_td">상품류 명</td>
                        <td>
                            <input id="co_name" class="nation-input" type="text" placeholder="상품류 명 입력" maxlength="20">
                        </td>
                    </tr>
                    <tr>
                        <td class="nation-td co_td">카테고리 설명</td>
                        <td>
                            <input id="co_txt" class="nation-input" type="text" placeholder="카테고리 설명 입력" maxlength="50">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                    <button id="co_button" type="button" class="btn btn-outline-primary btn-lg btn-block"onclick="checkValue('input')" >저장</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal 끝-->

<script>
    //마드리드 가부 jquery
    $("input:radio[name=madrid]").click(function(){
        if($("input:radio[name=madrid]:checked").val() == 'Y'){
            document.getElementById('md_cost').disabled = false;
        }else if($("input:radio[name=madrid]:checked").val() == 'N'){
            document.getElementById('md_cost').disabled = true;
        }
    });
    //체크박스 전체 체크
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
    //삭제 알람
    function deletModal(idx){
        var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
        if(result==true){
            deleteNation('delete', idx);
        }
    }
    //단체 삭제 알람
    function deletModals(){
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
            if(result==true){
                deleteNation('deleteThows', indexArr);
            }
        }
    }
    //값 확인
    function checkValue(value){
        if(document.getElementById('co_name').value == ''){
            alert("상품류 명을 입력해주세요.");
        }else if(document.getElementById('co_txt').value == ''){
            alert("카테고리 설명을 입력해주세요");
        }else{
            sendNation(value);
        }
    }
    //추가 모달 출력
    function inputModal(){
        $('#co_rank').val(1).prop("seleted",true);
        $('#co_name').val("");
        $('#co_txt').val("");
        $('#nt_bco_buttonutton').removeAttr("onclick");
        $('#co_button').attr("onclick","checkValue('input')");
        $('#inputOverseas').modal();
    }
     //수정 모달 출력
     function updateModal(idx){
        $.ajax({
                url: "./category_overseas_update.php",
                type: "post",
                dataType: "json",
                data:{
                    act: "select",
                    idx: idx
                },success: function(result) {
                    $('#co_idx').val(result['idx']);
                    $('#co_rank').val(result['co_rank']).prop("seleted",true);
                    $('#co_name').val(result['co_name']);
                    $('#co_txt').val(result['co_txt']);
                    $('#co_button').removeAttr("onclick");
                    $('#co_button').attr("onclick","checkValue('update')");
                    $('#inputOverseas').modal();
                } 
            });
    }
    //추가 수정
    function sendNation(value){
        if(value=="input"){
            $.post(
                {url: "./category_overseas_update.php"},
                {
                    act: value,
                    co_rank: $('#co_rank option:selected').val(),
                    co_name: document.getElementById('co_name').value,
                    co_txt: document.getElementById('co_txt').value,
                },
                function (data) {
                    if(data=="Y"){
                        $('#inputNatioin').modal('hide');
                        alert("추가 되었습니다.");
                        location.reload();
                    }else{
                        console.log(data);
                    }
            });
        }else if(value=="update"){
            $.post(
                {url: "./category_overseas_update.php"},
                {
                    act: value,
                    co_idx: document.getElementById('co_idx').value,
                    co_rank: $('#co_rank option:selected').val(),
                    co_name: document.getElementById('co_name').value,
                    co_txt: document.getElementById('co_txt').value
                },
                function (data) {
                    if(data=="Y"){                   
                        $('#inputNatioin').modal('hide');
                        alert("수정 되었습니다.");
                        location.reload();
                    }else{
                        console.log(data);
                    }
            });
        }
    }

    //삭제
    function deleteNation(value, idx){
        if(value=="delete"){
            $.post(
                {url: "./category_overseas_update.php"},
                {
                    act: value,
                    idx: idx
                },
                function (data){
                    if(data=='Y'){
                        alert("삭제되었습니다.");
                        location.reload();
                    }
                }
            );
        }else if(value=="deleteThows"){
            $.post(
                {url: "./category_overseas_update.php"},
                {
                    act: value,
                    idx: idx
                },
                function (data){
                    if(data=='Y'){
                        alert("삭제되었습니다.");
                        location.reload();
                    }
                }
            );
        }
    }
</script>
<?
	include "./foot_inc.php";
?>
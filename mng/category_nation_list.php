<?
	include "./head_inc.php";
	$chk_menu = '5';
	$chk_sub_menu = '3';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "7";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
    <div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"></h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3">국가 관리</div>
						<div class="col-xl-9">
                            <div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
                                    <div class="form-group mx-sm-1">
										<input type="button" class="btn btn-primary" value="엑셀로 업로드" onclick="fileUploadModal()" />
									</div>
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
							<th class="text-center" style="width:100px;">
								대륙
							</th>
							<th class="text-center" style="width:100px;">
								나라 명
							</th>
							<th class="text-center" style="width:100px;">
                                마드리드 가부
							</th>
							<th class="text-center" style="width:100px;">
								개별국 출원시 금액
							</th>
                            <th class="text-center" style="width:100px;">
								마드리드 국제 출원시 금액
							</th>
							<th class="text-center" style="width:120px;">
								관리
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$_where = " where ";
							$query = "
								select *, a1.idx as nt_idx from nation_t a1
							";
							$query_count = "
								select count(*) from nation_t a1
							";

							// if($_GET['search_txt']) {
							// 	if($_GET['sel_search']=="all") {
							// 		$where_query .= $_where."(instr(a1.nt_title, '".$_GET['search_txt']."') or instr(a1.nt_content, '".$_GET['search_txt']."'))";
							// 	} else {
							// 		$where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
							// 	}
							// 	$_where = " and ";
							// }
                            $where_query = "where idx!=1";

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
                                <input class="bannerCheck" value="<?= $row['nt_idx']?>" name="bannerCheck" type="checkBox">
							</td>
							<td class="text-center">
                                <?php 
                                    switch($row['nt_continent']){
                                        case 0:
                                            echo "-";
                                            break;
                                        case 1:
                                            echo "아시아";
                                            break;
                                        case 2:
                                            echo "북미";
                                            break;
                                        case 3:
                                            echo "유럽";
                                            break;
                                        case 4:
                                            echo "아프리카";
                                            break;
                                        case 5:
                                            echo "오세아니아";
                                            break;
                                        case 6:
                                            echo "중동";
                                            break;
                                        case 7:
                                            echo "중남미";
                                            break;
                                    }
                                ?>
							</td>
							<td class="text-center">
								<?= $row['nt_name']?>
							</td>
							<td class="text-center">
                                <?php 
                                    if($row['nt_madrid']=="Y"){
                                        echo "-";
                                    }else{
                                        echo "불가";
                                    }
                                ?>
							</td>
							<td class="text-center">
								<?=number_format($row['nt_cost'])?>
							</td>
							<td class="text-center">
                                <?php 
                                    if($row['nt_madrid']=='N'){
                                        echo "불가";
                                    }else{
                                        echo number_format($row['md_cost']);
                                    }
                                ?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="updateModal(<?=$row['nt_idx']?>)" />
                                <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="deletModal(<?=$row['nt_idx']?>)" />
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
<div class="modal fade" id="inputNation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <input type="hidden" id="nt_idx" value="">
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
                        <td class="nation-td">대륙</td>
                        <td>
                            <select id="nt_continent" class="nationn-select">
                                <option value="0">=== 선택 ===</option>
                                <option value="1">아시아</option>
                                <option value="2">북미</option>
                                <option value="3">유럽</option>
                                <option value="4">아프리카</option>
                                <option value="5">오세아니아</option>
                                <option value="6">중동</option>
                                <option value="7">중남미</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="nation-td">나라명</td>
                        <td>
                            <input id="nt_name" class="nation-input" type="text" placeholder="나라명 입력">
                        </td>
                    </tr>
                    <tr>
                        <td class="nation-td">개별국 출원시 금액</td>
                        <td>
                            <input id="nt_cost" class="nation-input" type="text" placeholder="금액 입력" numberOnly>
                        </td>
                    </tr>
                    <tr>
                        <td class="nation-td">마드리드 가부</td>
                        <td style="text-align: left">
                            <div class="input-group-prepend">
                                <div class="checks" style="color: black; margin-right: 10px;">
                                    <input name="madrid" id="madrid1" type="radio" value="Y"> <label for="madrid1">가능</label>
                                </div>
                                <div class="checks" style="color: black">
                                <input name="madrid" id="madrid2" type="radio" value="N"> <label for="madrid2">불가</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="nation-td">마드리드 국제 출원시 금액</td>
                        <td>
                            <input id="md_cost" class="nation-input" type='text' placeholder="금액 입력" numberOnly disabled>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                    <button id="nt_button" type="button" class="btn btn-outline-primary btn-lg btn-block"onclick="checkValue('input')" >저장</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal 끝-->
<!-- Modal -->
<div class="modal fade" id="fileUpload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
             <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">엑셀로 카테고리 추가</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                   <i class="xi-close fs_36 fc_grccc"></i>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" action="./category_nation_update.php" onsubmit="return checkFile()">
                <div class="modal-body text-center">
                    <input type="hidden" name="act" value="fileUpload">
                    <table class="table table-bordered">
                        <tr>
                            <td class="nation-td co_td">파일</td>
                            <td style="text-align:left">
                                <input type="file" name="excelFile">
                                <small id="select_category_help" class="form-text text-muted">
							        해외출원 견적 비용 엑셀과 같은 형식의 파일만 제대로 저장됩니다.
							    </small>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                        <button id="co_button" type="submit" class="btn btn-outline-primary btn-lg btn-block">업로드</button>
                </div>
            </form>
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
    //값 확인
    function checkValue(value){
        if(document.getElementById('nt_name').value == ''){
            alert("나라 명을 입력해주시요.");
        }else if(document.getElementById('nt_cost').value == ''){
            alert("개별국 출원시 금액을 입력해주세요.");
        }else if($("input:radio[name=madrid]:checked").val() == undefined){
            alert("마드리드 가부를 선택해주세요.");
        }else if($("input:radio[name=madrid]:checked").val()=="Y"&& document.getElementById('md_cost').value == ''){
            alert("마드리드 국제 출원시 금액을 입력해주세요.");
        }else{
            sendNation(value);
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
    //추가 모달 출력
    function inputModal(){
        $('#nt_idx').val("");
        $('#nt_continent').val(0).prop("seleted",true);
        $('#nt_name').val("");
        $('#nt_cost').val("");
        $('#madrid1').prop("checked",false);
        $('#madrid2').prop("checked",false);
        $('#md_cost').val("");
        $('#nt_button').removeAttr("onclick");
        $('#nt_button').attr("onclick","checkValue('input')");
        $('#inputNation').modal();
    }
    //수정 모달 출력
    function updateModal(idx){
        $.ajax({
                url: "./category_nation_update.php",
                type: "post",
                dataType: "json",
                data:{
                    act: "select",
                    idx: idx
                },success: function(result) {
                    $('#nt_idx').val(result['idx']);
                    $('#nt_continent').val(result['nt_continent']).prop("seleted",true);
                    $('#nt_name').val(result['nt_name']);
                    $('#nt_cost').val(result['nt_cost']);
                    if(result['nt_madrid']=="Y"){
                        $('#madrid1').prop("checked",true);
                    }else{
                        $('#madrid2').prop("checked",true);
                    }
                    $('#md_cost').val(result['md_cost']);
                    $('#nt_button').removeAttr("onclick");
                    $('#nt_button').attr("onclick","checkValue('update')");
                    $('#inputNation').modal();
                } 
            });
    }
    //추가 수정
    function sendNation(value){
        if(value=="input"){
            $.post(
                {url: "./category_nation_update.php"},
                {
                    act: value,
                    nt_continent: $('#nt_continent option:selected').val(),
                    nt_name: document.getElementById('nt_name').value,
                    nt_cost: document.getElementById('nt_cost').value,
                    nt_madrid: $("input:radio[name=madrid]:checked").val(),
                    md_cost: document.getElementById('md_cost').value
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
                {url: "./category_nation_update.php"},
                {
                    act: value,
                    nt_idx: document.getElementById('nt_idx').value,
                    nt_continent: $('#nt_continent option:selected').val(),
                    nt_name: document.getElementById('nt_name').value,
                    nt_cost: document.getElementById('nt_cost').value,
                    nt_madrid: $("input:radio[name=madrid]:checked").val(),
                    md_cost: document.getElementById('md_cost').value
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
                {url: "./category_nation_update.php"},
                {
                    act: value,
                    idx: idx
                },
                function (data){
                    if(data=='Y'){
                        alert("삭제되었습니다.");
                        location.reload();
                    }else{
                        console.log(data);
                    }
                }
            );
        }else if(value=="deleteThows"){
            $.post(
                {url: "./category_nation_update.php"},
                {
                    act: value,
                    idx: idx
                },
                function (data){
                    console.log(data);
                    if(data=='Y'){
                        alert("삭제되었습니다.");
                        location.reload();
                    }else{
                        console.log(data);
                    }
                }
            );
        }
    }
    //엑셀로 업로드 모달
    function fileUploadModal(){
        $('#fileUpload').modal();
    }
    //엑셀로 업로드 값 확인
    function checkFile(){
        if(document.getElementsByName('excelFile')[0].value==''){
            alert("엑셀 파일을 선택해주세요.");
            return false;
        }
        return true;
    }
</script>
<?
	include "./foot_inc.php";
?>
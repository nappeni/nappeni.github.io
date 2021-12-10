<?
	include "./head_inc.php";
	$chk_menu = '9';
	$chk_sub_menu = '1';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "3";
	$_get_txt = "&pg=";
?>
<div class="content-wrapper">
    <div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"></h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3">FAQ 카테고리 관리</div>
						<div class="col-xl-9">
                            <div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="#" class="form-inline" onsubmit="return frm_search_chk(this);">
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
                            <script>
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
                            </script>
							<th class="text-center" style="width:100px;">
								카테고리 명
							</th>
							<th class="text-center" style="width:100px;">
								관리
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$query = "
								select *, a1.idx as fc_idx from cate_faq_t a1
							";
							$query_count = "
								select count(*) from cate_faq_t a1
							";

							$row_cnt = $DB->fetch_query($query_count);
							$couwt_query = $row_cnt[0];
							$counts = $couwt_query;
							$n_page = ceil($couwt_query / $n_limit_num);
							if($pg=="") $pg = 1;
							$n_from = ($pg - 1) * $n_limit;
							$counts = $counts - (($pg - 1) * $n_limit_num);

							unset($list);
							$sql_query = $query." order by a1.idx desc limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);

							if($list) {
								foreach($list as $row) {
						?>
						<tr>
                            <td class="text-center">
                                <input class="bannerCheck" value="<?= $row['fc_idx']?>" name="bannerCheck" type="checkBox">
							</td>
							<td class="text-center">
								<?= $row['fc_name']?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="updateModal(<?=$row['fc_idx']?>)" />
                                <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="deletModal(<?=$row['fc_idx']?>)" />
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
<div class="modal fade" id="inputFAQ" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <input type="hidden" id="fc_idx" value="">
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
                        <td class="nation-td">카테고리 이름</td>
                        <td>
                            <input id="fc_name" class="nation-input" type="text" placeholder="카테고리 이름 입력">
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
<script>
    //값 확인
    function checkValue(value){
        if(document.getElementById('fc_name').value == ''){
            alert("카테고리 명을 입력해주세요.");
        }else{
            sendFAQ(value);
        }
    }
    //삭제 알람
    function deletModal(idx){
        var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
        if(result==true){
            $.post(
                {url: "./faq_cate_update.php"},
                {
                    act: "delete",
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
                $.post(
                    {url: "./faq_cate_update.php"},
                    {
                        act: "deleteThows",
                        idx: indexArr
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
    }
    //추가 모달 출력
    function inputModal(){
        $('#fc_name').val("");
        $('#nt_button').removeAttr("onclick");
        $('#nt_button').attr("onclick","checkValue('input')");
        $('#inputFAQ').modal();
    }
    //수정 모달 출력
    function updateModal(idx){
        $.ajax({
                url: "./faq_cate_update.php",
                type: "post",
                dataType: "json",
                data:{
                    act: "select",
                    idx: idx
                },success: function(result) {
                    if(result['success']==1){
                    console.log(result['fc_idx']);
                    $('#fc_idx').val(result['fc_idx']);
                    $('#fc_name').val(result['fc_name']);
                    $('#nt_button').removeAttr("onclick");
                    $('#nt_button').attr("onclick","checkValue('update')");
                    $('#inputFAQ').modal();
                    }else{
                        alert("값을 가져오는데 실패하였습니다.");
                    }
                } 
            });
    }
    //추가 수정
    function sendFAQ(value){
        var text = document.getElementById('fc_name').value;
        if(value=="input"){
            $.post(
                {url: "./faq_cate_update.php"},
                {
                    act: value,
                    fc_name: text
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
            var text = document.getElementById('fc_name').value;
            $.post(
                {url: "./faq_cate_update.php"},
                {
                    act: value,
                    fc_idx: document.getElementById('fc_idx').value,
                    fc_name: text
                   
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
</script>
<?
	include "./foot_inc.php";
?>
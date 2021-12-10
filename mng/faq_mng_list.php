<?
	include "./head_inc.php";
	$chk_menu = '9';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "5";
	$_get_txt = "&pg=";

    $best_count = "select count(*) as best from faq_t where ft_best = 'Y'";
    $b_count = $DB->fetch_query($best_count);
    $best = $b_count['best'];
?>
<div class="content-wrapper">
    <div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"></h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3">FAQ관리</div>
						<div class="col-xl-9">
                            <div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="#" class="form-inline" onsubmit="">
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
								카테고리
							</th>
                            <th class="text-center" style="width:100px;">
								TOP5 여부
							</th>
                            <th class="text-center" style="width:100px;">
								FAQ 제목
							</th>
							<th class="text-center" style="width:100px;">
								관리
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$query = "
								select *, a1.idx as ft_idx from faq_t a1
							";
							$query_count = "
								select count(*) from faq_t a1
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
                                <input class="bannerCheck" value="<?= $row['ft_idx']?>" name="bannerCheck" type="checkBox">
							</td>
                            <td class="text-center">
                                <?php 
                                    $sql = "select cft.fc_name from cate_faq_t cft join faq_t ft on cft.idx = ft.fc_idx where cft.idx = '".$row['fc_idx']."'";
                                    $name = $DB -> fetch_query($sql);
                                    echo $name['fc_name'];
                                ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                    if($row['ft_best']=="Y"){
                                        echo "TOP5";
                                    }else{
                                        echo "-";
                                    }
                                ?>
                            </td>
							<td class="text-center">
								<?= $row['ft_title']?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="updateModal(<?=$row['ft_idx']?>)" />
                                <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="deletModal(<?=$row['ft_idx']?>)" />
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
            <input type="hidden" id="ft_idx" value="">
             <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">FAQ 추가/수정</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                   <i class="xi-close fs_36 fc_grccc"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <table class="table table-bordered">
                    <tr>
                        <td class="nation-td">카테고리</td>
                        <?php 
                            unset($list);
                            $sql = "select * from cate_faq_t order by idx";
                            $list = $DB -> select_query($sql);
                        ?>
                        <td>
                            <select id="idx" class="nationn-select">
                                <option value="0">=== 선택 ===</option>
                                <?php foreach($list as $row){?>
                                <option value="<?= $row['idx']?>"><?= $row['fc_name']?></option>
                                <? }?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="nation-td">자주하는 질문 설정</td>
                        <td style="text-align: left;">
                            <input type="radio" name="ac" id="ac1" value="Y">
                            <label for="ac1" style="margin-right: 4px;">네</label>
                            <input type="radio" name="ac" id="ac2" value="N">
                            <label for="ac2">아니요</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="nation-td">FAQ 제목</td>
                        <td>
                            <input id="fc_title" class="nation-input" type="text" placeholder="FAQ 제목 입력">
                        </td>
                    </tr>
                    <tr>
                        <td class="nation-td">FAQ 내용</td>
                        <td>
                        <textarea class="form-control" placeholder="FAQ 내용 입력" name="fc_content" id="fc_content" rows="5"></textarea>
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
    // $("#ac1").click(function(){
    //     var b_count = <?= $best?>;
    //     if(b_count>=5){
    //         alert("자주하는 질문이 5개 이상입니다.");
    //         $("#ac2").attr("checked",true);
    //     }
    // });
    //값 확인
    function checkValue(value){
        if(document.getElementById('idx').value == 0){
            alert("카테고리를 선택해주세요");
        }else if($("input:radio[name=ac]:checked").length == 0){
            alert("자주 질문하는 설정을 선택해주세요.");
        }else if(document.getElementById('fc_title').value == ""){
            alert("FAQ제목을 입력해주세요.");
        }else if(document.getElementById('fc_content').value == ""){
            alert("FAQ내용을 입력해주세요.");
        }else{
            sendFAQ(value);
        }
    }
    //삭제 알람
    function deletModal(idx){
        var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
        if(result==true){
            $.post(
                {url: "./faq_mng_update.php"},
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
                    {url: "./faq_mng_update.php"},
                    {
                        act: "deleteThows",
                        idx: indexArr
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
    }
    //추가 모달 출력
    function inputModal(){
        $('#idx').val(0).prop("selected",true);
        $('#ac1').attr("checked",false);
        $('#ac2').attr("checked",false);
        $('#fc_title').val("");
        $('#fc_content').val("");
        $('#nt_button').removeAttr("onclick");
        $('#nt_button').attr("onclick","checkValue('input')");
        $('#inputFAQ').modal();
    }
    //수정 모달 출력
    function updateModal(idx){
        $.ajax({
                url: "./faq_mng_update.php",
                type: "post",
                dataType: "json",
                data:{
                    act: "select",
                    idx: idx
                },success: function(result) {
                    if(result['success']==1){
                    $('#ft_idx').val(result['idx']);
                    $('#idx').val(result['fc_idx']).prop("selected",true);
                    if(result['ft_best'] == "Y"){
                        $('#ac1').attr("checked",true);
                    }else{
                        $('#ac2').attr("checked",true);
                    }
                    $('#fc_title').val(result['ft_title']);
                    $('#fc_content').val(result['ft_content'] );
                    $('#nt_button').removeAttr("onclick");
                    $('#nt_button').attr("onclick","checkValue('update')");
                    $('#inputFAQ').modal()
                    }else{
                        alert("값을 가져오는데 실패하였습니다.");
                    }
                } 
            });
    }
    //추가 수정
    function sendFAQ(value){
        console.log(value);
        if(value=="input"){
            $.post(
                {url: "./faq_mng_update.php"},
                {
                    act: value,
                    fc_idx: document.getElementById('idx').value,
                    fc_best: $('input[name="ac"]:checked').val(),
                    fc_title: document.getElementById('fc_title').value,
                    fc_content : document.getElementById('fc_content').value,
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
                {url: "./faq_mng_update.php"},
                {
                    act: value,
                    idx: document.getElementById('ft_idx').value,
                    fc_idx: document.getElementById('idx').value,
                    fc_best: $('input[name="ac"]:checked').val(),
                    fc_title: document.getElementById('fc_title').value,
                    fc_content: document.getElementById('fc_content').value,
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
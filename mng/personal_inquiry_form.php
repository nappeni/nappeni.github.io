<?
	include "./head_inc.php";
	$chk_menu = '9';
	$chk_sub_menu = '3';
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as it_idx from inquiry_t a1
			where a1.idx = '".$_GET['it_idx']."'
		";
		$row = $DB->fetch_query($query);
		$_act = "update";
		$_act_txt = " 수정";
	}
    $n_limit = 10;
    $pg0 = $_GET['pg0'];
    $pg1 = $_GET['pg1'];
    $_get_txt0 = "act=".$_GET['act']."&search_txt=".$_GET['search_txt']."&mt_idx=".$_GET['mt_idx']."&pg0=";
	$_get_txt1 = "act=".$_GET['act']."&search_txt=".$_GET['search_txt']."&mt_idx=".$_GET['mt_idx']."&pg1=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">1:1문의 관리</h4>
                    <br>
                    <h4 class="card-title">회원 정보</h4>
					<div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td co_td">아이디</td>
                                <td style="text-align:left;"><?= $row['mt_id']?> </td>
                                <td class="nation-td co_td">성명</td>
                                <td style="text-align:left;"><?= $row['mt_name']?> </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <h4 class="card-title">문의 내용</h4>
                    <div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td co_td">제목</td>
                                <td style="text-align:left;"><?= $row['qt_title']?> </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">문의 내용</td>
                                <td style="text-align:left;">
                                    <p><?= $row['qt_content']?></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">상태</td>
                                <td style="text-align:left;">
                                    <?php 
                                        if($row['qt_status']=="1"){
                                            echo "접수";
                                        }else{
                                            echo "답변 완료";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">등록날짜</td>
                                <td style="text-align:left;">
                                    <?= dateType($row['qt_wdate'],1)?>
                                </td>
                            </tr>
                        </table>
					</div>
                    <br>
                    <form method="post" action="./personal_inquiry_update.php" onsubmit="return checkNull(this)">
                    <input type="hidden" name="it_idx" value="<?=$row['it_idx']?>">
                    <h4 class="card-title">답변</h4>
                    <div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td co_td">답변</td>
                                <td style="text-align:left;">
                                <textarea id="qt_answer" name="qt_answer" class="form-control" rows="5" placeholder="답변을 입력해주세요"><?= $row['qt_answer']?></textarea>
                                </td>
                            </tr>
                        </table>
					</div>
                    <br>
                    <p class="p-3 text-center">
                    <input type="submit" value="저장" class="btn btn-outline-primary mx-2" />
						<input type="button" value="목록" onclick="location.href='./app_overseas_list.php'" class="btn btn-outline-secondary mx-2" />
					</p>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function checkNull(f){
        if(f.qt_content==" "){
            alert("문의 내용을 입력해주세요.");
            return false;
        }
        reurn true;
    }
</script>
<?
	include "./foot_inc.php";
?>
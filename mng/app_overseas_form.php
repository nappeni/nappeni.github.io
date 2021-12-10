<?
	include "./head_inc.php";
	$chk_menu = '2';
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as od_idx from o_app_domestic a1
			where a1.idx = '".$_GET['od_idx']."'
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
					<h4 class="card-title">국제 출원 관리 상세보기</h4>
                    <br>
                    <?php
                        $sql = "select mt_id, mt_name, mt_hp from member_t where idx='".$row['mt_idx']."'";
                        $member = $DB->fetch_query($sql);
                    ?>
                    <h4 class="card-title">회원 정보</h4>
					<div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td co_td">아이디</td>
                                <td style="text-align:left;"><?= $member['mt_id']?> </td>
                                <td class="nation-td co_td">성명</td>
                                <td style="text-align:left;"><?= $member['mt_name']?> </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">휴대전화</td>
                                <td colspan="3" style="text-align:left;"><?= $member['mt_hp']?> </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <?php 
                        $nations = explode("/", $row['o_nations']);
                        for($i=0; $i<count($nations)-1; $i++){
                            $n_sql = "select nt_name from nation_t where idx='".$nations[$i]."'";
                            $n_name[] = $DB->fetch_query($n_sql);
                        }
                        $classes = explode("/", $row['o_class']);
                        for($i=0;$i<count($classes)-1;$i++){
                            $c_sql = "select co_name from cate_overseas_t where idx='".$classes[$i]."'";
                            $c_name[] = $DB -> fetch_query($c_sql);
                        }
                    ?>
                    <h4 class="card-title">상표 정보</h4>
                    <div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td co_td">상표명</td>
                                <td style="text-align:left;"><?= $row['p_name']?> </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">출원국가</td>
                                <td style="text-align:left;">
                                    <?php
                                        for($i=0; $i<count($n_name); $i++){
                                            if($i==count($n_name)-1){
                                                echo $n_name[$i]['nt_name'];
                                            }else{
                                                echo $n_name[$i]['nt_name'].", ";
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">상품 분류</td>
                                <td style="text-align:left;">
                                    <?php 
                                        for($i=0; $i<count($c_name);$i++){
                                            if($i==count($c_name)-1){
                                                echo $c_name[$i]['co_name'];
                                            }else{
                                                echo $c_name[$i]['co_name'].", ";
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">국내 출원 유무</td>
                                <td style="text-align:left;">
                                    <?php 
                                        if($row['d_opt']=="Y"){
                                            echo "네, 있습니다.";
                                        }else{
                                            echo "아니요, 없습니다.";
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">변형 출원 유무</td>
                                <td style="text-align:left;">
                                    <?php
                                         if($row['c_opt']=="Y"){
                                            echo "네, 변형 해주세요.";
                                        }else{
                                            echo "아니요, 그래도 출원합니다.";
                                         }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">상표 색상</td>
                                <td style="text-align:left;">
                                    <?php 
                                        if($row['o_color']=="B"){
                                            echo "블랙";
                                        }else{
                                            echo "컬러";
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
					</div>
                    <br>
                    <h4 class="card-title">담당자 정보</h4>
					<div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td co_td">담당자명</td>
                                <td style="text-align:left;"><?= $row['m_name']?> </td>
                                <td class="nation-td co_td">이메일</td>
                                <td style="text-align:left;"><?= $row['m_email']?> </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">휴대전화</td>
                                <td colspan="3" style="text-align:left;"><?= $row['m_phone']?> </td>
                            </tr>
                        </table>
                    </div>
                    <p class="p-3 text-center">
						<input type="button" value="목록" onclick="location.href='./app_overseas_list.php'" class="btn btn-outline-secondary mx-2" />
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
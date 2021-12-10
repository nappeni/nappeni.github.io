<?
	include "./head_inc.php";
	$chk_menu = '4';
	$chk_sub_menu = '1';
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as mt_idx from member_t a1
			where a1.idx = '".$_GET['mt_idx']."'
		";
		$row = $DB->fetch_query($query);
		$_act = "update";
		$_act_txt = " 수정";
	} else {
		$_act = "input";
		$_act_txt = " 입력";
	}
    $n_limit = $n_limit_num;
    $mt_idx = $_GET['mt_idx'];
    //출원 준비 관리
    $ad_sql = "select * from d_app_domestic ";
    $ad_sql_copunt = "select count(*) as dd_count from d_app_domestic ";
    $ad_sql_order = "order by d_datetime desc ";
    $ad_sql_where = "where app_status > 0 and mt_idx='".$_GET['mt_idx']."'";
    $dd_count = $DB -> fetch_query($ad_sql_copunt.$ad_sql_where);

    //상품류별 사건 관리
    $ca_sql_from =  "from d_app_domestic_item dadi left join d_app_domestic dad on dadi.app_idx = dad.idx ";
    $ca_sql_order = "order by dadi.idx desc ";
    $ca_sql_where = "where dad.app_status = 6 and dad.mt_idx='".$mt_idx."'";
    $ca_sql = "select dadi.*, dad.img_mark, dad.dt_complete {$ca_sql_from} ";
    $ca_sql_count = " select count(*) as ddi_count {$ca_sql_from} ";
    $ddi_count = $DB -> fetch_query($ca_sql_count.$ca_sql_where);
    
    //등록료 납부 관리
    $od_sql_from  = "from d_app_domestic_item ddi left join d_app_domestic dd on ddi.app_idx = dd.idx ";
    $od_sql_order = "order by ddi.idx desc ";
    $od_sql_where = "where ddi.d_status = 14 and dd.mt_idx='".$mt_idx."'";
    $od_sql = "select ddi.*, dd.cate_mark, dd.name_mark, dd.mt_name {$od_sql_from} ";
    $od_sql_count = " select count(*) as od_count {$od_sql_from} ";
    $od_count = $DB->fetch_assoc($od_sql_count.$od_sql_where);

    $get_txt = "act=update&mt_idx=".$mt_idx;
    $pg0 = $_GET['pg0'];
    $pg1 = $_GET['pg1'];
    $pg2 = $_GET['pg2'];
    if($_GET['pg0']){
        $get_txt .= "&pg0=";
    }
    if($_GET['pg1']){
        $get_txt .= "&pg1=";
    }
    if($_GET['pg2']){
        $get_txt .= "&pg2=";
    }
?>

<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">일반회원 관리</h4>
					<form method="post" name="frm_form" id="frm_form" action="./member_mng_update.php" onsubmit="return frm_form_chk(this);">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="mt_idx" id="mt_idx" value="<?=$row['mt_idx']?>" />
					<input type="hidden" name="bt_type" id="bt_type" value="1" />
                    <br>
                    <h4 class="card-title">회원 정보</h4>
					<div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td co_td">아이디</td>
                                <td><?= $row['mt_id']?> </td>
                                <td class="nation-td co_td">성명</td>
                                <td><?= $row['mt_name']?> </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">휴대전화</td>
                                <td><?= $row['mt_hp']?> </td>
                                <td class="nation-td co_td">유선전화번호</td>
                                <td> 
                                    <?php 
                                        if($row['mt_tel']==null){
                                            echo "-";
                                        }else{
                                            echo $row['mt_tel'];
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">추천인 코드</td>
                                <td><?= $row['mt_discount_cd']?> </td>
                                <td class="nation-td co_td">가입날짜</td>
                                <td><?=DateType($row['mt_wdate'],1)?> </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">보유 포인트</td>
                                <td colspan="3"><?= number_format($row['mt_point'])?> </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">출원 준비 수</td>
                                <td><?= $dd_count['dd_count']?></td>
                                <td class="nation-td co_td">상품류별 출원 수</td>
                                <td><?= $ddi_count['ddi_count']?> </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">상표 등록 수</td>
                                <td colspan="3"><?= $row['mt_discount_cd']?> </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <h4 class="card-title">환불계좌 정보</h4>
                    <div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td co_td">예금주</td>
                                <td colspan="3"><?= $row['bk_uname']?> </td>
                            </tr>
                            <tr>
                                <td class="nation-td co_td">은행명</td>
                                <td>
                                    <?php
                                        switch($row['bk_name']){
                                            case "W":
                                                echo "우리은행";
                                                break;
                                            case "N":
                                                echo "농협";
                                                break;
                                            case "B":
                                                echo "부산은행";
                                                break;
                                        }
                                    ?>
                                </td>
                                <td class="nation-td co_td">계좌번호</td>
                                <td> 
                                    <?php 
                                        if($row['bk_acount_num']==null){
                                            echo "-";
                                        }else{
                                            echo $row['bk_acount_num'];
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
					</div>
                    <br>
                    <?php 
                        $ad_total_count = $dd_count['dd_count'];
                        $ad_n_page = ceil($ad_total_count/$n_limit_num);
                        if($pg0=="") $pg0 = 1;
                        $ad_n_from = ($pg0 -1) * $n_limit;
                        unset($list);
                        $ad_sql_query = $ad_sql.$ad_sql_where.$ad_sql_order."limit ".$ad_n_from.",".$n_limit;
                        $list = $DB->select_query($ad_sql_query);
                    ?>
                    <h4 class="card-title">출원 준비 내역</h4>
                    <div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td">접수일자</td>
                                <td class="nation-td">접수번호</td>
                                <td class="nation-td">담당자 명</td>
                                <td class="nation-td">상표명</td>
                                <td class="nation-td">상품류</td>
                                <td class="nation-td">진행 상태</td>
                                <td class="nation-td">관리</td>
                            </tr>
                            <?php
                            if($list){ 
                                foreach($list as $row){
                                $sql = "select dadi.cate_ps2, cp1.ct_catenum, cp1.ct_name, count(cp1.ct_id) as cnt from d_app_domestic_item dadi left join cate_ps1 cp1 on dadi.cate_ps2 = cp1.ct_id where dadi.app_idx = '{$row['idx']}' order by cp1.ct_catenum ";
                                $dadi = $DB->fetch_assoc($sql);
                                $dadi_cnt = $dadi['cnt']-1;?>
                            <tr>
                                <td><?= str_replace("-",".",$row['d_datetime']) ?></td>
                                <td><?= $row['code1'] ?></td>
                                <td><?= $row['mt_name'] ?></td>
                                <td><?= $row['name_mark'] ?></td>
                                <td>
                                    <?
                                    $ad_txt = "제".$dadi['ct_catenum']."류";
                                    if($dadi_cnt>0){ $ad_txt .= " 그 외 ".$dadi_cnt."개"; }
                                    echo $ad_txt;
                                    ?>
                                </td>
                                <td>
                                    <? 
                                        switch($row['app_status']){
                                            case 1:
                                                echo "접수";
                                                break;
                                            case 2:
                                                echo "접수완료";
                                                break;
                                            case 3:
                                                echo "출원준비-1차 수정요청";
                                                break;
                                            case 4:
                                                echo "출원준비-2차 수정요청";
                                                break;
                                            case 5:
                                                echo "출원준비-3차 수정요청";
                                                break;
                                            case 6:
                                                echo "출원완료";
                                                break;
                                            case 7:
                                                echo "출원취소";
                                                break;
                                            case 8:
                                                echo "출원대기";
                                                break;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <input type="button" class="btn btn-outline-primary btn-sm" value="자세히" onclick="location.href='app_domestic_form.php?app_idx=<?= $row['idx']?>'"/>
                                </td>
                            </tr>
                            <?php } 
                            }else{?>
                                <tr>
                                    <td colspan="7" class="text-center"><b>내역이 없습니다.</b></td>
                                </tr>
                            <?php }?>
                        </table>
                        <?
                        if($ad_n_page>0) {
                             echo page_listing2($pg0, $ad_n_page, $_SERVER['PHP_SELF']."?".$get_txt."&pg0=");
                         }
                        ?>
					</div>
                    
                    <?php
                        $ca_total_count = $ddi_count['ddi_count'];
                        $ca_n_page = ceil($ca_total_count/$n_limit_num);
                        if($pg1=="") $pg1 = 1;
                        $ca_n_from = ($pg1 - 1)*$n_limit;
                        unset($list);
                        $ca_sql_query = $ca_sql.$ca_sql_where.$ca_sql_order."limit ".$ca_n_from.", ".$n_limit;
                        $list = $DB->select_query($ca_sql_query);
                    ?>
                    <br>
                    <h4 class="card-title">상품별 사건 내역</h4>
                    <div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td">출원일</td>
                                <td class="nation-td">접수번호</td>
                                <th class="nation-td">출원번호</th>
                                <td class="nation-td">담당자명</td>
                                <td class="nation-td">상표명</td>
                                <td class="nation-td">상품류</td>
                                <td class="nation-td">진행상태</td>
                                <td class="nation-td">관리</td>
                            </tr>
                            <?php if($list){
                                    foreach($list as $row){
                                    $sql = "select * from d_app_domestic where idx = '{$row['app_idx']}' ";
                                    $dad = $DB->fetch_assoc($sql);
                                    $sql = "select * from service_domestic where idx = '{$row['cate_s']}' ";
                                    $sd = $DB->fetch_assoc($sql);
                                    ?>
                                    
                            <tr>
                                <td><?= str_replace("-",".",$row['dt_complete']) ?></td>
                                <td><?= $row['code_register1'] ?></td>
                                <td><?= $row['code_app'] ?></td>
                                <td><?= $dad['mt_name'] ?></td>
                                <td><?= $dad['name_mark'] ?></td>
                                <td><?= $sd['s_name'] ?></td>
                                <td>
                                    <?php 
                                        switch($row['d_status']){
                                            case 1:
                                                echo "출원완료"; 
                                                break;
                                            case 2:
                                                echo "심사중";
                                                break;
                                            case 3:
                                                echo "출원취소";
                                                break;
                                            case 4:
                                                echo "심사 결과 통지";
                                                break;
                                            case 5:
                                                echo "심사 재개";
                                                break;
                                            case 6:
                                                echo "거절결정 1차"; 
                                                break;
                                            case 7:
                                                echo "심사진행";
                                                break;
                                            case 8:
                                                echo "거절결정 2차";
                                                break;
                                            case 9:
                                                echo "심판결과 (패소)";
                                                break;
                                            case 10:
                                                echo "승소";
                                                break;
                                            case 11:
                                                echo "출원공고";
                                                break;
                                            case 12:
                                                echo "등록대기"; 
                                                break;
                                            case 13:
                                                $sql_dadh = "select * from d_app_domestic_history2 where app_idx = '{$row['app_idx']}' and app_item_idx = '{$row['idx']}' and d_content = '등록결정' ";
                                                $dadh = $DB->fetch_assoc($sql_dadh);
                                                if($dadh['d_pay_status']=="paid"){
                                                    echo "등록결정 (결제완료)";
                                                }else{
                                                    echo "등록결정 (결제대기)";
                                                }
                                                break;
                                            case 14:
                                                echo "등록완료";
                                                break;
                                        }
                                    ?>
                                </td>
                                <td>
                                <input type="button" class="btn btn-outline-primary btn-sm" value="자세히" onclick="location.href='app_domestic_form.php?app_idx=<?= $row['idx']?>'"/>
                                </td>
                            </tr>
                            <?php } 
                            }else{?>
                                <tr>
                                    <td colspan="8" class="text-center"><b>내역이 없습니다.</b></td>
                                </tr>
                            <?php }?>
                        </table>
                        <?
                            if($ca_n_page>0) {
                                echo page_listing2($pg1, $ca_n_page, $_SERVER['PHP_SELF']."?".$get_txt."&pg1=");
                            }
                        ?>
					</div>
                    <br>
                    <?php 
                        $od_total_count = $od_count['od_count'];
                        $od_n_page = ceil($od_total_count/ $n_limit_num);
                        if($pg2=="") $pg2 =1;
                        $od_n_from = ($pg2-1)*$n_limit;
                        unset($list);
                        $od_sql_query = $od_sql.$od_sql_where.$od_sql_order."limit ".$od_n_from.", ".$n_limit;
                        $list = $DB->select_query($od_sql_query);
                    ?>
                    <h4 class="card-title">등록료 납부 내역</h4>
                    <div class="form-group row">
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td">상품명</td>
                                <td class="nation-td">등록번호</td>
                                <td class="nation-td">담당자명</td>
                                <td class="nation-td">상품류</td>
                                <td class="nation-td">존속기간</td>
                                <td class="nation-td">갱신일</td>
                                <td class="nation-td">결제금액</td>
                                <td class="nation-td">결제상태</td>
                                <td class="nation-td">관리</td>
                            </tr>
                            <?php if($list){
                                foreach($list as $row){
                                        $sql = "select ct_catenum, ct_name from cate_ps1 where ct_id = '{$row['cate_ps2']}' ";
                                        $cpi = $DB->fetch_assoc($sql);
                                        $sqlb = "select date_add('{$row['dt_register_complete']}',interval {$row['period']} year) as dt from dual ";
                                        $rowb = $DB->fetch_assoc($sqlb);
                                        $dt_period_result = str_replace("-",".",$rowb['dt']);if($row['dt_renewal']){
                                        $sqlb = "select date_add('{$row['dt_renewal']}',interval {$row['period']} year) as dt from dual ";
                                        $rowb = $DB->fetch_assoc($sqlb);
                                        $dt_period_result = str_replace("-",".",$rowb['dt']);
                                    }else{
                                        $sqlb = "select date_add('{$row['dt_register_complete']}',interval {$row['period']} year) as dt from dual ";
                                        $rowb = $DB->fetch_assoc($sqlb);
                                        $dt_period_result = str_replace("-",".",$rowb['dt']);
                                    }

                                    $sqlc = "select * from order_domestic where app_item_idx = '{$row['idx']}' and (ot_mode = 8 or ot_mode = 9) order by idx desc limit 1 ";
                                    $rowc = $DB->fetch_assoc($sqlc);    
                                ?>
                                <tr>
                                    <td><?= $row['name_mark'] ?></td>
                                    <td><?= $row['code_register2'] ?></td>
                                    <td><?= $row['mt_name'] ?></td>
                                    <td>제<?= $cpi['ct_catenum'] ?>류</td>
                                    <td><?= $dt_period_result ?> (<?= $row['period'] ?>년)</td>
                                    <td><?= $row['dt_renewal'] ?></td>
                                    <td><?= number_format($rowc['sum_price']) ?></td>
                                    <td><?= $rowc['od_status'] ?></td>
                                    <td>
                                        <input type="button" class="btn btn-outline-primary btn-sm" value="자세히" onclick="location.href='./registered_trademark_form.php?idx=<?= $row['idx']?>'"/>
                                    </td>
                                </tr>
                            <?php }
                            }else{?>
                            <tr>
                                <td colspan="9" class="text-center"><b>내역이 없습니다.</b></td>
                            </tr>
                            <?php }?> 
                        </table>
                        <?
                            if($ca_n_page>0) {
                                echo page_listing2($pg1, $ca_n_page, $_SERVER['PHP_SELF']."?".$get_txt."&pg1=");
                            }
                        ?>
					</div>
                    <br>
                    <h4 class="card-title">포인트 변동내역(최신 20건)</h4>
                    <div class="form-group row">
                        <div style="width: 100%; height:30px; float: right;">
                            <div style="cursor: pointer" onclick="location.href='./member_point.php?sel_search=a2.mt_id&search_txt=<?=$row['mt_id']?>'">전체보기</div>
                        </div>
                        <table class="table table-bordered" style="text-align: center;">
                            <tr>
                                <td class="nation-td">NO</td>
                                <td class="nation-td">적립/사용 일시</td>
                                <td class="nation-td">내용</td>
                                <td class="nation-td">구분</td>
                                <td class="nation-td">지급/사용 포인트</td>
                                <td class="nation-td">사용 만료일시</td>
                            </tr>
                            <?php 
                            foreach($data as $row){?>
                            <tr>
                                <td><?= $i=1?></td>
                                <td><?= DATETYPE($row['pt_wdate'],6)?></td>
                                <td><?= $row['pt_content']?></td>
                                <td>
                                    <?php 
                                    if($row['pt_type']=='P'){
                                        echo "적립";
                                    }else{
                                        echo "차감";
                                    }
                                    ?>
                                </td>
                                <td><?= $row['pt_point']?></td>
                                <td><?= $row['pt_rdate']?></td>
                            </tr>
                            <?php $i++;}?>
                        </table>
					</div>
                    <br>
                    <?php 
                        $result = $DB->select_query("select ad_msg from member_t where idx='".$mt_idx."'");
                        foreach($result as $row);
                    ?>
                    <h4 class="card-title">기타</h4>
                    <div class="form-group row">
						<label for="ad_msg" class="col-sm-2 col-form-label" style="background-color:lightgray; font-weight:bold; text-align:center; padding-top: 60px;">관리자 메모</label>
						<div class="col-sm-10">
							<textarea name="ad_msg" id="ad_msg" class="form-control form-control-sm" style="height: 150px;"><?= $row['ad_msg']?></textarea>
						</div>
					</div>
					<p class="p-3 text-center">
						<input type="button" value="목록" onclick="goList()" class="btn btn-outline-secondary mx-2" />
                        <input type="submit" value="확인" class="btn btn-outline-primary" />
					</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function goList(){
        var result = confirm("관리자 메모를 저장하지 않고 목록으로 나가시겠습니까?");
        if(result == true){
            location.href='./member_mng.php';
        }
    }
    function frm_form_chk(f){
        var msg = document.getElementById('ad_msg').value;
        if(msg==''){
            alert("관리자 메모를 입력해주세요");
            return false;
        }
        return true;
    }
</script>
<?
	include "./foot_inc.php";
?>
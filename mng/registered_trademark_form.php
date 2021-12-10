<?php
include "./head_inc.php";
$chk_menu = '3';
include "./head_menu_inc.php";

$app_item_idx = $_GET['idx'];
$sfl = $_GET['sfl'];
$stx = $_GET['stx'];
$stx_dt1 = $_GET['stx_dt1'];
$stx_dt2 = $_GET['stx_dt2'];
$pg = $_GET['pg'];
$pg2 = $_GET['pg2'];

$qstr = "sfl=".$_GET['sfl'];
$qstr .= "&stx=".$_GET['stx'];
if($_GET['stx_dt1']){ $qstr .= "&stx_dt1=".$_GET['stx_dt1']; }
if($_GET['stx_dt2']){ $qstr .= "&stx_dt2=".$_GET['stx_dt2']; }
$qstr .= "&pg=".$pg;


$sql = "select * from d_app_domestic_item where idx = '{$app_item_idx}' ";
$dadi = $DB->fetch_assoc($sql);
$sql = "select * from d_app_domestic where idx = '{$dadi['app_idx']}' ";
$dad = $DB->fetch_assoc($sql);
$sql = "select * from service_domestic where idx = '{$dadi['cate_s']}' ";
$sd = $DB->fetch_assoc($sql);
$sql = "select * from cate_ps1 where ct_id = '{$dadi['cate_ps2']}' ";
$cp1 = $DB->fetch_assoc($sql);

if($dadi['dt_renewal']){
    $sqlb = "select date_add('{$dadi['dt_renewal']}',interval {$dadi['period']} year) as dt from dual ";
    $rowb = $DB->fetch_assoc($sqlb);
    $dt_period_result = str_replace("-",".",$rowb['dt']);
}else{
    $sqlb = "select date_add('{$dadi['dt_register_complete']}',interval {$dadi['period']} year) as dt from dual ";
    $rowb = $DB->fetch_assoc($sqlb);
    $dt_period_result = str_replace("-",".",$rowb['dt']);
}

if($dad['cate_mark']==1){ $cate_mark = "문자 상표"; }
else if($dad['cate_mark']==2){ $cate_mark = "도형 상표"; }
else if($dad['cate_mark']==3){ $cate_mark = "복합 상표"; }
else if($dad['cate_mark']==4){ $cate_mark = "기타 상표"; }

$n_limit_num = 15;
$n_limit = $n_limit_num;

$sql_count = "select count(*) as cnt from order_domestic where app_item_idx = '{$app_item_idx}' and (ot_mode = 8 or ot_mode = 9) order by idx desc ";

$row_cnt = $DB->fetch_assoc($sql_count);
$total_count = $row_cnt['cnt'];
$n_page = ceil($total_count / $n_limit_num);
if($pg2=="") $pg2 = 1;
$n_from = ($pg2 - 1) * $n_limit;

$sql = "select * from order_domestic where app_item_idx = '{$app_item_idx}' and (ot_mode = 8 or ot_mode = 9) order by idx desc "."limit ".$n_from.", ".$n_limit;
$list_o = $DB->select_query($sql);

$qstr2 = "idx=".$app_item_idx."&".$qstr."&pg2=";
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">등록료 납부 관리</h4>

                    <div class="flex margin-bottom-10 wd-100">
                        <div class="margin-left-auto">
                            <input type="button" value="목록" onclick="click_golist()" class="btn btn-secondary" />
                            <input type="button" class="btn btn-primary" value="저장하기" onclick="submit_form1()">
                        </div>
                    </div>

                    <div class="view-scroll-y" style="height: 550px;">
                        <form method="post" name="form1" id="form1" action="./registered_trademark_form_update.php" enctype="multipart/form-data">
                            <input type="hidden" name="app_item_idx" id="app_item_idx" value="<?= $app_item_idx ?>" />
                            <input type="hidden" name="qstr" id="qstr" value="<?= $qstr ?>" />
                            <input type="hidden" name="qstr2" id="qstr2" value="<?= $qstr2 ?>" />
                            <input type="hidden" name="pg2" id="pg2" value="<?= $pg2 ?>" />

                            <div class="font-20 font-weight-700 mb-3">상표 정보</div>
                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">상표 유형</th>
                                    <td class="wd-35 py-3 px-3"><?= $cate_mark ?></td>
                                    <th class="jm_th1 wd-15 py-3">상표명</th>
                                    <td class="wd-35 py-3 px-3"><?= $dad['name_mark'] ?></td>
                                </tr>
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">등록 번호</th>
                                    <td class="wd-35 py-3 px-3"><?= $dadi['code_register2'] ?></td>
                                    <th class="jm_th1 wd-15 py-3">상품류</th>
                                    <td class="wd-35 py-3 px-3">제<?= $cp1['cate_num'] ?>류</td>
                                </tr>
                                <? if($dad['img_mark']){ ?>
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">상표 이미지</th>
                                    <td class="py-3 px-3" colspan="3">
                                        <a href="../data/app_domestic/<?= $dad['img_mark'] ?>" target="_blank">
                                            <img class="wd-100" src="../data/app_domestic/<?= $dad['img_mark'] ?>" alt="상표 이미지" style="max-width: 400px;">
                                        </a>
                                    </td>
                                </tr>
                                <? } ?>
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">등록공보</th>
                                    <td class="py-3 px-3" colspan="3"><a href="../data/app_domestic_item/<?= $dadi['file_report4'] ?>" target="_blank" download="<?= $dadi['file_report4_origin'] ?>"><?= $dadi['file_report4_origin'] ?></a></td>
                                </tr>
                            </table>

                            <div class="font-20 font-weight-700 mb-3">존속 기간</div>
                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">존속 기간</th>
                                    <td class="py-3 px-3" colspan="3">
                                        <?
                                        echo $dt_period_result." (".$dadi['period']."년)";
                                        ?>
                                    </td>
                                </tr>
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">갱신일</th>
                                    <td class="py-3 px-3" colspan="3">
                                        <input type="text" name="dt_renewal" id="dt_renewal" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $dadi['dt_renewal'] ?>">
                                    </td>
                                </tr>
                            </table>

                            <div class="font-20 font-weight-700 mb-3">담당자 정보</div>
                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">담당자명</th>
                                    <td class="wd-35 py-3 px-3"><?= $dad['mt_name'] ?></td>
                                    <th class="jm_th1 wd-15 py-3">이메일</th>
                                    <td class="wd-35 py-3 px-3"><a href="mailto:<?= $dad['mt_email'] ?>"><?= $dad['mt_email'] ?></a></td>
                                </tr>
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">휴대전화</th>
                                    <td class="py-3 px-3" colspan="3"><?= format_phone(str_replace("-","",$dad['mt_hp'])) ?></td>
                                </tr>
                            </table>

                            <div class="font-20 font-weight-700 mb-3">갱신/결제 내역</div>
                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 py-3">결제일</th>
                                    <th class="jm_th1 py-3">결제 상품</th>
                                    <th class="jm_th1 py-3">결제 수단</th>
                                    <th class="jm_th1 py-3">결제 상태</th>
                                </tr>
                                <?
                                if(count($list_o)>0){
                                    foreach ($list_o as $rowo) {
                                        ?>
                                        <tr class="show_stat show_stat11">
                                            <td class="py-3 text-center"><?= $rowo['ot_pdate'] ?></td>
                                            <td class="py-3 text-center"><?= $rowo['odname'] ?></td>
                                            <td class="py-3 text-center"><?= $rowo['pay_method'] ?></td>
                                            <td class="py-3 text-center"><? if($rowo['od_status']=='paid'){echo '결제 완료';}else{echo '결제 대기';} ?></td>
                                        </tr>
                                        <?
                                    }
                                }
                                ?>
                            </table>
                            <div class="wrap_pagination">
                                <?
                                if($n_page>0) {
                                    echo page_listing2($pg2, $n_page, $_SERVER['PHP_SELF']."?".$qstr2);
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function click_golist(){
        if(confirm("정말 저장 없이 전 페이지로 돌아가시겠습니까?")){
            location.href = "./registered_trademark_list.php?<?=$qstr?>";
        }
    }
</script>
<?
include "./foot_inc.php";
?>

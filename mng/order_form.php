<?php
include "./head_inc.php";
$chk_menu = '6';
$chk_sub_menu = '2';
include "./head_menu_inc.php";
$pg = $_GET['pg'];
$idx = $_GET['idx'];

$qstr = "stx=".$_GET['stx'];
$qstr .= "&sfl=".$_GET['sfl'];
$qstr .= "&stx_dt1=".$_GET['stx_dt1'];
$qstr .= "&stx_dt2=".$_GET['stx_dt2'];
$qstr .= "&pg=".$_GET['pg'];

$sql_from = "from order_domestic od left join member_t m on od.mt_idx = m.idx ";
$sql = "select od.*, m.mt_name, m.mt_email, m.mt_hp {$sql_from} where od.idx = '{$idx}' ";
$od = $DB->fetch_assoc($sql);
$sql = "select * from d_app_domestic where idx = '{$od['app_idx']}' ";
$dad = $DB->fetch_assoc($sql);
$sql = "select * from d_app_domestic_item where idx = '{$od['app_item_idx']}' ";
$dadi = $DB->fetch_assoc($sql);
$sql = "select * from service_domestic where idx = '{$dadi['cate_s']}' ";
$sd = $DB->fetch_assoc($sql);
$sql = "select * from cate_ps1 where ct_id = '{$dadi['cate_ps2']}' ";
$cp1 = $DB->fetch_assoc($sql);

if($dad['cate_mark']==1){ $cate_mark = "문자 상표"; }
else if($dad['cate_mark']==2){ $cate_mark = "도형 상표"; }
else if($dad['cate_mark']==3){ $cate_mark = "복합 상표"; }
else if($dad['cate_mark']==4){ $cate_mark = "기타 상표"; }
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">결제 관리</h4>

                    <div class="flex margin-bottom-10 wd-100">
                        <div class="margin-left-auto">
                            <input type="button" value="목록" onclick="click_golist()" class="btn btn-secondary" />
                            <input type="button" class="btn btn-primary" value="저장하기" onclick="submit_form1()">
                        </div>
                    </div>

                    <div>
                        <form method="post" name="form1" id="form1" action="./order_form_update.php" enctype="multipart/form-data">
                            <input type="hidden" name="idx" id="idx" value="<?= $idx ?>" />
                            <input type="hidden" name="qstr" id="qstr" value="<?= $qstr ?>" />

                            <div class="font-20 font-weight-700 mb-3">결제 내용</div>
                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">결제 상태</th>
                                    <td class="py-3 px-3">
                                        <select name="od_status" id="od_status" class="custom-select custom-select-sm sel_od_status" data-idx="<?= $od['idx'] ?>" style="max-width: 400px;">
                                            <option value="paid" <? if($od['od_status']=='paid'){echo 'selected';} ?> >결제 완료</option>
                                            <option value="ready" <? if($od['od_status']=='ready'){echo 'selected';} ?> >결제 대기</option>
                                            <option value="canceled" <? if($od['od_status']=='ready'){echo 'canceled';} ?> >환불요청</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">관리자 메모</th>
                                    <td class="py-3 px-3"><textarea name="ot_memo" id="ot_memo" class="form-control form-control-sm" rows="6"><?= strip_tags($od['ot_memo']) ?></textarea></td>
                                </tr>
                            </table>

                            <div class="font-20 font-weight-700 mb-3">회원 정보</div>
                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">이름</th>
                                    <td class="wd-35 py-3 px-3"><?= $od['mt_name'] ?></td>
                                    <th class="jm_th1 wd-15 py-3">이메일</th>
                                    <td class="wd-35 py-3 px-3"><a href="mailto:<?= $od['mt_email'] ?>"><?= $od['mt_email'] ?></a></td>
                                </tr>
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">휴대전화</th>
                                    <td class="py-3 px-3" colspan="3"><?= format_phone(str_replace("-","",$od['mt_hp'])) ?></td>
                                </tr>
                            </table>

                            <div class="font-20 font-weight-700 mb-3">상표 정보</div>
                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">상표 유형</th>
                                    <td class="wd-35 py-3 px-3"><?= $cate_mark ?></td>
                                    <th class="jm_th1 wd-15 py-3">상표명</th>
                                    <td class="wd-35 py-3 px-3"><?= $dad['name_mark'] ?></td>
                                </tr>
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">접수 번호</th>
                                    <td class="py-3 px-3" colspan="3">
                                        <?
                                        if($od['app_item_idx']){
                                            echo $dadi['code_register1'];
                                        }else{
                                            echo $dad['code1'];
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <? if($od['app_item_idx']){ ?>
                                    <tr class="show_stat show_stat11">
                                        <th class="jm_th1 wd-15 py-3">출원번호</th>
                                        <td class="py-3 px-3" colspan="3"><?= $dadi['code_app'] ?></td>
                                    </tr>
                                    <tr class="show_stat show_stat11">
                                        <th class="jm_th1 wd-15 py-3">상품류</th>
                                        <td class="py-3 px-3" colspan="3">제<?= $cp1['cate_num'] ?>류</td>
                                    </tr>
                                <? } ?>

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

                            </table>

                            <!--<div class="font-20 font-weight-700 mb-3">결제 내역</div>
                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 py-3">결제일</th>
                                    <th class="jm_th1 py-3">결제 상품</th>
                                    <th class="jm_th1 py-3">결제 수단</th>
                                    <th class="jm_th1 py-3">결제 상태</th>
                                </tr>
                                <?/*
                                if(count($list_o)>0){
                                    foreach ($list_o as $rowo) {
                                        */?>
                                        <tr class="show_stat show_stat11">
                                            <td class="py-3 text-center"><?/*= $rowo['ot_pdate'] */?></td>
                                            <td class="py-3 text-center"><?/*= $rowo['odname'] */?></td>
                                            <td class="py-3 text-center"><?/*= $rowo['pay_method'] */?></td>
                                            <td class="py-3 text-center"><?/* if($rowo['od_status']=='paid'){echo '결제 완료';}else{echo '결제 대기';} */?></td>
                                        </tr>
                                        <?/*
                                    }
                                }
                                */?>
                            </table>
                            <div class="wrap_pagination">
                                <?/*
                                if($n_page>0) {
                                    echo page_listing2($pg2, $n_page, $_SERVER['PHP_SELF']."?".$qstr2);
                                }
                                */?>
                            </div>-->

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
            location.href = "./order_list.php?<?= $qstr ?>";
        }
    }
</script>
<?
include "./foot_inc.php";
?>

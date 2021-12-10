<?php
include "./head_inc.php";
$chk_menu = '6';
$chk_sub_menu = '3';
include "./head_menu_inc.php";

$w = $_GET['w'];
$idx = $_GET['idx'];
$sfl = $_GET['sfl'];
$stx = $_GET['stx'];
$stx_dt1 = $_GET['stx_dt1'];
$stx_dt2 = $_GET['stx_dt2'];
$pg = $_GET['pg'];
$strcode = $_GET['strcode'];


$qstr = 'sfl='.$sfl;
$qstr .= '&$stx='.$stx;
$qstr .= '&stx_dt1='.$stx_dt1;
$qstr .= '&stx_dt2='.$stx_dt2;
$qstr .= '&pg='.$pg;

if($w==""){

}else{
    $sql = "select * from d_refunt where idx = '{$idx}' ";
    $dr = $DB->fetch_assoc($sql);

    if(!$_GET['strcode']){$strcode = $dr['strcode'];}

    $sql = "select * from d_app_domestic where idx = '{$dr['app_idx']}' ";
    $dad = $DB->fetch_assoc($sql);
    $sql = "select * from d_app_domestic_item where idx = '{$dr['app_item_idx']}' ";
    $dadi = $DB->fetch_assoc($sql);
}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">환불 관리</h4>

                    <div class="flex margin-bottom-10 wd-100">
                        <div class="margin-left-auto">
                            <input type="button" value="목록" onclick="click_golist()" class="btn btn-secondary" />
                            <input type="button" class="btn btn-primary" value="저장하기" onclick="submit_form1()">
                            <input type="button" value="삭제" class="btn btn-danger" onclick="del_content('d_refunt','<?= $dr['idx'] ?>','/mng/refund_list_domestic.php?<?= $qstr ?>')">
                        </div>
                    </div>

                    <div class="view-scroll-y" style="height: 550px;">
                        <form method="post" name="form1" id="form1" action="./refund_form_domestic_update.php" enctype="multipart/form-data">
                            <input type="hidden" name="w" value="<?= $w ?>" />
                            <input type="hidden" name="idx" value="<?= $idx ?>" />
                            <input type="hidden" name="qstr" value="<?= $qstr ?>" />
                            <input type="hidden" name="cate1" value="domestic" />

                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">접수 번호</th>
                                    <td class="py-3 px-3">
                                        <input type="text" name="code_register1" id="code_register1" class="form-control form-control-sm wd-40 d-inline-block" value="<?= $strcode ?>" required>
                                        <input type="button" class="btn btn btn-info" value="검색" onclick="sch_code_register1_mng()">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="jm_th1 wd-15 py-3">관리자 메모</th>
                                    <td class="py-3 px-3">
                                        <textarea type="text" name="txt_memo" id="txt_memo" class="form-control form-control-sm" rows="7"><?= strip_tags($dr['txt_memo']) ?></textarea>
                                    </td>
                                </tr>
                                <? if($w==""){ ?>
                                <tr>
                                    <th class="jm_th1 wd-15 py-3">등록일시</th>
                                    <td class="py-3 px-3"><?= $dr['d_datetime'] ?></td>
                                </tr>
                                <? } ?>
                            </table>

                            <div id="wrap_sch_code_register1">
                                <?
                                if($strcode){
                                    $sql = "select * from d_app_domestic where code1 = '{$strcode}' ";
                                    $rowa = $DB->fetch_assoc($sql);
                                    $sql = "select * from d_app_domestic_item where code_register1 = '{$strcode}' ";
                                    $rowb = $DB->fetch_assoc($sql);

                                    $result_num = 0;
                                    $listc = "";

                                    if($rowa['idx']){
                                        $sqlc = "select * from order_domestic where app_idx = '{$rowa['idx']}' and app_item_idx < 1 order by idx desc ";
                                        $listc = $DB->select_query($sqlc);
                                        if(count($listc)>0){
                                            $sqlc = "select * from d_app_domestic_item where idx = '{$rowb['idx']}' ";
                                            $dadic = $DB->fetch_assoc($sqlc);
                                            $sqlc = "select * from d_app_domestic where idx = '{$dadic['app_idx']}' ";
                                            $dadc = $DB->fetch_assoc($sqlc);
                                            $sqlc = "select * from member_t where idx = '{$dadc['mt_idx']}' ";
                                            $mtc = $DB->fetch_assoc($sqlc);
                                            ?>
                                            <table cellpadding="0" cellspacing="0" class="wd-100 mb-3">
                                                <tr>
                                                    <td class="jm_th1 wd-15 py-3">회원이름</td>
                                                    <td class="jm_td1 wd-35 py-3"><?= $mtc['mt_name'] ?></td>
                                                    <td class="jm_th1 wd-15 py-3">회원이메일</td>
                                                    <td class="jm_td1 wd-35 py-3"><?= $mtc['mt_email'] ?></td>
                                                </tr>
                                            </table>
                                            <table cellpadding="0" cellspacing="0" class="wd-100">
                                                <tr>
                                                    <td class="jm_th1 py-3">진행단계</td>
                                                    <td class="jm_th1 py-3">주문금액</td>
                                                    <td class="jm_th1 py-3">출원인코드<br>할인금액</td>
                                                    <td class="jm_th1 py-3">할인코드<br>할인금액</td>
                                                    <td class="jm_th1 py-3">사용 포인트</td>
                                                    <td class="jm_th1 py-3">총 결제금액</td>
                                                    <td class="jm_th1 py-3">결제수단</td>
                                                    <td class="jm_th1 py-3">결제상태</td>
                                                    <td class="jm_th1 py-3">결제일시</td>
                                                    <td class="jm_th1 py-3">관리</td>
                                                </tr>
                                                <?
                                                foreach ($listc as $rowc){
                                                    ?>
                                                    <tr>
                                                        <td class="jm_td1 py-2"><?= $rowc['odname'] ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['sum_price']) ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['sale_price_mtcode']) ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['sale_price_salecode']) ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['sale_price_point']) ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['paid_amount']) ?></td>
                                                        <td class="jm_td1 py-2"><?= $rowc['pay_method'] ?></td>
                                                        <td class="jm_td1 py-2">
                                                            <?
                                                            if($rowc['od_status']=='paid'){ echo '결제 완료'; }
                                                            else if($rowc['od_status']=='ready'){ echo '결제 대기'; }
                                                            else if($rowc['od_status']=='canceled'){ echo '환불 요청'; }
                                                            ?>
                                                        </td>
                                                        <td class="jm_td1 py-2"><?= $rowc['ot_pdate'] ?></td>
                                                        <td class="jm_td1 py-2">
                                                            <?
                                                            if($rowc['od_status']!='canceled'){
                                                                ?>
                                                                <input type="button" class="btn btn btn-info" value="환불" onclick="chk_refund('<?= $rowb['idx'] ?>')">
                                                                <?
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?
                                                }
                                                ?>
                                            </table>
                                            <?php

                                        }
                                    }else if($rowb['idx']){
                                        $sqlc = "select * from order_domestic where app_item_idx = '{$rowb['idx']}' order by idx desc ";
                                        $listc = $DB->select_query($sqlc);
                                        if(count($listc)>0){
                                            $sqlc = "select * from d_app_domestic_item where idx = '{$rowb['idx']}' ";
                                            $dadic = $DB->fetch_assoc($sqlc);
                                            $sqlc = "select * from d_app_domestic where idx = '{$dadic['app_idx']}' ";
                                            $dadc = $DB->fetch_assoc($sqlc);
                                            $sqlc = "select * from member_t where idx = '{$dadc['mt_idx']}' ";
                                            $mtc = $DB->fetch_assoc($sqlc);
                                            ?>
                                            <table cellpadding="0" cellspacing="0" class="wd-100 mb-3">
                                                <tr>
                                                    <td class="jm_th1 wd-15 py-3">회원이름</td>
                                                    <td class="jm_td1 wd-35 py-3"><?= $mtc['mt_name'] ?></td>
                                                    <td class="jm_th1 wd-15 py-3">회원이메일</td>
                                                    <td class="jm_td1 wd-35 py-3"><?= $mtc['mt_email'] ?></td>
                                                </tr>
                                            </table>

                                            <table cellpadding="0" cellspacing="0" class="wd-100">
                                                <tr>
                                                    <td class="jm_th1 py-3">진행단계</td>
                                                    <td class="jm_th1 py-3">주문금액</td>
                                                    <td class="jm_th1 py-3">출원인코드<br>할인금액</td>
                                                    <td class="jm_th1 py-3">할인코드<br>할인금액</td>
                                                    <td class="jm_th1 py-3">사용 포인트</td>
                                                    <td class="jm_th1 py-3">총 결제금액</td>
                                                    <td class="jm_th1 py-3">결제수단</td>
                                                    <td class="jm_th1 py-3">결제상태</td>
                                                    <td class="jm_th1 py-3">결제일시</td>
                                                    <td class="jm_th1 py-3">관리</td>
                                                </tr>
                                                <?
                                                foreach ($listc as $rowc){
                                                    ?>
                                                    <tr>
                                                        <td class="jm_td1 py-2"><?= $rowc['odname'] ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['sum_price']) ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['sale_price_mtcode']) ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['sale_price_salecode']) ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['sale_price_point']) ?></td>
                                                        <td class="jm_td1 py-2"><?= number_format($rowc['paid_amount']) ?></td>
                                                        <td class="jm_td1 py-2"><?= $rowc['pay_method'] ?></td>
                                                        <td class="jm_td1 py-2">
                                                            <?
                                                            if($rowc['od_status']=='paid'){ echo '결제 완료'; }
                                                            else if($rowc['od_status']=='ready'){ echo '결제 대기'; }
                                                            else if($rowc['od_status']=='canceled'){ echo '환불 요청'; }
                                                            ?>
                                                        </td>
                                                        <td class="jm_td1 py-2"><?= $rowc['ot_pdate'] ?></td>
                                                        <td class="jm_td1 py-2">
                                                            <?
                                                            if($rowc['od_status']!='canceled'){
                                                                ?>
                                                                <input type="button" class="btn btn btn-info" value="환불" onclick="chk_refund('<?= $rowb['idx'] ?>')">
                                                                <?
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?
                                                }
                                                ?>
                                            </table>
                                            <?php

                                        }
                                    }else{

                                    }
                                }
                                ?>
                            </div>

                            <script>
                                function chk_refund(od_idx){
                                    if(confirm("해당 결제 건을 환불 처리하시곘습니까?")){
                                        $.ajax({
                                            type: "POST",
                                            url: hostname + "/get_ajax.php",
                                            data: {
                                                mode:'refund_order_mng',
                                                idx:od_idx,
                                            },
                                            cache: false,
                                            success: function(data){
                                                console.log(data);
                                                //location.reload();
                                            }
                                        });
                                    }
                                }

                                function sch_code_register1_mng(){
                                    var strcode = $("#code_register1").val();
                                    if(strcode.length<1){
                                        alert('접수번호를 입력해주세요.');
                                        $("#code_register1").focus();
                                    }else{
                                        var qstr = 'w=<?= $w ?>';
                                        qstr += '&strcode='+strcode;
                                        qstr += '&idx=<?= $idx ?>';
                                        qstr += '&<?= $qstr ?>';
                                        location.href = "./refund_form_domestic.php?"+qstr;
                                    }

                                }
                            </script>

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
            location.href = "./refund_list_domestic.php?<?= $qstr ?>";
        }
    }
</script>
<?
include "./foot_inc.php";
?>

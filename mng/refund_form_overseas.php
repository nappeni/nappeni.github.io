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
$o_idx = $_GET['o_idx'];


$qstr = 'sfl='.$sfl;
$qstr .= '&$stx='.$stx;
$qstr .= '&stx_dt1='.$stx_dt1;
$qstr .= '&stx_dt2='.$stx_dt2;
$qstr .= '&pg='.$pg;

if($w=="u"){
    if($o_idx){
        $sql = "select * from o_app_domestic where idx='".$o_idx."'";
        $ot = $DB->fetch_assoc($sql);
    }
}else{
    $sql = "select * from d_refunt where idx = '{$idx}' ";
    $dr = $DB->fetch_assoc($sql);
    $sql = "select * from o_app_domestic where idx='".$o_idx."'";
    $ot = $DB->fetch_assoc($sql);
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
                        </div>
                    </div>

                    <div class="view-scroll-y" style="height: 550px;">
                        <form method="post" name="form1" id="form1" action="./refund_overseas_update.php" enctype="multipart/form-data" onsubmit="return chk_refund()">
                            <input name="act" type="hidden" value="<?php echo $w=='u'?"input":"update"?>">
                            <input type="hidden" name="idx" id="idx" value="<?= $idx ?>" />
                            <input type="hidden" name="o_idx" id="o_idx" value="<?= $o_idx ?>" />
                            <input type="hidden" name="p_name" id="p_name" value="<?= $strcode?>"/>
                            <input type="hidden" name="qstr" id="qstr" value="<?= $qstr ?>" />

                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <tr class="show_stat show_stat11">
                                    <th class="jm_th1 wd-15 py-3">상품명</th>
                                    <td class="py-3 px-3">
                                        <input type="text" name="m_name" id="m_name" class="form-control form-control-sm wd-40 d-inline-block" value="<?= $strcode ?>" required>
                                        <?php if($w=='u'){?>
                                        <input type="button" class="btn btn btn-info" value="검색" onclick="sch_m_name()">
                                        <?php }?>
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
                                <? }?>
                            </table>

                            <div id="wrap_sch_code_register1">
                                <?if($strcode){
                                    $sql = "select * from o_app_domestic od where od.p_name = '{$strcode}' ";
                                    $rowa = $DB->select_query($sql);
                                    if($rowa){  
                                        foreach($rowa as $rowa){ ?> 
                                            <table cellpadding="0" cellspacing="0" class="wd-100">
                                                <tr>
                                                    <td class="jm_th1 py-3">담당자 명</td>
                                                    <td class="jm_th1 py-3">상표명</td>
                                                    <td class="jm_th1 py-3">출원 국가</td>
                                                    <td class="jm_th1 py-3">접수날짜</td>
                                                    <?php if($w=='u'){?>
                                                    <td class="jm_th1 py-3">관리</td>
                                                    <?php }?>
                                                </tr>
                                                <tr>
                                                    <td class="jm_td1 py-2"><?= $rowa['m_name']?></td>
                                                    <td class="jm_td1 py-2"><?= $rowa['p_name']?></td>
                                                    <td class="jm_td1 py-2">
                                                    <?php
                                                        $nations = explode("/",$rowa['o_nations']);
                                                        $sql = "select nt_name from nation_t where idx='".$nations[0]."'";
                                                        $n_name = $DB->fetch_query($sql);
                                                        $n_count = count($nations)-2;
                                                        $n_txt = $n_name['nt_name'];
                                                        if($n_count>0){
                                                            $n_txt .= " 외 ".$n_count."개";
                                                        }
                                                        echo $n_txt;
                                                    ?>
                                                    </td>
                                                    <td class="jm_td1 py-2"><?= dateType($rowa['o_datetime'],1)?></td>
                                                    <?php if($w=='u'){?>
                                                    <td class="jm_td1 py-2"><input type="button" class="btn btn btn-info" value="선택" onclick="sch_o_info(<?= $rowa['idx']?>)"></td>
                                                    <?php }?>
                                                </tr>
                                            </table>
                                        <? }
                                    }else{?>
                                    <table cellpadding="0" cellspacing="0" class="wd-100">
                                                <tr>
                                                    <td class="jm_th1 py-3">담당자 명</td>
                                                    <td class="jm_th1 py-3">상표명</td>
                                                    <td class="jm_th1 py-3">출원 국가</td>
                                                    <td class="jm_th1 py-3">접수날짜</td>
                                                    <?php if($w=='u'){?>
                                                    <td class="jm_th1 py-3">관리</td>
                                                    <?php }?>
                                                </tr>
                                                <tr>
                                                    <td class="jm_td1 py-2" colspan="5">해당 결과가 없습니다.</td>
                                                </tr>
                                            </table>
                                <?}
                                }?>
                            </div>
                            <Br>
                            <div id="wrap_sch_code_register1">
                            <?if($o_idx){
                                $sql = "select * from member_t where idx='".$ot['idx']."'";
                                $user = $DB->fetch_query($sql);
                            ?>
                            <table cellpadding="0" cellspacing="0" class="wd-100">
                                <tr>
                                    <td class="jm_th1 py-3">환불 수단</td>
                                    <td class="jm_td1 py-2">환불계좌</td>
                                    <td class="jm_th1 py-3">환불 계좌</td>
                                    <td class="jm_td1 py-2"><?= $user['bk_acount_num']?></td>
                                </tr>
                                <tr>
                                    <td class="jm_th1 py-3">예금주</td>
                                    <td class="jm_td1 py-2"><?= $user['bk_uname']?></td>
                                    <td class="jm_th1 py-3">은행 이름</td>
                                    <td class="jm_td1 py-2">
                                        <? switch($user['bk_name']){
                                            case "W":
                                                echo "우리은행";
                                                break;
                                            case "N":
                                                echo "농협";
                                                break;
                                            case "B":
                                                echo "부산은행";
                                                break;  
                                        }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="jm_th1 py-3">환불 금액</td>
                                    <td class="jm_td1 py-2"><input id="o_refund_cost" name="o_refund_cost" type="text" value="<?= number_format($ot['o_refund_cost'])?>" numberOnly></td>
                                    <td class="jm_th1 py-3">환불 상태</td>
                                    <td class="jm_td1 py-2">
                                        <input name="o_refund_status" class="state_radio" type="radio" id="f1" value="1" <?php if($ot['o_refund_status']==1) echo "checked"?>>
                                        <label for="f1">환불요청</label>

                                        <input name="o_refund_status"  class="state_radio" type="radio" id="f2" value="2" <?php if($ot['o_refund_status']==2) echo "checked"?>>
                                        <label for="f2">환불완료</label>
                                    </td>
                                </tr>
                            </table>
                            <div style="text-align:center; margin-top : 10px;">
                            <input type="submit" class="btn btn btn-info" value="환불">
                            </div>
                            <? }?>
                            </div>
                            <script>
                                function chk_refund(od_idx){
                                    if($("input:radio[name=o_refund_status]:checked").length == 0){
                                        alert("환불 상태를입력해주세요.");
                                        return false;
                                    }else if($("#o_refund_cost").val() == ''){
                                        alert("환불 금액을입력해주세요.");
                                        return false;
                                    }
                                    if(confirm("해당 결제 건을 환불 처리하시곘습니까?")){
                                        return true;
                                    }
                                }

                                function sch_m_name(){
                                    var strcode = $("#m_name").val();
                                    if(strcode.length<1){
                                        alert('상품 명을 입력해주세요.');
                                        $("#m_name").focus();
                                    }else{
                                        var qstr = 'w=<?= $w ?>';
                                        qstr += '&strcode='+strcode;
                                        qstr += '&idx=<?= $idx ?>';
                                        qstr += '&<?= $qstr ?>';
                                        location.href = "./refund_form_overseas.php?"+qstr;
                                    }
                                }

                                function sch_o_info(o_idx){
                                    var strcode = $("#m_name").val();
                                    var qstr = 'w=<?= $w ?>';
                                    qstr += '&strcode='+strcode;
                                    qstr += '&o_idx='+o_idx;
                                    qstr += '&idx=<?= $idx ?>';
                                    qstr += '&<?= $qstr ?>';
                                    location.href = "./refund_form_overseas.php?"+qstr;
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
            location.href = "./refund_list_overseas.php?<?= $qstr ?>";
        }
    }
</script>
<?
include "./foot_inc.php";
?>
<?php
include("./head_inc.php");
if(!$_SESSION['mt_id']){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;

$chk_post_code="Y";

$idx = $_GET['idx'];
$ot_mode = 8;
$pg = $_GET['pg'];
$qstr = "pg=".$pg;

$sql = "select * from d_app_domestic_item where idx = '{$idx}' ";
$row = $DB->fetch_assoc($sql);

$sql = "select * from d_app_domestic where idx = '{$row['app_idx']}' ";
$dad = $DB->fetch_assoc($sql);
if($dad['img_mark']){ $img_mark_src = "./data/app_domestic/".$dad['img_mark']; }else{ $img_mark_src = "./images/noimg.png"; }

$sql = "select * from member_t where idx = '{$_SESSION['mt_idx']}' ";
$mta = $DB->fetch_assoc($sql);

$sql = "select idx,s_name from service_domestic where idx = '{$row['cate_s']}' ";
$sdb = $DB->fetch_assoc($sql);

$sql = "select * from cate_ps1 where ct_id = '{$row['cate_ps2']}' ";
$cp1 = $DB->fetch_assoc($sql);

$merchant_uid = "ORD".$_SESSION['mt_idx'].date("Ymdhis")."-".randomcode2(10);

// 추가상품 가산 수수료
$vat1_pr_add = $row['vat1_pr_add'];
// 추가상품 VAT
$vat2_pr_add = $row['vat2_pr_add'];
// 닥터마크 수수료
$vat4_pr_add = $row['vat4_pr_add'];
// 추가상품 총 가산 수수료
$vat3_pr_add = $row['vat3_pr_add'];

// 서비스별 금액
$price_sdb1 = 0;
// 서비스별 수수료
$price_sdb2 = 0;
if($sdb['idx']==1 || $sdb['idx']==3){
    $price_sdb1 = 40000;
    $price_sdb2 = 4000;
}else if($sdb['idx']==2 || $sdb['idx']==4){
    $price_sdb1 = 150000;
    $price_sdb2 = 15000;
}

$price_audit = $row['vat1_pr_add'];
$price_audit_result = $row['vat3_pr_add'];

$sum_price = $price_sdb1+$price_sdb2+$vat3_pr_add;
$ot_name = "특허청 등록 결제";

?>
<div class="sub_pg my_pg report">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
                <!-- w-30 시작 / 마이페이지 -->
                <?
                $idx_lm1 = 2;
                $idx_lm2 = 1;
                $idx_lm3 = 2;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->

                <!-- w-65 시작-->
                <form method="post" enctype="multipart/form-data" id="form1" class="w-65 " action="./applied_trademark_enrollment_payment_update.php">
                    <input type="hidden" name="app_idx" value="<?= $dad['idx'] ?>">
                    <input type="hidden" name="app_item_idx" value="<?= $idx ?>">
                    <input type="hidden" name="pg" value="<?= $pg ?>">
                    <input type="hidden" name="ot_mode" value="<?= $ot_mode ?>">
                    <input type="hidden" name="sale_price_point" id="sale_price_point">
                    <input type="hidden" name="sale_price_sum" id="sale_price_sum">
                    <input type="hidden" name="sum_price" id="sum_price" value="<?= $sum_price ?>">
                    <input type="hidden" name="pay_price" id="pay_price" value="<?= $sum_price ?>">
                    <input type="hidden" name="price_sdb1" id="price_sdb1" value="<?= $price_sdb1 ?>">
                    <input type="hidden" name="price_sdb2" id="price_sdb2" value="<?= $price_sdb2 ?>">
                    <input type="hidden" name="price_period1" id="price_period1" value="0">
                    <input type="hidden" name="price_period2" id="price_period2" value="0">

                    <div class="w-100">
                        <div class="report_top">
                            <h2 class="sub_tit">등록료 납부</h2>

                            <div class="bg-wh rounded-lg border_bold p_30 d-block d-sm-flex mb_25">
                                <div class="brand_img" style="background-image: url('<?= $img_mark_src ?>')"></div>
                                <div class="d-block d-md-flex justify-content-between align-items-center brand_cont flex-wrap">
                                    <div class="row col-12 m-0">
                                        <div class="col-12 col-md-6 w_140_md">
                                            <div>
                                                <div class="d-flex align-items-center mb_8">
                                                    <p class="fc_gr222 fw_500 w_140">출원번호</p>
                                                    <p class="fs_15"><?= $row['code_register1'] ?></p>
                                                </div>
                                                <div class="d-flex align-items-center mb_8">
                                                    <p class="fc_gr222 fw_500 w_140">출원날짜</p>
                                                    <p class="fs_15"><?= $dad['dt_complete'] ?></p>
                                                </div>
                                                <div class="d-flex align-items-center mb_8">
                                                    <p class="fc_gr222 fw_500 w_140">출원인</p>
                                                    <p class="fs_15"><?= $dad['applicant_name_k'] ?><? if($dad['applicant_name_e']){ echo " (".$dad['applicant_name_e'].")"; } ?></p>
                                                </div>
                                                <div class="d-flex align-items-start mb_8">
                                                    <p class="fc_gr222 fw_500 w_140">심사결과 예정일</p>
                                                    <p class="fs_15"><?= $row['dt_result'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 w_140_md">
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">출원 타입</p>
                                                <p class="fs_15"><?= $sdb['s_name'] ?></p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">상표 유형</p>
                                                <p class="fs_15">
                                                    <?
                                                    if($dad['cate_mark']==1){ echo "문자 상표"; }
                                                    else if($dad['cate_mark']==2){ echo "도형 상표"; }
                                                    else if($dad['cate_mark']==3){ echo "복합 상표"; }
                                                    else if($dad['cate_mark']==4){ echo "기타"; }
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">상표명</p>
                                                <p class="fs_15"><?= $dad['name_mark'] ?></p>
                                            </div>
                                            <div class="d-flex mb_8">
                                                <p class="fc_gr222 fw_500 w_100">상품류</p>
                                                <p class="fs_15">제<?= $cp1['ct_catenum'] ?>류</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fee_division">
                            <!-- fd_left 시작-->
                            <div class="fd_left">
                                <h3 class="sub_tit2 fc_gr222">특허청 등록 결제 정보</h3>
                                <div class="ip_wr">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>존속기간 선택</h5>
                                    </div>
                                    <div class=" input-group">
                                        <select class="custom-select" id="period" name="period">
                                            <option value="">기간 선택</option>
                                            <option value="10">10년</option>
                                            <option value="5">5년</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ip_wr pb_15 br_bottom">
                                    <div class="ip_tit d-flex align-items-center d-flex mb-3">
                                        <h5>존속기간</h5>
                                    </div>
                                    <input type="hidden" name="dt_register_complete" id="dt_register_complete">
                                    <p class="fs_15" id="p_dt_register_complete">-</p>
                                </div>
                                <ul class="mb_50">
                                    <li class="d-flex align-items-center justify-content-between mb_5">
                                        <div class="d-flex align-items-center mr-3">
                                            <p class="fw_500 fc_gr222 mr-2 p-period2">등록 관납료</p>
                                        </div>
                                        <p class="p-price_period1">0원</p>
                                    </li>

                                    <li class="d-flex align-items-center justify-content-between mb_5">
                                        <div class="d-flex align-items-center mr-3">
                                            <p class="fw_500 fc_gr222 mr-2">지정상품 가산금 <span class="fs_14 fc_gr999">(총 <?= $row['cnt_pr_add'] ?>개 초과)</span></p>
                                        </div>
                                        <p><?= number_format($vat2_pr_add+$vat4_pr_add) ?>원</p>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb_5">
                                        <div class="d-flex align-items-center mr-3">
                                            <p class="fw_500 fc_gr222 mr-2">
                                                지정상품 관납료 <span class="fs_14 fc_gr999 p-period"></span>  <span class="fs_14 fc_gr999">(총 <?= $row['cnt_pr_add'] ?>개 초과)</span>
                                            </p>
                                        </div>
                                        <p class="p-price_period2">0원</p>
                                    </li>


                                    <li class="d-flex align-items-center justify-content-between mb_5">
                                        <div class="d-flex align-items-center mr-3">
                                            <p class="fw_500 fc_gr222 mr-2">닥터마크 수수료(<?= $sdb['s_name'] ?>)</p>
                                        </div>
                                        <p class="p-price_sdb1"><?= number_format($price_sdb1) ?>원</p>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between mb_5">
                                        <div class="d-flex align-items-center mr-3">
                                            <p class="fw_500 fc_gr222 mr-2">닥터마크 수수료 VAT</p>
                                        </div>
                                        <p class="p-price_sdb1"><?= number_format($price_sdb2) ?>원</p>
                                    </li>


                                    <li class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center mr-3">
                                            <p class="fw_500 fc_gr222 mr-2">총 결제금액</p>
                                        </div>
                                        <p class="p-sum_price"><?= number_format($sum_price) ?>원</p>
                                    </li>
                                </ul>

                                <div class="border_bk mb_50"></div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <h3 class="sub_tit2 fc_gr222">상표 등록증<br>수령 주소 정보</h3>
                                    <div class="checks ml-3">
                                        <input type="checkbox" name="chk_same_mt" id="chk_same_mt">
                                        <label for="chk_same_mt">담당자 정보와 동일</label>
                                    </div>
                                </div>

                                <div class="ip_wr">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>수령인 명 <span class="fc_primary">*</span></h5>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" name="regit_mt_name" id="regit_mt_name" class="form-control" placeholder="'-'없이 번호를 입력하세요">
                                    </div>
                                </div>

                                <div class="ip_wr">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>등록증 수령 주소 <span class="fc_primary">*</span></h5>
                                    </div>
                                    <div class="input-group mb_8">
                                        <input type="text" name="regit_mt_addr1" id="regit_mt_addr1" class="form-control" placeholder="우편번호">
                                        <div class="input-group-append">
                                            <button class="btn btn-secondary btn-md btn_sch_addr" type="button" onclick="execDaumPostcode5()">주소찾기</button>
                                        </div>
                                    </div>
                                    <input type="text" name="regit_mt_addr2" id="regit_mt_addr2" class="form-control mb_8" placeholder="도로명/ 지번 주소">
                                    <input type="text" name="regit_mt_addr3" id="regit_mt_addr3" class="form-control" placeholder="상세주소 입력">
                                </div>


                                <div class="ip_wr mb_50">
                                    <div class="ip_tit d-flex align-items-center d-flex mb-3">
                                        <h5>수령인 휴대 전화번호 <span class="fc_primary">*</span></h5>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" name="regit_mt_hp" id="regit_mt_hp" class="form-control" placeholder="'-'없이 번호를 입력하세요" onkeyup="nohypen_input('regit_mt_hp')">
                                    </div>
                                </div>



                                <div class="border_bk mb_50"></div>

                                <h3 class="sub_tit2 fc_gr222">결제 정보</h3>

                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>결제수단 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group mb_22">
                                    <div class="input-group-prepend">
                                        <div class="checks mb-2 mr-4 mr-sm-5">
                                            <input type="radio" name="regit_pay_method" id="regit_pay_method1">
                                            <label for="regit_pay_method1">무통장 입금</label>
                                        </div>
                                        <div class="checks mb-2 mr-4 mr-sm-5">
                                            <input type="radio" name="regit_pay_method" id="regit_pay_method2" checked>
                                            <label for="regit_pay_method2">신용카드</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- fd_left 끝-->

                            <!-- d_right 시작-->
                            <div class="fd_right">
                                <h3 class="sub_tit2 fc_gr222">결제금액</h3>
                                <div class="bg-wh rounded-lg p_25_20 mb_22">
                                    <ul class="payment_list">
                                        <li>
                                            <p class="fw_500 fc_gr222 mr-2 p-period2">등록 관납료</p>
                                            <p class="fw_500 p-price_period1">0원</p>
                                        </li>
                                        <li>
                                            <p class="fw_500 fc_gr222 mr-2">지정상품 가산금 <span class="fs_14 fc_gr999">(총 <?= $row['cnt_pr_add'] ?>개 초과)</span></p>
                                            <p class="fw_500"><?= number_format($vat2_pr_add+$vat4_pr_add) ?>원</p>
                                        </li>
                                        <li>
                                            <p class="fw_500 fc_gr222 mr-2">
                                                지정상품 관납료 <span class="fs_14 fc_gr999 p-period"></span>  <span class="fs_14 fc_gr999">(총 <?= $row['cnt_pr_add'] ?>개 초과)</span>
                                            </p>
                                            <p class="fw_500 p-price_period2">0원</p>
                                        </li>
                                        <li>
                                            <p class="fw_500 fc_gr222 mr-2">닥터마크 수수료 <span class="fs_14 fc_gr999">(<?= $sdb['s_name'] ?>)</span></p>
                                            <p class="fw_500"><?= number_format($price_sdb1) ?>원</p>
                                        </li>
                                        <li>
                                            <p class="fw_500 fc_gr222 mr-2">닥터마크 수수료 VAT</p>
                                            <p class="fw_500"><?= number_format($price_sdb2) ?>원</p>
                                        </li>
                                    </ul>
                                    <div class="border_bk mb_20"></div>
                                    <div class="payment">
                                        <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                        <p class="fs_24 fc_bdk fw_600 p-sum_price"><?= number_format($sum_price) ?>원</p>
                                    </div>
                                </div>

                                <div class="ip_wr">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>포인트 사용</h5>
                                    </div>
                                    <div class="input-group mb_10">
                                        <input type="text" class="form-control" name="ot_use_point" id="ot_use_point" placeholder="포인트 입력" onkeyup="use_point(this.value)" onkeypress="use_point(this.value)">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary btn-md" type="button" onclick="use_allpoint()">전체사용</button>
                                        </div>
                                    </div>
                                    <p class="fs_14">보유중인 포인트 : <?= number_format($mta['mt_point']) ?>원</p>
                                </div>

                                <div class="pay_fin mb_22">
                                    <div class="bg-wh rounded-lg p_25_20 br_primary">
                                        <ul class="payment_list">
                                            <li>
                                                <div class="d-flex align-items-center mr-3">
                                                    <p class="fw_500 fc_gr222 mr-2">주문금액</p>
                                                </div>
                                                <p class="fw_500"><?= number_format($sum_price) ?>원</p>
                                            </li>

                                            <!-- 포인트 사용 -->
                                            <li>
                                                <div class="d-flex align-items-center mr-3">
                                                    <p class="fw_500 fc_gr222 mr-2">포인트 할인금액</p>
                                                </div>
                                                <p class="fw_500" id="view_sale_price_point">-0원</p>
                                            </li>
                                            <!---------------------->

                                            <li>
                                                <div class="d-flex align-items-center mr-3">
                                                    <p class="fw_500 fc_gr222 mr-2">총 할인 금액</p>
                                                </div>
                                                <p class="fw_500" id="view_sale_price_sum">- 0원</p>
                                            </li>
                                        </ul>
                                        <div class="border_bk mb_20 bg_gre9"></div>
                                        <div class="payment">
                                            <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                            <p class="fs_24 fc_bdk fw_600" id="view_pay_price"><?= number_format($sum_price) ?>원</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary btn-md btn-block" onclick="pay()">결제하기</button>
                                </div>
                            </div>
                            <!-- d_right 끝-->
                        </div>

                    </div>
                </form>
                <!-- w-65 끝-->
                <!-- division 끝 / 서브페이지 영역 2분할 -->
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->

<script>
    var cnt_pr_add = Number('<?= $row['cnt_pr_add'] ?>');
    var sum_price = 0;
    var pay_price = 0;

    // 추가상품 가산 수수료
    var vat1_pr_add = Number('<?= $vat1_pr_add ?>');
    // 추가상품 VAT
    var vat2_pr_add = Number('<?= $vat2_pr_add ?>');
    // 닥터마크 수수료
    var vat4_pr_add = Number('<?= $vat4_pr_add ?>');
    // 추가상품 총 가산 수수료
    var vat3_pr_add = Number('<?= $vat3_pr_add ?>');

    // 서비스별 금액
    var price_sdb1 = Number('<?= $price_sdb1 ?>');
    // 서비스별 수수료
    var price_sdb2 = Number('<?= $price_sdb2 ?>');
    //  기간별 금액
    var price_period1 = 0;
    //  기간별 가산 관납료
    var price_period2 = 0;

    $("#period").on("change", function (){
        //  기간
        var period = $("#period").val();
        // 사용 포인트
        var ot_use_point = Number($("#ot_use_point").val());

        if(period!=""){
            const today = new Date();
            let dt_register_complete = dateFormat(today).substring(0,10);
            $.ajax({
                type: "POST",
                url: hostname + "/get_ajax.php",
                data: {
                    mode:'dt_add',
                    dtval:dt_register_complete,
                    dt_unit:"y",
                    add_val:period,
                },
                cache: false,
                success: function(data){
                    $("#dt_register_complete").val(dt_register_complete.replaceAll("-","."));
                    let arr1 = data.split("-");
                    $("#p_dt_register_complete").html(arr1[0]+"년 "+arr1[1]+"월 "+arr1[2]+"일 예정 ("+period+"년)");

                    if(period=='5'){ price_period1 = 141120; price_period2 = 1000*cnt_pr_add; }
                    else if(period=='10'){ price_period1 = 220120; price_period2 = 2000*cnt_pr_add; }

                    sum_price = price_period1+vat2_pr_add+vat4_pr_add+price_period2+price_sdb1+price_sdb2;
                    pay_price = sum_price-ot_use_point;

                    $(".p-period").html("("+period+"년)");
                    $(".p-period2").html(""+period+"년 연장");
                    $("#price_period1").val(price_period1);
                    $("#price_period2").val(price_period2);
                    $(".p-price_period1").html(addComma(price_period1)+"원");
                    $(".p-price_period2").html(addComma(price_period2)+"원");
                    $(".p-sum_price").html(addComma(sum_price)+"원");

                    $("#sale_price_point").val(ot_use_point);
                    $("#sale_price_sum").val(ot_use_point);
                    $("#view_sale_price_point").html(addComma(ot_use_point)+"원");
                    $("#view_sale_price_sum").html(addComma(ot_use_point)+"원");

                    $("#sum_price").val(sum_price);
                    $("#pay_price").val(pay_price);
                    $("#view_pay_price").html(addComma(pay_price)+"원");
                }
            });
        }
    });

    function use_point(){
        var ot_use_point = Number($("#ot_use_point").val());
        $("#sale_price_point").val(ot_use_point);
        $("#sale_price_sum").val(ot_use_point);
        $("#view_sale_price_point").html(addComma(ot_use_point)+"원");
        $("#view_sale_price_sum").html(addComma(ot_use_point)+"원");

        sum_price = price_period1+vat2_pr_add+vat4_pr_add+price_period2+price_sdb1+price_sdb2;
        pay_price = sum_price-ot_use_point;

        $("#sum_price").val(sum_price);
        $("#pay_price").val(pay_price);
        $("#view_pay_price").html(addComma(pay_price)+"원");
    }
    function use_allpoint(){
        var ot_use_point = Number('<?= $mta["mt_point"] ?>');
        $("#ot_use_point").val(ot_use_point);
        $("#sale_price_point").val(ot_use_point);
        $("#sale_price_sum").val(ot_use_point);
        $("#view_sale_price_point").html(addComma(ot_use_point)+"원");
        $("#view_sale_price_sum").html(addComma(ot_use_point)+"원");

        sum_price = price_period1+vat2_pr_add+vat4_pr_add+price_period2+price_sdb1+price_sdb2;
        pay_price = sum_price-ot_use_point;

        $("#sum_price").val(sum_price);
        $("#pay_price").val(pay_price);
        $("#view_pay_price").html(addComma(pay_price)+"원");
    }

    function pay(){
        var period = Number($("#period").val());
        var regit_mt_name = $("#regit_mt_name").val();
        var regit_mt_addr1 = $("#regit_mt_addr1").val();
        var regit_mt_addr2 = $("#regit_mt_addr2").val();
        var regit_mt_addr3 = $("#regit_mt_addr3").val();
        var regit_mt_hp = $("#regit_mt_hp").val();
        var regit_pay_method = $("#regit_pay_method:checked").val();
        var sale_price_point = Number($("#sale_price_point").val());
        var sale_price_sum = Number($("#sale_price_sum").val());

        if(period<5){
            alert("존속기간을 선택해주세요.");
            $("#period").focus();
        }else if(regit_mt_name==""){
            alert("수령인 명을 입력해주세요.");
            $("#regit_mt_name").focus();
        }else if(regit_mt_addr1=="" || regit_mt_addr2=="" || regit_mt_addr3==""){
            alert("등록증 수령 주소를 입력해주세요.");
            $("#regit_mt_addr1").focus();
        }else if(regit_mt_hp==""){
            alert("수령인 휴대 전화번호를 입력해주세요.");
            $("#regit_mt_hp").focus();
        }else if(pay_price<0){
            alert("결제 금액이 0보다 작을 수 없습니다.");
        }else{
            var ot_name = '<?= $ot_name ?>'+' ('+period+'년)';
            pay_inicis(ot_name,'<?= $ot_mode ?>','<?= $merchant_uid ?>',regit_pay_method,'<?= $dad['idx'] ?>','<?= $idx ?>','<?= $mta['idx'] ?>','<?= $mta['mt_email'] ?>','<?= $mta['mt_name'] ?>','<?= $mta['mt_hp'] ?>',sum_price,0,0,sale_price_point);
        }
    }

    $("#chk_same_mt").on("click",function (){
        if($(this).is(":checked")==true){
            var regit_mt_name = "<?= $dad['mt_name'] ?>";
            var regit_mt_hp = "<?= $dad['mt_hp'] ?>";
            $("#regit_mt_name").val(regit_mt_name);
            $("#regit_mt_hp").val(regit_mt_hp);
        }else{
            $("#regit_mt_name").val("");
            $("#regit_mt_hp").val("");
        }
    });

    var hd_height = $("#hd").height(); //헤더의 높이를 구합니다.
    $(document).scroll(function() { //페이지내에서 스크롤이 시작되면
        curSc = $(document).scrollTop() + $(window).height(); //현재 스크롤의 위치입니다.
        body_height = $("body").height(); //body의 높이를 구합니다.
        footer_height = $(".ft").height(); // 푸터의 높이를 구합니다.
        bottom_top = body_height - footer_height; //푸터를 제외한 body의 길이를 구합니다.
        if (window.innerWidth > 1560) {

            if (curSc > bottom_top + 20) { // 현재 스크롤의 높이가 body_top 보다 크다면 (하단 영역에 도착했다면)  *20 은 적당히 조절해주시면 됩니다.
                $(".my_page").css('top', 'auto'); //fixed top 성질을 없애고
                $(".my_page").css('bottom', curSc - bottom_top + 150); //fixed bottom 을 줍니다.
            } else {
                $(".my_page").css('top', hd_height + 60); // 그렇지않으면 상단에 고정되게 합니다.
            }
        }
        resize();
    })
</script>
<?php
include "./foot_inc.php";
?>

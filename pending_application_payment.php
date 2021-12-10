<?php
include("./head_inc.php");
if(!$_SESSION['mt_id']){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;

$idx = $_GET['idx'];
$ot_mode = $_GET['ot_mode'];
$pg = $_GET['pg'];
$qstr = "pg=".$pg;

$sql = "select * from d_app_domestic_item where idx = '{$idx}' ";
$row = $DB->fetch_assoc($sql);

$sql = "select * from d_app_domestic where idx = '{$row['app_idx']}' ";
$dad = $DB->fetch_assoc($sql);
if($dad['img_mark']){ $img_mark_src = "./data/app_domestic/".$dad['img_mark']; }else{ $img_mark_src = "./images/noimg.png"; }

$sql = "select * from member_t where idx = '{$_SESSION['mt_idx']}' ";
$mta = $DB->fetch_assoc($sql);

$sql = "select s_name from service_domestic where idx = '{$row['cate_s']}' ";
$sdb = $DB->fetch_assoc($sql);

$sql = "select * from cate_ps1 where ct_id = '{$row['cate_ps2']}' ";
$cp1 = $DB->fetch_assoc($sql);

$merchant_uid = "ORD".$_SESSION['mt_idx'].date("Ymdhis")."-".randomcode2(10);

if($ot_mode==5){
    $price_audit = $row['price_audit'];
    $price_audit_result = $price_audit+($price_audit*0.1);
    $sum_price = $price_audit_result;
    $ot_name = "심사 대응 수수료";
}else if($ot_mode==6){
    $price_audit = $row['price_referee3'];
    $price_audit_result = $price_audit+($price_audit*0.1);
    $sum_price = $price_audit_result;
    $ot_name = "심사 대응 수수료";
}else if($ot_mode==7){
    $price_audit = $row['price_referee4'];
    $price_audit_result = $price_audit+($price_audit*0.1);
    $sum_price = $price_audit_result;
    $ot_name = "심사 대응 수수료";
}else if($ot_mode==8){
    $price_audit = $row['vat1_pr_add'];
    $price_audit_result = $row['vat3_pr_add'];
    $sum_price = $price_audit_result;
    $ot_name = "상표 등록료";
}
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
                <div class="w-65">
                    <div class="report_top">
                        <h2 class="sub_tit">결제하기</h2>

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
                        <form method="post" enctype="multipart/form-data" id="form1" class="wd-100 fee_division" action="./pending_application_payment_update.php">
                            <input type="hidden" name="app_idx" value="<?= $dad['idx'] ?>">
                            <input type="hidden" name="app_item_idx" value="<?= $idx ?>">
                            <input type="hidden" name="d_status" value="<?= $row['d_status'] ?>">
                            <input type="hidden" name="pg" value="<?= $pg ?>">
                            <div class="fd_left">
                                <h3 class="sub_tit2 fc_gr222">결제 정보</h3>

                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>결제수단 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group mb_22">
                                    <div class="input-group-prepend">
                                        <div class="checks mb-2 mr-3 mr-sm-5">
                                            <input type="radio" name="pay_method" id="pay_method1" value="vbank">
                                            <label for="pay_method1">무통장 입금</label>
                                        </div>
                                        <div class="checks mb-2 mr-3 mr-sm-5">
                                            <input type="radio" name="pay_method" id="pay_method2" value="card" checked>
                                            <label for="pay_method2">신용카드</label>
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
                                            <p class="fw_500 fc_gr222 mr-2"><?= $ot_name ?></p>
                                            <p class="fw_500"><?= number_format($sum_price) ?>원</p>
                                        </li>
                                    </ul>
                                    <div class="border_bk mb_20"></div>
                                    <div class="payment">
                                        <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                        <p class="fs_24 fc_bdk fw_600"><?= number_format($sum_price) ?>원</p>
                                    </div>
                                </div>

                                <div class="ip_wr">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>포인트 사용</h5>
                                    </div>
                                    <div class="input-group mb_10">
                                        <input type="text" class="form-control" name="ot_use_point" id="ot_use_point" placeholder="포인트 입력" onkeyup="use_point_domestic2(this.value)" onkeypress="use_point_domestic2(this.value)">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary btn-md" type="button" onclick="use_allpoint_domestic2()">전체사용</button>
                                        </div>
                                    </div>
                                    <p class="fs_14">보유중인 포인트 : <?= number_format($mta['mt_point']) ?>원</p>
                                </div>

                                <div class="ip_wr" style="<? if($ot_mode==8){echo 'display: none;';} ?>">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>할인코드</h5>
                                    </div>
                                    <div class="input-group mb_10">
                                        <input type="text" class="form-control" name="code_sale" id="code_sale" placeholder="할인코드 입력">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary btn-md" type="button" onclick="use_salecode_domestic()">등록하기</button>
                                        </div>
                                    </div>
                                    <p class="fs_14">사용할 추천인 코드는 한번만 사용이 가능하며, 등록시에 결제금액의 5% 할인을 받습니다.</p>
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

                                            <!-- 할인 코드 사용 -->
                                            <li style="<? if($ot_mode==8){echo 'display: none;';} ?>">
                                                <div class="d-flex align-items-center mr-3">
                                                    <p class="fw_500 fc_gr222 mr-2" id="txt_sale_price_salecode">할인코드 차감 (0%)</p>
                                                </div>
                                                <input type="hidden" name="sale_price_salecode" id="sale_price_salecode">
                                                <p class="fw_500" id="view_sale_price_salecode">- 0원</p>
                                            </li>
                                            <!---------------------->

                                            <!-- 포인트 사용 -->
                                            <li>
                                                <div class="d-flex align-items-center mr-3">
                                                    <p class="fw_500 fc_gr222 mr-2">포인트 할인금액</p>
                                                </div>
                                                <input type="hidden" name="sale_price_point" id="sale_price_point">
                                                <p class="fw_500" id="view_sale_price_point">-0원</p>
                                            </li>
                                            <!---------------------->

                                            <li>
                                                <div class="d-flex align-items-center mr-3">
                                                    <p class="fw_500 fc_gr222 mr-2">총 할인 금액</p>
                                                </div>
                                                <input type="hidden" name="sale_price_sum" id="sale_price_sum">
                                                <p class="fw_500" id="view_sale_price_sum">- 0원</p>
                                            </li>
                                        </ul>
                                        <div class="border_bk mb_20 bg_gre9"></div>
                                        <div class="payment">
                                            <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                            <input type="hidden" name="sum_price" id="sum_price" value="<?= $sum_price ?>">
                                            <input type="hidden" name="pay_price" id="pay_price" value="<?= $sum_price ?>">
                                            <p class="fs_24 fc_bdk fw_600" id="view_pay_price"><?= number_format($sum_price) ?>원</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary btn-md btn-block" onclick="pay()">결제하기</button>
                                </div>
                            </div>
                        </form>
                        <!-- d_right 끝-->
                    </div>





                </div>
                <!-- w-65 끝-->
                <!-- division 끝 / 서브페이지 영역 2분할 -->
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->

<script>
    function use_salecode_domestic(){
        var code_sale = $("#code_sale").val();
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'chk_salecode',
                code_sale:code_sale,
            },
            cache: false,
            success: function(data){
                console.log(data)
                if(Number(data)==1){
                    alert("작성하신 할인 코드와 일치하는 할인 코드를 찾지 못했습니다.");
                    $("#code_sale").focus();
                }else if(Number(data)==2){
                    alert("작성하신 할인 코드는 사용 가능 횟수가 0이므로 사용이 불가능합니다.");
                    $("#code_sale").focus();
                }else if(Number(data)==3){
                    alert("할인 코드 사용 가능 기간 이전입니다.");
                    $("#code_sale").focus();
                }else if(Number(data)==4){
                    alert("할인 코드 사용 가능 기간이 지났습니다.");
                    $("#code_sale").focus();
                }else if(Number(data)==5){
                    alert("작성하신 할인 코드는 이미 사용하신 코드입니다.");
                    $("#code_sale").focus();
                }else if(Number(data)>0){
                    const per_sale = Number(data);
                    const num_sale = Number(data)/100;

                    var sum_price = $("#sum_price").val();
                    var sale_price_mtcode = 0;
                    var sale_price_salecode = Number(sum_price) * num_sale;
                    sale_price_salecode = Math.round(sale_price_salecode);
                    var sale_price_point = $("#sale_price_point").val();
                    var sale_price_sum = Number(sale_price_mtcode)+Number(sale_price_salecode)+Number(sale_price_point);;
                    var pay_price = Number(sum_price)-Number(sale_price_sum);

                    $("#sale_price_mtcode").val(sale_price_mtcode);
                    $("#view_sale_price_mtcode").html("- "+addComma(sale_price_mtcode)+"원");

                    $("#sale_price_salecode").val(sale_price_salecode);
                    $("#txt_sale_price_salecode").html("할인코드 차감 ("+per_sale+"%)");
                    $("#view_sale_price_salecode").html("- "+addComma(sale_price_salecode)+"원");

                    $("#sale_price_sum").val(sale_price_sum);
                    $("#view_sale_price_sum").html("- "+addComma(sale_price_sum)+"원");

                    $("#pay_price").val(pay_price);
                    $("#view_pay_price").html(addComma(pay_price)+"원");
                }
            }
        });
    }

    function pay(){
        var pay_method = $("#pay_method:checked").val();
        var sum_price = Number($("#sum_price").val());
        var sale_price_salecode = Number($("#sale_price_salecode").val());
        var sale_price_point = Number($("#sale_price_point").val());
        pay_inicis('<?= $ot_name ?>','<?= $ot_mode ?>','<?= $merchant_uid ?>',pay_method,'<?= $dad['idx'] ?>','<?= $idx ?>','<?= $mta['idx'] ?>','<?= $mta['mt_email'] ?>','<?= $mta['mt_name'] ?>','<?= $mta['mt_hp'] ?>',sum_price,0,sale_price_salecode,sale_price_point)
    }

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

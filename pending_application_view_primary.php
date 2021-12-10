<?php
include("./head_inc.php");
if(!$_SESSION['mt_id']){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;

$pg = $_GET['pg'];
$idx = $_GET['idx'];
$qstr = "pg=".$pg;
$sql = "select * from d_app_domestic where idx = '{$idx}' ";
$row = $DB->fetch_assoc($sql);
if($row['img_mark']){ $img_mark_src = "./data/app_domestic/".$row['img_mark']; }else{ $img_mark_src = "./images/noimg.png"; }

$sql = "select dadi.cate_ps2, dadi.cate_s, cp1.ct_catenum, cp1.ct_name from d_app_domestic_item dadi left join cate_ps1 cp1 on dadi.cate_ps2 = cp1.ct_id where dadi.app_idx = '{$idx}' order by cp1.ct_catenum ";
$dadi_list = $DB->select_query($sql);

$sql = "select * from member_t where idx = '{$_SESSION['mt_idx']}' ";
$mta = $DB->fetch_assoc($sql);

$merchant_uid = "ORD".$_SESSION['mt_idx'].date("Ymd")."-".randomcode2(10);

$sql = "select * from d_price_service where txt_cate = 'mod_ver2' ";
$dps2 = $DB->fetch_assoc($sql);
$sql = "select * from d_price_service where txt_cate = 'mod_ver3' ";
$dps3 = $DB->fetch_assoc($sql);
?>
<div class="sub_pg my_pg report">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
                <!-- w-30 시작 / 마이페이지 -->
                <?
                $idx_lm1 = 2;
                $idx_lm2 = 1;
                $idx_lm3 = 1;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->

                <!-- w-65 시작-->
                <div class="w-65">
                    <div class="report_top">
                        <h2 class="sub_tit">출원준비중인 상표</h2>

                        <div class="bg-wh rounded-lg border_bold p_30 d-block d-sm-flex mb_25">
                            <div class="brand_img" style="background-image: url('<?= $img_mark_src ?>')"></div>
                            <div class="d-block d-md-flex justify-content-between align-items-center brand_cont flex-wrap">
                                <div class="row col-12 m-0">
                                    <div class="col-12 col-md-6">
                                        <div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">신청 번호</p>
                                                <p class="fs_15"><?= $row['code1'] ?></p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">신청 날짜</p>
                                                <p class="fs_15">2021.09.03</p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">출원인</p>
                                                <p class="fs_15">
                                                    <?= $row['applicant_name_k'] ?>
                                                    <? if($row['applicant_name_e']){ echo " (".$row['applicant_name_e'].")"; } ?>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">출원완료일</p>
                                                <p class="fs_15"><? if($row['dt_complete']){ echo $row['dt_complete']; }else{{ echo "-"; }} ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center mb_8">
                                            <p class="fc_gr222 fw_500 w_100">상표 유형</p>
                                            <p class="fs_15">
                                                <?
                                                if($row['cate_mark']==1){ echo "문자 상표"; }
                                                else if($row['cate_mark']==2){ echo "도형 상표"; }
                                                else if($row['cate_mark']==3){ echo "복합 상표"; }
                                                else if($row['cate_mark']==4){ echo "기타"; }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="d-flex align-items-center mb_8">
                                            <p class="fc_gr222 fw_500 w_100">상표명</p>
                                            <p class="fs_15"><?= $row['name_mark'] ?></p>
                                        </div>
                                        <div class="d-flex mb_8">
                                            <p class="fc_gr222 fw_500 w_100">상품류</p>
                                            <div class="detail_text_wrap">
                                                <p class="detail_text">
                                                    <span>
                                                        <?
                                                        $txt_cate_num = "";
                                                        foreach ($dadi_list as $dadi){
                                                            $txt_cate_num .= "제".$dadi['ct_catenum']."류, ";
                                                        }
                                                        $txt_cate_num = substr($txt_cate_num,0,-2);
                                                        echo $txt_cate_num;
                                                        ?>
                                                    </span>
                                                </p>
                                                <? if(strlen($txt_cate_num)>41){ ?>
                                                <span class="text_more fc_primary p-0 fs_15 fw_400 text-underline">더보기</span>
                                                <? } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?
                    if($row['app_status']>1){
                        ?>
                        <!-- 진행 상황 시작 -->
                        <form id="form1" action="./pending_application_view_update.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="app_idx" value="<?= $row['idx'] ?>">
                            <input type="hidden" name="pg" value="<?= $_GET['pg'] ?>">
                            <input type="hidden" name="app_status" value="<?= $row['app_status'] ?>">
                            <div class="application_process mb_50">
                                <h3 class="sub_tit2">진행 상황</h3>

                                <p class="fs_17 fc_gr222 fw_500 mb_10">
                                    <?
                                    if($row['app_status']<6){ echo '출원 준비'; }
                                    else if($row['app_status']==6){ echo '출원완료'; }
                                    else if($row['app_status']==7){ echo '출원취소'; }
                                    else if($row['app_status']==8){ echo '출원대기'; }
                                    ?>
                                    <?
                                    if($row['app_status']==2){
                                        echo '&nbsp;<span class="fc_primary">1차 수정요청</span>';
                                    }else if($row['app_status']==3){
                                        echo '&nbsp;<span class="fc_primary">2차 수정요청</span>';
                                    }else if($row['app_status']==4){
                                        echo '&nbsp;<span class="fc_primary">3차 수정요청 검토중</span>';
                                    }else if($row['app_status']==5){
                                        echo '&nbsp;<span class="fc_primary">3차 수정요청 검토중</span>';
                                    }
                                    ?>
                                </p>

                                <?
                                if($row['app_status']<5){
                                ?>
                                <div class="bg-wh border rounded p_20 mb_22">
                                    <p class="wh_pre fs_15 fc_gr444">출원하실 상표에 상품류가 20개를 초가하여 추가 금액을 결제하셔야합니다.
                                        결제와 동시에 출원보고서에 수정사항이 있을 시 하단 입력란에 작성해주세요.
                                        없을 시 ‘수정사항이 없습니다’ 를 선택하고 결제 및 동의 버튼을 눌러주세요.
                                    </p>
                                </div>
                                <?
                                }
                                ?>

                                <? if($row['app_status']==2 && $row['report_ver1']!=""){ ?>
                                    <div class="d-flex justify-content-center mb_22">
                                        <a href="./data/app_domestic/<?= $row['report_ver1'] ?>" download="<?= $row['report_ver1_origin'] ?>">
                                            <button type="button" class="btn btn-primary btn-md btn_style03">보고서 저장</button>
                                        </a>
                                    </div>
                                <? } ?>
                                <? if($row['app_status']==3 && $row['report_ver2']!=""){ ?>
                                    <div class="d-flex justify-content-center mb_22">
                                        <a href="./data/app_domestic/<?= $row['report_ver2'] ?>" download="<?= $row['report_ver2_origin'] ?>">
                                            <button type="button" class="btn btn-primary btn-md btn_style03">보고서 저장</button>
                                        </a>
                                    </div>
                                <? } ?>

                                <?
                                if($row['app_status']<5){
                                ?>
                                <div class="ip_wr">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>출원보고서 수정사항</h5>
                                    </div>
                                    <?
                                    if($row['app_status']==2){
                                        ?>
                                        <div class="input-group">
                                            <textarea class="form-control" name="txt_mod_ver1" id="txt_mod_ver1" placeholder="출원보고서 수정할 내용을 입력하세요" rows="5"><?= strip_tags($row['txt_mod_ver1']) ?></textarea>
                                        </div>
                                        <div class="checks mt_10">
                                            <input type="checkbox" name="non_txt_mod_ver1" id="non_txt_mod_ver1" value="Y">
                                            <label for="non_txt_mod_ver1">수정사항이 없습니다.</label>
                                        </div>
                                        <script>
                                            $("#non_txt_mod_ver1").on("click", function (){
                                                if($(this).is(":checked")==true){
                                                    $("#txt_mod_ver1").val("");
                                                    $("#txt_mod_ver1").attr("disabled",true);
                                                }else{
                                                    $("#txt_mod_ver1").attr("disabled",false);
                                                }
                                            });
                                        </script>
                                        <?
                                    }else if($row['app_status']==3){
                                        ?>
                                        <div class="input-group">
                                            <textarea class="form-control" name="txt_mod_ver2" id="txt_mod_ver2" placeholder="출원보고서 수정할 내용을 입력하세요" rows="5"><?= strip_tags($row['txt_mod_ver2']) ?></textarea>
                                        </div>
                                        <div class="checks mt_10">
                                            <input type="checkbox" name="non_txt_mod_ver2" id="non_txt_mod_ver2" value="Y">
                                            <label for="non_txt_mod_ver2">수정사항이 없습니다.</label>
                                        </div>
                                        <script>
                                            $("#non_txt_mod_ver2").on("click", function (){
                                                if($(this).is(":checked")==true){
                                                    //$("#wrap_paymethod").hide();
                                                    $("#txt_mod_ver2").val("");
                                                    $("#txt_mod_ver2").attr("disabled",true);
                                                    $(".d-show-payprice").html(addComma(0)+"원");
                                                }else{
                                                    //$("#wrap_paymethod").show();
                                                    $("#txt_mod_ver2").attr("disabled",false);
                                                }
                                            })
                                        </script>
                                        <?
                                    }else if($row['app_status']==4){
                                        ?>
                                        <div class="input-group">
                                            <textarea class="form-control" name="txt_mod_ver3" id="txt_mod_ver3" placeholder="출원보고서 수정할 내용을 입력하세요" rows="5"><?= strip_tags($row['txt_mod_ver3']) ?></textarea>
                                        </div>
                                        <div class="checks mt_10">
                                            <input type="checkbox" name="non_txt_mod_ver3" id="non_txt_mod_ver3" value="Y">
                                            <label for="non_txt_mod_ver3">수정사항이 없습니다.</label>
                                        </div>
                                        <script>
                                            $("#non_txt_mod_ver3").on("click", function (){
                                                if($(this).is(":checked")==true){
                                                    $("#wrap_paymethod").hide();
                                                    $("#txt_mod_ver3").val("");
                                                    $("#txt_mod_ver3").attr("disabled",true);
                                                    $(".d-show-payprice").html(addComma(0)+"원");
                                                }else{
                                                    $("#wrap_paymethod").show();
                                                    $("#txt_mod_ver3").attr("disabled",false);
                                                }
                                            });
                                        </script>
                                        <?
                                    }
                                    ?>

                                </div>
                                <?
                                }
                                ?>

                                <? if($row['app_status']<5){ ?>
                                    <? if($row['app_status']==3){ ?>
                                        <h3 class="sub_tit2 mt_50">결제금액</h3>
                                        <div class="bg-wh rounded-lg p_25_20 mb_22 border">
                                            <ul class="payment_list">
                                                <li class="d-show-ele1">
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <p class="fw_500 fc_gr222 mr-2">2차 수정 요청 금액</p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class=" border_bk mb_20"></div>
                                            <div class="payment">
                                                <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                                <p class="fs_24 fc_bdk fw_600 d-show-payprice">
                                                    <? echo number_format(0)."원"; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <? }else if($row['app_status']==4){ ?>
                                        <h3 class="sub_tit2 mt_50">결제금액</h3>
                                        <div class="bg-wh rounded-lg p_25_20 mb_22 border">
                                            <ul class="payment_list">
                                                <li class="d-show-ele1">
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <p class="fw_500 fc_gr222 mr-2">3차 수정 요청 금액</p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class=" border_bk mb_20"></div>
                                            <div class="payment">
                                                <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                                <p class="fs_24 fc_bdk fw_600 d-show-payprice">
                                                    <? echo number_format(0)."원"; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <? }else if($row['app_status']==2){ ?>
                                        <h3 class="sub_tit2 mt_50">결제금액</h3>
                                        <div class="bg-wh rounded-lg p_25_20 mb_22 border">
                                            <ul class="payment_list">
                                                <li>
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <p class="fw_500 fc_gr222 mr-2">지정 상품</p>
                                                        <p class="fc_grccc mr-2">X <?= $row['cnt_pr_designated'] ?></p>
                                                        <p class="fc_grccc"><? if($row['pr_designated']){ echo "( ".strip_tags($row['pr_designated'])." )"; } ?></p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class=" border_bk mb_20"></div>
                                            <div class="payment">
                                                <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                                <p class="fs_24 fc_bdk fw_600 d-show-payprice">
                                                    <? echo number_format($row['price_pr_add1'])."원"; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <? } ?>

                                <? } ?>

                                <!--
                                <div class="bg-wh rounded-lg p_25_20 border" id="wrap_paymethod">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>결제수단 <span class="fc_primary">*</span></h5>
                                    </div>
                                    <div class="input-group mb_22">
                                        <div class="input-group-prepend">
                                            <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                                <input type="radio" name="pay_method" id="pay_method1" checked value="vbank">
                                                <label for="pay_method1">무통장 입금</label>
                                            </div>
                                            <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                                <input type="radio" name="pay_method" id="pay_method2" value="card">
                                                <label for="pay_method2">신용카드</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->


                                <?
                                if($row['app_status']<5){
                                    if($row['app_status']<6 || $row['app_status']==8){
                                        echo '<div class="d-flex justify-content-center">';
                                        echo '<button type="button" class="btn btn-primary btn-md btn_style03" onclick="pay()">결제 및 동의</button>';
                                        echo '</div>';
                                    }
                                }
                                ?>


                            </div>

                            <script>
                                $(function (){
                                    //$("#wrap_paymethod").hide();
                                });
                                function pay(){
                                    var strval_pay_method = 'card';
                                    var app_status = Number("<?= $row['app_status'] ?>");
                                    var price_pr_add1 = Number("<?= $row['price_pr_add1'] ?>");
                                    var txt_mod_ver1 = $("#txt_mod_ver1").val();
                                    var txt_mod_ver2 = $("#txt_mod_ver2").val();
                                    var txt_mod_ver3 = $("#txt_mod_ver3").val();

                                    if(app_status==2){
                                        var ot_mode = 2;
                                        var pay_price = Number('<?= $row['price_pr_add1'] ?>');
                                        pay_inicis('출원 준비 - 1차 수정요청(추가상품 결제)',ot_mode,'<?= $merchant_uid ?>',strval_pay_method,'<?= $row['idx'] ?>','0','<?= $mta['idx'] ?>','<?= $mta['mt_email'] ?>','<?= $mta['mt_name'] ?>','<?= $mta['mt_hp'] ?>',pay_price,0,0,0)

                                    }else if(app_status==3){
                                        var ot_mode = 3;
                                        var pay_price = 0;
                                        if(txt_mod_ver2.length>0){ pay_price = Number('<?= $dps2['price'] ?>'); }else{ pay_price = 0; }
                                        pay_inicis('출원 준비 - 2차 수정요청',ot_mode,'<?= $merchant_uid ?>',strval_pay_method,'<?= $row['idx'] ?>','0','<?= $mta['idx'] ?>','<?= $mta['mt_email'] ?>','<?= $mta['mt_name'] ?>','<?= $mta['mt_hp'] ?>',pay_price,0,0,0)

                                    }else if(app_status==4){
                                        var ot_mode = 4;
                                        var pay_price = 0;
                                        if(txt_mod_ver3.length>0){ pay_price = Number('<?= $dps3['price'] ?>'); }else{ pay_price = 0; }
                                        pay_inicis('출원 준비 - 3차 수정요청',ot_mode,'<?= $merchant_uid ?>',strval_pay_method,'<?= $row['idx'] ?>','0','<?= $mta['idx'] ?>','<?= $mta['mt_email'] ?>','<?= $mta['mt_name'] ?>','<?= $mta['mt_hp'] ?>',pay_price,0,0,0)

                                    }
                                }
                            </script>
                        </form>
                        <!-- 진행 상황 끝 -->
                        <?
                    }
                    ?>


                    <div class="process_information">
                        <div class='info-tit'>진행 내역<div class='expand'></div>
                        </div>
                        <div class='info_cont info_cont2'>
                            <ul>

                                <?
                                $sql = "select * from d_app_domestic_history where app_idx = '{$idx}' order by idx desc ";
                                $h_list = $DB->select_query($sql);
                                if(count($h_list)>0){
                                    foreach ($h_list as $rowh) {
                                        ?>
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <p class="fs_18 fw_600 fc_gr222 mr-2"><?= $rowh['d_content'] ?></p>
                                                <span class="fc_graaa">(<?= $rowh['d_date'] ?>)</span>
                                            </div>

                                            <ul class="info_list">

                                                <? if($rowh['d_content_file1']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">1차 보고서</p>
                                                        <p class="fs_15"><a href="./data/app_domestic/<?= $row['report_ver1'] ?>" target="_blank" download="<?= $row['report_ver1_origin'] ?>"><?= $row['report_ver1_origin'] ?></a></p>
                                                    </li>
                                                <? } ?>
                                                <? if($rowh['txt_mod_ver1']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">1차 수정요청사항</p>
                                                        <p class="fs_15"><?= $rowh['txt_mod_ver1'] ?></p>
                                                    </li>
                                                <? } ?>

                                                <? if($rowh['d_content_file2']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">2차 보고서</p>
                                                        <p class="fs_15"><a href="./data/app_domestic/<?= $row['report_ver2'] ?>" target="_blank" download="<?= $row['report_ver2_origin'] ?>"><?= $row['report_ver2_origin'] ?></a></p>
                                                    </li>
                                                <? } ?>
                                                <? if($rowh['txt_mod_ver2']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">2차 수정요청사항</p>
                                                        <p class="fs_15"><?= $rowh['txt_mod_ver2'] ?></p>
                                                    </li>
                                                <? } ?>

                                                <? if($rowh['d_content_file3']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">3차 보고서</p>
                                                        <p class="fs_15"><a href="./data/app_domestic/<?= $row['report_ver3'] ?>" target="_blank" download="<?= $row['report_ver3_origin'] ?>"><?= $row['report_ver3_origin'] ?></a></p>
                                                    </li>
                                                <? } ?>
                                                <? if($rowh['txt_mod_ver3']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">3차 수정요청사항</p>
                                                        <p class="fs_15"><?= $rowh['txt_mod_ver3'] ?></p>
                                                    </li>
                                                <? } ?>

                                                <? if($rowh['d_price']){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">결제 금액</p>
                                                        <p class="fs_15"><?= number_format($rowh['d_price']) ?>원</p>
                                                    </li>
                                                <? } ?>

                                                <? if($rowh['d_pay_method']){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">결제 수단</p>
                                                        <p class="fs_15">
                                                            <?
                                                            if($rowh['d_pay_method']=="card"){
                                                                echo "카드";
                                                            }else if($rowh['d_pay_method']=="vbank"){
                                                                echo "무통장입금";
                                                            }else{
                                                                echo $rowh['d_pay_method'];
                                                            }
                                                            ?>
                                                        </p>
                                                    </li>
                                                <? } ?>

                                            </ul>

                                        </li>
                                        <?
                                    }
                                }
                                ?>

                            </ul>
                        </div>

                        <?
                        $sql = "select * from order_domestic where app_idx = '{$idx}' order by idx desc ";
                        $od_list = $DB->select_query($sql);
                        if(count($od_list)>0){
                            ?>
                            <div class='info-tit mt_50'>결제정보<div class='expand'></div></div>
                            <div class='info_cont'>
                                <ul class="ic_pay">
                                    <?
                                    foreach ($od_list as $od){
                                        $sqlb = "select * from d_app_domestic_history where imp_uid = '{$od['imp_uid']}' and merchant_uid = '{$od['merchant_uid']}' ";
                                        $odh = $DB->fetch_assoc($sqlb);
                                        ?>
                                        <li>
                                            <p class="fs_20 fc_gr222 fw_600 mb_10"><?= $odh['d_content'] ?></p>
                                            <div class="bg_lgr rounded-lg p_25_20 pay-info">
                                                <ul class="payment_list">
                                                    <?
                                                    if($od['ot_mode']==1){
                                                        ?>
                                                        <? if($od['sum_price']>0){ ?>
                                                            <li>
                                                                <p class="fw_500 fc_gr222 mr-2">주문금액</p>
                                                                <p class="fw_500"><?= number_format($od['sum_price']) ?>원</p>
                                                            </li>
                                                        <? } ?>
                                                        <? if($od['sale_price_mtcode']>0){ ?>
                                                            <li>
                                                                <p class="fw_500 fc_gr222 mr-2">추천인 코드 등록</p>
                                                                <p class="fw_500"><?= "- ".number_format($od['sale_price_mtcode']) ?>원</p>
                                                            </li>
                                                        <? } ?>
                                                        <? if($od['sale_price_salecode']>0){ ?>
                                                            <li>
                                                                <p class="fw_500 fc_gr222 mr-2">할인코드 차감</p>
                                                                <p class="fw_500"><?= "- ".number_format($od['sale_price_salecode']) ?>원</p>
                                                            </li>
                                                        <? } ?>
                                                        <?
                                                    }else if($od['ot_mode']==2){
                                                        ?>
                                                        <li>
                                                            <p class="fw_500 fc_gr222 mr-2">추가상품 수수료</p>
                                                            <p class="fw_500"><?= number_format($row['price_pr_add1']) ?>원</p>
                                                        </li>
                                                        <li>
                                                            <p class="fw_500 fc_gr222 mr-2">VAT</p>
                                                            <p class="fw_500"><?= number_format($row['price_pr_add2']) ?>원</p>
                                                        </li>
                                                        <li>
                                                            <p class="fw_500 fc_gr222 mr-2">특허청 관납료</p>
                                                            <p class="fw_500"><?= number_format($row['price_pr_add3']) ?>원</p>
                                                        </li>
                                                        <?
                                                    }
                                                    ?>

                                                    <? if($od['sale_price_point']>0){ ?>
                                                        <li>
                                                            <p class="fw_500 fc_gr222 mr-2">포인트 할인</p>
                                                            <p class="fw_500"><? echo "- ".number_format($od['sale_price_point']); ?>원</p>
                                                        </li>
                                                    <? } ?>

                                                </ul>
                                                <div class="payment">
                                                    <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                                    <p class="fs_24 fc_bdk fw_600"><? echo number_format($od['paid_amount']); ?>원</p>
                                                </div>
                                            </div>
                                        </li>
                                        <?
                                    }
                                    ?>

                                </ul>
                            </div>
                            <?
                        }
                        ?>

                    </div>

                    <!-- process_information 끝 -->

                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
    });

    $(document).ready(function() {
        $('.info-tit').mouseenter(function() {
            $(this).children('.expand').addClass('turn');
        });
        $('.info-tit').mouseleave(function() {
            if ($(this).hasClass('open')) {} else {
                $(this).children('.expand').removeClass('turn');
            }
        });
        $('.info-tit').click(function() {
            var $this = $(this);
            if ($this.hasClass('open')) {
                $('.info-tit').removeClass('open');
                $('.info_cont').stop(true).slideUp("fast");
                $('.expand').removeClass('turn');
                $this.removeClass('open');
                $this.children('.expand').removeClass('turn');
                $this.next().stop(true).slideUp("fast");
            } else {
                $('.info-tit').removeClass('open');
                $('.info_cont').stop(true).slideUp("fast");
                $('.expand').removeClass('turn');

                $this.addClass('open');
                $this.children('.expand').addClass('turn');
                $this.next().stop(true).slideDown("fast");
            }
        });
    });

    //더보기, 접기 버튼
    $('.detail_text_wrap .text_more').on('click', function() {
        let textHeight = $('.detail_text span').outerHeight();
        if ($(this).prev().height() <= 22) {
            $(this).prev().animate({
                'overflow': 'unset',
                'height': textHeight
            });
            $(this).text('접기');
        } else {
            $(this).prev().animate({
                'overflow': 'hidden',
                'height': '22px'
            });
            $(this).text('더보기');
        }
    });

    $("#txt_mod_ver2").on("keyup",function (){
        var txt_mod_ver2 = $("#txt_mod_ver2").val();
        var price = Number('<?= $dps2['price'] ?>');
        if(txt_mod_ver2.length>0){
            $(".d-show-payprice").html(addComma(price)+"원");
            //$("#wrap_paymethod").show();
        }else{
            $(".d-show-payprice").html(addComma(0)+"원");
            //$("#wrap_paymethod").hide();
        }
    });

    $("#txt_mod_ver3").on("keyup",function (){
        var txt_mod_ver3 = $("#txt_mod_ver3").val();
        var price = Number('<?= $dps3['price'] ?>');
        if(txt_mod_ver3.length>0){
            $(".d-show-payprice").html(addComma(price)+"원");
            //$("#wrap_paymethod").show();
        }else{
            $(".d-show-payprice").html(addComma(0)+"원");
            //$("#wrap_paymethod").hide();
        }
    });
</script>
<?php
include("./foot_inc.php");
?>
<?php
include "./head_inc.php";
if(!$_SESSION['mt_id']){
    alert("로그인 후 이용해주세요.", "./login.php");
}
$sql = "select * from d_app_domestic where mt_idx = '{$_SESSION['mt_idx']}' and app_status < 1 and d_datetime = '' ";
$dad = $DB->fetch_assoc($sql);

$query = "select * from cate_ps1 where ct_level = 1 order by ct_order asc, ct_id asc ";
$list1 = $DB->select_query($query);

$query = "select * from service_domestic order by idx asc ";
$sdlist = $DB->select_query($query);

$sqlb = "select dadi.*, sd.s_name from d_app_domestic_item dadi ";
$sqlb .= "left join d_app_domestic dad on dad.idx = dadi.app_idx ";
$sqlb .= "left join service_domestic sd on sd.idx = dadi.cate_s ";
$sqlb .= "where app_status < 1 and d_datetime = '' and dad.mt_idx = '{$_SESSION['mt_idx']}' order by dadi.idx desc ";
$listb = $DB->select_query($sqlb);

$sqlc = "select sd.idx, sd.s_name, count(sd.idx) as s_cnt, sum(sd.s_price) as s_price from d_app_domestic_item dadi ";
$sqlc .= "left join d_app_domestic dad on dad.idx = dadi.app_idx ";
$sqlc .= "left join service_domestic sd on sd.idx = dadi.cate_s ";
$sqlc .= "where app_status < 1 and d_datetime = '' and dad.mt_idx = '{$_SESSION['mt_idx']}' ";
$sqlc .= "group by sd.idx ";
$listc = $DB->select_query($sqlc);

$sqld = "select sum(sd.s_price) as sum_price from d_app_domestic_item dadi ";
$sqld .= "left join d_app_domestic dad on dad.idx = dadi.app_idx ";
$sqld .= "left join service_domestic sd on sd.idx = dadi.cate_s ";
$sqld .= "where app_status < 1 and d_datetime = '' and dad.mt_idx = '{$_SESSION['mt_idx']}' ";
$rowd = $DB->fetch_assoc($sqld);
?>
<div class="sub_pg application_domestic">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <form id="form1" name="form1" method="post" enctype="multipart/form-data">
                <input type="hidden" id="cate_s" name="cate_s" value="">
                <div class="division d-block d-xl-flex justify-content-between">
                    <div class="w-65">
                        <h2 class="sub_tit">상표출원하기</h2>

                        <!-- 상표출원 단계 -->
                        <div class="step d-flex flex-wrap mb_15">
                            <button type="button"  class="btn btn-outline-secondary btn-md mr_8 no-cursor">1. 상표정보 입력</button>
                            <button type="button"  class="btn btn-outline-primary btn-md mr_8 no-cursor">2. 상품분류 및 서비스 선택</button>
                            <button type="button"  class="btn btn-outline-secondary btn-md mr_8 no-cursor">3. 상표 권리자 정보 등록</button>
                            <button type="button"  class="btn btn-outline-secondary btn-md no-cursor">4. 최종 확인 및 결제</button>
                        </div>
                        <!-- 상표출원 단계 끝-->


                        <!-- 상표출원 임시저장 -->
                        <!--<div class="d-flex align-items-center bg-light rounded p_15_20 justify-content-between mb_50">
                            <div class="d-flex mr-3">
                                <i class=" xi-info-o fc_primary fs_19 mr_8 mt-1"></i></i>
                                <p class="fc_primary">임시저장하여 나중에 돌아오실때 저장 되었던 곳에서 진행하세요.</p>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm">임시저장</button>
                        </div>-->
                        <!-- 상표출원 임시저장 끝 -->



                        <h3 class="sub_tit2 mt-5">상품 · 서비스 카테고리 선택</h3>
                        <div class="category_type mb_50">
                            <!-- 선택 라디오,체크박스 -->
                            <div class="select d-flex flex-wrap justify-content-between">

                                <?
                                if(count($list1)>0){
                                    $a1=1;
                                    foreach ($list1 as $pslv1) {
                                        if($pslv1['ct_icon']){
                                            $upload_dir = "./data/app_domestic/";
                                            $imgsrc = $upload_dir.$pslv1['ct_icon'];
                                        }else{
                                            $upload_dir = "./images/";
                                            $imgsrc = $upload_dir."noimg.png";
                                        }
                                        ?>
                                        <div class="checks w-33">
                                            <input type="radio" name="cate_ps1" class="cate_ps1" id="cate_ps1_<?= $a1 ?>" value="<?= $pslv1['ct_id'] ?>" onclick="click_cate_ps1('<?= $pslv1['ct_id'] ?>')">
                                            <label for="cate_ps1_<?= $a1 ?>">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= $imgsrc ?>" alt="" class="category_img mr_20">
                                                    <div>
                                                        <p><?= $pslv1['ct_name'] ?></p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <?
                                        $a1++;
                                    }
                                }
                                ?>

                            </div>
                            <!-- 선택 라디오,체크박스 끝-->
                        </div>
                        <!-- 상품 · 서비스 카테고리 선택 끝 -->

                        <h3 class="sub_tit2">분류 선택</h3>
                        <div class="classification_type mb_50">
                            <!-- 선택 라디오,체크박스 -->
                            <div id="wrap_cate_lv2" class="select d-flex flex-wrap justify-content-between">
                                <div class="text-center wd-100">
                                    <p class="mr-3 fc_gr999">상품 · 서비스 카테고리를 선택하세요.</p>
                                </div>
                            </div>
                            <!-- 선택 라디오,체크박스 끝-->
                        </div>
                        <!-- 분류 선택 끝 -->


                        <h3 class="sub_tit2">서비스 선택</h3>
                        <div class="service_type mb_22">
                            <div class="select d-flex flex-wrap justify-content-between">
                                <?
                                if(count($sdlist)>0){
                                    foreach ($sdlist as $sd) {
                                        ?>
                                        <div class="service w-50">
                                            <div class="top bg-primary d-flex align-items-center justify-content-between fc_wh">
                                                <p class="fs_20 fw_500"><?= $sd['s_name'] ?></p>
                                                <p class="fs_26 fw_500"><?= number_format($sd['s_price']) ?></p>
                                            </div>
                                            <div class="bottom bottom2">
                                                <ul class="fs_15 mb_40">
                                                    <? if($sd['s_content1']){ ?>
                                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                        <p><?= $sd['s_content1'] ?></p>
                                                    </li>
                                                    <? } ?>

                                                    <? if($sd['s_content2']){ ?>
                                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                        <p><?= $sd['s_content2'] ?></p>
                                                    </li>
                                                    <? } ?>

                                                    <? if($sd['s_content3']){ ?>
                                                        <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                            <p><?= $sd['s_content3'] ?></p>
                                                        </li>
                                                    <? } ?>
                                                </ul>
                                                <button type="button" class="btn btn-secondary btn-md btn-block" onclick="click_service('<?= $sd['idx'] ?>')">선택</button>
                                            </div>
                                        </div>
                                        <?
                                    }
                                }
                                ?>

                            </div>
                        </div>
                        <!-- 서비스 선택 끝-->

                        <div class="btn_group d-none d-md-flex justify-content-center">
                            <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="location.href='application_domestic_step1.php'">이전으로</button>
                            <? if(count($listb)>0){ ?>
                                <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_domestic_step3.php'">다음으로</button>
                            <? } ?>
                        </div>

                    </div>
                    <!-- w-65 끝-->



                    <!-- w-30 시작-->
                    <div class="w-30 h-80 aside">
                        <div class="aside_scroll">
                            <h3 class="sub_tit2 fc_bdk">상표유형 선택</h3>
                            <ul class="select_product_list mb_15">
                                <?
                                if(count($listb)>0){
                                    foreach ($listb as $rowb){
                                        $sqlb = "select * from cate_ps1 where ct_id = '{$rowb['cate_ps2']}' ";
                                        $cp1 = $DB->fetch_assoc($sqlb);
                                        if(strlen($cp1['ct_catenum'])<2){ $ct_catenum = "0".$cp1['ct_catenum']; }else{ $ct_catenum = $cp1['ct_catenum']; }
                                        ?>
                                        <li>
                                            <div class="d-flex justify-content-between mb-2">
                                                <p class="fs_17 fc_gr222 fw_500"><?= $rowb['s_name'] ?></p>
                                                <a class="btn_del_dadi" data-idx="<?= $rowb['idx'] ?>"><i class="xi-close fs_18 fc_grccc"></i></a>
                                            </div>
                                            <p><?= $ct_catenum ?>류 : <?= $cp1['ct_name'] ?></p>
                                        </li>
                                        <?
                                    }
                                }else{
                                    ?>
                                    <li>
                                        <p>선택된 상품이 없습니다.</p>
                                    </li>
                                    <?
                                }
                                ?>

                            </ul>

                            <? if(count($listb)>0){ ?>
                            <button type="button" data-mtidx="<?= $_SESSION['mt_idx'] ?>" class="btn btn-outline-primary btn-sm btn-block mb_40 btn_del_dadi_all">전체삭제</button>
                            <? } ?>

                            <h3 class="sub_tit2 fc_bdk">결제금액</h3>
                            <div class="bg-wh rounded-lg p_25_20">
                                <ul class="payment_list">
                                    <?
                                    if(count($listc)>0){
                                        foreach ($listc as $rowc) {
                                            ?>
                                            <li>
                                                <div class="d-flex align-items-center mr-3">
                                                    <p class="fw_500 fc_gr222 mr-2"><?= $rowc['s_name'] ?></p>
                                                    <p class="fc_grccc">X<?= $rowc['s_cnt'] ?></p>
                                                </div>
                                                <p class="fw_500"><?= number_format($rowc['s_price']) ?>원</p>
                                            </li>
                                            <?
                                        }
                                    }
                                    ?>
                                </ul>
                                <? if(count($listb)>0){ ?>
                                <div class="border_bk mb_20"></div>
                                <? } ?>
                                <div class="payment">
                                    <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                    <p class="fs_24 fc_bdk fw_600">
                                        <?
                                        echo number_format($rowd['sum_price'])."원";
                                        ?>
                                    </p>
                                </div>
                            </div>

                            <div class="btn_group d-flex d-md-none justify-content-center mt-5 mt-md-0">
                                <button type="button" class="btn btn-secondary btn-md btn_style03 mr-2 mr-md-3" onclick="location.href='application_domestic_step1.php'">이전으로</button>
                                <? if(count($listb)>0){ ?>
                                <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_domestic_step3.php'">다음으로</button>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                    <!-- w-30 끝-->
                    <!-- division 끝 / 서브페이지 영역 2분할 -->

            </form>


        </div>
    </div>
</div>
<!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->

<script>
    function click_service(sdidx){
        $("#cate_s").val(sdidx);
        var cate_ps1 = $("input[name='cate_ps1']:checked").length;
        var cate_ps2 = $(".cate_ps2:checked").length;
        if(cate_ps1<1){
            alert("상품 · 서비스 카테고리를 선택해주세요.");
        }else if(cate_ps2<1){
            alert("분류를 선택해주세요.");
        }else{
            var params;
            var url;
            params = new FormData($('#form1').get(0));
            url = "./upload_domestic_step2.php";
            $.ajax({
                type: "POST",
                url: url,
                data: params,
                dataType:'html',
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                cache: false,

                success: function(data){
                    //console.log(data);
                    if(Number(data)==1){
                        location.reload();
                    }else{
                        alert("상표 출원 도중 오류가 발생하였습니다. 처음 단계부터 재시도 부탁드리며 해당 오류가 계속 발견될 시 담당자에게 문의 부탁드립니다.");
                    }
                }
            });
        }
    }

    function click_cate_ps1(ct_id){
        $.ajax({
            type: "POST",
            url: "./get_ajax.php",
            data: {
                mode:'get_cate2_domestic',
                ct_id:ct_id,
            },
            cache: false,
            success: function(data){
                $("#wrap_cate_lv2").html(data);
            }
        });
    }


    var hd_height = $("#hd").height(); //헤더의 높이를 구합니다.
    $(document).scroll(function() { //페이지내에서 스크롤이 시작되면
        curSc = $(document).scrollTop() + $(window).height(); //현재 스크롤의 위치입니다.
        body_height = $("body").height(); //body의 높이를 구합니다.
        footer_height = $(".ft").height(); // 푸터의 높이를 구합니다.
        bottom_top = body_height - footer_height; //푸터를 제외한 body의 길이를 구합니다.
        if (window.innerWidth > 1560) {

            if (curSc > bottom_top + 20) { // 현재 스크롤의 높이가 body_top 보다 크다면 (하단 영역에 도착했다면)  *20 은 적당히 조절해주시면 됩니다.
                $(".aside").css('top', 'auto'); //fixed top 성질을 없애고
                $(".aside").css('bottom', curSc - bottom_top + 150); //fixed bottom 을 줍니다.
            } else {
                $(".aside").css('top', hd_height + 60); // 그렇지않으면 상단에 고정되게 합니다.
            }
        }
        resize();
    });

    $(".btn_del_dadi").on("click", function (){
        var idx = $(this).attr("data-idx");
        del_dadi_domestic(idx);
    });

    $(".btn_del_dadi_all").on("click", function (){
        var mtidx = $(this).attr("data-mtidx");
        del_dadi_domestic_all(mtidx);
    });

    $(function (){
        // 1단계 데이터 임시 저장
        save_temporarily2("application_domestic");
    });
</script>

<?php
include "./foot_inc.php";
?>

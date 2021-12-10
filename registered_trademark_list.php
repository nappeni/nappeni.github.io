<?php
include("./head_inc.php");
if(!$_SESSION['mt_id']){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;

$n_limit_num = 15;
$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$qstr = "&pg=";

$sql_from = "from d_app_domestic_item dadi left join d_app_domestic dad on dadi.app_idx = dad.idx ";
$sql = "select dadi.*, dad.img_mark, dad.cate_mark, dad.name_mark, dad.dt_complete {$sql_from} ";
$sql_count = " select count(*) as cnt {$sql_from} ";
$sql_order = "order by dadi.idx desc ";
$sql_where = "where dad.mt_idx = '{$_SESSION['mt_idx']}' and dadi.d_status = 14 ";

$row_cnt = $DB->fetch_assoc($sql_count.$sql_where);
$total_count = $row_cnt['cnt'];
$n_page = ceil($total_count / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;

unset($list);
$sql_query = $sql.$sql_where.$sql_order."limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>
<div class="sub_pg my_pg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
                <!-- w-30 시작 / 마이페이지 -->
                <?
                $idx_lm1 = 2;
                $idx_lm2 = 3;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->


                <!-- w-65 시작-->
                <div class="w-65">
                    <h2 class="sub_tit">등록상표 현황</h2>

                    <div class="bg-light rounded p_20_25 mb_30">
                        <ul class="fs_15">
                            <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                <p>존속기간 만료 1년전부터 갱신료 납부가 활성화가됩니다.</p>
                            </li>
                            <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                <p>후기 등록 시 닥터마크에서 선정하여 이용후기에 올라갑니다.</p>
                            </li>
                        </ul>
                    </div>


                    <ul class="brand_list brand_list2 mb_30">
                        <?
                        if(count($list)>0){
                            foreach ($list as $row) {
                                $sql = "select s_name from service_domestic where idx = '{$row['cate_s']}' ";
                                $sdb = $DB->fetch_assoc($sql);

                                $sql = "select * from cate_ps1 where ct_id = '{$row['cate_ps2']}' ";
                                $cp1 = $DB->fetch_assoc($sql);

                                $sqlb = "select date_add('{$row['dt_register_complete']}',interval {$row['period']} year ) as dt from dual ";
                                $rowb = $DB->fetch_assoc($sqlb);
                                $result_dt_period = str_replace("-",".",$rowb['dt']);
                                $arr_result_dt_period = explode(".",$result_dt_period);

                                $sqlc = "select datediff('{$result_dt_period}',date_format(now(),'%Y.%m.%d')) as dtnum from dual ";
                                $rowc = $DB->fetch_assoc($sqlc);

                                if ($row['img_mark']) {
                                    $img_mark_src = "./data/app_domestic/" . $row['img_mark'];
                                } else {
                                    $img_mark_src = "./images/noimg.png";
                                }
                                ?>
                                <li class="d-block d-sm-flex">
                                    <div class="brand_img" style="background-image: url('<?= $img_mark_src ?>')"></div>
                                    <div class="d-block d-md-flex justify-content-between align-items-center brand_cont flex-wrap">
                                        <div class="row col-12 m-0">
                                            <div class="col-12 col-md-6">
                                                <div>
                                                    <div class="d-flex align-items-center mb_8">
                                                        <p class="fc_gr222 fw_500 w_100">상표 유형</p>
                                                        <p class="fs_15">
                                                            <?
                                                            if($row['cate_mark']==1){ echo '문자상표'; }
                                                            else if($row['cate_mark']==2){ echo '도형상표'; }
                                                            else if($row['cate_mark']==3){ echo '복합상표'; }
                                                            else if($row['cate_mark']==4){ echo '기타상표'; }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="d-flex align-items-center mb_8">
                                                        <p class="fc_gr222 fw_500 w_100">출원번호</p>
                                                        <p class="fs_15"><?= $row['code_app'] ?></p>
                                                    </div>
                                                    <div class="d-flex align-items-center mb_8">
                                                        <p class="fc_gr222 fw_500 w_100">상표명</p>
                                                        <p class="fs_15"><?= $row['name_mark'] ?></p>
                                                    </div>
                                                    <div class="d-flex align-items-center mb_8">
                                                        <p class="fc_gr222 fw_500 w_100">상품류</p>
                                                        <p class="fs_15">제<?= $cp1['ct_catenum'] ?>류</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center mb_8 flex-wrap">
                                                    <p class="fc_gr222 fw_500 w_100">등록일</p>
                                                    <div class="d-flex align-items-center">
                                                        <p class="fs_15"><?= $row['dt_register_complete'] ?></p>
                                                        <?
                                                        if($row['file_report4']){
                                                            ?>
                                                            <a href="./data/app_domestic_item/<?= $row['file_report4'] ?>" download="<?= $row['file_report4_origin'] ?>" class="fs_15 fc_primary a_link pl-3">등록공보 조회하기</a>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center mb_8">
                                                    <p class="fc_gr222 fw_500 w_100">갱신일</p>
                                                    <p class="fs_15">
                                                        <?
                                                        if($row['dt_renewal']){
                                                            echo str_replace("-",".",$row['dt_renewal']);
                                                        }else{
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <p class="fc_gr222 fw_500 w_100">존속기간</p>
                                                    <p class="fs_15"><?= $arr_result_dt_period[0] ?>년 <?= $arr_result_dt_period[1] ?>월 <?= $arr_result_dt_period[2] ?>일 (<?= $row['period'] ?>년)</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt_5">
                                            <?
                                            if(!$row['rv_subject']){
                                                ?>
                                                <button type="button" class="btn btn-outline-primary m-1" type="button" onclick="location.href='registered_trademark_review.php?idx=<?= $row['idx'] ?><?= $qstr ?>' ">후기 등록하기</button>
                                                <?
                                            }

                                            if($rowc['dtnum']<=365){
                                                ?>
                                                <button type="button" class="btn btn-primary m-1" type="button" onclick="location.href='registered_trademark_renewal_fee.php?idx=<?= $row['idx'] ?><?= $qstr ?>'">갱신료 납부</button>
                                                <?
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <?
                            }
                        }else{
                            ?>
                            <li class="d-block fs_18 fc_gr222 fw_600 text-center">등록 완료된 상표가 없습니다.</li>
                            <?
                        }
                        ?>
                    </ul>

                    <?
                    if($n_page>0) {
                        echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$qstr);
                    }
                    ?>
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

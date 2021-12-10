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
$sql = "select dadi.*, dad.img_mark, dad.dt_complete {$sql_from} ";
$sql_count = " select count(*) as cnt {$sql_from} ";
$sql_order = "order by dadi.idx desc ";
$sql_where = "where dad.mt_idx = '{$_SESSION['mt_idx']}' and dad.app_status = 6 ";

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
                $idx_lm2 = 1;
                $idx_lm3 = 2;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->


                <!-- w-65 시작-->
                <div class="w-65">
                    <h2 class="sub_tit">출원완료 상표</h2>
                    <ul class="brand_list mt_30 mb_30">
                        <?
                        if(count($list)>0){
                            foreach ($list as $row){
                                if($row['img_mark']){ $img_mark_src = "./data/app_domestic/".$row['img_mark']; }else{ $img_mark_src = "./images/noimg.png"; }
                                ?>
                                <li class="d-block d-sm-flex">
                                    <div class="brand_img" style="background-image: url('<?= $img_mark_src ?>')"></div>
                                    <div class="d-block d-md-flex justify-content-between align-items-center brand_cont">
                                        <div class="pr-2">
                                            <p class="fs_20 fc_gr222 fw_600 mb_5">
                                                <?
                                                if($row['code_app']){ echo $row['code_register1']; }else{ echo '00-0000-0000000'; }
                                                ?>
                                            </p>
                                            <div class="d-flex align-items-center mb_8 flex-wrap">
                                                <div class="d-flex align-items-center fc_gr222 fw_500 w_200 mr-2">
                                                    <i class="xi-check-circle-o fs_18 mr-2"></i>
                                                    <p>출원완료일</p>
                                                </div>
                                                <p class="fs_15"><?= $row['dt_complete'] ?></p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8 flex-wrap">
                                                <div class="d-flex align-items-center fc_gr222 fw_500 w_200 mr-2">
                                                    <i class="xi-timer-o fs_18 mr-2"></i>
                                                    <p>심사결과 통지 예정일</p>
                                                </div>
                                                <p class="fs_15"><?= $row['dt_result'] ?></p>
                                            </div>
                                            <div class="d-flex flex-wrap mt_10">
                                                <p class="text_bg mr-2 my-1">
                                                    <?
                                                    $sqlb = "select s_name from service_domestic where idx = '{$row['cate_s']}' ";
                                                    $sdb = $DB->fetch_assoc($sqlb);
                                                    echo $sdb['s_name'];
                                                    ?>
                                                </p>
                                                <p class="text_bg bg_gre9 fc_gr666 my-1">
                                                    <?
                                                    if($row['d_status']==1){ echo "출원완료"; }
                                                    else if($row['d_status']==2){ echo "심사중"; }
                                                    else if($row['d_status']==3){ echo "출원취소"; }
                                                    else if($row['d_status']==4){ echo "심사 결과 통지"; }
                                                    else if($row['d_status']==5){ echo "심사 재개"; }
                                                    else if($row['d_status']==6){ echo "거절결정 1차"; }
                                                    else if($row['d_status']==7){ echo "심사진행"; }
                                                    else if($row['d_status']==8){ echo "거절결정 2차"; }
                                                    else if($row['d_status']==9){ echo "심판결과 (패소)"; }
                                                    else if($row['d_status']==10){ echo "승소"; }
                                                    else if($row['d_status']==11){ echo "출원공고"; }
                                                    else if($row['d_status']==12){ echo "등록대기"; }
                                                    else if($row['d_status']==13){
                                                        $sql_dadh = "select * from d_app_domestic_history2 where app_idx = '{$row['app_idx']}' and app_item_idx = '{$row['idx']}' and d_content = '등록결정' ";
                                                        $dadh = $DB->fetch_assoc($sql_dadh);
                                                        if($dadh['d_pay_status']=="paid"){
                                                            echo "등록결정 (결제완료)";
                                                        }else{
                                                            echo "등록결정 (결제대기)";
                                                        }
                                                    }
                                                    else if($row['d_status']==14){ echo "등록완료"; }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-outline-secondary btn-md" onclick="gourl('./completed_application_view.php?idx=<?= $row['idx'] ?>&<?= $qstr ?><?= $pg ?>')">상세보기</button>
                                        </div>
                                    </div>
                                </li>
                                <?
                            }
                        }else{
                            ?>
                            <li class="d-block fs_18 fc_gr222 fw_600 text-center">출원 완료된 상표가 없습니다.</li>
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

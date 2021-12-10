<?
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

$sql = "select * from d_app_domestic ";
$sql_count = " select count(*) as cnt from d_app_domestic ";
$sql_order = "order by d_datetime desc ";
$sql_where = "where mt_idx = '{$_SESSION['mt_idx']}' and app_status > 0 and app_status < 9 and app_status != 6 ";

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
                $idx_lm3 = 1;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->

                <!-- w-65 시작-->
                <div class="w-65">
                    <h2 class="sub_tit">출원준비중인 상표</h2>
                    <ul class="brand_list mt_30 mb_30">
                        <?
                        if(count($list)>0){
                            foreach ($list as $row) {
                                if($row['img_mark']){ $img_mark_src = "./data/app_domestic/".$row['img_mark']; }else{ $img_mark_src = "./images/noimg.png"; }
                                ?>
                                <li class="d-block d-sm-flex">
                                    <div class="brand_img" style="background-image: url('<?= $img_mark_src ?>')"></div>
                                    <div class="d-block d-md-flex justify-content-between align-items-center brand_cont">
                                        <div class="pr-2">
                                            <div class="d-flex align-items-center flex-wrap mb_8">
                                                <div class="d-flex align-items-center fc_gr222 fw_500 w_140">
                                                    <i class="xi-check-circle-o fs_18 mr-2"></i>
                                                    <p>접수일자</p>
                                                </div>
                                                <p class="fs_15"><?= str_replace("-",".",substr($row['d_datetime'],0,10)) ?></p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mb_8">
                                                <div class="d-flex align-items-center fc_gr222 fw_500 w_140">
                                                    <i class="xi-timer-o fs_18 mr-2"></i>
                                                    <p>출원완료일</p>
                                                </div>
                                                <p class="fs_15"><? if($row['dt_complete']){echo $row['dt_complete'];}else{echo "-";} ?></p>
                                            </div>
                                            <div class="d-flex flex-wrap mt_10">
                                                <p class="text_bg bg_gre9 fc_gr666 my-1">
                                                    <?
                                                    if($row['app_status']==1){ echo "접수"; }
                                                    else if($row['app_status']==2){ echo "접수완료"; }
                                                    else if($row['app_status']==3){ echo "출원준비-1차 수정요청"; }
                                                    else if($row['app_status']==4){ echo "출원준비-2차 수정요청"; }
                                                    else if($row['app_status']==5){ echo "출원준비-3차 수정요청"; }
                                                    else if($row['app_status']==6){ echo "출원완료"; }
                                                    else if($row['app_status']==7){ echo "출원취소"; }
                                                    else if($row['app_status']==8){ echo "출원대기"; }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <?
                                        if($row['app_status']>1){
                                            ?>
                                            <div>
                                                <button type="button" class="btn btn-outline-secondary btn-md" onclick="gourl('./pending_application_view_primary.php?idx=<?= $row['idx'] ?>&<?= $qstr ?><?= $pg ?>')">상세보기</button>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </li>
                                <?
                            }
                        }else{
                            ?>
                            <li class="d-block fs_18 fc_gr222 fw_600 text-center">출원 준비중인 상표가 없습니다.</li>
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
include("./foot_inc.php");
?>

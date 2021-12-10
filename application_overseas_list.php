<? include_once("./head_inc.php"); 
if($_SESSION['mt_id']==null){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;
$n_limit = 4;
$pg = $_GET['pg'];
$_get_txt = "sel_search=".$_GET['sel_search']."&pg=";
?>
<div class="sub_pg my_pg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
               <!-- w-30 시작 / 마이페이지 -->
               <?
                $idx_lm1 = 2;
                $idx_lm2 = 2;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->


                <!-- w-65 시작-->
                <?php 
                    $_where = " where ";
                    $_query = "select *, idx as od_idx from o_app_domestic";
                    $_query_count = "select count(*) from o_app_domestic";
                    $_where_query .= $_where."mt_idx='".$_SESSION['mt_idx']."'";

                    $row_cnt = $DB->fetch_query($_query_count.$_where_query);
                    $couwt_query = $row_cnt[0];
                    $counts = $couwt_query;
                    $n_page = ceil($couwt_query /4);
					if($pg=="") $pg = 1;
					$n_from = ($pg - 1) * $n_limit;
					$counts = $counts - (($pg - 1) * 4);

                    unset($list);
                ?>
                <div class="w-65">
                    <h2 class="sub_tit">해외 출원상표 현황표</h2>
                    <ul class="brand_list oversea mt_30 mb_30">
                        <?php 
                            $sql_query = $_query.$_where_query."order by o_datetime desc limit ".$n_from.", ".$n_limit;
                            $list = $DB-> select_query($sql_query);
                            if($list){
                                foreach($list as $row){
                        ?>
                        <li class="d-block d-sm-flex">
                            <div class="d-block d-md-flex justify-content-between align-items-center brand_cont">
                                <div class="pr-2">
                                    <p class="fs_20 fc_gr222 fw_600 mb_5"><?= $row['p_name']?></p>
                                    <div class="d-flex align-items-center mb_8">
                                        <div class="d-flex align-items-center fc_gr222 fw_500 w_140">
                                            <i class="xi-timer-o fs_18 mr-2"></i>
                                            <p>접수날짜</p>
                                        </div>
                                        <p class="fs_15"><?= DateType($row['o_datetime'],1)?></p>
                                    </div>
                                    <div class="d-flex align-items-center mb_8">
                                        <div class="d-flex align-items-center fc_gr222 fw_500 w_140">
                                            <i class="xi-user-o fs_18 mr-2"></i>
                                            <p>담당자명</p>
                                        </div>
                                        <p class="fs_15"><?= $row['m_name']?></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center fc_gr222 fw_500 w_140">
                                            <i class="xi-map-o fs_18 mr-2"></i>
                                            <p>출원국가</p>
                                        </div>
                                        <p class="fs_15">
                                            <?php
                                                $nations = explode("/", $row['o_nations']);
                                                for($i=0; $i<count($nations); $i++){
                                                    $sql = "select nt_name from nation_t where idx='".$nations[$i]."'";
                                                    $nation = $DB -> fetch_query($sql);
                                                    echo $nation['nt_name']." ";
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-outline-secondary btn-md" onclick="location.href='application_overseas_information.php?info=<?= $row['od_idx']?>'">상세보기</button>
                                </div>
                            </div>
                        </li>
                        <?php } 
                        }else{?>
                            <li class="d-block d-sm-flex">
                                <p class="fs_18 fc_gr222 fw_600" style="margin:auto">해외 출원 상표 내역이 없습니다.</p>
                            </li>
                        <?php }?>
                    </ul>
                    <?
                        if($n_page>0) {
                            echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
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
<? include_once("./foot_inc.php"); ?>



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
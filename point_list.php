<? include_once("./head_inc.php"); ?>
<?php 
if($_SESSION['mt_id']==null){
    p_alert("로그인이 필요합니다.","./index.php");
}
$sql = "select mt_point from member_t where idx='".$_SESSION['mt_idx']."'";
$data1 = $DB -> select_query($sql);
foreach($data1 as $data1);
$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$_get_txt = "sel_search=".$_GET['sel_search']."&pg=";
?>
<div class="sub_pg my_pg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
                <!-- w-30 시작 / 마이페이지 -->
                <div class="w-30 my_page">
                    <h3 class="sub_tit2 fc_bdk"><?= $_SESSION['mt_name']?> 회원님 <span class="fs_19 fw_500 fc_gr666">반갑습니다.</span></h3>
                    <div class="bg-wh rounded-lg p_20 fw_600 mb_20">
                        <a href="./point_list.php" class="d-flex align-items-center justify-content-between ">
                            <p class="fs_18 fc_gr222">보유 포인트</p>
                            <p class="fs_24 fc_bdk"><?= $data1['mt_point']?>P</p>
                        </a>
                    </div>

                    <ul class="my_menu">
                        <li><a href="./account_management.php">계정관리</a></li>
                        <li>
                            <a href="./pending_application_list.php">상표현황</a>
                            <ul class="my_menu_2ul">
                                <li>
                                    <a href="./pending_application_list.php">출원상표 현황</a>
                                    <ul class="my_menu_3ul">
                                        <li><a href="./pending_application_list.php">- 출원준비 상표</a></li>
                                        <li><a href="./completed_application_list.php">- 출원완료 상표</a></li>
                                    </ul>
                                </li>
                                <li><a href="./application_overseas_list.php">해외 출원상표 현황</a></li>
                                <li><a href="./registered_trademark_list.php">등록상표 현황</a></li>
                            </ul>
                        </li>
                    </ul>


                </div>
                <!-- w-30 끝-->

                <!-- w-65 시작-->
                <div class="w-65">
                    <h2 class="sub_tit">포인트 내역</h2>
                    <form method="get" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>">
                        <select name="sel_search" id="sel_search" class="point-select" onchange="pit_search()">
                            <option value="all" <?php if($_GET['sel_search']=="all") echo "selected";?>>구분</option>
                            <option value="P" <?php if($_GET['sel_search']=="P") echo "selected";?>>적립</option>
                            <option value="M" <?php if($_GET['sel_search']=="M") echo "selected";?>>사용</option>
                        </select>
                    </form>
                    <ul class="point_list mb_22">
                    <?php
                    $_where = " where ";
                    $_query = "select * from point_t ";
                    $_query_count = "select count(*) from point_t";

                    if($_GET['sel_search']){
                        if($_GET['sel_search']!="all"){
                        $where_query .= $_where."pt_type='".$_GET['sel_search']."'";
                        $_where = " and ";
                        }
                    }
                    $where_query .= $_where."mt_idx='".$_SESSION['mt_idx']."'";

                    $row_cnt = $DB->fetch_query($_query_count.$where_query);
					$couwt_query = $row_cnt[0];
					$counts = $couwt_query;
					$n_page = ceil($couwt_query / $n_limit_num);
					if($pg=="") $pg = 1;
					$n_from = ($pg - 1) * $n_limit;
					$counts = $counts - (($pg - 1) * $n_limit_num);

                    unset($list);
                    $sql_query = $_query.$where_query."order by pt_wdate desc limit ".$n_from.", ".$n_limit;
                    $list = $DB-> select_query($sql_query);
                    if($list){
                        foreach($list as $row){
                    ?>
                        <li>
                            <div class="mb_5">
                                <p class="fs_18 fc_gr222 fw_600 mr-3"><?= $row['pt_content']?></p>
                                <p class="mr-3 fs_14 fc_grccc">만료일 <?= $row['pt_rdate']?></p>
                            </div>
                            <div class="point">
                                <p class="fs_20 fc_bdk fw_600 text-right"><?php echo $row['pt_type']=="P" ? "+" : "-";?><?= $row['pt_point']?>P</p>
                                <div class="d-flex text-right">
                                    <p class="fs_14 fc_grccc mr-2"><?= $row['pt_wdate']?></p>
                                    <p class="fs_14 <?php echo $row['pt_type']=="P"?"fc_primary":"text-danger"?>"><?php echo $row['pt_type']=="P"? "적립": "사용"?></p>
                                </div>
                            </div>
                        </li>
                    <?php }
                    }else{?>
                        <li>
                            <!-- <div class="mb_5"> -->
                                <p class="fs_18 fc_gr222 fw_600" style="margin:auto">포인트 내역이 없습니다.</p>
                            <!-- </div> -->
                        </li>
                    <?}?>
                    </ul>
					<?
                        if($n_page>0) {
                            echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
                        }
                    ?>
                    <!-- <div class="d-flex justify-content-center">
                        <nav aria-label="...">
                            <ul class="pagination fs_17 align-items-center">
                                <li class="page-item arrow">
                                    <a class="page-link fs_16" href="#" tabindex="-1"><i class="xi xi-angle-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#">5</a></li>
                                <li class="page-item arrow">
                                    <a class="page-link fs_16" href="#"><i class="xi xi-angle-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div> -->
                </div>
                <!-- w-65 끝-->
                <!-- division 끝 / 서브페이지 영역 2분할 -->
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<script type="text/javascript">
function pit_search(){
    $('#frm_search').submit();
}
</script>
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
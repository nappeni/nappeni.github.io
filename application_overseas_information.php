<? include_once("./head_inc.php");
if($_SESSION['mt_id']==null){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;
$sql = "select * from o_app_domestic od where od.idx = '".$_GET['info']."'";
$user = $DB->fetch_query($sql);
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
                <div class="w-65">
                    <h2 class="sub_tit">해외 출원상표 상세 정보</h2>
                    <div class="bg_lgr rounded-lg p_35_30 mb_25">
                        <h3 class="sub_tit2">설문지 내역</h3>
                        <ul class="information">
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">상품명</p>
                                <p class="fs_15"><?= $user['p_name']?></p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">간략한 상품소개</p>
                                <p class="fs_15"><?= $user['p_info']?> </p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">국가별 상표 유형</p>
                                <p class="fs_15">
                                    <?php 
                                        if($user['o_type']==1){
                                            echo "모든 국가에 동일 상표 출원";
                                        }else{
                                            echo "국가별 다른 상표 출원";
                                        }
                                    ?>
                                </p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">상표색상</p>
                                <p class="fs_15">
                                    <?php
                                        if($user['o_color']=="B"){
                                            echo "흑백";
                                        }else{
                                            echo "컬러";
                                        }
                                    ?>
                                </p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">출원국가</p>
                                <p class="fs_15">
                                    <?php 
                                        $natinos = explode("/",$user['o_nations']);
                                        for($i=0; $i<count($natinos)-1; $i++){
                                            $sql = "select nt_name from nation_t where idx='".$natinos[$i]."'";
                                            $n_name[] = $DB -> fetch_query($sql);
                                        }
                                        for($i=0; $i<count($natinos)-1; $i++){
                                            if($i==count($natinos)-1){
                                                echo $n_name[$i]['nt_name'];
                                            }else{
                                                echo $n_name[$i]['nt_name'].", ";
                                            }
                                        }
                                    ?>
                                </p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">상품분류</p>
                                <p class="fs_15">
                                    <?php
                                        $classes = explode("/", $user['o_class']);
                                        for($i=0;$i<count($classes)-1;$i++){
                                            $c_sql = "select co_name from cate_overseas_t where idx='".$classes[$i]."'";
                                            $c_name[] = $DB -> fetch_query($c_sql);
                                        }
                                        for($i=0; $i<count($c_name);$i++){
                                            if($i==count($c_name)-1){
                                                echo $c_name[$i]['co_name'];
                                            }else{
                                                echo $c_name[$i]['co_name'].", ";
                                            }
                                        }
                                    ?>
                                </p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">국내출원 유무</p>
                                <p class="fs_15">
                                    <?php
                                        if($user['d_opt']=="Y"){
                                            echo "네, 있습니다.";
                                        }else{
                                            echo "아니요, 없습니다.";
                                        }
                                    ?>
                                </p>
                            </li>
                            <li class="d-flex">
                                <p class="w_140 fc_gr222 fw_500">변형 출원 유뮤</p>
                                <p class="fs_15">
                                    <?php
                                        if($user['c_opt']=="Y"){
                                            echo "네, 변경 해주세요.";
                                        }else{
                                            echo "아니요, 그래도 출원합니다.";
                                        }
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="bg_lgr rounded-lg p_35_30">
                        <h3 class="sub_tit2">담당자 정보</h3>
                        <ul class="information">
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">담당자 이름</p>
                                <p class="fs_15"><?= $user['m_name']?></p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">담당자 이메일</p>
                                <p class="fs_15"><?= $user['m_email']?></p>
                            </li>
                            <li class="d-flex">
                                <p class="w_140 fc_gr222 fw_500">담당자 연락처</p>
                                <p class="fs_15"><?= $user['m_phone']?></p>
                            </li>
                        </ul>
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
<? include_once("./head_inc.php");
if($_SESSION['mt_id']==null){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;
$sql = "select *, idx as it_idx from inquiry_t it where it.idx = '".$_GET['info']."'";
$user = $DB->fetch_query($sql);
?>
<div class="sub_pg my_pg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
                <!-- w-30 시작 / 마이페이지 -->
                <?
                $idx_lm1 = 3;
                $idx_lm2 = 2;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->


                <!-- w-65 시작-->
                <div class="w-65">
                    <h2 class="sub_tit">1:1문의 상세 정보</h2>
                    <div class="bg_lgr rounded-lg p_35_30 mb_25">
                        <h3 class="sub_tit2">문의 내용</h3>
                        <ul class="information">
                            <li class="d-flex">
                                <p class="w_140 fc_gr222 fw_500">문의 날짜</p>
                                <p class="fs_15">
                                   <?= DateType($user['qt_wdate'],1)?>
                                </p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">문의 제목</p>
                                <p class="fs_15"><?= $user['qt_title']?></p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">문의 내용</p>
                                <p class="fs_15"><?= $user['qt_content']?> </p>
                            </li>
                        </ul>
                    </div>

                    <?php if($user['qt_status']==2){?>
                    <div class="bg_lgr rounded-lg p_35_30">
                        <h3 class="sub_tit2">답변 내용</h3>
                        <ul class="information">
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">답변 날짜</p>
                                <p class="fs_15"> <?= DateType($user['qt_adate'],1)?></p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">답변 내용</p>
                                <p class="fs_15"><?= $user['qt_answer']?></p>
                            </li>
                        </ul>
                    </div>
                    <?php }else{?>
                        <div style="text-align:center;">
                            <button type="button" class="btn btn-outline-secondary btn-md" onclick="location.href='personal_inquiry_view.php?act=update&info=<?= $user['it_idx']?>'">수정</button>
                            <button type="button" class="btn btn-outline-secondary btn-md" onclick="location.href='personal_inquiry_information.php?info=<?= $user['it_idx']?>'">삭제</button>
                        </div>
                    <?php }?>
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
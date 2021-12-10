<?php
include("./head_inc.php");
if(!$_SESSION['mt_id']){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;

$idx = $_GET['idx'];
$pg = $_GET['pg'];
$qstr = "&pg=";
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
                    <h2 class="sub_tit">상표등록 후기</h2>

                    <div class="bg-light rounded p_20_25 mb_30">
                        <ul class="fs_15">
                            <li class="d-flex"><span class="flex-shrink-0 mr-2 fc_primary">※</span>
                                <p class="fc_primary">후기 등록 시 닥터마크에서 선정하여 이용후기에 올라갑니다.</p>
                            </li>
                        </ul>
                    </div>

                    <form method="post" enctype="multipart/form-data" action="./registered_trademark_review_update.php">
                        <input type="hidden" name="idx" value="<?= $idx ?>">
                        <input type="hidden" name="pg" value="<?= $pg ?>">
                        <div class="ip_wr">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>제목</h5>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="rv_subject" id="rv_subject" placeholder="제목 입력해주세요." required maxlength="255">
                            </div>
                        </div>

                        <div class="ip_wr mb_22">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>후기 내용</h5>
                            </div>
                            <div class="input-group">
                                <textarea class="form-control" name="rv_content" id="rv_content" rows="10" placeholder="닥터마크를 이용하면서 느낀 후기를 작성해주세요." required></textarea>
                            </div>
                        </div>

                        <div class=" btn_group d-flex justify-content-center mb_70 mb-md-0">
                            <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="gourl('./registered_trademark_list.php?pg=<?= $pg ?>')">취소</button>
                            <button type="submit" class="btn btn-primary btn-md btn_style03">등록하기</button>
                        </div>
                    </form>


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

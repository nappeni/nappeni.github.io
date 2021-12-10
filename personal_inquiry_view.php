<? include_once("./head_inc.php"); 
if($_SESSION['mt_id']==null){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;
if($_GET['act']=="update"){
    $sql = "select * from inquiry_t where idx = '".$_GET['info']."'";
    $row = $DB->fetch_query($sql);
}
?>
<div class="sub_pg my_pg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
               <!-- w-30 시작 / 마이페이지 -->
               <?
                $idx_lm1 = 3;
                $idx_lm2 = 1;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->
                    <!-- w-65 시작-->
                    <div class="w-65">
                        <form name="qna" method="post" action="JYController/personal_inquiry.php" onsubmit="return checkNull(this)">
                            <input name="act" type="hidden" value="<?php echo  $_GET['act']=="update"?"update":"input"?>">
                            <input name="it_idx" type="hidden" value="<?= $_GET['info']?>">
                            <h2 class="sub_tit">1:1문의하기</h2>
                            <div class="ip_tit d-flex align-items-center d-flex mb-3">
                                <h5>제목</h5>
                            </div>
                            <div class="input-group">
                                <input id="qt_title" name="qt_title" type="text" class="form-control" placeholder="제목을 입력해주세요" value="<?= $row['qt_title']?>">
                            </div>
                            <br>
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>문의 내용</h5>
                            </div>
                            <div class=" input-group">
                                <textarea id="qt_content" name="qt_content" class="form-control" rows="5" placeholder="문의 내용을 입력해주세요"><?= $row['qt_content']?></textarea>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-md btn_style03"><?php echo  $_GET['act']=="update"?"수정하기":"문의하기"?></button>
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
    function checkNull(f){
        if(f.qt_title==' '){
            alert("제목을 입력해주세요");
            return false;
        }else if(f.qt_content== ' '){
            alert("문의 내용을 입력해주세요");
            return false;
        }
        return true;
    }
</script>
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
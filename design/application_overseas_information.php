<? include_once("./inc/head.php"); ?>
<div class="sub_pg my_pg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
                <!-- w-30 시작 / 마이페이지 -->
                <div class="w-30 my_page">
                    <h3 class="sub_tit2 fc_bdk">홍길동 회원님 <span class="fs_19 fw_500 fc_gr666">반갑습니다.</span></h3>
                    <div class="bg-wh rounded-lg p_20 fw_600 mb_20">
                        <a href="./point_list.php" class="d-flex align-items-center justify-content-between ">
                            <p class="fs_18 fc_gr222">보유 포인트</p>
                            <p class="fs_24 fc_bdk">10,000P</p>
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
                                <li><a href="./application_overseas_list.php" class="active">해외 출원상표 현황</a></li>
                                <li><a href="./registered_trademark_list.php">등록상표 현황</a></li>
                            </ul>
                        </li>
                    </ul>


                </div>
                <!-- w-30 끝-->


                <!-- w-65 시작-->
                <div class="w-65">
                    <h2 class="sub_tit">해외 출원상표 상세 정보</h2>
                    <div class="bg_lgr rounded-lg p_35_30 mb_25">
                        <h3 class="sub_tit2">설문지 내역</h3>
                        <ul class="information">
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">담당자명</p>
                                <p class="fs_15">김이름</p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">간략한 상품소개</p>
                                <p class="fs_15">로렘 입숨(lorem ipsum; 줄여서 립숨, lipsum)은 출판이나 그래픽 디자인 분야에서 폰트, 타이포그래피,
                                    레이아웃 같은 그래픽 요소나 시각적 연출을 보여줄 때 사용하는 표준 채우기 텍스트움 글로도 이용된다. </p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">국가별 상표 유형</p>
                                <p class="fs_15">모든 국가에 동일 상표 출원</p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">상표색상</p>
                                <p class="fs_15">흑백</p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">출원국가</p>
                                <p class="fs_15">대한민국, 방글레시아, 미국, 호주</p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">상품분류</p>
                                <p class="fs_15">제 26류, 제 37류</p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">국내출원 유무</p>
                                <p class="fs_15">아니요, 없습니다.</p>
                            </li>
                            <li class="d-flex">
                                <p class="w_140 fc_gr222 fw_500">변형 출원 유뮤</p>
                                <p class="fs_15">아니요, 그래도 출원합니다.</p>
                            </li>
                        </ul>
                    </div>

                    <div class="bg_lgr rounded-lg p_35_30">
                        <h3 class="sub_tit2">담당자 정보</h3>
                        <ul class="information">
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">담당자 이름</p>
                                <p class="fs_15">김미자</p>
                            </li>
                            <li class="d-flex mb_8">
                                <p class="w_140 fc_gr222 fw_500">담당자 이메일</p>
                                <p class="fs_15">aaa@naver.com</p>
                            </li>
                            <li class="d-flex">
                                <p class="w_140 fc_gr222 fw_500">담당자 연락처</p>
                                <p class="fs_15">010-1111-1111</p>
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
<? include_once("./inc/tail.php"); ?>



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
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

                    <ul class="point_list mb_22">
                        <li>
                            <div class="mb_5">
                                <p class="fs_18 fc_gr222 fw_600 mr-3">회원가입시 적립</p>
                                <p class="mr-3 fs_14 fc_grccc">만료일 2021-11-07 12:00:00</p>
                            </div>
                            <div class="point">
                                <p class="fs_20 fc_bdk fw_600 text-right">+ 1,000P</p>
                                <div class="d-flex text-right">
                                    <p class="fs_14 fc_grccc mr-2">2021-09-07 12:00:00</p>
                                    <p class="fs_14 fc_primary">적립</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="mb_5">
                                <p class="fs_18 fc_gr222 fw_600 mr-3">추가상품 결제에 사용</p>
                                <p class="mr-3 fs_14 fc_grccc">만료일 2021-11-07 12:00:00</p>
                            </div>
                            <div class="point">
                                <p class="fs_20 fc_bdk fw_600 text-right">- 1,000P</p>
                                <div class="d-flex text-right">
                                    <p class="fs_14 fc_grccc mr-2">2021-09-07 12:00:00</p>
                                    <p class="fs_14 text-danger">사용</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="mb_5">
                                <p class="fs_18 fc_gr222 fw_600 mr-3">추가상품 결제 시 1% 적립</p>
                                <p class="mr-3 fs_14 fc_grccc">만료일 2021-11-07 12:00:00</p>
                            </div>
                            <div class="point">
                                <p class="fs_20 fc_bdk fw_600 text-right">+ 1,000P</p>
                                <div class="d-flex text-right">
                                    <p class="fs_14 fc_grccc mr-2">2021-09-07 12:00:00</p>
                                    <p class="fs_14 fc_primary">적립</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="mb_5">
                                <p class="fs_18 fc_gr222 fw_600 mr-3">심판진행 시 사용</p>
                                <p class="mr-3 fs_14 fc_grccc">만료일 2021-11-07 12:00:00</p>
                            </div>
                            <div class="point">
                                <p class="fs_20 fc_bdk fw_600 text-right">- 1,000P</p>
                                <div class="d-flex text-right">
                                    <p class="fs_14 fc_grccc mr-2">2021-09-07 12:00:00</p>
                                    <p class="fs_14 text-danger">사용</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="mb_5">
                                <p class="fs_18 fc_gr222 fw_600 mr-3">추가상품 결제에 사용</p>
                                <p class="mr-3 fs_14 fc_grccc">만료일 2021-11-07 12:00:00</p>
                            </div>
                            <div class="point">
                                <p class="fs_20 fc_bdk fw_600 text-right">+ 1,000P</p>
                                <div class="d-flex text-right">
                                    <p class="fs_14 fc_grccc mr-2">2021-09-07 12:00:00</p>
                                    <p class="fs_14 fc_primary">적립</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="mb_5">
                                <p class="fs_18 fc_gr222 fw_600 mr-3">추가상품 결제 시 1% 적립</p>
                                <p class="mr-3 fs_14 fc_grccc">만료일 2021-11-07 12:00:00</p>
                            </div>
                            <div class="point">
                                <p class="fs_20 fc_bdk fw_600 text-right">- 1,000P</p>
                                <div class="d-flex text-right">
                                    <p class="fs_14 fc_grccc mr-2">2021-09-07 12:00:00</p>
                                    <p class="fs_14 text-danger">사용</p>
                                </div>
                            </div>
                        </li>
                    </ul>


                    <div class="d-flex justify-content-center">
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
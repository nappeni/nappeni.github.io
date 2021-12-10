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
                                <li><a href="./registered_trademark_list.php" class="active">등록상표 현황</a></li>
                            </ul>
                        </li>
                    </ul>


                </div>
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

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>제목</h5>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="제목 입력해주세요.">
                        </div>
                    </div>

                    <div class="ip_wr mb_22">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>후기 내용</h5>
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="닥터마크를 이용하면서 느낀 후기를 작성해주세요."></textarea>
                        </div>
                    </div>

                    <div class=" btn_group d-flex justify-content-center mb_70 mb-md-0">
                        <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="location.href='application_overseas_step1.php'">취소</button>
                        <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_overseas_step3.php'">등록하기</button>
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
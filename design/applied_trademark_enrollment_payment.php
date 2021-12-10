<? include_once("./inc/head.php"); ?>
<div class="sub_pg my_pg report">
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
                                        <li><a href="./completed_application_list.php" class="active">- 출원완료 상표</a></li>
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
                    <div class="report_top">
                        <h2 class="sub_tit">등록료 납부</h2>

                        <div class="bg-wh rounded-lg border_bold p_30 d-block d-sm-flex mb_25">
                            <div class="brand_img">
                                <img src="img/brand1.jpg">
                            </div>
                            <div class="d-block d-md-flex justify-content-between align-items-center brand_cont flex-wrap">
                                <div>
                                    <div class="d-flex align-items-center mb_8">
                                        <p class="fc_gr222 fw_500 w_100">상표명</p>
                                        <p class="fs_15">닥터마크</p>
                                    </div>
                                    <div class="d-flex align-items-center mb_8">
                                        <p class="fc_gr222 fw_500 w_100">상표유형</p>
                                        <p class="fs_15">문자상표</p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="fc_gr222 fw_500 w_100">상품류</p>
                                        <p class="fs_15">제10류</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fee_division">
                        <!-- fd_left 시작-->
                        <div class="fd_left">
                            <h3 class="sub_tit2 fc_gr222">특허청 등록 결제 정보</h3>
                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>존속기간 선택</h5>
                                </div>
                                <div class=" input-group">
                                    <select class="custom-select" id="inputGroupSelect01">
                                        <option selected="">10년</option>
                                        <option value="1">5년</option>
                                        <option value="2">10년</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ip_wr pb_15 br_bottom">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>존속기간</h5>
                                </div>
                                <p class="fs_15">2026년 09월 02일 예정 (10년)</p>
                            </div>
                            <ul class="mb_50">
                                <li class="d-flex align-items-center justify-content-between mb_5">
                                    <div class="d-flex align-items-center mr-3">
                                        <p class="fw_500 fc_gr222 mr-2">특허청 관납료</p>
                                    </div>
                                    <p>320,000원</p>
                                </li>
                                <li class="d-flex align-items-center justify-content-between mb_5">
                                    <div class="d-flex align-items-center mr-3">
                                        <p class="fw_500 fc_gr222 mr-2">납부 수수료</p>
                                    </div>
                                    <p>40,000원</p>
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center mr-3">
                                        <p class="fw_500 fc_gr222 mr-2">총 결제금액</p>
                                    </div>
                                    <p>360,000원</p>
                                </li>
                            </ul>

                            <div class="border_bk mb_50"></div>

                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="sub_tit2 fc_gr222">상표 등록증<br>수령 주소 정보</h3>
                                <div class="checks ml-3">
                                    <input type="checkbox" name="dd" id="d1" checked>
                                    <label for="d1">담당자 정보와 동일</label>
                                </div>
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>수령인 명 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요">
                                </div>
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>등록증 수령 주소 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group mb_8">
                                    <input type="text" class="form-control" placeholder="우편번호">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary btn-md" type="button">주소찾기</button>
                                    </div>
                                </div>
                                <input type="text" class="form-control mb_8" placeholder="도로명/ 지번 주소">
                                <input type="text" class="form-control" placeholder="상세주소 입력">
                            </div>


                            <div class="ip_wr mb_50">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>수령인 휴대 전화번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요">
                                </div>
                            </div>



                            <div class="border_bk mb_50"></div>

                            <h3 class="sub_tit2 fc_gr222">결제 정보</h3>

                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>결제수단 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_22">
                                <div class="input-group-prepend">
                                    <div class="checks mb-2 mr-4 mr-sm-5">
                                        <input type="radio" name="eg" id="eg1">
                                        <label for="eg1">무통장 입금</label>
                                    </div>
                                    <div class="checks mb-2 mr-4 mr-sm-5">
                                        <input type="radio" name="eg" id="eg2" checked>
                                        <label for="eg2">신용카드</label>
                                    </div>
                                    <div class="checks mb-2 mr-4 mr-sm-5">
                                        <input type="radio" name="eg" id="eg3">
                                        <label for="eg3">네이버 페이</label>
                                    </div>
                                    <div class="checks mb-2 mr-4 mr-sm-5">
                                        <input type="radio" name="eg" id="eg4">
                                        <label for="eg4">카카오페이</label>
                                    </div>
                                </div>
                            </div>
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>영수증 발행</h5>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="checks mb-2 mr-4 mr-sm-5">
                                        <input type="radio" name="ef" id="ef1" checked>
                                        <label for="ef1">세금계산서 발행</label>
                                    </div>
                                    <div class="checks mb-2 mr-4 mr-sm-5">
                                        <input type="radio" name="ef" id="ef2">
                                        <label for="ef2">현금영수증</label>
                                    </div>
                                    <div class="checks mb-2 mr-4 mr-sm-5">
                                        <input type="radio" name="ef" id="ef3">
                                        <label for="ef3">발행안함</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fd_left 끝-->

                        <!-- d_right 시작-->
                        <div class="fd_right">
                            <h3 class="sub_tit2 fc_gr222">결제금액</h3>
                            <div class="bg-wh rounded-lg p_25_20 mb_22">
                                <ul class="payment_list">
                                    <li>
                                        <p class="fw_500 fc_gr222 mr-2">10년 연장</p>
                                        <p class="fw_500">320,000원</p>
                                    </li>
                                    <li>
                                        <p class="fw_500 fc_gr222 mr-2">지정상품 가산금 <span class="fs_14 fc_gr999">(총 10개 초과)</span></p>
                                        <p class="fw_500">31,000원</p>
                                    </li>
                                    <li>
                                        <p class="fw_500 fc_gr222 mr-2">가산 관납료 <span class="fs_14 fc_gr999">(1년)</span></p>
                                        <p class="fw_500">2,000원</p>
                                    </li>
                                    <li>
                                        <p class="fw_500 fc_gr222 mr-2">등록 수수료 <span class="fs_14 fc_gr999">(간편출원)</span></p>
                                        <p class="fw_500">40,000원</p>
                                    </li>
                                    <li>
                                        <p class="fw_500 fc_gr222 mr-2">등록 수수료 VAT</p>
                                        <p class="fw_500">4,000원</p>
                                    </li>
                                </ul>
                                <div class="border_bk mb_20"></div>
                                <div class="payment">
                                    <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                    <p class="fs_24 fc_bdk fw_600">397,000원</p>
                                </div>
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>포인트 사용</h5>
                                </div>
                                <div class="input-group mb_10">
                                    <input type="text" class="form-control" placeholder="포인트 입력">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-md" type="button">전체사용</button>
                                    </div>
                                </div>
                                <p class="fs_14">보유중인 포인트 : 1000원</p>
                            </div>

                            <div class="pay_fin mb_22">
                                <div class="bg-wh rounded-lg p_25_20 br_primary">
                                    <ul class="payment_list">
                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2">주문금액</p>
                                            </div>
                                            <p class="fw_500">397,000원</p>
                                        </li>
                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2">할인금액</p>
                                            </div>
                                            <p class="fw_500">-1,000원</p>
                                        </li>
                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2">총 할인 금액</p>
                                            </div>
                                            <p class="fw_500">-1,000원</p>
                                        </li>
                                    </ul>
                                    <div class="border_bk mb_20 bg_gre9"></div>
                                    <div class="payment">
                                        <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                        <p class="fs_24 fc_bdk fw_600">396,000원</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <button type="button" class="btn btn-primary btn-md btn-block" onclick="location.href='application_domestic_final.php'">결제하기</button>
                            </div>
                        </div>
                        <!-- d_right 끝-->
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
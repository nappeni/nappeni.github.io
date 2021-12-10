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
                                        <li><a href="./pending_application_list.php" class="active">- 출원준비 상표</a></li>
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
                    <div class="report_top">
                        <h2 class="sub_tit">출원준비중인 상표</h2>

                        <div class="bg-wh rounded-lg border_bold p_30 d-block d-sm-flex mb_25">
                            <div class="brand_img">
                                <img src="img/brand1.jpg">
                            </div>
                            <div class="d-block d-md-flex justify-content-between align-items-center brand_cont flex-wrap">
                                <div class="row col-12 m-0">
                                    <div class="col-12 col-md-6">
                                        <div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">신청 번호</p>
                                                <p class="fs_15">210903-0546</p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">신청 날짜</p>
                                                <p class="fs_15">2021.09.03</p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">출원인</p>
                                                <p class="fs_15">김미자</p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">출원번호</p>
                                                <p class="fs_15">-</p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_100">출원완료일</p>
                                                <p class="fs_15">-</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center mb_8">
                                            <p class="fc_gr222 fw_500 w_100">출원 타입</p>
                                            <p class="fs_15">간편출원</p>
                                        </div>
                                        <div class="d-flex align-items-center mb_8">
                                            <p class="fc_gr222 fw_500 w_100">상표 유형</p>
                                            <p class="fs_15">문자상표</p>
                                        </div>
                                        <div class="d-flex align-items-center mb_8">
                                            <p class="fc_gr222 fw_500 w_100">상표명</p>
                                            <p class="fs_15">닥터마크</p>
                                        </div>
                                        <div class="d-flex mb_8">
                                            <p class="fc_gr222 fw_500 w_100">상품류</p>
                                            <div class="detail_text_wrap">
                                                <p class="detail_text">
                                                    <span>제10류, 제15류, 제3류, 제22류,제10류, 제15류, 제3류, 제10류</span>
                                                </p>
                                                <span class="text_more fc_primary p-0 fs_15 fw_400 text-underline">더보기</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report_top 끝-->


                    <!-- 진행 상황 시작 -->
                    <div class="application_process mb_50">
                        <h3 class="sub_tit2">진행 상황</h3>

                        <p class="fs_17 fc_gr222 fw_500 mb_10">출원 준비 <span class="fc_primary">2차 수정요청</span></p>
                        <div class="bg-wh border rounded p_20 mb_22">
                            <p class="wh_pre fs_15 fc_gr444">출원하실 상표에 상품류가 20개를 초가하여 추가 금액을 결제하셔야합니다.
                                결제와 동시에 출원보고서에 수정사항이 있을 시 하단 입력란에 작성해주세요.
                                없을 시 ‘수정사항이 없습니다’ 를 선택하고 결제 및 동의 버튼을 눌러주세요.
                            </p>
                        </div>

                        <div class="d-flex justify-content-center mb_22">
                            <button type="button" class="btn btn-primary btn-md btn_style03">보고서 저장</button>
                        </div>

                        <div class="ip_wr">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>출원보고서 수정사항</h5>
                            </div>
                            <div class="input-group">
                                <textarea class="form-control" placeholder="출원보고서 수정할 내용을 입력하세요" id="exampleFormControlTextarea1" rows="5"></textarea>
                            </div>
                            <div class="checks mt_10">
                                <input type="checkbox" name="ff" id="f1" checked="">
                                <label for="f1">수정사항 이 없습니다.</label>
                            </div>
                        </div>


                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-primary btn-md btn_style03" type="button" onclick="location.href='pending_application_payment.php'">결제 및 동의</button>
                        </div>

                    </div>
                    <!-- 진행 상황 끝 -->

                    <div class="process_information">
                        <div class='info-tit'>진행 내역<div class='expand'></div>
                        </div>
                        <div class='info_cont info_cont2'>
                            <ul>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <p class="fs_18 fw_600 fc_gr222 mr-2">출원준비 - 추가 상품</p>
                                        <span class="fc_graaa">(2021.09.05)</span>
                                    </div>
                                    <ul class="info_list">
                                        <li>
                                            <p class="fw_500 fc_gr222 w_150">추가 지정상품</p>
                                            <p class="fs_15">제3류 패션/뷰티</p>
                                        </li>
                                        <li>
                                            <p class="fw_500 fc_gr222 w_150">보고서</p>
                                            <p class="fs_15 a_link"><a href="" class="fc_primary">지정상품 보고서.pdf</a></p>
                                        </li>
                                        <li class="align-items-start">
                                            <p class="fw_500 fc_gr222 w_150">1차 수정 요청사항</p>
                                            <p class="fs_15 wh_pre">2페이지에 문구 수정 부탁드립니다. 2페이지에 문구 수정 부탁드립니다.
                                                2페이지에 문구 수정 부탁드립니다. 2페이지에 문구 수정 부탁드립니다.</p>
                                        </li>
                                        <li>
                                            <p class="fw_500 fc_gr222 w_150">결제금액</p>
                                            <p class="fs_15">1,360,000원</p>
                                        </li>
                                        <li>
                                            <p class="fw_500 fc_gr222 w_150">결제 수단</p>
                                            <p class="fs_15">신용카드</p>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <p class="fs_18 fw_600 fc_gr222 mr-2">결제 완료</p>
                                        <span class="fc_graaa">(2021.09.05)</span>
                                    </div>
                                    <ul class="info_list">
                                        <li>
                                            <p class="fw_500 fc_gr222 w_150">결제 금액</p>
                                            <p class="fs_15">1,360,000원</p>
                                        </li>
                                        <li>
                                            <p class="fw_500 fc_gr222 w_150">결제 수단</p>
                                            <p class="fs_15">신용카드</p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class='info-tit mt_50'>결제정보<div class='expand'></div>
                        </div>
                        <div class='info_cont'>
                            <ul class="ic_pay">
                                <li>
                                    <p class="fs_20 fc_gr222 fw_600 mb_10">상표권 출원 진행</p>
                                    <div class="bg_lgr rounded-lg p_25_20 pay-info">
                                        <ul class="payment_list">
                                            <li>
                                                <p class="fw_500 fc_gr222 mr-2">총 출원 수수료</p>
                                                <p class="fw_500">10,000원</p>
                                            </li>
                                            <li>
                                                <p class="fw_500 fc_gr222 mr-2">VAT</p>
                                                <p class="fw_500">1,000원</p>
                                            </li>
                                            <li>
                                                <p class="fw_500 fc_gr222 mr-2">특허청 관납료</p>
                                                <p class="fw_500">20,000원</p>
                                            </li>
                                            <li>
                                                <p class="fw_500 fc_gr222 mr-2">포인트 할인</p>
                                                <p class="fw_500">0원</p>
                                            </li>
                                        </ul>
                                        <div class="payment">
                                            <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                            <p class="fs_24 fc_bdk fw_600">1,360,000원</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <p class="fs_20 fc_gr222 fw_600 mb_10">출원준비 - 추가상품 </p>
                                    <div class="bg_lgr rounded-lg p_25_20 pay-info">
                                        <ul class="payment_list">
                                            <li>
                                                <p class="fw_500 fc_gr222 mr-2">총 출원 수수료</p>
                                                <p class="fw_500">10,000원</p>
                                            </li>
                                            <li>
                                                <p class="fw_500 fc_gr222 mr-2">VAT</p>
                                                <p class="fw_500">1,000원</p>
                                            </li>
                                            <li>
                                                <p class="fw_500 fc_gr222 mr-2">특허청 관납료</p>
                                                <p class="fw_500">20,000원</p>
                                            </li>
                                            <li>
                                                <p class="fw_500 fc_gr222 mr-2">포인트 할인</p>
                                                <p class="fw_500">0원 (할인코드 미사용)</p>
                                            </li>
                                        </ul>
                                        <div class="payment">
                                            <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                            <p class="fs_24 fc_bdk fw_600">31,000원</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- process_information 끝 -->



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

<script>
    $(document).ready(function() {
        $('.info-tit').mouseenter(function() {
            $(this).children('.expand').addClass('turn');
        });
        $('.info-tit').mouseleave(function() {
            if ($(this).hasClass('open')) {} else {
                $(this).children('.expand').removeClass('turn');
            }
        });
        $('.info-tit').click(function() {
            var $this = $(this);
            if ($this.hasClass('open')) {
                $('.info-tit').removeClass('open');
                $('.info_cont').stop(true).slideUp("fast");
                $('.expand').removeClass('turn');
                $this.removeClass('open');
                $this.children('.expand').removeClass('turn');
                $this.next().stop(true).slideUp("fast");
            } else {
                $('.info-tit').removeClass('open');
                $('.info_cont').stop(true).slideUp("fast");
                $('.expand').removeClass('turn');

                $this.addClass('open');
                $this.children('.expand').addClass('turn');
                $this.next().stop(true).slideDown("fast");
            }
        });
    });
</script>



<script>
    //더보기, 접기 버튼
    $('.detail_text_wrap .text_more').on('click', function() {
        let textHeight = $('.detail_text span').outerHeight();
        if ($(this).prev().height() <= 22) {
            $(this).prev().animate({
                'overflow': 'unset',
                'height': textHeight
            });
            $(this).text('접기');
        } else {
            $(this).prev().animate({
                'overflow': 'hidden',
                'height': '22px'
            });
            $(this).text('더보기');
        }
    });
</script>
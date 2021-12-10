<? include_once("./inc/head.php"); ?>
<div class="sub_pg application_domestic">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <form>
                <div class="division d-block d-xl-flex justify-content-between">
                    <div class="w-65">
                        <h2 class="sub_tit">상표출원하기</h2>

                        <!-- 상표출원 단계 -->
                        <div class="step d-flex flex-wrap mb_15">
                            <button class="btn btn-outline-secondary btn-md mr_8">1. 상표정보 입력</button>
                            <button class="btn btn-outline-primary btn-md mr_8">2. 상품분류 및 서비스 선택</button>
                            <button class="btn btn-outline-secondary btn-md mr_8">3. 상표 권리자 정보 등록</button>
                            <button class="btn btn-outline-secondary btn-md">4. 최종 확인 및 결제</button>
                        </div>
                        <!-- 상표출원 단계 끝-->


                        <!-- 상표출원 임시저장 -->
                        <div class="d-flex align-items-center bg-light rounded p_15_20 justify-content-between mb_50">
                            <div class="d-flex mr-3">
                                <i class=" xi-info-o fc_primary fs_19 mr_8 mt-1"></i></i>
                                <p class="fc_primary">임시저장하여 나중에 돌아오실때 저장 되었던 곳에서 진행하세요.</p>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm">임시저장</button>
                        </div>
                        <!-- 상표출원 임시저장 끝 -->



                        <h3 class="sub_tit2">상품 · 서비스 카테고리 선택</h3>
                        <div class="category_type mb_50">
                            <!-- 선택 라디오,체크박스 -->
                            <div class="select d-flex flex-wrap justify-content-between">
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b1">
                                    <label for="b1">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon01.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>요식업/식음료</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b2">
                                    <label for="b2">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon02.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>의류/패션/쇼핑몰</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b3">
                                    <label for="b3">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon03.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>뷰티/미용/화장품</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b4">
                                    <label for="b4">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon04.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>의료/제약/복지</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b5">
                                    <label for="b5">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon05.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>여행/스포츠/취미</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b6">
                                    <label for="b6">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon06.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>교육/엔터테인먼트/유튜브</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b7">
                                    <label for="b7">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon07.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>생활/편의서비스</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b8">
                                    <label for="b8">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon08.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>생활용품/가구/가전제품</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b9">
                                    <label for="b9">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon09.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>출산/유아동</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b10">
                                    <label for="b10">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon10.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>반려/애완용품</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b11">
                                    <label for="b11">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon11.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>차량/오토</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b12">
                                    <label for="b12">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon12.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>인테리어, 건축, 부동산</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b13">
                                    <label for="b13">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon13.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>과학, 환경/법률</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b14">
                                    <label for="b14">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon14.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>IT/플랫폼/APP</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-33">
                                    <input type="radio" name="bb" id="b15">
                                    <label for="b15">
                                        <div class="d-flex align-items-center">
                                            <img src="./img/ca_icon15.png" alt="" class="category_img mr_20">
                                            <div>
                                                <p>전체</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>

                            </div>
                            <!-- 선택 라디오,체크박스 끝-->
                        </div>
                        <!-- 상품 · 서비스 카테고리 선택 끝 -->

                        <h3 class="sub_tit2">분류 선택</h3>
                        <div class="classification_type mb_50">
                            <!-- 선택 라디오,체크박스 -->
                            <div class="select d-flex flex-wrap justify-content-between">
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c1">
                                    <label for="c1">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제01류</p>
                                            <p>화학제품,비료,코팅제,비닐 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c2">
                                    <label for="c2">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제02류</p>
                                            <p>페인트,래커,잉크,염료 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c3">
                                    <label for="c3">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제03류</p>
                                            <p>화장품,향수,디퓨저,세면용품,세제 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c4">
                                    <label for="c4">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제04류</p>
                                            <p>양초, 향초, 램프 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c5">
                                    <label for="c5">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제05류</p>
                                            <p>화학제품,비료,코팅제,비닐 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c6">
                                    <label for="c6">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제06류</p>
                                            <p>페인트,래커,잉크,염료 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c7">
                                    <label for="c7">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제07류</p>
                                            <p>화장품,향수,디퓨저,세면용품,세제 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c8">
                                    <label for="c8">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제08류</p>
                                            <p>양초, 향초, 램프 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c9">
                                    <label for="c9">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제09류</p>
                                            <p>화학제품,비료,코팅제,비닐 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c10">
                                    <label for="c10">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제10류</p>
                                            <p>페인트,래커,잉크,염료 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c11">
                                    <label for="c11">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제11류</p>
                                            <p>화장품,향수,디퓨저,세면용품,세제 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c12">
                                    <label for="c12">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제12류</p>
                                            <p>양초, 향초, 램프 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c13">
                                    <label for="c13">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제13류</p>
                                            <p>화학제품,비료,코팅제,비닐 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c14">
                                    <label for="c14">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제14류</p>
                                            <p>페인트,래커,잉크,염료 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c15">
                                    <label for="c15">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제15류</p>
                                            <p>화장품,향수,디퓨저,세면용품,세제 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                                <div class="checks w-50">
                                    <input type="checkbox" name="cc" id="c16">
                                    <label for="c16">
                                        <div class="d-block d-sm-flex align-items-center">
                                            <p class="mr-3 fc_gr999">제16류</p>
                                            <p>양초, 향초, 램프 제품 이름</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <!-- 선택 라디오,체크박스 끝-->
                        </div>
                        <!-- 분류 선택 끝 -->


                        <h3 class="sub_tit2">서비스 선택</h3>
                        <div class="service_type mb_22">
                            <div class="select d-flex flex-wrap justify-content-between">
                                <div class="service w-50">
                                    <div class="top bg-primary d-flex align-items-center justify-content-between fc_wh">
                                        <p class="fs_20 fw_500">간편출원</p>
                                        <p class="fs_26 fw_500">235,000</p>
                                    </div>
                                    <div class="bottom bottom2">
                                        <ul class="fs_15 mb_40">
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>고객의 비즈니스를 분석하여 적합한 지정상품을 선정하여 지정상품 분석 보고서 제공</p>
                                            </li>
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>동일 선출원 또는 선등록 상표의 존재여부 확인</p>
                                            </li>
                                        </ul>
                                        <button type="button" class="btn btn-secondary btn-md btn-block" checks>선택</button>
                                    </div>
                                </div>
                                <div class="service w-50">
                                    <div class="top bg-primary d-flex align-items-center justify-content-between fc_wh">
                                        <p class="fs_20 fw_500">전문출원</p>
                                        <p class="fs_26 fw_500">235,000</p>
                                    </div>
                                    <div class="bottom bottom2">
                                        <ul class="fs_15 mb_40">
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>고객의 비즈니스를 분석하여 적합한 지정상품을 선정하여 지정상품 분석 보고서 및 상표 등록가능성 보고서 제공</p>
                                            </li>
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>동일 또는 유사한 선출원 또는 선등록상표의 존재 여부 확인</p>
                                            </li>
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>상표의 식별력 존부 검토</p>
                                            </li>
                                        </ul>
                                        <button type="button" class="btn btn-secondary btn-md btn-block">선택</button>
                                    </div>
                                </div>
                                <div class="service w-50">
                                    <div class="top bg_bdk d-flex align-items-center justify-content-between fc_wh">
                                        <p class="fs_20 fw_500">간편신속출원</p>
                                        <p class="fs_26 fw_500">235,000</p>
                                    </div>
                                    <div class="bottom">
                                        <ul class="fs_15 mb_40">
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>간편출원시에 우선심사를 신청하여 심사기간을 약 4개월로 단축</p>
                                            </li>
                                        </ul>
                                        <button type="button" class="btn btn-secondary btn-md btn-block">선택</button>
                                    </div>
                                </div>
                                <div class="service w-50">
                                    <div class="top bg_bdk d-flex align-items-center justify-content-between fc_wh">
                                        <p class="fs_20 fw_500">전문신속출원</p>
                                        <p class="fs_26 fw_500">235,000</p>
                                    </div>
                                    <div class="bottom">
                                        <ul class="fs_15 mb_40">
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>간편출원시에 우선심사를 신청하여 심사기간을 약 4개월로 단축</p>
                                            </li>
                                        </ul>
                                        <button type="button" class="btn btn-secondary btn-md btn-block">선택</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 서비스 선택 끝-->

                        <div class="btn_group d-none d-md-flex justify-content-center">
                            <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="location.href='application_domestic_step1.php'">이전으로</button>
                            <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_domestic_step3.php'">다음으로</button>
                        </div>

                    </div>
                    <!-- w-65 끝-->



                    <!-- w-30 시작-->
                    <div class="w-30 h-80 aside">
                        <div class="aside_scroll">
                            <h3 class="sub_tit2 fc_bdk">상표유형 선택</h3>
                            <ul class="select_product_list mb_15">
                                <li>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="fs_17 fc_gr222 fw_500">간편출원</p>
                                        <a href=""><i class="xi-close fs_18 fc_grccc"></i></a>
                                    </div>
                                    <p>00류 : 음식점, 카페, 베이커리, 주점</p>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="fs_17 fc_gr222 fw_500">전문출원</p>
                                        <i class="xi-close fs_18 fc_grccc"></i>
                                    </div>
                                    <p>00류 : 생활/편의서비스</p>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="fs_17 fc_gr222 fw_500">간편출원</p>
                                        <i class="xi-close fs_18 fc_grccc"></i>
                                    </div>
                                    <p>00류 : 페인트,래커,잉크,염료 제품 이름</p>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="fs_17 fc_gr222 fw_500">간편출원</p>
                                        <i class="xi-close fs_18 fc_grccc"></i>
                                    </div>
                                    <p>00류 : 페인트,래커,잉크,염료 제품 이름</p>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="fs_17 fc_gr222 fw_500">간편출원</p>
                                        <i class="xi-close fs_18 fc_grccc"></i>
                                    </div>
                                    <p>00류 : 페인트,래커,잉크,염료 제품 이름</p>
                                </li>
                            </ul>

                            <button type="button" class="btn btn-outline-primary btn-sm btn-block mb_40">전체삭제</button>

                            <h3 class="sub_tit2 fc_bdk">결제금액</h3>
                            <div class="bg-wh rounded-lg p_25_20">
                                <ul class="payment_list">
                                    <li>
                                        <div class="d-flex align-items-center mr-3">
                                            <p class="fw_500 fc_gr222 mr-2">간편출원</p>
                                            <p class="fc_grccc">X2</p>
                                        </div>
                                        <p class="fw_500">742,000원</p>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center mr-3">
                                            <p class="fw_500 fc_gr222 mr-2">전문출원</p>
                                            <p class="fc_grccc">X1</p>
                                        </div>
                                        <p class="fw_500">742,000원</p>
                                    </li>
                                    <li>
                                        <div class="d-flex align-items-center mr-3">
                                            <p class="fw_500 fc_gr222 mr-2">간편신속출원</p>
                                            <p class="fc_grccc">X1</p>
                                        </div>
                                        <p class="fw_500">350,000원</p>
                                    </li>
                                </ul>
                                <div class="border_bk mb_20"></div>
                                <div class="payment">
                                    <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                    <p class="fs_24 fc_bdk fw_600">1,630,000원</p>
                                </div>
                            </div>

                            <div class="btn_group d-flex d-md-none justify-content-center mt-5 mt-md-0">
                                <button type="button" class="btn btn-secondary btn-md btn_style03 mr-2 mr-md-3" onclick="location.href='application_domestic_step1.php'">이전으로</button>
                                <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_domestic_step3.php'">다음으로</button>
                            </div>
                        </div>
                    </div>
                    <!-- w-30 끝-->
                    <!-- division 끝 / 서브페이지 영역 2분할 -->

            </form>


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
                $(".aside").css('top', 'auto'); //fixed top 성질을 없애고
                $(".aside").css('bottom', curSc - bottom_top + 150); //fixed bottom 을 줍니다.
            } else {
                $(".aside").css('top', hd_height + 60); // 그렇지않으면 상단에 고정되게 합니다.
            }
        }
        resize();
    })
</script>
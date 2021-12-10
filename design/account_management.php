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
                        <li><a href="./account_management.php" class="active">계정관리</a></li>
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
                    <h2 class="sub_tit">계정 관리</h2>

                    <h2 class="sub_tit2">현재 계정 정보</h2>

                    <div class="bg-light rounded p_20_25 mb_22">
                        <div class="d-flex align-items-center mb_8">
                            <p class="fc_gr222 fw_500 w_140">아이디 (이메일)</p>
                            <p class="fs_15">honggil123@gmail.com</p>
                        </div>
                        <div class="d-flex align-items-center mb_8">
                            <p class="fc_gr222 fw_500 w_140">성명</p>
                            <p class="fs_15">홍길동</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <p class="fc_gr222 fw_500 w_140">할인코드</p>
                            <p class="fs_15">HON1654</p>
                        </div>
                    </div>

                    <div class="ip_wr col-md-6 pr-0 pr-md-2">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>현재 비밀번호</h5>
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control mr-0" placeholder="현재 비밀번호를 입력해주세요">
                            <button class="pw pw_off"></button>
                            <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="ip_wr col-md-6">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>새 비밀번호</h5>
                            </div>
                            <div class="input-group">
                                <input type="password" class="form-control mr-0" placeholder="새 비밀번호를 입력해주세요">
                                <button class="pw pw_off"></button>
                                <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                            </div>
                        </div>
                        <div class="ip_wr col-md-6">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>새 비밀번호 재입력</h5>
                            </div>
                            <div class="input-group">
                                <input type="password" class="form-control mr-0" placeholder="새 비밀번호를 재입력해주세요">
                                <button class="pw pw_off"></button>
                                <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                            </div>
                            <p class="text-danger mt_10 fs_14">비밀번호가 일치하지 않습니다.</p>
                        </div>
                    </div>

                    <div class="form-row pb_30 br_bottom mb_50">
                        <div class="ip_wr col-md-6">
                            <div class="ip_tit d-flex align-items-center d-flex mb-3">
                                <h5>이메일</h5>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="이메일을 입력하세요">
                            </div>
                            <p class="mt_10 fs_14">현재 사용하시는 이메일 대신 사용하고 싶은 이메일은 입력해주세요.</p>
                        </div>
                        <div class="ip_wr col-md-6">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>휴대전화 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요">
                            </div>
                        </div>
                    </div>

                    <h2 class="sub_tit2">환불계좌 정보</h2>

                    <div class="ip_wr col-md-6">
                        <div class="ip_tit d-flex align-items-center d-flex mb-3">
                            <h5>예금주</h5>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="홍길동">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="ip_wr col-md-6 pr-0 pr-md-2">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>은행명</h5>
                            </div>
                            <div class=" input-group">
                                <select class="custom-select" id="inputGroupSelect01">
                                    <option selected="">NH 농협</option>
                                    <option value="1">우리은행</option>
                                    <option value="2">부산은행</option>
                                </select>
                            </div>
                        </div>
                        <div class="ip_wr col-md-6">
                            <div class="ip_tit d-flex align-items-center d-flex mb-3">
                                <h5>계좌번호</h5>
                            </div>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="000-0000-0000-00">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mb_50">
                        <button type="button" class="btn btn-primary btn-md btn_style03">수정 완료</button>
                    </div>

                    <div class="border_bk mb_50"></div>
                    <h2 class="sub_tit2">회원탈퇴</h2>

                    <div class="bg-light rounded p_20_25 mb_22">
                        <ul class="fs_15">
                            <li class="d-flex"><span class="flex-shrink-0 mr-2 fc_primary">※</span>
                                <p class="fc_primary">회원탈퇴 시, 닥터마크 홈페이지 사용에 제한을 받습니다.</p>
                            </li>
                        </ul>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='member_secession.php'">탈퇴하기</button>
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
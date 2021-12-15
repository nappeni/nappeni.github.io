<? include_once("./inc/head.php"); ?>
<div class="sub_pg application_domestic">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <form>
                <div class="division d-block d-xl-flex justify-content-between align-items-start">
                    <div class="w-65">
                        <h2 class="sub_tit">상표출원하기</h2>

                        <!-- 상표출원 단계 -->
                        <div class="step d-flex flex-wrap mb_15">
                            <button class="btn btn-outline-secondary btn-md mr_8">1. 상표정보 입력</button>
                            <button class="btn btn-outline-secondary btn-md mr_8">2. 상품분류 및 서비스 선택</button>
                            <button class="btn btn-outline-primary btn-md mr_8">3. 상표 권리자 정보 등록</button>
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



                        <h3 class="sub_tit2">담당자 정보</h3>
                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>담당자명 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="담당자 이름을 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="이메일을 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row mb_50">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>휴대전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>유선 전화번호 <span class="fc_gr666 fw_300 fs_16">(선택)</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="이메일을 입력하세요">
                                </div>
                            </div>
                        </div>


                        <h3 class="sub_tit2">출원인 정보</h3>
                        <div class="input-group br_bottom pb_15 mb_22">
                            <div class="checks mr-5">
                                <input type="radio" name="dd" id="d1">
                                <label for="d1">담당자 정보와 동일</label>
                            </div>
                            <div class="checks">
                                <input type="radio" name="dd" id="d2">
                                <label for="d2">공동출원</label>
                                <i class="xi-help fs_19 fc_graaa"></i>
                            </div>
                        </div>


                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>출원유형 <span class="fc_primary">*</span></h5>
                        </div>
                        <div class="input-group mb_22">
                            <div class="input-group-prepend">
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="ee" id="e1">
                                    <label for="e1">국내개인</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="ee" id="e2">
                                    <label for="e2">국내법인</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="ee" id="e3">
                                    <label for="e3">외국개인</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="ee" id="e4">
                                    <label for="e4">외국법인</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0">
                                    <input type="radio" name="ee" id="e5">
                                    <label for="e5">국가기관</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인명 (한글) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="출원인명 한글로 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인명 (영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="출원인명 영문으로 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6 mb-3 mb-md-4">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 주민 등록번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="주민 등록번호 앞자리 6자리">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit align-items-center d-none d-md-flex mb-3 fc_wh">
                                    <h5 class="fc_wh">출원인 주민 등록번호 <span class="fc_wh">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="주민 등록번호 뒷자리 7자리">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="이메일을 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 휴대전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 유선전화 <span class="fc_gr666 fw_300 fs_16">(선택)</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요">
                                </div>
                            </div>
                        </div>


                        <div class="ip_wr mb_50">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>출원인 등본상 주소 <span class="fc_primary">*</span></h5>
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

                        <div class="border_bk mb_50"></div>

                        <h3 class="sub_tit2">법정 대리인 정보</h3>

                        <div class="input-group br_bottom pb_15 mb_22">
                            <div class="checks mr-5">
                                <input type="checkbox" name="ff" id="f1">
                                <label for="f1">법정 대리인 필요<p class="fs_14 fc_gr999 mt-2">※ 만 n세 이하의 미성년자는 특허법상 독립적으로 출원을 진행할 수 없습니다. (특허법 3조)</p></label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 성명(한글) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="법정 대리인 성명 한글로 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 성명(영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="법정 대리인 성명 영문으로 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6 mb-3 mb-md-4">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 주민 등록번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="법정 대리인 주민 등록번호 앞자리 6자리">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit align-items-center d-none d-md-flex mb-3 fc_wh">
                                    <h5 class="fc_wh">법정 대리인 주민 등록번호 <span class="fc_wh">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="법정 대리인 주민 등록번호 뒷자리 7자리">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="이메일을 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 휴대전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 유선전화 <span class="fc_gr666 fw_300 fs_16">(선택)</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="ip_wr mb_50">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>법정 대리인 등본상 주소 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" placeholder="우편번호">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-md" type="button">주소 찾기</button>
                                </div>
                            </div>
                            <input type="text" class="form-control mb_8" placeholder="도로명/ 지번 주소">
                            <input type="text" class="form-control" placeholder="상세주소 입력">
                        </div>

                        <div class="ip_wr">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>주민등록등본 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" placeholder="파일명은 ‘띄어쓰기 없이 영문’으로 첨부 해주세요. 선택 최대용량: 20MB">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-md" type="button">파일 첨부</button>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb_50">
                            <div class="input-group d-inline w-auto">
                                <div class="checks mr-3">
                                    <input type="checkbox" name="gg" id="g1">
                                    <label for="g1" class="d-flex">(필수) 법정대리인 위임장 동의</label>
                                </div>
                            </div>
                            <a class="fc_primary mt_2 a_link" data-toggle="modal" data-target="#v_con_wiim">자세히 보기</a>

                            <div class="modal fade" id="v_con_wiim" tabindex="-1" aria-labelledby="v_con_wiimLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header align-items-center">
                                            <h5 class="modal-title" id="v_con_wiimLabel">비밀번호 찾기</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <!-- <span aria-hidden="true">&times;</span> -->
                                                <i class="xi-close fs_36 fc_grccc"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <p class="mt_50 mb_35 fs_18">성공적으로 <span class="fw_500 fc_gr444">비밀번호가 변경</span>이 되었습니다.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                            <button type="button" class="btn btn-primary btn-lg btn-block">확인</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border_bk mb_50"></div>

                        <h3 class="sub_tit2">결제 정보</h3>

                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>결제수단 <span class="fc_primary">*</span></h5>
                        </div>
                        <div class="input-group mb_22">
                            <div class="input-group-prepend">
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="ee" id="e1" checked>
                                    <label for="e1">무통장 입금</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="ee" id="e2">
                                    <label for="e2">신용카드</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="ee" id="e3">
                                    <label for="e3">네이버 페이</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0">
                                    <input type="radio" name="ee" id="e4">
                                    <label for="e4">카카오페이</label>
                                </div>
                            </div>
                        </div>

                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>영수증 발행</h5>
                        </div>
                        <div class="input-group mb_22">
                            <div class="input-group-prepend">
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="ee" id="e1" checked>
                                    <label for="e1">세금계산서 발행</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="ee" id="e2">
                                    <label for="e2">현금영수증</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0">
                                    <input type="radio" name="ee" id="e3">
                                    <label for="e3">발행안함</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>상호명</h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="상호명을 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>사업자등록번호</h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="사업자등록번호를 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>대표자명</h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="대표자명을 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>이메일</h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="이메일을 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="사업자등록증">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>주민등록등본 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" placeholder="파일명은 ‘띄어쓰기 없이 영문’으로 첨부 해주세요. 선택 최대용량: 20MB">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-md" type="button">파일 첨부</button>
                                </div>
                            </div>
                        </div>


                        <!-- 이용약관-->
                        <div class="ip_wr">
                            <div class="border rounded bg-light p_30_20">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>이용약관 및 위임 동의</h5>
                                </div>
                                <div class="checks ml_25 mb-3">
                                    <input type="checkbox" name="ll" id="l1">
                                    <label for="l1">(필수) 개인정보 활용에 동의합니다.</label>
                                </div>
                                <div class="checks ml_25 mb-3">
                                    <input type="checkbox" name="ll" id="l2">
                                    <label for="l2">(필수) 상표출원 관련 업무에 대해 마크 인포에 위임할 것을 동의합니다.</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="checks ml_25 d-inline w-auto mr-3">
                                        <input type="checkbox" name="ll" id="l3">
                                        <label for="l3">(선택) 마케팅 활용에 동의합니다.</label>
                                    </div>
                                    <a class="fc_primary mt_2 a_link" data-toggle="modal" data-target="#v_con_marketing">자세히 보기</a>

                                    <div class="modal fade" id="v_con_marketing" tabindex="-1" aria-labelledby="v_con_marketingLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header align-items-center">
                                                    <h5 class="modal-title" id="v_con_marketingLabel">마케팅 활용</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <!-- <span aria-hidden="true">&times;</span> -->
                                                        <i class="xi-close fs_36 fc_grccc"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <div class="mt_50 mb_35 fs_18">
                                                        <?
                                                        $sqlz = "select st_agree3 from setup_t ";
                                                        $rowz = $DB->fetch_assoc($sqlz);
                                                        echo $rowz['st_agree3'];
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                    <button type="button" class="btn btn-primary btn-lg btn-block">확인</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- 이용약관 끝-->



                        <div class="btn_group d-none d-md-flex justify-content-center">
                            <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="location.href='application_domestic_step2.php'">이전으로</button>
                            <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_domestic_final.php'">결제하기</button>
                        </div>

                    </div>
                    <!-- w-65 끝-->



                    <!-- w-30 시작-->
                    <div class="w-30 h-80 aside">
                        <div class="aside_scroll">
                            <h3 class="sub_tit2 fc_bdk">선택 상품류 목록</h3>
                            <ul class="select_product_list mb_40 h-auto">
                                <li>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="fs_17 fc_gr222 fw_500">간편출원</p>
                                    </div>
                                    <p>00류 : 음식점, 카페, 베이커리, 주점</p>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="fs_17 fc_gr222 fw_500">전문출원</p>
                                    </div>
                                    <p>00류 : 생활/편의서비스</p>
                                </li>
                                <li>
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="fs_17 fc_gr222 fw_500">간편출원</p>
                                    </div>
                                    <p>00류 : 페인트,래커,잉크,염료 제품 이름</p>
                                </li>
                            </ul>

                            <h3 class="sub_tit2 fc_bdk">결제금액</h3>
                            <div class="bg-wh rounded-lg p_25_20 mb_22">
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

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>포인트 사용</h5>
                                </div>
                                <div class="input-group mb_10">
                                    <input type="text" class="form-control" placeholder="사용할 포인트를 입력하세요">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-md" type="button">전체사용</button>
                                    </div>
                                </div>
                                <p class="fs_14">보유중인 포인트 : 1000원</p>
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>할인코드</h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="할인코드를 입력하세요">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-sm" type="button">등록하기</button>
                                    </div>
                                </div>
                            </div>


                            <div class="pay_fin">
                                <div class="bg-wh rounded-lg p_25_20 br_primary">
                                    <ul class="payment_list">
                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2">주문금액</p>
                                            </div>
                                            <p class="fw_500">1,630,000원</p>
                                        </li>
                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2">할인율 차감</p>
                                            </div>
                                            <p class="fw_500">- 81,500 (5%)원</p>
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
                                            <p class="fw_500">- 82,500원</p>
                                        </li>
                                    </ul>
                                    <div class="border_bk mb_20 bg_gre9"></div>
                                    <div class="payment">
                                        <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                        <p class="fs_24 fc_bdk fw_600">1,547,500원</p>
                                    </div>
                                </div>
                            </div>



                            <div class="btn_group d-flex d-md-none justify-content-center mt-5 mt-md-0">
                                <button type="button" class="btn btn-secondary btn-md btn_style03 mr-2 mr-md-3" onclick="location.href='application_domestic_step2.php'">이전으로</button>
                                <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_domestic_final.php'">결제하기</button>
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
<? include_once("./inc/head.php"); ?>
<div class="sub_pg">
    <div class="container-fluid px-0">
        <div class="container-xl ">
            <div class="container01 mx-auto">

                <h2 class="sub_tit">상표출원하기</h2>

                <!-- 상표출원 단계 -->
                <div class="step d-flex flex-wrap mb_15">
                    <button class="btn btn-outline-primary btn-md mr_8">1. 상표정보 입력</button>
                    <button class="btn btn-outline-secondary btn-md mr_8">2. 상품분류 및 서비스 선택</button>
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

                <form>
                    <h3 class="sub_tit2">상표유형 선택</h3>

                    <!-- 상표유형 라디오 선택 -->
                    <div class="trademark_type mb_20">
                        <!-- 선택 라디오,체크박스 -->
                        <div class="select d-flex flex-wrap justify-content-between">
                            <div class="checks w-50">
                                <input type="radio" name="exampleRadios" id="aa">
                                <label for="aa">
                                    <div class="d-flex align-items-center align-items-md-start">
                                        <img src="./img/trademark_type1.png" alt="" class="type_img mr_20">
                                        <div>
                                            <p class="fs_18 fw_600 fc_gr222 mb-2 mt-3">문자 상표</p>
                                            <p>폰트, 캘리그라피 등 텍스트형의 상표로 이루어집니다.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="checks w-50">
                                <input type="radio" name="exampleRadios" id="a2">
                                <label for="a2">
                                    <div class="d-flex align-items-center align-items-md-start">
                                        <img src="./img/trademark_type2.png" alt="" class="type_img mr_20">
                                        <div>
                                            <p class="fs_18 fw_600 fc_gr222 mb-2 mt-3">도형 상표</p>
                                            <p>도형을 사용하실 경우 선택해주세요.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="checks w-50">
                                <input type="radio" name="exampleRadios" id="a3">
                                <label for="a3">
                                    <div class="d-flex align-items-center align-items-md-start">
                                        <img src="./img/trademark_type3.png" alt="" class="type_img mr_20">
                                        <div>
                                            <p class="fs_18 fw_600 fc_gr222 mb-2 mt-3">복합 상표</p>
                                            <p>문자와 도형이 이루어진 경우 선택해주세요.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="checks w-50">
                                <input type="radio" name="exampleRadios" id="a4">
                                <label for="a4">
                                    <div class="d-flex align-items-center align-items-md-start">
                                        <img src="./img/trademark_type4.png" alt="" class="type_img mr_20">
                                        <div>
                                            <p class="fs_18 fw_600 fc_gr222 mb-2 mt-3">기타</p>
                                            <p>어떤 유형인지 결정을 못하실 경우 선택해주세요.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <!-- 선택 라디오,체크박스 끝-->
                    </div>
                    <!-- 상표유형 라디오 선택 끝-->


                    <div class="ip_wr mb_50">
                        <div class="ip_tit mb-3">
                            <h5>상표 이미지 첨부 <span class="fw_300 fc_gr666">(선택)</span></h5>
                        </div>
                        <ul class="mb-3 fs_15">
                            <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                <p>최대 20 MB 용량의 jpg, png 파일을 첨부하실 수 있습니다.</p>
                            </li>
                            <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                <p>400px x 400px의 흰 바탕의 이미지 파일을 올려주세요</p>
                            </li>
                        </ul>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Choose file...">
                            <div class="input-group-append">
                                <button class="btn btn-secondary btn-md" type="button">파일 첨부</button>
                            </div>
                        </div>
                    </div>


                    <h3 class="sub_tit2">상표·서비스 소개</h3>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex mb-3">
                            <h5>1. 현재 해당 상표는 상품 및 서비스에 사용중인가요?</h5>
                        </div>
                        <div class="input-group-prepend">
                            <div class="checks mr_30">
                                <input id="rd1" name="rd" type="radio">
                                <label for="rd1">예</label>
                            </div>
                            <div class="checks">
                                <input id="rd2" name="rd" type="radio">
                                <label for="rd2">아니오</label>
                            </div>
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>2. 상표 등록 시 제품 및 서비스에 대해 설명해주세요. </h5>
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" placeholder="상표 등록 시 제품 및 서비스에 대해 설명해주세요." id="exampleFormControlTextarea1" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit mb-3">
                            <h5>3. 현재 진행중인 온라인 쇼핑몰이 있으시면 쇼핑몰의 링크를 입력해주세요. <span class="fw_300 fc_gr666">(선택)</span></h5>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="ex) www.naver.com">
                        </div>
                    </div>


                    <div class="btn_group d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_domestic_step2.php'">다음으로</button>
                    </div>


                </form>
            </div>
            <!-- container01-->
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->
<? include_once("./inc/tail.php"); ?>
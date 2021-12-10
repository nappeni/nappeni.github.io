<? include_once("./inc/head.php"); ?>
<div class="sub_pg application_domestic">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <form>
                <div class="division d-block d-xl-flex justify-content-between">
                    <div class="w-65">
                        <h2 class="sub_tit">해외상표 출원하기</h2>

                        <form>
                            <h3 class="sub_tit2">상표유형 선택</h3>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex mb-4">
                                    <h5>1. 출원하고자 하는 상표의 유형을 선택하세요.</h5>
                                </div>
                                <!-- 해외 상표유형 라디오 선택 -->
                                <div class="trademark_type2 mb_22 text-center">
                                    <!-- 선택 라디오,체크박스 -->
                                    <div class="select d-flex flex-wrap justify-content-between">
                                        <div class="checks w-50">
                                            <input type="radio" name="exampleRadios2" id="ab1">
                                            <label for="ab1">
                                                <p class="fs_18 fw_600 fc_gr222">모든 국가에 동일 상표 출원</p>
                                                <ul class="d-flex justify-content-center mt_20">
                                                    <li class="m-1"><img src="./img/mark1.png" alt=""></li>
                                                </ul>
                                            </label>
                                        </div>
                                        <div class="checks w-50 p_35_20">
                                            <input type="radio" name="exampleRadios2" id="ab2">
                                            <label for="ab2">
                                                <p class="fs_18 fw_600 fc_gr222">국가별 다른 상표 출원</p>
                                                <ul class="d-flex justify-content-center mt_20">
                                                    <li class="m-1"><img src="./img/mark1.png" alt=""></li>
                                                    <li class="m-1"><img src="./img/mark2.png" alt=""></li>
                                                    <li class="m-1"><img src=" ./img/mark3.png" alt=""></li>
                                                </ul>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- 선택 라디오,체크박스 끝-->
                                </div>
                                <!-- 상표유형 라디오 선택 끝-->
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>2. 상표의 색상을 선택하세요.</h5>
                                </div>
                                <div class="input-group-prepend">
                                    <div class="checks mr_30">
                                        <input type="radio" name="ac" id="ac1">
                                        <label for="ac1">흑백</label>
                                    </div>
                                    <div class="checks">
                                        <input type="radio" name="ac" id="ac2">
                                        <label for="ac2">컬러</label>
                                    </div>
                                </div>
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit mb-3">
                                    <h5>3. 출원하고자 하는 국가를 입력하세요.</h5>
                                </div>
                                <div class="d-flex">
                                    <div class="input-group mb_10">
                                        <div class="d-flex form_serch">
                                            <input class="form-control" type="search" placeholder="국가명 검색">
                                            <button class="btn serch_btn" type="submit" alt="검색"></button>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn_style04" type="button" data-toggle="modal" data-target="#country">국가 바로선택하기</button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="mb-3 fs_15">
                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                        <p>상표등록을 받고 싶은 국가의 이름을 검색 또는 직접 선택 할 수 있습니다.</p>
                                    </li>
                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                        <p>검색된 국가를 체크하여 선택하세요. (다중선택 가능)</p>
                                    </li>
                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                        <p>마드리드 미가입 국가는 개별 출원됩니다.</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="d-flex flex-wrap mb_50">
                                <button type="button" class="btn btn-secondary m-1">대한민국<i class="xi-close fc_grccc mt-2 ml_8"></i></button>
                                <button type="button" class="btn btn-secondary m-1">미국<i class="xi-close fc_grccc mt-2 ml_8"></i></button>
                                <button type="button" class="btn btn-secondary m-1">대한민국<i class="xi-close fc_grccc mt-2 ml_8"></i></button>
                                <button type="button" class="btn btn-secondary m-1">미국<i class="xi-close fc_grccc mt-2 ml_8"></i></button>
                                <button type="button" class="btn btn-secondary m-1">대한민국<i class="xi-close fc_grccc mt-2 ml_8"></i></button>
                                <button type="button" class="btn btn-secondary m-1">미국<i class="xi-close fc_grccc mt-2 ml_8"></i></button>
                            </div>

                            <div class="border_bk mb_50"></div>

                            <div class="d-flex align-items-center justify-content-between mb_22">
                                <div class="d-block d-sm-flex align-items-center">
                                    <h3 class="sub_tit2 mr_15 mb-2 mb-sm-0">분류 선택</h3>
                                    <p class="fc_primary">마우스를 위에 얹어보세요.</p>
                                </div>
                                <div class="num_cases">
                                    <p class="fs_14 fc_primary">총 3건 선택</p>
                                </div>
                            </div>

                            <div class="mb_22">
                                <!-- 선택 라디오,체크박스 -->
                                <div class="classification_type2 select d-flex flex-wrap text-center">
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da1">
                                        <label for="da1">
                                            <p>제 01류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>

                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da2">
                                        <label for="da2">
                                            <p>제 02류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da3">
                                        <label for="da3">
                                            <p>제 03류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da4">
                                        <label for="da4">
                                            <p>제 04류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da5">
                                        <label for="da5">
                                            <p>제 05류</p>
                                        </label>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da6">
                                        <label for="da6">
                                            <p>제 06류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da7">
                                        <label for="da7">
                                            <p>제 07류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da8">
                                        <label for="da8">
                                            <p>제 08류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da9">
                                        <label for="da9">
                                            <p>제 09류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da10">
                                        <label for="da10">
                                            <p>제 10류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da11">
                                        <label for="da11">
                                            <p>제 11류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da12">
                                        <label for="da12">
                                            <p>제 12류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da13">
                                        <label for="da13">
                                            <p>제 13류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da14">
                                        <label for="da14">
                                            <p>제 14류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da15">
                                        <label for="da15">
                                            <p>제 15류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da16">
                                        <label for="da16">
                                            <p>제 16류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da17">
                                        <label for="da17">
                                            <p>제 17류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da18">
                                        <label for="da18">
                                            <p>제 18류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da19">
                                        <label for="da19">
                                            <p>제 19류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da20">
                                        <label for="da20">
                                            <p>제 20류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da21">
                                        <label for="da21">
                                            <p>제 21류</p>
                                        </label>
                                        <p class="hover_type">페인트,래커,잉크,염료 제품</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da22">
                                        <label for="da22">
                                            <p>제 22류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da23">
                                        <label for="da23">
                                            <p>제 23류</p>
                                        </label>
                                        <p class="hover_type">의약제, 살균제, 제초제 제품 이름</p>
                                    </div>
                                    <div class="checks">
                                        <input type="checkbox" name="da" id="da24">
                                        <label for="da24">
                                            <p>제 24류</p>
                                        </label>
                                        <p class="hover_type">페인트,래커,잉크,염료 제품</p>
                                    </div>
                                </div>
                                <!-- 선택 라디오,체크박스 끝-->
                            </div>
                            <!-- 분류 선택 끝 -->


                            <div class=" btn_group d-flex justify-content-center mb_70 mb-md-0">
                                <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_overseas_step2.php'">다음으로</button>
                            </div>



                    </div>
                    <!-- w-65 끝-->


                    <!-- w-30 시작-->
                    <div class="w-30 aside2">
                        <img src="./img/aside2.png" alt="">
                    </div>
                    <!-- w-30 끝-->
                    <!-- division 끝 / 서브페이지 영역 2분할 -->


                </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->
<? include_once("./inc/tail.php"); ?>





<!-- 출원국가 선택 Modal -->
<div class="modal fade" id="country" tabindex="-1" aria-labelledby="exampleModalLabe" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">출원국가 선택</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="xi-close fs_36 fc_grccc"></i>
                </button>
            </div>
            <div class="modal-body">

                <!-- 중복선택시 팝업이 나오도록...
                 <button class="btn btn-primary btn_style04" type="button" data-toggle="modal" data-target="#duplicate">중복선택</button> 
                 #duplicate 모달 추가
                -->
                <h3 class="sub_tit2">아시아</h3>
                <div class="country_sec text-center mb_40">
                    <!-- 선택 라디오,체크박스 -->
                    <div class="select d-flex flex-wrap text-center">
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z1">
                            <label for="z1">
                                <p>네팔</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z2">
                            <label for="z2">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">몽골</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z3">
                            <label for="z3">
                                <p>미안마</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z4">
                            <label for="z4">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">대한민국</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z5">
                            <label for="z5">
                                <p>말레이시아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z6">
                            <label for="z6">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">베트남</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z7">
                            <label for="z7">
                                <p>인도네시아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z8">
                            <label for="z8">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">캄보디아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z9">
                            <label for="z9">
                                <p>파키스탄</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z10">
                            <label for="z10">
                                <p>미안마</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z11">
                            <label for="z11">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">대한민국</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z12">
                            <label for="z12">
                                <p>말레이시아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z13">
                            <label for="z13">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">베트남</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z14">
                            <label for="z14">
                                <p>인도네시아</p>
                            </label>
                        </div>
                    </div>
                    <!-- 선택 라디오,체크박스 끝-->
                </div>
                <!-- 아시아 국가 선택 끝 -->

                <h3 class="sub_tit2">유럽</h3>
                <div class="country_sec text-center m_50">
                    <!-- 선택 라디오,체크박스 -->
                    <div class="select d-flex flex-wrap text-center">
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz1">
                            <label for="zz1">
                                <p>네팔</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz2">
                            <label for="zz2">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">몽골</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz3">
                            <label for="zz3">
                                <p>미안마</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz4">
                            <label for="zz4">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">대한민국</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz5">
                            <label for="zz5">
                                <p>말레이시아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz6">
                            <label for="zz6">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">베트남</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz7">
                            <label for="zz7">
                                <p>인도네시아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz8">
                            <label for="zz8">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">캄보디아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz9">
                            <label for="zz9">
                                <p>파키스탄</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz10">
                            <label for="zz10">
                                <p>미안마</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz11">
                            <label for="zz11">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">대한민국</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz12">
                            <label for="zz12">
                                <p>말레이시아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz13">
                            <label for="zz13">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">베트남</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz14">
                            <label for="zz14">
                                <p>인도네시아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz15">
                            <label for="zz15">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">캄보디아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz16">
                            <label for="zz16">
                                <p>파키스탄</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="zz17">
                            <label for="zz17">
                                <p><img src="./img/m_icon.png" alt="" class="d-inline mr-3">캄보디아</p>
                            </label>
                        </div>
                        <div class="checks">
                            <input type="checkbox" name="zzz" id="z18">
                            <label for="z18">
                                <p>파키스탄</p>
                            </label>
                        </div>
                    </div>
                    <!-- 선택 라디오,체크박스 끝-->
                </div>
                <!-- 유럽 국가 선택 끝 -->
            </div>

            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary btn-lg btn-block">선택</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- 출원국가 선택 Modal 끝-->



<!-- 출원국가 중복선택 Modal -->
<div class="modal fade" id="duplicate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">중복선택</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="xi-close fs_36 fc_grccc"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <p class="mt_50 mb_35 fs_18">이미 <span class="fw_500 fc_gr444">선택한 국가</span>입니다.</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary btn-lg btn-block">확인</button>
            </div>
        </div>
    </div>
</div>
<!-- 출원국가 중복선택 Modal 끝-->
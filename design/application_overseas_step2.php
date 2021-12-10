<? include_once("./inc/head.php"); ?>
<div class="sub_pg application_domestic">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <form>
                <div class="division d-block d-xl-flex justify-content-between">
                    <div class="w-65">
                        <h2 class="sub_tit">해외상표 출원하기</h2>

                        <form>
                            <h3 class="sub_tit2">국가별 가상 견적 결과</h3>

                            <div class="bg-light rounded p_20_25 mb_50">
                                <ul class="fs_15">
                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">＊</span>
                                        <p>해외 상표 견적은 현지 환경에 따라 실시간으로 변동될 수 있습니다.
                                        </p>
                                    </li>
                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">＊</span>
                                        <p>마드리드 출원이 불가한 나라는 개별출원 비용으로 합계 됩니다.</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="table-responsive">
                                <table class="table table_style text-center w_480 mb_22">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">개별국 출원시</th>
                                            <th scope="col">마드리드 국제 출원시</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>기본료</th>
                                            <td>없음</td>
                                            <td>1,821,250원</td>
                                        </tr>
                                        <tr>
                                            <th><img src="./img/m_icon.png" alt="" class="d-inline mr-3">버진아일랜드(미국령)</th>
                                            <td>1,821,250원</td>
                                            <td>1,821,250원</td>
                                        </tr>
                                        <tr>
                                            <th><img src="./img/m_icon.png" alt="" class="d-inline mr-3">미국</th>
                                            <td>1,821,250원</td>
                                            <td><span class="text-danger">불가</span> (1,821,250원)</td>
                                        </tr>
                                        <tr>
                                            <th>합계</th>
                                            <td>2,642,250원</td>
                                            <td>1,821,250원</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            <div class=" btn_group d-flex justify-content-center mb_70 mb-md-0">
                                <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="location.href='application_overseas_step1.php'">국가 다시 선택하기</button>
                                <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='application_overseas_step3.php'">다음으로</button>
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
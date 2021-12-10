<? include_once("./inc/head.php"); ?>

<div class="container-lg py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-5 position-relative">
            <ul class="fixed-top d-none d-lg-block" style="left:5%; top:160px;">
                <li><a href="#guide_pg1">타이틀</a></li>
                <li><a href="#guide_pg2">폰트</a></li>
                <li><a href="#guide_pg3">입력폼</a></li>
                <li><a href="#guide_pg4">버튼</a></li>
            </ul>
            <h1 id="guide_pg1" class="guide_pg mb-3"><span class="bg-info d-block py-2 px-3 fc_wh">▼ 타이틀</span></h1>
            <h1 class="mb-3 mt-3 fc_red">▼ 타이틀 스타일1</h1>
            <div class="px-2">
                <h4 class="tit1 fs_31 fc_dgr fw_600 mb-2">회원가입</h4>
            </div>



            <h1 id="guide_pg2" class="guide_pg mb-3"><span class="bg-info d-block py-2 px-3 fc_wh">▼ 폰트</span></h1>
            <h1 class="mb-3 mt-3 fc_red">▼ 폰트 사이즈</h1>
            <div class="px-2">
                <div class="fs_8">fs_8</div>
                <div class="fs_9">fs_9</div>
                <div class="fs_10">fs_10</div>
                <div class="fs_11">fs_11</div>
                <div class="fs_17">~</div>
                <div class="fs_17">fs_17</div>
                <div class="fs_19">fs_19</div>
                <div class="fs_20">fs_20</div>
                <div class="fs_21">fs_21</div>
                <div class="fs_22">fs_22</div>
                <div class="fs_52">~</div>
                <div class="fs_52">fs_52</div>
            </div>
            <h1 class="mb-3 mt-3 fc_red">▼ 폰트 굵기</h1>
            <div class="px-2 py-2">
                <div class="fw_100">fw_100</div>
                <div class="fw_200">fw_200</div>
                <div class="fw_300">fw_300</div>
                <div class="fw_400">fw_400</div>
                <div class="fw_500">fw_500</div>
                <div class="fw_600">fw_600</div>
                <div class="fw_700">fw_700</div>
                <div class="fw_800">fw_800</div>
            </div>
            <h1 class="mb-3 mt-3 fc_red">▼ 폰트 색상</h1>
            <div class="px-2">
                <div class="fw_500">
                    <span class="fc_wh px-2 py-1 bg-dark">fc_wh</span>
                    <span class="fc_bl px-2 py-1">fc_bl</span>
                    <span class="fc_graaa px-2 py-1">fc_graaa</span>
                    <span class="fc_gr999 px-2 py-1">fc_gr999</span>
                    <span class="fc_gr777 px-2 py-1">fc_gr777</span>
                    <span class="fc_gr666 px-2 py-1">fc_gr666</span>
                    <span class="fc_gr444 px-2 py-1">fc_gr444</span>
                    <span class="fc_gr222 px-2 py-1">fc_gr222</span>
                    <span class="fc_bk px-2 py-1">fc_bk</span>
                </div>
            </div>

            <h1 id="guide_pg3" class="guide_pg mb-3 mt-5"><span class="bg-info d-block py-2 px-3 fc_wh">▼ 입력폼</span></h1>
            <h1 class="mb-3 mt-3 fc_red">▼ 기본</h1>
            <div class="px-2">



                <div class="ip_wr mt_30">
                    <div class="ip_tit d-flex align-items-center mb-3">
                        <h5>아이디(이메일)</h5>
                        <p class="ml-3">메일 인증을 해주세요</p>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="업체명을 입력해 주세요" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                </div>

                <div class="mt_30">
                    <div class="ip_tit d-flex align-items-center mb-3">
                        <h5>아이디(이메일)</h5>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-secondary btn-md" type="button">주소 찾기</button>
                        </div>
                    </div>
                </div>


                <ul class="lst_st01">
                    <li>테스트 운영 기간에는 임직원 이메일로만 가입하실 수 있습니다.</li>
                </ul>









                <div class="ip_wr mt_30">
                    <div class="ip_tit d-flex align-items-center mb-3">
                        <h5>아이디(이메일)</h5>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-secondary btn-md" type="button">주소 찾기</button>
                        </div>
                    </div>
                </div>

                <div class="ip_wr input_in_btn m-0 mb-4">
                    <div class="input-group">
                        <div class="border rounded d-flex">
                            <input type="text" class="form-control border-0" placeholder="이메일 입력하세요" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="btn_wr">
                                <button type="button" class="btn fc_graaa fw_600 px-0">취소</button>
                                <button type="button" class="btn fc_bl fw_600">댓글 쓰기</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>


            <div class="ip_wr m-0">
                <div class="input-group ip_textarea position-relative d-block">
                    <textarea class="form-control border-0" aria-label="With textarea" placeholder="내용을 입력해 주세요"></textarea>
                    <div class="d-flex justify-content-end"><button type="button" class="btn fc_bl fw_600">댓글 쓰기</button></div>
                </div>
            </div>



            <h1 id="guide_pg4" class="guide_pg mb-3"><span class="bg-info d-block py-2 px-3 fc_wh">▼ 버튼</span></h1>
            <h1 class="mb-3 mt-3 fc_red">▼ 버튼</h1>

            <div class="p-3">
                <button type="button" class="btn btn-primary btn-lg">회원가입</button>
                <button type="button" class="btn btn-secondary btn-lg">회원가입</button>
                <button type="button" class="btn btn-outline-primary btn-lg">회원가입</button>
                <button type="button" class="btn btn-outline-secondary btn-lg">회원가입</button>
            </div>

            <div class="p-3">
                <button type="button" class="btn btn-primary btn-lg btn-block">회원가입</button>
                <button type="button" class="btn btn-secondary btn-lg btn-block">회원가입</button>
                <button type="button" class="btn btn-outline-primary btn-lg btn-block">회원가입</button>
                <button type="button" class="btn btn-outline-secondary btn-lg btn-block">회원가입</button>
            </div>
            <div class="p-3">
                <button type="button" class="btn btn-primary">회원가입</button>
                <button type="button" class="btn btn-secondary">회원가입</button>
                <button type="button" class="btn btn-outline-primary">회원가입</button>
                <button type="button" class="btn btn-outline-secondary">회원가입</button>
            </div>

            <h1 class="mb-3 mt-3 fc_red">▼ 페이저</h1>


            <div class="d-flex pt-5 justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination fs_20 align-items-center">
                        <li class="page-item arrow disabled">
                            <a class="page-link fs_16" href="#" tabindex="-1"><i class="xi xi-angle-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active">
                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item arrow">
                            <a class="page-link fs_16" href="#"><i class="xi xi-angle-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>

            <h1 class="mb-3 mt-3 fc_red">▼ 체크박스 / 라디오 버튼</h1>

            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="checks">
                        <input id="ck1" name="ck" type="checkbox" aria-label="ck1 button for following text input">
                        <label for="ck1">체크박스</label>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="checks mr-3">
                        <input id="rd1" name="rd" type="radio" aria-label="rd1 button for following text input">
                        <label for="rd1">라디오1</label>
                    </div>
                    <div class="checks">
                        <input id="rd2" name="rd" type="radio" aria-label="rd2 button for following text input">
                        <label for="rd2">라디오2</label>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<? include_once("./inc/tail.php"); ?>
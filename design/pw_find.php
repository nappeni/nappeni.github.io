<? include_once("./inc/head.php"); ?>
<div class="sub_pg login_bg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="container02 mx-auto">
                <h2 class="sub_tit fc_gr222 text-center">비밀번호 찾기</h2>

                <form class="mt_30">

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>아이디 (이메일)</h5>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="아이디 (이메일)를 입력해주세요">
                        </div>
                        <p class="text-danger mt_10">존재하지 않는 아이디입니다.</p>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>이름</h5>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="이름을 입력해주세요">
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>전화번호</h5>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="‘-’ 없이 전화번호 입력">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary btn-md" type="button">인증번호 전송</button>
                            </div>
                        </div>
                        <p class="mt_10">인증번호를 입력하신 전화번호로 전송했습니다.</p>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>인증번호</h5>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="인증번호 4자리를 입력해주세요">
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-lg btn-block mb_50" onclick="location.href='pw_change.php' ">다음으로</button>
                </form>
            </div>
            <!-- container02-->
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->
<? include_once("./inc/tail.php"); ?>
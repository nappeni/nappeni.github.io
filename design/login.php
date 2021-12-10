<? include_once("./inc/head.php"); ?>
<div class="sub_pg login_bg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="container02 mx-auto">
                <h2 class="sub_tit fc_gr222 text-center">로그인</h2>

                <form class="mt_30">
                    <div class="ip_wr mb-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="아이디를 입력해주세요">
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="input-group">
                            <input type="password" class="form-control mr-0" placeholder="비밀번호를 입력해주세요">
                            <button class="pw pw_off"></button>
                            <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-lg btn-block mb_10">로그인</button>
                    <button type="button" class="btn btn-secondary btn-lg btn-block mb_10" onclick="location.href='join.php' ">회원가입</button>
                    <a href="./pw_find.php" class="mb_50 d-block">비밀번호를 잊어버리셨나요?</a>



                    <!-- SNS로그인-->
                    <div class="text-center mb_22">
                        <p class="sns_tit">SNS 로그인</p>
                    </div>

                    <button type="button" class="btn bg_kakao btn-lg btn-block d-flex align-items-center justify-content-center mb_10 ">
                        <img src="./img/kakao.png" alt="" class="mr_8">카카오로 로그인하기
                    </button>
                    <button type="button" class="btn bg_naver btn-lg btn-block d-flex align-items-center justify-content-center">
                        <img src="./img/naver.png" alt="" class="mr_8">네이버로 로그인하기
                    </button>
                    <!-- SNS로그인 끝-->




                </form>
            </div>
            <!-- container02-->
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->
<? include_once("./inc/tail.php"); ?>
<?
	include "./head_inc.php";
?>
<?php 
//카카오
define('KAKAO_REST_KEY','1512ac611b6b05ca640256e35bdc60b2');
define('KAKAO_CALLBACK_URL','https://dmonster1705.cafe24.com/JYController/KakaoCollBack.php');
$kakao_state = md5(microtime(). mt_rand());
$_SESSION['kakao_state'] = $kakao_state;
$kakaoUrl = "https://kauth.kakao.com/oauth/authorize?client_id=".KAKAO_REST_KEY."&redirect_uri=".KAKAO_CALLBACK_URL."&response_type=code&state=".$kakao_state;
//네이버
define('NAVER_CLIENT_ID','Q_dcTfUGTbbjzrPFjQli');
define('NAVER_CLIENT_SECRET', 'b4U4dopvID');
define('NAVER_CALLBACK_URL','https://dmonster1705.cafe24.com/JYController/NaverCollBack.php');
$naver_state = md5(microtime().mt_rand());
$_SESSION['naver_state'] = $naver_state;
$naverURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".NAVER_CLIENT_ID."&redirect_uri=".urlencode(NAVER_CALLBACK_URL)."&state=".$naver_state;

$hostname=$_SERVER["HTTP_HOST"]; //도메인명(호스트)명을 구합니다.
$uri= $_SERVER['REQUEST_URI']; //uri를 구합니다.
$query_string=getenv("QUERY_STRING"); // Get값으로 넘어온 값들을 구합니다.
$phpself=$_SERVER["PHP_SELF"]; //현재 실행되고 있는 페이지의 url을 구합니다.
$basename=basename($_SERVER["PHP_SELF"]); //현재 실행되고 있는 페이지명만 구합니다.
$protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
?>
<div class="sub_pg login_bg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="container02 mx-auto">
                <h2 class="sub_tit fc_gr222 text-center">로그인</h2>
                <form name="loginForm" class="mt_30" action="JYController/login.php" method="POST"  onsubmit="return checkLoginValues();">
                    <input type="hidden" name="url" value="<?= $_GET['url'] ?>">
                    <div class="ip_wr mb-3">
                        <div class="input-group">
                            <input name="id" type="text" class="form-control" placeholder="아이디를 입력해주세요">
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="input-group">
                            <input name="passwdBlind" type="password" class="form-control mr-0" placeholder="비밀번호를 입력해주세요">
                            <button name="passwdBlind" type="button" class="pw pw_off" onclick="BlindSet()"></button>
                            <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                        </div>
                    </div>

                    <div class="error">
                        <div name="errorMsg" class="errorText">
                            <p><strong>아이디</strong>를 입력해주세요</p>
                        </div>
                        <div name="errorMsg" class="errorText">
                            <p><strong>비밀번호</strong>를 입력해주세요</p>
                        </div>
                        <div name="errorMsg">
                        <?php if(isset($_SESSION['test'])){?>
                            <div class="errorText" style="display: block;">
                                <p>아이디 혹은 비밀번호가 일치하지 않습니다.</p>
                            </div>
                        <?php
                            if(isset($_SESSION['test'])){
                                unset($_SESSION['test']);
                            }
                        }?>
                        </div>
                    </div>
            

                    <button type="submit" class="btn btn-primary btn-lg btn-block mb_10">로그인</button>
                    <button type="button" class="btn btn-secondary btn-lg btn-block mb_10" onclick="location.href='join.php' ">회원가입</button>
                    <a href="./pw_find.php" class="mb_50 d-block">비밀번호를 잊어버리셨나요?</a>


                    <!-- SNS로그인-->
                    <div class="text-center mb_22">
                        <p class="sns_tit">SNS 로그인</p>
                    </div>
                    <a href="<?=$kakaoUrl?>">
                        <button type="button" class="btn bg_kakao btn-lg btn-block d-flex align-items-center justify-content-center mb_10 ">
                            <img src="./images/kakao.png" alt="" class="mr_8">카카오로 로그인하기
                        </button>
                    </a>
                    <a href="<?=$naverURL?>">
                    <button type="button" class="btn bg_naver btn-lg btn-block d-flex align-items-center justify-content-center">
                        <img src="./images/naver.png" alt="" class="mr_8">네이버로 로그인하기
                    </button>
                    </a>
                    <!-- SNS로그인 끝-->


                </form>
            </div>
            <!-- container02-->
        </div>
    </div>
    <!-- container-fluid -->
</div>
<script>
    //id에러메세지 [0], passwd에러메세지[1], 아이디와 비밀번호가 틀리면 [3]
    function checkLoginValues() {
        var loginform = document.loginForm;
        if (document.loginForm.id.value == '') {
            document.getElementsByName('errorMsg')[0].style.display = 'block';
            document.getElementsByName('errorMsg')[1].style.display = 'none';
            document.getElementsByName('errorMsg')[2].style.display = 'none';
            return false;
        } else if (document.loginForm.passwdBlind[0].value == '') {
            document.getElementsByName('errorMsg')[0].style.display = 'none';
            document.getElementsByName('errorMsg')[1].style.display = 'block';
            document.getElementsByName('errorMsg')[2].style.display = 'none';
            return false;
        }
    }
    //비밀번호 노출
    function BlindSet() {
    //[0] 패스워드 input [2]패스워드 노출 버튼
        var passwordButton = document.getElementsByName('passwdBlind')[1].className;
        if (passwordButton == 'pw pw_off') {
            document.getElementsByName('passwdBlind')[0].type = 'text';
            document.getElementsByName('passwdBlind')[1].className = 'pw pw_on';
        } else {
            document.getElementsByName('passwdBlind')[0].type = 'password';
            document.getElementsByName('passwdBlind')[1].className = 'pw pw_off';
        }
    }
</script>
<!-- sub_pg 끝 -->
<?
	include "./foot_inc.php";
?>
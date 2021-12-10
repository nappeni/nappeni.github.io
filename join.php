<?
	include "./head_inc.php";
?>
<?php include "JYController/Naver_Recatch.php";?>
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
//네이버 캡차
define('NAVER_CLIENT_ID_Recaptcha','2jRhNaVHxSB5NzDvV4KY');
define('NAVER_CLIENT_SECRET_Recaptcha','IYB7smOvZW');
?>
<link rel="stylesheet" href="css/jy_css.css">
<div class="sub_pg login_bg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="container02 mx-auto">
                <h2 class="sub_tit fc_gr222 text-center">회원가입</h2>
                <form class="mt_30" action="JYController/join.php" method="POST" onsubmit="return checkNull(this);">
                    <input name="function" type="hidden" value="joinUser">
                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>아이디 (이메일) <span class="fc_primary">*</span></h5>
                        </div>
                        <div class="input-group">
                            <input id="id" name="userid" type="text" class="form-control" placeholder="이메일을 입력해주세요" onKeyup="Check_Id()">
                            <!-- <div class="input-group-append">
                                <button class="btn btn-outline-primary btn-md" type="button">중복확인</button>
                            </div> -->
                        </div>
                        <div class="checkValue">
                            <div name="IdMsg" class="errorText"></div>
                            <div name="IdMsg" class="successText">
                                <p>사용 가능한 아이디입니다.</p>
                            </div>
                        </div>
                    </div>

                    <div class="ip_wr">
                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>비밀번호 <span class="fc_primary">*</span></h5>
                        </div>
                        <div class="input-group">
                            <input id="passwd" name="passwdBlind"  type="password" class="form-control mr-0" placeholder="비밀번호를 입력해주세요" onKeyup="check_Pw()">
                            <button name="passwdBlind" type="button" class="pw pw_off" onclick="BlindSet()"></button>
                            <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                        </div>
                        <div class="checkValue">
                            <div name="PWMsg" class="errorText">
                            </div>
                            <div name="PWMsg" class="successText">
                                <p>사용 가능한 비밀번호입니다.</p>
                            </div>
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>이름 <span class="fc_primary">*</span></h5>
                        </div>
                        <div class="input-group">
                            <input id="name" name="mt_name" type="text" class="form-control" placeholder="이름을 입력해주세요">
                        </div>
                        <div class="checkValue">
                            <div name="NameMsg" class="errorText">
                                <p>이름은 한글 또는 영어로 입력해주세요.</p>
                            </div>
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>휴대전화 <span class="fc_primary">*</span></h5>
                        </div>
                        <div class="input-group">
                            <input id="phone" name="mt_hp" type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>유선전화번호 <span class="fc_gr666 fw_300 fs_16">(선택)</span></h5>
                        </div>
                        <div class="input-group">
                            <input type="text" name="usernum" class="form-control" placeholder="'-'없이 번호를 입력하세요" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" >
                        </div>
                    </div>

                    <!-- 이용약관-->
                    <div class="ip_wr">
                        <div class="border rounded bg-light p_30_20">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>서비스 이용약관 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="checks">
                                <input type="checkbox" name="ck" id="ck1">
                                <label for="ck1">(필수) <button class="a_btn fc_primary mt_2 a_link" type="button" data-toggle="modal" data-target="#terms_use">서비스 이용약관</button> 및 <button class="a_btn fc_primary mt_2 a_link" type="button" data-toggle="modal" data-target="#terms_user">개인정보취급방침</button>에 동의합니다.</label>
                            </div>
                        </div>
                    </div>
                    <!-- 이용약관 끝-->




                    <!-- <img src="./images/captcha.png" alt="" style="max-width:100%;" class="mb_22"> -->
                    <!-- 예시 이미지... reCAPTCHA 기능넣어주세용>< -->
                    <div id="recatch"class="ip_wr"> <!--reCAPTCHA 넣을 곳-->
                        <?php //reCAPTCHA 이미지 가져오기
                            $key = $recatch -> setkey(); //키 값 받아오기
                            $img = $recatch -> getImage($key); // 이미지 받아오기
                            $imgLink = $img."?".rand(0,100000);
                        ?>
                        <table class="recatchTable">
                            <tr>
                                <td rowspan="2">
                                    <img id="recaptchaImg" src="./<?= $imgLink?>">
                                </td>
                                <td>
                                    <input id="inputRecatch" type="text" class="form-control" style="margin-top: 15px;" autocomplete="off"placeholder="자동입력 방지문자">
                                </td>
                            </tr>
                            <tr>
                                <td class="recatchTd">
                                    <button id="recatch_Btn" class="btn btn-outline-primary btn-md btn-set" type="button" onclick="checkRecatch()">확인</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <button type="submit" frommethod="post" class="btn btn-primary btn-lg btn-block mb_50">회원가입</button>

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
    var recatchResult = false;
    //recatch 확인
    function checkRecatch(){
        <?php if(isset($key)){ $_SESSION['recatchKey'] = $key;}?>
        var value =  document.getElementById('inputRecatch').value;
        $.ajax({
            url: './JYController/Naver_Recatch.php',
            data: {
                function: 'checkkey',
                inputvalue: value,
            },
            type: 'post',
            dataType: 'json',
            success: function(result){
                if(result['result']==true){
                    recatchResult = true;
                    $('#recatch_Btn').css("display","none");
                    $('#inputRecatch').attr("disabled", true);
                    $('#inputRecatch').css("color","green");
                    $('#inputRecatch').val("인증되었습니다.");
                }else{
                    $('#recatch').load(location.href+" #recatch");
                }
            }   
        });
    }
    //필수 요소 확인
    function checkNull(f) {
        var checkName = /^[가-힣a-zA-Z]+$/;
        console.log(IdFlag);
        if(f.id.value==''||IdFlag==false){
            alert("아이디를 제대로 입력해주세요");
            return false;
        }else if(f.passwd.value==''||passwdFlag==false){
            alert("비밀번호를 제대로 입력해주세요");
            return false;
        }else if(f.name.value==''){
            alert("이름을 입력해주세요");
            return false;
        }else if(checkName.test(f.name.value)==false){
            alert("이름에 한글과 영어만 입력해주세요");
            return false;
        }else if(f.phone.value==''){
            alert("휴대전화번호를 입력해주세요.");
            return false;
        }else if(f.ck1.checked == false){
            alert("서비스 이용약관에 동의해주세요");
            return false;
        }else if(recatchResult==false){
            alert("자동입력 방지문자를 입력해 주세요");
            return false;
        }
        //return true;
    }
</script>
<!-- 출원국가 선택 Modal -->
<div class="modal fade" id="terms_use" tabindex="-1" aria-labelledby="exampleModalLabe" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">서비스 이용약관</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="xi-close fs_36 fc_grccc"></i>
                </button>
            </div>
            <div class="modal-body">

                <p class="wh_pre">
                    <?php
                        $result = $DB ->select_query("SELECT st_agree1 FROM setup_t");
                        foreach($result as $value);
                        echo $value['st_agree1'];
                    ?>
                </p>

            </div>

            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">확인</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- 출원국가 선택 Modal 끝-->
<!-- 출원국가 선택 Modal -->
<div class="modal fade" id="terms_user" tabindex="-1" aria-labelledby="exampleModalLabe" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel"> 개인정보취급방침</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="xi-close fs_36 fc_grccc"></i>
                </button>
            </div>
            <div class="modal-body">

                <p class="wh_pre">
                <?php
                        $result = $DB ->select_query("SELECT st_agree2 FROM setup_t");
                        foreach($result as $value);
                        echo $value['st_agree2'];
                    ?>
                </p>

            </div>

            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">확인</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- 출원국가 선택 Modal 끝-->
<!-- sub_pg 끝 -->
<?
	include "./foot_inc.php";
?>
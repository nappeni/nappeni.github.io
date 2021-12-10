<? include("./head_inc.php");?>
<?php include "JYController/MyInfo.php";?>
<?php 
if($_SESSION['mt_id']==null){
    p_alert("로그인이 필요합니다.","./index.php");
}
$info = new MyInfo;?>
<div class="sub_pg my_pg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
                <!-- w-30 시작 / 마이페이지 -->
                <?
                $idx_lm1 = 1;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->

                <!-- w-65 시작-->
                <div class="w-65">
                    <form method="POST" action="JYController/account_management.php" onsubmit="return checkPhone()">
                        <h2 class="sub_tit">계정 관리</h2>

                        <h2 class="sub_tit2">현재 계정 정보</h2>

                        <div class="bg-light rounded p_20_25 mb_22">
                            <div class="d-flex align-items-center mb_8">
                                <p class="fc_gr222 fw_500 w_140">아이디 (이메일)</p>
                                <p class="fs_15"><?= $_SESSION['mt_id']?></p>
                            </div>
                            <div class="d-flex align-items-center mb_8">
                                <p class="fc_gr222 fw_500 w_140">성명</p>
                                <p class="fs_15"><?= $_SESSION['mt_name']?></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="fc_gr222 fw_500 w_140">할인코드</p>
                                <p class="fs_15"><?= $info -> getDiscountCd();?></p>
                            </div>
                        </div>

                        <div class="ip_wr col-md-6 pr-0 pr-md-2">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>현재 비밀번호</h5>
                            </div>
                            <div class="input-group">
                                <input name="passwdNowBlind" type="password" class="form-control mr-0" placeholder="현재 비밀번호를 입력해주세요">
                                <button name="passwdNowBlind" class="pw pw_off" onclick="BlindNowSet()"></button>
                                <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>새 비밀번호</h5>
                                </div>
                                <div class="input-group">
                                    <input name="passwdBlind"type="password" class="form-control mr-0" placeholder="새 비밀번호를 입력해주세요" onKeyup="check_Pw()">
                                    <button name="passwdBlind" class="pw pw_off" onclick="BlindSet()"></button>
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
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>새 비밀번호 재입력</h5>
                                </div>
                                <div class="input-group">
                                    <input name="passwdCkBlind" type="password" class="form-control mr-0" placeholder="새 비밀번호를 재입력해주세요" onKeyup="checkPassword()">
                                    <button name="passwdCkBlind" class="pw pw_off" onclick="BlindCkSet()"></button>
                                    <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                                </div>
                                <div class="checkValue">
                                    <div name="PWMsg" class="errorText">
                                    </div>
                                    <div name="PWMsg" class="successText">
                                        <p>비밀번호가 일치합니다.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row pb_30 br_bottom mb_50">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex mb-3">
                                    <h5>이메일</h5>
                                </div>
                                <div class="input-group">
                                    <input name="userEmail" type="text" class="form-control" placeholder="이메일을 입력하세요" value="<?=$info->getEmail() ?>">
                                </div>
                                <p class="mt_10 fs_14">현재 사용하시는 이메일 대신 사용하고 싶은 이메일은 입력해주세요.</p>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>휴대전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input name="userPhoneNum" type="text" class="form-control" placeholder="'-'없이 번호를 입력해주세요." value="<?= $info -> getPhNum(); ?>">
                                </div>
                            </div>
                        </div>

                        <?php 
                            $bankInfo = $info -> getBankInfo();

                        ?>
                        <h2 class="sub_tit2">환불계좌 정보</h2>

                        <div class="ip_wr col-md-6">
                            <div class="ip_tit d-flex align-items-center d-flex mb-3">
                                <h5>예금주</h5>
                            </div>
                            <div class="input-group">
                                <input id="bkName" name="bankInfos[]" type="text" class="form-control" value="<?= $bankInfo['bk_uname']?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr col-md-6 pr-0 pr-md-2">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>은행명</h5>
                                </div>
                                <div class=" input-group">
                                    <select name="bankInfos[]" class="custom-select" id="inputGroupSelect01">
                                        <option value="N" <?php if($bankInfo['bk_name']=='N' || $bankInfo['bk_name']== NULL) echo "SELECTED"?>>NH 농협</option>
                                        <option value="W" <?php if($bankInfo['bk_name']=='W') echo "SELECTED"?>>우리은행</option>
                                        <option value="B" <?php if($bankInfo['bk_name']=='B') echo "SELECTED"?>>부산은행</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex mb-3">
                                    <h5>계좌번호</h5>
                                </div>
                                <div class="input-group">
                                    <input id="acountNum" name="bankInfos[]" type="text" class="form-control"  placeholder="'-'없이 번호를 입력해주세요." value="<?= $bankInfo['bk_acount_num']?>">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mb_50">
                            <button type="submit" formmethod="post" class="btn btn-primary btn-md btn_style03">수정 완료</button>
                        </div>
                    </form>

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
    //형식과 빈 값 확인
    function checkPhone(){
        var result = true;
        var checkPhone = /^01(?:0|1|[6-9])(?:\d{3}|\d{4})\d{4}$/;
        var checkName = /^[가-힣]{2,4}$/;
        var checkAcountNum = /^[0-9]{13}$/;
        //휴대전화 필수 입력 사항
        if(document.getElementsByName('userPhoneNum')[0].value == '' || document.getElementsByName('userPhoneNum')[0].value==''){
            alert("휴대전화 번호를 입력해주세요.");
            result = false;
        }else if(checkPhone.test(document.getElementsByName('userPhoneNum')[0].value)!=1){
            alert("휴대전화 번호를 제대로 입력해주세요.");
            result = false;
        }
        // 입력이 있을시
        if(document.getElementsByName('passwdBlind')[0].value!=' ' && document.getElementsByName('passwdCkBlind')[0].value!='' ){
            if(passwdFlag != true && passwdCkFlag != true){
                alert("비밀번호를 제대로 입력해주세요.");
                result = false;
            }
        }
        
        if(checkName.test(document.getElementById('bkName').value)!=1 && document.getElementById('bkName').value != ''){
            alert("이름을 제대로 입력해주세요");
            result = false;
        }else if(checkAcountNum.test(document.getElementById('acountNum').value)!=1 && document.getElementById('acountNum').value != ''){
            alert("계좌번호를 제대로 입력해주세요");
            result = false;
        }
        return result;
    }
</script>
<!-- sub_pg 끝 -->
<? include("./foot_inc.php"); ?>
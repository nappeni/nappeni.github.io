<? include_once("./head_inc.php"); ?>
<link rel="stylesheet" href="design/design.css">
<div class="sub_pg login_bg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="container02 mx-auto">
                <h2 class="sub_tit fc_gr222 text-center mt_70">비밀번호 찾기</h2>

                <form class="mt_30">

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex mb-3">
                            <h5>새 비밀번호</h5>
                        </div>
                        <div class="input-group">
                            <input name="passwdBlind" type="password" class="form-control mr-0" placeholder="새 비밀번호를 입력해주세요" onKeyup="check_Pw()">
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
                        <div class="ip_tit d-flex align-items-center d-flex mb-3">
                            <h5>비밀번호 재입력</h5>
                        </div>
                        <div class="input-group">
                            <input name="passwdCkBlind" type="password" class="form-control mr-0" placeholder="새 비밀번호를 재입력해주세요" onKeyup="checkPassword()">
                            <button id="pwButton" name="passwdCkBlind" type="button" class="pw pw_off" onclick="BlindCkSet()"></button>
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
                    <button type="button" class="btn btn-primary btn-lg btn-block mb_50" onclick="setPassword()">변경하기</button>
                </form>
            </div>
            <!-- container02-->
        </div>
    </div>
    <!-- container-fluid -->
</div>
<script>
    function nullCheck(){
        var result = false;
        if(document.getElementsByName('passwdBlind')[0].value == '' || document.getElementsByName('passwdCkBlind')[0].value == ' '){
            alert("비밀번호를 제대로 입력해주세요.");
        }else if(passwdFlag == true && passwdCkFlag == true){
            result = true;
        }else{
            alert("비밀번호와 비밀번호 재입력란을 다시 확인해주세요.");
        }
        return result;
    }

    function setPassword(){
        var send = nullCheck();
        if(send == true){
            var passwdBlind = document.getElementsByName('passwdBlind')[0].value;
            $.ajax({
                url: 'JYController/pw_change.php',
                data: {
                    passwdBlind: passwdBlind,
                },
                type: 'POST',
                dataType: 'json',
                success: function(result){
                    if(result.success==1){
                        $('#pw').modal();
                    }
                }
            });
        }
    }
</script>
<!-- sub_pg 끝 -->
<!-- Modal -->
<div class="modal fade" id="pw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">비밀번호 찾기</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span> 
                   <i class="xi-close fs_36 fc_grccc"></i>
                </button> -->
            </div>
            <div class="modal-body text-center">
                <p class="mt_50 mb_35 fs_18">성공적으로 <span class="fw_500 fc_gr444">비밀번호가 변경</span>이 되었습니다.</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary btn-lg btn-block"onclick="location.href='./index.php'" >확인</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal 끝-->
<? include_once("./foot_inc.php"); ?>
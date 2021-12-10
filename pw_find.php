<?
	include "./head_inc.php";
?>
<div class="sub_pg login_bg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="container02 mx-auto">
                <h2 class="sub_tit fc_gr222 text-center">비밀번호 찾기</h2>

                <form id="find_pw" class="mt_30" method="POST" action="JYController/pw_find.php" onsubmit="return checkNull()">

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>아이디 (이메일)</h5>
                        </div>
                        <div class="input-group">
                            <input name="userId" type="text" class="form-control" placeholder="아이디 (이메일)를 입력해주세요" onKeyup="checkId()">
                        </div>
                        <p id="idBox" class="text-danger mt_10" style="display:none;">존재하지 않는 아이디입니다.</p>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>이름</h5>
                        </div>
                        <div class="input-group">
                            <input name="userName" type="text" class="form-control" placeholder="이름을 입력해주세요">
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>전화번호</h5>
                        </div>
                        <div class="input-group">
                            <input id="userPhone" type="text" class="form-control" placeholder="‘-’ 없이 전화번호 입력" onKeyup="checkPhone()">
                            <div class="input-group-append">
                                <button id="userPhoneBut" class="btn btn-outline-primary btn-md" type="button" onclick="sendMsg()" disabled="true">인증번호 전송</button>
                            </div>
                        </div>
                        <p name="phoneBox" class="mt_10 phoneText phoneText-error">숫자만 입력해주세요.</p>
                        <p name="phoneBox" class="mt_10 phoneText">인증번호를 입력하신 전화번호로 전송했습니다.</p>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>인증번호</h5>
                        </div>
                        <div class="input-group">
                            <input name="CertificationNum" type="text" class="form-control" autocomplete="off" placeholder="인증번호 4자리를 입력해주세요">
                        </div>
                    </div>
                    <button type="submit" frommethod="post" class="btn btn-primary btn-lg btn-block mb_50">다음으로</button>
                    <input name="function" type="hidden" value="checkInfo">
                </form>
            </div>
            <!-- container02-->
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->
<script>
    var Certification = false;
    checkPhone();
    //아이디 확인
    function checkId(){
        var userId = document.getElementsByName('userId')[0].value;
        $.ajax({
            url: './JYController/pw_find.php',
            data: {
                function: 'checkId',
                userId: userId
            },
            type: 'POST',
            dataType: 'json',
            success: function(result){
                if(result.success){
                    document.getElementById('idBox').style.display = "none";
                }else{
                    document.getElementById('idBox').style.display = "block"; 
                }
            }
        });
    }
    //휴대전화 조건 확인
    function checkPhone(){
        var userPhone = document.getElementById('userPhone').value;
        var checkValue = /^[0-9]*$/;
        if(userPhone != ''){
            document.getElementById('userPhoneBut').disabled = false;
        }else if(checkValue.test(userPhone)){
            document.getElementsByName('phoneBox')[0].style.display = "none";
            document.getElementById('userPhoneBut').disabled = false;
        }else{
            document.getElementsByName('phoneBox')[0].style.display = "block";
            document.getElementById('userPhoneBut').disabled = true;
        }
    }
    //인증번호 전송
    function sendMsg(){
        var userPhone = document.getElementById('userPhone').value;
        $.ajax({
            url: '../JYController/pw_find.php',
            data: { 
                function: 'sendMsg',
                userPhone: userPhone,
            },
            type: 'POST',
            dataType: 'json',
            success: function(result){
                if(result.result_code==1){
                    Certification = true;
                    document.getElementsByName('phoneBox')[1].style.display = "block";
                }
            }
        });
    }
    //다음으로 submit하기 전 확인
    function checkNull(){
        var cknull = $("#find_pw input[type=text]");
        var result = false;
        for(var i=0; i<cknull.length;i++){
            if($(cknull[i]).val()==null||$(cknull[i]).val()==""){
                result = false;
                break;
            }else{
                result = true;
            }
        }
        if(result==false){
            alert("정보를 제대로 입력해주세요.");
        }else if(Certification == false){
            alert("휴대전화 인증을 해주세요.");
            result = false;
        }
        return result;
    }
    
</script>
<?
	include "./foot_inc.php";
?>
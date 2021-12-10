<? include_once("./head_inc.php"); 
    if(!$_SESSION['mt_id']){
        alert("로그인 후 이용해주세요.", "./login.php");
    }
    $sql = "select * from member_t where idx=".$_SESSION['mt_idx'];
    $list1 = $DB->select_query($sql);
    foreach($list1 as $row);
    $sql = "select st_agree1 from setup_t";
    $list2 = $DB->select_query($sql);
?>
<div class="sub_pg application_domestic">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <form method="post" action="./JYController/application_overseas.php" onsubmit="return checkNull()">
                <input name="act" type="hidden" value="update">
                <div class="division d-block d-xl-flex justify-content-between">
                    <div class="w-65">
                        <h2 class="sub_tit">해외상표 출원하기</h2>
                            <h3 class="sub_tit2">신청인 정보 입력</h3>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>1. 국내에서 출원한적이 있습니까?</h5>
                                </div>
                                <div class="input-group-prepend">
                                    <div class="checks mr_30">
                                        <input type="radio" name="ad" id="ad1" value="Y">
                                        <label for="ad1">네</label>
                                    </div>
                                    <div class="checks">
                                        <input type="radio" name="ad" id="ad2" value="N">
                                        <label for="ad2">아니오</label>
                                    </div>
                                </div>
                            </div>

                            <div id="subCheck" class="ip_wr" style="display: none">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5> 2. 기존 등록된 상표를 변형하여 출원하시겠습니까?</h5>
                                </div>
                                <div class="input-group-prepend">
                                    <div class="checks mr_30">
                                        <input type="radio" name="ae" id="ae1" value="Y">
                                        <label for="ae1">네</label>
                                    </div>
                                    <div class="checks">
                                        <input type="radio" name="ae" id="ae2" value="N">
                                        <label for="ae2">아니오</label>
                                    </div>
                                </div>
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>상표명을 입력해주세요.</h5>
                                </div>
                                <div class="input-group">
                                    <input id="p_name" name="p_name" type="text" class="form-control" placeholder="상표명을 입력해주세요.">
                                </div>
                            </div>

                            <div class="ip_wr mb_50">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>상품소개</h5>
                                </div>
                                <div class="input-group">
                                    <textarea id="p_info" name="p_info" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="간략하게 상품에대해 소개해주세요."></textarea>
                                </div>
                            </div>

                            <div class="border_bk mb_50"></div>

                            <h2 class="sub_tit2">담당자 정보</h2>
                            <div class="form-row">
                                <div class="ip_wr col-md-6">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>담당자명</h5>
                                    </div>
                                    <div class="input-group">
                                        <input id="m_name" name="m_name" type="text" class="form-control" placeholder="담당자 이름을 입력하세요" value="<?= $row['mt_name']?>">
                                    </div>
                                </div>
                                <div class="ip_wr col-md-6">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>이메일</h5>
                                    </div>
                                    <div class="input-group">
                                        <input id="m_email" name="m_email" type="text" class="form-control" placeholder="이메일을 입력하세요" value="<?= $row['mt_email']?>">
                                    </div>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="ip_wr col-md-6  mb_50">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>휴대전화</h5>
                                    </div>
                                    <div class="input-group">
                                        <input id="m_phone" name="m_phone" type="text" class="form-control" placeholder="'-'없이 번호를 입력하세요" value="<?= $row['mt_hp']?>">
                                    </div>
                                </div>
                            </div>


                            <div class="border_bk mb_50"></div>

                            <!-- 이용약관-->
                            <div class="ip_wr">
                                <div class="border rounded bg-light p_30_20">
                                    <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                        <h5>이용약관 동의</h5>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="checks ml_25 d-inline w-auto mr-3">
                                            <input type="checkbox" name="ll" id="l3">
                                            <label for="l3">(필수) 개인정보 활용에 동의합니다.</label>
                                        </div>
                                    </div>
                                    <div class="bg-wh p_30_20 rounded-lg mt_15">
                                        <p class="fs_14 wh_pre scroll">
                                             <?php
                                                $result = $DB ->select_query("SELECT st_agree1 FROM setup_t");
                                                foreach($result as $value);
                                                echo $value['st_agree1'];
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- 이용약관 끝-->
                            <div class=" btn_group d-flex justify-content-center mb_70 mb-md-0">
                                <button type="submit" class="btn btn-primary btn-md btn_style03">견적서 받아보기</button>
                            </div>



                    </div>
                    <!-- w-65 끝-->


                    <!-- w-30 시작-->
                    <div class="w-30 aside2">
                        <img src="./images/aside2.png" alt="">
                    </div>
                    <!-- w-30 끝-->
                    <!-- division 끝 / 서브페이지 영역 2분할 -->


                </div>
            <form>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<script type="text/javascript">
    $('input:radio[name=ad]').on("click",function(e){
        if($('input:radio[name=ad]')[0].checked==true){
            $('#subCheck').css("display","block");
        }else{
            $('#subCheck').css("display","none");
        }
    });
    function checkNull(){
        if($('input:radio[name=ad]:checked').length==0){
            alert("국내 출원 여부를 체크해주세요.");
            return false;
        }else if($('input:radio[name=ae]:checked').length==0&&$('input:radio[name=ad]')[0].checked==true){
            alert("상표 변형 여부를 체크해주세요.");
            return false;
        }else if(document.getElementById('p_name').value == ' '){
            alert("상표명을 입력해주세요.");
            return false;
        }else if(document.getElementById('p_info').value == ' '){
            alert("상품소개를 입력해주세요.");
            return false;
        }else if(document.getElementById('m_name').value == ' '){
            alert("담당자 이름을 입력해주세요.");
            return false;
        }else if(document.getElementById('m_email').value == ' '){
            alert("담당자 이메일을 입력해주세요.");
            return false;
        }else if(document.getElementById('m_pnum').value == ' '){
            alert("담당자 전화번호를 입력해주세요.");
            return false;
        }else if($('input[name=ll]:checked').length == 0){
            alert("이용약관 동의를 체크해주세요.");
            return false;
        }
        return true;
    }
</script>
<!-- sub_pg 끝 -->
<? include_once("./foot_inc.php"); ?>
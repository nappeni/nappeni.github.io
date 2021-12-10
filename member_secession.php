<? include_once("./head_inc.php"); ?>
<?php include "JYController/MyInfo.php";?>
<?php $info = new MyInfo;?>
<div class="sub_pg my_pg">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
                <!-- w-30 시작 / 마이페이지 -->
                <div class="w-30 my_page">
                    <h3 class="sub_tit2 fc_bdk""><?= $_SESSION['mt_name']?> 회원님 <span class="fs_19 fw_500 fc_gr666">반갑습니다.</span></h3>
                    <div class="bg-wh rounded-lg p_20 fw_600 mb_20">
                        <a href="./point_list.php" class="d-flex align-items-center justify-content-between ">
                            <p class="fs_18 fc_gr222">보유 포인트</p>
                            <p class="fs_24 fc_bdk"><?= $info->getPoint()?>P</p>
                        </a>
                    </div>

                    <ul class="my_menu">
                        <li><a href="./account_management.php" class="active">계정관리</a></li>
                        <li>
                            <a href="./pending_application_list.php">상표현황</a>
                            <ul class="my_menu_2ul">
                                <li>
                                    <a href="./pending_application_list.php">출원상표 현황</a>
                                    <ul class="my_menu_3ul">
                                        <li><a href="./pending_application_list.php">- 출원준비 상표</a></li>
                                        <li><a href="./completed_application_list.php">- 출원완료 상표</a></li>
                                    </ul>
                                </li>
                                <li><a href="./application_overseas_list.php">해외 출원상표 현황</a></li>
                                <li><a href="./registered_trademark_list.php">등록상표 현황</a></li>
                            </ul>
                        </li>
                    </ul>


                </div>
                <!-- w-30 끝-->

                <!-- w-65 시작-->
                <div class="w-65">
                    <h2 class="sub_tit">회원탈퇴</h2>

                    <div class="bg-light rounded p_20_25 mb_22">
                        <ul class="fs_15">
                            <li>
                                <p class="fc_primary mb_5">회원탈퇴 전, 유의사항을 확인해 주시기 바랍니다.</p>
                            </li>
                            <li class="d-flex"><span class="flex-shrink-0 mr-2 mb_5">-</span>
                                <p>탈퇴하면 같은 메일주소로 재가입 불가합니다.</p>
                            </li>
                            <li class="d-flex"><span class="flex-shrink-0 mr-2 mb_5">-</span>
                                <p>회원정보 및 서비스 이용기록은 모두 삭제됩니다.</p>
                            </li>
                            <li class="d-flex"><span class="flex-shrink-0 mr-2 mb_5">-</span>
                                <p>게시판에 등록한 게시물은 직접 삭제해야 합니다. (개인정보 노출 방지를 위해 연락처 및 전자메일은 유추할 수 없도록 처리되어있습니다.)</p>
                            </li>
                            <li class="d-flex"><span class="flex-shrink-0 mr-2">-</span>
                                <p>탈퇴시 출원 상표 및 등록 상표에 관한 특허청 통지서를 안내해드리지 않으며, 이에 따른 문제 발생시 닥터마크에서 책임지지 않습니다.</p>
                            </li>
                        </ul>
                    </div>

                    <div class="input-group mb_22">
                        <div class="checks mr-5">
                            <input type="checkbox" name="ff" id="f1" checked>
                            <label for="f1">회원탈퇴 시 처리사항 안내를 확인하였음에 동의합니다.</label>
                        </div>
                    </div>

                    <div class=" btn_group d-flex justify-content-center mb_70 mb-md-0">
                        <button type="button" class="btn btn-primary btn-md btn_style03 mr-3" onclick="checkBoxValue()">탈퇴하기</button>
                        <button type="button" class="btn btn-secondary btn-md btn_style03" onclick="location.href='./account_management.php'">취소</button>
                    </div>


                </div>
                <!-- w-65 끝-->

                <!-- division 끝 / 서브페이지 영역 2분할 -->
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->
<!-- Modal -->
<div class="modal fade" id="secession" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p class="mt_50 mb_35 fs_18"><span class="fw_500 fc_gr444">회원 탈퇴</span> 하시겠습니까?</p>
            </div>
            <div class="modal-footer">
                <div class="btn_group d-flex justify-content-center mb_70 mb-md-0">
                    <button type="button" class="btn btn-primary btn-md btn_style03 mr-3" onclick="setSecession()" >탈퇴하기</button>
                    <button type="button" class="btn btn-secondary btn-md btn_style03" data-dismiss="modal" aria-label="Close">취소</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal 끝-->
<!-- Modal -->
<div class="modal fade" id="secessionResult" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p class="mt_50 mb_35 fs_18">회원탈퇴가 되었습니다.</p>
            </div>
            <div class="modal-footer">
                <div class="btn_group d-flex justify-content-center mb_70 mb-md-0">
                    <button type="button" class="btn btn-primary btn-md btn_style03 mr-3" onclick="location.href='./index.php'" >확인</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal 끝-->
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
    //checkbox 확인
    function checkBoxValue(){
        var result = document.getElementById('f1').checked;
        if(result == true){
            $('#secession').modal();
        }else{
            alert("회원탈퇴 시 처리사항 안내를 확인하였음에 동의가 필요합니다.");
        }
    }
    //탈퇴 진행 함수
    function setSecession(){
        $.ajax({
            url: "JYController/member_secession.php",
            data: {},
            type: "post",
            dataType: "json",
            success: function(result){
                console.log(result);
                if(result.success==1){
                    $('#secession').modal('hide');
                    $('#secessionResult').modal('show');
                }else{
                    alert("탈퇴 중 에러가 발생하였습니다.");
                }
            }
                
        });
    }
</script>
<? include_once("./foot_inc.php"); ?>
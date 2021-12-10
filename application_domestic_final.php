<?php
include "./head_inc.php";
?>
<div class="sub_pg">
    <div class="container-fluid px-0">
        <div class="container-xl ">
            <div class="container01 mx-auto">

                <h2 class="sub_tit">상표출원하기</h2>

                <div class="bg-light rounded p_20_25 mb_80">
                    <div class="d-flex align-items-center mb-1">
                        <p class="fw_500 fc_gr222 mr-3">접수번호</p>
                        <p class="fw_500">21090305245928</p>
                    </div>
                    <p class="fc_primary">입력하신 내용으로 상표 출원 신청이 접수되었습니다.</p>
                </div>


                <h3 class="sub_tit2 text-center">결제를 완료했습니다.</h3>
                <ul class="process">
                    <li class="active">
                        <p>접수</p>
                    </li>
                    <li>
                        <p>출원완료</p>
                    </li>
                    <li>
                        <p>심사</p>
                    </li>
                    <li>
                        <p>출원공고</p>
                    </li>
                    <li>
                        <p>등록완료</p>
                    </li>
                </ul>

                <div class="btn_group d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="location.href='./pending_application_list.php'">내역보기</button>
                    <button type="button" class="btn btn-primary btn-md btn_style03" onclick="location.href='./application_domestic_step1.php'">신규 상표출원</button>
                </div>


            </div>
        </div>
    </div>
</div>
<?php
include "./foot_inc.php";
?>

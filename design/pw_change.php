<? include_once("./inc/head.php"); ?>
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
                            <input type="password" class="form-control mr-0" placeholder="새 비밀번호를 입력해주세요">
                            <button class="pw pw_off"></button>
                            <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                        </div>
                    </div>
                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex mb-3">
                            <h5>비밀번호 재입력</h5>
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control mr-0" placeholder="새 비밀번호를 재입력해주세요">
                            <button class="pw pw_off"></button>
                            <!-- .pw_off 비밀번호 눈꺼짐 / .pw_on 비밀번호 눈켜짐-->
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-lg btn-block mb_50" data-toggle="modal" data-target="#pw">변경하기</button>
                </form>
            </div>
            <!-- container02-->
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->
<? include_once("./inc/tail.php"); ?>


<!-- Modal -->
<div class="modal fade" id="pw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">비밀번호 찾기</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="xi-close fs_36 fc_grccc"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                <p class="mt_50 mb_35 fs_18">성공적으로 <span class="fw_500 fc_gr444">비밀번호가 변경</span>이 되었습니다.</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary btn-lg btn-block">확인</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal 끝-->
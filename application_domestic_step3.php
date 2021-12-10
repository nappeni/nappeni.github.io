<?php
include "./head_inc.php";
if(!$_SESSION['mt_id']){
    alert("로그인 후 이용해주세요.", "./login.php");
}
// 다음 주소 검색 사용
$chk_post_code = "Y";

$sql = "select * from member_t where idx = '{$_SESSION['mt_idx']}' ";
$mta = $DB->fetch_assoc($sql);

$sql = "select * from d_app_domestic where mt_idx = '{$_SESSION['mt_idx']}' and app_status < 1 and d_datetime = '' order by idx desc limit 1 ";
$dad = $DB->fetch_assoc($sql);
if($dad['applicant_jumin']){
    $arr_jumin = explode("-",$dad['applicant_jumin']);
}

$sqlb = "select dadi.*, sd.s_name from d_app_domestic_item dadi ";
$sqlb .= "left join d_app_domestic dad on dad.idx = dadi.app_idx ";
$sqlb .= "left join service_domestic sd on sd.idx = dadi.cate_s ";
$sqlb .= "where dad.mt_idx = '{$_SESSION['mt_idx']}' and dad.idx = '{$dad['idx']}' order by dadi.idx desc ";
$listb = $DB->select_query($sqlb);

$sqlc = "select sd.idx, sd.s_name, count(sd.idx) as s_cnt, sum(sd.s_price) as s_price from d_app_domestic_item dadi ";
$sqlc .= "left join d_app_domestic dad on dad.idx = dadi.app_idx ";
$sqlc .= "left join service_domestic sd on sd.idx = dadi.cate_s ";
$sqlc .= "where dad.mt_idx = '{$_SESSION['mt_idx']}' and app_idx = '{$dad['idx']}' ";
$sqlc .= "group by sd.idx ";
$listc = $DB->select_query($sqlc);

$sqld = "select sum(sd.s_price) as sum_price from d_app_domestic_item dadi ";
$sqld .= "left join d_app_domestic dad on dad.idx = dadi.app_idx ";
$sqld .= "left join service_domestic sd on sd.idx = dadi.cate_s ";
$sqld .= "where dad.mt_idx = '{$_SESSION['mt_idx']}' and app_idx = '{$dad['idx']}' ";
$rowd = $DB->fetch_assoc($sqld);

if($_SESSION['mt_name_app']!=""){
    $mt_name = $_SESSION['mt_name_app'];
}else if($dad['mt_name']!=""){
    $mt_name = $dad['mt_name'];
}else{
    $mt_name = $mta['mt_name'];
}

if($_SESSION['mt_email_app']!=""){
    $mt_email = $_SESSION['mt_email_app'];
}else if($dad['mt_email']!=""){
    $mt_email = $dad['mt_email'];
}else{
    $mt_email = $mta['mt_id'];
}

if($dad['mt_hp']!=""){
    $mt_hp = str_replace("-","",$dad['mt_hp']);
}else if($_SESSION['mt_hp_app']!=""){
    $mt_hp = str_replace("-","",$_SESSION['mt_hp_app']);
}else{
    $mt_hp = str_replace("-","",$mta['mt_hp']);
}

if($dad['mt_tel']!=""){
    $mt_tel = str_replace("-","",$dad['mt_tel']);
}else if($_SESSION['mt_tel_app']!=""){
    $mt_tel = str_replace("-","",$_SESSION['mt_tel_app']);
}else{
    $mt_tel = str_replace("-","",$mta['mt_tel']);
}

if($_SESSION['chk_info1']!=""){
    $chk_info1 = $_SESSION['chk_info1'];
}else{
    $chk_info1 = $dad['chk_info1'];
}

if($_SESSION['chk_info2']!=""){
    $chk_info2 = $_SESSION['chk_info2'];
}else{
    $chk_info2 = $dad['chk_info2'];
}

if($_SESSION['type_applicant']!=""){
    $type_applicant = $_SESSION['type_applicant'];
}else{
    $type_applicant = $dad['type_applicant'];
}

if($_SESSION['applicant_name_k']!=""){
    $applicant_name_k = $_SESSION['applicant_name_k'];
}else{
    $applicant_name_k = $dad['applicant_name_k'];
}

if($_SESSION['applicant_name_e']!=""){
    $applicant_name_e = $_SESSION['applicant_name_e'];
}else{
    $applicant_name_e = $dad['applicant_name_e'];
}

if($_SESSION['applicant_jumin1']!=""){
    $applicant_jumin1 = $_SESSION['applicant_jumin1'];
}else{
    if($dad['applicant_jumin']){
        $applicant_jumin1 = $arr_jumin[0];
    }else{
        $applicant_jumin1 = "";
    }
}

if($_SESSION['applicant_jumin2']!=""){
    $applicant_jumin2 = $_SESSION['applicant_jumin2'];
}else{
    if($dad['applicant_jumin']){
        $applicant_jumin2 = $arr_jumin[1];
    }else{
        $applicant_jumin2 = "";
    }
}

if($_SESSION['applicant_email']!=""){
    $applicant_email = $_SESSION['applicant_email'];
}else{
    if($dad['applicant_email']){
        $applicant_email = $dad['applicant_email'];
    }else{
        $applicant_email = "";
    }
}

if($_SESSION['applicant_hp']!=""){
    $applicant_hp = $_SESSION['applicant_hp'];
}else{
    if($dad['applicant_hp']){
        $applicant_hp = $dad['applicant_hp'];
    }else{
        $applicant_hp = "";
    }
}

if($_SESSION['applicant_tel']!=""){
    $applicant_tel = $_SESSION['applicant_tel'];
}else{
    if($dad['applicant_tel']){
        $applicant_tel = $dad['applicant_tel'];
    }else{
        $applicant_tel = "";
    }
}

if($_SESSION['applicant_addr1']!=""){
    $applicant_addr1 = $_SESSION['applicant_addr1'];
}else{
    if($dad['applicant_addr1']){
        $applicant_addr1 = $dad['applicant_addr1'];
    }else{
        $applicant_addr1 = "";
    }
}

if($_SESSION['applicant_addr2']!=""){
    $applicant_addr2 = $_SESSION['applicant_addr2'];
}else{
    if($dad['applicant_addr2']){
        $applicant_addr2 = $dad['applicant_addr2'];
    }else{
        $applicant_addr2 = "";
    }
}

if($_SESSION['applicant_addr3']!=""){
    $applicant_addr3 = $_SESSION['applicant_addr3'];
}else{
    if($dad['applicant_addr3']){
        $applicant_addr3 = $dad['applicant_addr3'];
    }else{
        $applicant_addr3 = "";
    }
}

if($_SESSION['chk_agent']!=""){
    $chk_agent = $_SESSION['chk_agent'];
}else{
    if($dad['chk_agent']){
        $chk_agent = $dad['chk_agent'];
    }else{
        $chk_agent = "";
    }
}

if($_SESSION['agent_file']!=""){
    $agent_file = $_SESSION['agent_file'];
}else{
    if($dad['agent_file']){
        $agent_file = $dad['agent_file'];
    }else{
        $agent_file = "";
    }
}

if($_SESSION['agent_file_origin']!=""){
    $agent_file_origin = $_SESSION['agent_file_origin'];
}else{
    if($dad['agent_file_origin']){
        $agent_file_origin = $dad['agent_file_origin'];
    }else{
        $agent_file_origin = "";
    }
}

$merchant_uid = "ORD".date("Ymd")."-".randomcode2(10);
//while (true){
    //$merchant_uid = "ORD".date("Ymd")."-".randomcode2(10);
    //$sql = "select * from order_domestic where merchant_uid = '{$merchant_uid}' ";
    //$rowz = $DB->fetch_assoc($sql);
    //if($rowz['idx']){ break; }
//}
?>
<div class="sub_pg application_domestic">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <form id="form1" method="post" enctype="multipart/form-data" action="./application_domestic_step3_update.php">
                <input type="hidden" name="app_idx" value="<?= $dad['idx'] ?>">
                <div class="division d-block d-xl-flex justify-content-between align-items-start">
                    <div class="w-65">
                        <h2 class="sub_tit">상표출원하기</h2>

                        <!-- 상표출원 단계 -->
                        <div class="step d-flex flex-wrap mb_15">
                            <button type="button" class="btn btn-outline-secondary btn-md mr_8 no-cursor">1. 상표정보 입력</button>
                            <button type="button" class="btn btn-outline-secondary btn-md mr_8 no-cursor">2. 상품분류 및 서비스 선택</button>
                            <button type="button" class="btn btn-outline-primary btn-md mr_8 no-cursor">3. 상표 권리자 정보 등록</button>
                            <button type="button" class="btn btn-outline-secondary btn-md no-cursor">4. 최종 확인 및 결제</button>
                        </div>
                        <!-- 상표출원 단계 끝-->


                        <!-- 상표출원 임시저장 -->
                        <!--<div class="d-flex align-items-center bg-light rounded p_15_20 justify-content-between mb_50">
                            <div class="d-flex mr-3">
                                <i class=" xi-info-o fc_primary fs_19 mr_8 mt-1"></i></i>
                                <p class="fc_primary">임시저장하여 나중에 돌아오실때 저장 되었던 곳에서 진행하세요.</p>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm">임시저장</button>
                        </div>-->
                        <!-- 상표출원 임시저장 끝 -->



                        <h3 class="sub_tit2">담당자 정보</h3>
                        <div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>담당자명 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mt_name" id="mt_name" placeholder="담당자 이름을 입력하세요" value="<?= $mt_name ?>" onkeyup="save_session('mt_name_app',this.value)" required>
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mt_email" id="mt_email" placeholder="이메일을 입력하세요" value="<?= $mt_email ?>" onkeyup="save_session('mt_email_app',this.value)" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row mb_50">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>휴대전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mt_hp" id="mt_hp" placeholder="'-'없이 번호를 입력하세요" value="<?= $mt_hp ?>" onkeyup="nohypen_save_session('mt_hp','mt_hp_app',this.value)" required>
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>유선 전화번호 <span class="fc_gr666 fw_300 fs_16">(선택)</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="mt_tel" id="mt_tel" placeholder="'-'없이 번호를 입력하세요" value="<?= $mt_tel ?>" onkeyup="nohypen_save_session('mt_tel','mt_tel_app',this.value)">
                                </div>
                            </div>
                        </div>


                        <h3 class="sub_tit2">출원인 정보</h3>
                        <div class="input-group br_bottom pb_15 mb_22">
                            <div class="checks mr-5">
                                <input type="checkbox" name="chk_info1" id="chk_info1" value="Y" onclick="click_chk_info1()" <? if($chk_info1=="Y"){echo 'checked';} ?> >
                                <label for="chk_info1">담당자 정보와 동일</label>
                            </div>
                            <div class="checks div_chk_info2">
                                <input type="checkbox" name="chk_info2" id="chk_info2" value="Y" <? if($chk_info2=="Y"){echo 'checked';} ?> >
                                <label for="chk_info2">공동출원</label>
                                <i class="xi-help fs_19 fc_graaa"></i>
                            </div>
                        </div>


                        <div class="ip_tit d-flex align-items-center d-flex  mb-3 wrap_type_applicant">
                            <h5>출원유형 <span class="fc_primary">*</span></h5>
                        </div>
                        <div class="input-group mb_22 wrap_type_applicant">
                            <div class="input-group-prepend">
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="type_applicant" id="type_applicant1" class="type_applicant" value="1" required onclick="click_type_applicant1()" <? if($type_applicant=="0" || $type_applicant==1){echo 'checked';} ?> >
                                    <label for="type_applicant1">국내개인</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="type_applicant" id="type_applicant2" class="type_applicant" value="2" required onclick="click_type_applicant1()" <? if($type_applicant==2){echo 'checked';} ?> >
                                    <label for="type_applicant2">국내법인</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="type_applicant" id="type_applicant3" class="type_applicant" value="3" required onclick="click_type_applicant1()" <? if($type_applicant==3){echo 'checked';} ?> >
                                    <label for="type_applicant3">외국개인</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="type_applicant" id="type_applicant4" class="type_applicant" value="4" required onclick="click_type_applicant1()" <? if($type_applicant==4){echo 'checked';} ?> >
                                    <label for="type_applicant4">외국법인</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0">
                                    <input type="radio" name="type_applicant" id="type_applicant5" class="type_applicant" value="5" required onclick="click_type_applicant1()" <? if($type_applicant==5){echo 'checked';} ?> >
                                    <label for="type_applicant5">국가기관</label>
                                </div>
                            </div>
                        </div>



                        <!------------------------------------------------------------------------------------------------------------------------>



                        <div class="form-row con_type1">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인명 (한글) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_name_k" id="applicant_name_k" placeholder="출원인명을 한글로 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인명 (영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_name_e" id="applicant_name_e" placeholder="출원인명을 영문으로 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type1">
                            <div class="ip_wr col-md-6 mb-3 mb-md-4">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 주민 등록번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_jumin1" id="applicant_jumin1" placeholder="주민 등록번호 앞자리 6자리" maxlength="6">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit align-items-center d-none d-md-flex mb-3 fc_wh">
                                    <h5 class="fc_wh">출원인 주민 등록번호 <span class="fc_wh">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="applicant_jumin2" id="applicant_jumin2" placeholder="주민 등록번호 뒷자리 7자리" maxlength="7">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type1">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_email" id="applicant_email" placeholder="이메일을 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type1">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 휴대전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_hp" id="applicant_hp" placeholder="'-'없이 번호를 입력하세요" onkeyup="nohypen_input('applicant_hp')">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 유선전화 <span class="fc_gr666 fw_300 fs_16">(선택)</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_tel" id="applicant_tel" placeholder="'-'없이 번호를 입력하세요" onkeyup="nohypen_input('applicant_tel')">
                                </div>
                            </div>
                        </div>

                        <div class="ip_wr mb_50 con_type1">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>출원인 등본상 주소 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" id="applicant_addr1" name="applicant_addr1" placeholder="우편번호">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-md btn_sch_addr" type="button" onclick="execDaumPostcode()">주소찾기</button>
                                </div>
                            </div>
                            <input type="text" class="form-control mb_8" id="applicant_addr2" name="applicant_addr2" placeholder="주소">
                            <input type="text" class="form-control" id="applicant_addr3" name="applicant_addr3" placeholder="상세주소 입력">
                        </div>



                        <!------------------------------------------------------------------------------------------------------------------------>



                        <div class="form-row con_type2">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 명칭 (한글) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cop_name_k" id="cop_name_k" placeholder="법인 명칭을 한글로 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 명칭 (영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cop_name_e" id="cop_name_e" placeholder="법인 명칭을 영문으로 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type2">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>법인 인감(사용인감) <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" name="file_cop1_origin" id="file_cop1_origin" readonly placeholder="파일명은 ‘띄어쓰기 없이 영문’으로 첨부 해주세요. 선택 최대용량: 20MB">
                                <input type="file" name="file_cop1" id="file_cop1" class="hide">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-md" onclick="click_btn_file_cop1()">파일 첨부</button>
                                </div>
                            </div>
                            <script>
                                function click_btn_file_cop1(){
                                    $("#file_cop1").click();
                                }
                                $("#file_cop1").on("change", function(event){
                                    ajax_post_file2("domestic_step3","form1","file_cop1_origin");
                                });
                            </script>
                        </div>

                        <div class="form-row con_type2">
                            <div class="ip_wr col-md-6 mb-3 mb-md-4">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 등록번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="num_corporate_reg1" id="num_corporate_reg1" placeholder="법인 등록번호 앞자리">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit align-items-center d-none d-md-flex mb-3 fc_wh">
                                    <h5 class="fc_wh">법인 등록번호 <span class="fc_wh">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="num_corporate_reg2" id="num_corporate_reg2" placeholder="법인 등록번호 뒷자리">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type2">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>사업자등록번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="num_business" id="num_business">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>대표자 성명 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="boss_name" id="boss_name">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type2">
                            <div class="ip_wr col-md-6 mb-3 mb-md-4">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>대표자 주민등록번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="boss_jumin1" id="boss_jumin1" maxlength="6" placeholder="주민등록번호 앞자리">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit align-items-center d-none d-md-flex mb-3 fc_wh">
                                    <h5 class="fc_wh">대표자 주민등록번호 <span class="fc_wh">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="boss_jumin2" id="boss_jumin2" maxlength="7" placeholder="주민등록번호 뒷자리">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type2">
                            <div class="ip_wr col-md-6 mb-3 mb-md-4">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 대표 이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="corp_boss_email" id="corp_boss_email">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6 mb-3 mb-md-4">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 대표 휴대전화</h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="corp_boss_hp" id="corp_boss_hp" placeholder="'-'없이 번호를 입력하세요" onkeyup="nohypen_input('corp_boss_hp')">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type2">
                            <div class="ip_wr col-md-6 mb-3 mb-md-4">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 대표 유선전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="corp_boss_tel" id="corp_boss_tel" placeholder="'-'없이 번호를 입력하세요" onkeyup="nohypen_input('corp_boss_tel')">
                                </div>
                            </div>
                        </div>



                        <!------------------------------------------------------------------------------------------------------------------------>



                        <div class="form-row con_type3">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인명 (한글) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_name_k3" id="applicant_name_k" placeholder="출원인명을 한글로 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인명 (영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_name_e3" id="applicant_name_e" placeholder="출원인명을 영문으로 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type3">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>대표자 서명 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" name="file_sign3_origin" id="file_sign3_origin" readonly placeholder="파일명은 ‘띄어쓰기 없이 영문’으로 첨부 해주세요. 선택 최대용량: 20MB">
                                <input type="file" name="file_sign3" id="file_sign3" class="hide">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-md unset_zindex" onclick="click_btn_file_sign3()">파일 첨부</button>
                                </div>
                            </div>
                            <script>
                                function click_btn_file_sign3(){
                                    $("#file_sign3").click();
                                }
                                $("#file_sign3").on("change", function(event){
                                    ajax_post_file2("domestic_step3","form1","file_sign3_origin");
                                });
                            </script>
                        </div>

                        <div class="form-row con_type3">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>국적 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <select class="form-control" name="nation" id="nation">
                                        <option value="">국적 선택</option>
                                        <?
                                        $sqle = "select nation from g5_nation order by nation asc ";
                                        $liste = $DB->select_query($sqle);
                                        foreach ($liste as $rowe){
                                            ?>
                                            <option value="<?= $rowe['nation'] ?>"><?= $rowe['nation'] ?></option>
                                            <?
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type3">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>외국인 등록증 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <div class="checks mr-5">
                                        <input type="radio" name="chk_cert_foreigner" id="chk_cert_foreigner1" value="Y">
                                        <label for="chk_cert_foreigner1">있음</label>
                                    </div>
                                    <div class="checks">
                                        <input type="radio" name="chk_cert_foreigner" id="chk_cert_foreigner2" value="N" checked>
                                        <label for="chk_cert_foreigner2">없음</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type3">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>여권 사본</h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" name="file_passport_origin" id="file_passport_origin" readonly placeholder="파일명은 ‘띄어쓰기 없이 영문’으로 첨부 해주세요. 선택 최대용량: 20MB">
                                <input type="file" name="file_passport" id="file_passport" class="hide">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-md unset_zindex" onclick="click_btn_file_passport()">파일 첨부</button>
                                </div>
                            </div>
                            <script>
                                function click_btn_file_passport(){
                                    $("#file_passport").click();
                                }
                                $("#file_passport").on("change", function(event){
                                    ajax_post_file2("domestic_step3","form1","file_passport_origin");
                                });
                            </script>
                        </div>

                        <div class="form-row con_type3">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>여권 번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="num_passport" id="num_passport" placeholder="">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_email3" id="applicant_email" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="form-row cert_fore">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>출원인 휴대전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="applicant_hp3" id="applicant_hp3" placeholder="'-'없이 번호를 입력하세요" onkeyup="nohypen_input('applicant_hp3')">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type3">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>해외 주소 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="addr_overseas" id="addr_overseas" placeholder="영문으로 작성해주세요.">
                                </div>
                            </div>
                        </div>

                        <div class="form-row cert_fore">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>외국인 등록증 앞면 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="file1_cert_forei_origin" id="file1_cert_forei_origin" readonly placeholder="">
                                    <input type="file" name="file1_cert_forei" id="file1_cert_forei" class="hide">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary btn-md unset_zindex" onclick="click_btn_file1_cert_forei()">파일 첨부</button>
                                    </div>
                                </div>
                                <script>
                                    function click_btn_file1_cert_forei(){
                                        $("#file1_cert_forei").click();
                                    }
                                    $("#file1_cert_forei").on("change", function(event){
                                        ajax_post_file2("domestic_step3","form1","file1_cert_forei_origin");
                                    });
                                </script>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>외국인 등록증 뒷면 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="file2_cert_forei_origin" id="file2_cert_forei_origin" readonly placeholder="">
                                    <input type="file" name="file2_cert_forei" id="file2_cert_forei" class="hide">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary btn-md unset_zindex" onclick="click_btn_file2_cert_forei()">파일 첨부</button>
                                    </div>
                                </div>
                                <script>
                                    function click_btn_file2_cert_forei(){
                                        $("#file2_cert_forei").click();
                                    }
                                    $("#file2_cert_forei").on("change", function(event){
                                        ajax_post_file2("domestic_step3","form1","file2_cert_forei_origin");
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="form-row cert_fore">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>외국인 등록번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="num_cert_forei" id="num_cert_forei" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="ip_wr mb_50 cert_fore">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>외국인등록증상 주소 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" id="cert_forei_addr1" name="cert_forei_addr1" placeholder="우편번호">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-md btn_sch_addr" type="button" onclick="execDaumPostcode4()">주소찾기</button>
                                </div>
                            </div>
                            <input type="text" class="form-control mb_8" id="cert_forei_addr2" name="cert_forei_addr2" placeholder="주소">
                            <input type="text" class="form-control" id="cert_forei_addr3" name="cert_forei_addr3" placeholder="상세주소 입력">
                        </div>



                        <!------------------------------------------------------------------------------------------------------------------------>



                        <div class="form-row con_type4">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 명칭 (한글) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cop_name_k4" id="cop_name_k4" placeholder="법인 명칭을 한글로 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 명칭 (영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cop_name_e4" id="cop_name_e4" placeholder="법인 명칭을 영문으로 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type4">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>대표자 서명 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" name="file_sign4_origin" id="file_sign4_origin" readonly placeholder="파일명은 ‘띄어쓰기 없이 영문’으로 첨부 해주세요. 선택 최대용량: 20MB">
                                <input type="file" name="file_sign4" id="file_sign4" class="hide">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-md unset_zindex" onclick="click_btn_file_sign4()">파일 첨부</button>
                                </div>
                            </div>
                            <script>
                                function click_btn_file_sign4(){
                                    $("#file_sign4").click();
                                }
                                $("#file_sign4").on("change", function(event){
                                    ajax_post_file2("domestic_step3","form1","file_sign4_origin");
                                });
                            </script>
                        </div>

                        <div class="form-row con_type4">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>국적 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <select class="form-control" name="nation4" id="nation4">
                                        <option value="">국적 선택</option>
                                        <?
                                        $sqle = "select nation from g5_nation order by nation asc ";
                                        $liste = $DB->select_query($sqle);
                                        foreach ($liste as $rowe){
                                            ?>
                                            <option value="<?= $rowe['nation'] ?>"><?= $rowe['nation'] ?></option>
                                            <?
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type4">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>대표자 성명 (영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="boss_name4" id="boss_name4" placeholder="영문으로 작성해주세요.">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type4">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 대표 이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="corp_boss_email4" id="corp_boss_email4" placeholder="">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법인 주소 (영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="addr_overseas4" id="addr_overseas4" placeholder="영문으로 작성해주세요.">
                                </div>
                            </div>
                        </div>



                        <!------------------------------------------------------------------------------------------------------------------------>



                        <div class="form-row con_type5">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>국가/공공 기관명 (한글) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name_institution_k" id="name_institution_k" placeholder="국가/공공 기관명을 한글로 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>국가/공공 기관명 (영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name_institution_e" id="name_institution_e" placeholder="국가/공공 기관명을 영문으로 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type5 mb-3">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-6">
                                <h5>공인대장(기관인감) <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" name="file1_institution_origin" id="file1_institution_origin" readonly placeholder="파일명은 ‘띄어쓰기 없이 영문’으로 첨부 해주세요. 선택 최대용량: 20MB">
                                <input type="file" name="file1_institution" id="file1_institution" class="hide">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-md unset_zindex" onclick="click_btn_file1_institution()">파일 첨부</button>
                                </div>
                            </div>
                            <script>
                                function click_btn_file1_institution(){
                                    $("#file1_institution").click();
                                }
                                $("#file1_institution").on("change", function(event){
                                    ajax_post_file2("domestic_step3","form1","file1_institution_origin");
                                });
                            </script>
                        </div>

                        <div class="form-row con_type5">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>고유번호(사업자 등록번호) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="num_busi_insti" id="num_busi_insti" placeholder="">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>기관 대표 이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="boss_email_insti" id="boss_email_insti" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_type5">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>기관 대표 유선전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="boss_tel_insti" id="boss_tel_insti" placeholder="" onkeyup="nohypen_input('boss_tel_insti')">
                                </div>
                            </div>
                        </div>

                        <div class="ip_wr mb_50 con_type5">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>출원인 등본상 주소 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" id="insti_addr1" name="insti_addr1" placeholder="우편번호">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-md btn_sch_addr" type="button" onclick="execDaumPostcode2()">주소찾기</button>
                                </div>
                            </div>
                            <input type="text" class="form-control mb_8" id="insti_addr2" name="insti_addr2" placeholder="주소">
                            <input type="text" class="form-control" id="insti_addr3" name="insti_addr3" placeholder="상세주소 입력">
                        </div>



                        <!------------------------------------------------------------------------------------------------------------------------>



                        <div class="border_bk mb_50 mt_50"></div>

                        <h3 class="sub_tit2">법정 대리인 정보</h3>

                        <div class="input-group br_bottom pb_15 mb_22">
                            <div class="checks mr-5">
                                <input type="checkbox" name="chk_agent" id="chk_agent" value="Y" <? if($chk_agent=="Y"){echo "checked";} ?> >
                                <label for="chk_agent">법정 대리인 필요<p class="fs_14 fc_gr999 mt-2">※ 만 n세 이하의 미성년자는 특허법상 독립적으로 출원을 진행할 수 없습니다. (특허법 3조)</p></label>
                            </div>
                        </div>

                        <div class="form-row con_agent">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 성명(한글) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="agent_name_k" id="agent_name_k" placeholder="법정 대리인 성명 한글로 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 성명(영문) <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="agent_name_e" id="agent_name_e" placeholder="법정 대리인 성명 영문으로 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_agent">
                            <div class="ip_wr col-md-6 mb-3 mb-md-4">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 주민 등록번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="agent_jumin1" id="agent_jumin1" maxlength="6" placeholder="법정 대리인 주민 등록번호 앞자리 6자리">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit align-items-center d-none d-md-flex mb-3 fc_wh">
                                    <h5 class="fc_wh">법정 대리인 주민 등록번호 <span class="fc_wh">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="agent_jumin2" id="agent_jumin2" maxlength="7" placeholder="법정 대리인 주민 등록번호 뒷자리 7자리">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_agent">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="agent_email" id="agent_email" placeholder="이메일을 입력하세요">
                                </div>
                            </div>
                        </div>

                        <div class="form-row con_agent">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 휴대전화 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="agent_hp" id="agent_hp" placeholder="'-'없이 번호를 입력하세요" onkeyup="nohypen_input('agent_hp')">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>법정 대리인 유선전화</h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="agent_tel" id="agent_tel" placeholder="'-'없이 번호를 입력하세요" onkeyup="nohypen_input('agent_tel')">
                                </div>
                            </div>
                        </div>

                        <div class="ip_wr mb_50 con_agent">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>법정 대리인 등본상 주소 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" name="agent_addr1" id="agent_addr1" placeholder="우편번호">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary btn-md btn_sch_addr" type="button" onclick="execDaumPostcode3()">주소찾기</button>
                                </div>
                            </div>
                            <input type="text" class="form-control mb_8" name="agent_addr2" id="agent_addr2" placeholder="도로명/ 지번 주소">
                            <input type="text" class="form-control" name="agent_addr3" id="agent_addr3" placeholder="상세주소 입력">
                        </div>

                        <div class="form-row con_agent">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>주민등록등본 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" name="agent_file_origin" id="agent_file_origin" value="<?= $agent_file_origin ?>" readonly placeholder="파일명은 ‘띄어쓰기 없이 영문’으로 첨부 해주세요. 선택 최대용량: 20MB">
                                <input type="file" name="agent_file" id="agent_file" class="hide">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-md" onclick="click_btn_agent_file()">파일 첨부</button>
                                </div>
                            </div>
                            <script>
                                function click_btn_agent_file(){
                                    $("#agent_file").click();
                                }
                                $("#agent_file").on("change", function(event){
                                    ajax_post_file2("domestic_step3","form1","agent_file_origin");
                                });
                            </script>
                        </div>

                        <div class="jm-d-flex align-items-center mb_50 con_agent">
                            <div class="input-group d-inline w-auto">
                                <div class="checks mr-3">
                                    <input type="checkbox" name="chk_agree_agent" id="chk_agree_agent" value="Y" onclick="click_agree_agent()">
                                    <label for="chk_agree_agent" class="d-flex" onclick="click_agree_agent()">(필수) 법정대리인 위임장 동의</label>
                                </div>
                            </div>
                            <a class="fc_primary mt_2 a_link cursor_pointer" data-toggle="modal" data-target="#v_con_wiim">자세히 보기</a>
                            <div class="modal fade" id="v_con_wiim" tabindex="-1" aria-labelledby="v_con_wiimLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header align-items-center">
                                            <h5 class="modal-title" id="v_con_wiimLabel">상표출원위임 동의</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <!-- <span aria-hidden="true">&times;</span> -->
                                                <i class="xi-close fs_36 fc_grccc"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb_30 modal_img">
                                                <img src="./design/img/warrant.jpg" alt="">
                                            </div>
                                            <div class="text-center">
                                                <p class="fc_gr222 fw_500 mb-2">상기와 같은 표준위임장 양식의 공란에 입력하신 출원인에 관한 정보를 입력하여 위임장을 작성하고 특허청에 제출하는 것에 동의합니다.</p>
                                                <p class="fs_14 mb_22 text-danger">(동의하지 않을 경우 상표출원을 진행할 수 없습니다.)</p>
                                            </div>
                                            <form>
                                                <div class="d-flex flex-column align-items-center justify-content-center">
                                                    <p class="fc_gr222 fw_500 mb-2">동의합니다.</p>
                                                    <div class="input-group-prepend">
                                                        <div class="checks mr_30">
                                                            <input type="radio" name="wiim_ac" id="wiim_ac1" value="y">
                                                            <label for="wiim_ac1">예</label>
                                                        </div>
                                                        <div class="checks">
                                                            <input type="radio" name="wiim_ac" id="wiim_ac2" value="n">
                                                            <label for="wiim_ac2">아니요</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                            <button type="button" class="btn btn-primary btn-lg btn-block" onclick="confitm_wiim_ac()">확인</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function click_agree_agent(){
                                if($("#chk_agree_agent:checked").length<1){
                                    $("#v_con_wiim").modal("show");
                                }
                            }
                            function confitm_wiim_ac(){
                                if($("input[name=wiim_ac]:checked").length>0){
                                    if($("input[name=wiim_ac]:checked").val()=='y'){
                                        $("#chk_agree_agent").prop('checked',true);
                                        $("#v_con_wiim").modal("hide");
                                    }else{
                                        alert("상표 출원 위임에 동의해주세요.");
                                        $("#chk_agree_agent").prop('checked',false);
                                    }
                                }else{
                                    alert("상표 출원 위임에 동의해주세요.");
                                    $("#chk_agree_agent").prop('checked',false);
                                }
                            }
                        </script>

                        <div class="border_bk mb_50 mt_50"></div>

                        <h3 class="sub_tit2">결제 정보</h3>

                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>결제수단 <span class="fc_primary">*</span></h5>
                        </div>
                        <div class="input-group mb_22">
                            <div class="input-group-prepend">
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="pay_method" id="pay_method1" checked value="vbank">
                                    <label for="pay_method1">무통장 입금</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="pay_method" id="pay_method2" value="card">
                                    <label for="pay_method2">신용카드</label>
                                </div>
                                <!--<div class="checks mb-2 mb-sm-0 mr-4 mr-sm-5">
                                    <input type="radio" name="pay_method" id="pay_method3">
                                    <label for="pay_method3">네이버 페이</label>
                                </div>
                                <div class="checks mb-2 mb-sm-0">
                                    <input type="radio" name="pay_method" id="pay_method4">
                                    <label for="pay_method4">카카오페이</label>
                                </div>-->
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="ip_wr wd-100">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>추천인 코드</h5>
                                </div>
                                <div class="my-2 font-14">사용할 추천인 코드는 한번만 사용이 가능하며, 등록시에 결제금액의 5% 할인을 받습니다.</div>
                                <div class="input-group">
                                    <input type="hidden" class="form-control" id="use_code_person_id" value="">
                                    <input type="text" class="form-control" name="code_person_id" id="code_person_id">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary btn-md" onclick="click_btn_discount_cd()">등록</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--<div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>상호명 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="comp_name" id="comp_name" placeholder="상호명을 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>사업자등록번호 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="business_num" id="business_num" placeholder="사업자등록번호를 입력하세요">
                                </div>
                            </div>
                        </div>-->

                        <!--<div class="form-row">
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>대표자명 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="name_boss" id="name_boss" placeholder="대표자명을 입력하세요">
                                </div>
                            </div>
                            <div class="ip_wr col-md-6">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>이메일 <span class="fc_primary">*</span></h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="email_boss" id="email_boss" placeholder="이메일을 입력하세요">
                                </div>
                            </div>
                        </div>-->

                        <!--<div class="form-row">
                            <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                <h5>주민등록등본 <span class="fc_primary">*</span></h5>
                            </div>
                            <div class="input-group mb_8">
                                <input type="text" class="form-control" name="pay_file_origin" id="pay_file_origin" readonly placeholder="파일명은 ‘띄어쓰기 없이 영문’으로 첨부 해주세요. 선택 최대용량: 20MB">
                                <input type="file" name="pay_file" id="pay_file" class="hide">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary btn-md" onclick="click_btn_pay_file()">파일 첨부</button>
                                </div>
                            </div>
                            <script>
                                function click_btn_pay_file(){
                                    $("#pay_file").click();
                                }
                                $("#pay_file").on("change", function(event){
                                    ajax_post_file2("domestic_step3","form1","pay_file_origin");
                                });
                            </script>
                        </div>-->


                        <!-- 이용약관-->
                        <div class="ip_wr">
                            <div class="border rounded bg-light p_30_20">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>이용약관 및 위임 동의</h5>
                                </div>
                                <div class="checks ml_25 mb-3">
                                    <input type="checkbox" name="chk_agree1" id="chk_agree1">
                                    <label for="chk_agree1">(필수) 개인정보 활용에 동의합니다.</label>
                                </div>
                                <div class="checks ml_25 mb-3">
                                    <input type="checkbox" name="chk_agree2" id="chk_agree2">
                                    <label for="chk_agree2">(필수) 상표출원 관련 업무에 대해 마크 인포에 위임할 것을 동의합니다.</label>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="checks ml_25 d-inline w-auto mr-3">
                                        <input type="checkbox" name="chk_agree3" id="chk_agree3" onclick="click_agree3()">
                                        <label for="chk_agree3" onclick="click_agree3()">(선택) 마케팅 활용에 동의합니다.</label>
                                    </div>
                                    <a class="fc_primary mt_2 a_link cursor_pointer" data-toggle="modal" data-target="#v_con_marketing" onclick="click_agree3()">자세히 보기</a>
                                    <div class="modal fade" id="v_con_marketing" tabindex="-1" aria-labelledby="v_con_marketingLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header align-items-center">
                                                    <h5 class="modal-title" id="v_con_marketingLabel">마케팅 활용</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <!-- <span aria-hidden="true">&times;</span> -->
                                                        <i class="xi-close fs_36 fc_grccc"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mt_50 mb_35 fs_18" style="height: 300px; overflow-y: scroll;">
                                                        <?
                                                        $sqlz = "select st_agree3 from setup_t ";
                                                        $rowz = $DB->fetch_assoc($sqlz);
                                                        echo $rowz['st_agree3'];
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                                                    <!--<button type="button" class="btn btn-primary btn-lg btn-block">확인</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function click_agree3(){
                                            if($("#chk_agree3:checked").length<1){
                                                $("#v_con_marketing").modal("show");
                                                //$("#chk_agree3").prop('checked',true);
                                            }
                                        }
                                    </script>
                                </div>

                            </div>
                        </div>
                        <!-- 이용약관 끝-->



                        <div class="btn_group flex justify-content-center">
                            <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="location.href='application_domestic_step2.php'">이전으로</button>
                            <button type="button" class="btn btn-primary btn-md btn_style03" onclick="pay()">결제하기</button>
                        </div>

                    </div>
                    <!-- w-65 끝-->



                    <!-- w-30 시작-->
                    <div class="w-30 h-80 aside">
                        <div class="aside_scroll">
                            <h3 class="sub_tit2 fc_bdk">선택 상품류 목록</h3>
                            <ul class="select_product_list mb_40 h-auto">
                                <?
                                if(count($listb)>0){
                                    foreach ($listb as $rowb){
                                        $sqlb = "select * from cate_ps1 where ct_id = '{$rowb['cate_ps2']}' ";
                                        $cp1 = $DB->fetch_assoc($sqlb);
                                        if(strlen($cp1['ct_catenum'])<2){ $ct_catenum = "0".$cp1['ct_catenum']; }else{ $ct_catenum = $cp1['ct_catenum']; }
                                        ?>
                                        <li>
                                            <div class="d-flex justify-content-between mb-2">
                                                <p class="fs_17 fc_gr222 fw_500"><?= $rowb['s_name'] ?></p>
                                            </div>
                                            <p><?= $ct_catenum ?>류 : <?= $cp1['ct_name'] ?></p>
                                        </li>
                                        <?
                                    }
                                }
                                ?>
                            </ul>

                            <h3 class="sub_tit2 fc_bdk">결제금액</h3>
                            <div class="bg-wh rounded-lg p_25_20 mb_22">
                                <ul class="payment_list">
                                    <?
                                    if(count($listc)>0){
                                        foreach ($listc as $rowc) {
                                            ?>
                                            <li>
                                                <div class="d-flex align-items-center mr-3">
                                                    <p class="fw_500 fc_gr222 mr-2"><?= $rowc['s_name'] ?></p>
                                                    <p class="fc_grccc">X<?= $rowc['s_cnt'] ?></p>
                                                </div>
                                                <p class="fw_500"><?= number_format($rowc['s_price']) ?>원</p>
                                            </li>
                                            <?
                                        }
                                    }
                                    ?>
                                </ul>
                                <div class="border_bk mb_20"></div>
                                <div class="payment">
                                    <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                    <input type="hidden" name="sum_price" id="sum_price" value="<?= $rowd['sum_price'] ?>">
                                    <p class="fs_24 fc_bdk fw_600" id="view_sum_price"><?= number_format($rowd['sum_price']) ?>원</p>
                                </div>
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>포인트 사용</h5>
                                </div>
                                <div class="input-group mb_10">
                                    <input type="number" class="form-control" placeholder="사용할 포인트를 입력하세요" name="ot_use_point" id="ot_use_point" onkeyup="use_point_domestic(this.value)" onkeypress="use_point_domestic(this.value)">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-md" type="button" onclick="use_allpoint_domestic()">전체사용</button>
                                    </div>
                                </div>
                                <p class="fs_14">보유중인 포인트 : <?= number_format($mta['mt_point']) ?>원</p>
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>할인코드</h5>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="code_sale" id="code_sale" placeholder="할인코드를 입력하세요">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-sm" type="button" onclick="use_salecode_domestic()">등록하기</button>
                                    </div>
                                </div>
                            </div>


                            <div class="pay_fin">
                                <div class="bg-wh rounded-lg p_25_20 br_primary">
                                    <ul class="payment_list">
                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2">주문금액</p>
                                            </div>
                                            <p class="fw_500"><?= number_format($rowd['sum_price']) ?>원</p>
                                        </li>

                                        <!-- 추천인 코드 사용 -->
                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2">추천인코드 등록 (5%)</p>
                                            </div>
                                            <input type="hidden" name="sale_price_mtcode" id="sale_price_mtcode">
                                            <p class="fw_500" id="view_sale_price_mtcode">- 0원</p>
                                        </li>
                                        <!---------------------->

                                        <!-- 할인 코드 사용 -->
                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2" id="txt_sale_price_salecode">할인코드 차감 (0%)</p>
                                            </div>
                                            <input type="hidden" name="sale_price_salecode" id="sale_price_salecode">
                                            <p class="fw_500" id="view_sale_price_salecode">- 0원</p>
                                        </li>
                                        <!---------------------->

                                        <!-- 포인트 사용 -->
                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2">포인트 할인금액</p>
                                            </div>
                                            <input type="hidden" name="sale_price_point" id="sale_price_point">
                                            <p class="fw_500" id="view_sale_price_point">-0원</p>
                                        </li>
                                        <!---------------------->

                                        <li>
                                            <div class="d-flex align-items-center mr-3">
                                                <p class="fw_500 fc_gr222 mr-2">총 할인 금액</p>
                                            </div>
                                            <input type="hidden" name="sale_price_sum" id="sale_price_sum">
                                            <p class="fw_500" id="view_sale_price_sum">- 0원</p>
                                        </li>
                                    </ul>
                                    <div class="border_bk mb_20 bg_gre9"></div>
                                    <div class="payment">
                                        <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                        <input type="hidden" name="pay_price" id="pay_price" value="<?= $rowd['sum_price'] ?>">
                                        <p class="fs_24 fc_bdk fw_600" id="view_pay_price"><?= number_format($rowd['sum_price']) ?>원</p>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="btn_group d-flex d-md-none justify-content-center mt-5 mt-md-0">
                                <button type="button" class="btn btn-secondary btn-md btn_style03 mr-2 mr-md-3" onclick="location.href='application_domestic_step2.php'">이전으로</button>
                                <button type="button" class="btn btn-primary btn-md btn_style03" onclick="pay()">결제하기</button>
                            </div>-->
                        </div>
                    </div>
                    <!-- w-30 끝-->
                </div>
                    <!-- division 끝 / 서브페이지 영역 2분할 -->

            </form>


        </div>
    </div>
</div>
<!-- container-fluid -->
</div>

<script>
    function click_btn_discount_cd(){
        var code_person_id = $("#code_person_id").val();
        chk_mt_discount_cd(code_person_id);
    }

    function use_salecode_domestic(){
        var code_sale = $("#code_sale").val();
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'chk_salecode',
                code_sale:code_sale,
            },
            cache: false,
            success: function(data){
                console.log(data)
                if(data=='a'){
                    alert("작성하신 할인 코드와 일치하는 할인 코드를 찾지 못했습니다.");
                    $("#code_sale").focus();
                }else if(data=='b'){
                    alert("작성하신 할인 코드는 사용 가능 횟수가 0이므로 사용이 불가능합니다.");
                    $("#code_sale").focus();
                }else if(data=='c'){
                    alert("할인 코드 사용 가능 기간 이전입니다.");
                    $("#code_sale").focus();
                }else if(data=='d'){
                    alert("할인 코드 사용 가능 기간이 지났습니다.");
                    $("#code_sale").focus();
                }else if(data=='e'){
                    alert("작성하신 할인 코드는 이미 사용하신 코드입니다.");
                    $("#code_sale").focus();
                }else if(Number(data)>0){
                    const per_sale = Number(data);
                    const num_sale = Number(data)/100;

                    var sum_price = $("#sum_price").val();
                    var sale_price_mtcode = Number($("#sale_price_mtcode").val());
                    var sale_price_salecode = Number(sum_price) * num_sale;
                    var sale_price_point = $("#sale_price_point").val();
                    var sale_price_sum = Number(sale_price_mtcode)+Number(sale_price_salecode)+Number(sale_price_point);;
                    var pay_price = Number(sum_price)-Number(sale_price_sum);

                    $("#sale_price_mtcode").val(sale_price_mtcode);
                    $("#view_sale_price_mtcode").html("- "+addComma(sale_price_mtcode)+"원");

                    $("#sale_price_salecode").val(sale_price_salecode);
                    $("#txt_sale_price_salecode").html("할인코드 차감 ("+per_sale+"%)");
                    $("#view_sale_price_salecode").html("- "+addComma(sale_price_salecode)+"원");

                    $("#sale_price_sum").val(sale_price_sum);
                    $("#view_sale_price_sum").html("- "+addComma(sale_price_sum)+"원");

                    $("#pay_price").val(pay_price);
                    $("#view_pay_price").html(addComma(pay_price)+"원");
                }
            }
        });
    }

    function click_chk_info1(){
        var type_applicant = $(".type_applicant:checked").val();

        var mt_name = $("#mt_name").val();
        var mt_email = $("#mt_email").val();
        var mt_hp = $("#mt_hp").val();
        var mt_tel = $("#mt_tel").val();

        save_session('mt_name_app',mt_name);
        save_session('mt_email_app',mt_email);
        save_session('mt_hp_app',mt_hp);
        save_session('mt_tel_app',mt_tel);

        if(type_applicant==1){
            if($("#chk_info1").is(":checked") === true){
                $(".con_type1 #applicant_name_k").val(mt_name);
                $(".con_type1 #applicant_email").val(mt_email);
                $(".con_type1 #applicant_hp").val(mt_hp);
                $(".con_type1 #applicant_tel").val(mt_tel);
            }else{
                $(".con_type1 #applicant_name_k").val("");
                $(".con_type1 #applicant_email").val("");
                $(".con_type1 #applicant_hp").val("");
                $(".con_type1 #applicant_tel").val("");
            }
        }else if(type_applicant==2){
            if($("#chk_info1").is(":checked") === true){
                $(".con_type2 #corp_boss_email").val(mt_email);
                $(".con_type2 #corp_boss_hp").val(mt_hp);
                $(".con_type2 #corp_boss_tel").val(mt_tel);
            }else{
                $(".con_type2 #corp_boss_email").val("");
                $(".con_type2 #corp_boss_hp").val("");
                $(".con_type2 #corp_boss_tel").val("");
            }
        }else if(type_applicant==3){
            if($("#chk_info1").is(":checked") === true){
                $(".con_type3 #applicant_name_k").val(mt_name);
            }else{
                $(".con_type3 #applicant_name_k").val("");
            }
        }else if(type_applicant==4){
            if($("#chk_info1").is(":checked") === true){
                $(".con_type4 #corp_boss_email4").val(mt_email);
            }else{
                $(".con_type4 #corp_boss_email4").val("");
            }
        }else if(type_applicant==5){
            if($("#chk_info1").is(":checked") === true){
                $(".con_type5 #boss_email_insti").val(mt_email);
            }else{
                $(".con_type5 #boss_email_insti").val("");
            }
        }

    }

    function click_type_applicant1(){
        var strval = $(".type_applicant:checked").val();
        save_session('type_applicant',strval);

        $("#chk_info1").prop("checked",false);
        $("#chk_info2").prop("checked",false);
        save_session('chk_info1',"N");
        save_session('chk_info2',"N");

        if(strval==1){
            $(".div_chk_info2").show();
            $(".con_type1").show();
            $(".con_type2").hide();
            $(".con_type3").hide();
            $(".con_type4").hide();
            $(".con_type5").hide();
        }else if(strval==2){
            $(".div_chk_info2").hide();
            $(".con_type1").hide();
            $(".con_type2").show();
            $(".con_type3").hide();
            $(".con_type4").hide();
            $(".con_type5").hide();
        }else if(strval==3){
            $(".div_chk_info2").hide();
            $(".con_type1").hide();
            $(".con_type2").hide();
            $(".con_type3").show();
            $(".con_type4").hide();
            $(".con_type5").hide();
        }else if(strval==4){
            $(".div_chk_info2").hide();
            $(".con_type1").hide();
            $(".con_type2").hide();
            $(".con_type3").hide();
            $(".con_type4").show();
            $(".con_type5").hide();
        }else if(strval==5){
            $(".div_chk_info2").hide();
            $(".con_type1").hide();
            $(".con_type2").hide();
            $(".con_type3").hide();
            $(".con_type4").hide();
            $(".con_type5").show();
        }

    }

    function keyup_addr(){
        var applicant_addr1 = $("#applicant_addr1").val();
        var applicant_addr2 = $("#applicant_addr2").val();
        var applicant_addr3 = $("#applicant_addr3").val();
        save_session('applicant_addr1',applicant_addr1);
        save_session('applicant_addr2',applicant_addr2);
        save_session('applicant_addr3',applicant_addr3);
    }

    $("#chk_agent").on("click", function () {
        if($(this).is(":checked")==true){
            save_session('chk_agent',"Y");
            $(".con_agent").show();
        }else{
            save_session('chk_agent',"N");
            $(".con_agent").hide();
        }
    });

    $("input[name=chk_cert_foreigner]").on("click",function (){
        var strval = $("input[name=chk_cert_foreigner]:checked").val();
        if(strval=="Y"){
            $(".cert_fore").show();
        }else{
            $(".cert_fore").hide();
        }
    });

    var hd_height = $("#hd").height(); //헤더의 높이를 구합니다.
    $(document).scroll(function() { //페이지내에서 스크롤이 시작되면
        curSc = $(document).scrollTop() + $(window).height(); //현재 스크롤의 위치입니다.
        body_height = $("body").height(); //body의 높이를 구합니다.
        footer_height = $(".ft").height(); // 푸터의 높이를 구합니다.
        bottom_top = body_height - footer_height; //푸터를 제외한 body의 길이를 구합니다.
        if (window.innerWidth > 1560) {

            if (curSc > bottom_top + 20) { // 현재 스크롤의 높이가 body_top 보다 크다면 (하단 영역에 도착했다면)  *20 은 적당히 조절해주시면 됩니다.
                $(".aside").css('top', 'auto'); //fixed top 성질을 없애고
                $(".aside").css('bottom', curSc - bottom_top + 150); //fixed bottom 을 줍니다.
            } else {
                $(".aside").css('top', hd_height + 60); // 그렇지않으면 상단에 고정되게 합니다.
            }
        }
        resize();
    });

    function pay(){
        var type_applicant = $(".type_applicant:checked").val();


        if($(".type_applicant:checked").length<1){
            alert("출원유형을 선택해주세요."); $("#type_applicant1").focus(); return false;

        }else if(type_applicant==1){
            var applicant_name_k = $(".con_type1 #applicant_name_k").val();
            var applicant_name_e = $(".con_type1 #applicant_name_e").val();
            var applicant_jumin1 = $(".con_type1 #applicant_jumin1").val();
            var applicant_jumin2 = $(".con_type1 #applicant_jumin2").val();
            var applicant_email = $(".con_type1 #applicant_email").val();
            var applicant_hp = $(".con_type1 #applicant_hp").val();
            var applicant_addr1 = $(".con_type1 #applicant_addr1").val();
            var applicant_addr2 = $(".con_type1 #applicant_addr2").val();
            var applicant_addr3 = $(".con_type1 #applicant_addr3").val();

            if(applicant_name_k==""){ alert("출원인명을 입력하세요."); $(".con_type1 #applicant_name_k").focus(); return false; }
            if(applicant_name_e==""){ alert("출원인명을 입력하세요."); $(".con_type1 #applicant_name_e").focus(); return false; }
            if(applicant_jumin1==""){ alert("출원인 주민 등록번호를 입력하세요."); $(".con_type1 #applicant_jumin1").focus(); return false; }
            if(applicant_jumin2==""){ alert("출원인 주민 등록번호를 입력하세요."); $(".con_type1 #applicant_jumin2").focus(); return false; }
            if(applicant_email==""){ alert("출원인 이메일을 입력하세요."); $(".con_type1 #applicant_email").focus(); return false; }
            if(applicant_hp==""){ alert("출원인 휴대전화를 입력하세요."); $(".con_type1 #applicant_hp").focus(); return false; }
            if(applicant_addr1==""){ alert("출원인 등본상 주소를 입력하세요."); $(".con_type1 #applicant_addr1").focus(); return false; }
            if(applicant_addr2==""){ alert("출원인 등본상 주소를 입력하세요."); $(".con_type1 #applicant_addr2").focus(); return false; }
            if(applicant_addr3==""){ alert("출원인 등본상 주소를 입력하세요."); $(".con_type1 #applicant_addr3").focus(); return false; }

        }else if(type_applicant==2){
            var cop_name_k = $(".con_type2 #cop_name_k").val();
            var cop_name_e = $(".con_type2 #cop_name_e").val();
            var file_cop1 = $(".con_type2 #file_cop1").val();
            var num_corporate_reg1 = $(".con_type2 #num_corporate_reg1").val();
            var num_corporate_reg2 = $(".con_type2 #num_corporate_reg2").val();
            var num_business = $(".con_type2 #num_business").val();
            var boss_name = $(".con_type2 #boss_name").val();
            var boss_jumin1 = $(".con_type2 #boss_jumin1").val();
            var boss_jumin2 = $(".con_type2 #boss_jumin2").val();
            var corp_boss_email = $(".con_type2 #corp_boss_email").val();
            var corp_boss_tel = $(".con_type2 #corp_boss_tel").val();

            if(cop_name_k==""){ alert("법인 명칭을 입력하세요."); $(".con_type2 #cop_name_k").focus(); return false; }
            if(cop_name_e==""){ alert("법인 명칭을 입력하세요."); $(".con_type2 #cop_name_e").focus(); return false; }
            if(file_cop1==""){ alert("법인 인감 파일을 첨부하세요."); $(".con_type2 #file_cop1").focus(); return false; }
            if(num_corporate_reg1==""){ alert("법인 등록번호를 입력하세요."); $(".con_type2 #num_corporate_reg1").focus(); return false; }
            if(num_corporate_reg2==""){ alert("법인 등록번호를 입력하세요."); $(".con_type2 #num_corporate_reg2").focus(); return false; }
            if(num_business==""){ alert("사업자등록번호를 입력하세요."); $(".con_type2 #num_business").focus(); return false; }
            if(boss_name==""){ alert("대표자 성명을 입력하세요."); $(".con_type2 #boss_name").focus(); return false; }
            if(boss_jumin1==""){ alert("대표자 주민등록번호를 입력하세요."); $(".con_type2 #boss_jumin1").focus(); return false; }
            if(boss_jumin2==""){ alert("대표자 주민등록번호를 입력하세요."); $(".con_type2 #boss_jumin2").focus(); return false; }
            if(corp_boss_email==""){ alert("법인 대표 이메일을 입력하세요."); $(".con_type2 #corp_boss_email").focus(); return false; }
            if(corp_boss_tel==""){ alert("법인 대표 유선전화를 입력하세요."); $(".con_type2 #corp_boss_tel").focus(); return false; }

        }else if(type_applicant==3){
            var applicant_name_k = $(".con_type3 #applicant_name_k").val();
            var applicant_name_e = $(".con_type3 #applicant_name_e").val();
            var file_cop1_origin = $(".con_type3 #file_cop1_origin").val();
            var nation = $(".con_type3 #nation").val();
            var chk_cert_foreigner = $(".con_type3 input[name=chk_cert_foreigner]:checked").length;
            var num_passport = $(".con_type3 #num_passport").val();
            var applicant_email = $(".con_type3 #applicant_email").val();
            var addr_overseas = $(".con_type3 #addr_overseas").val();

            var strval_chk_cert_forei = $("input[name=chk_cert_foreigner]:checked").val();

            if(applicant_name_k==""){ alert("출원인명을 입력하세요."); $(".con_type3 #applicant_name_k").focus(); return false; }
            if(applicant_name_e==""){ alert("출원인명을 입력하세요."); $(".con_type3 #applicant_name_e").focus(); return false; }
            if(file_cop1_origin==""){ alert("서명 파일을 첨부하세요."); $(".con_type3 #file_cop1_origin").focus(); return false; }
            if(nation==""){ alert("국적을 선택하세요."); $(".con_type3 #nation").focus(); return false; }
            if(chk_cert_foreigner<1){ alert("외국인 등록증 유무를 선택하세요."); $(".con_type3 #chk_cert_foreigner1").focus(); return false; }
            if(num_passport==""){ alert("여권 번호를 입력하세요."); $(".con_type3 #num_passport").focus(); return false; }
            if(applicant_email==""){ alert("출원인 이메일을 입력하세요."); $(".con_type3 #applicant_email").focus(); return false; }
            if(addr_overseas==""){ alert("해외 주소를 입력하세요."); $(".con_type3 #addr_overseas").focus(); return false; }

            if(strval_chk_cert_forei=="Y"){
                var applicant_hp3 = $(".cert_fore #applicant_hp3").val();
                var file1_cert_forei_origin = $(".cert_fore #file1_cert_forei_origin").val();
                var file2_cert_forei_origin = $(".cert_fore #file2_cert_forei_origin").val();
                var num_cert_forei = $(".cert_fore #num_cert_forei").val();
                var cert_forei_addr1 = $(".cert_fore #cert_forei_addr1").val();
                var cert_forei_addr2 = $(".cert_fore #cert_forei_addr2").val();
                var cert_forei_addr3 = $(".cert_fore #cert_forei_addr3").val();
                if(applicant_hp3==""){ alert("출원인 휴대전화를 입력하세요."); $(".cert_fore #applicant_hp3").focus(); return false; }
                if(file1_cert_forei_origin==""){ alert("외국인 등록증 앞면을 첨부하세요."); $(".cert_fore #file1_cert_forei_origin").focus(); return false; }
                if(file2_cert_forei_origin==""){ alert("외국인 등록증 뒷면을 첨부하세요."); $(".cert_fore #file2_cert_forei_origin").focus(); return false; }
                if(num_cert_forei==""){ alert("외국인 등록번호를 입력하세요."); $(".cert_fore #num_cert_forei").focus(); return false; }
                if(cert_forei_addr1==""){ alert("외국인등록증상 주소를 입력하세요."); $(".cert_fore #cert_forei_addr1").focus(); return false; }
                if(cert_forei_addr2==""){ alert("외국인등록증상 주소를 입력하세요."); $(".cert_fore #cert_forei_addr2").focus(); return false; }
                if(cert_forei_addr3==""){ alert("외국인등록증상 주소를 입력하세요."); $(".cert_fore #cert_forei_addr3").focus(); return false; }
            }

        }else if(type_applicant==4){
            var cop_name_k4 = $(".con_type4 #cop_name_k4").val();
            var cop_name_e4 = $(".con_type4 #cop_name_e4").val();
            var file_sign4_origin = $(".con_type4 #file_sign4_origin").val();
            var nation4 = $(".con_type4 #nation4").val();
            var boss_name4 = $(".con_type4 #boss_name4").val();
            var corp_boss_email4 = $(".con_type4 #corp_boss_email4").val();
            var addr_overseas4 = $(".con_type4 #addr_overseas4").val();

            if(cop_name_k4==""){ alert("법인 명칭을 입력하세요."); $(".con_type4 #cop_name_k4").focus(); return false; }
            if(cop_name_e4==""){ alert("법인 명칭을 입력하세요."); $(".con_type4 #cop_name_e4").focus(); return false; }
            if(file_sign4_origin==""){ alert("대표자 서명 파일을 첨부하세요."); $(".con_type4 #file_sign4_origin").focus(); return false; }
            if(nation4==""){ alert("국적을 선택하세요."); $(".con_type4 #nation4").focus(); return false; }
            if(boss_name4==""){ alert("대표자 성명을 입력하세요."); $(".con_type4 #boss_name4").focus(); return false; }
            if(corp_boss_email4==""){ alert("법인 대표 이메일을 입력하세요."); $(".con_type4 #corp_boss_email4").focus(); return false; }
            if(addr_overseas4==""){ alert("법인 주소를 입력하세요."); $(".con_type4 #addr_overseas4").focus(); return false; }

        }else if(type_applicant==5){
            var name_institution_k = $(".con_type5 #name_institution_k").val();
            var name_institution_e = $(".con_type5 #name_institution_e").val();
            var file1_institution_origin = $(".con_type5 #file1_institution_origin").val();
            var num_busi_insti = $(".con_type5 #num_busi_insti").val();
            var boss_email_insti = $(".con_type5 #boss_email_insti").val();
            var boss_tel_insti = $(".con_type5 #boss_tel_insti").val();
            var insti_addr1 = $(".con_type5 #insti_addr1").val();
            var insti_addr2 = $(".con_type5 #insti_addr1").val();
            var insti_addr3 = $(".con_type5 #insti_addr1").val();

            if(name_institution_k==""){ alert("국가/공공 기관명을 입력하세요."); $(".con_type5 #name_institution_k").focus(); return false; }
            if(name_institution_e==""){ alert("국가/공공 기관명을 입력하세요."); $(".con_type5 #name_institution_e").focus(); return false; }
            if(file1_institution_origin==""){ alert("공인대장(기관인감)을 첨부하세요."); $(".con_type5 #file1_institution_origin").focus(); return false; }
            if(num_busi_insti==""){ alert("고유번호(사업자 등록번호)를 입력하세요."); $(".con_type5 #num_busi_insti").focus(); return false; }
            if(boss_email_insti==""){ alert("기관 대표 이메일을 입력하세요."); $(".con_type5 #boss_email_insti").focus(); return false; }
            if(boss_tel_insti==""){ alert("기관 대표 유선전화를 입력하세요."); $(".con_type5 #boss_tel_insti").focus(); return false; }
            if(insti_addr1==""){ alert("출원인 등본상 주소를 입력하세요."); $(".con_type5 #insti_addr1").focus(); return false; }
            if(insti_addr2==""){ alert("출원인 등본상 주소를 입력하세요."); $(".con_type5 #insti_addr2").focus(); return false; }
            if(insti_addr3==""){ alert("출원인 등본상 주소를 입력하세요."); $(".con_type5 #insti_addr3").focus(); return false; }

        }

        if($("#chk_agent").is(":checked")==true){
            var agent_name_k = $("#agent_name_k").val();
            var agent_name_e = $("#agent_name_e").val();
            var agent_jumin1 = $("#agent_jumin1").val();
            var agent_jumin2 = $("#agent_jumin2").val();
            var agent_email = $("#agent_email").val();
            var agent_hp = $("#agent_hp").val();
            var agent_addr1 = $("#agent_addr1").val();
            var agent_addr2 = $("#agent_addr2").val();
            var agent_addr3 = $("#agent_addr3").val();
            var agent_file_origin = $("#agent_file_origin").val();

            if(agent_name_k==""){ alert("법정 대리인 성명을 입력하세요."); $(".con_agent #agent_name_k").focus(); return false; }
            if(agent_name_e==""){ alert("법정 대리인 성명을 입력하세요."); $(".con_agent #agent_name_e").focus(); return false; }
            if(agent_jumin1==""){ alert("법정 대리인 주민 등록번호를 입력하세요."); $(".con_agent #agent_jumin1").focus(); return false; }
            if(agent_jumin2==""){ alert("법정 대리인 주민 등록번호를 입력하세요."); $(".con_agent #agent_jumin2").focus(); return false; }
            if(agent_email==""){ alert("법정 대리인 이메일을 입력하세요."); $(".con_agent #agent_email").focus(); return false; }
            if(agent_hp==""){ alert("법정 대리인 휴대전화번호를 입력하세요."); $(".con_agent #agent_hp").focus(); return false; }
            if(agent_addr1==""){ alert("법정 대리인 등본상 주소를 입력하세요."); $(".con_agent #agent_addr1").focus(); return false; }
            if(agent_addr2==""){ alert("법정 대리인 등본상 주소를 입력하세요."); $(".con_agent #agent_addr2").focus(); return false; }
            if(agent_addr3==""){ alert("법정 대리인 등본상 주소를 입력하세요."); $(".con_agent #agent_addr3").focus(); return false; }
            if(agent_file_origin==""){ alert("주민등록등본을 첨부하세요."); $(".con_agent #agent_file_origin").focus(); return false; }

            if($("#chk_agree_agent").is(":checked")==false){
                alert("법정대리인 위임장 동의 여부를 체크하세요."); $(".con_agent #chk_agree_agent").focus(); return false;
            }
        }

        var strval_pay_method = $("input[name=pay_method]:checked").val();
        //var comp_name = $("#comp_name").val();
        //var business_num = $("#business_num").val();
        //var name_boss = $("#name_boss").val();
        //var email_boss = $("#email_boss").val();
        //var pay_file_origin = $("#pay_file_origin").val();
        var chk_agree1 = $("#chk_agree1:checked").length;
        var chk_agree2 = $("#chk_agree2:checked").length;
        if(strval_pay_method==""){ alert("결제수단을 선택하세요."); $("#pay_method1").focus(); return false; }
        //if(comp_name==""){ alert("상호명을 입력하세요."); $("#comp_name").focus(); return false; }
        //if(business_num==""){ alert("사업자등록번호를 입력하세요."); $("#business_num").focus(); return false; }
        //if(name_boss==""){ alert("대표자명을 입력하세요."); $("#name_boss").focus(); return false; }
        //if(email_boss==""){ alert("이메일을 입력하세요."); $("#email_boss").focus(); return false; }
        //if(pay_file_origin==""){ alert("주민등록등본을 첨부하세요."); $("#pay_file_origin").focus(); return false; }
        if(chk_agree1<1){ alert("개인정보 활용에 동의해 주세요."); $("#chk_agree1").focus(); return false; }
        if(chk_agree2<1){ alert("상표출원 관련 업무에 대해 마크 인포에 위임할 것을 동의해 주세요."); $("#chk_agree2").focus(); return false; }

        var pay_price = Number($("#pay_price").val());
        var ot_mode = 1;

        var sum_price = $("#sum_price").val();
        var sale_price_mtcode = $("#sale_price_mtcode").val();
        var sale_price_salecode = $("#sale_price_salecode").val();
        var sale_price_point = $("#sale_price_point").val();

        pay_inicis('국내 상표 출원 금액 결제',ot_mode,'<?= $merchant_uid ?>',strval_pay_method,'<?= $dad['idx'] ?>','0','<?= $mta['idx'] ?>','<?= $mta['mt_email'] ?>','<?= $mta['mt_name'] ?>','<?= $mta['mt_hp'] ?>',sum_price,sale_price_mtcode,sale_price_salecode,sale_price_point)

    }

    $(function (){
        $(".con_agent").hide();
        $(".cert_fore").hide();

        var type_applicant = $(".type_applicant:checked").val();

        if(type_applicant==1){
            $(".div_chk_info2").show();
            $(".con_type1").show();
            $(".con_type2").hide();
            $(".con_type3").hide();
            $(".con_type4").hide();
            $(".con_type5").hide();
        }else if(type_applicant==2){
            $(".div_chk_info2").hide();
            $(".con_type1").hide();
            $(".con_type2").show();
            $(".con_type3").hide();
            $(".con_type4").hide();
            $(".con_type5").hide();
        }else if(type_applicant==3){
            $(".div_chk_info2").hide();
            $(".con_type1").hide();
            $(".con_type2").hide();
            $(".con_type3").show();
            $(".con_type4").hide();
            $(".con_type5").hide();
        }else if(type_applicant==4){
            $(".div_chk_info2").hide();
            $(".con_type1").hide();
            $(".con_type2").hide();
            $(".con_type3").hide();
            $(".con_type4").show();
            $(".con_type5").hide();
        }else if(type_applicant==5){
            $(".div_chk_info2").hide();
            $(".con_type1").hide();
            $(".con_type2").hide();
            $(".con_type3").hide();
            $(".con_type4").hide();
            $(".con_type5").show();
        }else{
            $(".div_chk_info2").show();
            $(".con_type1").show();
            $(".con_type2").hide();
            $(".con_type3").hide();
            $(".con_type4").hide();
            $(".con_type5").hide();
        }

        if($("#chk_agent").is(":checked")==true){
            $(".con_agent").show();
        }else{
            $(".con_agent").hide();
        }

    });
</script>
<?php
include "./foot_inc.php";
?>

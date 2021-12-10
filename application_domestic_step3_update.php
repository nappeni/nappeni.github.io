<?php
include "./lib_inc.php";

$sql = "select count(*) as cnt from d_app_domestic where d_datetime like '".date("Y")."-%' order by idx asc ";
$rowa = $DB->fetch_assoc($sql);
$num_myorder = $rowa['cnt']+1;

// 접수번호 생성 (상품류번호 미포함)
$maxordnum = 6;
$currnum = strlen($num_myorder);
$strzero = "";
for($a=1; $a<=$maxordnum-$currnum; $a++){
    $strzero .= "0";
}

$sql = "select * from d_app_domestic where mt_idx = '{$_SESSION['mt_idx']}' and app_status < 1 and d_datetime = '' ";
$dad = $DB->fetch_assoc($sql);

$mt_name = $_POST['mt_name'];
$mt_email = $_POST['mt_email'];
$mt_hp = $_POST['mt_hp'];
$mt_tel = $_POST['mt_tel'];
$chk_info1 = $_POST['chk_info1'];
$chk_info2 = $_POST['chk_info2'];
$type_applicant = $_POST['type_applicant'];

$chk_agent = $_POST['chk_agent'];

$code1 = date("Y")."-";
$code1 .= $strzero.$num_myorder;


$sql_common = "code1 = '{$code1}', ";
$sql_common .= "mt_name = '{$mt_name}', ";
$sql_common .= "mt_email = '{$mt_email}', ";
$sql_common .= "mt_hp = '{$mt_hp}', ";
$sql_common .= "mt_tel = '{$mt_tel}', ";
$sql_common .= "chk_info1 = '{$chk_info1}', ";
$sql_common .= "chk_info2 = '{$chk_info2}', ";
$sql_common .= "type_applicant = '{$type_applicant}', ";

if($type_applicant==1){
    // 국내개인
    $applicant_name_k = $_POST['applicant_name_k'];
    $applicant_name_e = $_POST['applicant_name_e'];
    $applicant_jumin1 = $_POST['applicant_jumin1'];
    $applicant_jumin2 = $_POST['applicant_jumin2'];
    $applicant_jumin = $applicant_jumin1."-".$applicant_jumin2;
    $applicant_email = $_POST['applicant_email'];
    $applicant_hp = $_POST['applicant_hp'];
    $applicant_tel = $_POST['applicant_tel'];
    $applicant_addr1 = $_POST['applicant_addr1'];
    $applicant_addr2 = $_POST['applicant_addr2'];
    $applicant_addr3 = $_POST['applicant_addr3'];

    $sql_common .= "applicant_name_k = '{$applicant_name_k}', ";
    $sql_common .= "applicant_name_e = '{$applicant_name_e}', ";
    $sql_common .= "applicant_jumin = '{$applicant_jumin}', ";
    $sql_common .= "applicant_email = '{$applicant_email}', ";
    $sql_common .= "applicant_hp = '{$applicant_hp}', ";
    $sql_common .= "applicant_tel = '{$applicant_tel}', ";
    $sql_common .= "applicant_addr1 = '{$applicant_addr1}', ";
    $sql_common .= "applicant_addr2 = '{$applicant_addr2}', ";
    $sql_common .= "applicant_addr3 = '{$applicant_addr3}', ";

}else if($type_applicant==2){
    // 국내법인
    $cop_name_k = $_POST['cop_name_k'];
    $cop_name_e = $_POST['cop_name_e'];
    $file_cop1 = $_SESSION['file_cop1'];
    $file_cop1_origin = $_SESSION['file_cop1_origin'];
    $num_corporate_reg1 = $_POST['num_corporate_reg1'];
    $num_corporate_reg2 = $_POST['num_corporate_reg2'];
    $num_business = $_POST['num_business'];
    $boss_name = $_POST['boss_name'];
    $boss_jumin1 = $_POST['boss_jumin1'];
    $boss_jumin2 = $_POST['boss_jumin2'];
    $boss_jumin = $boss_jumin1."-".$boss_jumin2;
    $corp_boss_email = $_POST['corp_boss_email'];
    $corp_boss_hp = $_POST['corp_boss_hp'];
    $corp_boss_tel = $_POST['corp_boss_tel'];

    $sql_common .= "cop_name_k = '{$cop_name_k}', ";
    $sql_common .= "cop_name_e = '{$cop_name_e}', ";
    $sql_common .= "file_cop1 = '{$file_cop1}', ";
    $sql_common .= "file_cop1_origin = '{$file_cop1_origin}', ";
    $sql_common .= "num_corporate_reg1 = '{$num_corporate_reg1}', ";
    $sql_common .= "num_corporate_reg2 = '{$num_corporate_reg2}', ";
    $sql_common .= "num_business = '{$num_business}', ";
    $sql_common .= "boss_name = '{$boss_name}', ";
    $sql_common .= "boss_jumin = '{$boss_jumin}', ";
    $sql_common .= "corp_boss_email = '{$corp_boss_email}', ";
    $sql_common .= "corp_boss_hp = '{$corp_boss_hp}', ";
    $sql_common .= "corp_boss_tel = '{$corp_boss_tel}', ";

}else if($type_applicant==3){
    // 외국개인
    $applicant_name_k = $_POST['applicant_name_k3'];
    $applicant_name_e = $_POST['applicant_name_e3'];
    $applicant_email = $_SESSION['applicant_email3'];
    $file_sign = $_SESSION['file_sign3'];
    $file_sign_origin = $_SESSION['file_sign3_origin'];
    $nation = $_POST['nation'];
    $chk_cert_foreigner = $_POST['chk_cert_foreigner'];
    $file1_cert_forei = $_SESSION['file1_cert_forei'];
    $file1_cert_forei_origin = $_SESSION['file1_cert_forei_origin'];
    $file2_cert_forei = $_SESSION['file2_cert_forei'];
    $file2_cert_forei_origin = $_SESSION['file2_cert_forei_origin'];
    $num_cert_forei = $_SESSION['num_cert_forei'];
    $cert_forei_addr1 = $_SESSION['cert_forei_addr1'];
    $cert_forei_addr2 = $_SESSION['cert_forei_addr2'];
    $cert_forei_addr3 = $_SESSION['cert_forei_addr3'];
    $file_passport = $_SESSION['file_passport'];
    $file_passport_origin = $_SESSION['file_passport_origin'];
    $num_passport = $_SESSION['num_passport'];
    $addr_overseas = $_SESSION['addr_overseas'];

    $sql_common .= "applicant_name_k = '{$applicant_name_k}', ";
    $sql_common .= "applicant_name_e = '{$applicant_name_e}', ";
    $sql_common .= "applicant_email = '{$applicant_email}', ";
    $sql_common .= "file_sign = '{$file_sign}', ";
    $sql_common .= "file_sign_origin = '{$file_sign_origin}', ";
    $sql_common .= "nation = '{$nation}', ";
    $sql_common .= "chk_cert_foreigner = '{$chk_cert_foreigner}', ";
    $sql_common .= "file1_cert_forei = '{$file1_cert_forei}', ";
    $sql_common .= "file1_cert_forei_origin = '{$file1_cert_forei_origin}', ";
    $sql_common .= "file2_cert_forei = '{$file2_cert_forei}', ";
    $sql_common .= "file2_cert_forei_origin = '{$file2_cert_forei_origin}', ";
    $sql_common .= "num_cert_forei = '{$num_cert_forei}', ";
    $sql_common .= "cert_forei_addr1 = '{$cert_forei_addr1}', ";
    $sql_common .= "cert_forei_addr2 = '{$cert_forei_addr2}', ";
    $sql_common .= "cert_forei_addr3 = '{$cert_forei_addr3}', ";
    $sql_common .= "file_passport = '{$file_passport}', ";
    $sql_common .= "file_passport_origin = '{$file_passport_origin}', ";
    $sql_common .= "num_passport = '{$num_passport}', ";
    $sql_common .= "addr_overseas = '{$addr_overseas}', ";

}else if($type_applicant==4){
    // 외국법인
    $cop_name_k = $_POST['cop_name_k4'];
    $cop_name_e = $_POST['cop_name_e4'];
    $file_sign = $_SESSION['file_sign4'];
    $file_sign_origin = $_SESSION['file_sign4_origin'];
    $nation = $_POST['nation4'];
    $boss_name = $_POST['boss_name4'];
    $corp_boss_email = $_POST['corp_boss_email4'];
    $addr_overseas = $_POST['addr_overseas4'];

    $sql_common .= "cop_name_k = '{$cop_name_k}', ";
    $sql_common .= "cop_name_e = '{$cop_name_e}', ";
    $sql_common .= "boss_name = '{$boss_name}', ";
    $sql_common .= "corp_boss_email = '{$corp_boss_email}', ";
    $sql_common .= "file_sign = '{$file_sign}', ";
    $sql_common .= "file_sign_origin = '{$file_sign_origin}', ";
    $sql_common .= "nation = '{$nation}', ";
    $sql_common .= "addr_overseas = '{$addr_overseas}', ";

}else if($type_applicant==5){
    // 국가기관
    $name_institution_k = $_POST['name_institution_k'];
    $name_institution_e = $_POST['name_institution_e'];
    $file1_institution = $_SESSION['file1_institution'];
    $file1_institution_origin = $_SESSION['file1_institution_origin'];
    $num_busi_insti = $_POST['num_busi_insti'];
    $boss_email_insti = $_POST['boss_email_insti'];
    $boss_tel_insti = $_POST['boss_tel_insti'];
    $insti_addr1 = $_POST['insti_addr1'];
    $insti_addr2 = $_POST['insti_addr2'];
    $insti_addr3 = $_POST['insti_addr3'];

    $sql_common .= "name_institution_k = '{$name_institution_k}', ";
    $sql_common .= "name_institution_e = '{$name_institution_e}', ";
    $sql_common .= "file1_institution = '{$file1_institution}', ";
    $sql_common .= "file1_institution_origin = '{$file1_institution_origin}', ";
    $sql_common .= "num_busi_insti = '{$num_busi_insti}', ";
    $sql_common .= "boss_email_insti = '{$boss_email_insti}', ";
    $sql_common .= "boss_tel_insti = '{$boss_tel_insti}', ";
    $sql_common .= "insti_addr1 = '{$insti_addr1}', ";
    $sql_common .= "insti_addr2 = '{$insti_addr2}', ";
    $sql_common .= "insti_addr3 = '{$insti_addr3}', ";

}

if($chk_agent=="Y"){
    // 법정 대리인 필요 시
    $agent_name_k = $_POST['agent_name_k'];
    $agent_name_e = $_POST['agent_name_e'];
    $agent_jumin1 = $_POST['agent_jumin1'];
    $agent_jumin2 = $_POST['agent_jumin2'];
    $agent_jumin = $agent_jumin1."-".$agent_jumin2;
    $agent_hp = $_POST['agent_hp'];
    $agent_email = $_POST['agent_email'];
    $agent_tel = $_POST['agent_tel'];
    $agent_addr1 = $_POST['agent_addr1'];
    $agent_addr2 = $_POST['agent_addr2'];
    $agent_addr3 = $_POST['agent_addr3'];
    $agent_file = $_SESSION['agent_file'];
    $agent_file_origin = $_SESSION['agent_file_origin'];
    $chk_agree_agent = $_POST['chk_agree_agent'];

    $sql_common .= "chk_agent = '{$chk_agent}', ";
    $sql_common .= "agent_name_k = '{$agent_name_k}', ";
    $sql_common .= "agent_name_e = '{$agent_name_e}', ";
    $sql_common .= "agent_jumin = '{$agent_jumin}', ";
    $sql_common .= "agent_email = '{$agent_email}', ";
    $sql_common .= "agent_hp = '{$agent_hp}', ";
    $sql_common .= "agent_tel = '{$agent_tel}', ";
    $sql_common .= "agent_addr1 = '{$agent_addr1}', ";
    $sql_common .= "agent_addr2 = '{$agent_addr2}', ";
    $sql_common .= "agent_addr3 = '{$agent_addr3}', ";
    $sql_common .= "agent_file = '{$agent_file}', ";
    $sql_common .= "agent_file_origin = '{$agent_file_origin}', ";
    $sql_common .= "chk_agree_agent = '{$chk_agree_agent}', ";
}


$chk_agree1 = $_POST['chk_agree1'];
$chk_agree2 = $_POST['chk_agree2'];
$chk_agree3 = $_POST['chk_agree3'];
$pay_method = $_POST['pay_method'];
$code_person_id = $_POST['code_person_id'];
$comp_name = $_POST['comp_name'];
$business_num = $_POST['business_num'];
$name_boss = $_POST['name_boss'];
$email_boss = $_POST['email_boss'];
$pay_file = $_SESSION['pay_file'];
$pay_file_origin = $_SESSION['pay_file_origin'];

$ot_use_point = $_POST['ot_use_point'];
$code_sale = $_POST['code_sale'];

$d_datetime = date("Y-m-d H:i:s");

$sql_common .= "chk_agree1 = '{$chk_agree1}', ";
$sql_common .= "chk_agree2 = '{$chk_agree2}', ";
$sql_common .= "chk_agree3 = '{$chk_agree3}', ";
$sql_common .= "pay_method = '{$pay_method}', ";
$sql_common .= "code_person_id = '{$code_person_id}', ";
$sql_common .= "comp_name = '{$comp_name}', ";
$sql_common .= "business_num = '{$business_num}', ";
$sql_common .= "name_boss = '{$name_boss}', ";
$sql_common .= "email_boss = '{$email_boss}', ";
$sql_common .= "pay_file = '{$pay_file}', ";
$sql_common .= "pay_file_origin = '{$pay_file_origin}', ";

$sql_common .= "use_point = '{$ot_use_point}', ";
$sql_common .= "code_sale = '{$code_sale}', ";

$sql_common .= "app_status = '1', ";
$sql_common .= "d_datetime = '{$d_datetime}' ";



$sql = "update d_app_domestic set ";
$sql .= $sql_common;
$sql .= "where idx = '{$dad['idx']}' ";

$DB->db_query($sql);

if($code_sale){
    $sqla = "select * from discount_code_t where d_code_name = '{$code_sale}' ";
    $rowa = $DB->fetch_assoc($sqla);
    if($rowa['idx']){
        $d_num = $rowa['d_num']-1;
        $sqla = "update discount_code_t set d_num = '{$d_num}' where idx = '{$rowa['idx']}' ";
        $DB->db_query($sqla);
    }
}

if($code_person_id){
    $sqlb = "select * from member_t where mt_discount_cd = '{$code_person_id}' ";
    $mtb = $DB->fetch_assoc($sqlb);
    if($mtb['idx']){
        $point_add = $_POST['sum_price']*0.01;
        $cur_point = $mtb['mt_point']+$point_add;
        $sqlc = "update member_t set mt_point = '{$cur_point}' where idx = '{$mtb['idx']}' ";
        $DB->db_query($sqlc);

        $sql = "insert into point_t set ";
        $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
        $sql .= "pt_type = 'P', ";
        $sql .= "pt_point = '{$point_add}', ";
        $sql .= "pt_content = '추천인 코드 사용 적립', ";
        $sql .= "re_amount = '0', ";
        $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
        $DB->db_query($sql);
    }
}





$sql = "select * from d_app_domestic_item where app_idx = '{$dad['idx']}' order by idx desc ";
$lista = $DB->select_query($sql);
foreach ($lista as $dadi){
    // 상품류 번호 조회
    $sqlb = "select ct_catenum from cate_ps1 where ct_level = '2' and ct_id = '{$dadi['cate_ps2']}' ";
    $cp1 = $DB->fetch_assoc($sqlb);
    if(strlen($cp1['ct_catenum'])<2){
        $ct_catenum = "0".$cp1['ct_catenum'];
    }else{
        $ct_catenum = $cp1['ct_catenum'];
    }

    // 접수번호 생성 (상품류번호 포함)
    $code_register1 = $code1."-".$ct_catenum;

    // 상품별 신청 내역에 접수번호 등록 (상품류번호 포함)
    $sql = "update d_app_domestic_item set ";
    $sql .= "code_register1 = '{$code_register1}', ";
    $sql .= "d_status = '1' ";
    $sql .= "where idx = '{$dadi['idx']}' ";
    $DB->db_query($sql);

    // 결제 내역에 접수번호 등록 (상품류번호 포함)
    $sql = "update order_domestic set ";
    $sql .= "code_register1 = '{$code_register1}' ";
    $sql .= "where app_idx = '{$dad['idx']}' and app_item_idx = '{$dadi['idx']}' ";
    $DB->db_query($sql);
}



// 세션 초기화
$_SESSION['cate_mark'] = "";
$_SESSION['name_mark'] = "";
$_SESSION['img_mark_origin'] = "";
$_SESSION['img_mark'] = "";
$_SESSION['chk_use1'] = "";
$_SESSION['txt_ps'] = "";
$_SESSION['link_shop'] = "";
$_SESSION['agent_file'] = "";
$_SESSION['agent_file_origin'] = "";
$_SESSION['file_cop1'] = "";
$_SESSION['file_cop1_origin'] = "";
$_SESSION['file_passport'] = "";
$_SESSION['file_passport_origin'] = "";
$_SESSION['file1_cert_forei'] = "";
$_SESSION['file1_cert_forei_origin'] = "";
$_SESSION['file2_cert_forei'] = "";
$_SESSION['file2_cert_forei_origin'] = "";
$_SESSION['file_sign3'] = "";
$_SESSION['file_sign3_origin'] = "";
$_SESSION['file_sign4'] = "";
$_SESSION['file_sign4_origin'] = "";
$_SESSION['file1_institution'] = "";
$_SESSION['file1_institution_origin'] = "";
$_SESSION['pay_file'] = "";
$_SESSION['pay_file_origin'] = "";

gotourl("./application_domestic_final.php");

?>
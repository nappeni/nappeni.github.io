<?php
//회원가입
require_once("../lib_inc.php");
$function = $_POST['function'];
switch ($function) {
    case 'checkId':
        checkId();
        break;
    case 'joinUser':
        joinUser();
        break;
}
// 아이디 중복확인 함수
function checkId(){
    $userId = str_replace("'","\'",$_POST['id']);
    //db
    $sql_query = "SELECT mt_id, mt_level FROM member_t WHERE mt_id='".$userId."'";
    $DB = new DB();
    $DB -> __construct();
    $resultValue = $DB -> select_query($sql_query,0);
    $DB -> close($DB);
    //값 전달
    if($resultValue == null){
        $result['success'] = "1";
    }else{
        foreach($resultValue as $row);
        if($row['mt_level']==1){//탈퇴한 회원인지 확인
            $result['success'] = "2";
        }else{
            $result['success'] = "0";
        }
    }
    echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}

//회원가입 함수
function joinUser(){
    $userId =str_replace("'","\'",$_POST['userid']);
    $userPw =str_replace("'","\'", $_POST['passwdBlind']);
    $userName = str_replace("'","\'", $_POST['mt_name']);
    $userPhone = $_POST['mt_hp'];
    $userNum = $_POST['usernum'];
    $discount_cd = substr($userId,0,3).rand(1000,9999); //할인코드
    //회원가입
    $sql_query = "insert into member_t (mt_id,mt_pwd,mt_level,mt_name,mt_point,mt_hp,mt_tel,mt_email,mt_discount_cd) value ('".$userId."',PASSWORD('".$userPw."'),'2','".$userName."','1000','".$userPhone."','".$userNum."','".$userId."','".$discount_cd."')";
    $DB = new DB();
    $DB -> __construct();
    $result = $DB -> db_query($sql_query,0);
    $DB -> close($DB);
    //pointdb에 저장
    $select_query = "select idx from member_t where mt_id='".$userId."'";
    $DB = new DB();
    $DB -> __construct();
    $result = $DB -> db_query($select_query,0);
    $DB -> close($DB);
    foreach($result as $row);
    $insertArr = array(
        'mt_idx' => $row['idx'],
        'pt_type' => 'P',
        'pt_point' => 1000,
        'pt_content' => '회원가입시 적립',
        'pt_rdate' => 'DATE_ADD(NOW(), interval 2 YEAR)'
    );
     $DB = new DB();
    $DB -> __construct();
    $result = $DB -> insert_query("point_t",$insertArr,0);
    $DB -> close($DB);
    if($result){
        p_gotourl("../../index.php");
    }else{
        p_alert("회원가입에 실패하였습니다.","../../index.php");    
    }   
}
?>
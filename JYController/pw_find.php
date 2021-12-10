<?php 
//비밀번호 찾기
require_once("../lib_inc.php");
$function = $_POST["function"];
switch($function){
    case 'checkId':
        checkId();
        break;
    case 'sendMsg':
        send();
        break;
    case 'checkInfo':
        checkInfo();
        break;
}
//사용자 아이디 찾기
function checkId(){
    $userId = $_POST['userId'];
    $sql_query = "SELECT mt_id FROM member_t WHERE mt_id = '".$userId."'";
    $DB = new DB();
    $DB -> __construct();
    $result = $DB -> select_query($sql_query,0);
    $DB -> close($DB);
    if($result){
        $result['success'] = true;
    }else{
        $result['success'] = false;
    }
    echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
//메세지 보내기
function send(){// 실제로 사용할 때는 $sendRand 주석 풀고, testmode_yn Y를 지우면됨
    //$sendRand = rand(100000,999999);
    $sendRand = 101010;
    $_SESSION['rand'] = $sendRand;
    $msg = "인증번호를 입력하세요"."[".$sendRand."]";
    $reciver = $_POST['userPhone']; 
    sendMsg($msg, $reciver);
}
//입력한 결과 확인
function checkInfo(){
    $CertificationNum = $_POST["CertificationNum"];
    if($CertificationNum==$_SESSION['rand']){
        unset($_SESSION['rand']);
        $userId = $_POST["userId"];
        $userName = $_POST["userName"];
        $sql_query = "SELECT mt_id, mt_level FROM member_t WHERE mt_id = '".$userId."' AND mt_name='".$userName."'";
        $DB = NEW DB();
        $DB -> __construct();
        $result = $DB -> select_query($sql_query,0);
        $DB -> close($DB);
        if($result){
            foreach($result as $row);
            if($row['mt_level'] != 1){
                $_SESSION['changpw_id'] = $row['mt_id'];
                p_gotourl("../../pw_change.php");
            }else{
                p_alert("탈퇴 회원입니다.","../../index.php");
            }
        }else{
            p_alert("회원정보가 맞지 않습니다.","../../pw_find.php");
        }
    }else{
        p_alert("인증번호가 일치하지 않습니다.","../../pw_find.php");
    }
}
?>
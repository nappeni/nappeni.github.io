<?php
//계정관리
require_once("../lib_inc.php");

$nowPassword = $_POST['passwdNowBlind'];
$changPassword = $_POST['passwdBlind'];
$email = $_POST['userEmail'];
$userPhoneNum = $_POST['userPhoneNum'];
$userBInfo = $_REQUEST['bankInfos'];//환불계좌정보 [0]:예금주명, [1]:은행명, [2]:계좌번호
//수정한 정보들이 제대로 db에 update되었는지 확인하는 flag
$flag[] = array(null,null,null,null); // [0]: 핸드폰 [1]:비밀번호 [2]:이메일 [3]:은행정보
//휴대전화 수정여부
$PhoneResult = getPhone();
foreach($PhoneResult as $result);
//휴대전화 수정
if($userPhoneNum != $result['mt_hp']){
    $updatePhone = updatePhone($userPhoneNum);
    $updatePhone==1?$flag[0]=true:$flag[0]=false;
}
//비밀번호 수정여부
if($nowPassword != '' && $changPassword != ''){
    //입력한 password와 db에 있는 password가 같은지 확인
    $sql_select = "SELECT count('".$_SESSION['mt_id']."') AS result FROM member_t WHERE mt_id = '".$_SESSION['mt_id']."' AND mt_pwd = PASSWORD('".$nowPassword."');";
    $DB = new DB;
    $DB -> __construct();
    $selectResult = $DB -> db_query($sql_select,0);
    $DB -> close();
    foreach($selectResult as $result);
    //입력한 password와 db에 있는 password 일치 -> db의 password수정
    if($result['result'] == 1){
        $updatePwResult = updataPasswd($changPassword);
        $updatePwResult==1?$flag[1]=true:$flag[1]=false;
    }else{
        p_alert("현재 비밀번호가 일치하지 않습니다.","../../account_management.php");
    }
}
//이메일 수정 여부
$EmailResult = getEmail();
foreach($EmailResult as $result);
if($email != $result['mt_email']){
    $updateEmResult = updateEmail($email);
    $updateEmResult==1?$flag[2]=true:$flag[2]=false;
}
//환불계좌 정보 수정 여부
$BankResult = getBankInfo();
foreach($BankResult as $result);
if($userBInfo[0]!=$result['bk_uname']||$userBInfo[1]!=$result['bk_name']||$userBInfo[2]!=$result['bk_acount_num']){
    $updateBankInfo = updateBankInfo($userBInfo[0], $userBInfo[1], $userBInfo[2]);
    $updateBankInfo==1?$flag[3]=true:$flag[3]=false;
}
//flag값 확인하고 페이지 새로 고침
for($i=0; $i<count($flag); $i++){
    if($flag[$i]!=NULL&&$flag[$i]==true){
        p_gotourl("../account_management.php");
    }else{
        p_alert("수정 중 오류가 발생하였습니다.","../account_management.php");
    }
}

//------------------함수 시작--------------------------
//휴대폰번호 가져오는 함수
function getPhone(){
    $sql_select = "SELECT mt_hp FROM member_t WHERE mt_id = '".$_SESSION['mt_id']."'";
    $DB = new DB;
    $DB -> __construct();
    $selectResult = $DB -> db_query($sql_select,0);
    $DB -> close();
    return $selectResult;
}
//휴대폰번호 수정
function updatePhone($userPhoneNum){
    $sql_update = "UPDATE member_t SET mt_hp = '".$userPhoneNum."' WHERE mt_id = '".$_SESSION['mt_id']."'";
    $DB = new DB;
    $DB -> __construct();
    $updateResult = $DB -> db_query($sql_update,0);
    $DB -> close();
    return $updateResult;
}
//비밀번호 수정
function updataPasswd($changPassword){
    $sql_update = "UPDATE member_t SET mt_pwd = PASSWORD('".$changPassword."') WHERE mt_id = '".$_SESSION['mt_id']."' AND mt_name = '".$_SESSION['mt_name']."'";
    $DB = new DB;
    $DB -> __construct();
    $updateResult = $DB -> db_query($sql_update,0);
    $DB -> close();
    return $updateResult;
}
//이메일 가져오는 함수
function getEmail(){
    $sql_select = "SELECT mt_email FROM member_t WHERE mt_id = '".$_SESSION['mt_id']."'";
    $DB = new DB;
    $DB -> __construct();
    $selectResult = $DB -> db_query($sql_select,0);
    $DB -> close();
    return $selectResult;
}
//이메일 수정
function updateEmail($email){
    $sql_update = "UPDATE member_t SET mt_email = '".$email."' WHERE mt_id = '".$_SESSION['mt_id']."'";
    $DB = new DB;
    $DB -> __construct();
    $updateResult = $DB -> db_query($sql_update,0);
    $DB -> close();
    return $updateResult;
}
//계좌정보 가져오기
function getBankInfo(){
    $sql_select = "SELECT bk_uname, bk_name, bk_acount_num FROM member_t WHERE mt_id = '".$_SESSION['mt_id']."'";
    $DB = new DB;
    $DB -> __construct();
    $selectResult = $DB -> db_query($sql_select,0);
    $DB -> close();
    return $selectResult;
}
//계좌정보 수정
function updateBankInfo($uname,$name,$acountnum){
    $sql_update = "mt_id = '".$_SESSION['mt_id']."'";
    $updateArr = array(
        bk_uname => $uname,
        bk_name => $name,
        bk_acount_num => $acountnum,
    );
    $DB = new DB;
    $DB -> __construct();
    $updateResult = $DB -> update_query("member_t",$updateArr ,$sql_update ,0);
    $DB -> close();
    return $updateResult;
}
//함수 끝
?>
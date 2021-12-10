<?php 
require_once("../lib_inc.php");
define('NAVER_CLIENT_ID','Q_dcTfUGTbbjzrPFjQli');
define('NAVER_CLIENT_SECRET','b4U4dopvID');
define('NAVER_CALLBACK_URL','https://dmonster1705.cafe24.com/JYController/NaverCollBack.php');

if($_SESSION['naver_state'] != $_GET['state']){
    p_alert("오류가 발생하였습니다.","https://dmonster1705.cafe24.com/login.php");
}

if($_GET['code']){
    //사용자 토큰 받기
    $code = $_GET['code'];
    $params = sprintf('grant_type=authorization_code&client_id=%s&client_secret=%s&redirect_uri=%s&code=%s',NAVER_CLIENT_ID,NAVER_CLIENT_SECRET,NAVER_CALLBACK_URL,$code);
    $TOKEN_API_URL = "https://nid.naver.com/oauth2.0/token";
    $opts = array(
        CURLOPT_URL => $TOKEN_API_URL,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSLVERSION => 1,
        CURLOPT_POST => false,
        CURLOPT_POSTFIELDS => $params,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false
    );

    $curlSession = curl_init();
    curl_setopt_array($curlSession,$opts);
    $accessTokenJson = curl_exec($curlSession);
    curl_close($curlSession);

    $responseArr = json_decode($accessTokenJson, true);
    $_SESSION['naver_access_token'] = $responseArr['access_token'];
    $_SESSION['naver_refresh_token'] = $responseArr['refresh_token'];

    //사용자 정보 가져오기
    $USER_API_URL = "https://openapi.naver.com/v1/nid/me";
    $opts = array(
        CURLOPT_URL => $USER_API_URL,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSLVERSION => 1,
        CURLOPT_POST => false,
        CURLOPT_POSTFIELDS => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $responseArr['access_token']
        ) 
    );

    $curlSession = curl_init();
    curl_setopt_array($curlSession,$opts);
    $accessUserJson = curl_exec($curlSession);
    curl_close($curlSession);

    $me_responseArr = json_decode($accessUserJson,true);

    if($me_responseArr['response']['id']){
        $mb_uid = 'naver_'.$me_responseArr['response']['id'];
        $DB = new DB();
        $DB -> __construct();
        $getId = $DB -> select_query("SELECT idx, mt_id, mt_level, mt_name FROM member_t WHERE mt_id = '$mb_uid'",0);
        $DB -> close();
        if($getId){
            foreach($getId as $row);
            if($row['mt_level']!=1){
                //아이디가 있는 경우
                $updateArray = array(mt_access_tk => $responseArr['access_token']);
                $DB = new DB();
                $DB -> __construct();
                $setToken = $DB -> update_query("member_t",$updateArray,"mt_id = '$mb_uid'",0);
                $DB -> close();
                $_SESSION['mt_idx'] = $row['idx'];
                $_SESSION['mt_id'] = $mb_uid;
                $_SESSION['mt_name'] = $row['mt_name'];
                p_gotourl("../../index.php");
            }else{
                p_alert("탈퇴 회원입니다.","../../index.php");
            }
        }else{
            $mb_nickname = $me_responseArr['response']['nickname']; // 닉네임
            $mb_email = $me_responseArr['response']['email']; // 이메일
            $discount_cd = substr($me_responseArr['response']['id'],0,3).rand(1000,9999); //할인코드
            
            //아이디가 없는 경우
            $insertArray = array(
                mt_id => $mb_uid,
                mt_level => 2,
                mt_name => $mb_nickname,
                mt_point => 1000,
                mt_email =>  $mb_email,
                mt_social => 'N',
                mt_access_tk => $responseArr['access_token'],
                mt_discount_cd => $discount_cd,
            );
            $DB = new DB();
            $DB -> __construct();
            $DB -> insert_query("member_t",$insertArray,0);
            $DB -> close();
            //point저장
            $DB = new DB();
            $DB -> __construct();
            $select_idx = $DB-> select_query("select idx from member_t where mt_id='".$mb_uid."'");
            foreach($select_idx as $row);
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
            $_SESSION['mt_idx'] = $row['idx'];
            $_SESSION['mt_id'] = $mb_uid;
            $_SESSION['mt_name'] = $mb_nickname;
            p_gotourl("../../index.php");
        }
    }else{
        p_alert("회원 정보를 가져올 수 없습니다.","https://dmonster1705.cafe24.com/login.php");
    }
}
?>
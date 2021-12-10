<?php
require_once("../lib_inc.php");

define('KAKAO_REST_KEY','1512ac611b6b05ca640256e35bdc60b2');
define('KAKAO_CALLBACK_URL','https://dmonster1705.cafe24.com/JYController/KakaoCollBack.php');

if($_SESSION['kakao_state'] != $_GET['state']){
    p_alert("오류가 발생하였습니다.","https://dmonster1705.cafe24.com/login.php");
}else{
        if($_GET["code"]){
        //사용자 토큰 받기
        $code = $_GET["code"];
        $params = sprintf('grant_type=authorization_code&client_id=%s&redirect_uri=%s&code=%s',KAKAO_REST_KEY,KAKAO_CALLBACK_URL,$code);
        $TOKEN_API_URL = "https://kauth.kakao.com/oauth/token";
        $opts = array(
            CURLOPT_URL => $TOKEN_API_URL,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSLVERSION => 1,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false
        );

        $curlSession = curl_init();
        curl_setopt_array($curlSession,$opts);
        $accessTokenJson = curl_exec($curlSession);
        curl_close($curlSession);

        $responseArr = json_decode($accessTokenJson, true);
        $_SESSION['kakao_access_token'] = $responseArr['access_token'];
        $_SESSION['kako_refresh_token'] = $responseArr['refresh_token'];
        $_SESSION['kakao_refresh_token_expires_in'] = $responseArr['refresh_token_expires_in'];

        //사용자 정보 가져오기
        $USER_API_URL = "https://kapi.kakao.com./v2/user/me";
        $opts = array(
            CURLOPT_URL => $USER_API_URL,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSLVERSION => 1,
            CURLOPT_POST => true,
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
        if($me_responseArr['id']){
            $mb_uid = 'kakao_'.$me_responseArr['id'];
            $DB = new DB();
            $DB -> __construct();
            $getId = $DB -> select_query("SELECT idx, mt_id, mt_level, mt_name  FROM member_t WHERE mt_id = '$mb_uid'",0);
            $DB -> close();
            if($getId){
                foreach($getId as $row);
                if($row['mt_level']!=1){
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
                //카카오 정보 가져오기
                    $mb_nickname = $me_responseArr['properties']['nickname']; // 닉네임
                    $mb_email = $me_responseArr['kakao_account']['email']; // 이메일
                    $mb_ph = $me_responseArr[''];//전화번호
                    $discount_cd = substr($me_responseArr['id'],0,3).rand(1000,9999); //할인코드
                    //아이디가 없는 경우
                    $insertArray = array(
                        mt_id => $mb_uid,
                        mt_level => 2,
                        mt_name => $mb_nickname,
                        mt_point => 1000,
                        mt_email => $mb_email,
                        mt_social => 'K',
                        mt_access_tk => $responseArr['access_token'],
                        mt_discount_cd => $discount_cd,
                    );
                    $DB = new DB();
                    $DB -> __construct();
                    $DB -> insert_query("member_t",$insertArray,0);
                    $DB -> close();
                    //point_t저장
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
}
?>
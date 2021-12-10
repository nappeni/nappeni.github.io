<?php 
include ("../lib_inc.php");
define('NAVER_CLIENT_ID','2jRhNaVHxSB5NzDvV4KY');
define('NAVER_CLIENT_SECRET','IYB7smOvZW');
$recatch = new Naver_Reacatch();
//AJAX실행관련
$inputvalue;
$function = $_POST['function'];
switch($function){
    case 'checkkey':
        $result['result'] = $recatch->checkKey($_SESSION['recatchKey'],  $_POST['inputvalue']);
        if(isset($key)){unset($_SESSION['recatchKey']);}
        echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        break;
}
class Naver_Reacatch{ 
    //키발급 
    function setKey(){
        $code = "0";
        $url = "https://openapi.naver.com/v1/captcha/skey?code=".$code;
        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = "X-Naver-Client-Id: ".NAVER_CLIENT_ID;
        $headers[] = "X-Naver-Client-Secret: ".NAVER_CLIENT_SECRET;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);
        if($status_code == 200) {
            $keyValue = json_decode($response, true);
        } else {
            p_alert("recatch를 실행 할 수 없습니다.","https://dmonster1705.cafe24.com/join.php");
        }
        return $keyValue['key'];
    }
    //이미지 가져오기
    function getImage($key){
        $key = $key;
        $url = "https://openapi.naver.com/v1/captcha/scaptcha?key=".$key;
        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = "X-Naver-Client-Id: ".NAVER_CLIENT_ID;
        $headers[] = "X-Naver-Client-Secret: ".NAVER_CLIENT_SECRET;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);
        if($status_code == 200) {
        //echo $response;
            $fp = fopen("captcha.wav", "w+");
            fwrite($fp, $response);
            fclose($fp);
        //echo "<img src='captcha.jpg'>";
        } else {
           p_alert("recatch를 실행 할 수 없습니다.","https://dmonster1705.cafe24.com/join.php");
        }
        return 'captcha.wav';
    }
    //입력한 값과 키 비교 
    function checkKey($key, $inputValue){
        $code = "1";
        $key = $key;
        $value = $inputValue;
        $url = "https://openapi.naver.com/v1/captcha/skey?code=".$code."&key=".$key."&value=".$value;
        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = "X-Naver-Client-Id: ".NAVER_CLIENT_ID;
        $headers[] = "X-Naver-Client-Secret: ".NAVER_CLIENT_SECRET;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //echo "status_code:".$status_code."<br>";
        curl_close ($ch);
        if($status_code == 200) {
            $Values = json_decode($response, true);
        } else {
            p_alert("recatch를 실행 할 수 없습니다.","https://dmonster1705.cafe24.com/join.php");
        }
        return $Values['result'];
    }
}
?>
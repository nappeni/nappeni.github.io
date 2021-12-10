<?php
require_once("../lib_inc.php");
if($_POST['act']=="nation_select"){//검색
    $text = str_replace("'","\'",$_POST['text']);
    $text = str_replace('"','\"',$text);
    $s_sql = "select exists(select nt_name from nation_t where nt_name ='".$text."') as success, idx from nation_t where nt_name='".$text."'";
    $result = $DB -> select_query($s_sql, 0);
    foreach($result as $row);
    if($row['success']==1){
        $result['success'] = 1;
        $result['nt_idx'] = $row['idx'];
    }else{
        $result['success'] = 0;
    }
    echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}else if($_POST['act']=="step1"){
    $_SESSION['o_type'] = $_POST['exampleRadios2'];
    $_SESSION['o_color'] = $_POST['ac'];
    $_SESSION['o_nations'] = $_POST['nationValues'];
    for($i=0; $i<count($_REQUEST['da']); $i++){
        $o_class .= $_REQUEST['da'][$i]."/";
    }
    $_SESSION['o_class'] = $o_class;
    p_gotourl("../application_overseas_step2.php");
}else if($_POST['act']=="update"){
    //db에 저장
    if($_POST['ae'] == NULL){
        $ae = 'N';
    }else{
        $ae = "Y";
    }
    $insertArr = array(
        'mt_idx' => $_SESSION['mt_idx'],
        'o_color' => $_SESSION['o_color'],
        'o_type' => $_SESSION['o_type'],
        'o_nations' => $_SESSION['o_nations'],
        'o_class' => $_SESSION['o_class'],
        'd_opt' => $_POST['ad'],
        'c_opt' => $ae,
        'p_name' => $_POST['p_name'],
        'p_info' => $_POST['p_info'],
        'm_name' => $_POST['m_name'],
        'm_email' => $_POST['m_email'],
        'm_phone' => $_POST['m_phone']
    );
    $result = $DB -> insert_query("o_app_domestic",$insertArr);
    if($result == 1){
        $_SESSION['o_color'] = "";
        $_SESSION['o_type'] = "";
        $_SESSION['o_nations'] ="";
        $_SESSION['o_class'] = "";
        //관리자에게 알람보내기
        $sql = "select * from member_t where mt_level = 9";
        $ad_info = $DB->fetch_query($sql);
        //---------------문자-----------------
        $msg = $_SESSION['mt_id']."님이 해외 상표 출원 견적 접수하였습니다.";
        $reciver = $ad_info['mt_hp'];
        sendMsg($msg, $reciver);
        echo $reciver;
        p_gotourl("../application_overseas_final.php");
    }else{
        p_alert("등록 중 문제가 발생하였습니다.","https://dmonster1705.cafe24.com/application_overseas_step1.php");
    }
}
?>
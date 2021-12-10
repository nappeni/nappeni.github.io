<?php
require_once("../lib_inc.php");
if($_POST['act']=="input"){
    $qt_title = str_replace('"','\"',$_POST['qt_title']);
    $qt_title = str_replace("'","\'",$qt_title);
    $qt_content = str_replace("'","\'",$_POST['qt_content']);
    $qt_content = str_replace('"','\"',$qt_content);
    $inserArr = array(
        'mt_idx' => $_SESSION['mt_idx'],
        'mt_name' => $_SESSION['mt_name'],
        'mt_id' => $_SESSION['mt_id'],
        'qt_title' => $qt_title,
        'qt_content' => $qt_content
    );
    $result = $DB -> insert_query("inquiry_t",$inserArr);
    if($result){
        p_alert("문의가 접수되었습니다.","../personal_inquiry_list.php");
    }
}else if($_POST['act']=="update"){
    $qt_title = str_replace('"','\"',$_POST['qt_title']);
    $qt_title = str_replace("'","\'",$qt_title);
    $qt_content = str_replace("'","\'",$_POST['qt_content']);
    $qt_content = str_replace('"','\"',$qt_content);
    $updateArr = array(
        'qt_title' => $qt_title,
        'qt_content' => $qt_content
    );
    $where_query = "idx ='".$_POST['it_idx']."'";
    $result = $DB -> update_query("inquiry_t",$updateArr,$where_query);
    if($result){
        p_alert("문의가 수정되었습니다.","../personal_inquiry_list.php");
    }
}
?>
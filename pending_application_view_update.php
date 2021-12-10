<?php
include "./lib_inc.php";
$app_idx = $_POST['app_idx'];
$pg = $_POST['pg'];
$app_status = $_POST['app_status'];

$txt_mod_ver1 = nl2br($_POST['txt_mod_ver1']);
$txt_mod_ver1 = str_replace("'","\'",$txt_mod_ver1);
$txt_mod_ver1 = str_replace('"','\"',$txt_mod_ver1);
$non_txt_mod_ver1 = $_POST['non_txt_mod_ver1'];
$txt_mod_ver2 = nl2br($_POST['txt_mod_ver2']);
$txt_mod_ver2 = str_replace("'","\'",$txt_mod_ver2);
$txt_mod_ver2 = str_replace('"','\"',$txt_mod_ver2);
$non_txt_mod_ver2 = $_POST['non_txt_mod_ver2'];

if($app_status==2){

    if($non_txt_mod_ver1!="Y" && $txt_mod_ver1==""){
        alert("출원보고서 수정사항을 입력해주세요. 수정사항이 없다면 수정사항 없음을 체크해주세요.");
    }

    $sql = "update d_app_domestic set ";
    $sql .= "txt_mod_ver1 = '{$txt_mod_ver1}', ";
    $sql .= "non_txt_mod_ver1 = '{$non_txt_mod_ver1}' ";
    if($non_txt_mod_ver1=="Y"){ $sql .= ", app_status = '8' "; }
    else{ $sql .= ", app_status = '3' "; }
    $sql .= "where idx = '{$app_idx}' ";
    $DB->db_query($sql);

    gotourl("./pending_application_view_primary.php?idx=".$app_idx."&pg=".$pg."");

}else if($app_status==3){

    if($non_txt_mod_ver2!="Y" && $txt_mod_ver2==""){
        alert("출원보고서 수정사항을 입력해주세요. 수정사항이 없다면 수정사항 없음을 체크해주세요.");
    }

    $sql = "update d_app_domestic set ";
    $sql .= "txt_mod_ver2 = '{$txt_mod_ver2}', ";
    $sql .= "non_txt_mod_ver2 = '{$non_txt_mod_ver2}' ";
    if($non_txt_mod_ver2=="Y"){ $sql .= ", app_status = '8' "; }
    else{ $sql .= ", app_status = '4' "; }
    $sql .= "where idx = '{$app_idx}' ";
    $DB->db_query($sql);
    gotourl("./pending_application_view_primary.php?idx=".$app_idx."&pg=".$pg."");

}else if($app_status==4){
    $txt_mod_ver3 = nl2br($_POST['txt_mod_ver3']);
    $txt_mod_ver3 = str_replace("'","\'",$txt_mod_ver3);
    $txt_mod_ver3 = str_replace('"','\"',$txt_mod_ver3);
    $non_txt_mod_ver3 = $_POST['non_txt_mod_ver3'];
    if($non_txt_mod_ver3!="Y" && $txt_mod_ver3==""){
        alert("출원보고서 수정사항을 입력해주세요. 수정사항이 없다면 수정사항 없음을 체크해주세요.");
    }

    $sql = "update d_app_domestic set ";
    $sql .= "txt_mod_ver3 = '{$txt_mod_ver3}', ";
    $sql .= "non_txt_mod_ver3 = '{$non_txt_mod_ver3}' ";
    if($non_txt_mod_ver3=="Y"){ $sql .= ", app_status = '8' "; }
    else{ $sql .= ", app_status = '5' "; }
    $sql .= "where idx = '{$app_idx}' ";
    $DB->db_query($sql);
    gotourl("./pending_application_view_primary.php?idx=".$app_idx."&pg=".$pg."");
}
?>
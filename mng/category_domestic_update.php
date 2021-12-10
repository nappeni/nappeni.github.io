<?php
include "../lib_inc.php";

$sql = "select * from cate_ps1 order by ct_id desc limit 1 ";
$row = $DB->fetch_assoc($sql);

$w = $_POST['w'];
if($w==""){
    $ct_id = $row['ct_id']+1;
}else{
    $ct_id = $_POST['ct_id'];
}
$ct_level = $_POST['ct_level'];
$ct_pid = $_POST['ct_pid'];
$ct_name = $_POST['ct_name'];
$ct_catenum = $_POST['ct_catenum'];
$ct_order = $_POST['ct_order'];
$ct_icon = "";

$foldername = "app_domestic";
$upload_dir = "../data/".$foldername."/";
$ext_str = "jpg,gif,png,JPG,GIF,PNG";
$allowed_extensions = explode(',', $ext_str);

if($_FILES['ct_icon']['name']){
    $img_mark_origin = $_FILES['ct_icon']['name'];
    $ext = substr($_FILES['ct_icon']['name'], strrpos($_FILES['ct_icon']['name'], '.') + 1);
    $file_name = "ct_icon".$ct_level.$ct_id.'.'.$ext;

    if(!in_array($ext, $allowed_extensions)) {
        alert("ct_icon : 업로드할 수 없는 확장자 입니다.","./category_domestic.php");
    }else{
        if(move_uploaded_file($_FILES['ct_icon']['tmp_name'], $upload_dir.$file_name)) {
            $ct_icon = $file_name;
        } else {
            alert("ct_icon : 업로드 되지 않았습니다.","./category_domestic.php");
        }
    }
}

$sql_common = "ct_level = '{$ct_level}', ";
$sql_common .= "ct_pid = '{$ct_pid}', ";
$sql_common .= "ct_name = '{$ct_name}', ";
$sql_common .= "ct_catenum = '{$ct_catenum}', ";
if($ct_icon){ $sql_common .= "ct_icon = '{$ct_icon}', "; }
$sql_common .= "ct_order = '{$ct_order}' ";

if($w==""){
    $sql = "insert into cate_ps1 set ";
    $sql .= $sql_common;
}else{
    $sql = "update cate_ps1 set ";
    $sql .= $sql_common;
    $sql .= "where ct_id = '{$ct_id}' ";
}
$DB->db_query($sql);
$qstr = "ct_level=".$ct_level;
$qstr .= "&ct_id=".$ct_id;
$qstr .= "&ct_pid=".$ct_pid;
gotourl("./category_domestic.php?".$qstr);

?>
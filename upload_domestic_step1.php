<?php
include "./lib_inc.php";
$msg = "";
$foldername = "app_domestic";
$upload_dir = "./data/".$foldername."/";
if($_SESSION['img_mark']){ unlink("./data/app_domestic/".$_SESSION['img_mark']); }
if($_FILES['img_mark']['name']){
    $img_mark_origin = $_FILES['img_mark']['name'];
    $ext = substr($_FILES['img_mark']['name'], strpos($_FILES['img_mark']['name'], '.') + 1);
    $file_name = "img_mark".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
    if(move_uploaded_file($_FILES['img_mark']['tmp_name'], $upload_dir.$file_name)) {
        $_SESSION['img_mark_origin'] = $img_mark_origin;
        $_SESSION['img_mark'] = $file_name;
        $msg = $img_mark_origin;
    } else {
        $msg = 1;
    }
}
echo $msg;

?>
<?php
include "./lib_inc.php";
$arr1 = array();

$foldername = "app_domestic";
$upload_dir = "./data/".$foldername."/";
if($_SESSION['agent_file']){ unlink("./data/app_domestic/".$_SESSION['agent_file']); }
if($_SESSION['file_cop1']){ unlink("./data/app_domestic/".$_SESSION['file_cop1']); }
if($_SESSION['file_passport']){ unlink("./data/app_domestic/".$_SESSION['file_passport']); }
if($_SESSION['file1_cert_forei']){ unlink("./data/app_domestic/".$_SESSION['file1_cert_forei']); }
if($_SESSION['file2_cert_forei']){ unlink("./data/app_domestic/".$_SESSION['file2_cert_forei']); }
if($_SESSION['file_sign3']){ unlink("./data/app_domestic/".$_SESSION['file_sign3']); }
if($_SESSION['file_sign4']){ unlink("./data/app_domestic/".$_SESSION['file_sign4']); }
if($_SESSION['file1_institution']){ unlink("./data/app_domestic/".$_SESSION['file1_institution']); }
if($_SESSION['pay_file']){ unlink("./data/app_domestic/".$_SESSION['pay_file']); }

if($_POST["cate_act"]=="agent_file_origin"){
    if($_FILES['agent_file']['name']){
        $agent_file_origin = $_FILES['agent_file']['name'];
        $ext = substr($_FILES['agent_file']['name'], strpos($_FILES['agent_file']['name'], '.') + 1);
        $file_name = "agent_file".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['agent_file']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['agent_file_origin'] = $agent_file_origin;
            $_SESSION['agent_file'] = $file_name;
            echo $agent_file_origin;
        } else {
        }
    }
}

if($_POST["cate_act"]=="file_sign_origin"){
    if($_FILES['file_sign']['name']){
        $file_sign_origin = $_FILES['file_sign']['name'];
        $ext = substr($_FILES['file_sign']['name'], strpos($_FILES['file_sign']['name'], '.') + 1);
        $file_name = "file_sign".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_sign']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['file_sign_origin'] = $file_sign_origin;
            $_SESSION['file_sign'] = $file_name;
            echo $file_sign_origin;
        } else {
        }
    }
}

if($_POST["cate_act"]=="file_cop1_origin"){
    if($_FILES['file_cop1']['name']){
        $file_cop1_origin = $_FILES['file_cop1']['name'];
        $ext = substr($_FILES['file_cop1']['name'], strpos($_FILES['file_cop1']['name'], '.') + 1);
        $file_name = "file_cop1".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_cop1']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['file_cop1_origin'] = $file_cop1_origin;
            $_SESSION['file_cop1'] = $file_name;
            echo $file_cop1_origin;
        } else {
        }
    }
}

if($_POST["cate_act"]=="file_passport_origin"){
    if($_FILES['file_passport']['name']){
        $file_passport_origin = $_FILES['file_passport']['name'];
        $ext = substr($_FILES['file_passport']['name'], strpos($_FILES['file_passport']['name'], '.') + 1);
        $file_name = "file_passport".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_passport']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['file_passport_origin'] = $file_passport_origin;
            $_SESSION['file_passport'] = $file_name;
            echo $file_passport_origin;
        } else {
        }
    }
}

if($_POST["cate_act"]=="file1_cert_forei_origin"){
    if($_FILES['file1_cert_forei']['name']){
        $file1_cert_forei_origin = $_FILES['file1_cert_forei']['name'];
        $ext = substr($_FILES['file1_cert_forei']['name'], strpos($_FILES['file1_cert_forei']['name'], '.') + 1);
        $file_name = "file1_cert_forei".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file1_cert_forei']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['file1_cert_forei_origin'] = $file1_cert_forei_origin;
            $_SESSION['file1_cert_forei'] = $file_name;
            echo $file1_cert_forei_origin;
        } else {
        }
    }
}

if($_POST["cate_act"]=="file2_cert_forei_origin"){
    if($_FILES['file2_cert_forei']['name']){
        $file2_cert_forei_origin = $_FILES['file2_cert_forei']['name'];
        $ext = substr($_FILES['file2_cert_forei']['name'], strpos($_FILES['file2_cert_forei']['name'], '.') + 1);
        $file_name = "file2_cert_forei".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file2_cert_forei']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['file2_cert_forei_origin'] = $file2_cert_forei_origin;
            $_SESSION['file2_cert_forei'] = $file_name;
            echo $file2_cert_forei_origin;
        } else {
        }
    }
}


if($_POST["cate_act"]=="file_sign3_origin"){
    if($_FILES['file_sign3']['name']){
        $file_sign3_origin = $_FILES['file_sign3']['name'];
        $ext = substr($_FILES['file_sign3']['name'], strpos($_FILES['file_sign3']['name'], '.') + 1);
        $file_name = "file_sign3".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_sign3']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['file_sign3_origin'] = $file_sign3_origin;
            $_SESSION['file_sign3'] = $file_name;
            echo $file_sign3_origin;
        } else {
        }
    }
}

if($_POST["cate_act"]=="file_sign4_origin"){
    if($_FILES['file_sign4']['name']){
        $file_sign4_origin = $_FILES['file_sign4']['name'];
        $ext = substr($_FILES['file_sign4']['name'], strpos($_FILES['file_sign4']['name'], '.') + 1);
        $file_name = "file_sign4".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_sign4']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['file_sign4_origin'] = $file_sign4_origin;
            $_SESSION['file_sign4'] = $file_name;
            echo $file_sign4_origin;
        } else {
        }
    }
}

if($_POST["cate_act"]=="file1_institution_origin"){
    if($_FILES['file1_institution']['name']){
        $file1_institution_origin = $_FILES['file1_institution']['name'];
        $ext = substr($_FILES['file1_institution']['name'], strpos($_FILES['file1_institution']['name'], '.') + 1);
        $file_name = "file1_institution".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file1_institution']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['file1_institution_origin'] = $file1_institution_origin;
            $_SESSION['file1_institution'] = $file_name;
            echo $file1_institution_origin;
        } else {
        }
    }
}

if($_POST["cate_act"]=="pay_file_origin"){
    if($_FILES['pay_file']['name']){
        $pay_file_origin = $_FILES['pay_file']['name'];
        $ext = substr($_FILES['pay_file']['name'], strpos($_FILES['pay_file']['name'], '.') + 1);
        $file_name = "pay_file".$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['pay_file']['tmp_name'], $upload_dir.$file_name)) {
            $_SESSION['pay_file_origin'] = $pay_file_origin;
            $_SESSION['pay_file'] = $file_name;
            echo $pay_file_origin;
        } else {
        }
    }
}




?>
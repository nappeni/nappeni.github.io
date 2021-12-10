<?php
include "../lib_inc.php";
$foldername = "app_domestic";
$upload_dir = "../data/".$foldername."/";

$app_idx = $_POST['app_idx'];
$qstr = $_POST['qstr'];
$tabnum1 = $_POST['tabnum1'];
$tabnum2 = $_POST['tabnum2'];

if($tabnum1==1 && $tabnum2==2){
    $code_applicant = $_POST['code_applicant'];
    $applicant_file1 = "";
    $applicant_file2 = "";
    $applicant_file3 = "";
    $applicant_file_origin1 = "";
    $applicant_file_origin2 = "";
    $applicant_file_origin3 = "";
    $memo1 = nl2br($_POST['memo1']);
    $memo1 = str_replace("'","\'",$memo1);
    $memo1 = str_replace('"','\"',$memo1);

    if($_FILES['applicant_file1']['name']){
        $file_origin = $_FILES['applicant_file1']['name'];
        $ext = substr($_FILES['applicant_file1']['name'], strpos($_FILES['applicant_file1']['name'], '.') + 1);
        $file_name = "applicant_file1".$app_idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['applicant_file1']['tmp_name'], $upload_dir.$file_name)) {
            $applicant_file_origin1 = $file_origin;
            $applicant_file1 = $file_name;
        }
    }
    if($_FILES['applicant_file2']['name']){
        $file_origin = $_FILES['applicant_file2']['name'];
        $ext = substr($_FILES['applicant_file2']['name'], strpos($_FILES['applicant_file2']['name'], '.') + 1);
        $file_name = "applicant_file2".$app_idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['applicant_file2']['tmp_name'], $upload_dir.$file_name)) {
            $applicant_file_origin2 = $file_origin;
            $applicant_file2 = $file_name;
        }
    }
    if($_FILES['applicant_file3']['name']){
        $file_origin = $_FILES['applicant_file3']['name'];
        $ext = substr($_FILES['applicant_file3']['name'], strpos($_FILES['applicant_file3']['name'], '.') + 1);
        $file_name = "applicant_file3".$app_idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['applicant_file3']['tmp_name'], $upload_dir.$file_name)) {
            $applicant_file_origin3 = $file_origin;
            $applicant_file3 = $file_name;
        }
    }

    $sql = "update d_app_domestic set ";
    if($_FILES['applicant_file1']['name']){ $sql .= "applicant_file1 = '{$applicant_file1}', "; }
    if($_FILES['applicant_file2']['name']){ $sql .= "applicant_file2 = '{$applicant_file2}', "; }
    if($_FILES['applicant_file3']['name']){ $sql .= "applicant_file3 = '{$applicant_file3}', "; }
    if($_FILES['applicant_file1']['name']){ $sql .= "applicant_file_origin1 = '{$applicant_file_origin1}', "; }
    if($_FILES['applicant_file2']['name']){ $sql .= "applicant_file_origin2 = '{$applicant_file_origin2}', "; }
    if($_FILES['applicant_file3']['name']){ $sql .= "applicant_file_origin3 = '{$applicant_file_origin3}', "; }
    $sql .= "memo1 = '{$memo1}', ";
    $sql .= "code_applicant = '{$code_applicant}' ";
    $sql .= "where idx = '{$app_idx}' ";
    $DB->db_query($sql);

}

if($tabnum1==1 && $tabnum2==3){
    $memo2 = nl2br($_POST['memo2']);
    $sql = "update d_app_domestic set ";
    $sql .= "memo2 = '{$memo2}' ";
    $sql .= "where idx = '{$app_idx}' ";
    $DB->db_query($sql);
}

if($tabnum1==1 && $tabnum2==4){
    $agent_applicant_code = $_POST['agent_applicant_code'];
    $sql = "update d_app_domestic set ";
    $sql .= "agent_applicant_code = '{$agent_applicant_code}' ";
    $sql .= "where idx = '{$app_idx}' ";
    $DB->db_query($sql);
}

if($tabnum1==2){
    $app_status = $_POST['app_status'];
    $report_ver1 = "";
    $report_ver2 = "";
    $report_ver3 = "";
    $report_ver1_origin = "";
    $report_ver2_origin = "";
    $report_ver3_origin = "";
    $pr_designated = nl2br($_POST['pr_designated']);
    $pr_designated = str_replace("'","\'",$pr_designated);
    $pr_designated = str_replace('"','\"',$pr_designated);

    $memo3 = nl2br($_POST['memo3']);
    $memo3 = str_replace("'","\'",$memo3);
    $memo3 = str_replace('"','\"',$memo3);

    $chk_pr_add = $_POST['chk_pr_add'];
    $cnt_pr_designated = $_POST['cnt_pr_designated'];
    $cnt_pr_add = $_POST['cnt_pr_add'];
    $price_pr_add1 = $_POST['price_pr_add1'];
    $price_pr_add2 = $_POST['price_pr_add2'];
    $price_pr_add3 = $_POST['price_pr_add3'];
    $reason_cancel = $_POST['reason_cancel'];
    $txt_mod_ver1 = nl2br($_POST['txt_mod_ver1']);
    $txt_mod_ver1 = str_replace("'","\'",$txt_mod_ver1);
    $txt_mod_ver1 = str_replace('"','\"',$txt_mod_ver1);
    $txt_mod_ver2 = nl2br($_POST['txt_mod_ver2']);
    $txt_mod_ver2 = str_replace("'","\'",$txt_mod_ver2);
    $txt_mod_ver2 = str_replace('"','\"',$txt_mod_ver2);
    $txt_mod_ver3 = nl2br($_POST['txt_mod_ver3']);
    $txt_mod_ver3 = str_replace("'","\'",$txt_mod_ver3);
    $txt_mod_ver3 = str_replace('"','\"',$txt_mod_ver3);

    if($_FILES['report_ver1']['name']){
        $file_origin = $_FILES['report_ver1']['name'];
        $ext = substr($_FILES['report_ver1']['name'], strpos($_FILES['report_ver1']['name'], '.') + 1);
        $file_name = "report_ver1".$app_idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['report_ver1']['tmp_name'], $upload_dir.$file_name)) {
            $report_ver1_origin = $file_origin;
            $report_ver1 = $file_name;
        }
    }
    if($_FILES['report_ver2']['name']){
        $file_origin = $_FILES['report_ver2']['name'];
        $ext = substr($_FILES['report_ver2']['name'], strpos($_FILES['report_ver2']['name'], '.') + 1);
        $file_name = "report_ver2".$app_idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['report_ver2']['tmp_name'], $upload_dir.$file_name)) {
            $report_ver2_origin = $file_origin;
            $report_ver2 = $file_name;
        }
    }
    if($_FILES['report_ver3']['name']){
        $file_origin = $_FILES['report_ver3']['name'];
        $ext = substr($_FILES['report_ver3']['name'], strpos($_FILES['report_ver3']['name'], '.') + 1);
        $file_name = "report_ver3".$app_idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['report_ver3']['tmp_name'], $upload_dir.$file_name)) {
            $report_ver3_origin = $file_origin;
            $report_ver3 = $file_name;
        }
    }

    $sql = "update d_app_domestic set ";

    //$sql .= "txt_mod_ver1 = '{$txt_mod_ver1}', ";
    //$sql .= "txt_mod_ver2 = '{$txt_mod_ver2}', ";
    //$sql .= "txt_mod_ver3 = '{$txt_mod_ver3}', ";

    if($_FILES['report_ver1']['name']){
        $sql .= "report_ver1 = '{$report_ver1}', ";
        $sql .= "report_ver1_origin = '{$report_ver1_origin}', ";
    }
    if($_FILES['report_ver2']['name']){
        $sql .= "report_ver2 = '{$report_ver2}', ";
        $sql .= "report_ver2_origin = '{$report_ver2_origin}', ";
    }
    if($_FILES['report_ver3']['name']){
        $sql .= "report_ver3 = '{$report_ver3}', ";
        $sql .= "report_ver3_origin = '{$report_ver3_origin}', ";
    }

    if($pr_designated){ $sql .= "pr_designated = '{$pr_designated}', "; }
    if($memo3){ $sql .= "memo3 = '{$memo3}', "; }
    if($chk_pr_add){ $sql .= "chk_pr_add = '{$chk_pr_add}', "; }
    if($cnt_pr_designated>0){ $sql .= "cnt_pr_designated = '{$cnt_pr_designated}', "; }
    $sql .= "cnt_pr_add = '{$cnt_pr_add}', ";
    $sql .= "price_pr_add1 = '{$price_pr_add1}', ";
    $sql .= "price_pr_add2 = '{$price_pr_add2}', ";
    $sql .= "price_pr_add3 = '{$price_pr_add3}', ";
    if($reason_cancel){ $sql .= "reason_cancel = '{$reason_cancel}', "; }
    $sql .= "app_status = '{$app_status}' ";

    if($app_status == 6){
        $dt_complete = date("Y.m.d");
        $sql .= ", dt_complete = '{$dt_complete}' ";
    }
    if($app_status == 7){
        $dt_cancel = date("Y.m.d");
        $sql .= ", dt_cancel = '{$dt_cancel}' ";
    }

    $sql .= "where idx = '{$app_idx}' ";
    $DB->db_query($sql);



    $sqly = "select * from d_app_domestic where idx = '{$app_idx}' ";
    $rowy = $DB->fetch_assoc($sqly);
    //$sqlz = "select * from d_app_domestic_history where app_idx = '{$app_idx}' and d_content = '출원 준비' ";
    //$rowz = $DB->fetch_assoc($sqlz);

    if($report_ver1!="" || $report_ver2!="" || $report_ver3!=""){
        /*if($rowz['idx']){
            $d_date = date("Y.m.d");
            $d_content = "출원 준비";
            $sql = "update d_app_domestic_history set ";
            $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
            $sql .= "app_idx = '{$app_idx}', ";
            $sql .= "imp_uid = '', ";
            $sql .= "merchant_uid = '', ";
            $sql .= "d_date = '{$d_date}', ";
            $sql .= "d_content = '{$d_content}', ";
            if($report_ver1_origin){ $sql .= "d_content_file1 = '{$report_ver1_origin}', "; }
            if($report_ver2_origin){ $sql .= "d_content_file2 = '{$report_ver2_origin}', "; }
            if($report_ver3_origin){ $sql .= "d_content_file3 = '{$report_ver3_origin}', "; }
            if($rowy['txt_mod_ver1']){ $sql .= "txt_mod_ver1 = '{$rowy['txt_mod_ver1']}', "; }
            if($rowy['txt_mod_ver2']){ $sql .= "txt_mod_ver2 = '{$rowy['txt_mod_ver2']}', "; }
            if($rowy['txt_mod_ver3']){ $sql .= "txt_mod_ver3 = '{$rowy['txt_mod_ver3']}', "; }

            $sql .= "pr_designated = '{$pr_designated}', ";
            $sql .= "chk_pr_add = '{$chk_pr_add}', ";
            $sql .= "cnt_pr_designated = '{$cnt_pr_designated}', ";
            $sql .= "cnt_pr_add = '{$cnt_pr_add}', ";
            $sql .= "price_pr_add1 = '{$price_pr_add1}', ";
            $sql .= "price_pr_add2 = '{$price_pr_add2}', ";
            $sql .= "price_pr_add3 = '{$price_pr_add3}', ";

            $sql .= "d_price = '{$_POST['paid_amount']}', ";
            $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
            $sql .= "d_pay_status = '{$_POST['od_status']}' ";
            $sql .= "where idx = '{$rowz['idx']}' ";
            $DB->db_query($sql);
        }else{

        }*/

        $d_date = date("Y.m.d");
        $d_content = "출원 준비";
        $sql = "insert into d_app_domestic_history set ";
        $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
        $sql .= "app_idx = '{$app_idx}', ";
        $sql .= "imp_uid = '', ";
        $sql .= "merchant_uid = '', ";
        $sql .= "d_date = '{$d_date}', ";
        $sql .= "d_content = '{$d_content}', ";
        if($report_ver1_origin){ $sql .= "d_content_file1 = '{$report_ver1_origin}', "; }
        if($report_ver2_origin){ $sql .= "d_content_file2 = '{$report_ver2_origin}', "; }
        if($report_ver3_origin){ $sql .= "d_content_file3 = '{$report_ver3_origin}', "; }
        //if($rowy['txt_mod_ver1']){ $sql .= "txt_mod_ver1 = '{$rowy['txt_mod_ver1']}', "; }
        //if($rowy['txt_mod_ver2']){ $sql .= "txt_mod_ver2 = '{$rowy['txt_mod_ver2']}', "; }
        //if($rowy['txt_mod_ver3']){ $sql .= "txt_mod_ver3 = '{$rowy['txt_mod_ver3']}', "; }

        $sql .= "pr_designated = '{$pr_designated}', ";
        $sql .= "chk_pr_add = '{$chk_pr_add}', ";
        $sql .= "cnt_pr_designated = '{$cnt_pr_designated}', ";
        $sql .= "cnt_pr_add = '{$cnt_pr_add}', ";
        $sql .= "price_pr_add1 = '{$price_pr_add1}', ";
        $sql .= "price_pr_add2 = '{$price_pr_add2}', ";
        $sql .= "price_pr_add3 = '{$price_pr_add3}', ";

        $sql .= "d_price = '{$_POST['paid_amount']}', ";
        $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
        $sql .= "d_pay_status = '{$_POST['od_status']}' ";
        $DB->db_query($sql);


    }

}


gotourl("./app_domestic_form.php?app_idx=".$app_idx."&".$qstr."&tabnum1=".$tabnum1."&tabnum2=".$tabnum2."");
?>
<?php
include "../lib_inc.php";

$foldername = "app_domestic_item";
$upload_dir = "../data/".$foldername."/";

$idx = $_POST['idx'];
$qstr = $_POST['qstr'];
$tabnum1 = $_POST['tabnum1'];
$tabnum2 = $_POST['tabnum2'];
$d_date = date("Y.m.d");

$sql = "select * from d_app_domestic_item where idx = '{$idx}' ";
$dadi = $DB->fetch_assoc($sql);
$app_idx = $dadi['app_idx'];
$sql = "select * from d_app_domestic where idx = '{$app_idx}' ";
$dad = $DB->fetch_assoc($sql);


if($tabnum1==1){
    $code_app = $_POST['code_app'];
    $file_report1 = "";
    $file_report1_origin = "";
    $memo1 = nl2br($_POST['memo1']);
    $memo1 = str_replace("'","\'",$memo1);
    $memo1 = str_replace('"','\"',$memo1);
    $dt_complete = $_POST['dt_complete'];
    $dt_result = "";

    if($_FILES['file_report1']['name']){
        $file_origin = $_FILES['file_report1']['name'];
        $ext = substr($_FILES['file_report1']['name'], strpos($_FILES['file_report1']['name'], '.') + 1);
        $file_name = "file_report1".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report1']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report1']){unlink($upload_dir.$dadi['file_report1']);}
            $file_report1_origin = $file_origin;
            $file_report1 = $file_name;
        }
    }

    if($dt_complete!=""){
        $sqlb = "select date_add('{$dt_complete}',interval 1 year) as dt from dual ";
        $rowb = $DB->fetch_assoc($sqlb);
        $dt_result = $rowb['dt'];

        $sqla = "update d_app_domestic set ";
        $sqla .= "dt_complete = '{$dt_complete}' ";
        $sqla .= "where idx = '{$app_idx}' ";
        $DB->db_query($sqla);

        $sqla = "update d_app_domestic_item set ";
        $sqla .= "dt_result = '{$dt_result}' ";
        $sqla .= "where app_idx = '{$app_idx}' ";
        $DB->db_query($sqla);
    }

    $sql = "update d_app_domestic_item set ";
    $sql .= "code_app = '{$code_app}', ";
    $sql .= "memo1 = '{$memo1}' ";
    if($file_report1){
        $sql .= ", file_report1 = '{$file_report1}', ";
        $sql .= "file_report1_origin = '{$file_report1_origin}' ";
    }
    $sql .= "where idx = '{$idx}' ";
    $DB->db_query($sql);

    $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '출원 완료' ";
    $row = $DB->fetch_assoc($sql);
    if($row['idx']){
        $sql_h = "update d_app_domestic_history2 set ";
        $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
        $sql_h .= "app_idx = '{$app_idx}', ";
        $sql_h .= "app_item_idx = '{$idx}', ";
        $sql_h .= "d_date = '{$d_date}', ";
        $sql_h .= "d_content = '출원 완료' ";
        if($file_report1_origin){ $sql_h .= ", d_content_file1 = '{$file_report1_origin}' "; }
        $sql_h .= "where idx = '{$row['idx']}' ";
        $DB->db_query($sql_h);
    }else{
        $sql_h = "insert into d_app_domestic_history2 set ";
        $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
        $sql_h .= "app_idx = '{$app_idx}', ";
        $sql_h .= "app_item_idx = '{$idx}', ";
        $sql_h .= "d_date = '{$d_date}', ";
        $sql_h .= "d_content = '출원 완료', ";
        $sql_h .= "d_content_file1 = '{$file_report1_origin}' ";
        $DB->db_query($sql_h);
    }

}else if($tabnum1==2){
    $d_status = $_POST['d_status'];

    $file_report2 = "";
    $file_report2_origin = "";
    if($_FILES['file_report2']['name']){
        $file_origin = $_FILES['file_report2']['name'];
        $ext = substr($_FILES['file_report2']['name'], strpos($_FILES['file_report2']['name'], '.') + 1);
        $file_name = "file_report2".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report2']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report2']){unlink($upload_dir.$dadi['file_report2']);}
            $file_report2_origin = $file_origin;
            $file_report2 = $file_name;
        }
    }

    $file_report3 = "";
    $file_report3_origin = "";
    if($_FILES['file_report3']['name']){
        $file_origin = $_FILES['file_report3']['name'];
        $ext = substr($_FILES['file_report3']['name'], strpos($_FILES['file_report3']['name'], '.') + 1);
        $file_name = "file_report3".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report3']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report3']){unlink($upload_dir.$dadi['file_report3']);}
            $file_report3_origin = $file_origin;
            $file_report3 = $file_name;
        }
    }

    $file_report4 = "";
    $file_report4_origin = "";
    if($_FILES['file_report4']['name']){
        $file_origin = $_FILES['file_report4']['name'];
        $ext = substr($_FILES['file_report4']['name'], strpos($_FILES['file_report4']['name'], '.') + 1);
        $file_name = "file_report4".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report4']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report4']){unlink($upload_dir.$dadi['file_report4']);}
            $file_report4_origin = $file_origin;
            $file_report4 = $file_name;
        }
    }

    $file_report5 = "";
    $file_report5_origin = "";
    if($_FILES['file_report5']['name']){
        $file_origin = $_FILES['file_report5']['name'];
        $ext = substr($_FILES['file_report5']['name'], strpos($_FILES['file_report5']['name'], '.') + 1);
        $file_name = "file_report5".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report5']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report5']){unlink($upload_dir.$dadi['file_report5']);}
            $file_report5_origin = $file_origin;
            $file_report5 = $file_name;
        }
    }

    $file_report6 = "";
    $file_report6_origin = "";
    if($_FILES['file_report6']['name']){
        $file_origin = $_FILES['file_report6']['name'];
        $ext = substr($_FILES['file_report6']['name'], strpos($_FILES['file_report6']['name'], '.') + 1);
        $file_name = "file_report6".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report6']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report6']){unlink($upload_dir.$dadi['file_report6']);}
            $file_report6_origin = $file_origin;
            $file_report6 = $file_name;
        }
    }

    $file_report71 = "";
    $file_report71_origin = "";
    if($_FILES['file_report71']['name']){
        $file_origin = $_FILES['file_report71']['name'];
        $ext = substr($_FILES['file_report71']['name'], strpos($_FILES['file_report71']['name'], '.') + 1);
        $file_name = "file_report71".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report71']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report71']){unlink($upload_dir.$dadi['file_report71']);}
            $file_report71_origin = $file_origin;
            $file_report71 = $file_name;
        }
    }

    $file_report72 = "";
    $file_report72_origin = "";
    if($_FILES['file_report72']['name']){
        $file_origin = $_FILES['file_report72']['name'];
        $ext = substr($_FILES['file_report72']['name'], strpos($_FILES['file_report72']['name'], '.') + 1);
        $file_name = "file_report72".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report72']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report72']){unlink($upload_dir.$dadi['file_report72']);}
            $file_report72_origin = $file_origin;
            $file_report72 = $file_name;
        }
    }

    $file_report8 = "";
    $file_report8_origin = "";
    if($_FILES['file_report8']['name']){
        $file_origin = $_FILES['file_report8']['name'];
        $ext = substr($_FILES['file_report8']['name'], strpos($_FILES['file_report8']['name'], '.') + 1);
        $file_name = "file_report8".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report8']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report8']){unlink($upload_dir.$dadi['file_report8']);}
            $file_report8_origin = $file_origin;
            $file_report8 = $file_name;
        }
    }

    $file_report9 = "";
    $file_report9_origin = "";
    if($_FILES['file_report9']['name']){
        $file_origin = $_FILES['file_report9']['name'];
        $ext = substr($_FILES['file_report9']['name'], strpos($_FILES['file_report9']['name'], '.') + 1);
        $file_name = "file_report9".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report9']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report9']){unlink($upload_dir.$dadi['file_report9']);}
            $file_report9_origin = $file_origin;
            $file_report9 = $file_name;
        }
    }

    $file_report10 = "";
    $file_report10_origin = "";
    if($_FILES['file_report10']['name']){
        $file_origin = $_FILES['file_report10']['name'];
        $ext = substr($_FILES['file_report10']['name'], strpos($_FILES['file_report10']['name'], '.') + 1);
        $file_name = "file_report10".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report10']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report10']){unlink($upload_dir.$dadi['file_report10']);}
            $file_report10_origin = $file_origin;
            $file_report10 = $file_name;
        }
    }

    $file_report11 = "";
    $file_report11_origin = "";
    if($_FILES['file_report11']['name']){
        $file_origin = $_FILES['file_report11']['name'];
        $ext = substr($_FILES['file_report11']['name'], strpos($_FILES['file_report11']['name'], '.') + 1);
        $file_name = "file_report11".$idx.$_SESSION['mt_idx'].date('YmdHis').'.'.$ext;
        if(move_uploaded_file($_FILES['file_report11']['tmp_name'], $upload_dir.$file_name)) {
            if($dadi['file_report11']){unlink($upload_dir.$dadi['file_report11']);}
            $file_report11_origin = $file_origin;
            $file_report11 = $file_name;
        }
    }

    if($d_status==1){
        // 출원완료일 떄
        
        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '출원 완료' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '출원 완료' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '출원 완료' ";
            $DB->db_query($sql_h);
        }

    }else if($d_status==2){
        // 심사중일 떄

        $sql = "update d_app_domestic_item set ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '심사중' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '심사중' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '심사중' ";
            $DB->db_query($sql_h);
        }
        
    }else if($d_status==3){
        // 출원취소일 떄

        $reason_cancel2 = $_POST['reason_cancel2'];

        $sql = "update d_app_domestic_item set ";
        $sql .= "reason_cancel2 = '{$reason_cancel2}', ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '출원취소' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "reason_cancel2 = '{$reason_cancel2}', ";
            $sql_h .= "d_content = '출원취소' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "reason_cancel2 = '{$reason_cancel2}', ";
            $sql_h .= "d_content = '출원취소' ";
            $DB->db_query($sql_h);
        }

    }else if($d_status==4){
        // 심사결과 통지일 떄

        $reason_cancel1 = nl2br($_POST['reason_cancel1']);
        $reason_cancel1 = str_replace("'","\'",$reason_cancel1);
        $reason_cancel1 = str_replace('"','\"',$reason_cancel1);

        $d_date1 = $_POST['d_date1'];
        $dt_result_end = $_POST['dt_result_end'];
        $price_audit = $_POST['price_audit'];

        $sql = "update d_app_domestic_item set ";
        $sql .= "d_status = '{$d_status}', ";
        if($file_report5){
            $sql .= "file_report5 = '{$file_report5}', ";
            $sql .= "file_report5_origin = '{$file_report5_origin}', ";
        }
        $sql .= "price_audit = '{$price_audit}', ";
        $sql .= "reason_cancel1 = '{$reason_cancel1}', ";
        $sql .= "price_referee1 = '{$price_audit}', ";
        $sql .= "d_date1 = '{$d_date1}', ";
        $sql .= "dt_result_end = '{$dt_result_end}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '심사결과 통지' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report5_origin){ $sql_h .= "d_content_file5 = '{$file_report5_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_date1 = '{$d_date1}', ";
            $sql_h .= "reason_cancel1 = '{$reason_cancel1}', ";
            $sql_h .= "d_content = '심사결과 통지' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report5_origin){ $sql_h .= "d_content_file5 = '{$file_report5_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_date1 = '{$d_date1}', ";
            $sql_h .= "reason_cancel1 = '{$reason_cancel1}', ";
            $sql_h .= "d_content = '심사결과 통지' ";
            $DB->db_query($sql_h);
        }

    }else if($d_status==5){
        // 심사재개일 떄

        $d_date2 = $_POST['d_date2'];
        $dt_result_end2 = $_POST['dt_result_end2'];
        $price_audit = $dadi['price_audit'];

        $sql = "update d_app_domestic_item set ";
        $sql .= "d_status = '{$d_status}', ";
        if($file_report6){
            $sql .= "file_report6 = '{$file_report6}', ";
            $sql .= "file_report6_origin = '{$file_report6_origin}', ";
        }
        $sql .= "d_date2 = '{$d_date2}', ";
        $sql .= "dt_result_end2 = '{$dt_result_end2}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '심사재개' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report6_origin){ $sql_h .= "d_content_file6 = '{$file_report6_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_date2 = '{$d_date2}', ";
            $sql_h .= "d_content = '심사재개' ";
            if($price_audit>0){
                $sql_h .= ", d_price = '{$price_audit}', ";
                $sql_h .= "d_pay_status = 'ready' ";
            }
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report6_origin){ $sql_h .= "d_content_file6 = '{$file_report6_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_date2 = '{$d_date2}', ";
            $sql_h .= "d_content = '심사재개' ";
            if($price_audit>0){
                $sql_h .= ", d_price = '{$price_audit}', ";
                $sql_h .= "d_pay_status = 'ready' ";
            }
            $DB->db_query($sql_h);
        }

    }else if($d_status==6){
        // 거절결정 1차일 떄

        $reason_cancel3 = nl2br($_POST['reason_cancel3']);
        $reason_cancel3 = str_replace("'","\'",$reason_cancel3);
        $reason_cancel3 = str_replace('"','\"',$reason_cancel3);

        $d_date3 = $_POST['d_date3'];
        $dt_result_end3 = $_POST['dt_result_end3'];
        $price_referee3 = $_POST['price_referee3'];
        $price_referee3_result = $price_referee3+($price_referee3*0.1);

        $sql = "update d_app_domestic_item set ";
        if($file_report71_origin){
            $sql .= "file_report71 = '{$file_report71}', ";
            $sql .= "file_report71_origin = '{$file_report71_origin}', ";
        }
        $sql .= "price_referee3 = '{$price_referee3}', ";
        $sql .= "reason_cancel3 = '{$reason_cancel3}', ";
        $sql .= "d_date3 = '{$d_date3}', ";
        $sql .= "dt_result_end3 = '{$dt_result_end3}', ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '거절결정 1차' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report71_origin){ $sql_h .= "d_content_file71 = '{$file_report71_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_date3 = '{$d_date3}', ";
            $sql_h .= "dt_result_end3 = '{$dt_result_end3}', ";
            $sql_h .= "d_content = '거절결정 1차' ";
            if($price_referee3>0){
                $sql_h .= ", d_price = '{$price_referee3_result}', ";
                $sql_h .= "d_pay_status = 'ready' ";
            }
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report71_origin){ $sql_h .= "d_content_file71 = '{$file_report71_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_date3 = '{$d_date3}', ";
            $sql_h .= "dt_result_end3 = '{$dt_result_end3}', ";
            $sql_h .= "d_content = '거절결정 1차' ";
            if($price_referee3>0){
                $sql_h .= ", d_price = '{$price_referee3_result}', ";
                $sql_h .= "d_pay_status = 'ready' ";
            }
            $DB->db_query($sql_h);
        }

    }else if($d_status==7){
        // 심사진행일 떄

        $code_referee = $_POST['code_referee'];
        $code_referee2 = $_POST['code_referee2'];

        $sql = "update d_app_domestic_item set ";
        if($file_report8_origin){
            $sql .= "file_report8 = '{$file_report8}', ";
            $sql .= "file_report8_origin = '{$file_report8_origin}', ";
        }
        if($file_report11_origin){
            $sql .= "file_report11 = '{$file_report11}', ";
            $sql .= "file_report11_origin = '{$file_report11_origin}', ";
        }
        $sql .= "code_referee = '{$code_referee}', ";
        $sql .= "code_referee2 = '{$code_referee2}', ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '심사진행' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "code_referee = '{$code_referee}', ";
            $sql_h .= "code_referee2 = '{$code_referee2}', ";
            if($file_report8_origin){ $sql_h .= "d_content_file8 = '{$file_report8_origin}', "; }
            if($file_report11_origin){ $sql_h .= "d_content_file11 = '{$file_report11_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '심사진행' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "code_referee = '{$code_referee}', ";
            $sql_h .= "code_referee2 = '{$code_referee2}', ";
            if($file_report8_origin){ $sql_h .= "d_content_file8 = '{$file_report8_origin}', "; }
            if($file_report11_origin){ $sql_h .= "d_content_file11 = '{$file_report11_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '심사진행' ";
            $DB->db_query($sql_h);
        }

    }else if($d_status==8){
        // 거절결정 2차일 떄

        $reason_cancel4 = nl2br($_POST['reason_cancel4']);
        $reason_cancel4 = str_replace("'","\'",$reason_cancel4);
        $reason_cancel4 = str_replace('"','\"',$reason_cancel4);

        $d_date4 = $_POST['d_date4'];
        $dt_result_end4 = $_POST['dt_result_end4'];
        $price_referee4 = $_POST['price_referee4'];
        $price_referee4_result = $price_referee4+($price_referee4*0.1);

        $sql = "update d_app_domestic_item set ";
        if($file_report72_origin){
            $sql .= "file_report72 = '{$file_report72}', ";
            $sql .= "file_report72_origin = '{$file_report72_origin}', ";
        }
        $sql .= "price_referee4 = '{$price_referee4}', ";
        $sql .= "reason_cancel4 = '{$reason_cancel4}', ";
        $sql .= "d_date4 = '{$d_date4}', ";
        $sql .= "dt_result_end4 = '{$dt_result_end4}', ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '거절결정 2차' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report72_origin){ $sql_h .= "d_content_file72 = '{$file_report72_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_date4 = '{$d_date4}', ";
            $sql_h .= "dt_result_end3 = '{$dt_result_end4}', ";
            $sql_h .= "d_content = '거절결정 2차' ";
            if($price_referee4>0){
                $sql_h .= ", d_price = '{$price_referee4_result}', ";
                $sql_h .= "d_pay_status = 'ready' ";
            }
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report72_origin){ $sql_h .= "d_content_file72 = '{$file_report72_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_date4 = '{$d_date4}', ";
            $sql_h .= "dt_result_end3 = '{$dt_result_end4}', ";
            $sql_h .= "d_content = '거절결정 2차' ";
            if($price_referee4>0){
                $sql_h .= ", d_price = '{$price_referee4_result}', ";
                $sql_h .= "d_pay_status = 'ready' ";
            }
            $DB->db_query($sql_h);
        }

    }else if($d_status==9){
        // 심판결과(패소)일 떄

        $code_referee = $_POST['code_referee'];

        $sql = "update d_app_domestic_item set ";
        if($file_report9_origin){
            $sql .= "file_report9 = '{$file_report9}', ";
            $sql .= "file_report9_origin = '{$file_report9_origin}', ";
        }
        $sql .= "code_referee = '{$code_referee}', ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '심판결과(패소)' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "code_referee = '{$code_referee}', ";
            if($file_report9_origin){ $sql_h .= "d_content_file9 = '{$file_report9_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '심판결과(패소)' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "code_referee = '{$code_referee}', ";
            if($file_report9_origin){ $sql_h .= "d_content_file9 = '{$file_report9_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '심판결과(패소)' ";
            $DB->db_query($sql_h);
        }

    }else if($d_status==10){
        // 승소일 떄


        $sql = "update d_app_domestic_item set ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '승소' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '승소' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '승소' ";
            $DB->db_query($sql_h);
        }

    }else if($d_status==11){
        // 출원공고일 떄

        $dt_announce = $_POST['dt_announce'];
        $dt_register_expected = "";
        if($dt_announce){
            $sqlb = "select date_add('{$dt_announce}',interval 2 month) as dt from dual ";
            $rowb = $DB->fetch_assoc($sqlb);
            $dt_register_expected = $rowb['dt'];
        }

        $sql = "update d_app_domestic_item set ";
        $sql .= "d_status = '{$d_status}', ";
        if($file_report2){
            $sql .= "file_report2 = '{$file_report2}', ";
            $sql .= "file_report2_origin = '{$file_report2_origin}', ";
        }
        $sql .= "dt_announce = '{$dt_announce}', ";
        $sql .= "dt_register_expected = '{$dt_register_expected}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '출원공고' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report2_origin){ $sql_h .= "d_content_file2 = '{$file_report2_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '출원공고' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report2_origin){ $sql_h .= "d_content_file2 = '{$file_report2_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '출원공고' ";
            $DB->db_query($sql_h);
        }

    }else if($d_status==12){
        // 등록대기일 떄


        $sql = "update d_app_domestic_item set ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '등록대기' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '등록대기' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '등록대기' ";
            $DB->db_query($sql_h);
        }

    }else if($d_status==13){
        // 등록결정일 떄

        $dt_register_confirm = $_POST['dt_register_confirm'];
        $dt_register_pay = "";
        if($dt_register_confirm){
            $sqlb = "select date_add('{$dt_register_confirm}',interval 3 month) as dt from dual ";
            $rowb = $DB->fetch_assoc($sqlb);
            $dt_register_pay = $rowb['dt'];
        }

        $sql = "update d_app_domestic_item set ";
        if($file_report3){
            $sql .= "file_report3 = '{$file_report3}', ";
            $sql .= "file_report3_origin = '{$file_report3_origin}', ";
        }
        $sql .= "dt_register_confirm = '{$dt_register_confirm}', ";
        $sql .= "dt_register_pay = '{$dt_register_pay}', ";
        $sql .= "chk_pr_add = '{$_POST['chk_pr_add']}', ";
        $sql .= "cnt_pr_designated = '{$_POST['cnt_pr_designated']}', ";
        $sql .= "cnt_pr_add = '{$_POST['cnt_pr_add']}', ";

        $sql .= "vat1_pr_add = '{$_POST['vat1_pr_add']}', ";
        $sql .= "vat2_pr_add = '{$_POST['vat2_pr_add']}', ";
        $sql .= "vat3_pr_add = '{$_POST['vat3_pr_add']}', ";
        $sql .= "vat4_pr_add = '{$_POST['vat4_pr_add']}', ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '등록결정' ";
        $row = $DB->fetch_assoc($sql);

        $sql_h = "insert into d_app_domestic_history2 set ";
        $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
        $sql_h .= "app_idx = '{$app_idx}', ";
        $sql_h .= "app_item_idx = '{$idx}', ";
        if($file_report3_origin){ $sql_h .= "d_content_file3 = '{$file_report3_origin}', "; }
        if($dt_register_pay){ $sql_h .= "dt_register_pay = '{$dt_register_pay}', "; }
        $sql_h .= "d_date = '{$d_date}', ";
        $sql_h .= "d_content = '등록결정', ";
        $sql_h .= "d_price = '{$_POST['vat3_pr_add']}', ";
        $sql_h .= "d_pay_status = 'ready' ";
        $DB->db_query($sql_h);

    }else if($d_status==14){
        // 등록완료일 떄

        $dt_register_complete = $_POST['dt_register_complete'];
        $period = $_POST['period'];
        $code_register2 = $_POST['code_register2'];

        $sql = "update d_app_domestic_item set ";
        $sql .= "code_register2 = '{$code_register2}', ";
        if($file_report4){
            $sql .= "file_report4 = '{$file_report4}', ";
            $sql .= "file_report4_origin = '{$file_report4_origin}', ";
        }
        $sql .= "period = '{$period}', ";
        $sql .= "dt_register_complete = '{$dt_register_complete}', ";
        $sql .= "d_status = '{$d_status}' ";
        $sql .= "where idx = '{$idx}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_idx = '{$app_idx}' and app_item_idx = '{$idx}' and d_content = '등록완료' ";
        $row = $DB->fetch_assoc($sql);
        if($row['idx']){
            $sql_h = "update d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report4_origin){ $sql_h .= "d_content_file4 = '{$file_report4_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '등록완료' ";
            $sql_h .= "where idx = '{$row['idx']}' ";
            $DB->db_query($sql_h);
        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$app_idx}', ";
            $sql_h .= "app_item_idx = '{$idx}', ";
            if($file_report4_origin){ $sql_h .= "d_content_file4 = '{$file_report4_origin}', "; }
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '등록완료' ";
            $DB->db_query($sql_h);
        }


        /*




*/
    }



}

gotourl("./completed_application_form.php?idx=".$idx."&tabnum1=".$tabnum1."&".$qstr);
?>
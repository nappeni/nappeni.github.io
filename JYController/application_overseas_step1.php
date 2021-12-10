<?php
require_once("../lib_inc.php");
if($_POST['act']=="select"){//검색
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
}else{
    
}
?>
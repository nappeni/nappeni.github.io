<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
    
	if($_POST['nt_madrid']=="") $_POST['nt_madrid'] = 'N';
	if($_POST['nt_continent']=="") $_POST['nt_continent'] = 1;

	if($_POST['act']=="input") {
        //insert
        $insertArr = Array(
            'co_rank' => $_POST['co_rank'],
            'co_name' => $_POST['co_name'],
            'co_txt' => $_POST['co_txt']
        );
        $result = $DB->insert_query("cate_overseas_t",$insertArr,0);
        if($result){
             echo "Y";
        }else{
            echo "N";
        }       
	} else if($_POST['act']=="update"){
        $updateArr = Array(
            'co_rank' => $_POST['co_rank'],
            'co_name' => $_POST['co_name'],
            'co_txt' => $_POST['co_txt']
        );
        $where_query = "idx =".$_POST['co_idx'];
        $result = $DB->update_query("cate_overseas_t",$updateArr,$where_query,0);
        if($result){
            echo "Y";
        }else{
            echo "N";
        }
        
    } else if($_POST['act']=="select"){
        $data = $DB->select_query("select * from cate_overseas_t where idx=".$_POST['idx']);
        foreach($data as $row);
        if($data){
            $result['success'] = 1;
            $result['idx'] = $row['idx'];
            $result['co_rank'] = $row['co_rank'];
            $result['co_name'] = $row['co_name'];
            $result['co_txt'] = $row['co_txt'];
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }else{
            $result['success'] = 0;
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
    }else if($_POST['act']=="delete"){
        $DB->del_query('cate_overseas_t', " idx = '".$_POST['idx']."'");
        echo "Y";
    }else if($_POST['act']=="deleteThows"){
        $result = $_REQUEST['idx'];
        for($i=0; $i<count($result); $i++){
            $DB->del_query('cate_overseas_t', " idx = '".$result[$i]."'");
        }
        echo 'Y';
    }

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
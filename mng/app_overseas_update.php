<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=="delete"){
        $result = $DB->del_query('o_app_domestic', " idx = '".$_POST['idx']."'");
        if($result){
            echo "Y";
        }
    }else if($_POST['act']=="deleteThows"){
        $result = $_REQUEST['idx'];
        for($i=0; $i<count($result); $i++){
            $DB->del_query('o_app_domestic', " idx = '".$result[$i]."'");
        }
        echo 'Y';
    }

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
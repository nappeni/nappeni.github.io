<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=="input") {
        unset($arr_query);
        $arr_query = array(
            'txt_memo' => $_POST['txt_meno'],
            'strcode' => $_POST['p_name'],
            'cate1' => 'international',
            'd_datetime' => 'now()',
            'oat_idx' => $_POST['o_idx']
        );
        $DB->insert_query('d_refunt',$arr_query);

		unset($arr_query);
		$arr_query = array(
			'o_refund_status'=>$_POST['o_refund_status'],
            'o_refund_cost'=>$_POST['o_refund_cost'],
		);
        $where_query = "idx='".$_POST['o_idx']."'";
		$DB->update_query('o_app_domestic', $arr_query, $where_query);
        
		p_alert("환불 요청을 하었습니다.", "./refund_list_domestic.php");
	} else if($_POST['act']=="update"){
		unset($arr_query);
		$arr_query = array(
			'txt_memo' => $_POST['txt_memo'],
		);
		$where_query = "idx = '".$_POST['idx']."'";
		$DB->update_query('d_refunt', $arr_query, $where_query);
        
        unset($arr_query);
        $o_refund_cost = str_replace(",","",$_POST['o_refund_cost']);
		$arr_query = array(
			'o_refund_status'=>$_POST['o_refund_status'],
            'o_refund_cost'=>$o_refund_cost,
		);
		$where_query = "idx = '".$_POST['o_idx']."'";
		$DB->update_query('o_app_domestic', $arr_query, $where_query);
		p_alert("수정되었습니다.", "./refund_list_domestic.php");
	} else if($_POST['act']=="delete"){
        $query = "idx='".$_POST['idx']."'";
        $DB -> del_query("d_refunt", $query);
        unset($arr_query);
        $o_refund_cost = str_replace(",","",$_POST['o_refund_cost']);
		$arr_query = array(
			'o_refund_status'=>3,
            'o_refund_cost'=>0,
		);
		$where_query = "idx = '".$_POST['o_idx']."'";
		$DB->update_query('o_app_domestic', $arr_query, $where_query);
        echo "Y";
    }

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
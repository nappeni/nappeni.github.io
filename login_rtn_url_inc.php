<?
	$rtn_url_ex = explode('|', $_POST['rtn_url']);
	if($rtn_url_ex[0]=='qna_form') {
		$rtn_url_t = "./qna_form.php?qt_type=".$rtn_url_ex[1];
	} else if($rtn_url_ex[0]=='qna_list') {
		$rtn_url_t = "./qna_list.php?qt_type=".$rtn_url_ex[1];
	} else if($rtn_url_ex[0]=='study_list') {
		$rtn_url_t = "./study_list.php?ct_id=".$rtn_url_ex[1];
	} else {
		$rtn_url_t = "./".trim($rtn_url_ex[0]).".php";
	}
?>
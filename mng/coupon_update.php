<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['ct_show']=="") $_POST['ct_show'] = 'N';

	if($_POST['act']=="input") {
		unset($arr_query);
		$arr_query = array(
			"ct_title" => $_POST['ct_title'],
			"ct_type1" => $_POST['ct_type1'],
			"ct_sdate" => $_POST['ct_sdate'],
			"ct_edate" => $_POST['ct_edate'],
			"ct_days" => $_POST['ct_days'],
			"ct_type2" => $_POST['ct_type2'],
			"ct_discount1" => $_POST['ct_discount1'],
			"ct_discount2" => $_POST['ct_discount2'],
			"ct_show" => $_POST['ct_show'],
			"ct_wdate" => "now()",
		);

		$DB->insert_query('coupon_t', $arr_query);
		$_last_idx = $DB->insert_id();

		p_alert("등록되었습니다.", "./coupon_list.php");
	} else if($_POST['act']=="update"){
		unset($arr_query);
		$arr_query = array(
			"ct_title" => $_POST['ct_title'],
			"ct_type1" => $_POST['ct_type1'],
			"ct_sdate" => $_POST['ct_sdate'],
			"ct_edate" => $_POST['ct_edate'],
			"ct_days" => $_POST['ct_days'],
			"ct_type2" => $_POST['ct_type2'],
			"ct_discount1" => $_POST['ct_discount1'],
			"ct_discount2" => $_POST['ct_discount2'],
			"ct_show" => $_POST['ct_show'],
		);

		$where_query = "idx = '".$_POST['ct_idx']."'";

		$DB->update_query('coupon_t', $arr_query, $where_query);

		p_alert("수정되었습니다.");
	} else if($_POST['act']=="delete") {
		$DB->del_query('coupon_t', " idx = '".$_POST['idx']."'");

		echo "Y";
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
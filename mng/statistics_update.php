<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']=='statistics_chart1') {
		$arr_data = array();

		unset($list);
		$query = "
			select left(mt_ldate, 10) as date_t, count(idx) as cnt from member_t
			where mt_status = 'Y'
			and mt_level < 9
			group by left(mt_ldate, 10)
			order by mt_ldate asc
		";
		$list = $DB->select_query($query);

		if($list) {
			foreach($list as $row) {
				$arr_data['date_t'][] = $row['date_t'];
				$arr_data['cnt'][] = $row['cnt'];
			}
		}

		echo json_encode($arr_data);
	} else if($_POST['act']=='statistics_chart2') {
		$arr_data = array();

		unset($list);
		$query = "
			select left(mt_wdate, 10) as date_t, count(idx) as cnt from member_t
			where mt_status = 'Y'
			and mt_level < 9
			and mt_wdate between '".$_POST['sel_search_sdate']." 00:00:00' and '".$_POST['sel_search_edate']." 23:59:59'
			group by left(mt_wdate, 10)
			order by mt_wdate asc
		";
		$list = $DB->select_query($query);

		if($list) {
			foreach($list as $row) {
				$arr_data['date_t'][] = $row['date_t'];
				$arr_data['cnt'][] = $row['cnt'];
			}
		}

		echo json_encode($arr_data);
	} else if($_POST['act']=='statistics_chart3') {
		$arr_data = array();

		unset($list);
		$query = "
			select left(pt_wdate, 10) as date_t, count(idx) as cnt from product_t
			where pt_show = 'Y'
			and pt_wdate between '".$_POST['sel_search_sdate']." 00:00:00' and '".$_POST['sel_search_edate']." 23:59:59'
			group by left(pt_wdate, 10)
			order by pt_wdate asc
		";
		$list = $DB->select_query($query);

		if($list) {
			foreach($list as $row) {
				$arr_data['date_t'][] = $row['date_t'];
				$arr_data['cnt'][] = $row['cnt'];
			}
		}

		echo json_encode($arr_data);
	} else if($_POST['act']=='statistics_chart4') {
		$arr_data = array();

		unset($list);
		$query = "
			select left(ct_pdate, 10) as date_t, sum(ct_price) as cnt from cart_t
			where ct_status in (2,3,4,5)
			and ct_pdate between '".$_POST['sel_search_sdate']." 00:00:00' and '".$_POST['sel_search_edate']." 23:59:59'
			group by left(ct_pdate, 10)
			order by ct_pdate asc
		";
		$list = $DB->select_query($query);

		if($list) {
			foreach($list as $row) {
				$arr_data['date_t'][] = $row['date_t'];
				$arr_data['cnt'][] = $row['cnt'];
			}
		}

		echo json_encode($arr_data);
	} else if($_POST['act']=='statistics_chart5') {
		$arr_data = array();

		unset($list);
		$query = "
			select left(ct_pdate, 10) as date_t, count(idx) as cnt from cart_t
			where ct_status in (2,3,4,5)
			and ct_pdate between '".$_POST['sel_search_sdate']." 00:00:00' and '".$_POST['sel_search_edate']." 23:59:59'
			group by left(ct_pdate, 10)
			order by ct_pdate asc
		";
		$list = $DB->select_query($query);

		if($list) {
			foreach($list as $row) {
				$arr_data['date_t'][] = $row['date_t'];
				$arr_data['cnt'][] = $row['cnt'];
			}
		}

		echo json_encode($arr_data);
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
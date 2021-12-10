<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_POST['act']!="delete") {
		unset($list);
		$query = "select ct_id from category_t";
		$list = $DB->select_query($query);

		if($list) {
			foreach($list as $row) {
				$arr_cba = get_bottom_all($row['ct_id']);

				unset($arr_query);
				$arr_query = array(
					"ct_id" => $row['ct_id'],
					"ct_id_txt" => implode(',', $arr_cba),
				);

				$query_cba = "select idx from category_bottom_all where ct_id = '".$row['ct_id']."'";
				$row_cba = $DB->fetch_query($query_cba);

				if($row_cba['idx']) {
					$where_query = "idx = '".$row_cba['idx']."'";

					$DB->update_query('category_bottom_all', $arr_query, $where_query);
				} else {
					$DB->insert_query('category_bottom_all', $arr_query);
				}

			}
		}
	}

	$ct_file_num = 1;

    if($_POST['act']=="input") {
		unset($arr_query);
		$arr_query = array(
			"ct_name" => $_POST['ct_name'],
			"ct_rank" => $_POST['ct_rank'],
			"ct_level" => '0',
			"ct_pid" => '0',
		);

		$DB->insert_query('category_t', $arr_query);
		$_last_idx = $DB->insert_id();

		p_alert("등록되었습니다.", "./category_list.php");
    } else if($_POST['act']=="add") {
		unset($arr_query);
		$arr_query = array(
			"ct_name" => $_POST['ct_name'],
			"ct_rank" => $_POST['ct_rank'],
			"ct_level" => $_POST['ct_level'],
			"ct_pid" => $_POST['ct_id'],
		);

		$DB->insert_query('category_t', $arr_query);
		$_last_idx = $DB->insert_id();

		p_alert("등록되었습니다.", "./category_list.php");
	} else if($_POST['act']=="update"){
		unset($arr_query);
		$arr_query = array(
			"ct_name" => $_POST['ct_name'],
			"ct_rank" => $_POST['ct_rank'],
		);

		$where_query = "ct_id = '".$_POST['ct_id']."'";

		$DB->update_query('category_t', $arr_query, $where_query);
		$_last_idx = $_POST['ct_id'];

		p_alert("수정되었습니다.", './category_form.php?act=update&ct_idx='.$_POST['ct_id']);
	} else if($_POST['act']=="delete") {
		$DB->del_query('category_t', " ct_id = '".$_POST['idx']."'");

		echo "Y";
	} else if($_POST['act']=="sel_ct_level") {
		unset($list);
		$query = "select * from category_t where ct_level = '".$_POST['sel_ct_level']."' and ct_pid = '".$_POST['sel_ct_id']."' order by ct_rank asc, ct_id asc, ct_name asc";
		$list = $DB->select_query($query);

		echo "<option value=''>".$arr_sel_ct_level[$_POST['sel_ct_level']]."</option>";
		if($list) {
			foreach($list as $row) {
				echo "<option value='".$row['ct_id']."'>".$row['ct_name']."</option>";
			}
		}
    }

    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
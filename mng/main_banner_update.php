<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	$bt_file_num = 2;
	if($_POST['bt_show']=="") $_POST['bt_show'] = 'N';

    if($_POST['act']=="input") {
		unset($arr_query);
		$arr_query = array(
			"bt_type" => $_POST['bt_type'],
			"bt_title" => $_POST['bt_title'],
			"bt_link1" => $_POST['bt_link1'],
			"bt_link2" => $_POST['bt_link2'],
			"bt_target1" => $_POST['bt_target1'],
			"bt_target2" => $_POST['bt_target2'],
			"bt_rank" => $_POST['bt_rank'],
			"bt_show" => $_POST['bt_show'],
			"bt_wdate" => "now()",
		);

		$DB->insert_query('banner_t', $arr_query);
		$_last_idx = $DB->insert_id();

		unset($arr_query_img);
		$arr_query_img = array();
		for($q=1;$q<=$bt_file_num;$q++) {
			$temp_img_txt = "bt_file".$q;
			$temp_img_on_txt = "bt_file".$q."_on";
			$temp_img_temp_on_txt = "bt_file".$q."_temp_on";
			$temp_img_del_txt = "bt_file".$q."_del";

			if($_FILES[$temp_img_txt]['name']) {
				$bt_file = $_FILES[$temp_img_txt]['tmp_name'];
				$bt_file_name = $_FILES[$temp_img_txt]['name'];
				$bt_file_size = $_FILES[$temp_img_txt]['size'];
				$bt_file_type = $_FILES[$temp_img_txt]['type'];

				if($bt_file_name!="") {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
					$_POST[$temp_img_on_txt] = "bt_file_".$_last_idx."_".$q.".".get_file_ext($bt_file_name);
					upload_file($bt_file, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
					$img_width_t = $arr_bt_file_size[$_POST['bt_type']][$q][0];
					$img_height_t = $arr_bt_file_size[$_POST['bt_type']][$q][1];
					thumnail($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", $img_width_t, $img_height_t);
				}
			} else {
				if($_POST[$temp_img_del_txt]) {
					unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
				}
			}

			$arr_query_img['bt_file'.$q] = $_POST['bt_file'.$q.'_on'];
		}

		if($arr_query_img) {
			$where_query = "idx = '".$_last_idx."'";

			$DB->update_query('banner_t', $arr_query_img, $where_query);
		}

		p_alert("등록되었습니다.", "./main_banner.php");
	} else if($_POST['act']=="update"){
		unset($arr_query);
		$arr_query = array(
			"bt_type" => $_POST['bt_type'],
			"bt_title" => $_POST['bt_title'],
			"bt_link1" => $_POST['bt_link1'],
			"bt_link2" => $_POST['bt_link2'],
			"bt_target1" => $_POST['bt_target1'],
			"bt_target2" => $_POST['bt_target2'],
			"bt_rank" => $_POST['bt_rank'],
			"bt_show" => $_POST['bt_show'],
			"bt_wdate" => "now()",
		);

		$where_query = "idx = '".$_POST['bt_idx']."'";

		$DB->update_query('banner_t', $arr_query, $where_query);
		$_last_idx = $_POST['bt_idx'];

		unset($arr_query_img);
		$arr_query_img = array();
		for($q=1;$q<=$bt_file_num;$q++) {
			$temp_img_txt = "bt_file".$q;
			$temp_img_on_txt = "bt_file".$q."_on";
			$temp_img_temp_on_txt = "bt_file".$q."_temp_on";
			$temp_img_del_txt = "bt_file".$q."_del";

			if($_FILES[$temp_img_txt]['name']) {
				$bt_file = $_FILES[$temp_img_txt]['tmp_name'];
				$bt_file_name = $_FILES[$temp_img_txt]['name'];
				$bt_file_size = $_FILES[$temp_img_txt]['size'];
				$bt_file_type = $_FILES[$temp_img_txt]['type'];

				if($bt_file_name!="") {
					@unlink($ct_img_dir_a."/".$_POST[$temp_img_on_txt]);
					$_POST[$temp_img_on_txt] = "bt_file_".$_last_idx."_".$q.".".get_file_ext($bt_file_name);
					upload_file($bt_file, $_POST[$temp_img_on_txt], $ct_img_dir_a."/");
					$img_width_t = $arr_bt_file_size[$_POST['bt_type']][$q][0];
					$img_height_t = $arr_bt_file_size[$_POST['bt_type']][$q][1];
					scale_image_fit($ct_img_dir_a."/".$_POST[$temp_img_on_txt], $_POST[$temp_img_on_txt], $ct_img_dir_a."/", $img_width_t, $img_height_t);
				}
			} else {
				if($_POST[$temp_img_del_txt]) {
					unlink($ct_img_dir_a."/".$_POST[$temp_img_del_txt]);
				}
			}

			$arr_query_img['bt_file'.$q] = $_POST['bt_file'.$q.'_on'];
		}

		if($arr_query_img) {
			$where_query = "idx = '".$_last_idx."'";

			$DB->update_query('banner_t', $arr_query_img, $where_query);
		}

        p_alert("수정되었습니다.");
	} else if($_POST['act']=="delete") {
		$query = "select * from banner_t where idx = '".$_POST['idx']."'";
		$row = $DB->fetch_query($query);

		for($q=1;$q<=$bt_file_num;$q++) {
			$temp_img_txt = "bt_file".$q;
			if($row[$temp_img_txt]) {
				unlink($ct_img_dir_a."/".$row[$temp_img_txt]);
			}
		}

		$DB->del_query('banner_t', " idx = '".$_POST['idx']."'");

		echo "Y";
    } else if($_POST['act']=="delete_those"){
        $result = $_REQUEST['idx'];
        for($i=0; $i<count($result); $i++){
            $query = "select * from banner_t where idx = '".$result[$i]."'";
		    $row = $DB->fetch_query($query);

            for($q=1;$q<=$bt_file_num;$q++) {
                $temp_img_txt = "bt_file".$q;
                if($row[$temp_img_txt]) {
                    unlink($ct_img_dir_a."/".$row[$temp_img_txt]);
                }
            }

            $DB->del_query('banner_t', " idx = '".$result[$i]."'");
        }
        echo 'Y';
    }

    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
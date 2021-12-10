<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_GET['st_idx']) {
		$query = "
			select * from study_t where idx = '".$_GET['st_idx']."'
		";
		$row = $DB->fetch_query($query);

		$filepath = $ct_img_dir_r."/".$row['st_data'.$_GET['fileNo']];
		$filename = $row['st_data'.$_GET['fileNo'].'_origin'];
		$filesize = filesize($filepath);
		$path_parts = pathinfo($filepath);

		header("Content-Type: application/x-octetstream");
		//header("Content-Disposition: attachment; filename=".$filename);
		Header('Content-Disposition: attachment; filename="'.iconv('UTF-8', 'CP949', $filename).'"');
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".$filesize);
		header("Cache-Control:cache,must-revalidate");
		header("Pragma:no-cache");
		header("Expires:0");

		if(is_file($filepath)){
			$fp = fopen($filepath,"r");
			while(!feof($fp)){
				$buf = fread($fp,8096);
				$read = strlen($buf);
				print($buf);
				flush();
			}
			fclose($fp);
		}
	} else {
		if($_GET['img_src']) {
			$filepath = $ct_img_dir_r."/".$_GET['img_src'];
			$filename = $_GET['img_src'];
			$filesize = filesize($filepath);
			$path_parts = pathinfo($filepath);

			header("Content-Type: application/x-octetstream");
			header("Content-Disposition: attachment; filename=".$filename);
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".$filesize);

			$fp = fopen($filepath, 'rb');
			fpassthru($fp);
			fclose($fp);
		}
	}

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>

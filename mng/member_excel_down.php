<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	set_time_limit(0);
	ini_set("memory_limit", -1);

	$arr_cell = array(
		'이름', '아이디', '연락처', '보조연락처', '임직원관계', '자녀와의관계', '가입일시', '누적구매횟수', '만족도평가횟수'
	);

	require_once $_SERVER['DOCUMENT_ROOT'].'/lib/PHPExcel-1.8/Classes/PHPExcel.php';

	$objPHPExcel = new PHPExcel();

	$sheetIndex = $objPHPExcel->createSheet(0);
	$sheetIndex->setTitle('회원');

	$a = 'A';
	foreach($arr_cell as $key => $val) {
		$sheetIndex->setCellValue($a.'1', $val);
		$a++;
	}

	$q = 2;
	unset($list);
	$query = "select * from member_t where mt_level = '2'";
	$list = $DB->select_query($query);

	if($list) {
		foreach($list as $row) {
			$sheetIndex->setCellValue('A'.$q, $row['mt_name']);
			$sheetIndex->setCellValue('B'.$q, $row['mt_id']);
			$sheetIndex->setCellValue('C'.$q, $row['mt_hp']);
			$sheetIndex->setCellValue('D'.$q, $row['mt_tel']);
			$sheetIndex->setCellValue('E'.$q, $arr_mt_executives_chk[$row['mt_executives_chk']]);
			$sheetIndex->setCellValue('F'.$q, $arr_mt_child_chk[$row['mt_child_chk']]);
			$sheetIndex->setCellValue('G'.$q, $row['mt_wdate']);
			$sheetIndex->setCellValue('H'.$q, $row['mt_review_cash']);
			$sheetIndex->setCellValue('I'.$q, $row['mt_review_cash']);

			$q++;
		}
	}

	$objPHPExcel->removeSheetByIndex('1');
	$objPHPExcel->setActiveSheetIndex(0);

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="member_excel_'.date("YmdHis").'.xls"');
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Set-Cookie: fileDownload=true; path=/');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
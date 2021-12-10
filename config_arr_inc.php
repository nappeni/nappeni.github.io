<?
	$arr_mt_level = array(
		1 => '탈퇴',
		2 => '회원',
		5 => '선생님',
		9 => '관리자',
	);

	foreach($arr_mt_level as $key => $val) {
		if($val) {
			$arr_mt_level_option .= "<option value='".$key."' >".$val."</option>";
		}
	}
?>
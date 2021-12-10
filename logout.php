<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	if($_SESSION['_mt_idx']=='') {
		alert('잘못된 접근입니다.', './');
	}

	session_unset();
	session_destroy();
	unset($_SESSION);

	header("location:./");

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
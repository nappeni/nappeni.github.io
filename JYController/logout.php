<?php
require_once("../lib_inc.php");
//로그아웃
session_unset();
session_destroy();
unset($_SESSION);
echo "<script>location.href='../index.php'</script>";
?>
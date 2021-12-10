<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

    $updateArray = array(
        "qt_answer" => $_POST['qt_answer'],
        "qt_status" => 2,
        "qt_adate" => "now()",
    );
    $where_query = "idx='".$_POST['it_idx']."'";

    $result = $DB -> update_query("inquiry_t",$updateArray, $where_query);
    if($result){
        p_alert("답변이 등록되었습니다.","./personal_inquiry_list.php");
    }
	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
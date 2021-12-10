<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
    $rt_img_url = "../images/uploads/reviews/";
	$_act = $_REQUEST['act'];

	if($_POST['act']=='input') {
        //섬네일사진 업로드
        if($_FILES['rt_thum_img']['name']){
            $rt_file = $_FILES['rt_thum_img']['tmp_name'];
            $rt_file_type = explode("/",$_FILES['rt_thum_img']['type']);
            $rt_file_name = "rv_thum_file".date('ymdhis').".".$rt_file_type[1];
            $target = $rt_img_url."/".$rt_file_name;
            echo $rt_file_name;
            move_uploaded_file($rt_file, $target);
        }
        //db에 저장
        unset($arr_query_img);
		$rt_tags = preg_replace('/\s+/', '',$_POST['tagValue']);
		$select_query = "SELECT idx FROM member_t WHERE mt_id ='".$_POST['mt_id']."'";
		$result = $DB ->select_query($select_query,0);
        if($result!=null){
		foreach($result as $row);
            $insertArr = array(
                'mt_id'=>$_POST['mt_id'],
                'mt_idx'=>$row['idx'],
                'pt_title'=>$_POST['rt_title'],
                'rt_thum_img'=>$rt_file_name,
                'rt_tag'=>$rt_tags,
                'rt_content'=>$_POST['rt_content']
            );
            $result = $DB -> insert_query('review_t',$insertArr,0);
            if($result){
                p_alert("추가되었습니다.","./use_review.php");
            }
        }else{
            p_alert("아이디가 올바르지 않습니다.","./use_review_form.php");
        }
    } else if($_POST['act']=='update'){
        //사진 업로드
        if($_FILES['rt_thum_img']['name']){
            $rt_file = $_FILES['rt_thum_img']['tmp_name'];
            move_uploaded_file($rt_file, $rt_img_url.$_POST['rt_thum_img_on']);
        }
        //db에 업로드
        $rt_tags = preg_replace('/\s+/', '',$_POST['tagValue']);
        $updateArr = array(
            'pt_title' => $_POST['rt_title'],
            'rt_content' => $_POST['rt_content'],
            'rt_tag' => $rt_tags
        );
        $where_query = "idx='".$_POST['rt_idx']."'";
        $result = $DB -> update_query("review_t",$updateArr, $where_query,0);
        if($result){
            p_alert("수정되었습니다.","./use_review.php");
        }
    } else if($_POST['act']=='content_view') {
		$query = "
			select * from review_t
			where idx = '".$_POST['rt_idx']."'
		";
		$row = $DB->fetch_query($query);
    } else if($_POST['act']=='delete') {
        //사진삭제
        if($_POST['rt_thum_img_on']){
            unlink($rt_img_url."/".$_POST['rt_thum_img_on']);
        }
        //db에 있는 내용삭제
		$DB->del_query('review_t', " idx = '".$_POST['idx']."'");
		echo "Y";
	} else if($_POST['act']=="deleteThows"){
        $data = $_REQUEST['idx'];
        $select = "select rt_thum_img from review_t where idx='";
        //file이름 select
        for($i=0; $i<count($data); $i++){
            $result[] = $DB -> select_query($select.$data[$i]."'",0);
        }
        $i=0;
        //사진 삭제
        foreach($result as $row){
            unlink($rt_img_url."/".$row[$i]['rt_thum_img']);
        }
        //db에 있는 내용 삭제
        for($i=0; $i<count($data); $i++){
            $DB -> del_query('review_t',"idx='".$data[$i]."'");
        }
        echo "Y";
    }

    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
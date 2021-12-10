<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
    include "../JYController/PHPExcel-1.8/Classes/PHPExcel.php";
    include "../JYController/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php";
	if($_POST['nt_madrid']=="") $_POST['nt_madrid'] = 'N';
	if($_POST['nt_continent']=="") $_POST['nt_continent'] = 0;

	if($_POST['act']=="input") {
        $insertArr = Array(
            'nt_continent' => $_POST['nt_continent'],
            'nt_name' => $_POST['nt_name'],
            'nt_cost' => $_POST['nt_cost'],
            'nt_madrid' => $_POST['nt_madrid'],
            'md_cost' => $_POST['md_cost']
        );
        $result = $DB->insert_query("nation_t",$insertArr,0);
        if($result){
            echo "Y";
        }else{
            echo "N";
        }
	} else if($_POST['act']=="update"){
        $updateArr = Array(
            'nt_continent' => $_POST['nt_continent'],
            'nt_name' => $_POST['nt_name'],
            'nt_cost' => $_POST['nt_cost'],
            'nt_madrid' => $_POST['nt_madrid'],
            'md_cost' => $_POST['md_cost']
        );
        $where_query = "idx =".$_POST['nt_idx'];
        $result = $DB->update_query("nation_t",$updateArr,$where_query,0);
        if($result){
            echo "Y";
        }else{
            echo "N";
        }
        
    } else if($_POST['act']=="select"){
        $data = $DB->select_query("select * from nation_t where idx=".$_POST['idx']);
        foreach($data as $row);
        if($data){
            $result['success'] = 1;
            $result['idx'] = $row['idx'];
            $result['nt_continent'] = $row['nt_continent'];
            $result['nt_name'] = $row['nt_name'];
            $result['nt_madrid'] = $row['nt_madrid'];
            $result['nt_cost'] = $row['nt_cost'];
            $result['md_cost'] = $row['md_cost'];
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }else{
            $result['success'] = 0;
            echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
    }else if($_POST['act']=="delete"){
        $DB->del_query('nation_t', " idx = '".$_POST['idx']."'");
        echo "Y";
    }else if($_POST['act']=="deleteThows"){
        $result = $_REQUEST['idx'];
        for($i=0; $i<count($result); $i++){
            $DB->del_query('nation_t', " idx = '".$result[$i]."'");
        }
        echo 'Y';
    }else if($_POST['act']=="fileUpload"){
        //파일 업로드
        $objPHPExcel = new PHPExcel();
        $upload_dir = '../data/nation_file/';
        $upload_file = $upload_dir.basename($_FILES['excelFile']['name']);
        $allData = array();
        if(move_uploaded_file($_FILES['excelFile']['tmp_name'],$upload_file)){
            try{
                //엑셀 파일 일고 $allData에 초기화
                $filename = $upload_dir.$_FILES['excelFile']['name'];
                $objPHPExcel = PHPExcel_IOFactory::load($filename);
                $sheetsCount = $objPHPExcel -> getSheetCount();
                for($i=0;$i<$sheetsCount;$i++){
                    $objPHPExcel -> setActiveSheetIndex($i);
                    $sheet = $objPHPExcel -> getActiveSheet();
                    $highestRow = $sheet -> getHighestRow();
                    $highestColumn = $sheet -> getHighestColumn();
                    for($row=3;$row<$highestRow;$row++){
                        $rowData = $sheet -> rangeToArray("A" . $row . ":" . $highestColumn . $row, NULL, TRUE, FALSE);
                        $allData[$row] = $rowData[0];
                    }
                }
            }catch(excption $e){
                p_alert("파일 업로드 중 에러가 발생하였습니다.", "./category_nation_list.php");
            }
           if($allData){
               for($i=3; $i<count($allData); $i++){
                    if($allData[$i][1]!="불가"){
                        $madrid = "Y";
                    }else{
                            $madrid = "N";
                    }
                    switch($allData[$i][4]){
                        case "아시아":
                            $nt_continent = 1;
                            break;
                        case "북미":
                            $nt_continent = 2;
                            break;
                        case "유럽":
                            $nt_continent = 3;
                            break;
                        case "아프리카":
                            $nt_continent = 4;
                            break;
                        case "오세아니아":
                            $nt_continent = 5;
                            break;
                        case "중동":
                            $nt_continent = 6;
                            break;
                        case "중남미":
                            $nt_continent = 7;
                            break;
                        default:
                            $nt_continent = "";
                    }
                   $insertArr = Array(
                       'nt_name' => $allData[$i][0],
                       'nt_madrid' => $madrid,
                       'nt_cost'=> $allData[$i][2],
                       'md_cost'=> $madrid=="Y"?$allData[$i][3]:0,
                       'nt_continent' => $nt_continent

                   );
                   $result[] = $DB->insert_query("nation_t",$insertArr,0);
               }
               if($result){
                p_alert("등록되었습니다.", "./category_nation_list.php");
               }else{
                p_alert("등록 중 에러가 발생하였습니다.", "./category_nation_list.php");
               }
           }
        }else{
            echo '파일 업로드 안됨';
        }

    }

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
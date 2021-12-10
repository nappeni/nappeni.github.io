<?
include_once('./_common.php');
include_once('./category/lib/category.lib.php');

// 완전 초기화
if ($_POST['m'] == 'truncate') {
    // 분류 삭제
    sql_query(" delete from {$g5['category_table']} ");

} else {
    $sql_arr = array();

    // 초기화
    $tmp_id_list = "";

    // num 값이 있다면.
    if ($_POST['tmp_code']) {

        // 이미지 설정
        //$dmshop_image = shop_design_image();

        // 분류
        //if ($dmshop_image['image_category_use'] == '0') { $dmshop_image['thumb_width'] = shop_split("|", $dmshop_image['image_category'], "0"); $dmshop_image['thumb_height'] = shop_split("|", $dmshop_image['image_category'], "1"); } else { $dmshop_image['thumb_width'] = $dmshop_image['image_category_width']; $dmshop_image['thumb_height'] = $dmshop_image['image_category_height']; }

        // 돌려요
        for ($i=0; $i<=$tmp_code; $i++) {

    /*--------------------------------
        ## CODE ##
    --------------------------------*/

            // code
            $input_code = "code".$i;

            // post code
            $input_code_value = $_POST[$input_code];

            if ($input_code_value) {

                // 초기화
                $tmp_id_list = "";

                // 쪼갠다.
                $value = explode("|%|", trim($input_code_value));
                for ($k=0; $k<count($value); $k++) {

                    if ($value[$k]) {

                        // 다시 쪼갠다.
                        $tmp_value = explode(":%:", trim($value[$k]));
                        for ($j=0; $j<count($tmp_value); $j++) {

                            // 첫번째 것만
                            if ($tmp_value[$j] && $j == '0') {

                                $subject = str_replace('"','',$tmp_value[2]);
                                $subject = str_replace("'",'',$subject);
                                // 추가
                                if ($tmp_value[0] == 'insert') {
                                    $sql = " insert into {$g5['category_table']}
                                        SET c_id = '".addslashes($tmp_value[1])."', c_category = '".addslashes($tmp_value[3])."', c_code = '".addslashes($tmp_value[4])."'
                                            , c_subject = '".addslashes($subject)."', c_position = '".$k."', c_view = '1', c_datetime = '".G5_TIME_YMDHIS."' ";
                                    //, c_description ='".addslashes($tmp_value[5])."'
                                    $sql_arr[] = $sql;
                                    sql_query($sql);
                                    /*, skin = 'default'
                                        , item_width = '4', item_height = '5', thumb_width = '".$dmshop_image['thumb_width']."', thumb_height = '".$dmshop_image['thumb_height']."' */
                                }

                                // 업데이트
                                else if ($tmp_value[0] == 'update') {
                                    $sql = " update {$g5['category_table']}
                                        SET c_subject = '".addslashes($subject)."', c_position = '".$k."' 
                                        where c_id = '".addslashes($tmp_value[1])."' ";
                                    $sql_arr[] = $sql;
                                    sql_query($sql);
                                }

                                // 삭제 제외할 아이디 값을 담는다.
                                $tmp_id_list .= ",".$tmp_value[1];

                            } // end if

                        } // end for

                    } // end if

                } // end for

                // 동일 코드내 담은 아이디를 제외하고 나머지를 삭제한다.
                $sql = " delete from {$g5['category_table']} where c_code = '".addslashes($tmp_value[4])."' and c_id not in (".substr($tmp_id_list,1).") ";
                $sql_arr[] = $sql;
                sql_query($sql);

            } else {
                $sql = " delete from {$g5['category_table']} where c_code = '".$i."' ";
                $sql_arr[] = $sql;
                sql_query($sql);

            }

    /*--------------------------------
        ## LOG ##
    --------------------------------*/

            // log
            $input_log = "log".$i;
            $input_log_value = $_POST[$input_log];

            if ($input_log_value) {
                $sql = " update {$g5['category_table']} set c_log = '".addslashes($input_log_value)."' where c_id = '".$i."' ";
                $sql_arr[] = $sql;
                sql_query($sql);
            }

        } // end for

    }

    // 찌꺼기는 삭제해준다.
    $result = sql_query(" select * from {$g5['category_table']} where c_code != '0' order by c_code asc ");
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $shop_category = shop_category($row['c_code']);

        // 상위 분류가 없다면
        if (!$shop_category['c_id']) {
            $sql = " delete from {$g5['category_table']} where c_id = '".$row['id']."' ";
            $sql_arr[] = $sql;
            // 삭제함
            sql_query($sql);

        }

    }

}

//echo '<br/>';
//print_r($sql_arr);
goto_url("./category_config.php");
?>

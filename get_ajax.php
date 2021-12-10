<?php
include "./lib_inc.php";
switch ($_POST['mode']){
    case "save_session":
        $strname = $_POST['strname'];
        $strval = $_POST['strval'];
        //$strval = str_replace("'","\'",$strval);
        //$strval = str_replace('"','\"',$strval);
        $strval = nl2br($strval);
        $_SESSION[$strname]=$strval;
        break;

    case "save_temporarily":
        $strmode = $_POST['strmode'];
        if($_SESSION['mt_idx']){
            if($strmode=="application_domestic"){
                $sql = "select * from d_app_domestic where mt_idx = '{$_SESSION['mt_idx']}' and app_status < 1 and d_datetime = '' ";
                $dad = $DB->fetch_assoc($sql);

                $name_mark = str_replace("'","\'",$_SESSION['name_mark']);
                $name_mark = str_replace('"','\"',$name_mark);

                $txt_ps = str_replace("'","\'",$_SESSION['txt_ps']);
                $txt_ps = str_replace('"','\"',$txt_ps);

                $applicant_jumin = $_SESSION['applicant_jumin1']."-".$_SESSION['applicant_jumin2'];

                $sql_common = "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql_common .= "cate_mark = '{$_SESSION['cate_mark']}', ";
                $sql_common .= "name_mark = '{$name_mark}', ";
                $sql_common .= "img_mark = '{$_SESSION['img_mark']}', ";
                $sql_common .= "img_mark_origin = '{$_SESSION['img_mark_origin']}', ";
                $sql_common .= "chk_use1 = '{$_SESSION['chk_use1']}', ";
                $sql_common .= "txt_ps = '{$txt_ps}', ";
                $sql_common .= "link_shop = '{$_SESSION['link_shop']}', ";

                $sql_common .= "mt_name = '{$_SESSION['mt_name_app']}', ";
                $sql_common .= "mt_email = '{$_SESSION['mt_email_app']}', ";
                $sql_common .= "mt_hp = '{$_SESSION['mt_hp_app']}', ";
                $sql_common .= "mt_tel = '{$_SESSION['mt_tel_app']}', ";
                $sql_common .= "chk_info1 = '{$_SESSION['chk_info1']}', ";
                $sql_common .= "chk_info2 = '{$_SESSION['chk_info2']}', ";
                $sql_common .= "type_applicant = '{$_SESSION['type_applicant']}', ";
                $sql_common .= "applicant_name_k = '{$_SESSION['applicant_name_k']}', ";
                $sql_common .= "applicant_name_e = '{$_SESSION['applicant_name_e']}', ";
                $sql_common .= "applicant_jumin = '{$applicant_jumin}', ";
                $sql_common .= "applicant_email = '{$_SESSION['applicant_email']}', ";
                $sql_common .= "applicant_hp = '{$_SESSION['applicant_hp']}', ";
                $sql_common .= "applicant_tel = '{$_SESSION['applicant_tel']}' ";


                if($dad['idx']){
                    $sql2 = "update d_app_domestic set ";
                    $sql2 .= $sql_common;
                    $sql2 .= "where idx = '{$dad['idx']}' ";
                }else{
                    $sql2 = "insert into d_app_domestic set ";
                    $sql2 .= $sql_common;
                }
                $DB->db_query($sql2);
            }
        }
        break;

    case "del_cate1":
        $ctid = $_POST['ctid'];
        $catelv = $_POST['catelv'];
        $upload_dir = "../data/app_domestic/";

        $sql = "select * from cate_ps1 order by ct_id desc limit 1 ";
        $row = $DB->fetch_assoc($sql);
        if($row['ct_icon']){
            unlink($upload_dir.$row['ct_icon']);
        }

        $sql = "delete from cate_ps1 where ct_id = '{$ctid}' ";
        $DB->db_query($sql);
        if($catelv==1){
            $sql = "delete from cate_ps1 where ct_pid = '{$ctid}' ";
            $DB->db_query($sql);
        }

        $sql = "select count(*) as cnt from cate_ps1";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE cate_ps1 AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);

        break;

    case "up_ele_cate":
        $ct_level = $_POST['ct_level'];
        $ct_id = $_POST['ct_id'];
        $ct_pid = $_POST['ct_pid'];
        $num1 = 1;
        $arr1 = array();
        $arr2 = array();

        if($ct_level==1){
            $query = "select ct_id, ct_order from cate_ps1 where ct_level = {$ct_level} order by ct_order asc, ct_id asc ";
        }else{
            $query = "select ct_id, ct_order from cate_ps1 where ct_level = {$ct_level} and ct_pid = '{$ct_pid}' order by ct_order asc, ct_id asc ";
        }
        $list1 = $DB->select_query($query);

        foreach ($list1 as $row){
            array_push($arr1,$row['ct_id']);
        }

        $which_ctid = array_search($ct_id,$arr1);
        if($which_ctid>0){
            // 최상위가 아닐 때

            $before_thiswhich = $which_ctid-1;

            $ex_ctid = $arr1[$before_thiswhich];
            $arr1[$before_thiswhich] = $arr1[$which_ctid];
            $arr1[$which_ctid] = $ex_ctid;

            for($a1=0; $a1<count($arr1); $a1++){
                $sql = "update cate_ps1 set ";
                $sql .= "ct_order = '{$a1}' ";
                $sql .= "where ct_id = '".$arr1[$a1]."' ";
                $DB->db_query($sql);
            }

        }
        break;

    case "down_ele_cate":
        $ct_level = $_POST['ct_level'];
        $ct_id = $_POST['ct_id'];
        $ct_pid = $_POST['ct_pid'];
        $num1 = 1;
        $arr1 = array();
        $arr2 = array();

        if($ct_level==1){
            $query = "select ct_id, ct_order from cate_ps1 where ct_level = {$ct_level} order by ct_order asc, ct_id asc ";
        }else{
            $query = "select ct_id, ct_order from cate_ps1 where ct_level = {$ct_level} and ct_pid = '{$ct_pid}' order by ct_order asc, ct_id asc ";
        }
        $list1 = $DB->select_query($query);

        foreach ($list1 as $row){
            array_push($arr1,$row['ct_id']);
        }

        $which_ctid = array_search($ct_id,$arr1);
        if($which_ctid<count($arr1)-1){
            // 최하위가 아닐 때

            $before_thiswhich = $which_ctid+1;

            $ex_ctid = $arr1[$before_thiswhich];
            $arr1[$before_thiswhich] = $arr1[$which_ctid];
            $arr1[$which_ctid] = $ex_ctid;

            for($a1=0; $a1<count($arr1); $a1++){
                $sql = "update cate_ps1 set ";
                $sql .= "ct_order = '{$a1}' ";
                $sql .= "where ct_id = '".$arr1[$a1]."' ";
                $DB->db_query($sql);
            }

        }
        break;

    case "get_wrap_list_lv2":
        $ct_pid = $_POST['ct_pid'];

        unset($list);
        $query = "select * from cate_ps1 where ct_level = 2 and ct_pid = '{$ct_pid}' order by ct_order asc, ct_id asc ";
        $list1 = $DB->select_query($query);
        if(count($list1)>0){
            foreach ($list1 as $pslv2){
                if(strlen($pslv2['ct_catenum'])<2){ $ct_catenum = "0".$pslv2['ct_catenum']; }else{ $ct_catenum = $pslv2['ct_catenum']; }
                ?>
                <div class="clearboth wd-100 py-1 ele_cate2" data-ctid="<?= $pslv2['ct_id'] ?>" data-ctname="<?= $pslv2['ct_name'] ?>" data-catenum="<?= $pslv2['ct_catenum'] ?>">
                    <div class="float-left wd-20 text-center"><?= $ct_catenum ?>류</div>
                    <div class="float-left wd-80 px-2"><?= $pslv2['ct_name'] ?></div>
                </div>
                <?php
            }
        }

        break;

    case "get_cate2_domestic":
        $ct_pid = $_POST['ct_id'];
        unset($list);
        $query = "select * from cate_ps1 where ct_level = 2 and ct_pid = '{$ct_pid}' order by ct_order asc, ct_id asc ";
        $list1 = $DB->select_query($query);
        if(count($list1)>0){
            foreach ($list1 as $pslv2){
                if(strlen($pslv2['ct_catenum'])<2){ $ct_catenum = "0".$pslv2['ct_catenum']; }else{ $ct_catenum = $pslv2['ct_catenum']; }
                ?>
                <div class="checks w-50">
                    <input type="checkbox" name="cate_ps2[]" class="cate_ps2" id="c<?= $pslv2['ct_id'] ?>" value="<?= $pslv2['ct_id'] ?>">
                    <label for="c<?= $pslv2['ct_id'] ?>">
                        <div class="d-block d-sm-flex align-items-center">
                            <p class="mr-3 fc_gr999">제<?= $ct_catenum ?>류</p>
                            <p><?= $pslv2['ct_name'] ?></p>
                        </div>
                    </label>
                </div>
                <?php
            }
        }
        break;

    case "del_dadi_domestic":
        $idx = $_POST['idx'];

        $sql = "delete from d_app_domestic_item where idx = '{$idx}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from d_app_domestic_item";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE d_app_domestic_item AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);
        break;

    case "del_dadi_domestic_all":

        $sql = "select * from d_app_domestic where mt_idx = '{$_POST['mtidx']}' and app_status < 1 and d_datetime = '' order by idx desc limit 1 ";
        $dad = $DB->fetch_assoc($sql);
        $idx = $dad['idx'];

        $sql = "delete from d_app_domestic_item where app_idx = '{$idx}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from d_app_domestic_item";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE d_app_domestic_item AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);
        break;

    case "chk_mt_discount_cd":
        $sql = "select count(*) as cnt from member_t where mt_discount_cd = '{$_POST['code_person_id']}' ";
        $row = $DB->fetch_assoc($sql);
        if($row["cnt"]>0){
            $sql2 = "select * from member_t where mt_discount_cd = '{$_POST['code_person_id']}' ";
            $mta = $DB->fetch_assoc($sql2);

            $sql2 = "select count(*) as cnt from d_app_domestic where code_person_id = '{$_POST['code_person_id']}'  ";
            $row2 = $DB->fetch_assoc($sql2);
            if($row2["cnt"]>0){
                $msg = 2;
            }else{
                // OK
                $msg = 3;
            }

        }else{
            $msg = 1;
        }
        echo $msg;
        break;

    case "chk_mypoint":
        $ot_use_point = $_POST['ot_use_point'];

        $sql = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
        $mta = $DB->fetch_assoc($sql);
        if($mta['mt_point']<$ot_use_point){
            echo 1;
        }else{
            echo 2;
        }
        break;

    case "use_myallpoint":
        $sql = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";;
        $mta = $DB->fetch_assoc($sql);
        echo $mta['mt_point'];
        break;

    case "order_domestic":
        $o_datetime = date("Y-m-d H:i:s");

        $sql = "select count(*) as cnt from point_t where left(pt_wdate,4) = date_format(now(),'%Y') ";
        $pta = $DB->fetch_assoc($sql);
        $nextnum_pt = $pta['cnt']+1;
        $cur_ptnum = "";
        if(strlen($nextnum_pt)<6){
            $b = 6-strlen($nextnum_pt);
            for($a=1;$a<=$b;$a++){
                $cur_ptnum .= "0";
            }
            $cur_ptnum .= $nextnum_pt;
        }else{
            $cur_ptnum = $nextnum_pt;
        }
        $str_code1 = date("Y").'-'.$cur_ptnum;

        if($_POST['ot_mode']=='1'){
            // 접수결제

            $sql = "select * from d_app_domestic where mt_idx = '{$_SESSION['mt_idx']}' and app_status < 1 and d_datetime = '' ";
            $dad = $DB->fetch_assoc($sql);
            $sql = "select * from d_app_domestic_item where app_idx = '{$dad['idx']}' ";
            $lista = $DB->select_query($sql);

            $sqla = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
            $mta = $DB->fetch_assoc($sqla);

            if($_POST['sale_price_point']>0){
                $curr_point = $mta['mt_point']-$_POST['sale_price_point'];
                $sqla = "update member_t set mt_point = '{$curr_point}' where idx = '{$_SESSION['mt_idx']}' ";
                $DB->db_query($sqla);

                $sql = "insert into point_t set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "code1 = '{$str_code1}', ";
                $sql .= "pt_type = 'M', ";
                $sql .= "pt_point = '{$_POST['sale_price_point']}', ";
                $sql .= "pt_content = '국내 상표 출원 결제 사용', ";
                $sql .= "re_amount = '{$curr_point}', ";
                $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
                $DB->db_query($sql);
            }

            $d_date = date("Y.m.d");
            $d_content = "접수 완료";
            $sql = "insert into d_app_domestic_history set ";
            $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
            $sql .= "app_idx = '{$dad['idx']}', ";
            $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
            $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
            $sql .= "d_date = '{$d_date}', ";
            $sql .= "d_content = '{$d_content}', ";
            $sql .= "d_content_file1 = '', ";
            $sql .= "d_content_file2 = '', ";
            $sql .= "d_content_file3 = '', ";
            $sql .= "d_price = '{$_POST['paid_amount']}', ";
            $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
            $sql .= "d_pay_status = '{$_POST['od_status']}' ";
            $DB->db_query($sql);

            foreach ($lista as $dadi){

                $sql = "insert into order_domestic set ";

                $sql_common = "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql_common .= "app_idx = '{$dad['idx']}', ";
                $sql_common .= "app_item_idx = '{$dadi['idx']}', ";
                $sql_common .= "ot_mode = '{$_POST['ot_mode']}', ";

                $sql_common .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql_common .= "merchant_uid = '{$_POST['merchant_uid']}', ";

                $sql_common .= "code_register1 = '{$_POST['code_register1']}', ";
                $sql_common .= "code_app = '{$_POST['code_app']}', ";
                $sql_common .= "code_register2 = '{$_POST['code_register2']}', ";

                $sql_common .= "cate_ps1 = '{$dadi['cate_ps1']}', ";
                $sql_common .= "cate_ps2 = '{$dadi['cate_ps2']}', ";

                $sql_common .= "apply_num = '{$_POST['apply_num']}', ";
                $sql_common .= "bank_name = '{$_POST['bank_name']}', ";
                $sql_common .= "buyer_addr = '{$_POST['buyer_addr']}', ";
                $sql_common .= "buyer_email = '{$_POST['buyer_email']}', ";
                $sql_common .= "buyer_name = '{$_POST['buyer_name']}', ";
                $sql_common .= "buyer_postcode = '{$_POST['buyer_postcode']}', ";
                $sql_common .= "buyer_tel = '{$_POST['buyer_tel']}', ";
                $sql_common .= "card_name = '{$_POST['card_name']}', ";
                $sql_common .= "card_number = '{$_POST['card_number']}', ";
                $sql_common .= "card_quota = '{$_POST['card_quota']}', ";
                $sql_common .= "currency = '{$_POST['currency']}', ";

                $odname = $_POST['odname'];
                $odname = str_replace("'","\'",$odname);
                $odname = str_replace('"','\"',$odname);
                $sql_common .= "odname = '{$_POST['odname']}', ";
                $sql_common .= "paid_amount = '{$_POST['paid_amount']}', ";
                $sql_common .= "sum_price = '{$_POST['sum_price']}', ";
                $sql_common .= "sale_price_mtcode = '{$_POST['sale_price_mtcode']}', ";
                $sql_common .= "sale_price_salecode = '{$_POST['sale_price_salecode']}', ";
                $sql_common .= "sale_price_point = '{$_POST['sale_price_point']}', ";

                $sql_common .= "paid_at = '{$_POST['paid_at']}', ";
                $sql_common .= "pay_method = '{$_POST['pay_method']}', ";
                $sql_common .= "pg_provider = '{$_POST['pg_provider']}', ";
                $sql_common .= "pg_tid = '{$_POST['pg_tid']}', ";
                $sql_common .= "receipt_url = '{$_POST['receipt_url']}', ";

                $sql_common .= "vbank_date = '{$_POST['vbank_date']}', ";
                $sql_common .= "vbank_holder = '{$_POST['vbank_holder']}', ";
                $sql_common .= "vbank_name = '{$_POST['vbank_name']}', ";
                $sql_common .= "vbank_num = '{$_POST['vbank_num']}', ";

                $sql_common .= "od_status = '{$_POST['od_status']}', ";
                if($_POST['od_status']=="paid") {
                    $sql_common .= "ot_updatedt = '{$o_datetime}', ";
                }
                $sql_common .= "ot_pdate = '{$o_datetime}' ";

                //echo $sql.$sql_common."<br><br>";
                $DB->db_query($sql.$sql_common);

            }

        }else if($_POST['ot_mode']=='2'){
            // 추가상품결제

            $sqla = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
            $mta = $DB->fetch_assoc($sqla);

            if($_POST['sale_price_point']>0){
                $curr_point = $mta['mt_point']-$_POST['sale_price_point'];
                $sqla = "update member_t set mt_point = '{$curr_point}' where idx = '{$_SESSION['mt_idx']}' ";
                $DB->db_query($sqla);

                $sql = "insert into point_t set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "code1 = '{$str_code1}', ";
                $sql .= "pt_type = 'M', ";
                $sql .= "pt_point = '{$_POST['sale_price_point']}', ";
                $sql .= "pt_content = '국내 상표 출원 결제 사용 - 추가상품결제', ";
                $sql .= "re_amount = '{$curr_point}', ";
                $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
                $DB->db_query($sql);
            }

            if($_POST['paid_amount']>0){
                $sql = "insert into order_domestic set ";
                $sql_common = "mt_idx = '{$_POST['mt_idx']}', ";
                $sql_common .= "app_idx = '{$_POST['app_idx']}', ";
                $sql_common .= "ot_mode = '{$_POST['ot_mode']}', ";
                $sql_common .= "buyer_email = '{$_POST['buyer_email']}', ";
                $sql_common .= "buyer_name = '{$_POST['buyer_name']}', ";
                $sql_common .= "buyer_tel = '{$_POST['buyer_tel']}', ";
                $sql_common .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql_common .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql_common .= "odname = '{$_POST['odname']}', ";
                $sql_common .= "paid_amount = '{$_POST['paid_amount']}', ";
                $sql_common .= "sum_price = '{$_POST['sum_price']}', ";
                $sql_common .= "sale_price_mtcode = '{$_POST['sale_price_mtcode']}', ";
                $sql_common .= "sale_price_salecode = '{$_POST['sale_price_salecode']}', ";
                $sql_common .= "sale_price_point = '{$_POST['sale_price_point']}', ";
                $sql_common .= "paid_at = '{$_POST['paid_at']}', ";
                $sql_common .= "pay_method = '{$_POST['pay_method']}', ";
                $sql_common .= "pg_provider = '{$_POST['pg_provider']}', ";
                $sql_common .= "pg_tid = '{$_POST['pg_tid']}', ";
                $sql_common .= "receipt_url = '{$_POST['receipt_url']}', ";
                $sql_common .= "vbank_date = '{$_POST['vbank_date']}', ";
                $sql_common .= "vbank_holder = '{$_POST['vbank_holder']}', ";
                $sql_common .= "vbank_name = '{$_POST['vbank_name']}', ";
                $sql_common .= "vbank_num = '{$_POST['vbank_num']}', ";
                $sql_common .= "od_status = '{$_POST['od_status']}', ";
                if($_POST['od_status']=="paid") {
                    $sql_common .= "ot_updatedt = '{$o_datetime}', ";
                }
                $sql_common .= "ot_pdate = '{$o_datetime}' ";
                $DB->db_query($sql.$sql_common);
            }


            $sql = "select * from d_app_domestic where mt_idx = '{$_POST['mt_idx']}' and idx = '{$_POST['app_idx']}' ";
            $dad = $DB->fetch_assoc($sql);

            $sqlz = "select * from d_app_domestic_history where app_idx = '{$_POST['app_idx']}' and d_content = '출원 준비' ";
            $rowz = $DB->fetch_assoc($sqlz);
            if($rowz['idx']){
                $d_date = date("Y.m.d");
                $txt_mod_ver1 = nl2br($_POST['txt_mod_ver1']);
                $txt_mod_ver1 = str_replace("'","\'",$txt_mod_ver1);
                $txt_mod_ver1 = str_replace('"','\"',$txt_mod_ver1);
                $sql = "update d_app_domestic_history set ";
                $sql .= "mt_idx = '{$_POST['mt_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '{$_POST['odname']}', ";
                $sql .= "txt_mod_ver1 = '{$txt_mod_ver1}', ";
                $sql .= "d_price = '{$_POST['paid_amount']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $sql .= "where idx = '{$rowz['idx']}' ";
                $DB->db_query($sql);
            }
;
        }else if($_POST['ot_mode']=='3'){
            // 2차수정비용

            $sqla = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
            $mta = $DB->fetch_assoc($sqla);

            if($_POST['sale_price_point']>0){
                $curr_point = $mta['mt_point']-$_POST['sale_price_point'];
                $sqla = "update member_t set mt_point = '{$curr_point}' where idx = '{$_SESSION['mt_idx']}' ";
                $DB->db_query($sqla);

                $sql = "insert into point_t set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "code1 = '{$str_code1}', ";
                $sql .= "pt_type = 'M', ";
                $sql .= "pt_point = '{$_POST['sale_price_point']}', ";
                $sql .= "pt_content = '국내 상표 출원 결제 사용 - 2차 수정비용', ";
                $sql .= "re_amount = '{$curr_point}', ";
                $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
                $DB->db_query($sql);
            }

            if($_POST['paid_amount']>0){
                $sql = "insert into order_domestic set ";
                $sql_common = "mt_idx = '{$_POST['mt_idx']}', ";
                $sql_common .= "app_idx = '{$_POST['app_idx']}', ";
                $sql_common .= "ot_mode = '{$_POST['ot_mode']}', ";
                $sql_common .= "buyer_email = '{$_POST['buyer_email']}', ";
                $sql_common .= "buyer_name = '{$_POST['buyer_name']}', ";
                $sql_common .= "buyer_tel = '{$_POST['buyer_tel']}', ";
                $sql_common .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql_common .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql_common .= "odname = '{$_POST['odname']}', ";
                $sql_common .= "paid_amount = '{$_POST['paid_amount']}', ";
                $sql_common .= "sum_price = '{$_POST['sum_price']}', ";
                $sql_common .= "sale_price_mtcode = '{$_POST['sale_price_mtcode']}', ";
                $sql_common .= "sale_price_salecode = '{$_POST['sale_price_salecode']}', ";
                $sql_common .= "sale_price_point = '{$_POST['sale_price_point']}', ";
                $sql_common .= "paid_at = '{$_POST['paid_at']}', ";
                $sql_common .= "pay_method = '{$_POST['pay_method']}', ";
                $sql_common .= "pg_provider = '{$_POST['pg_provider']}', ";
                $sql_common .= "pg_tid = '{$_POST['pg_tid']}', ";
                $sql_common .= "receipt_url = '{$_POST['receipt_url']}', ";
                $sql_common .= "vbank_date = '{$_POST['vbank_date']}', ";
                $sql_common .= "vbank_holder = '{$_POST['vbank_holder']}', ";
                $sql_common .= "vbank_name = '{$_POST['vbank_name']}', ";
                $sql_common .= "vbank_num = '{$_POST['vbank_num']}', ";
                $sql_common .= "od_status = '{$_POST['od_status']}', ";
                if($_POST['od_status']=="paid") {
                    $sql_common .= "ot_updatedt = '{$o_datetime}', ";
                }
                $sql_common .= "ot_pdate = '{$o_datetime}' ";
                $DB->db_query($sql.$sql_common);
            }


            $sql = "select * from d_app_domestic where mt_idx = '{$_POST['mt_idx']}' and idx = '{$_POST['app_idx']}' ";
            $dad = $DB->fetch_assoc($sql);

            $sqlz = "select * from d_app_domestic_history where app_idx = '{$_POST['app_idx']}' and d_content = '출원 준비' ";
            $rowz = $DB->fetch_assoc($sqlz);
            if($rowz['idx']){
                $d_date = date("Y.m.d");
                $txt_mod_ver2 = nl2br($_POST['txt_mod_ver2']);
                $txt_mod_ver2 = str_replace("'","\'",$txt_mod_ver2);
                $txt_mod_ver2 = str_replace('"','\"',$txt_mod_ver2);
                $sql = "update d_app_domestic_history set ";
                $sql .= "mt_idx = '{$_POST['mt_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '{$_POST['odname']}', ";
                $sql .= "txt_mod_ver2 = '{$txt_mod_ver2}', ";
                $sql .= "d_price = '{$_POST['paid_amount']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $sql .= "where idx = '{$rowz['idx']}' ";
                $DB->db_query($sql);
            }

        }else if($_POST['ot_mode']=='4'){
            // 3차수정비용

            $sqla = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
            $mta = $DB->fetch_assoc($sqla);

            if($_POST['sale_price_point']>0){
                $curr_point = $mta['mt_point']-$_POST['sale_price_point'];
                $sqla = "update member_t set mt_point = '{$curr_point}' where idx = '{$_SESSION['mt_idx']}' ";
                $DB->db_query($sqla);

                $sql = "insert into point_t set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "code1 = '{$str_code1}', ";
                $sql .= "pt_type = 'M', ";
                $sql .= "pt_point = '{$_POST['sale_price_point']}', ";
                $sql .= "pt_content = '국내 상표 출원 결제 사용 - 3차 수정비용', ";
                $sql .= "re_amount = '{$curr_point}', ";
                $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
                $DB->db_query($sql);
            }

            if($_POST['paid_amount']>0){
                $sql = "insert into order_domestic set ";
                $sql_common = "mt_idx = '{$_POST['mt_idx']}', ";
                $sql_common .= "app_idx = '{$_POST['app_idx']}', ";
                $sql_common .= "app_item_idx = '{$_POST['app_item_idx']}', ";
                $sql_common .= "ot_mode = '{$_POST['ot_mode']}', ";
                $sql_common .= "buyer_email = '{$_POST['buyer_email']}', ";
                $sql_common .= "buyer_name = '{$_POST['buyer_name']}', ";
                $sql_common .= "buyer_tel = '{$_POST['buyer_tel']}', ";
                $sql_common .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql_common .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql_common .= "odname = '{$_POST['odname']}', ";
                $sql_common .= "paid_amount = '{$_POST['paid_amount']}', ";
                $sql_common .= "sum_price = '{$_POST['sum_price']}', ";
                $sql_common .= "sale_price_mtcode = '{$_POST['sale_price_mtcode']}', ";
                $sql_common .= "sale_price_salecode = '{$_POST['sale_price_salecode']}', ";
                $sql_common .= "sale_price_point = '{$_POST['sale_price_point']}', ";
                $sql_common .= "paid_at = '{$_POST['paid_at']}', ";
                $sql_common .= "pay_method = '{$_POST['pay_method']}', ";
                $sql_common .= "pg_provider = '{$_POST['pg_provider']}', ";
                $sql_common .= "pg_tid = '{$_POST['pg_tid']}', ";
                $sql_common .= "receipt_url = '{$_POST['receipt_url']}', ";
                $sql_common .= "vbank_date = '{$_POST['vbank_date']}', ";
                $sql_common .= "vbank_holder = '{$_POST['vbank_holder']}', ";
                $sql_common .= "vbank_name = '{$_POST['vbank_name']}', ";
                $sql_common .= "vbank_num = '{$_POST['vbank_num']}', ";
                $sql_common .= "od_status = '{$_POST['od_status']}', ";
                if($_POST['od_status']=="paid") {
                    $sql_common .= "ot_updatedt = '{$o_datetime}', ";
                }
                $sql_common .= "ot_pdate = '{$o_datetime}' ";

                $DB->db_query($sql.$sql_common);
            }


            $sql = "select * from d_app_domestic where mt_idx = '{$_POST['mt_idx']}' and idx = '{$_POST['app_idx']}' ";
            $dad = $DB->fetch_assoc($sql);

            $sqlz = "select * from d_app_domestic_history where app_idx = '{$_POST['app_idx']}' and d_content = '출원 준비' ";
            $rowz = $DB->fetch_assoc($sqlz);
            if($rowz['idx']){
                $d_date = date("Y.m.d");
                $txt_mod_ver3 = nl2br($_POST['txt_mod_ver3']);
                $txt_mod_ver3 = str_replace("'","\'",$txt_mod_ver3);
                $txt_mod_ver3 = str_replace('"','\"',$txt_mod_ver3);
                $sql = "update d_app_domestic_history set ";
                $sql .= "mt_idx = '{$_POST['mt_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '{$_POST['odname']}', ";
                $sql .= "txt_mod_ver3 = '{$txt_mod_ver3}', ";
                $sql .= "d_price = '{$_POST['paid_amount']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $sql .= "where idx = '{$rowz['idx']}' ";
                $DB->db_query($sql);
            }

        }else if($_POST['ot_mode']=='5'){
            // 심사대응비용(심사결과통지)

            $sqla = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
            $mta = $DB->fetch_assoc($sqla);

            if($_POST['sale_price_point']>0){
                $curr_point = $mta['mt_point']-$_POST['sale_price_point'];
                $sqla = "update member_t set mt_point = '{$curr_point}' where idx = '{$_SESSION['mt_idx']}' ";
                $DB->db_query($sqla);

                $sql = "insert into point_t set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "code1 = '{$str_code1}', ";
                $sql .= "pt_type = 'M', ";
                $sql .= "pt_point = '{$_POST['sale_price_point']}', ";
                $sql .= "pt_content = '국내 상표 출원 결제 사용 - 심사대응비용(심사결과통지)', ";
                $sql .= "re_amount = '{$curr_point}', ";
                $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
                $DB->db_query($sql);
            }

            $sql = "insert into order_domestic set ";
            $sql_common = "mt_idx = '{$_POST['mt_idx']}', ";
            $sql_common .= "app_idx = '{$_POST['app_idx']}', ";
            $sql_common .= "app_item_idx = '{$_POST['app_item_idx']}', ";
            $sql_common .= "ot_mode = '{$_POST['ot_mode']}', ";
            $sql_common .= "buyer_email = '{$_POST['buyer_email']}', ";
            $sql_common .= "buyer_name = '{$_POST['buyer_name']}', ";
            $sql_common .= "buyer_tel = '{$_POST['buyer_tel']}', ";
            $sql_common .= "imp_uid = '{$_POST['imp_uid']}', ";
            $sql_common .= "merchant_uid = '{$_POST['merchant_uid']}', ";
            $sql_common .= "odname = '{$_POST['odname']}', ";
            $sql_common .= "paid_amount = '{$_POST['paid_amount']}', ";
            $sql_common .= "sum_price = '{$_POST['sum_price']}', ";
            $sql_common .= "sale_price_mtcode = '{$_POST['sale_price_mtcode']}', ";
            $sql_common .= "sale_price_salecode = '{$_POST['sale_price_salecode']}', ";
            $sql_common .= "sale_price_point = '{$_POST['sale_price_point']}', ";
            $sql_common .= "paid_at = '{$_POST['paid_at']}', ";
            $sql_common .= "pay_method = '{$_POST['pay_method']}', ";
            $sql_common .= "pg_provider = '{$_POST['pg_provider']}', ";
            $sql_common .= "pg_tid = '{$_POST['pg_tid']}', ";
            $sql_common .= "receipt_url = '{$_POST['receipt_url']}', ";
            $sql_common .= "vbank_date = '{$_POST['vbank_date']}', ";
            $sql_common .= "vbank_holder = '{$_POST['vbank_holder']}', ";
            $sql_common .= "vbank_name = '{$_POST['vbank_name']}', ";
            $sql_common .= "vbank_num = '{$_POST['vbank_num']}', ";
            $sql_common .= "od_status = '{$_POST['od_status']}', ";
            if($_POST['od_status']=="paid") {
                $sql_common .= "ot_updatedt = '{$o_datetime}', ";
            }
            $sql_common .= "ot_pdate = '{$o_datetime}' ";

            $DB->db_query($sql.$sql_common);


            $sql = "select * from d_app_domestic where mt_idx = '{$_POST['mt_idx']}' and idx = '{$_POST['app_idx']}' ";
            $dad = $DB->fetch_assoc($sql);

            $sqlz = "select * from d_app_domestic_history2 where app_idx = '{$_POST['app_idx']}' and app_item_idx = '{$_POST['app_item_idx']}' and d_content = '심사재개' ";
            $rowz = $DB->fetch_assoc($sqlz);
            if($rowz['idx']){
                $d_date = date("Y.m.d");
                $sql = "update d_app_domestic_history2 set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '심사재개', ";
                $sql .= "d_price = '{$_POST['paid_amount']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $sql .= "where idx = '{$rowz['idx']}' ";
                $DB->db_query($sql);
            }else{
                $d_date = date("Y.m.d");
                $sql = "insert into d_app_domestic_history2 set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "app_idx = '{$_POST['app_idx']}', ";
                $sql .= "app_item_idx = '{$_POST['app_item_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '심사재개', ";
                $sql .= "d_price = '{$_POST['paid_amount']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $DB->db_query($sql);
            }

        }else if($_POST['ot_mode']=='6'){
            // 심사대응비용(1차거절이후)

            $sqla = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
            $mta = $DB->fetch_assoc($sqla);

            if($_POST['sale_price_point']>0){
                $curr_point = $mta['mt_point']-$_POST['sale_price_point'];
                $sqla = "update member_t set mt_point = '{$curr_point}' where idx = '{$_SESSION['mt_idx']}' ";
                $DB->db_query($sqla);

                $sql = "insert into point_t set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "code1 = '{$str_code1}', ";
                $sql .= "pt_type = 'M', ";
                $sql .= "pt_point = '{$_POST['sale_price_point']}', ";
                $sql .= "pt_content = '국내 상표 출원 결제 사용 - 심사대응비용(1차거절이후)', ";
                $sql .= "re_amount = '{$curr_point}', ";
                $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
                $DB->db_query($sql);
            }

            $sql = "insert into order_domestic set ";
            $sql_common = "mt_idx = '{$_POST['mt_idx']}', ";
            $sql_common .= "app_idx = '{$_POST['app_idx']}', ";
            $sql_common .= "app_item_idx = '{$_POST['app_item_idx']}', ";
            $sql_common .= "ot_mode = '{$_POST['ot_mode']}', ";
            $sql_common .= "buyer_email = '{$_POST['buyer_email']}', ";
            $sql_common .= "buyer_name = '{$_POST['buyer_name']}', ";
            $sql_common .= "buyer_tel = '{$_POST['buyer_tel']}', ";
            $sql_common .= "imp_uid = '{$_POST['imp_uid']}', ";
            $sql_common .= "merchant_uid = '{$_POST['merchant_uid']}', ";
            $sql_common .= "odname = '{$_POST['odname']}', ";
            $sql_common .= "paid_amount = '{$_POST['paid_amount']}', ";
            $sql_common .= "sum_price = '{$_POST['sum_price']}', ";
            $sql_common .= "sale_price_mtcode = '{$_POST['sale_price_mtcode']}', ";
            $sql_common .= "sale_price_salecode = '{$_POST['sale_price_salecode']}', ";
            $sql_common .= "sale_price_point = '{$_POST['sale_price_point']}', ";
            $sql_common .= "paid_at = '{$_POST['paid_at']}', ";
            $sql_common .= "pay_method = '{$_POST['pay_method']}', ";
            $sql_common .= "pg_provider = '{$_POST['pg_provider']}', ";
            $sql_common .= "pg_tid = '{$_POST['pg_tid']}', ";
            $sql_common .= "receipt_url = '{$_POST['receipt_url']}', ";
            $sql_common .= "vbank_date = '{$_POST['vbank_date']}', ";
            $sql_common .= "vbank_holder = '{$_POST['vbank_holder']}', ";
            $sql_common .= "vbank_name = '{$_POST['vbank_name']}', ";
            $sql_common .= "vbank_num = '{$_POST['vbank_num']}', ";
            $sql_common .= "od_status = '{$_POST['od_status']}', ";
            if($_POST['od_status']=="paid") {
                $sql_common .= "ot_updatedt = '{$o_datetime}', ";
            }
            $sql_common .= "ot_pdate = '{$o_datetime}' ";

            $DB->db_query($sql.$sql_common);


            $sql = "select * from d_app_domestic where mt_idx = '{$_POST['mt_idx']}' and idx = '{$_POST['app_idx']}' ";
            $dad = $DB->fetch_assoc($sql);

            $sqlz = "select * from d_app_domestic_history2 where app_idx = '{$_POST['app_idx']}' and app_item_idx = '{$_POST['app_item_idx']}' and d_content = '심사진행' ";
            $rowz = $DB->fetch_assoc($sqlz);
            if($rowz['idx']){
                $d_date = date("Y.m.d");
                $sql = "update d_app_domestic_history2 set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '심사진행', ";
                $sql .= "d_price = '{$_POST['paid_amount']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $sql .= "where idx = '{$rowz['idx']}' ";
                $DB->db_query($sql);
            }else{
                $d_date = date("Y.m.d");
                $sql = "insert into d_app_domestic_history2 set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "app_idx = '{$_POST['app_idx']}', ";
                $sql .= "app_item_idx = '{$_POST['app_item_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '심사진행', ";
                $sql .= "d_price = '{$_POST['paid_amount']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $DB->db_query($sql);
            }

        }else if($_POST['ot_mode']=='7'){
            // 심사대응비용(2차거절이후)

            $sqla = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
            $mta = $DB->fetch_assoc($sqla);

            if($_POST['sale_price_point']>0){
                $curr_point = $mta['mt_point']-$_POST['sale_price_point'];
                $sqla = "update member_t set mt_point = '{$curr_point}' where idx = '{$_SESSION['mt_idx']}' ";
                $DB->db_query($sqla);

                $sql = "insert into point_t set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "code1 = '{$str_code1}', ";
                $sql .= "pt_type = 'M', ";
                $sql .= "pt_point = '{$_POST['sale_price_point']}', ";
                $sql .= "pt_content = '국내 상표 출원 결제 사용 - 심사대응비용(2차거절이후)', ";
                $sql .= "re_amount = '{$curr_point}', ";
                $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
                $DB->db_query($sql);
            }

            $sql = "insert into order_domestic set ";
            $sql_common = "mt_idx = '{$_POST['mt_idx']}', ";
            $sql_common .= "app_idx = '{$_POST['app_idx']}', ";
            $sql_common .= "app_item_idx = '{$_POST['app_item_idx']}', ";
            $sql_common .= "ot_mode = '{$_POST['ot_mode']}', ";
            $sql_common .= "buyer_email = '{$_POST['buyer_email']}', ";
            $sql_common .= "buyer_name = '{$_POST['buyer_name']}', ";
            $sql_common .= "buyer_tel = '{$_POST['buyer_tel']}', ";
            $sql_common .= "imp_uid = '{$_POST['imp_uid']}', ";
            $sql_common .= "merchant_uid = '{$_POST['merchant_uid']}', ";
            $sql_common .= "odname = '{$_POST['odname']}', ";
            $sql_common .= "paid_amount = '{$_POST['paid_amount']}', ";
            $sql_common .= "sum_price = '{$_POST['sum_price']}', ";
            $sql_common .= "sale_price_mtcode = '{$_POST['sale_price_mtcode']}', ";
            $sql_common .= "sale_price_salecode = '{$_POST['sale_price_salecode']}', ";
            $sql_common .= "sale_price_point = '{$_POST['sale_price_point']}', ";
            $sql_common .= "paid_at = '{$_POST['paid_at']}', ";
            $sql_common .= "pay_method = '{$_POST['pay_method']}', ";
            $sql_common .= "pg_provider = '{$_POST['pg_provider']}', ";
            $sql_common .= "pg_tid = '{$_POST['pg_tid']}', ";
            $sql_common .= "receipt_url = '{$_POST['receipt_url']}', ";
            $sql_common .= "vbank_date = '{$_POST['vbank_date']}', ";
            $sql_common .= "vbank_holder = '{$_POST['vbank_holder']}', ";
            $sql_common .= "vbank_name = '{$_POST['vbank_name']}', ";
            $sql_common .= "vbank_num = '{$_POST['vbank_num']}', ";
            $sql_common .= "od_status = '{$_POST['od_status']}', ";
            if($_POST['od_status']=="paid") {
                $sql_common .= "ot_updatedt = '{$o_datetime}', ";
            }
            $sql_common .= "ot_pdate = '{$o_datetime}' ";

            $DB->db_query($sql.$sql_common);


            $sql = "select * from d_app_domestic where mt_idx = '{$_POST['mt_idx']}' and idx = '{$_POST['app_idx']}' ";
            $dad = $DB->fetch_assoc($sql);

            $sqlz = "select * from d_app_domestic_history2 where app_idx = '{$_POST['app_idx']}' and app_item_idx = '{$_POST['app_item_idx']}' and d_content = '심사진행' ";
            $rowz = $DB->fetch_assoc($sqlz);
            $d_date = date("Y.m.d");
            $sql = "insert into d_app_domestic_history2 set ";
            $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
            $sql .= "app_idx = '{$_POST['app_idx']}', ";
            $sql .= "app_item_idx = '{$_POST['app_item_idx']}', ";
            $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
            $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
            $sql .= "d_date = '{$d_date}', ";
            $sql .= "d_content = '심사진행', ";
            $sql .= "d_price = '{$_POST['paid_amount']}', ";
            $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
            $sql .= "d_pay_status = '{$_POST['od_status']}' ";
            $DB->db_query($sql);

        }else if($_POST['ot_mode']=='8'){
            // 등록결정

            $sqla = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
            $mta = $DB->fetch_assoc($sqla);

            if($_POST['sale_price_point']>0){
                $curr_point = $mta['mt_point']-$_POST['sale_price_point'];
                $sqla = "update member_t set mt_point = '{$curr_point}' where idx = '{$_SESSION['mt_idx']}' ";
                $DB->db_query($sqla);

                $sql = "insert into point_t set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "code1 = '{$str_code1}', ";
                $sql .= "pt_type = 'M', ";
                $sql .= "pt_point = '{$_POST['sale_price_point']}', ";
                $sql .= "pt_content = '국내 상표 출원 결제 사용 - 등록결정', ";
                $sql .= "re_amount = '{$curr_point}', ";
                $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
                $DB->db_query($sql);
            }

            $sql = "insert into order_domestic set ";
            $sql_common = "mt_idx = '{$_POST['mt_idx']}', ";
            $sql_common .= "app_idx = '{$_POST['app_idx']}', ";
            $sql_common .= "app_item_idx = '{$_POST['app_item_idx']}', ";
            $sql_common .= "ot_mode = '{$_POST['ot_mode']}', ";
            $sql_common .= "buyer_email = '{$_POST['buyer_email']}', ";
            $sql_common .= "buyer_name = '{$_POST['buyer_name']}', ";
            $sql_common .= "buyer_tel = '{$_POST['buyer_tel']}', ";
            $sql_common .= "imp_uid = '{$_POST['imp_uid']}', ";
            $sql_common .= "merchant_uid = '{$_POST['merchant_uid']}', ";
            $sql_common .= "odname = '{$_POST['odname']}', ";
            $sql_common .= "paid_amount = '{$_POST['paid_amount']}', ";
            $sql_common .= "sum_price = '{$_POST['sum_price']}', ";
            $sql_common .= "sale_price_mtcode = '{$_POST['sale_price_mtcode']}', ";
            $sql_common .= "sale_price_salecode = '{$_POST['sale_price_salecode']}', ";
            $sql_common .= "sale_price_point = '{$_POST['sale_price_point']}', ";
            $sql_common .= "paid_at = '{$_POST['paid_at']}', ";
            $sql_common .= "pay_method = '{$_POST['pay_method']}', ";
            $sql_common .= "pg_provider = '{$_POST['pg_provider']}', ";
            $sql_common .= "pg_tid = '{$_POST['pg_tid']}', ";
            $sql_common .= "receipt_url = '{$_POST['receipt_url']}', ";
            $sql_common .= "vbank_date = '{$_POST['vbank_date']}', ";
            $sql_common .= "vbank_holder = '{$_POST['vbank_holder']}', ";
            $sql_common .= "vbank_name = '{$_POST['vbank_name']}', ";
            $sql_common .= "vbank_num = '{$_POST['vbank_num']}', ";
            $sql_common .= "od_status = '{$_POST['od_status']}', ";
            if($_POST['od_status']=="paid") {
                $sql_common .= "ot_updatedt = '{$o_datetime}', ";
            }
            $sql_common .= "ot_pdate = '{$o_datetime}' ";

            $DB->db_query($sql.$sql_common);


            $sql = "select * from d_app_domestic where mt_idx = '{$_POST['mt_idx']}' and idx = '{$_POST['app_idx']}' ";
            $dad = $DB->fetch_assoc($sql);

            $sqlz = "select * from d_app_domestic_history2 where app_idx = '{$_POST['app_idx']}' and app_item_idx = '{$_POST['app_item_idx']}' and d_content = '등록결정' order by idx desc limit 1 ";
            $rowz = $DB->fetch_assoc($sqlz);
            if($rowz['idx']){
                $d_date = date("Y.m.d");
                $sql = "update d_app_domestic_history2 set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '등록결정', ";
                $sql .= "d_price = '{$_POST['pay_price']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $sql .= "where idx = '{$rowz['idx']}' ";
                $DB->db_query($sql);
            }else{
                $d_date = date("Y.m.d");
                $sql = "insert into d_app_domestic_history2 set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "app_idx = '{$_POST['app_idx']}', ";
                $sql .= "app_item_idx = '{$_POST['app_item_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '등록결정', ";
                $sql .= "d_price = '{$_POST['pay_price']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $DB->db_query($sql);
            }

        }else if($_POST['ot_mode']=='9'){
            // 갱신료 지불

            $sqla = "select mt_point from member_t where idx = '{$_SESSION['mt_idx']}' ";
            $mta = $DB->fetch_assoc($sqla);

            if($_POST['sale_price_point']>0){
                $curr_point = $mta['mt_point']-$_POST['sale_price_point'];
                $sqla = "update member_t set mt_point = '{$curr_point}' where idx = '{$_SESSION['mt_idx']}' ";
                $DB->db_query($sqla);

                $sql = "insert into point_t set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "code1 = '{$str_code1}', ";
                $sql .= "pt_type = 'M', ";
                $sql .= "pt_point = '{$_POST['sale_price_point']}', ";
                $sql .= "pt_content = '국내 상표 출원 결제 사용 - 갱신료 지불', ";
                $sql .= "re_amount = '{$curr_point}', ";
                $sql .= "pt_rdate = DATE_ADD(NOW(), interval 2 YEAR) ";
                $DB->db_query($sql);
            }

            $sql = "insert into order_domestic set ";
            $sql_common = "mt_idx = '{$_POST['mt_idx']}', ";
            $sql_common .= "app_idx = '{$_POST['app_idx']}', ";
            $sql_common .= "app_item_idx = '{$_POST['app_item_idx']}', ";
            $sql_common .= "ot_mode = '{$_POST['ot_mode']}', ";
            $sql_common .= "buyer_email = '{$_POST['buyer_email']}', ";
            $sql_common .= "buyer_name = '{$_POST['buyer_name']}', ";
            $sql_common .= "buyer_tel = '{$_POST['buyer_tel']}', ";
            $sql_common .= "imp_uid = '{$_POST['imp_uid']}', ";
            $sql_common .= "merchant_uid = '{$_POST['merchant_uid']}', ";
            $sql_common .= "odname = '{$_POST['odname']}', ";
            $sql_common .= "paid_amount = '{$_POST['paid_amount']}', ";
            $sql_common .= "sum_price = '{$_POST['sum_price']}', ";
            $sql_common .= "sale_price_mtcode = '{$_POST['sale_price_mtcode']}', ";
            $sql_common .= "sale_price_salecode = '{$_POST['sale_price_salecode']}', ";
            $sql_common .= "sale_price_point = '{$_POST['sale_price_point']}', ";
            $sql_common .= "paid_at = '{$_POST['paid_at']}', ";
            $sql_common .= "pay_method = '{$_POST['pay_method']}', ";
            $sql_common .= "pg_provider = '{$_POST['pg_provider']}', ";
            $sql_common .= "pg_tid = '{$_POST['pg_tid']}', ";
            $sql_common .= "receipt_url = '{$_POST['receipt_url']}', ";
            $sql_common .= "vbank_date = '{$_POST['vbank_date']}', ";
            $sql_common .= "vbank_holder = '{$_POST['vbank_holder']}', ";
            $sql_common .= "vbank_name = '{$_POST['vbank_name']}', ";
            $sql_common .= "vbank_num = '{$_POST['vbank_num']}', ";
            $sql_common .= "od_status = '{$_POST['od_status']}', ";
            if($_POST['od_status']=="paid") {
                $sql_common .= "ot_updatedt = '{$o_datetime}', ";
            }
            $sql_common .= "ot_pdate = '{$o_datetime}' ";

            $DB->db_query($sql.$sql_common);

            /*
            $sql = "select * from d_app_domestic where mt_idx = '{$_POST['mt_idx']}' and idx = '{$_POST['app_idx']}' ";
            $dad = $DB->fetch_assoc($sql);

            $sqlz = "select * from d_app_domestic_history2 where app_idx = '{$_POST['app_idx']}' and app_item_idx = '{$_POST['app_item_idx']}' and d_content = '등록결정' ";
            $rowz = $DB->fetch_assoc($sqlz);
            if($rowz['idx']){
                $d_date = date("Y.m.d");
                $sql = "update d_app_domestic_history2 set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '등록결정', ";
                $sql .= "d_price = '{$_POST['pay_price']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $sql .= "where idx = '{$rowz['idx']}' ";
                $DB->db_query($sql);
            }else{
                $d_date = date("Y.m.d");
                $sql = "insert into d_app_domestic_history2 set ";
                $sql .= "mt_idx = '{$_SESSION['mt_idx']}', ";
                $sql .= "app_idx = '{$_POST['app_idx']}', ";
                $sql .= "app_item_idx = '{$_POST['app_item_idx']}', ";
                $sql .= "imp_uid = '{$_POST['imp_uid']}', ";
                $sql .= "merchant_uid = '{$_POST['merchant_uid']}', ";
                $sql .= "d_date = '{$d_date}', ";
                $sql .= "d_content = '등록결정', ";
                $sql .= "d_price = '{$_POST['pay_price']}', ";
                $sql .= "d_pay_method = '{$_POST['pay_method']}', ";
                $sql .= "d_pay_status = '{$_POST['od_status']}' ";
                $DB->db_query($sql);
            }
            */

        }
        break;

    case "del_domestic":
        $sql = "delete from d_app_domestic where idx = '{$_POST['idx']}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from d_app_domestic";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE d_app_domestic AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);

        $sql = "delete from d_app_domestic_item where app_idx = '{$_POST['idx']}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from d_app_domestic_item";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE d_app_domestic_item AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);

        $sql = "delete from d_app_domestic_history where app_idx = '{$_POST['idx'][$k]}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from d_app_domestic_history";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE d_app_domestic_history AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);

        $sql = "delete from order_domestic where app_idx = '{$_POST['idx'][$k]}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from order_domestic";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE order_domestic AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);

        break;

    case "del_domestic_item":
        $sql = "delete from d_app_domestic_item where idx = '{$_POST['idx']}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from d_app_domestic_item";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE d_app_domestic_item AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);
        break;

    case "del_dadh":
        $sql = "select * from d_app_domestic_history where idx = '{$_POST['h_idx']}' ";
        $rowh = $DB->fetch_assoc($sql);
        $app_idx = $rowh['app_idx'];

        $sql = "delete from d_app_domestic_history where idx = '{$_POST['h_idx']}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from d_app_domestic_history";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE d_app_domestic_history AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history where app_idx = '{$app_idx}' order by idx desc limit 1 ";
        $dadh = $DB->fetch_assoc($sql);

        if(strpos("a".$dadh['d_content'],"1차 수정요청")!=false){
            $sql = "update d_app_domestic set app_status = '3' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh['d_content'],"2차 수정요청")!=false){
            $sql = "update d_app_domestic set app_status = '4' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh['d_content'],"3차 수정요청")!=false){
            $sql = "update d_app_domestic set app_status = '5' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh['d_content'],"출원준비")!=false){
            if($dadh['d_content_file3']){
                $sql = "update d_app_domestic set app_status = '4' ";
                $DB->db_query($sql);
            }else if($dadh['d_content_file2']){
                $sql = "update d_app_domestic set app_status = '3' ";
                $DB->db_query($sql);
            }else if($dadh['d_content_file1']){
                $sql = "update d_app_domestic set app_status = '2' ";
                $DB->db_query($sql);
            }
        }

        break;

    case "del_dadh2":
        $sql = "select * from d_app_domestic_history2 where idx = '{$_POST['h_idx']}' ";
        $rowh = $DB->fetch_assoc($sql);
        $app_idx = $rowh['app_idx'];
        $app_item_idx = $_POST['app_item_idx'];

        $sql = "delete from d_app_domestic_history2 where idx = '{$_POST['h_idx']}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from d_app_domestic_history2";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE d_app_domestic_history2 AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_history2 where app_item_idx = '{$app_item_idx}' order by idx desc limit 1 ";
        $dadh2 = $DB->fetch_assoc($sql);

        if(strpos("a".$dadh2['d_content'],"등록완료")!=false){
            $sql = "update d_app_domestic_item set d_status = '14' where idx = '{$app_item_idx}'  ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"등록결정")!=false){
            $sql = "update d_app_domestic_item set d_status = '13' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"출원공고")!=false){
            $sql = "update d_app_domestic_item set d_status = '11' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"승소")!=false){
            $sql = "update d_app_domestic_item set d_status = '10' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"심판결과(패소)")!=false){
            $sql = "update d_app_domestic_item set d_status = '9' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"심사진행")!=false){
            $sql = "update d_app_domestic_item set d_status = '7' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"거절결정 2차")!=false){
            $sql = "update d_app_domestic_item set d_status = '8' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"거절결정 1차")!=false){
            $sql = "update d_app_domestic_item set d_status = '6' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"심사재개")!=false){
            $sql = "update d_app_domestic_item set d_status = '5' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"심사결과 통지")!=false){
            $sql = "update d_app_domestic_item set d_status = '4' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"출원취소")!=false){
            $sql = "update d_app_domestic_item set d_status = '3' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"심사중")!=false){
            $sql = "update d_app_domestic_item set d_status = '2' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }else if(strpos("a".$dadh2['d_content'],"출원 완료")!=false){
            $sql = "update d_app_domestic_item set d_status = '1' where idx = '{$app_item_idx}' ";
            $DB->db_query($sql);
        }
        echo $sql;

        break;

    case "dt_add":
        if($_POST['dtval']){
            if($_POST['dt_unit']=="y"){ $dt_unit = "year"; }else if($_POST['dt_unit']=="m"){ $dt_unit = "month"; }else if($_POST['dt_unit']=="d"){ $dt_unit = "day"; }
            $sqlb = "select date_add('{$_POST['dtval']}',interval {$_POST['add_val']} {$dt_unit}) as dt from dual ";
            $rowb = $DB->fetch_assoc($sqlb);
            echo $rowb['dt'];
        }
        break;

    case "cancel_app_item":
        $sql = "update d_app_domestic_item set d_status = '3' where idx = '{$_POST['idx']}' ";
        $DB->db_query($sql);

        $sql = "select * from d_app_domestic_item where idx = '{$_POST['idx']}' ";
        $dadi = $DB->fetch_assoc($sql);

        $sql = "select * from d_app_domestic where idx = '{$dadi['app_idx']}' ";
        $dad = $DB->fetch_assoc($sql);

        $sql = "select * from d_app_domestic_history2 where mt_idx = '{$dad['mt_idx']}' and app_item_idx = '{$_POST['idx']}' and d_content = '출원취소' ";
        $row = $DB->fetch_assoc($sql);

        $d_date = date("Y.m.d");
        if($row['idx']){
            $sql = "delete from d_app_domestic_history2 where app_idx = '{$row['idx']}' ";
            $DB->db_query($sql);
            $sql = "select count(*) as cnt from d_app_domestic_history2";
            $row2 = $DB->fetch_assoc($sql);
            $sql = "ALTER TABLE d_app_domestic_history2 AUTO_INCREMENT={$row2['cnt']} ";
            $DB->db_query($sql);

            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$dad['idx']}', ";
            $sql_h .= "app_item_idx = '{$_POST['idx']}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '출원취소' ";
            $DB->db_query($sql_h);

        }else{
            $sql_h = "insert into d_app_domestic_history2 set ";
            $sql_h .= "mt_idx = '{$dad['mt_idx']}', ";
            $sql_h .= "app_idx = '{$dad['idx']}', ";
            $sql_h .= "app_item_idx = '{$_POST['idx']}', ";
            $sql_h .= "d_date = '{$d_date}', ";
            $sql_h .= "d_content = '출원취소' ";
            $DB->db_query($sql_h);

        }
        break;

    case "chg_od_status_mng":
        $idx = $_POST['idx'];
        $strval = $_POST['strval'];

        $sql = "update order_domestic set od_status = '{$strval}' where idx = '{$idx}' ";
        $DB->db_query($sql);
        break;

    case "refund_order_mng":
        $idx = $_POST['idx'];
        $sql = "select * from order_domestic where idx = '{$idx}' ";
        $row = $DB->fetch_assoc($sql);
        $ot_updatedt = date("Y.m.d H:i:s");

        $sql = "update order_domestic set ";
        $sql .= "od_status = 'canceled', ";
        $sql .= "ot_updatedt = '{$ot_updatedt}' ";
        $sql .= "where idx = '{$idx}' ";
        echo $sql;
        $DB->db_query($sql);

        break;

    case "del_content":
        $tbname = $_POST['tbname'];
        $idx = $_POST['idx'];

        $sql = "delete from {$tbname} where idx = '{$idx}' ";
        $DB->db_query($sql);
        $sql = "select count(*) as cnt from {$tbname}";
        $row = $DB->fetch_assoc($sql);
        $sql = "ALTER TABLE {$tbname} AUTO_INCREMENT={$row['cnt']} ";
        $DB->db_query($sql);
        break;

    case "chk_salecode":
        $code_sale = $_POST['code_sale'];

        $sqla = "select * from discount_code_t where d_code_name = '{$code_sale}' ";
        $rowa = $DB->fetch_assoc($sqla);
        if($rowa['idx']){
            // 동일한 할인코드가 있을 때

            if($rowa['d_num']<1){
                // 코드 한정 수량이 0일 때
                $msg = 'b';
                echo $msg;
            }else{
                // 코드 한정 수량이 1 이상일 때

                $sqlb = "select datediff('".$rowa['ct_sdate']."',date_format(now(),'%Y-%m-%d')) as dtnum from dual ";
                $rowb = $DB->fetch_assoc($sqlb);
                $dtnum1 = $rowb['dtnum'];

                $sqlb = "select datediff('".$rowa['ct_edate']."',date_format(now(),'%Y-%m-%d')) as dtnum from dual ";
                $rowb = $DB->fetch_assoc($sqlb);
                $dtnum2 = $rowb['dtnum'];

                if($dtnum1>0){
                    // 쿠폰 사용 시작일 이전일 때
                    $msg = 'c';
                    echo $msg;
                }else if($dtnum2<0){
                    // 쿠폰 사용 마감일 이후일 때
                    $msg = 'd';
                    echo $msg;
                }else{
                    $sqlb = "select count(*) as cnt from d_app_domestic where mt_idx = '{$_SESSION['mt_idx']}' and code_sale = '{$code_sale}' ";
                    $rowb = $DB->fetch_assoc($sqlb);
                    $cnt1 = $rowb['cnt'];
                    $sqlc = "select count(*) as cnt from d_app_domestic_item dadi left join d_app_domestic dad on dadi.app_idx = dad.idx where dad.mt_idx = '{$_SESSION['mt_idx']}' and dadi.code_sale = '{$code_sale}' ";
                    $rowc = $DB->fetch_assoc($sqlc);
                    $cnt2 = $rowc['cnt'];
                    if($cnt1>0){
                        // 할인코드를 사용한 이력이 있을 때
                        $msg = 'e';
                        echo $msg;
                    }else if($cnt2>0){
                        // 할인코드를 사용한 이력이 있을 때
                        $msg = 'e';
                        echo $msg;
                    }else{
                        // 할인율 반환
                        echo $rowa['d_rate'];
                    }
                }

            }

        }else{
            // 동일한 할인코드가 없을 때
            $msg = 'a';
            echo $msg;
        }


        break;
}
?>
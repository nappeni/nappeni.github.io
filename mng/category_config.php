<?
include_once('./category/lib/category.lib.php');
include "./head_inc.php";
$g5['title'] = '분류 관리';

//echo '<link rel="stylesheet" href="./category/css/default.css">'.PHP_EOL;
echo '<link rel="stylesheet" href="./category/css/adm.css">'.PHP_EOL;

// 초기화
$tmp_option1 = "<option value='0'>　[1차 분류 입력시 선택]　</option>";
$shopCateInput = "";
$shopCateInputLog = "";
$tmp_code = "0";
$tmp_shopCateInput_value0 = "";
$shopCateInput_value = "";

/*
for ($i=0; $row=sql_fetch_array($result); $i++) {

    // 첫번째 분류 옵션
    if ($row['category'] == '1' && $row['code'] == '0') {

        $tmp_option1 .= "<option value='".$row['id']."'>".filter1($row['subject'])."</option>";
        $tmp_shopCateInput_value0 .= "update:%:".$row['id'].":%:".filter1($row['subject']).":%:".$row['category'].":%:".$row['code']."|%|";

    }

    // 초기화
    $shopCateInput_value = "";

    // 데이터
    $result2 = sql_query(" select * from {$g5['c_category_table']} where code = '".$row['id']."' order by c_position asc, id asc ");
    for ($k=0; $code=sql_fetch_array($result2); $k++) {

        $shopCateInput_value .= "update:%:".$code['id'].":%:".filter1($code['subject']).":%:".$code['category'].":%:".$code['code']."|%|";

    }

    // id별 값을 생성
    $shopCateInput .= "shopCateInput('', '".$row['id']."', '".$shopCateInput_value."');";
    $shopCateInputLog .= "shopCateInputLog('', '".$row['id']."', '".$row['c_log']."');";

}
*/

// 마지막 id 값을 구한다.
$count = $DB->fetch_assoc(" select * from g5_category order by c_id desc ");

// 데이터가 존재하면
if ($count['c_id']) {
    // 마지막 id 값에 1 더한다.
    $tmp_code = $count['c_id'] + 1;
} else {
    $tmp_code = "0";
}
?>
<style type="text/css">
.contents_box {min-width:1045px;}
</style>

<script type="text/javascript" src="./category/js/category.js"></script>
<script type="text/javascript" src="./category/js/admin.js"></script>

<script type="text/javascript">
function categorySave()
{

    var f = document.formCategory;

    f.m.value = "";

    if (confirm("현재의 분류 설정값을 저장 하시겠습니까?")) {

        f.action = "./category_config_update.php";
        f.submit();

    } else {

        return false;

    }

}

function categoryTruncate()
{

    var f = document.formCategory;

    f.m.value = "truncate";

    if (confirm("상품분류를 초기화 하시겠습니까?\n\n초기화 하시면 복구가 불가능하며, 생성된 분류 및 설정값은 삭제됩니다.")) {

        f.action = "./category_config_update.php";
        f.submit();

    } else {

        return false;

    }

}
</script>

<p style="color:#e00000;font-weight: 600;padding: 0 0 2px;">※ 1단계 분류는 절대 수정하지 않는다</p>
<div class="contents_box">
    <form method="post" name="formCategory" autocomplete="off">
    <input type="hidden" name="m" value="" />
    <input type="hidden" id="category" name="category" value="0" />
    <input type="hidden" id="code" name="code" />
    <input type="hidden" id="tmp_code" name="tmp_code" value="<?=$tmp_code?>" />
    <input type="hidden" id="defalt_category" name="defalt_category" value="0" />
    <input type="hidden" id="defalt_code1" name="defalt_code1" value="0" />
    <input type="hidden" id="defalt_code2" name="defalt_code2" value="" />
    <input type="hidden" id="defalt_code3" name="defalt_code3" value="" />
    <input type="hidden" id="defalt_code4" name="defalt_code4" value="" />
    <input type="hidden" id="defalt_code5" name="defalt_code5" value="" />
    <input type="hidden" id="tmp_option" name="tmp_option" value="" />
    <input type="hidden" id="code0" name="code0" value="<?=$tmp_shopCateInput_value0?>" />
    <input type="hidden" id="tmp_log" name="tmp_log" value="" />
    <input type="hidden" id="log0" name="log0" value="" />

        <table id="inputCodeAdd" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
        <table id="inputCodeAddKind" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
        <table id="inputCodeAddLog" cellpadding="0" cellspacing="0" border="0" style="display:none;"></table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <tr height="443">
            <td width="305" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="title_bg">
            <td align="center" class="listname">관리자 분류 설정</td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
        <tr>
            <td width="30"></td>
            <td width="16"><img src="./category/img/ic1.gif"></td>
            <td class="listname">새 분류 추가</td>
        </tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
        <tr>
            <td width="46"></td>
            <td><input type="text" id="subject" name="subject" value="" onFocus="shopInfocus2(this);" onBlur="shopOutfocus2(this);" class="input2" style="width:145px;" /></td>
            <td width="5"></td>
            <td><a href="#" onclick="shopCateInsert(); return false;"><img src="./category/img/add.gif" border="0"></a></td>
        </tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
            <td width="46"></td>
            <td class="help1">분류상자에서 분류명을 선택 후 추가</td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:17px;">
        <tr><td class="line2"></td></tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
        <tr>
            <td width="30"></td>
            <td width="16"><img src="./category/img/ic1.gif"></td>
            <td class="listname">분류명 변경</td>
        </tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
        <tr>
            <td width="46"></td>
            <td><input type="text" id="ch_subject" name="ch_subject" value="" onFocus="shopInfocus2(this);" onBlur="shopOutfocus2(this);" class="input2" style="width:145px;" /></td>
            <td width="5"></td>
            <td><a href="#" onclick="shopCateChange(); return false;"><img src="./category/img/edit.gif" border="0"></a></td>
        </tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
            <td width="46"></td>
            <td class="help1">선택하신 분류명의 명칭을 변경합니다.</td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:17px;">
        <tr><td class="line2"></td></tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
        <tr>
            <td width="30"></td>
            <td width="16"><img src="./category/img/ic1.gif"></td>
            <td class="listname">순서 정렬</td>
            <td width="79"></td>
            <td><a href="#" onclick="shopCateMove('U'); return false;"><img src="./category/img/btn_u.gif" border="0" title="위로" alt="위로"></a></td>
            <td width="2"></td>
            <td><a href="#" onclick="shopCateMove('D'); return false;"><img src="./category/img/btn_d.gif" border="0" title="아래로" alt="아래로"></a></td>
            <td width="2"></td>
            <td><a href="#" onclick="shopCateMove('T'); return false;"><img src="./category/img/btn_t.gif" border="0" title="맨위로" alt="맨위로"></a></td>
            <td width="2"></td>
            <td><a href="#" onclick="shopCateMove('B'); return false;"><img src="./category/img/btn_b.gif" border="0" title="맨아래로" alt="맨아래로"></a></td>
        </tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
            <td width="46"></td>
            <td class="help1">선택하신 분류명의 출력순서를 변경 합니다.</td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:17px;">
        <tr><td class="line2"></td></tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
        <tr>
            <td width="30"></td>
            <td width="16"><img src="./category/img/ic1.gif"></td>
            <td class="listname">분류 삭제</td>
        </tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
        <tr>
            <td width="46"></td>
            <td class="tx1">현재 선택된 분류명을</td>
            <td width="10"></td>
            <td><a href="#" onclick="shopDelete(); return false;"><img src="./category/img/delete.gif" border="0"></a></td>
            <td width="10"></td>
            <td class="tx1">합니다.</td>
        </tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:7px;">
        <tr>
            <td width="46"></td>
            <td class="help1" style="line-height:16px;">Tip : 분류상자에서 분류명을 마우스 더블클릭<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;하셔도 삭제처리 됩니다.</td>
        </tr>
        </table>
            </td>
            <td width="1" bgcolor="#e4e4e4"></td>
            <td width="3"></td>
            <td width="1" bgcolor="#e4e4e4"></td>
            <td valign="top">
        <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="180" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="title_bg">
            <td align="center" class="listname">1단계 분류 상자</td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><select id="category1" name="category1" size="2" class="select_list2" onclick="shopChange('1', this.value);" ondblclick="shopDelete();"><?//=$tmp_option1?></select></td><!-- -->
        </tr>
        </table>
            </td>
            <td width="1" bgcolor="#e4e4e4"></td>
            <td width="3"></td>
            <td width="1" bgcolor="#e4e4e4"></td>
            <td width="180" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="title_bg">
            <td align="center" class="listname">2단계 분류 상자</td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><select id="category2" name="category2" size="2" class="select_list2" onclick="shopChange('2', this.value);" ondblclick="shopDelete();"><option value="">　</option></select></td><!-- -->
        </tr>
        </table>
            </td>
            <td width="1" bgcolor="#e4e4e4"></td>
            <td width="3"></td>
            <td width="1" bgcolor="#e4e4e4"></td>
            <td width="180" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="title_bg">
            <td align="center" class="listname">3단계 분류 상자</td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><select id="category3" name="category3" size="2" class="select_list2" onclick="shopChange('3', this.value);" ondblclick="shopDelete();"><option value="">　</option></select></td><!-- -->
        </tr>
        </table>
            </td>
            <td width="1" bgcolor="#e4e4e4"></td>
            <td width="3"></td>
            <td width="1" bgcolor="#e4e4e4"></td>
            <td width="180" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr class="title_bg">
            <td align="center" class="listname">4단계 분류 상자</td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td><select id="category4" name="category4" size="2" class="select_list2" onclick="shopChange('4', this.value);" ondblclick="shopDelete();"><option value="">　</option></select></td><!-- -->
        </tr>
        </table>
            </td>
            <td width="1" bgcolor="#e4e4e4"></td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:3px;">
        <tr><td height="1" bgcolor="#e4e4e4" class="none">&nbsp;</td></tr>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" style="margin:11px auto 0 auto;">
        <tr>
            <td><a href="#" onclick="shopCateMove('U'); return false;"><img src="./category/img/btn_u.gif" border="0" title="위로" alt="위로"></a></td>
            <td width="2"></td>
            <td><a href="#" onclick="shopCateMove('D'); return false;"><img src="./category/img/btn_d.gif" border="0" title="아래로" alt="아래로"></a></td>
            <td width="2"></td>
            <td><a href="#" onclick="shopCateMove('T'); return false;"><img src="./category/img/btn_t.gif" border="0" title="맨위로" alt="맨위로"></a></td>
            <td width="2"></td>
            <td><a href="#" onclick="shopCateMove('B'); return false;"><img src="./category/img/btn_b.gif" border="0" title="맨아래로" alt="맨아래로"></a></td>
            <td width="2"></td>
            <td><a href="#" onclick="shopDelete(); return false;"><img src="./category/img/delete2.gif" border="0"></a></td>
        </tr>
        </table>
            </td>
        </tr>
        <tr height="1">
            <td bgcolor="#e4e4e4"></td>
            <td></td>
            <td bgcolor="#e4e4e4"></td>
            <td bgcolor="#e4e4e4"></td>
            <td bgcolor="#e4e4e4"></td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr><td height="1" bgcolor="#c9c9c9" class="none">&nbsp;</td></tr>
        <tr><td height="1" bgcolor="#ffffff" class="none">&nbsp;</td></tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0" style="margin:20px auto 0 auto;">
        <tr>
            <td><a href="#" onclick="categorySave(); return false;"><img src="./category/img/confirm.gif" border="0" /></a></td>
            <td width="5"></td>
            <td><a href="./category_config.php"><img src="./category/img/cancel.gif" border="0"></a></td>
            <td width="5"></td>
            <td><a href="#" onclick="categoryTruncate(); return false"><img src="./category/img/truncate.gif" border="0"></a></td>
        </tr>
        </table>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr height="15"><td></td></tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0" class="auto">
        <tr>
            <td class="msg2">확인 버튼을 클릭하셔야만 현재의 설정값이 적용 됩니다.</td>
        </tr>
        </table>
    </form>

    <div class="page_bottom"></div>
</div>

<?/*
$result_cnt = sql_fetch(" select count(*) AS cnt from {$g5['c_category_table']} order by c_position asc, id asc ");
//------------------------------------------------------------------------------------------
$rows = 4000;
$total_count = $result_cnt['cnt'];
$total_page = ceil($total_count/$rows);//총 페이지
//------------------------------------------------------------------------------------------
for ($p=1; $p<=$total_page; $p++) {

    if ($total_count-($rows * $p) > 0) {//다음페이지가 있는지(남은게 천개보다 큰지) 확인.
        $max = $rows;
    } else {
        $max = $total_count-($rows * ($p-1));//$total_count;
    }
    $from_record = $rows * ($p-1);

    $sql = "select * from {$g5['c_category_table']} order by c_position asc, id asc LIMIT {$from_record}, {$max}";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        // 첫번째 분류 옵션
        if ($row['category'] == '1' && $row['code'] == '0') {
            $tmp_option1 .= "<option value='".$row['id']."'>".filter1($row['subject'])."</option>";
            $tmp_shopCateInput_value0 .= "update:%:".$row['id'].":%:".filter1($row['subject']).":%:".$row['category'].":%:".$row['code']."|%|";
        }

        // 초기화
        $shopCateInput_value = "";

        // 데이터
        $result2 = sql_query(" select * from {$g5['c_category_table']} where code = '".$row['id']."' order by c_position asc, id asc ");
        for ($k=0; $code=sql_fetch_array($result2); $k++) {
            $shopCateInput_value .= "update:%:".$code['id'].":%:".filter1($code['subject']).":%:".$code['category'].":%:".$code['code']."|%|";
        }

        // id별 값을 생성
        $shopCateInput .= "shopCateInput('', '".$row['id']."', '".$shopCateInput_value."');";
        $shopCateInputLog .= "shopCateInputLog('', '".$row['id']."', '".$row['c_log']."');";

    }
    //flush();
    //if(($p%$rows) == 0){}
    sleep(1);//$rows개 보내고 휴식
}*/
?>
<script type="text/javascript">
jQuery(function($){
    get_List_data();
});
function get_List_data() {
    var url = "proc.php";
    var params = $.param({'proc_mode':'getList_category'});

    $.ajax({
        url : url,
        data : params,
        type : "GET",
        dataType : "json",
        //timeout: 30000,
        success : function(response, status, request) {
            var tdata = $.parseJSON(request.responseText);
            var total_count = tdata.total_count;
            var data = tdata.result;

            if (total_count) {
                $('input#code0').val(data.tmp_shopCateInput_value0);
                $('select#category1').append(data.tmp_option1);

                var sCategory_id = data.sCategory_id;
                var sCategory_log = data.sCategory_log;
                var sCategory_cat = data.sCategory_cat;
                var sCategory_value = data.sCategory_value;
                var id_length = sCategory_id.length;
                for (var i=0; i<id_length; i++) {
                    //console.log(sCategory_id[i]);
                    //shopCateInput('', sCategory_id[i], '', sCategory_cat[i]);
                    shopCateInput('', sCategory_id[i], sCategory_value[i]);
                    shopCateInputLog('', sCategory_id[i], sCategory_log[i]);
                }

                /*$('select#category1 option').each(function(index, item){
                    if (index > 0) {
                        var el = $('select#category1 option:eq('+index+')');
                        var val = el.val();
                        var id = el.parent().attr('id');
                        id_arr = id.split('category');
                        id = id_arr[1];
                        //console.log('id: '+id+' / val: '+val);
                        if (id && val) {
                            get_CateInput(id, val);
                        }
                    }
                });*/
                //get_CodeInput();
            }
        },
        beforeSend:function(){
            showOnLoading();
        },
        complete:function(){
            $.fancybox.close();
        },
        error : function(request, status, error) {
            $.fancybox.close();
            console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
    });
}
/*function get_CodeInput() {

    $('#inputCodeAdd input[name^=code]').each(function(index, item){
        if (index > 0) {
            var el = $('#inputCodeAdd input[name^=code]:eq('+index+')');
            var id = el.attr('class');
            var val = el.attr('id');
            id_arr = val.split('code');
            val = id_arr[1];
            console.log('id: '+id+' / val: '+val);
            if (id && val) {
                //get_CateInput(id, val);
            }
        }
    });
}
function get_CateInput(id, val) {
    var url = "proc.php";
    var params = $.param({'proc_mode':'getList_category', 'a':'get_value', 'id': id, 'category_id': val});

    $.get(url, params, function(args) {
        var tdata = JSON.parse(args);
        //console.log(tdata.sql);
        var data = tdata.result;
        var total_count = tdata.total_count;
        if (total_count) {
            var sCategory_value = data.sCategory_value;
            if ($('input#code'+val).length) {
                $('input#code'+val).val(sCategory_value);
            } else {
                shopCateInput('', val, sCategory_value);
            }
            //shopChange(id, val);
        }
    });
}*/
/*
document.getElementById("code0").value = "<?=$tmp_shopCateInput_value0?>";

$(function() {
    $('select#category1').append("<?=$tmp_option1?>");
    <?=$shopCateInput?><?=$shopCateInputLog?>
});*/
</script>
<?
include_once('./foot_inc.php');
?>

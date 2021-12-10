<?
include "./head_inc.php";
$chk_menu = '6';
$chk_sub_menu = '3';
include "./head_menu_inc.php";

$n_limit_num = 15;
$n_limit = $n_limit_num;
$pg = $_GET['pg'];

$qstr = "stx=".$_GET['stx'];
$qstr .= "&sfl=".$_GET['sfl'];
$qstr .= "&stx_dt1=".$_GET['stx_dt1'];
$qstr .= "&stx_dt2=".$_GET['stx_dt2'];
$qstr .= "&pg=";

$sql_from = "from d_refunt dr  ";
$sql = "select dr.* {$sql_from} ";
$sql_count = " select count(*) as cnt {$sql_from} ";
$sql_order = "order by dr.idx desc ";
$sql_where = "where cate1='international' ";

if($_GET['stx']) {
    $sql_where .= "and instr(dr.strcode, '".$_GET['stx']."')";
}
if($_GET['stx_dt1']) {
    $sql_where .= "and left(dr.d_datetime,10) >= '".str_replace(".","-",$_GET['stx_dt1'])."' ";
}
if($_GET['stx_dt2']) {
    $sql_where .= "and left(dr.d_datetime,10) <= '".str_replace(".","-",$_GET['stx_dt2'])."' ";
}

$row_cnt = $DB->fetch_assoc($sql_count.$sql_where);
$total_count = $row_cnt['cnt'];
$n_page = ceil($total_count / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;

unset($list);
$sql_query = $sql.$sql_where.$sql_order."limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">환불 관리</h4>

                        <!-- tab menu -->
                        <div class="mb-3">
                            <input type="button" class="jm-tab1" value="국내 출원" onclick="location.href='./refund_list_domestic.php'">
                            <input type="button" class="jm-tab1 active" value="국제 출원" onclick="location.href='./refund_list_overseas.phpcnr">
                        </div>
                        <!-- tab menu -->

                        <div class="font-14 margin-bottom-10">등록일 날짜기간 검색</div>
                        <div class="mb-2 flex">
                            <form method="get" name="form1" id="form1" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline wd-100" onsubmit="return frm_search_chk(this);">

                                <div class="flex margin-right-30 my-2" style="width: 350px">
                                    <input type="text" name="stx_dt1" id="stx_dt1" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $_GET['stx_dt1'] ?>">
                                    <div style="padding: 0px 10px; height: 41px; line-height: 41px; vertical-align: middle;">-</div>
                                    <input type="text" name="stx_dt2" id="stx_dt2" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $_GET['stx_dt2'] ?>">
                                    <input type="button" value="적용" class="btn btn-info margin-left-4" onclick="sch_stx_dt()">
                                    <script>
                                        function sch_stx_dt(){
                                            var stx_dt1 = $("#stx_dt1").val();
                                            var stx_dt2 = $("#stx_dt2").val();

                                            if(stx_dt1=="" && stx_dt2==""){
                                                alert("접수기간을 선택하세요.");
                                                $("#stx_dt1").focus();
                                                return false;
                                            }else{
                                                var qstr = "stx_dt1="+stx_dt1;
                                                qstr += "&stx_dt2="+stx_dt2;

                                                <?
                                                if($_GET['stx']){
                                                ?>
                                                qstr += "&sfl=<?= $_GET['sfl'] ?>";
                                                qstr += "&stx=<?= $_GET['stx'] ?>";
                                                <?
                                                }
                                                ?>

                                                location.href = "?"+qstr;
                                            }
                                        }
                                    </script>
                                </div>

                                <div class="my-2">
                                    <div class="flex" style="width: 345px">

                                        <div class="form-group ml-1">
                                            <input type="text" class="form-control form-control-sm wd-100" style="max-width:160px;" name="stx" id="stx" value="<?=$_GET['stx']?>" placeholder="상품명을 입력바랍니다." required />
                                        </div>

                                        <div class="form-group ml-1 my-2">
                                            <input type="submit" class="btn btn-info" value="검색" />
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-left: auto;">
                                    <input type="button" value="추가" class="btn btn-info" onclick="location.href='./refund_form_overseas.php?w=u'">
                                </div>
                            </form>
                        </div>
                        <script type="text/javascript">
                            function frm_search_chk(f) {
                                if(f.search_txt.value=="") {
                                    alert("검색어를 입력바랍니다.");
                                    f.search_txt.focus();
                                    return false;
                                }

                                return true;
                            }
                        </script>

                        <div class="table-responsive">
                            <form method="post" action="./app_domestic_list_update.php" enctype="multipart/form-data" id="form2">
                                <table class="table border-1-aaa">
                                    <tr class="thead-dark">
                                        <th class="text-center">국내/국제</th>
                                        <th class="text-center">상품명</th>
                                        <th class="text-center">등록일시</th>
                                        <th class="text-center">관리</th>
                                    </tr>
                                    <?
                                    if(count($list)>0){
                                        $a1 = 1;
                                        foreach ($list as $row) {
                                            ?>
                                            <tr>
                                                <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888"><?if($row['cate1']=="international") echo "국제 출원" ?></td>
                                                <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888"><?= $row['strcode'] ?></td>
                                                <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888"><?= $row['d_datetime'] ?></td>
                                                <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888">
                                                    <input type="button" class="btn btn-sm btn-info" value="자세히" onclick="gourl('refund_form_overseas.php?w=&strcode=<?= $row['strcode']?>&idx=<?= $row['idx'] ?>&o_idx=<?=$row['oat_idx'] ?>&<?= $qstr ?><?= $pg ?>')">
                                                    <input type="button" value="삭제" class="btn btn-sm btn-danger" onclick="del_refund(<?= $row['idx']?>,<?= $row['oat_idx']?>)">
                                                </td>
                                            </tr>
                                            <?
                                        }
                                    }else{
                                        ?>
                                        <tr>
                                            <td colspan="4" class="text-center border-1-ccc" style="border-bottom: 1px solid #888">등록된 환불 내역이 없습니다.</td>
                                        </tr>
                                        <?
                                    }
                                    ?>
                                </table>
                            </form>
                            <div class="wrap_pagination">
                                <?
                                if($n_page>0) {
                                    echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$qstr);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function del_refund(idx, o_idx){
            if(confirm("해당콘텐츠를 삭제하시겠습니까?")){
            $.post(
                {url:"./refund_overseas_update.php"},
                {act:"delete",idx:idx,o_idx:o_idx},
                function(data){
                    if(data=='Y'){
                        alert("삭제되었습니다.");
                        location.reload();
                    }
                }
                );
            }
        }
    </script>
<?
include "./foot_inc.php";
?>
<?
include "./head_inc.php";
$chk_menu = '6';
$chk_sub_menu = '2';
include "./head_menu_inc.php";

$n_limit_num = 15;
$n_limit = $n_limit_num;
$pg = $_GET['pg'];

$qstr = "stx=".$_GET['stx'];
$qstr .= "&sfl=".$_GET['sfl'];
$qstr .= "&stx_dt1=".$_GET['stx_dt1'];
$qstr .= "&stx_dt2=".$_GET['stx_dt2'];
$qstr .= "&pg=";

$sql_from = "from order_domestic od left join member_t m on od.mt_idx = m.idx ";
$sql = "select od.*, m.mt_name, m.mt_email {$sql_from} ";
$sql_count = " select count(*) as cnt {$sql_from} ";
$sql_order = "order by od.idx desc ";
$sql_where = "where (1) ";

if($_GET['stx']) {
    $sql_where .= "and instr(".$_GET['sfl'].", '".$_GET['stx']."')";
}
if($_GET['stx_dt1']) {
    $sql_where .= "and left(od.ot_pdate,10) >= '".str_replace(".","-",$_GET['stx_dt1'])."' ";
}
if($_GET['stx_dt2']) {
    $sql_where .= "and left(od.ot_pdate,10) <= '".str_replace(".","-",$_GET['stx_dt2'])."' ";
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
                    <h4 class="card-title">결제 관리</h4>
                    <div class="font-14 margin-bottom-10">결제일 날짜기간 검색</div>
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
                                        <select name="sfl" id="sfl" class="custom-select">
                                            <option value="mt_name">이름</option>
                                            <option value="mt_email">이메일</option>
                                        </select>
                                    </div>

                                    <div class="form-group ml-1">
                                        <input type="text" class="form-control form-control-sm wd-100" style="max-width:160px;" name="stx" id="stx" value="<?=$_GET['stx']?>" placeholder="검색어를 입력바랍니다." required />
                                    </div>

                                    <div class="form-group ml-1 my-2">
                                        <input type="submit" class="btn btn-info" value="검색" />
                                    </div>
                                </div>
                            </div>
                            <!-- <div style="margin-left: auto;"><input type="button" value="선택삭제" class="btn btn-danger" onclick="submit_form2()"></div> -->
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
                                    <th class="text-center">접수번호</th>
                                    <th class="text-center">회원이름</th>
                                    <th class="text-center" rowspan="2">진행단계</th>
                                    <th class="text-center">주문금액</th>
                                    <th class="text-center">할인코드 할인금액</th>
                                    <th class="text-center">총 결제금액</th>
                                    <th class="text-center">결제상태</th>
                                    <th class="text-center" rowspan="2">관리</th>
                                </tr>
                                <tr class="thead-dark">
                                    <th class="text-center">출원번호</th>
                                    <th class="text-center">회원이메일</th>
                                    <th class="text-center">출원인코드 할인금액</th>
                                    <th class="text-center">사용 포인트</th>
                                    <th class="text-center">결제수단</th>
                                    <th class="text-center">결제일시</th>
                                </tr>
                                <?
                                if(count($list)>0){
                                    $a1 = 1;
                                    foreach ($list as $row) {
                                        $sql = "select * from d_app_domestic where idx = '{$row['app_idx']}' ";
                                        $dad = $DB->fetch_assoc($sql);
                                        $sql = "select * from d_app_domestic_item where idx = '{$row['app_item_idx']}' ";
                                        $dadi = $DB->fetch_assoc($sql);
                                        ?>
                                        <tr>
                                            <td class="text-center border-1-ccc">
                                                <?
                                                if($row['app_item_idx']>0){
                                                    echo $dadi['code_register1'];
                                                }else{
                                                    echo $dad['code1'];
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center border-1-ccc"><?= $row['mt_name'] ?></td>
                                            <td class="text-center border-1-ccc" rowspan="2" style="border-bottom: 1px solid #888"><?= $row['odname'] ?></td>
                                            <td class="text-center border-1-ccc"><?= number_format($row['sum_price']) ?></td>
                                            <td class="text-center border-1-ccc"><?= number_format($row['sale_price_salecode']) ?></td>
                                            <td class="text-center border-1-ccc"><?= number_format($row['paid_amount']) ?></td>
                                            <td class="text-center border-1-ccc">
                                                <input type="hidden" name="idx[]" id="idx<?= $a1 ?>" value="<?= $row['idx'] ?>">
                                                <select name="od_status[]" id="od_status<?= $a1 ?>" class="custom-select custom-select-sm sel_od_status" data-idx="<?= $row['idx'] ?>">
                                                    <option value="paid" <? if($row['od_status']=='paid'){echo 'selected';} ?> >결제 완료</option>
                                                    <option value="ready" <? if($row['od_status']=='ready'){echo 'selected';} ?> >결제 대기</option>
                                                    <option value="canceled" <? if($row['od_status']=='canceled'){echo 'canceled';} ?> >환불 요청</option>
                                                </select>
                                            </td>
                                            <td class="text-center border-1-ccc" rowspan="2" style="border-bottom: 1px solid #888">
                                                <input type="button" class="btn btn-sm btn-info" value="자세히" onclick="gourl('order_form.php?idx=<?= $row['idx'] ?>&<?= $qstr ?><?= $pg ?>')">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888"><?= $dadi['code_app'] ?></td>
                                            <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888"><?= $row['mt_email'] ?></td>
                                            <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888"><?= number_format($row['sale_price_mtcode']) ?></td>
                                            <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888"><?= number_format($row['sale_price_point']) ?></td>
                                            <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888"><?= $row['pay_method'] ?></td>
                                            <td class="text-center border-1-ccc" style="border-bottom: 1px solid #888"><?= $row['ot_pdate'] ?></td>
                                        </tr>
                                        <?
                                    }
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
    $(".sel_od_status").on("change",function (){
        const idx = $(this).attr("data-idx");
        const strval = $(this).val();

        $.ajax({
            type: "POST",
            url: "../get_ajax.php",
            data: {
                mode:'chg_od_status_mng',
                idx:idx,
                strval:strval
            },
            cache: false,
            success: function(data){
                //console.log(data);
                location.reload();
            }
        });
    })
</script>
<?
	include "./foot_inc.php";
?>
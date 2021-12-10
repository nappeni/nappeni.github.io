<?php
include "./head_inc.php";
$chk_menu = '3';
include "./head_menu_inc.php";
$n_limit_num = 15;
$n_limit = $n_limit_num;
$pg = $_GET['pg'];


$sql_from = "from d_app_domestic_item dadi left join d_app_domestic dad on dadi.app_idx = dad.idx ";
$sql_order = "order by dadi.idx desc ";
$sql_where = "where dadi.d_status >= 13 ";

$sql = "select dadi.*, dad.cate_mark, dad.name_mark, dad.mt_name {$sql_from} ";
$sql_count = " select count(*) as cnt {$sql_from} ";


if($_GET['stx']) {
    $sql_where .= "and instr(".$_GET['sfl'].", '".$_GET['stx']."')";
}
if($_GET['stx_dt1']) {
    $sql_where .= "and dt_renewal >= '".str_replace("-",".",$_GET['stx_dt1'])."' ";
}
if($_GET['stx_dt2']) {
    $sql_where .= "and dt_renewal <= '".str_replace("-",".",$_GET['stx_dt2'])."' ";
}

$row_cnt = $DB->fetch_assoc($sql_count.$sql_where);
$total_count = $row_cnt['cnt'];
$n_page = ceil($total_count / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;

unset($list);
$sql_query = $sql.$sql_where.$sql_order."limit ".$n_from.", ".$n_limit;
$list = $DB->select_query($sql_query);

$qstr = "sfl=".$_GET['sfl'];
$qstr .= "&stx=".$_GET['stx'];
if($_GET['stx_dt1']){ $qstr .= "&stx_dt1=".$_GET['stx_dt1']; }
if($_GET['stx_dt2']){ $qstr .= "&stx_dt2=".$_GET['stx_dt2']; }
$qstr .= "&pg=";
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">등록료 납부 관리</h4>

                    <div class="font-14 margin-bottom-10">접수일 날짜기간 검색</div>

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
                                            <option value="mt_name" <? if($_GET['sfl']=='mt_name'){echo 'selected';} ?> >이름</option>
                                            <option value="code_register2" <? if($_GET['sfl']=='code_register2'){echo 'selected';} ?> >등록번호</option>
                                            <option value="code_register1" <? if($_GET['sfl']=='code_register1'){echo 'selected';} ?> >접수번호</option>
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
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                <tr>
                                    <!--
                                    <th class="text-center" style="width:50px;">
                                        <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
                                    </th>
                                    -->
                                    <th class="text-center">상표명</th>
                                    <th class="text-center">등록번호</th>
                                    <th class="text-center">접수번호</th>
                                    <th class="text-center">답당자명</th>
                                    <th class="text-center">상품류</th>
                                    <th class="text-center">존속기간</th>
                                    <th class="text-center">갱신일</th>
                                    <th class="text-center">결제금액</th>
                                    <th class="text-center">결제상태</th>
                                    <th class="text-center">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                if($total_count>0){
                                    $rownum = $total_count-($n_limit_num*($pg-1));
                                    foreach ($list as $row) {
                                        $sql = "select ct_catenum, ct_name from cate_ps1 where ct_id = '{$row['cate_ps2']}' ";
                                        $cpi = $DB->fetch_assoc($sql);

                                        $sqlb = "select date_add('{$row['dt_register_complete']}',interval {$row['period']} year) as dt from dual ";
                                        $rowb = $DB->fetch_assoc($sqlb);
                                        $dt_period_result = str_replace("-",".",$rowb['dt']);if($row['dt_renewal']){
                                            $sqlb = "select date_add('{$row['dt_renewal']}',interval {$row['period']} year) as dt from dual ";
                                            $rowb = $DB->fetch_assoc($sqlb);
                                            $dt_period_result = str_replace("-",".",$rowb['dt']);
                                        }else{
                                            $sqlb = "select date_add('{$row['dt_register_complete']}',interval {$row['period']} year) as dt from dual ";
                                            $rowb = $DB->fetch_assoc($sqlb);
                                            $dt_period_result = str_replace("-",".",$rowb['dt']);
                                        }

                                        $sqlc = "select * from order_domestic where app_item_idx = '{$row['idx']}' and (ot_mode = 8 or ot_mode = 9) order by idx desc limit 1 ";
                                        $rowc = $DB->fetch_assoc($sqlc);
                                        ?>
                                        <tr>
                                            <!--
                                            <td class="text-center">
                                                <input type="hidden" name="idx[<?= $row['idx'] ?>]" value="<?= $row['idx'] ?>" id="idx_<?= $row['idx'] ?>">
                                                <input type="checkbox" class="ele_chk" name="chk[]" value="<?= $row['idx'] ?>" id="chk_<?= $row['idx'] ?>">
                                            </td>
                                            -->
                                            <td class="text-center">
                                                <?= $row['name_mark'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $row['code_register2'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $row['code_register1'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $row['mt_name'] ?>
                                            </td>
                                            <td class="text-center">
                                                제<?= $cpi['ct_catenum'] ?>류
                                            </td>
                                            <td class="text-center">
                                                <?= $dt_period_result ?> (<?= $row['period'] ?>년)
                                            </td>
                                            <td class="text-center">
                                                <?= $row['dt_renewal'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= number_format($rowc['sum_price']) ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $rowc['od_status'] ?>
                                            </td>
                                            <td class="text-center">
                                                <input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="gourl('./registered_trademark_form.php?idx=<?= $row['idx'] ?>&<?= $qstr ?><?= $pg ?>')" />
                                                <!-- <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="del_domestic(<?= $row['idx'] ?>)" /> -->
                                            </td>
                                        </tr>
                                        <?
                                        $rownum = $rownum-1;
                                    }
                                }
                                ?>
                                </tbody>
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
<?
include "./foot_inc.php";
?>

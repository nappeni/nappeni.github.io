<?php
include "./head_inc.php";
$chk_menu = '1';
$chk_sub_menu = '1';
include "./head_menu_inc.php";
$n_limit_num = 15;
$n_limit = $n_limit_num;
$pg = $_GET['pg'];

$qstr = "app_status=".$_GET['app_status'];
if($_GET['stx_dt1']){ $qstr .= "&stx_dt1=".$_GET['stx_dt1']; }
if($_GET['stx_dt2']){ $qstr .= "&stx_dt2=".$_GET['stx_dt2']; }
if($_GET['stx']){
    $qstr .= "&sfl=".$_GET['sfl'];
    $qstr .= "&stx=".$_GET['stx'];
}
$qstr .= "&pg=";

$sql = "select * from d_app_domestic ";
$sql_count = " select count(*) as cnt from d_app_domestic ";
$sql_order = "order by d_datetime desc ";
$sql_where = "where app_status > 0 ";

if($_GET['stx']) {
    $sql_where .= "and instr(".$_GET['sfl'].", '".$_GET['stx']."')";
}
if($_GET['stx_dt1']) {
    $sql_where .= "and left(d_datetime,10) >= '".str_replace(".","-",$_GET['stx_dt1'])."' ";
}
if($_GET['stx_dt2']) {
    $sql_where .= "and left(d_datetime,10) <= '".str_replace(".","-",$_GET['stx_dt2'])."' ";
}

if($_GET['app_status']>0){
    $sql_where .= "and app_status = '{$_GET['app_status']}' ";
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
                    <h4 class="card-title">국내 출원 관리</h4>

                        <div class="font-14 margin-bottom-10">접수일 날짜기간 검색</div>

                        <div class="mb-2 flex">
                            <form method="get" name="form1" id="form1" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline wd-100" onsubmit="return frm_search_chk(this);">
                                <div class="form-group margin-right-30 my-2">
                                    <select name="app_status" id="app_status" class="custom-select" onchange="chg_app_status(this.value)">
                                        <option value="">진행현황</option>
                                        <option value="1" <? if($_GET['app_status']==1){echo 'selected';} ?> >접수</option>
                                        <option value="2" <? if($_GET['app_status']==2){echo 'selected';} ?> >접수완료</option>
                                        <option value="3" <? if($_GET['app_status']==3){echo 'selected';} ?> >출원준비-1차 수정요청</option>
                                        <option value="4" <? if($_GET['app_status']==4){echo 'selected';} ?> >출원준비-2차 수정요청</option>
                                        <option value="5" <? if($_GET['app_status']==5){echo 'selected';} ?> >출원준비-3차 수정요청</option>
                                        <option value="8" <? if($_GET['app_status']==8){echo 'selected';} ?> >출원대기</option>
                                        <option value="6" <? if($_GET['app_status']==6){echo 'selected';} ?> >출원완료</option>
                                        <option value="7" <? if($_GET['app_status']==7){echo 'selected';} ?> >출원취소</option>
                                    </select>
                                    <script>
                                        function chg_app_status(num1){
                                            if(Number(num1)>0){
                                                var qstr = "app_status="+num1;

                                                <?
                                                if($_GET['stx_dt1']){
                                                ?>
                                                qstr += "&stx_dt1=<?= $_GET['stx_dt1'] ?>";
                                                <?
                                                }
                                                ?>

                                                <?
                                                if($_GET['stx_dt2']){
                                                ?>
                                                qstr += "&stx_dt2=<?= $_GET['stx_dt2'] ?>";
                                                <?
                                                }
                                                ?>

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
                                            }

                                            var qstr = "app_status=<?= $_GET['app_status'] ?>";
                                            qstr += "&stx_dt1="+stx_dt1;
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
                                    </script>
                                </div>

                                <div class="my-2">
                                    <div class="flex" style="width: 345px">

                                        <div class="form-group ml-1">
                                            <select name="sfl" id="sfl" class="custom-select">
                                                <option value="mt_name">이름</option>
                                                <option value="mt_email">이메일</option>
                                                <option value="code1">접수번호</option>
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
                                    <th class="text-center" style="width:80px;">번호</th>
                                    <th class="text-center">접수일시</th>
                                    <th class="text-center">접수번호</th>
                                    <th class="text-center">답당자명</th>
                                    <th class="text-center">상표명</th>
                                    <th class="text-center">상품류</th>
                                    <th class="text-center">진행상태</th>
                                    <th class="text-center">관리</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?
                                if($total_count>0){
                                    $rownum = $total_count-($n_limit_num*($pg-1));
                                    foreach ($list as $row) {
                                        $sql = "select dadi.cate_ps2, cp1.ct_catenum, cp1.ct_name, count(cp1.ct_id) as cnt from d_app_domestic_item dadi left join cate_ps1 cp1 on dadi.cate_ps2 = cp1.ct_id where dadi.app_idx = '{$row['idx']}' order by cp1.ct_catenum ";
                                        $dadi = $DB->fetch_assoc($sql);
                                        $dadi_cnt = $dadi['cnt']-1;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $rownum ?></td>
                                            <td class="text-center">
                                                <?= str_replace("-",".",$row['d_datetime']) ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $row['code1'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $row['mt_name'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $row['name_mark'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?
                                                $txt_dadi = "제".$dadi['ct_catenum']."류";
                                                if($dadi_cnt>0){ $txt_dadi .= " 그 외 ".$dadi_cnt."개"; }
                                                echo $txt_dadi;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?
                                                if($row['app_status']==1){ echo "접수"; }
                                                else if($row['app_status']==2){ echo "접수완료"; }
                                                else if($row['app_status']==3){ echo "출원준비-1차 수정요청"; }
                                                else if($row['app_status']==4){ echo "출원준비-2차 수정요청"; }
                                                else if($row['app_status']==5){ echo "출원준비-3차 수정요청"; }
                                                else if($row['app_status']==6){ echo "출원완료"; }
                                                else if($row['app_status']==7){ echo "출원취소"; }
                                                else if($row['app_status']==8){ echo "출원대기"; }
                                                else{ echo $row['app_status']; }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="gourl('./app_domestic_form.php?app_idx=<?= $row['idx'] ?>&<?= $qstr ?><?= $pg ?>')" />
                                                <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="del_domestic(<?= $row['idx'] ?>)" />
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

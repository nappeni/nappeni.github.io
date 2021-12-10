<?php
include "./head_inc.php";
$chk_menu='6';
$chk_sub_menu='1';
include "./head_menu_inc.php";
$sql = "select * from d_price_service order by idx desc ";
$list = $DB->select_query($sql);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">서비스 금액 관리</h4>

                    <div class="flex margin-bottom-10 wd-100">
                        <div class="margin-left-auto">
                            <input type="button" class="btn btn-primary" value="저장하기" onclick="submit_form1()">
                        </div>
                    </div>

                    <div class="view-scroll-y" style="height: 550px;">
                        <form method="post" name="form1" id="form1" action="./priceofservice_list_update.php" enctype="multipart/form-data">
                            <!--<div class="font-20 font-weight-700 mb-3">서비스 금액 관리</div>-->
                            <table cellspacing="0" cellpadding="0" class="wd-100 font-14 mb-5">
                                <?
                                foreach ($list as $row) {
                                    ?>
                                    <tr class="show_stat show_stat11">
                                        <th class="jm_th1 wd-15 py-3"><?= $row['txt_cate_view'] ?></th>
                                        <td class="py-3 px-3">
                                            <input type="hidden" name="idx[]" value="<?= $row['idx'] ?>" />
                                            <input type="hidden" name="txt_cate[]" value="<?= $row['txt_cate'] ?>" />
                                            <input type="number" name="price[]" class="form-control form-control-sm" value="<?= $row['price'] ?>" required />
                                        </td>
                                    </tr>
                                    <?
                                }
                                ?>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?
include "./foot_inc.php";
?>

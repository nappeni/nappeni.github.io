<? include_once("./head_inc.php"); 
$sql = "select st_agree1, st_agree2 from setup_t";
$terms = $DB -> fetch_query($sql);
?>
<div class="sub_pg">
    <div class="container-xl">
        <div class="mb_22">
            <h2 class="fs_40 fc_bdk pb_10 fw_700">이용약관 및 개인정보</h2>
            <p class="fs_20 fc_gr222 fw_500">많은 사업자분들이 닥터마크를 이용하고 계십니다.</p>
        </div>
        <h4 class="fs_20 fc_gr222 fw_500">개인정보</h4>
        <div class="border p_30_20 rounded-lg">
            <p class="wh-pre">
                <?= $terms['st_agree2']?>
            </p>
        </div>
        <br>
        <h4 class="fs_20 fc_gr222 fw_500">이용약관</h4>
        <div class="border p_30_20 rounded-lg">
            <p class="wh-pre">
                <?= $terms['st_agree1']?>
            </p>
        </div>

    </div>
</div>


<? include_once("./foot_inc.php"); ?>
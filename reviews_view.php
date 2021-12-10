<? include_once("./head_inc.php"); 
if($_GET['con']){
    $sql = "select * from review_t where idx='".$_GET['con']."'";
    $list = $DB -> select_query($sql);
    foreach($list as $row);
}
?>

<div class="sub_pg pb-0">
    <div class="reviews_view">
        <div class="d-flex align-items-center mb_30">
            <img src="./images/reviews_view_title.png" class="mr-4">
            <h2 class="fs_30 fc_gr222 fw_600"><?= $row['pt_title']?></h2>
        </div>

        <p class="fs_18 fc_gr222 wh_pre"><?= $row['rt_content']?></p>
    </div>

   <!-- <div class="reviews_view_bg">
        <div class="reviews_view">
            <img src="./images/reviews_view_img01.png">
        </div>
    </div> -->

</div>
<? include_once("./foot_inc.php"); ?>
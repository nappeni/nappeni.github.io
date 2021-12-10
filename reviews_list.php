<? include_once("./head_inc.php"); 
$thum_url = "./images/uploads/reviews/";
$n_limit = 12;
$pg = $_GET['pg'];
$_get_txt = "pg=";
?>

<div class="sub_pg">
    <div class="container-xl">
        <div class="mb_22">
            <h2 class="fs_40 fc_bdk pb_10 fw_700">닥터마크 이용후기</h2>
            <p class="fs_20 fc_gr222 fw_500">많은 사업자분들이 닥터마크를 이용하고 계십니다.</p>
        </div>

        <div class="reviews_list d-flex flex-wrap mb_22">
            <!-- 카드 한 세트-->
            <?php 
            $_query = "select idx as rv_idx, pt_title, rt_tag, rt_thum_img, mt_idx from review_t";
            $_query_count = "select count(*) from review_t";

            $row_cnt = $DB->fetch_query($_query_count);
            $couwt_query = $row_cnt[0];
            $counts = $couwt_query;
            $n_page = ceil($couwt_query/$n_limit);
            if($pg=="") $pg =1;
            $n_from = ($pg - 1) * $n_limit;
            $counts = $counts - (($pg -1 ) * $n_limit);

            unset($list);
            $sql_query = $_query." order by idx desc limit ".$n_from.", ".$n_limit;
            $list = $DB->select_query($sql_query);
            if($list){
                foreach($list as $row){?>
            <a href="./reviews_view.php?&con=<?= $row['rv_idx']?>"" class="card">
                <div class="card-img-top">
                    <img src="<?= $thum_url.$row['rt_thum_img']?>" alt="">
                </div>
                <div class="card-body">
                    <ul class="tag mb_10">
                        <?php
                            $tag = explode("/",$row['rt_tag']);
                            for($i=0; $i<count($tag)-1; $i++){
                                echo "<li>#".$tag[$i]."</li>";
                            }
                        ?>
                    </ul>
                    <strong class="fs_26 fw_500 fc_gr222 card_tit"><?= $row['pt_title']?></strong>
                    <div class="order_review mt_20">
                        <div class="d-flex align-items-center">
                            <img src="./images/review.png" alt="" class="mr-2">
                            <p class="fs_14"><?= $row['mt_idx']?>번째 고객님 상표등록 후기</p>
                        </div>
                    </div>
                </div>
            </a>
            <?php }
            }?>
            <!-- 카드 한 세트-->
        </div>
        <!-- reviews_list 끝-->

        <?
            if($n_page>0) {
                echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
            }
        ?>

        <!-- <div class="d-flex justify-content-center">
            <nav aria-label="...">
                <ul class="pagination fs_17 align-items-center">
                    <li class="page-item arrow">
                        <a class="page-link fs_16" href="#" tabindex="-1"><i class="xi xi-angle-left"></i></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item arrow">
                        <a class="page-link fs_16" href="#"><i class="xi xi-angle-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div> -->


    </div>
</div>


<? include_once("./foot_inc.php"); ?>
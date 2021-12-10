<? include_once("./head_inc.php"); 
$sql = "select * from faq_t where ft_best = 'Y'";
$list1 = $DB -> select_query($sql);

$sql = "select idx as cate, fc_name from cate_faq_t order by cate";
$cate_list1 = $DB -> select_query($sql);

$n_limit = $n_limit_num;
$pg = $_GET['pg'];
$get_txt = "search_txt=".$_GET['search_txt']."&category=".$_GET['category']."&pg=";

$where = " where ";
$query = "select *, a1.idx as ft_idx from faq_t a1";
$query_count = "select count(*) from faq_t a1";
if($_GET['search_txt']){
    $search_txt = str_replace("'","\'",$_GET['search_txt']);
    $where_query = $where."instr(a1.ft_title,'".$search_txt."')";
    $where = " and ";
}
if($_GET['category']){
    $where_query = $where."a1.fc_idx = '".$_GET['category']."'";
    $where = " and ";
}
$row_cnt = $DB->fetch_query($query_count.$where_query);
$couwt_query = $row_cnt[0];
$counts = $couwt_query;
$n_page = ceil($couwt_query / $n_limit_num);
if($pg=="") $pg = 1;
$n_from = ($pg - 1) * $n_limit;
$counts = $counts - (($pg - 1) * $n_limit_num);

$sql_query = $query.$where_query." order by ft_idx desc";
$list2 = $DB->select_query($sql_query);
?>

<div class="sub_pg qa">
    <div class="container-xl">
        <div class="w-70 mx-auto">
        <form method = "get"  name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
            <div class="d-block d-md-flex align-items-center mb_30 justify-content-between">
                <h2 class="fs_40 fc_bdk pb_10 fw_700">자주묻는 질문 TOP5</h2>
                <div class="d-flex form_serch">
                    <input id="search_txt" name="search_txt" class="form-control" type="search" value="<?= $_GET['search_txt'] ?>" placeholder="키워드 검색">
                    <button class="btn serch_btn" type="submit" alt="검색"></button>
                </div>
            </div>
            <ul class="qa_list mb_90">
            <?php
                if($list1){
                    foreach($list1 as $list1){
            ?>
                <li>
                    <div class='qa-tit'><?= $list1['ft_title']?><div class='expand'></div>
                    </div>
                    <div class='qa_cont'>
                        <p><?= $list1['ft_content']?></p>
                    </div>
                    </li>
            <?php } 
            }else{?>
                <li><div class="faq">등록된 질문이 없습니다.</div></li>
            <?}?>
            </ul>

            <!-- 키워드-->
            <div class="key-word d-flex">
                <button type="button" class="btn <?echo $_GET['category']==null?"btn-outline-primary":"btn-outline-secondary";?> btn-md" onclick="location.href='./faq.php'">전체</button>
                <?php 
                    foreach($cate_list1 as $cate){
                ?>
                <button type="button" class="btn <?echo $_GET['category']==$cate['cate']?"btn-outline-primary":"btn-outline-secondary";?> btn-md" onclick="location.href='./faq.php?category=<?= $cate['cate']?>'"><?= $cate['fc_name'] ?></button>
                <?php }?>
            </div>
            <!-- 키워드 끝-->


            <!-- 키워드별 질문 시작-->
            <div>
                <ul class="qa_list mb_22">
                    <?php 
                        if($list2){
                            foreach($list2 as $list2){
                    ?>
                    <li>
                        <div class='qa-tit'><?= $list2['ft_title']?><div class='expand'></div>
                        </div>
                        <div class='qa_cont'>
                            <p><?= $list2['ft_content']?></p>
                        </div>
                    </li>
                    <?php } 
                    }else{?>
                    <li><div class="faq">등록된 질문이 없습니다.</div></li>
                    <?php }?>
                </ul>
				<?
                    if($n_page>0) {
                         echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
                         echo "<Br>";
                    }
                ?>
            <form>
            <!-- 키워드별 질문 끝-->
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('.qa-tit').mouseenter(function() {
            $(this).children('.expand').addClass('turn');
        });
        $('.qa-tit').mouseleave(function() {
            if ($(this).hasClass('open')) {} else {
                $(this).children('.expand').removeClass('turn');
            }
        });
        $('.qa-tit').click(function() {
            var $this = $(this);
            if ($this.hasClass('open')) {
                $('.qa-tit').removeClass('open');
                $('.qa_cont').stop(true).slideUp("fast");
                $('.expand').removeClass('turn');
                $this.removeClass('open');
                $this.children('.expand').removeClass('turn');
                $this.next().stop(true).slideUp("fast");
            } else {
                $('.qa-tit').removeClass('open');
                $('.qa_cont').stop(true).slideUp("fast");
                $('.expand').removeClass('turn');

                $this.addClass('open');
                $this.children('.expand').addClass('turn');
                $this.next().stop(true).slideDown("fast");
            }
        });
    });
    function frm_search_chk(f){
            if(f.search_txt == ' '){
                alert("검색어를 입력해주세요");
                return false;
            }
            return true;
        }
    //-----------------질문 창 관련 jquery----------------
</script>

<? include_once("./foot_inc.php"); ?>
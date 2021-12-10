<?
	include "./head_inc.php";
	$chk_menu = '8';
	$chk_sub_menu = '1';
    $rt_img_url = "../images/uploads/reviews";
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "4";
	$_get_txt = "&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">닥터마크 이용후기 목록</h4>
					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
						</div>
					</div>

					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead class="thead-dark">
						<tr>
							<th class="text-center" style="width:30px;">
								번호
							</th>
						    <th class="text-center" style="width:100px;">
                                고객 아이디
							</th>
							<th class="text-center" style="width:150px;">
								제목
							</th>
							<th class="text-center" style="width:300px;">
								이용후기
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$_where = " where ";
							$query = "
                                select ddi.idx, ddi.rv_subject, ddi.rv_content, dd.mt_idx from d_app_domestic_item ddi left join d_app_domestic dd on ddi.app_idx = dd.idx
							";
							$query_count = "
                                select count(*) from d_app_domestic_item ddi left join d_app_domestic dd on ddi.app_idx = dd.idx
							";
                            $where_query = "where not ddi.rv_subject = ' ' and not ddi.rv_content = ' '";
							$row_cnt = $DB->fetch_query($query_count.$where_query);
							$couwt_query = $row_cnt[0];
							$counts = $couwt_query;
							$n_page = ceil($couwt_query / $n_limit_num);
							if($pg=="") $pg = 1;
							$n_from = ($pg - 1) * $n_limit;
							$counts = $counts - (($pg - 1) * $n_limit_num);

							unset($list);
							$sql_query = $query.$where_query." order by ddi.idx desc limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);
							if($list) {
								foreach($list as $row) {
                                    $sql = "select mt_id from member_t where idx='".$row['mt_idx']."'";
                                    $mt = $DB->fetch_query($sql);
						?>
						<tr>
                            <td class="text-center">
                                <?=$counts?>
                            </td>
							<td class="text-center">
                                <?= $mt['mt_id']?>
							</td>
                            <td class="text-center">
								<?=$row['rv_subject']?>
							</td>
							<td class="text-center">
								<?=$row['rv_content']?>
							</td>
						</tr>
						<?
									$counts--;
								}
							} else {
						?>
						<tr>
							<td colspan="<?=$_colspan_txt?>" class="text-center"><b>후기가 없습니다.</b></td>
						</tr>
						<?
							}
						?>
						</tbody>
					</table>
					</div>
					<div class="wrap_pagination">
					<?
                        if($n_page>0) {
                            echo page_listing2($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
                        }
                    ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    //단일 삭제
    function delBanner(url, idx, file){
        var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
        if(result){
            $.post(url, {act: 'delete', idx: idx, rt_thum_img_on: file}, function (data) {
                if(data=='Y') {
                    alert('삭제되었습니다.');
                    location.reload();
                }
            });
        }
    }
    //다중 삭제
    function delBanners(){
        var idxArr = new Array;
        for(var i=1; i<document.getElementsByName('reviewCheck').length; i++){
            if(document.getElementsByName('reviewCheck')[i].checked==true){
                idxArr[i-1] = document.getElementsByName('reviewCheck')[i].value;
            }
        }
        if(idxArr.length!=0){
            var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
            if(result){
                $.post(
                    {url: "./use_review_update.php"},
                    {act: "deleteThows", idx: idxArr},
                    function(data){
                        if(data=='Y'){
                            alert("삭제되었습니다.");
                            location.reload();
                        }
                    }
                );
            }
        }else{
            alert("삭제 할 이용후기를 선택해주세요.");
        }
    }
</script>
<?
	include "./foot_inc.php";
?>
<?
	include "./head_inc.php";
	$chk_menu = '8';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "6";
	$_get_txt = "&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">배너관리</h4>
					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
							<div class="float-right">
								<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" class="form-inline" onsubmit="return frm_search_chk(this);">
									<div class="form-group mx-sm-1">
										<input type="button" class="btn btn-primary" value="추가" onclick="location.href='main_banner_form.php'" />
									</div>
                                    <div class="form-group mx-sm-1">
										<input type="button" class="btn btn-primary" value="삭제" onclick="delBanner('./main_banner_update.php')" />
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
					    <thead class="thead-dark">
						<tr>
                            <th class="text-center" style="width: 30px;">
                                <input class="bannerCheck" name="bannerCheck" type="checkBox" onclick="allCheck()">
                            </th>
                            <script type="text/javascript">
                                function allCheck(){
                                    if(document.getElementsByName('bannerCheck')[0].checked == true){
                                        for(var i=0; i<document.getElementsByName('bannerCheck').length; i++){
                                            document.getElementsByName('bannerCheck')[i].checked = true;
                                        }
                                    }else{
                                        for(var i=0; i<document.getElementsByName('bannerCheck').length; i++){
                                            document.getElementsByName('bannerCheck')[i].checked = false;
                                        }
                                    }
                                }
                            </script>
							<th class="text-center" style="width:300px;">
								이미지
							</th>
							<th class="text-center" style="width:50px;">
								노출 상태
							</th>
							<th class="text-center" style="width:50px;">
								출력순서
							</th>
							<th class="text-center" style="width:100px;">
								등록날짜
							</th>
							<th class="text-center" style="width:120px;">
								관리
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$_where = " where ";
							$query = "
								select *, a1.idx as bt_idx from banner_t a1 where bt_type = 1
							";
							$query_count = "
								select count(*) from banner_t a1 where bt_type = 1
							";

							if($_GET['search_txt']) {
								if($_GET['sel_search']=="all") {
									$where_query .= $_where."(instr(a1.bt_title, '".$_GET['search_txt']."'))";
								} else {
									$where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
								}
								$_where = " and ";
							}

							$row_cnt = $DB->fetch_query($query_count.$where_query);
							$couwt_query = $row_cnt[0];
							$counts = $couwt_query;
							$n_page = ceil($couwt_query / $n_limit_num);
							if($pg=="") $pg = 1;
							$n_from = ($pg - 1) * $n_limit;
							$counts = $counts - (($pg - 1) * $n_limit_num);

							unset($list);
							$sql_query = $query.$where_query." order by a1.idx desc limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);

							if($list) {
								foreach($list as $row) {
						?>
						<tr>
                            <td class="text-center">
                                    <input class="bannerCheck" value="<?=$row['bt_idx']?>" name="bannerCheck" type="checkBox">
                            </td>
							<td class="text-center">
                                <img class="banner-img" style="border-radius: 0%; width:300px; height: 80px; object-fit:contain;" src="<?= $ct_img_url.'/'.$row['bt_file1']?>"/>
							</td>
							<td class="text-center">
								<?=$row['bt_show']?>
							</td>
							<td class="text-center">
								<?=$row['bt_rank']?>
							</td>
							<td class="text-center">
								<?=DateType($row['bt_wdate'], 1)?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="location.href='./main_banner_form.php?act=update&bt_idx=<?=$row['bt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" /> <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="f_post_del('./main_banner_update.php', '<?=$row['bt_idx']?>');" />
							</td>
						</tr>
						<?
									$counts--;
								}
							} else {
						?>
						<tr>
							<td colspan="<?=$_colspan_txt?>" class="text-center"><b>자료가 없습니다.</b></td>
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
<script>
    function delBanner(url){
        var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
        if(result){
        var indexArr = new Array;
        for(var i=1; i<document.getElementsByName('bannerCheck').length; i++){
            if(document.getElementsByName('bannerCheck')[i].checked==true){
                 indexArr[i-1] = document.getElementsByName('bannerCheck')[i].value;
            }
        }
        if(indexArr.length!=0){
            $.post(url, {act: 'delete_those', idx: indexArr}, function (data) {
                if(data=='Y') {
                    alert("삭제에 되었습니다.");
                    location.href="../mng/main_banner.php";
                }
            });
        }else{
            alert("삭제할 배너를 선택해주세요.");
        }
        }
    }
</script>
<?
	include "./foot_inc.php";
?>
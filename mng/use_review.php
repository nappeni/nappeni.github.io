<?
	include "./head_inc.php";
	$chk_menu = '8';
	$chk_sub_menu = '3';
    $rt_img_url = "../images/uploads/reviews";
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
					<h4 class="card-title">이용후기 관리</h4>
					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
							<div class="float-right">
								<div class="form-group mx-sm-1" style="display: inline-block;">
									<input type="submit" class="btn btn-info" value="추가" onclick="location.href='use_review_form.php'" />
								</div>
								<div class="form-group mx-sm-1" style="display: inline-block;">
									<input type="button" class="btn btn-secondary" value="삭제" onclick="delBanners()" />
								</div>

							</div>
						</div>
					</div>

					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead class="thead-dark">
						<tr>
                            <th class="text-center" style="width:30px;">
                                <input class="reviewCheck" name="reviewCheck" type="checkBox" onclick="allCheck()">
							</th>
                            <script type="text/javascript">
                                function allCheck(){
                                    var check = document.getElementsByName('reviewCheck');
                                    if(document.getElementsByName('reviewCheck')[0].checked == true){
                                        for(var i=0; i<document.getElementsByName('reviewCheck').length; i++){
                                            document.getElementsByName('reviewCheck')[i].checked = true;
                                        }
                                    }else{
                                        for(var i=0; i<document.getElementsByName('reviewCheck').length; i++){
                                            document.getElementsByName('reviewCheck')[i].checked = false;
                                        }
                                    }
                                }
                            </script>
							<th class="text-center" style="width:30px;">
								번호
							</th>
						    <th class="text-center" style="width:30px;">
                                고객 순번
							</th>
							<th class="text-center" style="width:150px;">
								제목
							</th>
							<th class="text-center" style="width:300px;">
								섬네일
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
								select *, a1.idx as rt_idx from review_t a1
							";
							$query_count = "
								select count(*) from review_t a1
							";

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
                                <input class="reviewCheck" name="reviewCheck" type="checkBox" value="<?= $row['rt_idx']?>">
                            </td>
							<td class="text-center">
								<?=$counts?>
							</td>
                            <td class="text-center">
								<?=$row['mt_idx']?>
							</td>
							<td class="text-center">
								<?=$row['pt_title']?>
							</td>
                            <td class="text-center">
                                <img class="banner-img" style="border-radius: 0%; width:230px; height: 80px; object-fit: contain;" src="<?=$rt_img_url."/".$row['rt_thum_img']?>"/>
							</td>
							<td class="text-center">
                                <input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="location.href='./use_review_form.php?act=update&rt_idx=<?=$row['rt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" />
                                <input type="button" class="btn btn-outline-danger btn-sm" value="삭제" onclick="delBanner('./use_review_update.php',<?=$row['rt_idx']?>,'<?=$row['rt_thum_img']?>')" />
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
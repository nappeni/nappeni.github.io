<?
	include "./head_inc.php";
	$chk_menu = '4';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "8";
	$_get_txt = "sel_search=".$_GET['sel_search']."&search_txt=".$_GET['search_txt']."&pg=";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">회원 포인트 내역</h4>
                    <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
					    <div class="row no-gutters mb-2">
						    <div class="col-xl-3"></div>
						    <div class="col-xl-9">
                                <div class="float-right">
                                    <input type="text" name="stx_dt1" id="stx_dt1" class="form-control form-control-sm wd-100 datepicker" autocomplete="off" style="max-width: 120px; display: inline-block;" value="<?= $_GET['stx_dt1'] ?>">     
                                    <div style="padding: 0px 10px; height: 41px; line-height: 41px; vertical-align: middle; display: inline-block;">-</div>
                                    <input type="text" name="stx_dt2" id="stx_dt2" class="form-control form-control-sm wd-100 datepicker" autocomplete="off" style="max-width: 120px; display: inline-block;" value="<?= $_GET['stx_dt2'] ?>">
                                    <input type="button" value="적용" class="btn btn-info margin-left-4" style="margin-right: 5px; display: inline-block; height: 41px;"  onclick="frm_data_search()">
                                    <input name="dt1" id="dt1" type="hidden" value="<?= $_GET['dt1']?>">
                                    <input name="dt2" id="dt2" type="hidden" value="<?= $_GET['dt2']?>">
                                    <script type="text/javascript">
                                        function frm_data_search(){
                                            if($('#stx_dt1').val()==''||$('#stx_dt2').val()==''){
                                                alert("날짜를 입력해주세요");
                                            }else if($('#stx_dt1').val()>$('#stx_dt2').val()){
                                                alert("입력하신 날을 확인해주세요");
                                            }else{
                                                $('#dt1').val($('#stx_dt1').val());
                                                $('#dt2').val($('#stx_dt2').val());
                                                document.getElementById("frm_search").submit();
                                            }
                                        }
                                    </script>
                                    <select name="sel_search" id="sel_search"class="form-control form-control-sm" style="display: inline-block; width: 100px; margin-right : 4px;">
                                        <option value="a2.mt_id">아이디</option>
                                        <option value="a1.code1">접수번호</option>
                                        <option value="a1.pt_content">내용</option>
                                        <option value="a1.pt_type">상태값</option>
                                    </select>
                                    <input type="text" class="form-control form-control-sm" style="width:200px; display: inline-block; margin-right : 4px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" placeholder="검색어를 입력바랍니다." />
                                    <input type="image" class="btn btn-info" style="background-color: white; padding: 8px; display: inline-block; height: 41px;" src="../images/search.png"/>
                                    <script type="text/javascript">
                                        function frm_search_chk(f) {
                                            if(f.search_txt.value=="") {
                                                alert("검색어를 입력바랍니다.");
                                                f.search_txt.focus();
                                                return false;
                                            }

                                            return true;
                                        }

                                        <? if($_GET['sel_search']) { ?>$('#sel_search').val('<?=$_GET['sel_search']?>');<? } ?>
                                    </script>
                                </div>
						    </div>
                        </div>
                    </form>

					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead class="thead-dark">
						<tr>
							<th class="text-center" style="width:80px;">
								번호
							</th>
							<th class="text-center" style="width:100px;">
								날짜
							</th>
							<th class="text-center" style="width:150px;">
								아이디
							</th>
							<th class="text-center" style="width:150px;">
								접수 번호
							</th>
                            <th class="text-center" style="width:150px;">
								내용
							</th>
                            <th class="text-center" style="width:80px;">
                                상태값
							</th>
							<th class="text-center" style="width:100px;">
								사용/적립 포인트(p)
							</th>
                            <th class="text-center" style="width:100px;">
                                차감 후 결제 금액
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$_where = " where ";
							$query = " 
								SELECT a1.* ,a1.idx as mt_idx, a2.mt_id from point_t a1 JOIN member_t a2 ON a1.mt_idx = a2.idx
							";
							$query_count = "
								SELECT COUNT(*) from point_t a1 JOIN member_t a2 ON a1.mt_idx = a2.idx
							";
                            
							if(strpos($_GET['search_txt'],"적립")!==false){
								$where_query .= $_where."instr(".$_GET['sel_search'].", 'P')";
								$_where = " and ";
							}else if(strpos($_GET['search_txt'],"차감")!==false){
								$where_query .= $_where."instr(".$_GET['sel_search'].", 'M')";
								$_where = " and ";
							}else if($_GET['search_txt']) {
								$where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
								$_where = " and ";
							}
                            if($_GET['dt1']&&$_GET['dt2']){
                                $where_query .= $_where."mt_wdate BETWEEN'".$_GET['dt1']."' AND '".$_GET['dt2']."'";
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
								<?=$counts?>
							</td>
							<td class="text-center">
								<?=DateType($row['pt_wdate'], 0)?>
							</td>
							<td class="text-center">
								<?=$row['mt_id']?>
							</td>
							<td class="text-center">
								<?php 
									if($row['code1']!=''){
										echo $row['code1'];
									}else{
										echo "-";
									}
								?>
							</td>
                            <td class="text-center">
								<?= $row['pt_content']?>
							</td>
                            <td class="text-center">
                                <?php
                                    switch($row['pt_type']){
										case 'P':
											echo "적립";
											break;
										case 'M':
											echo "차감";
											break;
                                    }  
                                ?>
							</td>
							<td class="text-center">
								<?php
									if($row['pt_type']=="P"){
										echo "+".$row['pt_point'];
									}else{
										echo "-".$row['pt_point'];
									}
								?>
							</td>
							<td class="text-center">
								<?php 
									if($row['re_amount']!=''){
										echo $row['re_amount'];
									}else{
										echo "-";
									}
								?>
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
    function post_del(url, idx){
        var confirmflag = confirm("해당 회원을 탈퇴시키겠습니까?");
        if(confirmflag){
            $.post(url, {act:'delete',mt_idx:idx}, function(data){
               if(data=="Y"){
                alert("탈퇴되었습니다.");
                location.reload();
               }
            });
        }
    }
</script>
<?
	include "./foot_inc.php";
?>
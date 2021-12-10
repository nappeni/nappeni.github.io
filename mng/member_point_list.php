<?
	include "./head_inc.php";
	$chk_menu = '4';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";

	$n_limit = $n_limit_num;
	$pg = $_GET['pg'];
	$_colspan_txt = "10";
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
						    <div class="col-xl-3">
                                <input type="text" name="stx_dt1" id="stx_dt1" class="form-control form-control-sm wd-100 datepicker" autocomplete="off" style="max-width: 120px; display: inline-block;" value="<?= $_GET['stx_dt1'] ?>">     
                                <div style="padding: 0px 10px; height: 41px; line-height: 41px; vertical-align: middle; display: inline-block;">-</div>
                                <input type="text" name="stx_dt2" id="stx_dt2" class="form-control form-control-sm wd-100 datepicker" autocomplete="off" style="max-width: 120px; display: inline-block;" value="<?= $_GET['stx_dt2'] ?>">
                                <input type="button" value="적용" class="btn btn-info margin-left-4" style="margin-right: 5px; display: inline-block;"  onclick="frm_data_search()">
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
                            </div>
						    <div class="col-xl-9">
                                <div class="float-right">
                                    <select name="sel_search" id="sel_search" class="form-control form-control-sm" style="display: inline-block; width: 100px;">
                                        <option value="a1.mt_name">이름</option>
                                        <option value="a1.mt_id">아이디</option>
                                        <option value="a1.mt_hp">휴대폰 번호</option>
                                    </select>
                                    <input type="text" class="form-control form-control-sm" style="width:200px; display: inline-block;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" placeholder="검색어를 입력바랍니다." />
                                    <input type="image" class="btn btn-info" style="background-color: white; padding: 8px; display: inline-block;" src="../images/search.png"/>
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
                            <th class="text-center" style="width: 30px;">
                                <input class="bannerCheck" name="bannerCheck" type="checkBox" onclick="allCheck()">
                            </th>
                            <script>
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
							<th class="text-center" style="width:80px;">
								번호
							</th>
							<th class="text-center" style="width:80px;">
								날짜
							</th>
							<th class="text-center" style="width:400px;">
								아이디
							</th>
							<th class="text-center" style="width:140px;">
								접수 번호
							</th>
                            <th class="text-center" style="width:140px;">
								가입 날짜
							</th>
                            <th class="text-center" style="width:80px;">
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
								select *, a1.idx as mt_idx from member_t a1
							";
							$query_count = "
								select count(*) from member_t a1
							";
                            
							if($_GET['search_txt']) {
								$where_query .= $_where."instr(".$_GET['sel_search'].", '".$_GET['search_txt']."')";
								$_where = " and ";
							}
                            if($_GET['set']!="all"&& $_GET['set']!= null){
                                $where_query .= $_where."mt_level=".$_GET['set'];
                                $_where = " and ";
                            }
                            if($_GET['dt1']&&$_GET['dt2']){
                                $where_query .= $_where."mt_wdate BETWEEN'".$_GET['dt1']."' AND '".$_GET['dt2']."'";
                                $_where = " and ";
                            }
                            $where_query .= $_where."not mt_level=9";
                             
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
                                <input class="bannerCheck" value="<?=$row['mt_idx']?>" name="bannerCheck" type="checkBox">
                            </td>
							<td class="text-center">
								<?=$counts?>
							</td>
							<td>
                                <?=$row['mt_name']?>
							</td>
							<td class="text-center">
								<?=$row['mt_id']?>
							</td>
							<td class="text-center">
								<?=$row['mt_hp']?>
							</td>
							<td class="text-center">
								<?=DateType($row['mt_wdate'], 6)?>
							</td>
                            <td class="text-center">
								<?php 
                                    switch($row['mt_social']){
                                        case 'P':
                                            echo "일반";
                                            break;
                                        case 'K':
                                            echo "카카오";
                                            break;
                                        case 'N':
                                            echo "네이버";
                                            break;
                                    }
                                ?>
							</td>
                            <td class="text-center">
                                <?php
                                    switch($row['mt_level']){
                                        case 1:
                                            echo "<label class='box box_secession'>● 탈퇴</label>";
                                            break;
                                        case 2:
                                            echo "<label class='box box_nomal'>● 일반</label>";
                                            break;
                                        case 3:
                                            echo "<label class='box box_sleep'>● 휴먼</label>";
                                            break;
                                    }  
                                ?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="수정" onclick="location.href='./member_mng_from.php?act=update&mt_idx=<?=$row['mt_idx']?>&<?=$_get_txt.$_GET['pg']?>'" /> 
                                <input type="button" class="btn btn-outline-danger btn-sm" value="탈퇴" onclick="post_del('./member_mng_update.php', '<?=$row['mt_idx']?>');" <?php if($row['mt_level']==1) echo "disabled";?>/>
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
					<?
						if($n_page>1) {
							echo page_listing($pg, $n_page, $_SERVER['PHP_SELF']."?".$_get_txt);
						}
					?>
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
<?
	include "./head_inc.php";
	$chk_menu = '2';
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
					<h4 class="card-title">국제 출원 관리</h4>
                    <form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
					    <div class="row no-gutters mb-2">
						    <div class="col-xl-9">
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
                                <select name="sel_search" id="sel_search" class="form-control form-control-sm" style="display: inline-block; width: 100px; margin-right: 4px;">
                                    <option value="mt.mt_name">이름</option>
                                    <option value="mt.mt_id">아이디</option>
                                    <option value="od.m_name">담당자명</option>
                                    <option value="od.p_name">상표명</option>
                                </select>
                                <input type="text" class="form-control form-control-sm" style="width:200px; display: inline-block; margin-right: 4px;" name="search_txt" id="search_txt" value="<?=$_GET['search_txt']?>" placeholder="검색어를 입력바랍니다." />
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
                            <br><br>
						    <div class="col-xl-3">
                                <div class="float-right">
                                    <div class="form-group mx-sm-1">
										<input type="button" class="btn btn-primary" value="삭제" onclick="deletModals()" />
									</div>
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
							<th class="text-center" style="width:80px;">
								이름
							</th>
							<th class="text-center" style="width:100px;">
								아이디
							</th>
							<th class="text-center" style="width:150px;">
                                담당자 명
							</th>
							<th class="text-center" style="width:150px;">
								상표명
							</th>
                            <th class="text-center" style="width:150px;">
								출원 국가
							</th>
                            <th class="text-center" style="width:120px;">
                                접수 날짜
							</th>
							<th class="text-center" style="width:100px;">
								관리
							</th>
						</tr>
						</thead>
						<tbody>
						<?
							$_where = " where ";
							$query = " 
								select od.idx as od_idx, mt.mt_name, mt.mt_id, od.m_name, od.p_name, od.o_nations, od.o_datetime from o_app_domestic od join member_t mt on od.mt_idx = mt.idx
							";
							$query_count = "
                                select count(*) from o_app_domestic od join member_t mt on od.mt_idx = mt.idx
							";
                            
                            if($_GET['search_txt']){
                                $search_txt = str_replace("'","\'",$_GET['search_txt']);
                                $where_query .= $_where."instr(".$_GET['sel_search'].", '".$search_txt."')";
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
							$sql_query = $query.$where_query." order by od.idx desc limit ".$n_from.", ".$n_limit;
							$list = $DB->select_query($sql_query);
							if($list) {
							foreach($list as $row) {
						?>
						<tr>
							<td class="text-center">
                                <input class="bannerCheck" value="<?=$row['od_idx']?>" name="bannerCheck" type="checkBox">
							</td>
							<td class="text-center">
								<?= $row['mt_name']?>
							</td>
							<td class="text-center">
								<?= $row['mt_id']?>
							</td>
							<td class="text-center">
								<?= $row['m_name']?>
							</td>
                            <td class="text-center">
								<?= $row['p_name']?>
							</td>
                            <td class="text-center">
                                <?php
                                    $nations = explode("/",$row['o_nations']);
                                    $sql = "select nt_name from nation_t where idx='".$nations[0]."'";
                                    $n_name = $DB->fetch_query($sql);
                                    $n_count = count($nations)-2;
                                    $n_txt = $n_name['nt_name'];
                                    if($n_count>0){
                                        $n_txt .= " 외 ".$n_count."개";
                                    }
                                    echo $n_txt;
                                ?>
							</td>
							<td class="text-center">
								<?= DateType($row['o_datetime'],0)?>
							</td>
							<td class="text-center">
								<input type="button" class="btn btn-outline-primary btn-sm" value="상세보기"  onclick="location.href='./app_overseas_form.php?act=update&od_idx=<?=$row['od_idx']?>&<?=$_get_txt.$_GET['pg']?>'"/> 
                                <input type="button" class="btn btn-outline-danger btn-sm" value=" 삭제 " onclick="ondelete(<?= $row['od_idx']?>)"/>
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
    function ondelete(idx){
        var confirmflag = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
        if(confirmflag){
            $.post(
            {url: "./app_overseas_update.php"}, 
            {act:'delete',idx: idx}, function(data){
               if(data=="Y"){
                alert("삭제되었습니다.");
                location.reload();
               }
            });
        }
    }
    function deletModals(){
        var indexArr = new Array;
        for(var i=1; i<document.getElementsByName('bannerCheck').length; i++){
            if(document.getElementsByName('bannerCheck')[i].checked==true){
                 indexArr[i-1] = document.getElementsByName('bannerCheck')[i].value;
            }
        }
        if(indexArr.length==0){
            alert("삭제 할 배너를 선택해주세요.");
        }else{
            var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
            if(result==true){
                $.post(
                {url: "./app_overseas_update.php"},
                {
                    act: "deleteThows",
                    idx: indexArr
                },
                function (data){
                    if(data=='Y'){
                        alert("삭제되었습니다.");
                        location.reload();
                    }
                }
                );
            }
        }
    }
</script>
<?
	include "./foot_inc.php";
?>
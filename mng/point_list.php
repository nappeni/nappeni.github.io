<?
	include "./head_inc.php";
	$chk_menu = "2";
	$chk_sub_menu = "1";
	include "./head_menu_inc.php";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">적립관리</h4>
					<p class="card-description">
						적립내역을 확인 할 수 있습니다.
					</p>

					<div class="row">
						<div class="col-sm-12">
							<div class="row justify-content-end">
                                <div class="form-inline mb-3">
                                    <input type="text" name="met_sdate" id="met_sdate" value="<?=$_GET['met_sdate']?>" class="form-control form-control-sm" placeholder="시작일자" />
                                    <input type="text" name="met_edate" id="met_edate" value="<?=$_GET['met_edate']?>" class="form-control form-control-sm ml-2" placeholder="마감일자" />
                                    <input type="button" class="btn btn-secondary btn-sm ml-2" value="기간검색" onclick="f_serach_date()" />
                                </div>
							</div>
							<script type="text/javascript">
							<!--
								(function($) {
									'use strict';
									$(function() {
										jQuery.datetimepicker.setLocale('ko');

										jQuery(function () {
											jQuery('#met_sdate').datetimepicker({
												format: 'Y-m-d',
												onShow: function (ct) {
													this.setOptions({
														maxDate: jQuery('#met_edate').val() ? jQuery('#met_edate').val() : false
													})
												},
												timepicker: false
											});
											jQuery('#met_edate').datetimepicker({
												format: 'Y-m-d',
												onShow: function (ct) {
													this.setOptions({
														minDate: jQuery('#met_sdate').val() ? jQuery('#met_sdate').val() : false
													})
												},
												timepicker: false
											});
										});
									});
								})(jQuery);

								function f_serach_date() {
									var met_sdate = $('#met_sdate').val();
									var met_edate = $('#met_edate').val();

									if(met_sdate=="") {
										alert("시작일자를 입력바랍니다.");
										$('#met_sdate').focus();
										return false;
									}
									if(met_edate=="") {
										alert("마감일자를 입력바랍니다.");
										$('#met_edate').focus();
										return false;
									}

									document.location.href = "./point_list.php?met_sdate="+met_sdate+"&met_edate="+met_edate;

									return true;
								}
							//-->
							</script>

							<table id="point_on_list" class="table">
								<thead>
									<tr>
										<th>성명</th>
										<th>주민번호</th>
										<th>연락처</th>
										<th>결제금액</th>

										<th>포인트내역</th>
										<th>적립금</th>
										<th style="width:120px;">일시</th>
									</tr>
								</thead>
								<tbody>
									<?
										unset($list_p);
										$query_p = "
											select * from point_t a1
											left outer join member_t a2 on a1.mt_idx = a2.idx
										";
										if($_GET['met_sdate'] && $_GET['met_sdate']) {
											$query_p .= " where a1.pt_wdate between '".$_GET['met_sdate']." 00:00:00' and '".$_GET['met_edate']." 23:59:59'";
										}
										$query_p .= " order by a1.pt_wdate desc";
										$list_p = $DB->select_query($query_p);

										$sum_pt_pay_price = 0;
										$sum_pt_point_num = 0;

										if($list_p) {
											foreach($list_p as $row_p) {
												if($row_p['pt_pay_type']=='M' || $row_p['pt_point_type']=='M') {
													$tr_class = " class='table-danger'";
													$row_p['pt_pay_price'] = '-'.$row_p['pt_pay_price'];
													$row_p['pt_point_num'] = '-'.$row_p['pt_point_num'];
												} else {
													$tr_class = " class='table-primary'";
												}

												if($row_p['pt_pay_type']=='M') {
													$td_class1 = " class='text-danger'";
												} else {
													$td_class1 = " class='text-primary'";
												}

												if($row_p['pt_point_type']=='M') {
													$td_class2 = " class='text-danger'";
												} else {
													$td_class2 = " class='text-primary'";
												}
									?>
									<tr<?=$tr_class?>>
										<td><?=$row_p['mt_name']?></td>
										<td><?=$row_p['mt_jumin']?></td>
										<td><?=$row_p['mt_hp']?></td>
										<td<?=$td_class1?>><?=number_format($row_p['pt_pay_price'])?></td>

										<td><?=$row_p['pt_point_type_info']?></td>
										<td<?=$td_class2?>><?=number_format($row_p['pt_point_num'])?></td>
										<td><?=DateType($row_p['pt_wdate'], 6)?></td>
									</tr>
									<?
												$sum_pt_pay_price += $row_p['pt_pay_price'];
												$sum_pt_point_num += $row_p['pt_point_num'];
											}
										}
									?>
								</tbody>
								<tfoot>
									<tr class="table-dark">
										<th></th>
										<th></th>
										<th></th>
										<th><?=number_format($sum_pt_pay_price)?></th>
										<th></th>
										<th><?=number_format($sum_pt_point_num)?></th>
										<th style="width:120px;"></th>
									</tr>
								</tfoot>
							</table>
							<script type="text/javascript">
							<!--
								(function($) {
									'use strict';
									$(function() {
										$('#point_on_list').DataTable({
											"dom": 'Bfrtip',
											"order": [[ 3, "desc" ]],
											"iDisplayLength": 10,
											"language": {
												"url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Korean.json"
											},
											"columnDefs": [
												{ "orderable": false, "targets": 4 }
											],
											"footerCallback": function ( row, data, start, end, display ) {
												var api = this.api(), data;

												console.log(api.search());
												if(api.search()) {
													var intVal = function ( i ) {
														return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
													};

													var total1 = api.column( 3, { page: 'current'} ).data().reduce( function (a, b) {
														return intVal(a) + intVal(b);
													}, 0 );

													$( api.column( 3 ).footer() ).html(comma_num(total1));

													var total3 = api.column( 5, { page: 'current'} ).data().reduce( function (a, b) {
														return intVal(a) + intVal(b);
													}, 0 );

													$( api.column( 5 ).footer() ).html(comma_num(total3));
												}
											},
											"buttons": [ {
												extend: 'excelHtml5',
												autoFilter: true,
												text: '엑셀',
												className: 'btn btn-success'
											} ]
										});
									});
								})(jQuery);
							//-->
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
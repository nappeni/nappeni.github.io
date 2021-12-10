<?
	include "./head_inc.php";
	$chk_menu = '11';
	$chk_sub_menu = '1';
	include "./head_menu_inc.php";

	if($_GET['sel_search_sdate']=="") {
		$_GET['sel_search_sdate'] = date('Y-m-d', strtotime("-6 days"));
	}
	if($_GET['sel_search_edate']=="") {
		$_GET['sel_search_edate'] = date('Y-m-d');
	}

	$arr_charts = array(
		'1' => array('방문자수', 'bar'),
		'2' => array('회원가입', 'bar'),
		'3' => array('상품등록', 'bar'),
		'4' => array('매출', 'line'),
		'5' => array('주문량', 'line'),
	);
?>
<div class="content-wrapper">
	<form method="get" name="frm_search" id="frm_search" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return frm_search_chk(this);">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body row align-items-center">
					<label for="sel_search_sdate" class="col-sm-1 col-form-label">검색기간</label>
					<div class="col-sm-5">
						<div class="btn-group" role="group" aria-label="select_category">
							<button type="button" onclick="f_order_search_date_range('3', '<?=date('Y-m-d', strtotime("-6 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range3" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range btn-info text-white">7일</button>
							<button type="button" onclick="f_order_search_date_range('4', '<?=date('Y-m-d', strtotime("-14 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range4" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">15일</button>
							<button type="button" onclick="f_order_search_date_range('5', '<?=date('Y-m-d', strtotime("-29 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range5" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">30일</button>
							<button type="button" onclick="f_order_search_date_range('6', '<?=date('Y-m-d', strtotime("-59 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range6" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">60일</button>
							<button type="button" onclick="f_order_search_date_range('7', '<?=date('Y-m-d', strtotime("-89 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range7" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">90일</button>
							<button type="button" onclick="f_order_search_date_range('8', '<?=date('Y-m-d', strtotime("-119 days"))?>', '<?=date('Y-m-d')?>');" id="f_order_search_date_range8" class="btn btn-outline-secondary btn-sm c_pt_selling_date_range">120일</button>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="input-group">
							<input type="text" name="sel_search_sdate" id="sel_search_sdate" value="<?=$_GET['sel_search_sdate']?>" class="form-control" readonly /> <span class="m-2">~</span> <input type="text" name="sel_search_edate" id="sel_search_edate" value="<?=$_GET['sel_search_edate']?>" class="form-control" readonly />
						</div>
					</div>
					<div class="col-sm-2">
						<div class="input-group">
							<input type="button" class="btn btn-primary" value="검색" onclick="chart_rendering();" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
	<script type="text/javascript">
	<!--
		(function($) {
			'use strict';
			$(function() {
				jQuery.datetimepicker.setLocale('ko');

				jQuery(function () {
					jQuery('#sel_search_sdate').datetimepicker({
						format: 'Y-m-d',
						onShow: function (ct) {
							this.setOptions({
								maxDate: jQuery('#sel_search_edate').val() ? jQuery('#sel_search_edate').val() : false
							})
						},
						timepicker: false
					});
					jQuery('#sel_search_edate').datetimepicker({
						format: 'Y-m-d',
						onShow: function (ct) {
							this.setOptions({
								minDate: jQuery('#sel_search_sdate').val() ? jQuery('#sel_search_sdate').val() : false
							})
						},
						timepicker: false
					});
				});

				chart_rendering();
			});
		})(jQuery);

		function chart_rendering() {
			var sel_search_sdate = $('#sel_search_sdate').val();
			var sel_search_edate = $('#sel_search_edate').val();

			<? foreach($arr_charts as $key => $val) { ?>
			$.post('./statistics_update.php', {act: 'statistics_chart<?=$key?>', sel_search_sdate: sel_search_sdate, sel_search_edate: sel_search_edate}, function (data) {
				var json_data = JSON.parse(data);

				if(json_data) {
					var ctx<?=$key?> = document.getElementById('statistics_chart<?=$key?>').getContext('2d');
					var statistics_chart<?=$key?> = new Chart(ctx<?=$key?>, {
						type: '<?=$val[1]?>',
						data: {
							labels: json_data.date_t,
							datasets: [{
								label: '<?=$val[0]?>',
								data: json_data.cnt,
								borderWidth: 1
							}]
						},
						options: {
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero: true
									}
								}]
							}
						}
					});
				} else {
					alert('잘못된 접근입니다.');
				}
			});
			<? } ?>

			return false;
		}

		function frm_search_chk(f) {
			/*
			if(f.search_txt.value=="") {
				alert("검색어를 입력바랍니다.");
				f.search_txt.focus();
				return false;
			}
			*/

			return true;
		}
	//-->
	</script>

	<div class="row">
		<div class="col-lg-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">방문자</h4>
					<canvas id="statistics_chart1"></canvas>
				</div>
			</div>
		</div>
		<div class="col-lg-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">회원</h4>
					<canvas id="statistics_chart2"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">상품</h4>
					<canvas id="statistics_chart3"></canvas>
				</div>
			</div>
		</div>
		<div class="col-lg-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">매출</h4>
					<canvas id="statistics_chart4"></canvas>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">주문</h4>
					<canvas id="statistics_chart5"></canvas>
				</div>
			</div>
		</div>
		<div class="col-lg-6 grid-margin stretch-card">

		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
<?
	include "./head_inc.php";
	$chk_menu = '12';
	$chk_sub_menu = '2';
	include "./head_menu_inc.php";
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">카테고리 설정</h4>

					<div class="row no-gutters mb-2">
						<div class="col-xl-3"></div>
						<div class="col-xl-9">
							<div class="float-right">
								<div class="btn-group mx-sm-1">
									<input type="button" class="btn btn-secondary" value="초기화" onclick="location.href='./category_list.php'" />
								</div>
								<div class="btn-group mx-sm-1">
									<input type="button" class="btn btn-outline-primary" value="신규등록" onclick="location.href='./category_form.php'" />
								</div>
							</div>
						</div>
					</div>


					<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered">
						<thead class="thead-dark">
						<tr>
							<th class="text-center" style="width:300px;">분류명</th>
							<th class="text-center" style="width:100px;">분류LEVEL</th>
							<th class="text-center" style="width:100px;">분류순위</th>
							<th class="text-center" style="width:160px;">관리</th>
						</tr>
						</thead>
						<tbody class="category_list_body">
							<? recusive_category(0, 0); ?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	unset($list);
	$query = "select ct_id from category_t";
	$list = $DB->select_query($query);

	if($list) {
		foreach($list as $row) {
			$arr_cba = get_bottom_all($row['ct_id']);

			unset($arr_query);
			$arr_query = array(
				"ct_id" => $row['ct_id'],
				"ct_id_txt" => implode(',', $arr_cba),
			);

			$query_cba = "select idx from category_bottom_all where ct_id = '".$row['ct_id']."'";
			$row_cba = $DB->fetch_query($query_cba);

			if($row_cba['idx']) {
				$where_query = "idx = '".$row_cba['idx']."'";

				$DB->update_query('category_bottom_all', $arr_query, $where_query);
			} else {
				$DB->insert_query('category_bottom_all', $arr_query);
			}

		}
	}

	include "./foot_inc.php";
?>
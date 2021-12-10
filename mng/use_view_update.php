<?
    include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	$_act = $_REQUEST['act'];

	if($_POST['act']=='swipe_image') {
?>
	<div class="modal-header">
		<h5 class="modal-title" id="staticBackdropLabel">등록리뷰 이미지</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="slider" id="product-swiper">
			<?
				$query = "
					select * from review_t
					where idx = '".$_POST['rt_idx']."'
				";
				$row = $DB->fetch_query($query);

				for($q=1;$q<=5;$q++) {
					$pt_image_t = "rt_img".$q;
					if($row[$pt_image_t]) {
			?>
			<div class="m-2"><img src="<?=$ct_img_url."/".$row[$pt_image_t]?>" onerror="this.src='<?=$ct_no_img_url?>'" class="product-swipe" alt="<?=$row['pt_title']?>"></div>
			<?
					}
				}
			?>
		</div>
	</div>
<?
    } else if($_POST['act']=='content_view') {
		$query = "
			select * from review_t
			where idx = '".$_POST['rt_idx']."'
		";
		$row = $DB->fetch_query($query);
?>
	<div class="modal-header">
		<h5 class="modal-title" id="staticBackdropLabel">등록리뷰 상세보기</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		<p><?=nl2br($row['rt_content'])?></p>
	</div>
<?
    } else if($_POST['act']=='delete') {
		$DB->del_query('review_t', " idx = '".$_POST['idx']."'");

		echo "Y";
	}

    include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>
<?
	include "./head_inc.php";
	$chk_menu = '8';
	$chk_sub_menu = '3';
	$chk_ckeditor = 'Y';
    $rt_img_url = "../images/uploads/reviews";
	include "./head_menu_inc.php";

	if($_GET['act']=="update") {
		$query = "
			select *, a1.idx as rt_idx from review_t a1
			where a1.idx = '".$_GET['rt_idx']."'
		";
		$row = $DB->fetch_query($query);

		$_act = "update";
		$_act_txt = " 수정";
	} else {
		$_act = "input";
		$_act_txt = " 입력";
	}

	$_get_txt = "&pg=".$_GET['pg'];
?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">이용후기 관리</h4>

					<form method="post" name="frm_form" id="frm_form" action="./use_review_update.php" target="hidden_ifrm" enctype="multipart/form-data" onsubmit="return frm_form_chk()">
					<input type="hidden" name="act" id="act" value="<?=$_act?>" />
					<input type="hidden" name="rt_idx" id="rt_idx" value="<?=$row['rt_idx']?>" />
					<div class="form-group row">
						<label for="mt_id" class="col-sm-2 col-form-label">고객 아이디</label>
						<div class="col-sm-3">
							<input type="text" name="mt_id" id="mt_id" value="<?=$row['mt_id']?>" class="form-control form-control-sm" <?php if($_act=="update") echo "disabled"?>/>
							<small id="select_category_help" class="form-text text-muted" style="width: 350px">
							*고객의 아이디로 고객의 순번을 찾습니다.
							</small>
						</div>
					</div>
					<div class="form-group row">
						<label for="rt_title" class="col-sm-2 col-form-label">제목</label>
						<div class="col-sm-10">
							<input type="text" name="rt_title" id="rt_title" value="<?=$row['pt_title']?>" class="form-control form-control-sm" />
						</div>
					</div>
					<div class="form-group row">
						<label for="rt_thum_img" class="col-sm-2 col-form-label">섬네일</label>
						<div class="col-sm-10">
							<input type="file" name="rt_thum_img" id="rt_thum_img" value="<?=$row['rt_thum_img']?>" accept=".gif, .jpg, .jpeg, .png, .gif, .bmp" class="d-none" />
							<input type="hidden" name="rt_thum_img_on" id="rt_thum_img_on" value="<?=$row['rt_thum_img']?>" class="form-control" />

							<div class="float-left mr-3 mb-3">
								<a href="javascript:;" onclick="f_preview_image_delete('rt_thum_img')"><label class="image_del" id="rt_thum_img_del"><i class="mdi mdi-close"></i></label></a>
								<label for="rt_thum_img" class="plus-input" id="rt_thum_img_box" style="width:250px;"><i class="mdi mdi-plus"></i></label>
							</div>
							<script type="text/javascript">
							<!--
								$('#rt_thum_img').on('change', function(e) {
									f_preview_image_selected(e,'rt_thum_img');
								});

								<? if($row['rt_thum_img']) { ?>
								$('#rt_thum_img_del').show();
								$("#rt_thum_img_box").css('border', 'none');
								$("#rt_thum_img_box").html('<img id="bt_link1_img" style="object-fit:contain; width:250px;" src="<?=$rt_img_url.'/'.$row['rt_thum_img']?>?v=<?=time()?>" onerror="this.src=\'../images/noimg.png\'" />');
								<? } ?>
							//-->
							</script>
							<div class="clearfix"></div>
						</div>
					</div>
                    <div class="form-group row">
						<label for="rt_tag" class="col-sm-2 col-form-label">태그</label>
						<div class="col-sm-10">
							<input type="text" name="rt_tag" id="rt_tag" value="" class="form-control form-control-sm"/>
							<small id="select_category_help" class="form-text text-muted" style="width: 350px">
							*태그 입력 후 스페이스 바를 입력하시면 태그가 입력됩니다.
							</small>
                            <input id="tagValue" name="tagValue" type="hidden" value="">
							<ul class="tag" id="rt-tag-list">
                                <?php 
                                    $tags = explode("/",$row['rt_tag']);
                                    for($i=0; $i<count($tags)-1; $i++){
                                        echo "<li name='tag-list-value' class='tag tag-box'>".$tags[$i]."<span class='del-btn' idx='".$i."'>"."X</span></li>";
                                    }
                                ?>
							</ul>
                            <script>
                                var tag = {};
                                var counter = 0;
                                function addTag(Value){
                                    tag[counter] = Value;
                                    counter++;
                                }
                                $('#rt_tag').on('keyup',function(e){
                                    var checkNum = document.getElementsByName('tag-list-value').length;
                                    if(e.key==" "||e.keyCode=="30"){
                                        if(checkNum<5){
                                            var tagValue = $('#rt_tag').val();
                                            if(tagValue != " "){
                                                $('#rt-tag-list').append("<li name='tag-list-value' class='tag tag-box'>"+tagValue+"<span class='del-btn' idx='"+counter+"'>"+"X</span></li>");
                                                addTag(tagValue);
                                                $('#rt_tag').val("");
                                            }
                                        }else{
                                            alert("태그는 최대 5개까지 가능합니다.");
                                        }
                                    }
                                });
                                $(document).on("click", ".del-btn", function (e) {
                                    var index = $(this).attr("idx");
                                    tag[index] = '';
                                    $(this).parent().remove();
                                });
                            </script>
						</div>
					</div>
					<div class="form-group row">
						<label for="rt_content" class="col-sm-2 col-form-label">내용</label>
						<div class="col-sm-10">
							<textarea name="rt_content" id="rt_content" class="form-control form-control-sm"><?=$row['rt_content']?></textarea>
							<script type="text/javascript">
								CKEDITOR.replace('rt_content', {
									extraPlugins: 'uploadimage, image2',
									height : '500px',
									filebrowserImageBrowseUrl : '',
									filebrowserImageUploadUrl : './file_upload.php?Type=Images&upload_name=st_agree1',
									enterMode : CKEDITOR.ENTER_BR,
								});
							</script>
						</div>
					</div>

					<p class="p-3 text-center">
						<?php if($_act=='update'){?>
						<input type="button" value="삭제" class="btn btn-outline-danger" onclick="delBanner('./use_review_update.php',<?= $row['rt_idx']?>)" />
						<?php }?>
						<input type="button" value="목록" onclick="location.href='./use_review.php?<?=$_get_txt?>'" class="btn btn-outline-secondary mx-2" />
                        <input type="submit" value="확인" class="btn btn-outline-primary"/>
					</p>

					</form>
					<script type="text/javascript">
						function f_preview_image_selected(e, obj_name) {
							var files = e.target.files;
							var filesArr = Array.prototype.slice.call(files);
							var obj_t = obj_name;

							filesArr.forEach(function(f) {
								if(!f.type.match("image.*")) {
									alert("확장자는 이미지 확장자만 가능합니다.");
									return;
								}

								if(f.size>12000000) {
									alert("이미지는 10메가 이하만 가능합니다.");
									return;
								}

								var reader = new FileReader();
								reader.onload = function(e) {
									$("#"+obj_t+"_box").css('border', 'none');
									$("#"+obj_t+"_box").html('<img style="object-fit:contain; width:250px;" src="'+e.target.result+'" onerror="this.src=\'../images/noimg.png\'" />');
									$("#"+obj_t+"_del").show();
								}
								reader.readAsDataURL(f);
							});
						}
						function frm_form_chk(f) {
							var f = document.frm_form;
                            var tag = document.getElementsByName('tag-list-value');
							if(f.mt_id.value==''){
								alert('고객 아이디을 입력해주세요.');
                                return false;
							}else if(f.rt_title.value==''){
                                alert('제목을 입력해주세요.');
                                return false;
                            }else if(document.getElementsByName('tag-list-value').length<0) {
                                alert("태그를 입력해주세요");
                                return false;
							}else if(CKEDITOR.instances.rt_content.getData()==''){
								alert("내용을 입력해주세요");
                                return false;
							}else{
                                for(var i=0; i<tag.length; i++){
                                    tagText = tag[i].innerText.split("X");
                                    $('#tagValue').val(tagText[0]+"/"+$('#tagValue').val());
                                }
                            }
                            return true;
						}
                        function delBanner(url, idx){
                            var result = confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.");
                            var file = document.getElementById('rt_thum_img_on').value;
                            if(result){
                            $('#delBanner').modal('hide');
                                $.post(url, {act: 'delete', idx: idx, rt_thum_img_on: file}, 
                                function (data) {
                                    if(data=='Y') {
                                        alert('삭제되었습니다.');
                                        location.href="../mng/use_review.php";
                                    }
                                });
                            }
                        }
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
<?
	include "./foot_inc.php";
?>
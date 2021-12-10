<?php
include "./head_inc.php";
if(!$_SESSION['mt_id']){
    alert("로그인 후 이용해주세요.", "./login.php");
}
$sql = "select * from d_app_domestic where mt_idx = '{$_SESSION['mt_idx']}' and app_status < 1 and d_datetime = '' ";
$dad = $DB->fetch_assoc($sql);
if($dad['cate_mark']){ $cate_mark = $dad['cate_mark']; }else{ $cate_mark = $_SESSION['cate_mark']; }
if($dad['name_mark']){ $name_mark = $dad['name_mark']; }else{ $name_mark = $_SESSION['name_mark']; }
if($dad['img_mark_origin']){ $img_mark_origin = $dad['img_mark_origin']; }else{ $img_mark_origin = $_SESSION['img_mark_origin']; }
if($dad['chk_use1']){ $chk_use1 = $dad['chk_use1']; }else{ $chk_use1 = $_SESSION['chk_use1']; }
if($dad['txt_ps']){ $txt_ps = $dad['txt_ps']; }else{ $txt_ps = $_SESSION['txt_ps']; }
if($dad['link_shop']){ $link_shop = $dad['link_shop']; }else{ $link_shop = $_SESSION['link_shop']; }
?>
<div class="sub_pg">
    <div class="container-fluid px-0">
        <div class="container-xl ">
            <div class="container01 mx-auto">

                <h2 class="sub_tit">상표출원하기</h2>

                <!-- 상표출원 단계 -->
                <div class="step d-flex flex-wrap mb_15">
                    <button type="button" class="btn btn-outline-primary btn-md mr_8 no-cursor">1. 상표정보 입력</button>
                    <button type="button" class="btn btn-outline-secondary btn-md mr_8 no-cursor">2. 상품분류 및 서비스 선택</button>
                    <button type="button" class="btn btn-outline-secondary btn-md mr_8 no-cursor">3. 상표 권리자 정보 등록</button>
                    <button type="button" class="btn btn-outline-secondary btn-md no-cursor">4. 최종 확인 및 결제</button>
                </div>
                <!-- 상표출원 단계 끝-->


                <!-- 상표출원 임시저장 -->
                <!--<div class="d-flex align-items-center bg-light rounded p_15_20 justify-content-between mb_50">
                    <div class="d-flex mr-3">
                        <i class=" xi-info-o fc_primary fs_19 mr_8 mt-1"></i></i>
                        <p class="fc_primary">임시저장하여 나중에 돌아오실때 저장 되었던 곳에서 진행하세요.</p>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" onclick="save_temporarily('application_domestic')">임시저장</button>
                </div>-->
                <!-- 상표출원 임시저장 끝 -->

                <form id="form1" name="form1" method="post" enctype="multipart/form-data" class="mt_50">
                    <h3 class="sub_tit2">상표유형 선택</h3>

                    <!-- 상표유형 라디오 선택 -->
                    <div class="trademark_type mb_20">

                        <input type="hidden" name="cate_mark" id="cate_mark" value="<?= $cate_mark ?>">

                        <!-- 선택 라디오,체크박스 -->
                        <div class="select d-flex flex-wrap justify-content-between">
                            <div class="checks w-50" onclick="click_type_applicant('1')">
                                <input type="radio" name="cate_mark" id="aa" <? if($cate_mark==1){echo "checked";} ?> >
                                <label for="aa">
                                    <div class="d-flex align-items-center align-items-md-start">
                                        <img src="./images/trademark_type1.png" alt="" class="type_img mr_20">
                                        <div>
                                            <p class="fs_18 fw_600 fc_gr222 mb-2 mt-3">문자 상표</p>
                                            <p>폰트, 캘리그라피 등 텍스트형의 상표로 이루어집니다.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="checks w-50" onclick="click_type_applicant('2')">
                                <input type="radio" name="cate_mark" id="a2" <? if($cate_mark==2){echo "checked";} ?> >
                                <label for="a2">
                                    <div class="d-flex align-items-center align-items-md-start">
                                        <img src="./images/trademark_type2.png" alt="" class="type_img mr_20">
                                        <div>
                                            <p class="fs_18 fw_600 fc_gr222 mb-2 mt-3">도형 상표</p>
                                            <p>도형을 사용하실 경우 선택해주세요.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="checks w-50" onclick="click_type_applicant('3')">
                                <input type="radio" name="cate_mark" id="a3" <? if($cate_mark==3){echo "checked";} ?> >
                                <label for="a3">
                                    <div class="d-flex align-items-center align-items-md-start">
                                        <img src="./images/trademark_type3.png" alt="" class="type_img mr_20">
                                        <div>
                                            <p class="fs_18 fw_600 fc_gr222 mb-2 mt-3">복합 상표</p>
                                            <p>문자와 도형이 이루어진 경우 선택해주세요.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="checks w-50" onclick="click_type_applicant('4')">
                                <input type="radio" name="cate_mark" id="a4" <? if($cate_mark==4){echo "checked";} ?> >
                                <label for="a4">
                                    <div class="d-flex align-items-center align-items-md-start">
                                        <img src="./images/trademark_type4.png" alt="" class="type_img mr_20">
                                        <div>
                                            <p class="fs_18 fw_600 fc_gr222 mb-2 mt-3">기타</p>
                                            <p>어떤 유형인지 결정을 못하실 경우 선택해주세요.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <!-- 선택 라디오,체크박스 끝-->
                    </div>
                    <!-- 상표유형 라디오 선택 끝-->


                    <div class="ip_wr mb_50 div_name_mark">
                        <div class="ip_tit mb-3">
                            <h5>상표명을 적어주세요.</h5>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" name="name_mark" id="name_mark" value="<?= $name_mark ?>" onkeyup="save_session('name_mark',this.value)">
                        </div>
                    </div>


                    <div class="ip_wr mb_50">
                        <div class="ip_tit mb-3">
                            <h5>상표 이미지 첨부 <span class="fw_300 fc_gr666">(선택)</span></h5>
                        </div>
                        <ul class="mb-3 fs_15">
                            <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                <p>최대 20 MB 용량의 jpg, png 파일을 첨부하실 수 있습니다.</p>
                            </li>
                            <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                <p>400px x 400px의 흰 바탕의 이미지 파일을 올려주세요</p>
                            </li>
                        </ul>
                        <div class="input-group">
                            <input type="text" name="img_mark_origin" id="img_mark_origin" class="form-control" placeholder="Choose file..." value="<?= $img_mark_origin ?>" readonly>
                            <input type="file" name="img_mark" id="img_mark" class="hide">
                            <div class="input-group-append">
                                <button class="btn btn-secondary btn-md" type="button" onclick="clickbtn_img_mark()">파일 첨부</button>
                            </div>
                        </div>
                    </div>

                    <h3 class="sub_tit2">상표·서비스 소개</h3>

                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex mb-3">
                            <h5>1. 현재 해당 상표는 상품 및 서비스에 사용중인가요?</h5>
                        </div>
                        <div class="input-group-prepend">
                            <div class="checks mr_30">
                                <input id="chk_use1_y" name="chk_use1" type="radio" value="Y" required <? if($chk_use1=="Y"){echo "checked";} ?> >
                                <label for="chk_use1_y">예</label>
                            </div>
                            <div class="checks">
                                <input id="chk_use1_n" name="chk_use1" type="radio" value="N" required <? if($chk_use1=="N"){echo "checked";} ?> >
                                <label for="chk_use1_n">아니오</label>
                            </div>
                        </div>
                    </div>


                    <div class="ip_wr">
                        <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                            <h5>2. 제품 및 서비스에 대해 설명해주세요. </h5>
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" placeholder="제품 및 서비스에 대해 설명해주세요." name="txt_ps" id="txt_ps" rows="5"><? echo strip_tags($txt_ps); ?></textarea>
                        </div>
                    </div>

                    <div class="ip_wr">
                        <div class="ip_tit mb-3">
                            <h5>3. 현재 진행중인 온라인 쇼핑몰이 있으시면 쇼핑몰의 링크를 입력해주세요. <span class="fw_300 fc_gr666">(선택)</span></h5>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" name="link_shop" id="link_shop" placeholder="ex) www.naver.com" value="<?= $link_shop ?>">
                        </div>
                    </div>


                    <div class="btn_group d-flex justify-content-center">
                        <button type="button" class="btn btn-primary btn-md btn_style03" onclick="chk_submit()">다음으로</button>
                    </div>


                </form>
                <script>
                    function chk_submit(){
                        var txt_ps = $("#txt_ps").val();
                        if($("input[name=chk_use1]:checked").length<1){
                            alert("상표 사용 유무를 체크 해주세요.");
                            $("#chk_use1_y").focus();
                        }else if(txt_ps.length<1){
                            alert("제품 및 서비스 설명을 입력해주세요.");
                            $("#txt_ps").focus();
                        }else{
                            location.href='application_domestic_step2.php';
                        }
                    }
                </script>
            </div>
            <!-- container01-->
        </div>
    </div>
    <!-- container-fluid -->
</div>

<script>
    var imageFile;

    function click_type_applicant(num1){
        save_session('cate_mark',num1);
        if(num1==1 || num1==4){
            $(".div_name_mark").show();
        }else{
            $(".div_name_mark").hide();
        }
    }
    function clickbtn_img_mark(){
        $("#img_mark").click();
    }

    $("#img_mark").on("change", function(event){
        ajax_post_file("domestic_step1","form1","img_mark_origin");
    });

    $("#chk_use1_y").on("click", function(event){
        save_session('chk_use1',$(this).val());
    });
    $("#chk_use1_n").on("click", function(event){
        save_session('chk_use1',$(this).val());
    });

    $("#txt_ps").on("keyup", function(event){
        save_session('txt_ps',$(this).val());
    });

    $("#link_shop").on("keyup", function(event){
        save_session('link_shop',$(this).val());
    });



    $(function (){
        var cate_mark = '<?= $_SESSION['cate_mark'] ?>';
        if(Number(cate_mark)==1 || Number(cate_mark)==4){
            $(".div_name_mark").show();
        }else{
            $(".div_name_mark").hide();
        }
    });
</script>
<?php
include "./foot_inc.php";
?>

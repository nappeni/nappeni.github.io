<? include_once("./head_inc.php");
    if(!$_SESSION['mt_id']){
        alert("로그인 후 이용해주세요.", "./login.php");
    }
    if($_SESSION['o_nations']){
        echo "ggg";
        $nations = explode("/",$_SESSION['o_nations']);
    }
    if($_SESSION['o_class']){
        $class = explode("/",$_SESSION['o_class']);
    }
    //출원 국가
    $sql = "select nt_continent from nation_t where not nt_continent = 0 group by nt_continent";
    $count = $DB->select_query($sql);
    for($i=0; $i<count($count); $i++){
        $sql = "select idx as nt_idx, nt_madrid, nt_name from nation_t where nt_continent='".$count[$i]['nt_continent']."'";
        $list1[] = $DB -> select_query($sql);
    }
    foreach($list1 as $list1[]);
    //분류선택
    $sql = "select * from cate_overseas_t order by co_rank";
    $list2=$DB -> select_query($sql);
?>
<div class="sub_pg application_domestic">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-between">
                <form id="ao1" method="post" action="./JYController/application_overseas.php" onsubmit="return checkNull()">
                <input name="act" type="hidden" value="step1">
                <div class="w-65">
                    <h2 class="sub_tit">해외상표 출원하기</h2>
                        <h3 class="sub_tit2">상표유형 선택</h3>
                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex mb-4">
                                    <h5>1. 출원하고자 하는 상표의 유형을 선택하세요.</h5>
                                </div>
                                <!-- 해외 상표유형 라디오 선택 -->
                                <div class="trademark_type2 mb_22 text-center">
                                    <!-- 선택 라디오,체크박스 -->
                                    <div class="select d-flex flex-wrap justify-content-between">
                                        <div class="checks w-50">
                                            <input type="radio" name="exampleRadios2" id="ab1" value="1" <?php if($_SESSION['o_type']==1) echo "checked";?>>
                                            <label for="ab1">
                                                <p class="fs_18 fw_600 fc_gr222">모든 국가에 동일 상표 출원</p>
                                                <ul class="d-flex justify-content-center mt_20">
                                                    <li class="m-1"><img src="./images/mark1.png" alt=""></li>
                                                </ul>
                                            </label>
                                        </div>
                                        <div class="checks w-50 p_35_20">
                                            <input type="radio" name="exampleRadios2" id="ab2" value="2" <?php if($_SESSION['o_type']==2) echo "checked";?>>
                                            <label for="ab2">
                                                <p class="fs_18 fw_600 fc_gr222">국가별 다른 상표 출원</p>
                                                <ul class="d-flex justify-content-center mt_20">
                                                    <li class="m-1"><img src="./images/mark1.png" alt=""></li>
                                                    <li class="m-1"><img src="./images/mark2.png" alt=""></li>
                                                    <li class="m-1"><img src=" ./images/mark3.png" alt=""></li>
                                                </ul>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- 선택 라디오,체크박스 끝-->
                                </div>
                                <!-- 상표유형 라디오 선택 끝-->
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit d-flex align-items-center d-flex  mb-3">
                                    <h5>2. 상표의 색상을 선택하세요.</h5>
                                </div>
                                <div class="input-group-prepend">
                                    <div class="checks mr_30">
                                        <input type="radio" name="ac" id="ac1" value="B" <?php if($_SESSION['o_color']=="B") echo "checked"?>>
                                        <label for="ac1">흑백</label>
                                    </div>
                                    <div class="checks">
                                        <input type="radio" name="ac" id="ac2" value="C" <?php if($_SESSION['o_color']=="C") echo "checked"?>>
                                        <label for="ac2">컬러</label>
                                    </div>
                                </div>
                            </div>

                            <div class="ip_wr">
                                <div class="ip_tit mb-3">
                                    <h5>3. 출원하고자 하는 국가를 입력하세요.</h5>
                                </div>
                                <div class="d-flex">
                                    <div class="input-group mb_10">
                                        <div class="d-flex form_serch">
                                            <input id="search" class="form-control" type="text" placeholder="국가명 검색">
                                            <button class="btn serch_btn" type="button" alt="검색" onclick="selectNation()"></button>
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn_style04" type="button" onclick="showNationM()">국가 바로선택하기</button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="mb-3 fs_15">
                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                        <p>상표등록을 받고 싶은 국가의 이름을 검색 또는 직접 선택 할 수 있습니다.</p>
                                    </li>
                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                        <p>검색된 국가를 체크하여 선택하세요. (다중선택 가능)</p>
                                    </li>
                                    <li class="d-flex"><span class="flex-shrink-0 mr-2">※</span>
                                        <p>마드리드 미가입 국가는 개별 출원됩니다.</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="d-flex flex-wrap mb_50">
                                <input name="nationValues" id="nationValues" type="hidden" value="">
                                <ul id="nationList">
                                    <?php 
                                        for($i=0; $i<count($nations)-1; $i++){
                                            $sql = "select idx, nt_name from nation_t where idx='".$nations[$i]."'";
                                            $list = $DB->fetch_query($sql);
                                            echo "<li name='nationValue' class='btn btn-secondary m-1' value='".$list['idx']."'>".$list['nt_name']."<i class='xi-close fc_grccc mt-2 ml_8 del-btn'></i></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="border_bk mb_50"></div>

                            <div class="d-flex align-items-center justify-content-between mb_22">
                                <div class="d-block d-sm-flex align-items-center">
                                    <h3 class="sub_tit2 mr_15 mb-2 mb-sm-0">분류 선택</h3>
                                    <p class="fc_primary">마우스를 위에 얹어보세요.</p>
                                </div>
                                <div class="num_cases">
                                    <p id="checkNum" class="fs_14 fc_primary">총 <?= count($class)?>건 선택</p>
                                </div>
                            </div>
                            <div class="mb_22">
                                <!-- 선택 라디오,체크박스 -->
                                <div class="classification_type2 select d-flex flex-wrap text-center">
                                <?php foreach($list2 as $list2){?>
                                    <div class="checks">
                                        <input type="checkbox" name="da[]" id="da<?= $list2['co_rank']?>" value="<?= $list2['idx']?>">
                                        <label for="da<?= $list2['co_rank']?>">
                                            <p><?= $list2['co_name']?></p>
                                        </label>
                                        <p class="hover_type"><?= $list2['co_txt']?></p>
                                    </div>
                                <?php }?>
                                <script>
                                    $("input[name='da[]']").each(function(i,val){
                                        <?php for($i=0; $i<count($class)-1; $i++){?>
                                            if(val.value==<?= $class[$i]?>){
                                                this.checked = true;
                                            }
                                        <?php }?>
                                    });
                                </script>
                                </div>
                                <!-- 선택 라디오,체크박스 끝-->
                            </div>
                            <!-- 분류 선택 끝 -->
                         <div class=" btn_group d-flex justify-content-center mb_70 mb-md-0">
                             <button type="submit" class="btn btn-primary btn-md btn_style03">다음으로</button>
                        </div>
                    </div>
                    <!-- w-65 끝-->
                    </form>
                    <!-- w-30 시작-->
                    <div class="w-30 aside2">
                        <img src="./images/aside2.png" alt="">
                    </div>
                    <!-- w-30 끝-->
                    <!-- division 끝 / 서브페이지 영역 2분할 -->

                </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- 출원국가 선택 Modal -->
<div class="modal fade" id="country" tabindex="-1" aria-labelledby="exampleModalLabe" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">출원국가 선택</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="xi-close fs_36 fc_grccc"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- 중복선택시 팝업이 나오도록...
                 <button class="btn btn-primary btn_style04" type="button" data-toggle="modal" data-target="#duplicate">중복선택</button> 
                 #duplicate 모달 추가
                -->
                <h3 class="sub_tit2">아시아</h3>
                <div class="country_sec text-center mb_40">
                    <!-- 선택 라디오,체크박스 -->
                    <div class="select d-flex flex-wrap text-center">
                        <?php foreach($list1[0] as $list1[0]){?>
                         <div class="checks">
                            <input type="checkbox" name="zz" id="z<?= $n_count?>" value="<?= $list1[0]['nt_idx']?>">
                            <label for="z<?= $n_count?>">
                                <p><?php if($list1[0]['nt_madrid']=="Y") echo "<img src='./images/m_icon.png' alt='' class='d-inline mr-3'>"?><?= $list1[0]['nt_name']?></p>
                            </label>
                        </div>
                        <?php 
                            $n_count++;
                        }?>
                    </div>
                    <!-- 선택 라디오,체크박스 끝-->
                </div>
                <!-- 아시아 국가 선택 끝 -->

                <h3 class="sub_tit2">북미</h3>
                <div class="country_sec text-center mb_40">
                    <!-- 선택 라디오,체크박스 -->
                    <div class="select d-flex flex-wrap text-center">
                        <?php foreach($list1[1] as $list1[1]){?>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z<?= $n_count?>" value="<?= $list1[1]['nt_idx']?>">
                            <label for="z<?= $n_count?>">
                                <p><?php if($list1[1]['nt_madrid']=="Y") echo "<img src='./images/m_icon.png' alt='' class='d-inline mr-3'>"?><?= $list1[1]['nt_name']?></p>
                            </label>
                        </div>
                        <?php
                            $n_count++; 
                        }?>
                    </div>
                    <!-- 선택 라디오,체크박스 끝-->
                </div>
                <!-- 북미 국가 선택 끝 -->

                <h3 class="sub_tit2">유럽</h3>
                <div class="country_sec text-center mb_40">
                    <!-- 선택 라디오,체크박스 -->
                    <div class="select d-flex flex-wrap text-center">
                        <?php foreach($list1[2] as $list1[2]){?>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z<?= $n_count?>" value="<?= $list1[2]['nt_idx']?>">
                            <label for="z<?= $n_count?>">
                                <p><?php if($list1[2]['nt_madrid']=="Y") echo "<img src='./images/m_icon.png' alt='' class='d-inline mr-3'>"?><?= $list1[2]['nt_name']?></p>
                            </label>
                        </div>
                        <?php 
                            $n_count++;
                        }?>
                    </div>
                    <!-- 선택 라디오,체크박스 끝-->
                </div>
                <!-- 유럽 국가 선택 끝 -->

                <h3 class="sub_tit2">아프리카</h3>
                <div class="country_sec text-center mb_40">
                    <!-- 선택 라디오,체크박스 -->
                    <div class="select d-flex flex-wrap text-center">
                    <?php foreach($list1[3] as $list1[3]){?>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z<?= $n_count?>" value="<?= $list1[3]['nt_idx']?>">
                            <label for="z<?= $n_count?>">
                                <p><?php if($list1[3]['nt_madrid']=="Y") echo "<img src='./images/m_icon.png' alt='' class='d-inline mr-3'>"?><?= $list1[3]['nt_name']?></p>
                            </label>
                        </div>
                        <?php 
                            $n_count++;
                        }?>
                    </div>
                    <!-- 선택 라디오,체크박스 끝-->
                </div>
                <!-- 북미 국가 선택 끝 -->

                <h3 class="sub_tit2">오세아니아</h3>
                <div class="country_sec text-center mb_40">
                    <!-- 선택 라디오,체크박스 -->
                    <div class="select d-flex flex-wrap text-center">
                        <?php foreach($list1[4] as $list1[4]){?>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z<?= $n_count?>" value="<?= $list1[4]['nt_idx']?>">
                            <label for="z<?= $n_count?>">
                                <p><?php if($list1[4]['nt_madrid']=="Y") echo "<img src='./images/m_icon.png' alt='' class='d-inline mr-3'>"?><?= $list1[4]['nt_name']?></p>
                            </label>
                        </div>
                        <?php 
                            $n_count++;
                        }?>
                    </div>
                    <!-- 선택 라디오,체크박스 끝-->
                </div>
                <!-- 오세아니아 국가 선택 끝 -->

                <h3 class="sub_tit2">중동</h3>
                <div class="country_sec text-center mb_40">
                    <!-- 선택 라디오,체크박스 -->
                    <div class="select d-flex flex-wrap text-center">
                    <?php foreach($list1[5] as $list1[5]){?>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z<?= $n_count?>" value="<?= $list1[5]['nt_idx']?>">
                            <label for="z<?= $n_count?>">
                                <p><?php if($list1[5]['nt_madrid']=="Y") echo "<img src='./images/m_icon.png' alt='' class='d-inline mr-3'>"?><?= $list1[5]['nt_name']?></p>
                            </label>
                        </div>
                    <?php 
                        $n_count++;
                    }?>
                    </div>
                    <!-- 선택 라디오,체크박스 끝-->
                </div>
                <!-- 중동 국가 선택 끝 -->

                <h3 class="sub_tit2">중남미</h3>
                <div class="country_sec text-center">
                    <!-- 선택 라디오,체크박스 -->
                    <div class="select d-flex flex-wrap text-center">
                        <?php foreach($list1[6] as $list1[6]){?>
                        <div class="checks">
                            <input type="checkbox" name="zz" id="z<?= $n_count?>" value="<?= $list1[6]['nt_idx']?>">
                            <label for="z<?= $n_count?>">
                                <p><?php if($list1[6]['nt_madrid']=="Y") echo "<img src='./images/m_icon.png' alt='' class='d-inline mr-3'>"?><?= $list1[6]['nt_name']?></p>
                            </label>
                        </div>
                        <?php 
                            $n_count++;
                        }?>
                    </div>
                    <!-- 선택 라디오,체크박스 끝-->
                </div>
                <!-- 중남미 국가 선택 끝 -->
            </div>

            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary btn-lg btn-block" onclick="showNation()">선택</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- 출원국가 선택 Modal 끝-->
<script type="text/javascript">
    //Enter 이벤트
    $('#search').on("keyup",function(e){ //검색
        if(e.key=="Enter"||e.keyCode=="23"){
            selectNation();
        }
    });
    $('input[type="text"]').keydown(function() { //submit enter x
        if (event.keyCode === 13) {
            event.preventDefault();
        }
    });
    //국가 검색
    $('input[type="text"]').keydown(function() {
    if (event.keyCode === 13) {
        event.preventDefault();
    }
    });
    function selectNation(){
        var text = document.getElementById('search').value;
        if(text == ''){
            alert("검색어를 입력해주세요.");
        }else{
            var check = 1;
            for(var i=0; i<document.getElementsByName('nationValue').length; i++){
                if(text == document.getElementsByName('nationValue')[i].innerText){
                    check = 0;
                    alert("이미 선택한 나라입니다.");
                    $('#search').val("");
                    break;
                }else{
                    check = 1;
                }
            }
            if(check==1){
                $.ajax({
                    url: "./JYController/application_overseas.php",
                    type: "post",
                    dataType: "json",
                    data: {act: "nation_select", text: text},
                    success:function(result){
                        if(result['success']==1){
                            $('#nationList').append("<li name='nationValue' class='btn btn-secondary m-1' value='"+result['nt_idx']+"'>"+text+"<i class='xi-close fc_grccc mt-2 ml_8 del-btn'></i></li>");
                            $('#search').val("");
                        }else{
                            alert("해당 국가 이름을 찾을 수 없습니다.");
                        }
                    }
                });
            }
        }
    }
    //국가 바로 선택 모달 창 표시
    function showNationM(){
        var valueNum = document.getElementsByName('nationValue').length;
        if(valueNum != 0){
            for(var i=0; i<valueNum; i++){
                var text = document.getElementsByName('nationValue')[i].value;
                $('input[name=zz]').each(function(i,val){
                    if(val.value == text){      
                        $(this).parent().css("display","none");
                    }else{
                        $(this).prop("checked",false);
                    }
                });
            }
        }else{
            $('input[name=zz]').each(function(i,val){
                $(this).prop("checked",false);
            });
        }
        $('#country').modal("show");
    }
    //국가 바로 선택 리스트 추가
    function showNation(){
        $('input[name=zz]:checked').each(function(i,val){
            var text = $('label[for='+val.id+']').text();
            $('#nationList').append("<li name='nationValue' class='btn btn-secondary m-1' value='"+val.value+"'>"+text+"<i class='xi-close fc_grccc mt-2 ml_8 del-btn'></i></li>");
            $(this).prop("checked",false);
        });
        $('#country').modal("hide");
    }
    //국가 리스트 삭제
    $(document).on("click",".del-btn",function(e){
        var text = $(this).parent().val();
        $('input[name=zz]').each(function(i,val){
            if(val.value == text){
                $(this).parent().css("display","block");
            }
        });
        $(this).parent().remove();
    });
    //분류 선택 카운트 및 값 출력
    $("input[name='da[]']").click(function(){
        var c_num = $("input[name='da[]']:checked").length;
        $("#checkNum").text("총 "+c_num+"건 선택");
    });
    //모든값이 입력됬는지 확인
    function checkNull(){
        var list = document.getElementsByName('nationValue');
        for(var i=0; i<list.length; i++){
            listText = list[i].value;
            $('#nationValues').val(listText+"/"+$('#nationValues').val());
        }
        if($('input:radio[name=exampleRadios2]:checked').length == 0){
            alert("상표 유형을 선택해주세요");
            return false;
        }else if($('input:radio[name=ac]:checked').length == 0){
            alert("상표 색상을 선택해주세요");
            return false;
        }else if(document.getElementsByName('nationValue').length == 0){
            alert("출원 국가를 선택해주세요.");
            return false;
        }else if($('input[name=da[]]:checked').length == 0){
            alert("분류를 선택해주세요.");
            return false;
        }
        return true;
    }
</script>
<!-- sub_pg 끝 -->
<? include_once("./foot_inc.php"); ?>
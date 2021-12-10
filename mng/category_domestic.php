<?
include "./head_inc.php";
$chk_menu = '5';
$chk_sub_menu = '1';
include "./head_menu_inc.php";

unset($list);
$query = "select * from cate_ps1 where ct_level = 1 order by ct_order asc, ct_id asc ";
$list1 = $DB->select_query($query);
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">국내 카테고리 관리</h4>

                        <div class="clearboth">
                            <div class="wd-40 float-left margin-right-30 wrap_cate">
                                <div class="margin-bottom-10">1차 카테고리</div>
                                <div id="wrap_list_lv1" class="border-1-ccc">

                                    <?
                                    if(count($list1)>0){
                                        foreach ($list1 as $pslv1) {
                                            if($pslv1['ct_icon']){
                                                $upload_dir = "../data/app_domestic/";
                                                $imgsrc = $upload_dir.$pslv1['ct_icon'];
                                            }else{
                                                $upload_dir = "../images/";
                                                $imgsrc = $upload_dir."noimg.png";
                                            }
                                            ?>
                                            <div class="clearboth wd-100 py-1 ele_cate1 <? if($_GET['ct_pid']==$pslv1['ct_id']){echo 'active';} ?>" data-ctid="<?= $pslv1['ct_id'] ?>" data-ctname="<?= $pslv1['ct_name'] ?>" data-cticon="<?= $pslv1['ct_icon'] ?>">
                                                <div class="float-left wd-20 text-center display-table">
                                                    <div class="table-cell">
                                                        <img src="<?= $imgsrc ?>" alt="" class="img_ct_icon">
                                                    </div>
                                                </div>
                                                <div class="float-left wd-80 px-2"><?= $pslv1['ct_name'] ?></div>
                                            </div>
                                            <?
                                        }
                                    }
                                    ?>

                                </div>

                                <div class="margin-top-10">
                                    <button type="button" id="up_ele_lv1" class="btn_caret1 margin-left-10 margin-right-4" onclick="up_ele_lv1()"><i class="fa fa-caret-up"></i></button>
                                    <button type="button" id="down_ele_lv1" class="btn_caret1 margin-right-4" onclick="down_ele_lv1()"><i class="fa fa-caret-down"></i></button>
                                    <button type="button" class="btn_txt1 margin-right-4" data-toggle="modal" data-target="#form_add_cate1">추가</button>
                                    <button type="button" id="btn_mod_lv1" class="btn_txt1 margin-right-4" data-toggle="modal" data-target="#form_mod_cate1">수정</button>
                                    <button type="button" id="btn_del_lv1" class="btn_txt1">삭제</button>
                                </div>

                                <div class="modal fade" id="form_add_cate1" tabindex="-1" aria-labelledby="form_add_cate1Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content p-3">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs_20 fs_lg_16 fs_sm_14" id="form_add_cate1Label">1차 카테고리 추가</h5>
                                                <button type="button" class="close align-self-center" data-dismiss="modal" aria-label="Close">
                                                    <span><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body fs_15 fs_lg_14 fs_sm_12 fc_aaa fw_mideum">
                                                <form class="wd-100" id="form1" action="category_domestic_update.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="w" id="w_lv1" value="">
                                                    <input type="hidden" name="ct_id" id="ct_id_lv1" value="">
                                                    <input type="hidden" name="ct_level" id="ct_level_lv1" value="1">
                                                    <table cellspacing="0" cellpadding="0" class="wd-100">
                                                        <tr>
                                                            <td class="wd-40 py-2 bg-eee text-center">카테고리명</td>
                                                            <td class="wd-60 py-2 px-2"><input type="text" id="ct_name_lv1" name="ct_name" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 bg-eee text-center">아이콘</td>
                                                            <td class="py-2 px-2"><input type="file" id="ct_icon_lv1" name="ct_icon"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-2 text-right" colspan="2">
                                                                <input type="submit" value="저장" class="btn btn-sm btn-success">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-lg btn-block btn_blue btn_sm_blue fs_18 fs_lg_16 fs_sm_14 text-white fw_medium">확인</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="form_mod_cate1" tabindex="-1" aria-labelledby="form_mod_cate1Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content p-3">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs_20 fs_lg_16 fs_sm_14" id="form_mod_cate1Label">1차 카테고리 수정</h5>
                                                <button type="button" class="close align-self-center" data-dismiss="modal" aria-label="Close">
                                                    <span><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body fs_15 fs_lg_14 fs_sm_12 fc_aaa fw_mideum">
                                                <form class="wd-100" id="form2" action="category_domestic_update.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="w" id="w_lv1" value="u">
                                                    <input type="hidden" name="ct_id" id="ct_id_lv1" value="">
                                                    <input type="hidden" name="ct_level" id="ct_level_lv1" value="1">
                                                    <table cellspacing="0" cellpadding="0" class="wd-100">
                                                        <tr>
                                                            <td class="wd-40 py-2 bg-eee text-center">카테고리명</td>
                                                            <td class="wd-60 py-2 px-2"><input type="text" id="ct_name_lv1" name="ct_name" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 bg-eee text-center">아이콘</td>
                                                            <td class="py-2 px-2"><input type="file" id="ct_icon_lv1" name="ct_icon"></td>
                                                        </tr>
                                                        <tr class="tr_iconview">
                                                            <td class="py-2 bg-eee text-center">아이콘 미리보기</td>
                                                            <td class="py-2 px-2 td_iconview"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-2 text-right" colspan="2">
                                                                <input type="submit" value="저장" class="btn btn-sm btn-success">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-lg btn-block btn_blue btn_sm_blue fs_18 fs_lg_16 fs_sm_14 text-white fw_medium">확인</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="wd-40 float-left wrap_cate">
                                <div class="margin-bottom-10">2차 카테고리</div>
                                <div id="wrap_list_lv2" class="border-1-ccc"></div>

                                <div class="margin-top-10">
                                    <button type="button" id="up_ele_lv2" class="btn_caret1 margin-left-10 margin-right-4" onclick="up_ele_lv2()"><i class="fa fa-caret-up"></i></button>
                                    <button type="button" id="down_ele_lv2" class="btn_caret1 margin-right-4" onclick="down_ele_lv2()"><i class="fa fa-caret-down"></i></button>
                                    <button type="button" class="btn_txt1 margin-right-4" data-toggle="modal" data-target="#form_add_cate2">추가</button>
                                    <button type="button" id="btn_mod_lv2" class="btn_txt1 margin-right-4" data-toggle="modal" data-target="#form_mod_cate2">수정</button>
                                    <button type="button" id="btn_del_lv2" class="btn_txt1">삭제</button>
                                </div>

                                <div class="modal fade" id="form_add_cate2" tabindex="-1" aria-labelledby="form_add_cate2Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content p-3">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs_20 fs_lg_16 fs_sm_14" id="form_add_cate2Label">2차 카테고리 추가</h5>
                                                <button type="button" class="close align-self-center" data-dismiss="modal" aria-label="Close">
                                                    <span><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body fs_15 fs_lg_14 fs_sm_12 fc_aaa fw_mideum">
                                                <form class="wd-100" id="form3" action="category_domestic_update.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="w" id="w_lv2" value="">
                                                    <input type="hidden" name="ct_id" id="ct_id_lv2" value="">
                                                    <input type="hidden" name="ct_level" id="ct_level_lv2" value="2">
                                                    <input type="hidden" name="ct_pid" id="ct_pid_lv2" value="">
                                                    <table cellspacing="0" cellpadding="0" class="wd-100">
                                                        <tr>
                                                            <td class="py-2 bg-eee text-center">분류번호</td>
                                                            <td class="py-2 px-2"><input type="number" id="ct_catenum_lv2" name="ct_catenum"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="wd-40 py-2 bg-eee text-center">카테고리명</td>
                                                            <td class="wd-60 py-2 px-2"><input type="text" id="ct_name_lv2" name="ct_name"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-2 text-right" colspan="2">
                                                                <input type="submit" value="저장" class="btn btn-sm btn-success">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-lg btn-block btn_blue btn_sm_blue fs_18 fs_lg_16 fs_sm_14 text-white fw_medium">확인</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="form_mod_cate2" tabindex="-1" aria-labelledby="form_mod_cate2Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content p-3">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs_20 fs_lg_16 fs_sm_14" id="form_mod_cate2Label">2차 카테고리 추가</h5>
                                                <button type="button" class="close align-self-center" data-dismiss="modal" aria-label="Close">
                                                    <span><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body fs_15 fs_lg_14 fs_sm_12 fc_aaa fw_mideum">
                                                <form class="wd-100" id="form4" action="category_domestic_update.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="w" id="w_lv2" value="u">
                                                    <input type="hidden" name="ct_id" id="ct_id_lv2" value="">
                                                    <input type="hidden" name="ct_level" id="ct_level_lv2" value="2">
                                                    <input type="hidden" name="ct_pid" id="ct_pid_lv2" value="">
                                                    <table cellspacing="0" cellpadding="0" class="wd-100">
                                                        <tr>
                                                            <td class="py-2 bg-eee text-center">분류번호</td>
                                                            <td class="py-2 px-2"><input type="number" id="ct_catenum_lv2" name="ct_catenum"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="wd-40 py-2 bg-eee text-center">카테고리명</td>
                                                            <td class="wd-60 py-2 px-2"><input type="text" id="ct_name_lv2" name="ct_name"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 px-2 text-right" colspan="2">
                                                                <input type="submit" value="저장" class="btn btn-sm btn-success">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-lg btn-block btn_blue btn_sm_blue fs_18 fs_lg_16 fs_sm_14 text-white fw_medium">확인</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function get_wrap_list_lv2(pid){
        $.ajax({
            type: "POST",
            url: "../get_ajax.php",
            data: {
                mode:'get_wrap_list_lv2',
                ct_pid:pid,
            },
            cache: false,
            success: function(data){
                console.log(data);
                $("#wrap_list_lv2").html(data);

                $(".ele_cate2").on("click", function (){
                    var ctid = $(this).attr("data-ctid");
                    var ctname = $(this).attr("data-ctname");
                    var catenum = $(this).attr("data-catenum");

                    $(".ele_cate2").removeClass("active");
                    $(this).addClass("active");

                    $("#form4 #ct_id_lv2").val(ctid);
                    $("#form4 #ct_name_lv2").val(ctname);
                    $("#form4 #ct_catenum_lv2").val(catenum);

                    $("#btn_mod_lv2").show();
                    $("#btn_del_lv2").show();
                    $("#up_ele_lv2").show();
                    $("#down_ele_lv2").show();
                });

            }
        });
    }

    $(".ele_cate1").on("click", function (){
        var ctid = $(this).attr("data-ctid");
        var ctname = $(this).attr("data-ctname");
        var cticon = $(this).attr("data-cticon");
        var cticon_src = "../data/app_domestic/"+cticon;

        $(".ele_cate1").removeClass("active");
        $(this).addClass("active");

        $("#form2 #ct_id_lv1").val(ctid);
        $("#form2 #ct_name_lv1").val(ctname);

        $("#form3 #ct_pid_lv2").val(ctid);
        $("#form4 #ct_pid_lv2").val(ctid);

        if(cticon!=""){
            $(".tr_iconview").show();
            $(".td_iconview").html('<img src="'+cticon_src+'" alt="" class="wd-100">');

        }else{
            $(".tr_iconview").hide();
            $(".td_iconview").html('');
        }

        get_wrap_list_lv2(ctid);

        $("#up_ele_lv1").show();
        $("#down_ele_lv1").show();
        $("#btn_mod_lv1").show();
        $("#btn_del_lv1").show();

    });


    $("#btn_del_lv1").on("click",function (){
        if(confirm("선택하신 카테고리를 삭제하시겠습니까? 해당 카테고리의 자료가 남아있는지 확인 부탁드립니다.")){
            var ctid = $("#form2 #ct_id_lv1").val();
            var catelv = $("#form2 #ct_name_lv1").val();
            del_cate1(catelv,ctid);
        }
    });
    $("#btn_del_lv2").on("click",function (){
        if(confirm("선택하신 카테고리를 삭제하시겠습니까? 해당 카테고리의 자료가 남아있는지 확인 부탁드립니다.")){
            var ctid = $("#form4 #ct_id_lv2").val();
            var catelv = $("#form4 #ct_name_lv2").val();
            del_cate1(catelv,ctid);
        }
    });

    function up_ele_lv1(){
        $("#up_ele_lv1").attr("disabled",true);
        var ct_id = $("#form2 #ct_id_lv1").val();
        up_ele_cate(1,ct_id);
    }
    function down_ele_lv1(){
        $("#down_ele_lv1").attr("disabled",true);
        var ct_id = $("#form2 #ct_id_lv1").val();
        down_ele_cate(1,ct_id);
    }

    function up_ele_lv2(){
        $("#up_ele_lv2").attr("disabled",true);
        var ct_id = $("#form4 #ct_id_lv2").val();
        var ct_pid = $("#form4 #ct_pid_lv2").val();
        up_ele_cate(2,ct_id,ct_pid);
    }
    function down_ele_lv2(){
        $("#down_ele_lv2").attr("disabled",true);
        var ct_id = $("#form4 #ct_id_lv2").val();
        var ct_pid = $("#form4 #ct_pid_lv2").val();
        down_ele_cate(2,ct_id,ct_pid);
    }

    $(function (){

        <?
        if ($_GET['ct_pid']) {
        ?>
        $(".ele_cate1.active").click();
        <?
        }else{
        ?>
        $("#up_ele_lv1").hide();
        $("#down_ele_lv1").hide();
        $("#btn_mod_lv1").hide();
        $("#btn_del_lv1").hide();
        <?
        }
        ?>

        $("#btn_mod_lv2").hide();
        $("#btn_del_lv2").hide();
        $("#up_ele_lv2").hide();
        $("#down_ele_lv2").hide();
    });
</script>
<?

include "./foot_inc.php";
?>
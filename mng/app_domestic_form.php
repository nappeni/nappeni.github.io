<?php
include "./head_inc.php";
$chk_menu = '1';
$chk_sub_menu = '1';
include "./head_menu_inc.php";

$app_idx = $_GET['app_idx'];

$qstr = "app_status=".$_GET['app_status'];
if($_GET['stx_dt1']){ $qstr .= "&stx_dt1=".$_GET['stx_dt1']; }
if($_GET['stx_dt2']){ $qstr .= "&stx_dt2=".$_GET['stx_dt2']; }
if($_GET['stx']){
    $qstr .= "&sfl=".$_GET['sfl'];
    $qstr .= "&stx=".$_GET['stx'];
}
$qstr .= "&pg=".$_GET['pg'];

if($_GET['tabnum1']){ $tabnum1=$_GET['tabnum1']; }else{ $tabnum1=1; }
if($_GET['tabnum2']){ $tabnum2=$_GET['tabnum2']; }else{ $tabnum2=1; }

$sql = "select * from d_app_domestic where idx = '{$app_idx}' ";
$dad = $DB->fetch_assoc($sql);

$sql = "select * from member_t where idx = '{$dad['mt_idx']}' ";
$mta = $DB->fetch_assoc($sql);

$sql = "select dadi.cate_ps2, dadi.cate_s, cp1.ct_catenum, cp1.ct_name from d_app_domestic_item dadi left join cate_ps1 cp1 on dadi.cate_ps2 = cp1.ct_id where dadi.app_idx = '{$app_idx}' order by cp1.ct_catenum ";
$dadi_list = $DB->select_query($sql);

$sql = "select count(*) as cnt from d_app_domestic_item where app_idx = '{$app_idx}' and d_status > 3 ";
$dadi2 = $DB->fetch_assoc($sql);

if($tabnum1==3){
    $pg2 = $_GET['pg2'];
    $n_limit_num = 8;
    $n_limit = $n_limit_num;

    $qstr2 = "app_idx=".$app_idx."&".$qstr;
    $qstr2 .= "&tabnum1=".$tabnum1;
    $qstr2 .= "&pg2=";

    $sql_count = " select count(*) as cnt from d_app_domestic_history where app_idx = '{$app_idx}' order by idx desc ";
    $row_cnt = $DB->fetch_assoc($sql_count);
    $total_count = $row_cnt['cnt'];
    $n_page = ceil($total_count / $n_limit_num);
    if($pg2=="") $pg2 = 1;
    $n_from = ($pg2 - 1) * $n_limit;

    $sql = "select * from d_app_domestic_history where app_idx = '{$app_idx}' order by idx desc limit ".$n_from.", ".$n_limit;
    $history_list = $DB->select_query($sql);
}
?>
<style>
    .jm-tab1:nth-child(2), .jm-tab1:nth-child(3){
        border-left: none;
    }
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">국내 출원 관리 상세보기</h4>

                    <div class="flex margin-bottom-10">
                        <div class="jm-tab1 <? if($tabnum1==1){echo "active";} ?>" onclick="gourl('?app_idx=<?= $app_idx ?>&<?= $qstr ?>&tabnum1=1')">출원 상표 정보</div>
                        <div class="jm-tab1 <? if($tabnum1==2){echo "active";} ?>" onclick="gourl('?app_idx=<?= $app_idx ?>&<?= $qstr ?>&tabnum1=2')">출원준비</div>
                        <div class="jm-tab1 <? if($tabnum1==3){echo "active";} ?>" onclick="gourl('?app_idx=<?= $app_idx ?>&<?= $qstr ?>&tabnum1=3')">업무처리 내역</div>
                    </div>

                    <div class="flex margin-bottom-10 wd-100">
                        <div class="font-16 display-table" style="height: 40px;">
                            <div class="table-cell">접수번호 : <?= $dad['code1'] ?></div>
                        </div>
                        <div class="margin-left-auto">
                            <input type="button" value="목록" onclick="click_golist()" class="btn btn-secondary" />
                            <?
                            if($tabnum1==1 && $tabnum2!=1){
                                ?><input type="button" class="btn btn-primary" value="저장하기" onclick="submit_form1()"><?
                            }else if($tabnum1==2){
                                ?><input type="button" class="btn btn-primary" value="저장하기" onclick="submit_form1()"><?
                            }
                            ?>


                        </div>
                    </div>

                    <? if($tabnum1==1){ ?>
                    <div class="flex margin-bottom-20 wd-100">
                        <div class="jm-tab2 <? if($tabnum2==1){echo "active";} ?>" onclick="gourl('?app_idx=<?= $app_idx ?>&<?= $qstr ?>&tabnum1=<?= $tabnum1 ?>&tabnum2=1')">회원 및 상표 정보</div>
                        <div class="jm-tab2 <? if($tabnum2==2){echo "active";} ?>" onclick="gourl('?app_idx=<?= $app_idx ?>&<?= $qstr ?>&tabnum1=<?= $tabnum1 ?>&tabnum2=2')">출원인 정보</div>
                        <div class="jm-tab2 <? if($tabnum2==3){echo "active";} ?>" onclick="gourl('?app_idx=<?= $app_idx ?>&<?= $qstr ?>&tabnum1=<?= $tabnum1 ?>&tabnum2=3')">담당자 정보</div>
                        <? if($dad['chk_agent']=="Y"){ ?>
                        <div class="jm-tab2 <? if($tabnum2==4){echo "active";} ?>" onclick="gourl('?app_idx=<?= $app_idx ?>&<?= $qstr ?>&tabnum1=<?= $tabnum1 ?>&tabnum2=4')">법정 대리인 정보</div>
                        <? } ?>
                    </div>
                    <? } ?>

                    <div class="view-scroll-y" style="height: 550px;">
                        <form method="post" name="form1" id="form1" action="./app_domestic_form_update.php" enctype="multipart/form-data">
                            <input type="hidden" name="app_idx" id="app_idx" value="<?= $dad['idx'] ?>" />
                            <input type="hidden" name="qstr" id="qstr" value="<?= $qstr ?>" />
                            <input type="hidden" name="tabnum1" id="tabnum1" value="<?= $tabnum1 ?>" />
                            <input type="hidden" name="tabnum2" id="tabnum2" value="<?= $tabnum2 ?>" />

                            <?
                            if($tabnum1==1 && $tabnum2==1){
                                ?>
                                <table cellpadding="0" cellspacing="0" class="wd-100 font-14">
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">이름</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['mt_name'] ?></td>
                                        <th class="jm_th1 wd-15 py-3">아이디</th>
                                        <td class="wd-35 py-3 px-3"><?= $mta['mt_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">상표 유형</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <?
                                            if($dad['cate_mark']==1){ echo "문자 상표"; }
                                            else if($dad['cate_mark']==2){ echo "도형 상표"; }
                                            else if($dad['cate_mark']==3){ echo "복합 상표"; }
                                            else if($dad['cate_mark']==4){ echo "기타"; }
                                            ?>
                                        </td>
                                    </tr>

                                    <? if($dad['name_mark']){ ?>
                                        <tr>
                                            <th class="wd-15 bg-eee text-center py-3">상표명</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <? echo $dad['name_mark']; ?>
                                            </td>
                                        </tr>
                                    <? } ?>

                                    <? if($dad['img_mark']){ ?>
                                        <tr>
                                            <th class="wd-15 bg-eee text-center py-3">상표 이미지</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <a href="../data/app_domestic/<?= $dad['img_mark']; ?>" target="_blank"><img src="../data/app_domestic/<?= $dad['img_mark']; ?>" alt="" class="wd-60"></a>
                                            </td>
                                        </tr>
                                    <? } ?>

                                    <tr>
                                        <th class="wd-15 bg-eee text-center py-3">상표 사용 유무</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <? echo $dad['chk_use1']; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="wd-15 bg-eee text-center py-3">제품 및 서비스 설명</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <? echo $dad['txt_ps']; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="wd-15 bg-eee text-center py-3">쇼핑몰 링크</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <a href="<? echo $dad['link_shop']; ?>" target="_blank"><? echo $dad['link_shop']; ?></a>
                                        </td>
                                    </tr>

                                </table>

                                <?
                                if(count($dadi_list)>0){
                                    $rownum_dadi = 1;
                                    ?>
                                    <table cellpadding="0" cellspacing="0" class="wd-100 font-14 margin-top-30">
                                        <tr class="bg-eee">
                                            <th class="py-3 px-3 text-center wd-20">번호</th>
                                            <th class="py-3 px-3 text-center wd-30">상품류</th>
                                            <th class="py-3 px-3 text-center">상품류명</th>
                                            <th class="py-3 px-3 text-center">서비스 유형</th>
                                        </tr>
                                        <?
                                        foreach ($dadi_list as $dadi){
                                            $sql = "select * from service_domestic where idx = '{$dadi['cate_s']}' ";
                                            $sd = $DB->fetch_assoc($sql);
                                            ?>
                                            <tr>
                                                <td class="py-3 px-3 text-center"><?= $rownum_dadi ?></td>
                                                <td class="py-3 px-3 text-center"><? echo "제".$dadi['ct_catenum']."류"; ?></td>
                                                <td class="py-3 px-3 text-center"><?= $dadi['ct_name'] ?></td>
                                                <td class="py-3 px-3 text-center"><?= $sd['s_name'] ?></td>
                                            </tr>
                                            <?
                                            $rownum_dadi++;
                                        }
                                        ?>
                                    </table>
                                    <?
                                }
                                ?>
                                <?
                            }
                            ?>

                            <?
                            if($tabnum1==1 && $tabnum2==2){
                                ?>
                                <table cellpadding="0" cellspacing="0" class="wd-100 font-14">
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">출원인명(국문)</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['applicant_name_k'] ?></td>
                                        <th class="jm_th1 wd-15 py-3">출원인명(영문)</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['applicant_name_e'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">출원유형</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <?
                                            if($dad['type_applicant']==1){ echo "국내개인"; }
                                            else if($dad['type_applicant']==2){ echo "국내법인"; }
                                            else if($dad['type_applicant']==3){ echo "외국개인"; }
                                            else if($dad['type_applicant']==4){ echo "외국법인"; }
                                            else if($dad['type_applicant']==5){ echo "국가기관"; }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">출원인코드</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <input type="text" name="code_applicant" id="code_applicant" class="form-control form-control-sm" placeholder="출원인 코드 입력" value="<?= $dad['code_applicant'] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">출원인 주민 등록번호</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <?= $dad['applicant_jumin'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">출원인 이메일</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <?= $dad['applicant_email'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">출원인 휴대전화</th>
                                        <td class="wd-35 py-3 px-3"><?= format_phone($dad['applicant_hp']) ?></td>
                                        <th class="jm_th1 wd-15 py-3">출원인 유선전화</th>
                                        <td class="wd-35 py-3 px-3"><?= format_phone($dad['applicant_tel']) ?></td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">출원인 등본상 주소</th>
                                        <td colspan="3" class="py-3 px-3">
                                            (<?= $dad['applicant_addr1'] ?>) <?= $dad['applicant_addr2'] ?> <?= $dad['applicant_addr3'] ?>
                                        </td>
                                    </tr>

                                    <? if($dad['type_applicant']==1){ ?>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">공동출원 여부</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <?= $dad['chk_info2'] ?>
                                        </td>
                                    </tr>
                                    <? } ?>

                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">파일 업로드 (관리자용)</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <input type="file" name="applicant_file1" class="form-control form-control-sm">
                                            <input type="file" name="applicant_file2" class="form-control form-control-sm">
                                            <input type="file" name="applicant_file3" class="form-control form-control-sm">
                                            <div class="margin-top-10">
                                                <ul>
                                                    <? if($dad['applicant_file1']){ ?><li><a href="../data/app_domestic/<?= $dad['applicant_file1'] ?>" target="_blank"><?= $dad['applicant_file_origin1'] ?></a></li><? } ?>
                                                    <? if($dad['applicant_file2']){ ?><li><a href="../data/app_domestic/<?= $dad['applicant_file2'] ?>" target="_blank"><?= $dad['applicant_file_origin2'] ?></a></li><? } ?>
                                                    <? if($dad['applicant_file3']){ ?><li><a href="../data/app_domestic/<?= $dad['applicant_file3'] ?>" target="_blank"><?= $dad['applicant_file_origin3'] ?></a></li><? } ?>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">비고</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <textarea name="memo1" id="memo1" class="form-control form-control-sm" rows="8" placeholder="텍스트 입력"><?= strip_tags($dad['memo1']) ?></textarea>
                                        </td>
                                    </tr>

                                </table>
                                <?
                            }
                            ?>

                            <?
                            if($tabnum1==1 && $tabnum2==3){
                                ?>
                                <table cellpadding="0" cellspacing="0" class="wd-100 font-14">
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">담당자명</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['mt_name'] ?></td>
                                        <th class="jm_th1 wd-15 py-3">담당자 이메일</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['mt_email'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">담당자 휴대전화</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['mt_hp'] ?></td>
                                        <th class="jm_th1 wd-15 py-3">담당자 유선전화</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['mt_tel'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">비고</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <textarea name="memo2" id="memo2" class="form-control form-control-sm" rows="8" placeholder="텍스트 입력"><?= strip_tags($dad['memo2']) ?></textarea>
                                        </td>
                                    </tr>
                                </table>
                                <?
                            }
                            ?>

                            <?
                            if($tabnum1==1 && $tabnum2==4){
                                ?>
                                <table cellpadding="0" cellspacing="0" class="wd-100 font-14">
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">법정 대리인 필요 여부</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <?= $dad['chk_agent'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">법정 대리인명(국문)</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['agent_name_k'] ?></td>
                                        <th class="jm_th1 wd-15 py-3">법정 대리인명(영문)</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['agent_name_e'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">법정 대리인 주민 등록번호</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['agent_jumin'] ?></td>
                                        <th class="jm_th1 wd-15 py-3">법정 대리인 이메일</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['agent_email'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">법정 대리인 휴대전화</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['agent_hp'] ?></td>
                                        <th class="jm_th1 wd-15 py-3">법정 대리인 유선전화</th>
                                        <td class="wd-35 py-3 px-3"><?= $dad['agent_tel'] ?></td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">법정 대리인 주소</th>
                                        <td colspan="3" class="py-3 px-3">
                                            (<?= $dad['agent_addr1'] ?>) <?= $dad['agent_addr2'] ?> <?= $dad['agent_addr3'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">주민등록등본</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <a href="../data/app_domestic/<?= $dad['agent_file'] ?>" target="_blank"><?= $dad['agent_file_origin'] ?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">법정대리인 위임장 동의 여부</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <?= $dad['chk_agree_agent'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="jm_th1 wd-15 py-3">법정 대리인 출원인 코드</th>
                                        <td colspan="3" class="py-3 px-3">
                                            <input type="text" name="agent_applicant_code" id="agent_applicant_code" class="form-control form-control-sm" placeholder="법정 대리인 출원인 코드 입력" value="<?= $dad['agent_applicant_code'] ?>" maxlength="255">
                                        </td>
                                    </tr>

                                </table>
                                <?
                            }
                            ?>

                            <?
                            if($tabnum1==2){
                                ?>
                            <table cellpadding="0" cellspacing="0" class="wd-100 font-14">
                                <tr>
                                    <th class="jm_th1 wd-15 py-3">진행 상태</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <div class="flex">
                                            <div class="mx-2">
                                                <input type="radio" name="app_status" id="app_status1" value="1" <? if($dad['app_status']==1){echo 'checked';} ?> >
                                                <label class="ml-1" for="app_status1">접수</label>
                                            </div>
                                            <div class="mx-2">
                                                <input type="radio" name="app_status" id="app_status2" value="2" <? if($dad['app_status']==2){echo 'checked';} ?> >
                                                <label class="ml-1" for="app_status2">접수 완료</label>
                                            </div>
                                            <div class="mx-2">
                                                <input type="radio" name="app_status" id="app_status3" value="3" <? if($dad['app_status']==3){echo 'checked';} ?> >
                                                <label class="ml-1" for="app_status3">출원준비-1차 수정요청</label>
                                            </div>
                                            <div class="mx-2">
                                                <input type="radio" name="app_status" id="app_status4" value="4" <? if($dad['app_status']==4){echo 'checked';} ?> >
                                                <label class="ml-1" for="app_status4">출원준비-2차 수정요청</label>
                                            </div>
                                            <div class="mx-2">
                                                <input type="radio" name="app_status" id="app_status5" value="5" <? if($dad['app_status']==5){echo 'checked';} ?> >
                                                <label class="ml-1" for="app_status5">출원준비-3차 수정요청</label>
                                            </div>
                                            <div class="mx-2">
                                                <input type="radio" name="app_status" id="app_status8" value="8" <? if($dad['app_status']==8){echo 'checked';} ?> >
                                                <label class="ml-1" for="app_status8">출원대기</label>
                                            </div>
                                            <div class="mx-2">
                                                <input type="radio" name="app_status" id="app_status6" value="6" <? if($dad['app_status']==6){echo 'checked';} ?> >
                                                <label class="ml-1" for="app_status6">출원완료</label>
                                            </div>
                                            <div class="mx-2">
                                                <input type="radio" name="app_status" id="app_status7" value="7" <? if($dad['app_status']==7){echo 'checked';} ?> >
                                                <label class="ml-1" for="app_status7">출원취소</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="d-show-stat d-show-stat2">
                                    <th class="jm_th1 wd-15 py-3">1차 보고서 첨부</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <input type="file" name="report_ver1" class="form-control form-control-sm">
                                        <? if($dad['report_ver1']){ ?>
                                        <div class="margin-top-10">
                                            <ul>
                                                <li>
                                                    <a href="../data/app_domestic/<?= $dad['report_ver1'] ?>" target="_blank" download="<?= $dad['report_ver1_origin'] ?>"><?= $dad['report_ver1_origin'] ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <? } ?>
                                    </td>
                                </tr>
                                <tr class="d-show-stat d-show-stat3">
                                    <th class="jm_th1 wd-15 py-3">2차 보고서 첨부</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <input type="file" name="report_ver2" class="form-control form-control-sm">
                                        <? if($dad['report_ver2']){ ?>
                                            <div class="margin-top-10">
                                                <ul>
                                                    <li>
                                                        <a href="../data/app_domestic/<?= $dad['report_ver2'] ?>" target="_blank" download="<?= $dad['report_ver2_origin'] ?>"><?= $dad['report_ver2_origin'] ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <? } ?>
                                    </td>
                                </tr>
                                <tr class="d-show-stat d-show-stat4">
                                    <th class="jm_th1 wd-15 py-3">3차 보고서 첨부</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <input type="file" name="report_ver3" class="form-control form-control-sm">
                                        <? if($dad['report_ver3']){ ?>
                                            <div class="margin-top-10">
                                                <ul>
                                                    <li>
                                                        <a href="../data/app_domestic/<?= $dad['report_ver3'] ?>" target="_blank" download="<?= $dad['report_ver3_origin'] ?>"><?= $dad['report_ver3_origin'] ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <? } ?>
                                    </td>
                                </tr>
                                <tr class="d-show-stat d-show-stat2">
                                    <th class="jm_th1 wd-15 py-3">지정상품</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <input type="text" name="pr_designated" id="pr_designated" class="form-control form-control-sm" placeholder="지정상품들 입력 ( ' , ' 로 구분 ) " value="<?= strip_tags($dad['pr_designated']) ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="jm_th1 wd-15 py-3">메모</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <textarea name="memo3" id="memo3" class="form-control form-control-sm" rows="8" placeholder="참고사항 입력"><?= strip_tags($dad['memo3']) ?></textarea>
                                    </td>
                                </tr>

                                <tr class="d-show-stat d-show-stat2">
                                    <th class="jm_th1 wd-15 py-3">추가상품 발생</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <div class="flex">
                                            <div class="mx-2">
                                                <input type="radio" name="chk_pr_add" id="chk_pr_add1" value="Y" <? if($dad['chk_pr_add']=="Y"){echo 'checked';} ?> >
                                                <label class="ml-1" for="chk_pr_add1">예, 지정상품이 20개 이상입니다.</label>
                                            </div>
                                            <div class="mx-2">
                                                <input type="radio" name="chk_pr_add" id="chk_pr_add2" value="N" <? if($dad['chk_pr_add']=="N"){echo 'checked';} ?> >
                                                <label class="ml-1" for="chk_pr_add2">아니오, 지정상품이 1개에서 20개 이내입니다.</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="d-show-stat d-show-stat2">
                                    <th class="jm_th1 wd-15 py-3">총 지정상품 수</th>
                                    <td class="py-3 px-3">
                                        <input type="number" name="cnt_pr_designated" id="cnt_pr_designated" class="form-control form-control-sm wd-35 d-inline-block" style="min-width: 90px;" value="<?= $dad['cnt_pr_designated'] ?>">
                                        <input type="button" value="적용하기" class="btn btn-secondary d-inline-block" onclick="regist_cnt_pr_designated()">
                                    </td>
                                    <th class="jm_th1 wd-15 py-3">추가상품 수</th>
                                    <td class="py-3 px-3">
                                        <input type="number" name="cnt_pr_add" id="cnt_pr_add" class="form-control form-control-sm wd-35" style="min-width: 90px;" value="<?= $dad['cnt_pr_add'] ?>" placeholder="총 지정상품 수 - 20" readonly>
                                    </td>
                                </tr>
                                <tr class="d-show-stat d-show-stat2">
                                    <th class="jm_th1 wd-15 py-3">추가상품 금액</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <input type="hidden" name="price_pr_add3" id="price_pr_add3" class="form-control form-control-sm" value="<?= $dad['price_pr_add3'] ?>" placeholder="추가상품 특허청 관납료">
                                        <input type="hidden" name="price_pr_add2" id="price_pr_add2" class="form-control form-control-sm" value="<?= $dad['price_pr_add2'] ?>" placeholder="추가상품 VAT">
                                        <input type="hidden" name="price_pr_add1" id="price_pr_add1" class="form-control form-control-sm" value="<?= $dad['price_pr_add1'] ?>" placeholder="추가상품 금액">
                                        <div id="view_price_pr_add"><?= number_format($dad['price_pr_add1']) ?>원</div>
                                    </td>
                                </tr>
                                <tr class="d-show-stat d-show-stat7">
                                    <th class="jm_th1 wd-15 py-3">취소 사유 선택</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <select class="custom-select" name="reason_cancel" id="reason_cancel">
                                            <option value="">취소 사유 선택</option>
                                            <option value="출원인 개인적 사유 - 출원접수 전" <? if($dad['reason_cancel']=="출원인 개인적 사유 - 출원접수 전"){ echo "selected"; } ?> >출원인 개인적 사유 - 출원접수 전</option>
                                            <option value="출원인 개인적 사유 - 출원접수 후" <? if($dad['reason_cancel']=="출원인 개인적 사유 - 출원접수 후"){ echo "selected"; } ?> >출원인 개인적 사유 - 출원접수 후</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr class="d-show-stat d-show-stat3 d-show-stat4 d-show-stat5 d-show-stat8">
                                    <th class="jm_th1 wd-15 py-3">1차 수정 사항</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <?= $dad['txt_mod_ver1'] ?>
                                    </td>
                                </tr>
                                <tr class="d-show-stat d-show-stat3 d-show-stat4 d-show-stat5 d-show-stat8">
                                    <th class="jm_th1 wd-15 py-3">2차 수정 사항</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <?= $dad['txt_mod_ver2'] ?>
                                    </td>
                                </tr>
                                <tr class="d-show-stat d-show-stat3 d-show-stat4 d-show-stat5 d-show-stat8">
                                    <th class="jm_th1 wd-15 py-3">3차 수정 사항</th>
                                    <td colspan="3" class="py-3 px-3">
                                        <?= $dad['txt_mod_ver3'] ?>
                                    </td>
                                </tr>
                            </table>
                                <?
                            }
                            ?>

                            <?
                            if($tabnum1==3){
                                ?>
                                <table cellpadding="0" cellspacing="0" class="wd-100 font-14">
                                    <tr>
                                        <td class="jm_th1 py-3 px-3">진행 날짜</td>
                                        <td class="jm_th1 py-3 px-3">내용</td>
                                        <td class="jm_th1 py-3 px-3">보고서 첨부</td>
                                        <td class="jm_th1 py-3 px-3">결제 금액</td>
                                        <td class="jm_th1 py-3 px-3">결제 수단</td>
                                        <td class="jm_th1 py-3 px-3">결제 상태</td>
                                        <td class="jm_th1 py-3 px-3">관리</td>
                                    </tr>
                                    <?
                                    if(count($history_list)>0){
                                        $num_h = 1;
                                        foreach ($history_list as $rowh){
                                            ?>
                                            <tr>
                                                <td class="py-3 px-3 text-center"><?= $rowh['d_date'] ?></td>
                                                <td class="py-3 px-3 text-center"><?= $rowh['d_content'] ?></td>
                                                <td class="py-3 px-3 text-center">
                                                    <?
                                                    if($rowh['d_content_file1']){
                                                        ?>
                                                        <a href="../data/app_domestic/<?= $dad['report_ver1'] ?>" download="<?= $rowh['d_content_file1'] ?>">1차 보고서</a>
                                                        <?
                                                    }else if($rowh['d_content_file2']){
                                                        ?>
                                                        <a href="../data/app_domestic/<?= $dad['report_ver2'] ?>" download="<?= $rowh['d_content_file2'] ?>">2차 보고서</a>
                                                        <?
                                                    }else if($rowh['d_content_file3']){
                                                        ?>
                                                        <a href="../data/app_domestic/<?= $dad['report_ver3'] ?>" download="<?= $rowh['d_content_file3'] ?>">3차 보고서</a>
                                                        <?
                                                    }
                                                    ?>
                                                </td>
                                                <td class="py-3 px-3 text-center"><?= $rowh['d_price'] ?></td>
                                                <td class="py-3 px-3 text-center"><?= $rowh['d_pay_method'] ?></td>
                                                <td class="py-3 px-3 text-center"><?= $rowh['d_pay_status'] ?></td>
                                                <td class="py-3 px-3 text-center">
                                                    <?
                                                    if($num_h==1 && $dadi2['cnt']<1 && strpos("a".$rowh['d_content'],"접수 완료")==false){
                                                        //
                                                        ?>
                                                        <input type="button" value="삭제" class="btn btn-sm btn-danger" onclick="del_dadh('<?= $rowh['idx'] ?>','<?= $app_idx ?>')">
                                                        <?
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?
                                            $num_h++;
                                        }
                                    }else{
                                        ?>
                                        <tr>
                                            <td colspan="7" class="py-3 px-3 text-center">업무 처리 내역이 없습니다.</td>
                                        </tr>
                                        <?
                                    }
                                    ?>
                                </table>
                                <div class="wrap_pagination">
                                    <?
                                    if($n_page>0) {
                                        echo page_listing2($pg2, $n_page, $_SERVER['PHP_SELF']."?".$qstr2);
                                    }
                                    ?>
                                </div>
                                <script>
                                    const del_dadh = (h_idx,app_idx) =>{
                                        if("해당 내역을 삭제하시겠습니까?"){
                                            $.ajax({
                                                type: "POST",
                                                url: hostname + "/get_ajax.php",
                                                data: {
                                                    mode:'del_dadh',
                                                    h_idx:h_idx,
                                                    app_idx:app_idx,
                                                },
                                                cache: false,
                                                success: function(data){
                                                    console.log(data);
                                                    location.reload();
                                                }
                                            });
                                        }
                                    }
                                </script>
                                <?
                            }
                            ?>



                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function regist_cnt_pr_designated(){
        var cnt_pr_designated = $("#cnt_pr_designated").val();
        var cnt_pr_add = cnt_pr_designated - 20;
        if(cnt_pr_add<0){ cnt_pr_add = 0; }
        var price_pr_add2 = cnt_pr_add*1100;
        var price_pr_add3 = cnt_pr_add*2000;
        var price_pr_add1 = price_pr_add2+price_pr_add3;
        $("#cnt_pr_add").val(cnt_pr_add);
        $("#price_pr_add1").val(price_pr_add1);
        $("#price_pr_add2").val(price_pr_add2);
        $("#price_pr_add3").val(price_pr_add3);
        $("#view_price_pr_add").html(addComma(price_pr_add1)+"원");
    }
    function click_golist(){
        if(confirm("정말 저장 없이 전 페이지로 돌아가시겠습니까?")){
            location.href = "./app_domestic_list.php?<?=$qstr?>";
        }
    }

    $("input[name=app_status]").on("change",function (){
        var app_stat = Number($(this).val());
        if(app_stat==1){
            $(".d-show-stat").hide();
            $(".d-show-stat1").show();
        }else if(app_stat==2){
            $(".d-show-stat").hide();
            $(".d-show-stat2").show();
        }else if(app_stat==3){
            $(".d-show-stat").hide();
            $(".d-show-stat3").show();
        }else if(app_stat==4){
            $(".d-show-stat").hide();
            $(".d-show-stat4").show();
        }else if(app_stat==5){
            $(".d-show-stat").hide();
            $(".d-show-stat5").show();
        }else if(app_stat==6){
            $(".d-show-stat").hide();
            $(".d-show-stat6").show();
        }else if(app_stat==7){
            $(".d-show-stat").hide();
            $(".d-show-stat7").show();
        }else if(app_stat==8){
            $(".d-show-stat").hide();
            $(".d-show-stat8").show();
        }
    });

    $(function (){
        var app_stat = Number("<?=  $dad['app_status']  ?>");
        if(app_stat==1){
            $(".d-show-stat").hide();
            $(".d-show-stat1").show();
        }else if(app_stat==2){
            $(".d-show-stat").hide();
            $(".d-show-stat2").show();
        }else if(app_stat==3){
            $(".d-show-stat").hide();
            $(".d-show-stat3").show();
        }else if(app_stat==4){
            $(".d-show-stat").hide();
            $(".d-show-stat4").show();
        }else if(app_stat==5){
            $(".d-show-stat").hide();
            $(".d-show-stat5").show();
        }else if(app_stat==6){
            $(".d-show-stat").hide();
            $(".d-show-stat6").show();
        }else if(app_stat==7){
            $(".d-show-stat").hide();
            $(".d-show-stat7").show();
        }else if(app_stat==8){
            $(".d-show-stat").hide();
            $(".d-show-stat8").show();
        }
    });
</script>
<?
include "./foot_inc.php";
?>

<?php
include "./head_inc.php";
$chk_menu = '1';
$chk_sub_menu = '2';
include "./head_menu_inc.php";
$n_limit_num = 15;
$n_limit = $n_limit_num;
$pg = $_GET['pg'];

$idx = $_GET['idx'];
$sql = "select * from d_app_domestic_item where idx = '{$idx}' ";
$dadi = $DB->fetch_assoc($sql);
$app_idx = $dadi['app_idx'];

$sql = "select * from d_app_domestic where idx = '{$app_idx}' ";
$dad = $DB->fetch_assoc($sql);

$sql = "select * from member_t where idx = '{$dad['mt_idx']}' ";
$mta = $DB->fetch_assoc($sql);

$sql = "select * from service_domestic where idx = '{$dadi['cate_s']}' ";
$sd = $DB->fetch_assoc($sql);

$sql = "select * from cate_ps1 where ct_id = '{$dadi['cate_ps2']}' ";
$cp1= $DB->fetch_assoc($sql);

$sql_dadh = "select * from d_app_domestic_history2 where app_idx = '{$dadi['app_idx']}' and app_item_idx = '{$dadi['idx']}' and d_content = '등록결정' ";
$dadh = $DB->fetch_assoc($sql_dadh);


if($_GET['tabnum1']){ $tabnum1=$_GET['tabnum1']; }else{ $tabnum1=1; }
if($_GET['tabnum2']){ $tabnum2=$_GET['tabnum2']; }else{ $tabnum2=1; }

$qstr = "d_status=".$_GET['d_status'];
if($_GET['stx_dt1']){ $qstr .= "&stx_dt1=".$_GET['stx_dt1']; }
if($_GET['stx_dt2']){ $qstr .= "&stx_dt2=".$_GET['stx_dt2']; }
if($_GET['stx']){
    $qstr .= "&sfl=".$_GET['sfl'];
    $qstr .= "&stx=".$_GET['stx'];
}
$qstr .= "&pg=".$_GET['pg'];

?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">상품류별 사건관리</h4>

                        <div class="flex margin-bottom-10">
                            <div class="jm-tab1 <? if($tabnum1==1){echo "active";} ?>" onclick="gourl('?idx=<?= $idx ?>&<?= $qstr ?>&tabnum1=1')">상품 출원 정보</div>
                            <div class="jm-tab1 <? if($tabnum1==2){echo "active";} ?>" onclick="gourl('?idx=<?= $idx ?>&<?= $qstr ?>&tabnum1=2')">업무처리</div>
                            <div class="jm-tab1 <? if($tabnum1==3){echo "active";} ?>" onclick="gourl('?idx=<?= $idx ?>&<?= $qstr ?>&tabnum1=3')">업무처리 내역</div>
                        </div>

                        <div class="flex margin-bottom-10 wd-100">
                            <div class="margin-left-auto">
                                <!--<input type="button" value="출원 정보 보기" class="btn btn-info" />-->
                                <input type="button" value="목록" onclick="click_golist()" class="btn btn-secondary" />
                                <?
                                if($tabnum1<=2){
                                    ?><input type="button" class="btn btn-primary" value="저장하기" onclick="submit_form1()"><?
                                }
                                ?>
                            </div>
                        </div>
                        <div class="flex margin-bottom-10 wd-100">
                            <div>
                                <?
                                if($tabnum1==1){
                                    ?>
                                    <div class="font-16 font-weight-700">상품 출원 정보</div>
                                    <div class="font-14">출원완료 시 사용자에게 노출되는 정보를 입력해주세요.</div>
                                    <?
                                }else if($tabnum1==2){
                                    ?>
                                    <div class="font-16 font-weight-700">업무처리</div>
                                    <?
                                }else if($tabnum1==3){
                                    ?>
                                    <div class="font-16 font-weight-700">업무처리 내역</div>
                                    <?
                                }
                                ?>
                            </div>
                        </div>

                        <div class="view-scroll-y" style="height: 550px;">
                            <?
                            if($tabnum1==1){
                                if($dadi['code_app']){ $code_app = $dadi['code_app']; }else{ $code_app = "00-0000-0000000"; }
                                ?>
                                <form method="post" name="form1" id="form1" action="./completed_application_form_update.php" enctype="multipart/form-data">
                                    <input type="hidden" name="idx" id="idx" value="<?= $idx ?>" />
                                    <input type="hidden" name="qstr" id="qstr" value="<?= $qstr ?>" />
                                    <input type="hidden" name="tabnum1" id="tabnum1" value="<?= $tabnum1 ?>" />
                                    <input type="hidden" name="tabnum2" id="tabnum2" value="<?= $tabnum2 ?>" />

                                    <table cellpadding="0" cellspacing="0" class="wd-100 font-14">
                                        <tr>
                                            <th class="jm_th1 wd-15 py-3">접수번호</th>
                                            <td colspan="3" class="py-3 px-3"><?= $dadi['code_register1'] ?></td>
                                        </tr>
                                        <tr>
                                            <th class="jm_th1 wd-15 py-3">상품류</th>
                                            <td class="wd-35 py-3 px-3">제<?= $cp1['ct_catenum'] ?>류</td>
                                            <th class="jm_th1 wd-15 py-3">상품류명</th>
                                            <td class="wd-35 py-3 px-3"><?= $cp1['ct_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <th class="jm_th1 wd-15 py-3">서비스 유형</th>
                                            <td colspan="3" class="py-3 px-3"><?= $sd['s_name'] ?></td>
                                        </tr>
                                        <tr>
                                            <th class="jm_th1 wd-15 py-3">출원 번호</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="text" name="code_app" id="code_app" class="form-control form-control-sm" value="<?= $code_app ?>" placeholder="00-0000-0000000" maxlength="15">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="jm_th1 wd-15 py-3">메모</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <textarea name="memo1" id="memo1" class="form-control form-control-sm" placeholder="관리자에게만 노출됩니다." rows="5"><?= strip_tags($dadi['memo1']) ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (출원서)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report1" class="form-control form-control-sm">
                                                <? if($dadi['file_report1']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report1'] ?>" download="<?= $dadi['file_report1_origin'] ?>" target="_blank"><?= $dadi['file_report1_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="jm_th1 wd-15 py-3">출원완료일</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="text" name="dt_complete" id="dt_complete" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $dad['dt_complete'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">심사결과 예정일</th>
                                            <td class="wd-35 py-3 px-3"><? echo str_replace("-",".",$dadi['dt_result']); ?></td>
                                        </tr>

                                    </table>
                                </form>
                                <?
                            }else if($tabnum1==2){
                                ?>
                                <form method="post" name="form1" id="form1" action="./completed_application_form_update.php" enctype="multipart/form-data">
                                    <input type="hidden" name="idx" id="idx" value="<?= $idx ?>" />
                                    <input type="hidden" name="qstr" id="qstr" value="<?= $qstr ?>" />
                                    <input type="hidden" name="tabnum1" id="tabnum1" value="<?= $tabnum1 ?>" />
                                    <input type="hidden" name="tabnum2" id="tabnum2" value="<?= $tabnum2 ?>" />

                                    <table cellpadding="0" cellspacing="0" class="wd-100 font-14">
                                        <tr>
                                            <th class="jm_th1 wd-15 py-3">진행현황</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <select name="d_status" id="d_status" class="custom-select custom-select-sm">
                                                    <option value="1" <? if($dadi['d_status']==1){echo 'selected';} ?> >출원완료</option>
                                                    <option value="2" <? if($dadi['d_status']==2){echo 'selected';} ?> >심사중</option>
                                                    <option value="3" <? if($dadi['d_status']==3){echo 'selected';} ?> >출원취소</option>
                                                    <option value="4" <? if($dadi['d_status']==4){echo 'selected';} ?> >심사 결과 통지</option>
                                                    <option value="5" <? if($dadi['d_status']==5){echo 'selected';} ?> >심사 재개</option>
                                                    <option value="6" <? if($dadi['d_status']==6){echo 'selected';} ?> >거절결정 1차</option>
                                                    <option value="7" <? if($dadi['d_status']==7){echo 'selected';} ?> >심사진행</option>
                                                    <option value="8" <? if($dadi['d_status']==8){echo 'selected';} ?> >거절결정 2차</option>
                                                    <option value="9" <? if($dadi['d_status']==9){echo 'selected';} ?> >심판결과 (패소)</option>
                                                    <!--<option value="10" <?/* if($dadi['d_status']==10){echo 'selected';} */?> >승소</option>-->
                                                    <option value="11" <? if($dadi['d_status']==11){echo 'selected';} ?> >출원공고</option>
                                                    <option value="12" <? if($dadi['d_status']==12){echo 'selected';} ?> >등록대기</option>
                                                    <option value="13" <? if($dadi['d_status']==13){echo 'selected';} ?> >등록결정</option>
                                                    <option value="14" <? if($dadi['d_status']==14){echo 'selected';} ?> >등록완료</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <!--  show_stat3 출원취소 -->
                                        <tr class="show_stat show_stat3">
                                            <th class="jm_th1 wd-15 py-3">취소 사유 선택</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <select name="reason_cancel2" id="reason_cancel2" class="custom-select custom-select-sm">
                                                    <option value="해당 상품류에 등록된 상표" <? if($dadi['reason_cancel2']=="해당 상품류에 등록된 상표"){echo 'selected';} ?> >해당 상품류에 등록된 상표</option>
                                                    <option value="심사결과 대응 포기" <? if($dadi['reason_cancel2']=="심사결과 대응 포기"){echo 'selected';} ?> >심사결과 대응 포기</option>
                                                    <option value="거절 결정 대응 포기" <? if($dadi['reason_cancel2']=="거절 결정 대응 포기"){echo 'selected';} ?> >거절 결정 대응 포기</option>
                                                    <option value="등록료 납부 포기" <? if($dadi['reason_cancel2']=="등록료 납부 포기"){echo 'selected';} ?> >등록료 납부 포기</option>
                                                    <option value="출원인 개인적 사유로 인한 취소(출원접수 후 특허청 출원 진행 전)" <? if($dadi['reason_cancel2']=="출원인 개인적 사유로 인한 취소(출원접수 후 특허청 출원 진행 전)"){echo 'selected';} ?> >출원인 개인적 사유로 인한 취소(출원접수 후 특허청 출원 진행 전)</option>
                                                    <option value="출원인 개인적 사유로 인한 취소(출원접수 전)" <? if($dadi['reason_cancel2']=="출원인 개인적 사유로 인한 취소(출원접수 전)"){echo 'selected';} ?> >출원인 개인적 사유로 인한 취소(출원접수 전)</option>
                                                    <option value="완료 전 상표가 이미 등록 되어있음(출원접수 후)" <? if($dadi['reason_cancel2']=="완료 전 상표가 이미 등록 되어있음(출원접수 후)"){echo 'selected';} ?> >완료 전 상표가 이미 등록 되어있음(출원접수 후)</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <!--  show_stat3 -->

                                        <!--  show_stat4 심사 결과 통지 -->
                                        <tr class="show_stat show_stat4">
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (심사결과 분석 보고서)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report5" class="form-control form-control-sm">
                                                <? if($dadi['file_report5']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report5'] ?>" download="<?= $dadi['file_report5_origin'] ?>" target="_blank"><?= $dadi['file_report5_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat4">
                                            <th class="jm_th1 wd-15 py-3">거절이유</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <textarea name="reason_cancel1" id="reason_cancel1" class="form-control form-control-sm" rows="8" placeholder="텍스트 입력"><?= strip_tags($dadi['reason_cancel1']) ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat4">
                                            <th class="jm_th1 wd-15 py-3">접수일자</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="text" name="d_date1" id="d_date1" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $dadi['d_date1'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">심사결과 마감일</th>
                                            <td class="wd-35 py-3 px-3"><input type="text" name="dt_result_end" id="dt_result_end" class="form-control form-control-sm" style="max-width: 120px;" value="<?= $cp1['dt_result_end'] ?>" readonly></td>
                                        </tr>
                                        <tr class="show_stat show_stat4">
                                            <th class="jm_th1 wd-15 py-3">심사대응비용</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="number" name="price_audit" id="price_audit" class="form-control form-control-sm wd-100" style="max-width: 120px;" value="<?= $dadi['price_audit'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">총 심사대응 비용 (+VAT 10%)</th>
                                            <td class="wd-35 py-3 px-3 td_price_audit_result"><?= number_format($dadi['price_audit']+($dadi['price_audit']*0.1)) ?></td>
                                        </tr>
                                        <!--  show_stat4 -->

                                        <!--  show_stat5 심사 재개 -->
                                        <tr class="show_stat show_stat5">
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (의견 및 보정서)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report6" class="form-control form-control-sm">
                                                <? if($dadi['file_report6']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report6'] ?>" download="<?= $dadi['file_report6_origin'] ?>" target="_blank"><?= $dadi['file_report6_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat5">
                                            <th class="jm_th1 wd-15 py-3">접수일자</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="text" name="d_date2" id="d_date2" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $dadi['d_date2'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">심사결과 마감일</th>
                                            <td class="wd-35 py-3 px-3"><input type="text" name="dt_result_end2" id="dt_result_end2" class="form-control form-control-sm" style="max-width: 120px;" value="<?= $dadi['dt_result_end2'] ?>" readonly></td>
                                        </tr>
                                        <!--  show_stat5 -->

                                        <!--  show_stat6 거절결정 1차 -->
                                        <tr class="show_stat show_stat6">
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (거절 결정 통지서)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report71" class="form-control form-control-sm">
                                                <? if($dadi['file_report71']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report71'] ?>" download="<?= $dadi['file_report71_origin'] ?>" target="_blank"><?= $dadi['file_report71_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat6">
                                            <th class="jm_th1 wd-15 py-3">거절이유</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <textarea name="reason_cancel3" id="reason_cancel3" class="form-control form-control-sm" rows="8" placeholder="텍스트 입력"><?= strip_tags($dadi['reason_cancel3']) ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat6">
                                            <th class="jm_th1 wd-15 py-3">접수일자</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="text" name="d_date3" id="d_date3" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $dadi['d_date3'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">심사결과 마감일</th>
                                            <td class="wd-35 py-3 px-3"><input type="text" name="dt_result_end3" id="dt_result_end3" class="form-control form-control-sm" style="max-width: 120px;" value="<?= $dadi['dt_result_end3'] ?>" readonly></td>
                                        </tr>
                                        <tr class="show_stat show_stat6">
                                            <th class="jm_th1 wd-15 py-3">심판진행 대응비용</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="number" name="price_referee3" id="price_referee3" class="form-control form-control-sm wd-100" style="max-width: 120px;" value="<?= $dadi['price_referee3'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">총 심사대응 비용 (+VAT 10%)</th>
                                            <td class="wd-35 py-3 px-3 td_price_referee3"><? echo $dadi['price_referee3']+($dadi['price_referee3']*0.1); ?></td>
                                        </tr>
                                        <!--  show_stat6 -->

                                        <!--  show_stat8 거절결정 2차 -->
                                        <tr class="show_stat show_stat8">
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (거절 결정 통지서)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report72" class="form-control form-control-sm">
                                                <? if($dadi['file_report72']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report72'] ?>" download="<?= $dadi['file_report72_origin'] ?>" target="_blank"><?= $dadi['file_report72_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat8">
                                            <th class="jm_th1 wd-15 py-3">거절이유</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <textarea name="reason_cancel4" id="reason_cancel4" class="form-control form-control-sm" rows="8" placeholder="텍스트 입력"><?= strip_tags($dadi['reason_cancel4']) ?></textarea>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat8">
                                            <th class="jm_th1 wd-15 py-3">접수일자</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="text" name="d_date4" id="d_date4" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $dadi['d_date4'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">심사결과 마감일</th>
                                            <td class="wd-35 py-3 px-3"><input type="text" name="dt_result_end4" id="dt_result_end4" class="form-control form-control-sm" style="max-width: 120px;" value="<?= $dadi['dt_result_end4'] ?>" readonly></td>
                                        </tr>
                                        <tr class="show_stat show_stat8">
                                            <th class="jm_th1 wd-15 py-3">심판진행 대응비용</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="number" name="price_referee4" id="price_referee4" class="form-control form-control-sm wd-100" style="max-width: 120px;" value="<?= $dadi['price_referee4'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">총 심사대응 비용 (+VAT 10%)</th>
                                            <td class="wd-35 py-3 px-3 td_price_referee4"><? echo $dadi['price_referee4']+($dadi['price_referee4']*0.1); ?></td>
                                        </tr>
                                        <!--  show_stat8 -->

                                        <!--  show_stat7 심사진행 -->
                                        <tr class="show_stat show_stat7">
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (1차 심판청구서)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report8" class="form-control form-control-sm">
                                                <? if($dadi['file_report8']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report8'] ?>" download="<?= $dadi['file_report8_origin'] ?>" target="_blank"><?= $dadi['file_report8_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat7">
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (2차 심판청구서)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report11" class="form-control form-control-sm">
                                                <? if($dadi['file_report11']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report11'] ?>" download="<?= $dadi['file_report11_origin'] ?>" target="_blank"><?= $dadi['file_report11_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <!--  show_stat7 -->

                                        <!--  show_stat9 심판결과(패소) -->
                                        <tr class="show_stat show_stat9">
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (심판결과)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report9" class="form-control form-control-sm">
                                                <? if($dadi['file_report9']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report9'] ?>" download="<?= $dadi['file_report9_origin'] ?>" target="_blank"><?= $dadi['file_report9_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <!--  show_stat9 -->

                                        <!--  show_stat7 심사진행 show_stat9 심판결과(패소) -->
                                        <tr class="show_stat show_stat7 show_stat9">
                                            <th class="jm_th1 wd-15 py-3">심판번호(1차)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="text" name="code_referee" id="code_referee" class="form-control form-control-sm wd-100" value="<?= $dadi['code_referee'] ?>">
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat7 show_stat9">
                                            <th class="jm_th1 wd-15 py-3">심판번호(2차)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="text" name="code_referee2" id="code_referee2" class="form-control form-control-sm wd-100" value="<?= $dadi['code_referee2'] ?>">
                                            </td>
                                        </tr>
                                        <!--  show_stat7 심사진행 show_stat9 심판결과(패소) -->

                                        <!--  show_stat11 출원공고 -->
                                        <tr class="show_stat show_stat11">
                                            <th class="jm_th1 wd-15 py-3">
                                                <?
                                                if($dadi['cate_s']=="3" || $dadi['cate_s']=="4"){
                                                    echo '보고서 첨부 (우선심사 신청서 및 결정서 저장)';
                                                }else{
                                                    echo '보고서 첨부 (출원공고서)';
                                                }
                                                ?>
                                            </th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report2" class="form-control form-control-sm">
                                                <? if($dadi['file_report2']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report2'] ?>" download="<?= $dadi['file_report2_origin'] ?>" target="_blank"><?= $dadi['file_report2_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat11">
                                            <th class="jm_th1 wd-15 py-3">출원공고일</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="text" name="dt_announce" id="dt_announce" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $dadi['dt_announce'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">예정 등록일</th>
                                            <td class="wd-35 py-3 px-3"><input type="text" name="dt_register_expected" id="dt_register_expected" class="form-control form-control-sm wd-100" readonly style="max-width: 120px;" value="<?= $dadi['dt_register_expected'] ?>"></td>
                                        </tr>
                                        <!--  show_stat11 -->

                                        <!--  show_stat13 등록결정 -->
                                        <tr class="show_stat show_stat13">
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (등록결정서)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report3" class="form-control form-control-sm">
                                                <? if($dadi['file_report3']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report3'] ?>" download="<?= $dadi['file_report3_origin'] ?>" target="_blank"><?= $dadi['file_report3_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat13">
                                            <th class="jm_th1 wd-15 py-3">등록결정일</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="text" name="dt_register_confirm" id="dt_register_confirm" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $dadi['dt_register_confirm'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">등록료 납부 마감일</th>
                                            <td class="wd-35 py-3 px-3 show_dt_register_pay"><?= $dadi['dt_register_pay'] ?></td>
                                        </tr>
                                        <tr class="show_stat show_stat13">
                                            <th class="jm_th1 wd-15 py-3">지정상품 초과</th>
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
                                        <tr class="show_stat show_stat13">
                                            <th class="jm_th1 wd-15 py-3">총 지정상품 수</th>
                                            <td class="py-3 px-3">
                                                <input type="number" name="cnt_pr_designated" id="cnt_pr_designated" class="form-control form-control-sm wd-35 d-inline-block" style="min-width: 90px;" value="<?= $dadi['cnt_pr_designated'] ?>">
                                                <input type="button" value="적용하기" class="btn btn-secondary d-inline-block" onclick="regist_cnt_pr_designated()">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">추가상품 수</th>
                                            <td class="py-3 px-3">
                                                <input type="number" name="cnt_pr_add" id="cnt_pr_add" class="form-control form-control-sm wd-35" style="min-width: 90px;" value="<?= $dadi['cnt_pr_add'] ?>" placeholder="총 지정상품 수 - 20" readonly>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat13">
                                            <th class="jm_th1 wd-15 py-3">가산 수수료</th>
                                            <td class="py-3 px-3">
                                                <input type="number" name="vat1_pr_add" id="vat1_pr_add" class="form-control form-control-sm wd-35" value="<?= $dadi['vat1_pr_add'] ?>" readonly>
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">VAR</th>
                                            <td class="py-3 px-3">
                                                <input type="number" name="vat2_pr_add" id="vat2_pr_add" class="form-control form-control-sm wd-35" value="<?= $dadi['vat2_pr_add'] ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat13">
                                            <th class="jm_th1 wd-15 py-3">닥터마크 수수료</th>
                                            <td class="py-3 px-3">
                                                <input type="number" name="vat4_pr_add" id="vat4_pr_add" class="form-control form-control-sm wd-35" value="<?= $dadi['vat4_pr_add'] ?>" readonly>
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">총 가산 수수료</th>
                                            <td class="py-3 px-3">
                                                <input type="number" name="vat3_pr_add" id="vat3_pr_add" class="form-control form-control-sm wd-35" value="<?= $dadi['vat3_pr_add'] ?>" readonly>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat13">
                                            <th class="jm_th1 wd-15 py-3">결제 상태</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <?
                                                if($dadh['d_pay_status']=="paid"){
                                                    echo "결제완료";
                                                }else{
                                                    echo "결제대기";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <!--  show_stat13 -->

                                        <!--  show_stat14 등록완료 -->
                                        <tr class="show_stat show_stat14">
                                            <th class="jm_th1 wd-15 py-3">보고서 첨부 (등록공보)</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="file" name="file_report4" class="form-control form-control-sm">
                                                <? if($dadi['file_report4']){ ?>
                                                    <div class="margin-top-10">
                                                        <ul>
                                                            <li>
                                                                <a href="../data/app_domestic_item/<?= $dadi['file_report4'] ?>" download="<?= $dadi['file_report4_origin'] ?>" target="_blank"><?= $dadi['file_report4_origin'] ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <? } ?>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat14">
                                            <th class="jm_th1 wd-15 py-3">등록완료일</th>
                                            <td class="wd-35 py-3 px-3">
                                                <input type="text" name="dt_register_complete" id="dt_register_complete" class="form-control form-control-sm wd-100 datepicker" style="max-width: 120px;" value="<?= $dadi['dt_register_complete'] ?>">
                                            </td>
                                            <th class="jm_th1 wd-15 py-3">기간 선택</th>
                                            <td class="wd-35 py-3 px-3">
                                                <div class="flex">
                                                    <div class="mx-2">
                                                        <input type="radio" name="period" id="period1" value="5" <? if($dadi['period']=="5" || $dadi['period']==""){echo 'checked';} ?> >
                                                        <label class="ml-1" for="period1">5년</label>
                                                    </div>
                                                    <div class="mx-2">
                                                        <input type="radio" name="period" id="period2" value="10" <? if($dadi['period']=="10"){echo 'checked';} ?> >
                                                        <label class="ml-1" for="period2">10년</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="show_stat show_stat14">
                                            <th class="jm_th1 wd-15 py-3">존속기간</th>
                                            <td colspan="3" class="py-3 px-3 show_result_period"></td>
                                        </tr>
                                        <tr class="show_stat show_stat14">
                                            <th class="jm_th1 wd-15 py-3">등록번호</th>
                                            <td colspan="3" class="py-3 px-3">
                                                <input type="text" name="code_register2" id="code_register2" class="form-control form-control-sm wd-100" value="<?= $dadi['code_register2'] ?>">
                                            </td>
                                        </tr>
                                        <!--  show_stat14 -->

                                    </table>
                                </form>
                                <?

                            }else if($tabnum1==3){
                                $pg2 = $_GET['pg2'];
                                $n_limit_num = 8;
                                $n_limit = $n_limit_num;

                                $qstr2 = "idx=".$idx."&".$qstr;
                                $qstr2 .= "&tabnum1=".$tabnum1;
                                $qstr2 .= "&pg2=";

                                $sql_count = " select count(*) as cnt from d_app_domestic_history2 where app_item_idx = '{$idx}' order by idx desc ";
                                $row_cnt = $DB->fetch_assoc($sql_count);
                                $total_count = $row_cnt['cnt'];
                                $n_page = ceil($total_count / $n_limit_num);
                                if($pg2=="") $pg2 = 1;
                                $n_from = ($pg2 - 1) * $n_limit;

                                $sql = "select * from d_app_domestic_history2 where app_item_idx = '{$idx}' order by idx desc limit ".$n_from.", ".$n_limit;
                                $history_list = $DB->select_query($sql);
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
                                                        <a href="../data/app_domestic_item/<?= $dad['report_ver1'] ?>" download="<?= $rowh['d_content_file1'] ?>">출원서 첨부</a>
                                                        <?
                                                    }else if($rowh['d_content_file2']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['report_ver2'] ?>" download="<?= $rowh['d_content_file2'] ?>">출원 공고서</a>
                                                        <?
                                                    }else if($rowh['d_content_file3']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['report_ver3'] ?>" download="<?= $rowh['d_content_file3'] ?>">등록 결정서</a>
                                                        <?
                                                    }else if($rowh['d_content_file4']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['report_ver4'] ?>" download="<?= $rowh['d_content_file4'] ?>">등록공보</a>
                                                        <?
                                                    }else if($rowh['d_content_file5']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['report_ver5'] ?>" download="<?= $rowh['d_content_file5'] ?>">심사결과 분석 보고서</a>
                                                        <?
                                                    }else if($rowh['d_content_file6']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['report_ver6'] ?>" download="<?= $rowh['d_content_file6'] ?>">의견 및 보정서</a>
                                                        <?
                                                    }else if($rowh['d_content_file71']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['file_report71'] ?>" download="<?= $rowh['d_content_file71'] ?>">거절결정통지서 (1차)</a>
                                                        <?
                                                    }else if($rowh['d_content_file72']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['file_report72'] ?>" download="<?= $rowh['d_content_file72'] ?>">거절결정통지서 (2차)</a>
                                                        <?
                                                    }else if($rowh['d_content_file8']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['file_report8'] ?>" download="<?= $rowh['d_content_file8'] ?>">심판 청구서</a>
                                                        <?
                                                    }else if($rowh['d_content_file9']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['file_report9'] ?>" download="<?= $rowh['d_content_file9'] ?>">1차 심판결과</a>
                                                        <?
                                                    }else if($rowh['d_content_file11']){
                                                        ?>
                                                        <a href="../data/app_domestic_item/<?= $dad['file_report11'] ?>" download="<?= $rowh['d_content_file11'] ?>">2차 심판결과</a>
                                                        <?
                                                    }
                                                    ?>
                                                </td>
                                                <td class="py-3 px-3 text-center"><?= $rowh['d_price'] ?></td>
                                                <td class="py-3 px-3 text-center"><?= $rowh['d_pay_method'] ?></td>
                                                <td class="py-3 px-3 text-center"><?= $rowh['d_pay_status'] ?></td>
                                                <td class="py-3 px-3 text-center">
                                                    <?
                                                    if($num_h==1 && strpos("a".$rowh['d_content'],"출원 완료")==false){
                                                        //
                                                        ?>
                                                        <input type="button" value="삭제" class="btn btn-sm btn-danger" onclick="del_dadh2('<?= $rowh['idx'] ?>','<?= $idx ?>')">
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
                                    const del_dadh2 = (h_idx,app_item_idx) =>{
                                        if(confirm("해당 내역을 삭제하시겠습니까?")){
                                            $.ajax({
                                                type: "POST",
                                                url: hostname + "/get_ajax.php",
                                                data: {
                                                    mode:'del_dadh2',
                                                    h_idx:h_idx,
                                                    app_item_idx:app_item_idx,
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
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $("#price_audit").on("keyup",function (){
        var price_audit = Number($(this).val());
        var price_audit_result = price_audit+(price_audit*0.1);
        $(".td_price_audit_result").html(addComma(price_audit_result));
    });

    $("#price_referee3").on("keyup",function (){
        var price_referee3 = Number($(this).val());
        var price_referee3_result = price_referee3+(price_referee3*0.1);
        $(".td_price_referee3").html(addComma(price_referee3_result));
    });

    $("#price_referee4").on("keyup",function (){
        var price_referee4 = Number($(this).val());
        var price_referee4_result = price_referee4+(price_referee4*0.1);
        $(".td_price_referee4").html(addComma(price_referee4_result));
    });

    $("#d_date1").on("change", function (){
        var d_date1 = $(this).val();
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'dt_add',
                dtval:d_date1,
                dt_unit:"m",
                add_val:2,
            },
            cache: false,
            success: function(data){
                $("#dt_result_end").val(data.replaceAll("-","."));
            }
        });
    });

    $("#d_date2").on("change", function (){
        var d_date2 = $(this).val();
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'dt_add',
                dtval:d_date2,
                dt_unit:"m",
                add_val:2,
            },
            cache: false,
            success: function(data){
                $("#dt_result_end2").val(data.replaceAll("-","."));
            }
        });
    });

    $("#d_date3").on("change", function (){
        var d_date3 = $(this).val();
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'dt_add',
                dtval:d_date3,
                dt_unit:"d",
                add_val:30,
            },
            cache: false,
            success: function(data){
                $("#dt_result_end3").val(data.replaceAll("-","."));
            }
        });
    });

    $("#d_date4").on("change", function (){
        var d_date4 = $(this).val();
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'dt_add',
                dtval:d_date4,
                dt_unit:"d",
                add_val:30,
            },
            cache: false,
            success: function(data){
                $("#dt_result_end4").val(data.replaceAll("-","."));
            }
        });
    });

    $("#dt_register_confirm").on("change", function (){
        var dt_register_confirm = $(this).val();
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'dt_add',
                dtval:dt_register_confirm,
                dt_unit:"m",
                add_val:3,
            },
            cache: false,
            success: function(data){
                $(".show_dt_register_pay").html(data);
            }
        });
    });

    $("#dt_register_complete").on("change", function (){
        var period = $("input[name=period]:checked").val();
        var dt_register_complete = $(this).val();
        if(period!=""){
            $.ajax({
                type: "POST",
                url: hostname + "/get_ajax.php",
                data: {
                    mode:'dt_add',
                    dtval:dt_register_complete,
                    dt_unit:"y",
                    add_val:period,
                },
                cache: false,
                success: function(data){
                    $(".show_result_period").html(data);
                }
            });
        }
    });
    $("input[name=period]").on("change", function (){
        var period = $(this).val();
        var dt_register_complete = $("#dt_register_complete").val();
        if(dt_register_complete!=""){
            $.ajax({
                type: "POST",
                url: hostname + "/get_ajax.php",
                data: {
                    mode:'dt_add',
                    dtval:dt_register_complete,
                    dt_unit:"y",
                    add_val:period,
                },
                cache: false,
                success: function(data){
                    $(".show_result_period").html(data);
                }
            });
        }
    });
    $("#dt_announce").on("change", function (){
        var dt_announce = $(this).val();
        if(dt_announce!=""){
            $.ajax({
                type: "POST",
                url: hostname + "/get_ajax.php",
                data: {
                    mode:'dt_add',
                    dtval:dt_announce,
                    dt_unit:"m",
                    add_val:2,
                },
                cache: false,
                success: function(data){
                    $("#dt_register_expected").val(data);
                }
            });
        }
    });

    function regist_cnt_pr_designated(){
        var cnt_pr_designated = $("#cnt_pr_designated").val();
        var cnt_pr_add = cnt_pr_designated - 20;
        if(cnt_pr_add<0){ cnt_pr_add = 0; }
        var vat1_pr_add = cnt_pr_add*2000;
        var vat4_pr_add = cnt_pr_add*1000;
        var vat2_pr_add = vat4_pr_add*0.1;
        var vat3_pr_add = vat1_pr_add+vat2_pr_add+vat4_pr_add;
        $("#cnt_pr_add").val(cnt_pr_add);
        $("#vat1_pr_add").val(vat1_pr_add);
        $("#vat2_pr_add").val(vat2_pr_add);
        $("#vat3_pr_add").val(vat3_pr_add);
        $("#vat4_pr_add").val(vat4_pr_add);
    }

    function click_golist(){
        if(confirm("정말 저장 없이 전 페이지로 돌아가시겠습니까?")){
            location.href = "./completed_application_list.php?<?=$qstr?>";
        }
    }

    $("#d_status").on("change", function (){
        var d_status = $(this).val();
        if(Number(d_status)==1){ $(".show_stat").hide(); $(".show_stat1").show(); }
        else if(Number(d_status)==2){ $(".show_stat").hide(); $(".show_stat2").show(); }
        else if(Number(d_status)==3){ $(".show_stat").hide(); $(".show_stat3").show(); }
        else if(Number(d_status)==4){ $(".show_stat").hide(); $(".show_stat4").show(); }
        else if(Number(d_status)==5){ $(".show_stat").hide(); $(".show_stat5").show(); }
        else if(Number(d_status)==6){ $(".show_stat").hide(); $(".show_stat6").show(); }
        else if(Number(d_status)==7){ $(".show_stat").hide(); $(".show_stat7").show(); }
        else if(Number(d_status)==8){ $(".show_stat").hide(); $(".show_stat8").show(); }
        else if(Number(d_status)==9){ $(".show_stat").hide(); $(".show_stat9").show(); }
        else if(Number(d_status)==10){ $(".show_stat").hide(); $(".show_stat10").show(); }
        else if(Number(d_status)==11){ $(".show_stat").hide(); $(".show_stat11").show(); }
        else if(Number(d_status)==12){ $(".show_stat").hide(); $(".show_stat12").show(); }
        else if(Number(d_status)==13){ $(".show_stat").hide(); $(".show_stat13").show(); }
        else if(Number(d_status)==14){ $(".show_stat").hide(); $(".show_stat14").show(); }
    });

    $(function (){
        var d_status = $("#d_status").val();
        if(Number(d_status)==1){ $(".show_stat").hide(); $(".show_stat1").show(); }
        else if(Number(d_status)==2){ $(".show_stat").hide(); $(".show_stat2").show(); }
        else if(Number(d_status)==3){ $(".show_stat").hide(); $(".show_stat3").show(); }
        else if(Number(d_status)==4){ $(".show_stat").hide(); $(".show_stat4").show(); }
        else if(Number(d_status)==5){ $(".show_stat").hide(); $(".show_stat5").show(); }
        else if(Number(d_status)==6){ $(".show_stat").hide(); $(".show_stat6").show(); }
        else if(Number(d_status)==7){ $(".show_stat").hide(); $(".show_stat7").show(); }
        else if(Number(d_status)==8){ $(".show_stat").hide(); $(".show_stat8").show(); }
        else if(Number(d_status)==9){ $(".show_stat").hide(); $(".show_stat9").show(); }
        else if(Number(d_status)==10){ $(".show_stat").hide(); $(".show_stat10").show(); }
        else if(Number(d_status)==11){ $(".show_stat").hide(); $(".show_stat11").show(); }
        else if(Number(d_status)==12){ $(".show_stat").hide(); $(".show_stat12").show(); }
        else if(Number(d_status)==13){ $(".show_stat").hide(); $(".show_stat13").show(); }
        else if(Number(d_status)==14){ $(".show_stat").hide(); $(".show_stat14").show(); }

        var d_date1 = $("#d_date1").val();
        if(d_date1!=""){
            $.ajax({
                type: "POST",
                url: hostname + "/get_ajax.php",
                data: {
                    mode:'dt_add',
                    dtval:d_date1,
                    dt_unit:"m",
                    add_val:2,
                },
                cache: false,
                success: function(data){
                    $("#dt_result_end").val(data.replaceAll("-","."));
                }
            });
        }

        var d_date2 = $("#d_date2").val();
        if(d_date2!=""){
            $.ajax({
                type: "POST",
                url: hostname + "/get_ajax.php",
                data: {
                    mode:'dt_add',
                    dtval:d_date2,
                    dt_unit:"m",
                    add_val:2,
                },
                cache: false,
                success: function(data){
                    $("#dt_result_end2").val(data.replaceAll("-","."));
                }
            });
        }

        var d_date3 = $("#d_date3").val();
        if(d_date3!=""){
            $.ajax({
                type: "POST",
                url: hostname + "/get_ajax.php",
                data: {
                    mode:'dt_add',
                    dtval:d_date3,
                    dt_unit:"d",
                    add_val:30,
                },
                cache: false,
                success: function(data){
                    $("#dt_result_end3").val(data.replaceAll("-","."));
                }
            });
        }

        var d_date4 = $("#d_date4").val();
        if(d_date4!=""){
            $.ajax({
                type: "POST",
                url: hostname + "/get_ajax.php",
                data: {
                    mode:'dt_add',
                    dtval:d_date4,
                    dt_unit:"d",
                    add_val:30,
                },
                cache: false,
                success: function(data){
                    $("#dt_result_end4").val(data.replaceAll("-","."));
                }
            });
        }

        var period = $("input[name=period]:checked").val();
        var dt_register_complete = $("#dt_register_complete").val();
        if(period!="" && dt_register_complete!=""){
            $.ajax({
                type: "POST",
                url: hostname + "/get_ajax.php",
                data: {
                    mode:'dt_add',
                    dtval:dt_register_complete,
                    dt_unit:"y",
                    add_val:period,
                },
                cache: false,
                success: function(data){
                    $(".show_result_period").html(data);
                }
            });
        }
    });
</script>
<?
include "./foot_inc.php";
?>
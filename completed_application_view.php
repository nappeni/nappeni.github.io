<?php
include("./head_inc.php");
if(!$_SESSION['mt_id']){
    p_alert("로그인이 필요합니다.","./index.php");
}
include "JYController/MyInfo.php";
$info = new MyInfo;

$pg = $_GET['pg'];
$idx = $_GET['idx'];
$qstr = "pg=".$pg;

$sql = "select * from d_app_domestic_item where idx = '{$idx}' ";
$row = $DB->fetch_assoc($sql);

$sql = "select * from d_app_domestic where idx = '{$row['app_idx']}' ";
$dad = $DB->fetch_assoc($sql);
if($dad['img_mark']){ $img_mark_src = "./data/app_domestic/".$dad['img_mark']; }else{ $img_mark_src = "./images/noimg.png"; }

$sql = "select * from member_t where idx = '{$_SESSION['mt_idx']}' ";
$mta = $DB->fetch_assoc($sql);

$sql = "select s_name from service_domestic where idx = '{$row['cate_s']}' ";
$sdb = $DB->fetch_assoc($sql);

$sql = "select * from cate_ps1 where ct_id = '{$row['cate_ps2']}' ";
$cp1 = $DB->fetch_assoc($sql);

?>
<div class="sub_pg my_pg report">
    <div class="container-fluid px-0">
        <div class="container-xl">
            <div class="division d-block d-xl-flex justify-content-end">
                <!-- w-30 시작 / 마이페이지 -->
                <?
                $idx_lm1 = 2;
                $idx_lm2 = 1;
                $idx_lm3 = 2;
                include "./lm_my_page.php";
                ?>
                <!-- w-30 끝-->

                <!-- w-65 시작-->
                <div class="w-65">
                    <div class="report_top">
                        <h2 class="sub_tit">출원상표 상세 정보</h2>

                        <div class="bg-wh rounded-lg border_bold p_30 d-block d-sm-flex mb_50">
                            <div class="brand_img" style="background-image: url('<?= $img_mark_src ?>')"></div>
                            <div class="d-block d-md-flex justify-content-between align-items-center brand_cont flex-wrap">
                                <div class="row col-12 m-0">
                                    <div class="col-12 col-md-6 w_140_md">
                                        <div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_140">출원번호</p>
                                                <p class="fs_15"><?= $row['code_register1'] ?></p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_140">출원날짜</p>
                                                <p class="fs_15"><?= $dad['dt_complete'] ?></p>
                                            </div>
                                            <div class="d-flex align-items-center mb_8">
                                                <p class="fc_gr222 fw_500 w_140">출원인</p>
                                                <p class="fs_15"><?= $dad['applicant_name_k'] ?><? if($dad['applicant_name_e']){ echo " (".$dad['applicant_name_e'].")"; } ?></p>
                                            </div>
                                            <div class="d-flex align-items-start mb_8">
                                                <p class="fc_gr222 fw_500 w_140">심사결과 예정일</p>
                                                <p class="fs_15"><?= $row['dt_result'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 w_140_md">
                                        <div class="d-flex align-items-center mb_8">
                                            <p class="fc_gr222 fw_500 w_100">출원 타입</p>
                                            <p class="fs_15"><?= $sdb['s_name'] ?></p>
                                        </div>
                                        <div class="d-flex align-items-center mb_8">
                                            <p class="fc_gr222 fw_500 w_100">상표 유형</p>
                                            <p class="fs_15">
                                                <?
                                                if($dad['cate_mark']==1){ echo "문자 상표"; }
                                                else if($dad['cate_mark']==2){ echo "도형 상표"; }
                                                else if($dad['cate_mark']==3){ echo "복합 상표"; }
                                                else if($dad['cate_mark']==4){ echo "기타"; }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="d-flex align-items-center mb_8">
                                            <p class="fc_gr222 fw_500 w_100">상표명</p>
                                            <p class="fs_15"><?= $dad['name_mark'] ?></p>
                                        </div>
                                        <div class="d-flex mb_8">
                                            <p class="fc_gr222 fw_500 w_100">상품류</p>
                                            <p class="fs_15">제<?= $cp1['ct_catenum'] ?>류</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- report_top 끝-->



                    <!-- 진행 상황 시작 -->
                    <div class="mb_50 mx_20">
                        <h3 class="sub_tit2">진행 상황</h3>

                        <?
                        if($row['d_status']==1){
                            $arr_dt_complete = explode(".",$dad['dt_complete']);
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">출원 완료</p>
                                <p class="fc_primary"><? echo $arr_dt_complete[0]."년 ".$arr_dt_complete[1]."월 ".$arr_dt_complete[2]."일 특허청에 출원을 완료했습니다."; ?></p>
                            </div>
                            <?
                            if($row['file_report1']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report1'] ?>" download="<?= $row['file_report1_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <?
                                            if($row['cate_s']=="3" || $row['cate_s']=="4"){
                                                echo '우선심사 신청서 및 결정서 저장';
                                            }else{
                                                echo '출원서 저장';
                                            }
                                            ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>
                            <?
                        }else if($row['d_status']==2){
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">심사중</p>
                                <p class="fc_primary">특허청에서 상표 출원을 심사중입니다.</p>
                            </div>
                            <?
                            if($row['file_report1']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report1'] ?>" download="<?= $row['file_report1_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <?
                                            if($row['cate_s']=="3" || $row['cate_s']=="4"){
                                                echo '우선심사 신청서 및 결정서 저장';
                                            }else{
                                                echo '출원서 저장';
                                            }
                                            ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>
                            <?
                        }else if($row['d_status']==3){
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">출원취소</p>
                                <p class="fc_primary">
                                    심사결과에 대하여 대응하는 것을 포기하여 출원이 취하되었습니다.<br>
                                    <? if($row['reason_cancel2']){ echo "사유 : ".$row['reason_cancel2']; } ?>
                                </p>
                            </div>
                            <?
                        }else if($row['d_status']==4){
                            $dt_result_end = explode(".",$row['dt_result_end']);
                            $price_audit = $row['price_audit'];
                            $price_audit_result = $price_audit+($price_audit*0.1);
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">심사 결과 통지</p>
                                <p class="fw_400 fc_gr222 mb-1">
                                    특허청 심사 거절 이유 :<br>
                                    <?= $row['reason_cancel1'] ?><br><br>
                                    <? echo $dt_result_end[0]."년 ".$dt_result_end[1]."월 ".$dt_result_end[2]."일에 마감이 됩니다.<br>상표 출원을 취소하시려면 포기, 심사재개를 진행하시려면 결제를 해주세요.<br><br>"; ?>
                                </p>
                                <p class="fc_primary">
                                    <? echo "결제 금액 : ".number_format($price_audit_result)."원"; ?>
                                </p>
                            </div>
                            <div class="d-flex justify-content-center mb_22">
                                <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="cancel_app_item('<?= $idx ?>')"><? echo '출원 포기'; ?></button>
                                <button type="button" class="btn btn-primary btn-md btn_style03" onclick="gourl('./pending_application_payment.php?idx=<?= $idx ?>&ot_mode=5&<?= $qstr ?>')"><? echo '결제 후 심사재개 진행'; ?></button>
                            </div>
                            <?
                            if($row['file_report5']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report5'] ?>" download="<?= $row['file_report5_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '심사 결과 분석 보고서'; ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>
                            <?
                        }else if($row['d_status']==5){
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">심사재개</p>
                                <p class="fc_primary mb-1">
                                    <? if($row['file_report6']){ echo "심사결과에 대한 의견서가 특허청에 제출 되었습니다."; } ?>
                                </p>
                                <p class="mb-1"><? if($row['d_date2']){ echo "접수일자 : ".$row['d_date2']; } ?></p>
                                <p><? if($row['dt_result_end2']){ echo "심사결과 마감일 : ".$row['dt_result_end2']; } ?></p>
                            </div>
                            <?
                            if($row['file_report6']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report6'] ?>" download="<?= $row['file_report6_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '의견 및 보정서'; ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>
                            <?
                        }else if($row['d_status']==6){
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">거절결정</p>
                                <p class="mb-1">
                                    <?
                                    if($row['d_date3']){
                                        $arr_d_date3 = explode(".",$row['d_date3']);
                                        echo $arr_d_date3[0]."년 ".$arr_d_date3[1]."월 ".$arr_d_date3[2]."일";
                                    }
                                    ?>
                                </p>
                                <p class="mb-4">
                                    <?
                                    if($row['reason_cancel3']){
                                        echo "특허청 거절 이유 : ".$row['reason_cancel3'];
                                    }
                                    ?>
                                </p>
                                <p class="mb-4">
                                    <?
                                    if($row['dt_result_end3']){
                                        $arr_dt_result_end3 = explode(".",$row['dt_result_end3']);
                                        echo $arr_dt_result_end3[0]."년 ".$arr_dt_result_end3[1]."월 ".$arr_dt_result_end3[2]."일에 마감이 됩니다. ";
                                    }
                                    ?>
                                </p>
                                <p>
                                    <?
                                    if($row['price_referee3']){
                                        $price_referee3 = $row['price_referee3']+($row['price_referee3']*0.1);
                                        echo "성표 출원을 취소하시려면 포기, 심사 청구를 진행하시려면 결제를 해주세요.<br>";
                                        echo "심판청구 대응 결제 금액 : ".number_format($price_referee3)."원";
                                    }
                                    ?>
                                </p>
                            </div>

                            <?
                            if($row['price_referee3']){
                                $price_referee3 = $row['price_referee3']+($row['price_referee3']*0.1);
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="cancel_app_item('<?= $idx ?>')"><? echo '출원 포기'; ?></button>
                                    <button type="button" class="btn btn-primary btn-md btn_style03" onclick="gourl('./pending_application_payment.php?idx=<?= $idx ?>&ot_mode=6&<?= $qstr ?>')"><? echo '결제 후 심사재개 진행'; ?></button>
                                </div>
                                <?
                            }
                            ?>

                            <?
                            if($row['file_report71']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report71'] ?>" download="<?= $row['file_report71_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '거절 결정 통지서'; ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>
                            <?
                        }else if($row['d_status']==7){
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">심사 진행</p>
                                <p class="mb-1"><? if($row['file_report8']){ echo "특허청 심판원에 심판청구서를 제출했습니다."; } ?></p>
                                <p>
                                    <?
                                    if($row['code_referee2']){ echo "심판번호 : ".$row['code_referee2']; }
                                    else if($row['code_referee']){ echo "심판번호 : ".$row['code_referee']; }
                                    ?>
                                </p>
                            </div>
                            <?
                            if($row['file_report11']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report11'] ?>" download="<?= $row['file_report11_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '심판 청구서'; ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }else if($row['file_report8']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report8'] ?>" download="<?= $row['file_report8_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '심판 청구서'; ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>
                            <?
                        }else if($row['d_status']==8){
                            ?>

                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">거절결정</p>
                                <p class="mb-1">
                                    <?
                                    if($row['d_date4']){
                                        $arr_d_date4 = explode(".",$row['d_date4']);
                                        echo $arr_d_date4[0]."년 ".$arr_d_date4[1]."월 ".$arr_d_date4[2]."일";
                                    }
                                    ?>
                                </p>
                                <p class="mb-4">
                                    <?
                                    if($row['reason_cancel4']){
                                        echo "특허청 거절 이유 : ".$row['reason_cancel4'];
                                    }
                                    ?>
                                </p>
                                <p class="mb-4">
                                    <?
                                    if($row['dt_result_end4']){
                                        $arr_dt_result_end4 = explode(".",$row['dt_result_end4']);
                                        echo $arr_dt_result_end4[0]."년 ".$arr_dt_result_end4[1]."월 ".$arr_dt_result_end4[2]."일에 마감이 됩니다. ";
                                    }
                                    ?>
                                </p>
                                <p>
                                    <?
                                    if($row['price_referee4']){
                                        $price_referee4 = $row['price_referee4']+($row['price_referee4']*0.1);
                                        echo "성표 출원을 취소하시려면 포기, 심사 청구를 진행하시려면 결제를 해주세요.<br>";
                                        echo "심판청구 대응 결제 금액 : ".number_format($price_referee4)."원";
                                    }
                                    ?>
                                </p>
                            </div>

                            <?
                            if($row['price_referee4']){
                                $price_referee4 = $row['price_referee4']+($row['price_referee4']*0.1);
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="cancel_app_item('<?= $idx ?>')"><? echo '출원 포기'; ?></button>
                                    <button type="button" class="btn btn-primary btn-md btn_style03" onclick="gourl('./pending_application_payment.php?idx=<?= $idx ?>&ot_mode=7&<?= $qstr ?>')"><? echo '결제 후 심사재개 진행'; ?></button>
                                </div>
                                <?
                            }
                            ?>

                            <?
                            if($row['file_report72']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report72'] ?>" download="<?= $row['file_report72_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '거절 결정 통지서'; ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>

                            <?
                        }else if($row['d_status']==9){
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">출원취소</p>
                                <p class="fc_primary">
                                    상표 출원이 거절되었습니다.<br>
                                    사유 : 심판결과 (패소)
                                    <? if($row['code_referee']){ echo "심판번호 : ".$row['code_referee']; } ?>
                                </p>
                            </div>
                            <?
                            if($row['file_report9']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report9'] ?>" download="<?= $row['file_report9_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '심사 결과 보고서'; ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>
                            <?

                        }else if($row['d_status']==10){
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">승소</p>
                            </div>
                            <?
                        }else if($row['d_status']==11){
                            $arr_dt_announce = explode(".",$row['dt_announce']);
                            $arr_dt_register_expected = explode("-",$row['dt_register_expected']);
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">출원공고</p>
                                <p class="fc_primary mb-1">
                                    <?
                                    echo $arr_dt_announce[0]."년 ".$arr_dt_announce[1]."월 ".$arr_dt_announce[2]."일 축하드립니다! 상표출원이 승인되었습니다. ";
                                    ?>
                                </p>
                                <p class="mb-1">
                                    <?
                                    echo "예정 등록일 : ".$arr_dt_register_expected[0]."년 ".$arr_dt_register_expected[1]."월 ".$arr_dt_register_expected[2]."일";
                                    ?>
                                </p>
                            </div>
                            <?
                            if($row['file_report2']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report2'] ?>" download="<?= $row['file_report2_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '출원공고서'; ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>
                            <?
                        }else if($row['d_status']==12){
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">등록대기</p>
                            </div>
                            <?
                        }else if($row['d_status']==13){
                            $dt_register_confirm = str_replace("-",".",$row['dt_register_confirm']);
                            $arr_dt_register_confirm = explode(".",$dt_register_confirm);
                            $dt_register_pay = str_replace("-",".",$row['dt_register_pay']);
                            $arr_dt_register_pay = explode(".",$dt_register_pay);
                            $sqlz = "select datediff('{$dt_register_pay}',date_format(now(),'%Y.%m.%d')) as dtnum from dual ";
                            $rowdt1 = $DB->fetch_assoc($sqlz);
                            $dtnum = $rowdt1['dtnum'];
                            $sqlz = "select * from order_domestic where app_idx = '{$row['app_idx']}' and app_item_idx = '{$row['idx']}' and ot_mode = '8' ";
                            $rowz = $DB->fetch_assoc($sqlz);
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">등록결정</p>
                                <?
                                if($row['file_report3']){
                                    ?>
                                    <p class="mb-1"><? echo $arr_dt_register_confirm[0]."년 ".$arr_dt_register_confirm[1]."월 ".$arr_dt_register_confirm[2]."일 등록결정서가 첨부되었습니다."; ?></p>
                                    <?
                                }
                                ?>
                                <?
                                if(!$rowz['idx']){
                                    // 결제 이력이 없을 때
                                    ?>
                                    <p class="mb-3">등록료를 결제하여 상표 등록을 완료하세요!</p>
                                    <p class="mb-1"><? echo $arr_dt_register_pay[0]."년 ".$arr_dt_register_pay[1]."월 ".$arr_dt_register_pay[2]."일 이후에는 마감되며 납부가 불가능합니다."; ?></p>
                                    <p class="mb-1">상표 출원을 취소하시려면 포기, 상표등록을 진행하시려면 결제를 해주세요.</p>
                                    <p class="fc_primary mb-1">결제 금액 : <?= number_format($row['vat3_pr_add']) ?>원</p>
                                    <?
                                }
                                ?>
                            </div>
                            <?
                            if(!$rowz['idx']){
                                // 결제 이력이 없을 때
                                if($dtnum>=0){
                                    // 결제 마감일 이전일 떄
                                    ?>
                                    <div class="d-flex justify-content-center mb_22">
                                        <button type="button" class="btn btn-secondary btn-md btn_style03 mr-3" onclick="cancel_app_item('<?= $idx ?>')"><? echo '출원 포기'; ?></button>
                                        <button type="button" class="btn btn-primary btn-md btn_style03" onclick="gourl('./applied_trademark_enrollment_payment.php?idx=<?= $idx ?>&ot_mode=8&<?= $qstr ?>')"><? echo '등록 납부'; ?></button>
                                    </div>
                                    <?
                                }
                            }

                            ?>
                            <?
                            if($row['file_report3']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report3'] ?>" download="<?= $row['file_report3_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '등록결정서 저장'; ?>
                                        </button>
                                    </a>
                                </div>
                                <?
                            }
                            ?>

                            <?
                        }else if($row['d_status']==14){
                            ?>
                            <div class="bg-light rounded p_20_25 mb_22">
                                <p class="fw_500 fc_gr222 mb-1">등록완료</p>
                                <p class="fc_primary">축하드립니다! 상표 등록이 되었습니다.<br>등록 상표  납부 등 정보는 [등록 상표 현황] 페이지에서 보실 수 있습니다.</p>
                            </div>
                            <?
                            if($row['file_report4']){
                                ?>
                                <div class="d-flex justify-content-center mb_22">
                                    <a href="./data/app_domestic_item/<?= $row['file_report4'] ?>" download="<?= $row['file_report4_origin'] ?>">
                                        <button type="button" class="btn btn-primary btn-md btn_style03">
                                            <? echo '등록 공보'; ?>
                                        </button>
                                    </a>
                                </div>
                            <?
                            }
                            ?>
                            <?
                        }
                        ?>

                    </div>
                    <!-- 진행 상황 끝 -->



                    <div class="process_information">
                        <div class='info-tit'>진행 내역<div class='expand'></div>
                        </div>
                        <div class='info_cont info_cont2'>
                            <ul>
                                <?
                                $sql = "select * from d_app_domestic_history2 where app_idx = '{$row['app_idx']}' and app_item_idx = '{$row['idx']}' order by idx desc ";
                                $h_list2 = $DB->select_query($sql);
                                if(count($h_list2)>0) {
                                    foreach ($h_list2 as $rowh2) {
                                        ?>
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <p class="fs_18 fw_600 fc_gr222 mr-2"><?= $rowh2['d_content'] ?></p>
                                                <span class="fc_graaa">(<?= $rowh2['d_date'] ?>)</span>
                                            </div>

                                            <?
                                            if($rowh2['d_content_file1']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">
                                                            <?
                                                            if($row['cate_s']=="3" || $row['cate_s']=="4"){
                                                                echo '우선심사 신청서 및 결정서';
                                                            }else{
                                                                echo '출원서';
                                                            }
                                                            ?>
                                                        </p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report1'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report1_origin'] ?>"><?= $row['file_report1_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }else if($rowh2['d_content_file2']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">출원공고서</p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report2'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report2_origin'] ?>"><?= $row['file_report2_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }else if($rowh2['d_content_file3']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">등록결정서</p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report3'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report3_origin'] ?>"><?= $row['file_report3_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }else if($rowh2['d_content_file4']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">등록공보</p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report4'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report4_origin'] ?>"><?= $row['file_report4_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }else if($rowh2['d_content_file5']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">심사결과 분석 보고서</p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report5'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report5_origin'] ?>"><?= $row['file_report5_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }else if($rowh2['d_content_file6']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">의견 및 보정서</p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report6'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report6_origin'] ?>"><?= $row['file_report6_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }else if($rowh2['d_content_file71']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">거절 결정 통지서</p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report71'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report71_origin'] ?>"><?= $row['file_report71_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }else if($rowh2['d_content_file72']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">거절 결정 통지서</p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report72'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report72_origin'] ?>"><?= $row['file_report72_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }else if($rowh2['d_content_file8']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">심판청구서</p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report8'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report8_origin'] ?>"><?= $row['file_report8_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }else if($rowh2['d_content_file9']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">심판결과</p>
                                                        <p class="fs_15 a_link">
                                                            <a href="./data/app_domestic_item/<?= $row['file_report9'] ?>" class="fc_primary" target="_blank" download="<?= $row['file_report9_origin'] ?>"><?= $row['file_report9_origin'] ?></a>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }

                                            if($rowh2['reason_cancel1']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">거절이유</p>
                                                        <p class="fs_15">
                                                            <?= $rowh2['reason_cancel1'] ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }

                                            if($rowh2['reason_cancel2']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">취소사유</p>
                                                        <p class="fs_15">
                                                            <?= $rowh2['reason_cancel2'] ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }

                                            if($rowh2['dt_register_pay']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">등록료 납부 마감일</p>
                                                        <p class="fs_15">
                                                            <?= $rowh2['dt_register_pay'] ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }

                                            if($rowh2['d_pay_status']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">결제 금액</p>
                                                        <p class="fs_15">
                                                            <?= number_format($rowh2['d_price']) ?>원
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }

                                            if($rowh2['d_pay_method']!="" && $rowh2['d_pay_method']!="point"){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">결제 수단</p>
                                                        <p class="fs_15">
                                                            <?
                                                            if($rowh2['d_pay_method']=="card"){
                                                                echo "카드";
                                                            }else if($rowh2['d_pay_method']=="vbank"){
                                                                echo "무통장입금";
                                                            }else{
                                                                echo $rowh2['d_pay_method'];
                                                            }
                                                            ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }

                                            if($rowh2['d_pay_status']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">결제 상태</p>
                                                        <p class="fs_15">
                                                            <?
                                                            if($rowh2['d_pay_status']=="paid"){
                                                                echo "결제 완료";
                                                            }else{
                                                                echo "결제 대기";
                                                            }
                                                            ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }

                                            if($rowh2['dt_result_end3']){
                                                ?>
                                                <ul class="info_list">
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">마감일자</p>
                                                        <p class="fs_15">
                                                            (거절 결정일자로부터 30일 후) <?= $rowh2['dt_result_end3'] ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?
                                            }
                                            ?>

                                        </li>
                                        <?
                                    }
                                }
                                ?>

                                <?
                                $sql = "select * from d_app_domestic_history where app_idx = '{$row['app_idx']}' and app_item_idx = '' order by idx desc ";
                                $h_list1 = $DB->select_query($sql);
                                if(count($h_list1)>0){
                                    foreach ($h_list1 as $rowh1){
                                        ?>
                                        <li>
                                            <div class="d-flex align-items-center">
                                                <p class="fs_18 fw_600 fc_gr222 mr-2"><?= $rowh1['d_content'] ?></p>
                                                <span class="fc_graaa">(<?= $rowh1['d_date'] ?>)</span>
                                            </div>

                                            <ul class="info_list">

                                                <? if($rowh1['d_content_file1']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">1차 보고서</p>
                                                        <p class="fs_15"><a href="./data/app_domestic/<?= $dad['report_ver1'] ?>" target="_blank" download="<?= $dad['report_ver1_origin'] ?>"><?= $dad['report_ver1_origin'] ?></a></p>
                                                    </li>
                                                <? } ?>
                                                <? if($rowh1['txt_mod_ver1']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">1차 수정요청사항</p>
                                                        <p class="fs_15"><?= $rowh1['txt_mod_ver1'] ?></p>
                                                    </li>
                                                <? } ?>

                                                <? if($rowh1['d_content_file2']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">2차 보고서</p>
                                                        <p class="fs_15"><a href="./data/app_domestic/<?= $dad['report_ver2'] ?>" target="_blank" download="<?= $dad['report_ver2_origin'] ?>"><?= $dad['report_ver2_origin'] ?></a></p>
                                                    </li>
                                                <? } ?>
                                                <? if($rowh1['txt_mod_ver2']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">2차 수정요청사항</p>
                                                        <p class="fs_15"><?= $rowh1['txt_mod_ver2'] ?></p>
                                                    </li>
                                                <? } ?>

                                                <? if($rowh1['d_content_file3']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">3차 보고서</p>
                                                        <p class="fs_15"><a href="./data/app_domestic/<?= $dad['report_ver3'] ?>" target="_blank" download="<?= $dad['report_ver3_origin'] ?>"><?= $dad['report_ver3_origin'] ?></a></p>
                                                    </li>
                                                <? } ?>
                                                <? if($rowh1['txt_mod_ver3']!=""){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">3차 수정요청사항</p>
                                                        <p class="fs_15"><?= $rowh1['txt_mod_ver3'] ?></p>
                                                    </li>
                                                <? } ?>

                                                <? if($rowh1['d_price']){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">결제 금액</p>
                                                        <p class="fs_15"><?= number_format($rowh1['d_price']) ?>원</p>
                                                    </li>
                                                <? } ?>

                                                <? if($rowh1['d_pay_method']){ ?>
                                                    <li>
                                                        <p class="fw_500 fc_gr222 w_150">결제 수단</p>
                                                        <p class="fs_15">
                                                            <?
                                                            if($rowh1['d_pay_method']=="card"){
                                                                echo "카드";
                                                            }else if($rowh1['d_pay_method']=="vbank"){
                                                                echo "무통장입금";
                                                            }else{
                                                                echo $rowh1['d_pay_method'];
                                                            }
                                                            ?>
                                                        </p>
                                                    </li>
                                                <? } ?>
                                            </ul>
                                        </li>
                                        <?
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <div class='info-tit mt_50'>결제정보<div class='expand'></div>
                        </div>
                        <div class='info_cont'>
                            <ul class="ic_pay">
                                <?
                                $sql = "select * from order_domestic where app_idx = '{$row['app_idx']}' and app_item_idx = '{$idx}' order by idx desc ";
                                $o_list1 = $DB->select_query($sql);
                                if(count($o_list1)>0) {
                                    foreach ($o_list1 as $rowo1) {
                                        ?>
                                        <li>
                                            <div class="bg_lgr rounded-lg p_25_20 pay-info">
                                                <div class="font-18 font-weight-700 mb-3"><?= $rowo1['odname'] ?></div>
                                                <ul class="payment_list">
                                                    <? if($rowo1['sum_price']>0){ ?>
                                                        <li>
                                                            <p class="fw_500 fc_gr222 mr-2">주문금액</p>
                                                            <p class="fw_500"><?= number_format($rowo1['sum_price']) ?>원</p>
                                                        </li>
                                                    <? } ?>
                                                    <? if($rowo1['sale_price_mtcode']>0){ ?>
                                                        <li>
                                                            <p class="fw_500 fc_gr222 mr-2">추천인 코드 등록</p>
                                                            <p class="fw_500"><?= "- ".number_format($rowo1['sale_price_mtcode']) ?>원</p>
                                                        </li>
                                                    <? } ?>
                                                    <? if($rowo1['sale_price_salecode']>0){ ?>
                                                        <li>
                                                            <p class="fw_500 fc_gr222 mr-2">할인코드 차감</p>
                                                            <p class="fw_500"><?= "- ".number_format($rowo1['sale_price_salecode']) ?>원</p>
                                                        </li>
                                                    <? } ?>
                                                    <? if($rowo1['sale_price_point']>0){ ?>
                                                        <li>
                                                            <p class="fw_500 fc_gr222 mr-2">포인트 할인</p>
                                                            <p class="fw_500"><? echo "- ".number_format($rowo1['sale_price_point']); ?>원</p>
                                                        </li>
                                                    <? } ?>
                                                </ul>
                                                <div class="payment">
                                                    <p class="fs_18 fc_gr222 fw_600">결제 금액</p>
                                                    <p class="fs_24 fc_bdk fw_600"><? echo number_format($rowo1['paid_amount']); ?>원</p>
                                                </div>
                                            </div>
                                        </li>
                                        <?
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <!-- process_information 끝 -->



                </div>
                <!-- w-65 끝-->
                <!-- division 끝 / 서브페이지 영역 2분할 -->
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- sub_pg 끝 -->

<script>
    var hd_height = $("#hd").height(); //헤더의 높이를 구합니다.
    $(document).scroll(function() { //페이지내에서 스크롤이 시작되면
        curSc = $(document).scrollTop() + $(window).height(); //현재 스크롤의 위치입니다.
        body_height = $("body").height(); //body의 높이를 구합니다.
        footer_height = $(".ft").height(); // 푸터의 높이를 구합니다.
        bottom_top = body_height - footer_height; //푸터를 제외한 body의 길이를 구합니다.
        if (window.innerWidth > 1560) {

            if (curSc > bottom_top + 20) { // 현재 스크롤의 높이가 body_top 보다 크다면 (하단 영역에 도착했다면)  *20 은 적당히 조절해주시면 됩니다.
                $(".my_page").css('top', 'auto'); //fixed top 성질을 없애고
                $(".my_page").css('bottom', curSc - bottom_top + 150); //fixed bottom 을 줍니다.
            } else {
                $(".my_page").css('top', hd_height + 60); // 그렇지않으면 상단에 고정되게 합니다.
            }
        }
        resize();
    })
</script>

<script>
    $(document).ready(function() {
        $('.info-tit').mouseenter(function() {
            $(this).children('.expand').addClass('turn');
        });
        $('.info-tit').mouseleave(function() {
            if ($(this).hasClass('open')) {} else {
                $(this).children('.expand').removeClass('turn');
            }
        });
        $('.info-tit').click(function() {
            var $this = $(this);
            if ($this.hasClass('open')) {
                $('.info-tit').removeClass('open');
                $('.info_cont').stop(true).slideUp("fast");
                $('.expand').removeClass('turn');
                $this.removeClass('open');
                $this.children('.expand').removeClass('turn');
                $this.next().stop(true).slideUp("fast");
            } else {
                $('.info-tit').removeClass('open');
                $('.info_cont').stop(true).slideUp("fast");
                $('.expand').removeClass('turn');

                $this.addClass('open');
                $this.children('.expand').addClass('turn');
                $this.next().stop(true).slideDown("fast");
            }
        });
    });
</script>



<script>
    //더보기, 접기 버튼
    $('.detail_text_wrap .text_more').on('click', function() {
        let textHeight = $('.detail_text span').outerHeight();
        if ($(this).prev().height() <= 22) {
            $(this).prev().animate({
                'overflow': 'unset',
                'height': textHeight
            });
            $(this).text('접기');
        } else {
            $(this).prev().animate({
                'overflow': 'hidden',
                'height': '22px'
            });
            $(this).text('더보기');
        }
    });
</script>

<?php
include "./foot_inc.php";
?>

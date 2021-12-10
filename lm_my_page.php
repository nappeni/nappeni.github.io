<div class="w-30 my_page">
    <h3 class="sub_tit2 fc_bdk"><?= $_SESSION['mt_name']?> 회원님 <span class="fs_19 fw_500 fc_gr666">반갑습니다.</span></h3>
    <div class="bg-wh rounded-lg p_20 fw_600 mb_20">
        <a href="./point_list.php" class="d-flex align-items-center justify-content-between ">
            <p class="fs_18 fc_gr222">보유 포인트</p>
            <p class="fs_24 fc_bdk"><?= number_format($info->getPoint()) ?>P</p>
        </a>
    </div>
    <ul class="my_menu">
        <li><a href="./account_management.php" class="<? if($idx_lm1==1){echo 'active';} ?>">계정관리</a></li>
        <li>
            <a href="./pending_application_list.php">상표현황</a>
            <ul class="my_menu_2ul">
                <li>
                    <a href="./pending_application_list.php">출원상표 현황</a>
                    <ul class="my_menu_3ul">
                        <li><a href="./pending_application_list.php" class="<? if($idx_lm1==2 && $idx_lm2==1 && $idx_lm3==1){echo 'active';} ?>">- 출원준비 상표</a></li>
                        <li><a href="./completed_application_list.php" class="<? if($idx_lm1==2 && $idx_lm2==1 && $idx_lm3==2){echo 'active';} ?>">- 출원완료 상표</a></li>
                    </ul>
                </li>
                <li><a href="./application_overseas_list.php" class="<? if($idx_lm1==2 && $idx_lm2==2){echo 'active';} ?>">해외 출원상표 현황</a></li>
                <li><a href="./registered_trademark_list.php" class="<? if($idx_lm1==2 && $idx_lm2==3){echo 'active';} ?>">등록상표 현황</a></li>
            </ul>
        </li>
        <!--<li>
            <a href="./personal_inquiry_list.php">고객센터</a>
            <ul class="my_menu_2ul">
            <li><a href="./personal_inquiry_view.php" class="<?/* if($idx_lm1==3 && $idx_lm2==1){echo 'active';} */?>">1:1 문의하기</a></li>
                <li><a href="./personal_inquiry_list.php" class="<?/* if($idx_lm1==3 && $idx_lm2==2){echo 'active';} */?>">1:1 문의 내역</a></li>
            </ul>
        </li>-->
    </ul>
</div>
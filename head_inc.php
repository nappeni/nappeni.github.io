<?
	include "./lib_inc.php";
?>
<!doctype html>
<html lang="ko">
<head>
    <?php session_start();?>
	<meta charset="UTF-8">
	<meta name="Generator" content="<?=APP_TITLE?>">
	<meta name="Author" content="<?=APP_AUTHOR?>">
	<meta name="Keywords" content="<?=KEYWORDS?>">
	<meta name="Description" content="<?=DESCRIPTION?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-title" content="<?=APP_TITLE?>">
	<meta content="telephone=no" name="format-detection">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta property="og:title" content="<?=APP_TITLE?>">
	<meta property="og:description" content="<?=APP_TITLE?>">
	<meta property="og:image" content="<?=DESIGN_HTTP?>/img/og-image.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?=DESIGN_HTTP?>/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=DESIGN_HTTP?>/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=DESIGN_HTTP?>/img/favicon-16x16.png">
	<link rel="manifest" href="">
	<link rel="mask-icon" href="" color="#ffffff">
	<meta name="msapplication-TileColor" content="">
	<meta name="theme-color" content="">
	<title><?=APP_TITLE?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--부트스트랩-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/navbar-fixed/">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- 폰트-->
    <!-- <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR:100,300,400,500,700,900&display=swap&subset=korean" rel="stylesheet"> -->

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/xeicon@2.3.3/xeicon.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

    <!-- JS -->
    <!-- <script type="text/javascript" src="./js/slick.min.js"></script> -->

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.8.js"></script>
    <script type="text/javascript" src="./lib/number_master/jquery.number.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="<?=DESIGN_HTTP?>/css/custom.css"><!-- 부트 커스텀 -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="<?=DESIGN_HTTP?>/css/common.css"><!-- 헤더/푸터 관련 CSS -->
    <link rel="stylesheet" href="<?=DESIGN_HTTP?>/css/design.css"><!-- 디자인 변경되는 부분 -->
    <link rel="stylesheet" href="<?=DESIGN_HTTP?>/css/design_dy.css"><!-- 다연 css -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <link rel="stylesheet" href="./css/jm_css.css">
    <script type="text/javascript" src="./js/jm_js.js"></script>

	<link rel="stylesheet" href="./css/jy_css.css">
    <script type="text/javascript" src="./js/jy_js.js"></script>
</head>

<body <? if($chk_index) { ?>class="idx"<? } ?> >

    <div id="hd" class="fixed-top bg-white border-bottom px-4 px-lg-5 py-sm-4 py-2 py-lg-0">
        <nav class="navbar navbar-expand-lg px-0 justify-content-between container-xl">
            <h1 class="logo">
                <a class="navbar-brand d-block" href="./index.php">
                    <img class="img_logo" src="<?=DESIGN_HTTP?>/img/logo.png" alt="닥터마크 로고">
                    <img class="main_logo" src="<?=DESIGN_HTTP?>/img/logo_w.png" alt="닥터마크 로고">
                </a>
            </h1>
            <div class="navbar-collapse d-flex flex-column flex-lg-row-reverse justify-content-between">
                <div class="d-flex flex-column flex-lg-row-reverse justify-content-between w-100 align-items-lg-center">
                    <button class="close_btn" type="button"><i class="xi xi-close"></i></button>
                    <div class="top_manu mx-4 mx-lg-0 pt-5 pb-4 pt-lg-0 pb-lg-0 fs_17">
                        <?php if(!isset($_SESSION['mt_id'])){?>
                        <ul class="mr-4 mb-3 mb-lg-0 d-flex align-items-center">
                            <li><a href="./join.php">회원가입</a></li>
                            <li><a href="./login.php" class="login_a">로그인</a></li>
                        </ul>
                        <?php }?>
                        <!-- 로그인전 -->
                        <?php if(isset($_SESSION['mt_id'])){?>
                        <div class="d-flex flex-column flex-column-reverse flex-lg-row align-items-lg-center">
                            <ul class="mr-4 mb-3 mb-lg-0 d-flex align-items-center">
                                <li><a href="./account_management.php">마이페이지</a></li>
                                <li><a href="./JYController/logout.php" class="login_a">로그아웃</a></li>
                            </ul>
                        </div>
                        <?php }?>
                        <!-- 로그인후 -->
                    </div>
                    <ul class="navbar-nav mr-auto fs_19  ff_sr">
                        <li class="nav-item active">
                            <a class="nav-link" href="./application_domestic_step1.php">상표 출원하기</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./product_description.php">상품설명</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./use.php">이용방법</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./reviews_list.php">이용후기</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./application_overseas_step1.php">해외상표 출원하기</a>
                        </li>
                    </ul>
                </div>


            </div>
            <div class="navbar-bg"></div>
            <div>
                <button class="navbar-toggler collapsed" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </div>

<?php
if(strpos("a".$_SERVER['REQUEST_URI'],"application_domestic_")==false){
    $sql = "select * from d_app_domestic where mt_idx = '{$_SESSION['mt_idx']}' and app_status < 1 and d_datetime = '' ";
    $dad = $DB->fetch_assoc($sql);
    $idx = $dad['idx'];

    // 1단계 데이터 삭제
    $_SESSION['cate_mark'] = "";
    $_SESSION['name_mark'] = "";
    unlink("./data/app_domestic/".$_SESSION['img_mark']);
    $_SESSION['img_mark_origin'] = "";
    $_SESSION['img_mark'] = "";
    $_SESSION['chk_use1'] = "";
    $_SESSION['txt_ps'] = "";
    $_SESSION['link_shop'] = "";
    $_SESSION['type_applicant'] = "";



    // 2단계 데이터 삭제
    $sql = "delete from d_app_domestic_item where app_idx = '{$idx}' ";
    $DB->db_query($sql);
    $sql = "select count(*) as cnt from d_app_domestic_item";
    $row = $DB->fetch_assoc($sql);
    $sql = "ALTER TABLE d_app_domestic_item AUTO_INCREMENT={$row['cnt']} ";
    $DB->db_query($sql);

    // 3단계 데이터 삭제
    unlink("./data/app_domestic/".$_SESSION['agent_file']);
    $_SESSION['agent_file'] = "";
    $_SESSION['agent_file_origin'] = "";
    unlink("./data/app_domestic/".$_SESSION['file_cop1']);
    $_SESSION['file_cop1'] = "";
    $_SESSION['file_cop1_origin'] = "";
    unlink("./data/app_domestic/".$_SESSION['file_passport']);
    $_SESSION['file_passport'] = "";
    $_SESSION['file_passport_origin'] = "";
    unlink("./data/app_domestic/".$_SESSION['file1_cert_forei']);
    $_SESSION['file1_cert_forei'] = "";
    $_SESSION['file1_cert_forei_origin'] = "";
    unlink("./data/app_domestic/".$_SESSION['file2_cert_forei']);
    $_SESSION['file2_cert_forei'] = "";
    $_SESSION['file2_cert_forei_origin'] = "";
    unlink("./data/app_domestic/".$_SESSION['file_sign3']);
    $_SESSION['file_sign3'] = "";
    $_SESSION['file_sign3_origin'] = "";
    unlink("./data/app_domestic/".$_SESSION['file_sign4']);
    $_SESSION['file_sign4'] = "";
    $_SESSION['file_sign4_origin'] = "";
    unlink("./data/app_domestic/".$_SESSION['file1_institution']);
    $_SESSION['file1_institution'] = "";
    $_SESSION['file1_institution_origin'] = "";
    unlink("./data/app_domestic/".$_SESSION['pay_file']);
    $_SESSION['pay_file'] = "";
    $_SESSION['pay_file_origin'] = "";


    $sql = "delete from d_app_domestic where idx = '{$idx}' ";
    $DB->db_query($sql);
    $sql = "select count(*) as cnt from d_app_domestic";
    $row = $DB->fetch_assoc($sql);
    $sql = "ALTER TABLE d_app_domestic AUTO_INCREMENT={$row['cnt']} ";
    $DB->db_query($sql);
}
if(strpos("a".$_SERVER['REQUEST_URI'],"application_overseas_")==false){
    $_SESSION['o_type'] = "";
    $_SESSION['o_color'] = "";
    $_SESSION['o_nations'] = "";
    $_SESSION['o_class'] = "";
}
?>
<!doctype html>
<html lang="ko">

<head>
    <!-- from.퍼블리셔 아래 내용 채워 주세요 -->
    <meta charset="UTF-8">
    <meta name="Generator" content="닥터마크">
    <meta name="Author" content="닥터마크">
    <meta name="Keywords" content="닥터마크">
    <meta name="Description" content="닥터마크">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-title" content="닥터마크">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta property="og:title" content="닥터마크">
    <meta property="og:description" content="닥터마크">
    <meta property="og:image" content="./img/og-image.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon-16x16.png">
    <link rel="manifest" href="">
    <link rel="mask-icon" href="" color="#ffffff">
    <meta name="msapplication-TileColor" content="">
    <meta name="theme-color" content="">
    <title>닥터마크</title>

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
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <!-- CSS -->
    <link rel="stylesheet" href="./css/custom.css"><!-- 부트 커스텀 -->
    <!-- <link rel="stylesheet" type="text/css" href="./css/slick.css" /> -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="./css/common.css"><!-- 헤더/푸터 관련 CSS -->
    <link rel="stylesheet" href="./css/design.css"><!-- 디자인 변경되는 부분 -->
    <link rel="stylesheet" href="./css/design_dy.css"><!-- 다연 css -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">






</head>

<?php if ($_SERVER['PHP_SELF'] == "/design/index.php") { ?>

    <body class="idx">
    <? } else { ?>

        <body>
        <? } ?>


        <div id="hd" class="fixed-top bg-white border-bottom px-4 px-lg-5 py-sm-4 py-2 py-lg-0">
            <nav class="navbar navbar-expand-lg px-0 justify-content-between container-xl">
                <h1 class="logo">
                    <a class="navbar-brand d-block" href="./index.php">
                        <img class="img_logo" src="./img/logo.png" alt="닥터마크 로고">
                        <img class="main_logo" src="./img/logo_w.png" alt="닥터마크 로고">
                    </a>
                </h1>
                <div class="navbar-collapse d-flex flex-column flex-lg-row-reverse justify-content-between">
                    <div class="d-flex flex-column flex-lg-row-reverse justify-content-between w-100 align-items-lg-center">
                        <button class="close_btn" type="button"><i class="xi xi-close"></i></button>
                        <div class="top_manu mx-4 mx-lg-0 pt-5 pb-4 pt-lg-0 pb-lg-0 fs_17">
                            <ul class="mr-4 mb-3 mb-lg-0 d-flex align-items-center">
                                <li><a href="./join.php">회원가입</a></li>
                                <li><a href="./login.php" class="login_a">로그인</a></li>
                            </ul>
                            <!-- 로그인전 -->

                            <!-- <div class="d-flex flex-column flex-column-reverse flex-lg-row align-items-lg-center">
								<a class="tc_link border-0 bg-primary text-white ff_sr fw_900 fs_20" href="./me_lecture_sct.php">내 수업<img class="d-inline-block ml-3" src="./img/top_myclass.png"></a>
								<ul class="ml-4 mb-3 mb-lg-0">
									<li><strong>김엄마님</strong><a href="#" class="login_a">로그아웃</a></li>
								</ul>
							</div> -->
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
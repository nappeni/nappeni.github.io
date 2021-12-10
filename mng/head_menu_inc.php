<?
	$hostname=$_SERVER["HTTP_HOST"]; //도메인명(호스트)명을 구합니다.
    $uri= $_SERVER['REQUEST_URI']; //uri를 구합니다.
    $query_string=getenv("QUERY_STRING"); // Get값으로 넘어온 값들을 구합니다.
    $phpself=$_SERVER["PHP_SELF"]; //현재 실행되고 있는 페이지의 url을 구합니다.
    $basename=basename($_SERVER["PHP_SELF"]); //현재 실행되고 있는 페이지명만 구합니다.
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
    
    if($_SESSION['mt_idx'] != 1) {
        alert("관리자만 접근할 수 있습니다.", "../login.php?url=".$protocol.$hostname.$uri);
    }
?>
<style>
    .sidebar .nav.sub-menu .nav-item .nav-link.active{
        color: #0091ea;
    }
</style>

<? if($chk_ckeditor=="Y") { ?>
<script src="//cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
<? } ?>

<div class="container-scroller">
	<!-- 상단바 시작 -->
	<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
		<div class="navbar-brand-wrapper d-flex justify-content-center">
			<div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
				<a class="navbar-brand brand-logo" href="./">
					<img src="<?=CDN_HTTP?>/images/logo_mng_head.png" alt="logo" style="width:107px;" />
				</a>
				<a class="navbar-brand brand-logo-mini" href="./">
					<img src="<?=CDN_HTTP?>/images/favicon-32x32.png" alt="logo" />
				</a>
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize"> <span class="mdi mdi-sort-variant"></span></button>
			</div>
		</div>
		<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
			<ul class="navbar-nav navbar-nav-right">
				<li class="nav-item nav-profile dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown"><span class="nav-profile-name"><?=$_SESSION['mt_name']?> 님 반갑습니다.</span></a>
					<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
						<a href="../" class="dropdown-item" target="_blank"> <i class="mdi mdi-home text-primary"></i> 홈페이지</a>
						<a href="../logout.php" class="dropdown-item"> <i class="mdi mdi-logout text-primary"></i> 로그아웃</a>
					</div>
				</li>
			</ul>
			<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas"> <span class="mdi mdi-menu"></span></button>
		</div>
	</nav>
	<!-- 상단바 끝 -->

	<div class="container-fluid page-body-wrapper">
		<!-- 왼쪽메뉴 시작 -->
		<nav class="sidebar sidebar-offcanvas" id="sidebar">
			<ul class="nav">
				<li class="nav-item<? if($chk_menu=='') { ?> active<? } ?>">
					<a class="nav-link" href="./"> <i class="mdi mdi-home menu-icon"></i>
						<span class="menu-title">대시보드</span>
					</a>
				</li>

                <li class="nav-item<? if($chk_menu=='1') { ?> active<? } ?>">
                    <a class="nav-link" data-toggle="collapse" href="#nav1" aria-expanded="<? if($chk_menu=='1') { ?>true<? } else { ?>false<? } ?>" aria-controls="nav1">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">국내 출원 관리</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse<? if($chk_menu=='1') { ?> show<? } ?>" id="nav1">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='1' && $chk_sub_menu=='1') { ?> active<? } ?>" href="./app_domestic_list.php">출원 준비 관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='1' && $chk_sub_menu=='2') { ?> active<? } ?>" href="./completed_application_list.php">상품류별 사건관리</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item<? if($chk_menu=='2') { ?> active<? } ?>">
                    <a class="nav-link <? if($chk_menu=='2') { ?>active<? } ?>" href="./app_overseas_list.php">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">국제 출원 관리</span>
                    </a>
                </li>

                <li class="nav-item<? if($chk_menu=='3') { ?> active<? } ?>">
                    <a class="nav-link <? if($chk_menu=='3') { ?>active<? } ?>" href="./registered_trademark_list.php">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">등록료 납부 관리</span>
                    </a>
                </li>

				<li class="nav-item<? if($chk_menu=='4') { ?> active<? } ?>">
					<a class="nav-link" data-toggle="collapse" href="#nav4" aria-expanded="<? if($chk_menu=='4') { ?>true<? } else { ?>false<? } ?>" aria-controls="nav4">
						<i class="mdi mdi-account-card-details-outline menu-icon"></i>
							<span class="menu-title">회원관리</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse<? if($chk_menu=='4') { ?> show<? } ?>" id="nav4">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item"> <a class="nav-link<? if($chk_menu=='4' && $chk_sub_menu=='1') { ?> active<? } ?>" href="./member_mng.php">일반회원 관리</a></li>
							<li class="nav-item"> <a class="nav-link<? if($chk_menu=='4' && $chk_sub_menu=='2') { ?> active<? } ?>" href="./member_point.php">회원 포인트 내역</a></li>
						</ul>
					</div>
				</li>

                <li class="nav-item<? if($chk_menu=='5') { ?> active<? } ?>">
                    <a class="nav-link" data-toggle="collapse" href="#nav5" aria-expanded="<? if($chk_menu=='5') { ?>true<? } else { ?>false<? } ?>" aria-controls="nav5">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">카테고리 관리</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse<? if($chk_menu=='5') { ?> show<? } ?>" id="nav5">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='5' && $chk_sub_menu=='1') { ?> active<? } ?>" href="./category_domestic.php">국내 카테고리 관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='5' && $chk_sub_menu=='2') { ?> active<? } ?>" href="./category_overseas.php">국제 카테고리 관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='5' && $chk_sub_menu=='3') { ?> active<? } ?>" href="./category_nation_list.php">국가 관리</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item<? if($chk_menu=='6') { ?> active<? } ?>">
                    <a class="nav-link" data-toggle="collapse" href="#nav6" aria-expanded="<? if($chk_menu=='6') { ?>true<? } else { ?>false<? } ?>" aria-controls="nav6">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">비용관리</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse<? if($chk_menu=='6') { ?> show<? } ?>" id="nav6">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='6' && $chk_sub_menu=='1') { ?> active<? } ?>" href="priceofservice_list.php">서비스 금액 관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='6' && $chk_sub_menu=='2') { ?> active<? } ?>" href="order_list.php">결제 관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='6' && $chk_sub_menu=='3') { ?> active<? } ?>" href="refund_list_domestic.php">환불 관리</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item<? if($chk_menu=='7') { ?> active<? } ?>">
                    <a class="nav-link <? if($chk_menu=='7') { ?>active<? } ?>" href="./discount_code_list.php">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">할인코드 관리</span>
                    </a>
                </li>

                <li class="nav-item<? if($chk_menu=='8') { ?> active<? } ?>">
                    <a class="nav-link" data-toggle="collapse" href="#nav8" aria-expanded="<? if($chk_menu=='8') { ?>true<? } else { ?>false<? } ?>" aria-controls="nav8">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">게시글 관리</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse<? if($chk_menu=='8') { ?> show<? } ?>" id="nav8">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='8' && $chk_sub_menu=='1') { ?> active<? } ?>" href="dockter_mark_review_list.php">닥터마크 이용후기 목록</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='8' && $chk_sub_menu=='2') { ?> active<? } ?>" href="main_banner.php">배너관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='8' && $chk_sub_menu=='3') { ?> active<? } ?>" href="use_review.php">이용후기 관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='8' && $chk_sub_menu=='4') { ?> active<? } ?>" href="success_list.php">성공사례 관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='8' && $chk_sub_menu=='5') { ?> active<? } ?>" href="terms_mng.php">이용약관 관리</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item<? if($chk_menu=='9') { ?> active<? } ?>">
                    <a class="nav-link" data-toggle="collapse" href="#nav9" aria-expanded="<? if($chk_menu=='9') { ?>true<? } else { ?>false<? } ?>" aria-controls="nav9">
                        <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                        <span class="menu-title">서비스 관리</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse<? if($chk_menu=='9') { ?> show<? } ?>" id="nav9">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='9' && $chk_sub_menu=='1') { ?> active<? } ?>" href="faq_cate_list.php">FAQ 카테고리 관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='9' && $chk_sub_menu=='2') { ?> active<? } ?>" href="faq_mng_list.php">FAQ 관리</a></li>
                            <li class="nav-item"> <a class="nav-link<? if($chk_menu=='9' && $chk_sub_menu=='3') { ?> active<? } ?>" href="personal_inquiry_list.php">1:1문의 관리</a></li>
                        </ul>
                    </div>
                </li>
				<!--<li class="nav-item<?/* if($chk_menu=='4') { */?> active<?/* } */?>">
					<a class="nav-link" data-toggle="collapse" href="#contents" aria-expanded="<?/* if($chk_menu=='4') { */?>true<?/* } else { */?>false<?/* } */?>" aria-controls="contents">
						<i class="mdi mdi-bulletin-board menu-icon"></i>
							<span class="menu-title">컨첸츠관리</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse<?/* if($chk_menu=='4') { */?> show<?/* } */?>" id="contents">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item"> <a class="nav-link<?/* if($chk_menu=='4' && $chk_sub_menu=='1') { */?> active<?/* } */?>" href="./notice_list.php">공지사항</a></li>
							<li class="nav-item"> <a class="nav-link<?/* if($chk_menu=='4' && $chk_sub_menu=='2') { */?> active<?/* } */?>" href="./banner_list.php">배너관리</a></li>
						</ul>
					</div>
				</li>-->

			</ul>
		</nav>
		<!-- 왼쪽메뉴 끝 -->

		<div class="main-panel">
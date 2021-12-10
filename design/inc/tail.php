		<!-- <div id="btn_top"><a class="ff_sr" href="#hd"><span>TOP</span></a></div>
		<script>
			$(function() {
				$(window).scroll(function() {
					if ($(this).scrollTop() > 200) {
						$('#btn_top').fadeIn();
					} else {
						$('#btn_top').fadeOut();
					}
				});
				
				$("#btn_top").click(function() {
					$('html, body').animate({
						scrollTop : 0
					}, 200);
					return false;
				});
			});
		</script> -->


		<footer class="ft text-muted bg_lgr py-5 container-fluid">
		    <div class="container-xl py-3">
		        <div class="row">
		            <div class="col-12 col-xl-2 mb-xl-0 mb-3 mb-sm-5">
		                <a class="ft_logo mb-4" href="./index.php"><img class="d-inline-block mw-100" src="./img/ft_logo.png" alt="닥터마크 로고"></a>
		            </div>
		            <div class="d-block d-lg-flex col-12 col-xl-10 justify-content-between">
		                <div class="mr-3">
		                    <div class="ft_link mb_15">
		                        <a href="./about_us.php" class="fc_gr222 fw_500">회사소개</a>
		                        <a href="./faq.php" class="fc_gr222 fw_500 px-3 px-sm-4 br_left">자주하는 질문</a>
		                        <a href="./terms_of_use.php" class="fc_gr222 fw_500 px-3 px-sm-4 br_left">이용약관 및 개인정보</a>
		                    </div>
		                    <div class="ft_cont">
		                        <div class="d-flex flex-wrap">
		                            <p class="fs_15 fc_gr999 mr-4"><span class="fc_gr666 mr-2">회사명</span> 닥터마크</p>
		                            <p class="fs_15 fc_gr999 mr-4"><span class="fc_gr666 mr-2">대표자</span> 임승섭, 장이안</p>
		                            <p class="fs_15 fc_gr999 mr-4"><span class="fc_gr666 mr-2">광고책임변리사</span> 장이안</p>
		                        </div>
		                        <p class="fs_15 fc_gr999"><span class="fc_gr666 mr-2">주소</span> 서울특별시 광진구 능동로 37길 7 2층</p>
		                        <div class="d-flex flex-wrap">
		                            <p class="fs_15 fc_gr999 mr-4"><span class="fc_gr666 mr-2">사업자등록번호</span> XXXXX</p>
		                            <p class="fs_15 fc_gr999 mr-4"><span class="fc_gr666 mr-2">통신판매업신고</span> 2021XX-XX-X-MMMM-XXXXX</p>
		                        </div>
		                        <div class="d-flex mb_15 flex-wrap">
		                            <p class="fs_15 fc_gr999 mr-4"><span class="fc_gr666 mr-2">계좌 기업은행</span> XXXX-XXX-XXXXXXX</p>
		                            <p class="fs_15 fc_gr999 mr-4"><span class="fc_gr666 mr-2">E-Mail</span> help@drmark.co.kr</p>
		                            <p class="fs_15 fc_gr999 mr-4"><span class="fc_gr666 mr-2">FAX</span> 02-568-2052</p>
		                        </div>
		                        <p class="fs_15 fc_gr999">COPYRIGHT(c) 2021 닥터마크. ALL RIGHTS RESERVED.</p>
		                    </div>
		                </div>
		                <div class="service_center mt-5 mt-lg-0">
		                    <p class="fs_17 fc_gr222 fw_600 mb-1">고객센터</p>
		                    <p class="fs_14 fc_gr999 mb_10">상표출원에 대한 문의는 <span class="fc_primary">우측 하단의 실시간 채팅상담</span>이 가장 빠릅니다.</p>
		                    <div class="d-flex align-items-center justify-content-between row">
		                        <strong class="fs_30 fw_600 fc_primary col-6 text-center">1588-MMMM</strong>
		                        <div class="br_left pl-5 col-6">
		                            <div class="d-flex mb-1">
		                                <small class="fs_15 fc_gr666 fw_500">평일</small>
		                                <span class="fs_15 fc_gr999">10:00 - 17:00</span>
		                            </div>
		                            <div class="d-flex mb-1">
		                                <small class="fs_15 fc_gr666 fw_500">점심시간</small>
		                                <span class="fs_15 fc_gr999">12:00 - 13:00</span>
		                            </div>
		                            <div class="d-flex">
		                                <small class="fs_15 fc_gr666 fw_500">휴무</small>
		                                <span class="fs_15 fc_gr999">토,일,공휴일</span>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</footer>

		<!-- 채널톡 -->
		<div id="ch_bot">
		    <button class="btn">
		        <img src="./img/ch_bot.png" alt="">
		    </button>
		</div>


		<script>
		    // 모바일 메뉴
		    $('.nav-item .arrow').on('click', function() {
		        if ($(this).parent().children().hasClass('dropdown-menu')) {
		            $(this).siblings('.dropdown-menu').toggleClass('on');
		        }
		    });
		    $('.navbar-toggler').on('click', function() {
		        $('.navbar-collapse').toggleClass('show');
		        $('.navbar-bg').toggleClass('show');
		    });
		    $('.navbar-collapse .close_btn').on('click', function() {
		        $('.navbar-collapse').toggleClass('show');
		        $('.navbar-bg').toggleClass('show');
		    });
		    $('.navbar-bg').on('click', function() {
		        $('.navbar-collapse').toggleClass('show');
		        $('.navbar-bg').toggleClass('show');
		    });
		    //상단검색
		    $('.ic_find').on('click', function() {
		        $('.top_search').toggleClass('show');
		        $('.top_search_bg').toggleClass('show');
		    });
		    $('.top_search_bg').on('click', function() {
		        $('.top_search').toggleClass('show');
		        $('.top_search_bg').toggleClass('show');
		    });
		    $('.top_search_close').on('click', function() {
		        $('.top_search').toggleClass('show');
		        $('.top_search_bg').toggleClass('show');
		    });
		</script>




		</body>

		</html>
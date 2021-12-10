<footer class="ft text-muted bg_lgr py-5 container-fluid">
    <div class="container-xl py-3">
        <div class="row">
            <div class="col-12 col-xl-2 mb-xl-0 mb-3 mb-sm-5">
                <a class="ft_logo mb-4" href="./index.php"><img class="d-inline-block mw-100" src="./images/ft_logo.png" alt="닥터마크 로고"></a>
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
<!--<div id="ch_bot">
    <button class="btn">
        <img src="./img/ch_bot.png" alt="">
    </button>
</div>-->

<!-- Channel Plugin Scripts -->
<script>
    (function() {
        var w = window;
        if (w.ChannelIO) {
            return (window.console.error || window.console.log || function(){})('ChannelIO script included twice.');
        }
        var ch = function() {
            ch.c(arguments);
        };
        ch.q = [];
        ch.c = function(args) {
            ch.q.push(args);
        };
        w.ChannelIO = ch;
        function l() {
            if (w.ChannelIOInitialized) {
                return;
            }
            w.ChannelIOInitialized = true;
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
            s.charset = 'UTF-8';
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        }
        if (document.readyState === 'complete') {
            l();
        } else if (window.attachEvent) {
            window.attachEvent('onload', l);
        } else {
            window.addEventListener('DOMContentLoaded', l, false);
            window.addEventListener('load', l, false);
        }
    })();
    ChannelIO('boot', {
        "pluginKey": "fa19e887-6943-4a06-831a-c5dd87d8d433"
    });
</script>
<!-- End Channel Plugin -->

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



<? if($chk_post_code=="Y") { ?>
    <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
        <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
    </div>

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        // 우편번호 찾기 화면을 넣을 element
        var element_layer = document.getElementById('layer');

        function closeDaumPostcode() {
            // iframe을 넣은 element를 안보이게 한다.
            element_layer.style.display = 'none';
        }

        function execDaumPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if(data.userSelectedType === 'R'){
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        // document.getElementById("sample2_extraAddress").value = extraAddr;

                    } else {
                        // document.getElementById("sample2_extraAddress").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('applicant_addr1').value = data.zonecode;
                    document.getElementById("applicant_addr2").value = addr;
                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById("applicant_addr3").focus();

                    // iframe을 넣은 element를 안보이게 한다.
                    // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                    element_layer.style.display = 'none';
                },
                width : '100%',
                height : '100%',
                maxSuggestItems : 5
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';

            // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
            initLayerPosition();
        }

        function execDaumPostcode2() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if(data.userSelectedType === 'R'){
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        // document.getElementById("sample2_extraAddress").value = extraAddr;

                    } else {
                        // document.getElementById("sample2_extraAddress").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('insti_addr1').value = data.zonecode;
                    document.getElementById("insti_addr2").value = addr;
                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById("insti_addr3").focus();

                    // iframe을 넣은 element를 안보이게 한다.
                    // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                    element_layer.style.display = 'none';
                },
                width : '100%',
                height : '100%',
                maxSuggestItems : 5
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';

            // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
            initLayerPosition();
        }

        function execDaumPostcode3() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if(data.userSelectedType === 'R'){
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        // document.getElementById("sample2_extraAddress").value = extraAddr;

                    } else {
                        // document.getElementById("sample2_extraAddress").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('agent_addr1').value = data.zonecode;
                    document.getElementById("agent_addr2").value = addr;
                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById("agent_addr3").focus();

                    // iframe을 넣은 element를 안보이게 한다.
                    // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                    element_layer.style.display = 'none';
                },
                width : '100%',
                height : '100%',
                maxSuggestItems : 5
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';

            // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
            initLayerPosition();
        }

        function execDaumPostcode4() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if(data.userSelectedType === 'R'){
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        // document.getElementById("sample2_extraAddress").value = extraAddr;

                    } else {
                        // document.getElementById("sample2_extraAddress").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('cert_forei_addr1').value = data.zonecode;
                    document.getElementById("cert_forei_addr2").value = addr;
                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById("cert_forei_addr3").focus();

                    // iframe을 넣은 element를 안보이게 한다.
                    // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                    element_layer.style.display = 'none';
                },
                width : '100%',
                height : '100%',
                maxSuggestItems : 5
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';

            // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
            initLayerPosition();
        }

        function execDaumPostcode5() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if(data.userSelectedType === 'R'){
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        // document.getElementById("sample2_extraAddress").value = extraAddr;

                    } else {
                        // document.getElementById("sample2_extraAddress").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('regit_mt_addr1').value = data.zonecode;
                    document.getElementById("regit_mt_addr2").value = addr;
                    // 커서를 상세주소 필드로 이동한다.
                    document.getElementById("regit_mt_addr3").focus();

                    // iframe을 넣은 element를 안보이게 한다.
                    // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                    element_layer.style.display = 'none';
                },
                width : '100%',
                height : '100%',
                maxSuggestItems : 5
            }).embed(element_layer);

            // iframe을 넣은 element를 보이게 한다.
            element_layer.style.display = 'block';

            // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
            initLayerPosition();
        }

        // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
        // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
        // 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
        function initLayerPosition(){
            var width = 300; //우편번호서비스가 들어갈 element의 width
            var height = 400; //우편번호서비스가 들어갈 element의 height
            var borderWidth = 5; //샘플에서 사용하는 border의 두께

            // 위에서 선언한 값들을 실제 element에 넣는다.
            element_layer.style.width = width + 'px';
            element_layer.style.height = height + 'px';
            element_layer.style.border = borderWidth + 'px solid';
            // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
            element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
            element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
        }
    </script>
<? } ?>

<iframe src="about:blank" name="hidden_ifrm" id="hidden_ifrm" style="display:none;"></iframe>

<div class="modal fade" id="splinner_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="text-center">
				<div class="spinner-border m-5" role="status"></div>
			</div>
			<div class="text-center mb-5">
				<span class="text-secondary">처리중입니다. 잠시만 기다려주세요.</span>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?
	include "./tail_inc.php";
?>
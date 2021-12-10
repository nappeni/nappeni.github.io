<?
	$chk_index = true;
	include "./head_inc.php";
    $query = "select * from banner_t where bt_show = 'Y' and bt_type = 1 order by bt_rank ";
    $rows = $DB->select_query($query,0);
    $query = "select * from banner_t where bt_show = 'Y' and bt_type = 2 order by bt_rank";
    $sucRow = $DB->select_query($query,0);
?>

    <div class="idx_pg">
        <div class="container-fluid px-0">
            <div class="main_visual">
                <div class="main_bn container-xl">
                    <?php
                    foreach($rows as $row){
                        $target = $row['bt_target1']=='Y'?'_block':'_self';
                    ?>
                    <div class="bn_item">
                        <a href="<?= $row['bt_link1']?>" target="<?= $target?>"class="d-block">
                            <div class="d-none d-lg-block bn" style="background: url('<?= $ct_img_url."/".$row['bt_file1']?>') no-repeat center; background-size: cover;"></div>
                            <img class="d-block d-lg-none w-100" src="<?= $ct_img_url."/".$row['bt_file1']?>">
                        </a>
                    </div>
                    <?php }?>
                </div>
                <script>
                    $('.main_bn').slick({
                        dots: true,
                        infinite: true,
                        speed: 800,
                        slidesToShow: 1,
                        arrows: false,
                        prevArrow: $('.prev'),
                        nextArrow: $('.next'),
                        autoplaySpeed: 4000,
                        autoplay: true,
                        fade: true,
                    }); //메인배너
                </script>
            </div>
            <!-- main_visual -->
            <div class="container-fluid sect bg_lgr sec_01" data-aos="fade" data-aos-duration="1500">
                <div class="container-xl row d-flex align-items-center justify-content-between">
                    <div class="col-12 col-xl-6">
                        <div class="main_qa_top">
                            <div class="d-flex justify-content-xl-start justify-content-center">
                                <strong class="fs_48 fw_600 fc_bdk line_h1_4 br_none text-xl-left">
                                    쉽고, 간편하게<br>
                                    전문적인<br><span class="br_block"></span>
                                    상표출원 서비스
                                </strong>
                            </div>
                            <div class="sec_01_text">
                                <div class="d-flex justify-content-xl-start justify-content-center">
                                    <p class="fs_30 fc_bdk mb_15 mt_35"><span class="fw_600">Dr.Mark</span> 란?</p>
                                </div>
                                <div class="d-flex justify-content-xl-start justify-content-center">
                                    <div class="d-block d-md-flex line_h1_7">
                                        <ul class="fs_16 pr_40 p-md-0 d-flex flex-column align-items-md-start align-items-center">
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>쉽고 간편하게 상표출원 의뢰</p>
                                            </li>
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>전문가에 의해 상표출원 준비 및 진행</p>
                                            </li>
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>출원 진행 실시간 모니터링 서비스 제공</p>
                                            </li>
                                        </ul>
                                        <ul class="fs_16 d-flex flex-column align-items-md-start align-items-center">
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>합리적인 가격으로 스마트한 서비스 제공</p>
                                            </li>
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>에스크로 대금결제 시스템을 통한 안전한 대금보호</p>
                                            </li>
                                            <li class="d-flex"><span class="flex-shrink-0 mr-2">- </span>
                                                <p>시작부터 끝까지 함께하는 담당 매니저</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <ul class="main_qa d-sm-block d-none">
                            <li>
                                <div class="d-flex align-items-center">
                                    <p class="fs_16 fw_300 fc_wh mr-4">상표를 등록 하지 않았는데, 먼저 사용해도 될까요?<br>
                                        상표를 등록하지 않고 미국 에서 물건을 판매해도 될까요?</p>
                                    <img src="./images/main_sec1_01.png" alt="">
                                </div>
                            </li>
                            <li class="bg-wh">
                                <div class="d-flex align-items-center">
                                    <img src="./images/main_sec1_02.png" alt="">
                                    <p class="fs_16 fw_300 fc_gr666 ml-4">상표권 분쟁이 발생하면 선사용(prior use)을 포함 다양한<br>
                                        상황을 고려하여 나의 상표권 소유를 증명해야 하는데요.<br>
                                        바로 이점으로 인해 오히려 상표의 등록이 더 필요하게 됩니다. </p>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex align-items-center">
                                    <p class="fs_16 fw_300 fc_wh mr-4">그렇구나! 감사합니다.<br>
                                        상표등록을 해놓으면 후에 문제가 생겼을 때 편하겠네요.</p>
                                    <img src="./images/main_sec1_01.png" alt="">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- sec_01 -->

            <div class="container-fluid sect bg-dark sec_02" data-aos="fade" data-aos-duration="1500">

                <div class="sec_02_slide d-block d-xl-flex align-items-center mb_55">
                    <div class="slider slider-for">
                        <div>
                            <strong class="fs_40 fc_wh fw_300 line_h1_3">
                                <span class="fw_500">고객의 비즈니스</span>에 맞는<br>
                                <span class="fw_500">브랜드 보호</span> 솔루션
                            </strong>
                            <p class="fc_wh fw_300 wh_pre mt_20 fs_16">세상에는 정말로 다양한 비즈니스가 있습니다.
                                그리고 비즈니스마다 필요한 브랜드 보호 전략이 있습니다.
                                빠른 시장에 발 맞춰야 하는 온라인 스토어의 브랜드 보호 전략은 가볍고 다양해야 합니다.
                                이에 비해 하나의 아이템도 소중하게 다뤄야 하는 스타트업의 브랜드 보호 전략은 조금 무겁더라도 깊고 자세해야 합니다.

                                닥터마크는 가벼운 브랜드 보호 전략이 필요한 고객분들에게는 비용부담 없이 이용가능한 간편출원 서비스를, 상세한 브랜드 보호 전략이 필요한 분들에게는 전문출원 서비스를 제공하여 고객의 비즈니스에 맞는 브랜드 보호 솔루션을 제공합니다.</p>
                        </div>
                        <div>
                            <strong class="fs_40 fc_wh fw_300 line_h1_3">
                                <span class="fw_500">비즈니스 빅데이터</span>를 이용한<br>
                                보다 쉽고 간편한 <span class="fw_500">상표출원</span>
                            </strong>
                            <p class="fc_wh fw_300 wh_pre mt_20 fs_16">특허청에서 고시하는 <지정상품 목록>에 기재되어 있는 수만개의 상품 이름은 현실과 다른 경우도 있고, 심지어 없는 경우도 있습니다.

                                    닥터마크는 비즈니스 빅데이터를 분석하여 현실에 맞게 특허청에서 고시하는 <지정상품 목록>을 분류하여 여러분이 보호받고자 하는 상표의 지정상품을 보다 쉽게 선택할 수 있는 간편한 상표출원 서비스를 제공합니다.</p>
                        </div>
                    </div>

                    <div class="slider slider-nav">
                        <div class="nav_img">
                            <img src="./images/sec2_img01.png" alt="">
                        </div>
                        <div class="nav_img">
                            <img src="./images/sec2_img02.png" alt="">
                        </div>
                    </div>

                </div>

            </div>

            <script>
                $('.slider-for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.slider-nav'
                });
                $('.slider-nav').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    asNavFor: '.slider-for',
                    dots: true,
                    arrows: false,
                    focusOnSelect: true,
                    centerMode: false,
                    variableWidth: true
                });

                $('a[data-slide]').click(function(e) {
                    e.preventDefault();
                    var slideno = $(this).data('slide');
                    $('.slider-nav').slick('slickGoTo', slideno - 1);
                });
            </script>



        </div>


    </div>
    <!-- sec_02 -->

    <div class="container-fluid sect bg_lgr sec_03" data-aos="fade" data-aos-duration="1500">
        <div class="d-flex justify-content-center mb_35 text-center">
            <strong class="fs_40 fc_gr222 fw_500"><span class="fw_600">성공사례</span>로 확인하는 <span class="fw_600 br_block">닥터마크</span></strong>
        </div>
        <div class="sec_03_slide mb_55">
        <?php foreach($sucRow as $srow[]);?>
            <div class="d-flex align-items-center justify-content-center">
                <ul class="success_story d-flex flex-wrap justify-content-center">
                <?php for($i=0; $i<4; $i++){?>
                    <li>
                        <div class="suc_str_top" style="background: url('<?= "https://dmonster1705.cafe24.com/data/app_domestic"."/".$srow[$i]['bt_file1']?>') no-repeat center; background-size: contain;"></div>
                        <div class="suc_str_bottom">
                            <div class="d-flex mb-2">
                                <strong class="fs_18 fc_gr222 fw_500">등록번호</strong>
                                <p class="fs_18 fc_gr222 fw_600"><?= $srow[$i]['code_register2']?></p>
                            </div>
                            <div class="d-flex mb-2">
                                <strong class="fs_18 fc_gr222 fw_500">등록일</strong>
                                <p class="fs_18"><?= $srow[$i]['dt_register_complete']?></p>
                            </div>
                            <div class="d-flex">
                                <strong class="fs_18 fc_gr222 fw_500">지정상품</strong>
                                <p class="fs_18"><?= $srow[$i]['bt_txt'] ?></p>
                            </div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <ul class="success_story d-flex flex-wrap justify-content-center">
                <?php for($i=4; $i<8; $i++){?>
                    <li>
                        <div class="suc_str_top" style="background: url('<?= "https://dmonster1705.cafe24.com/data/app_domestic"."/".$srow[$i]['bt_file1']?>') no-repeat center; background-size: contain;"></div>
                        <div class="suc_str_bottom">
                            <div class="d-flex mb-2">
                                <strong class="fs_18 fc_gr222 fw_500">등록번호</strong>
                                <p class="fs_18 fc_gr222 fw_600"><?= $srow[$i]['code_register2']?></p>
                            </div>
                            <div class="d-flex mb-2">
                                <strong class="fs_18 fc_gr222 fw_500">등록일</strong>
                                <p class="fs_18"><?= $srow[$i]['dt_register_complete']?></p>
                            </div>
                            <div class="d-flex">
                                <strong class="fs_18 fc_gr222 fw_500">지정상품</strong>
                                <p class="fs_18"><?= $srow[$i]['bt_txt'] ?></p>
                            </div>
                        </div>
                    </li>
                <?php }?>
                </ul>
            </div>
        </div>

        <script>
            $('.sec_03_slide').slick({
                dots: true,
                infinite: true,
                speed: 800,
                slidesToShow: 1,
                arrows: false,
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                autoplaySpeed: 4000,
                autoplay: true,
                fade: true,
            });
        </script>
    </div>
    </div>
    <!-- sec_03 -->

    <div class="container-fluid bg-primary">
        <div class="container-xl sec_04">
            <div class="d-flex justify-content-center mb_30 text-center">
                <strong class="fs_30 fc_wh fw_300">복잡하고 어려운 <span class="fw_500 br_block">상표출원 닥터마크에서 쉽고 간편하게</span></strong>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-outline-primary btn_style01 btn_style02" button type="button" onclick="location.href='application_domestic_step1.php' ">바로 상표출원하기</button>
            </div>
        </div>
    </div>
    <!-- sec_04 -->



    </div>
    <!-- container-fluid -->
    </div>
    <!-- idx_pg 끝 -->

    <script>
        //메뉴 스크롤이벤트
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $('body').removeClass('idx');
            } else {
                $('body').addClass('idx');
            }
        });
    </script>


    <!-- aos -->
    <script>
        AOS.init();
    </script>

<?
	include "./foot_inc.php";
?>
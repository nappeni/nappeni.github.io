var eng_num = /[^a-zA-Z0-9_-]/g;
var eng_kor = /[^a-zA-Zㄱ-ㅎ가-힣]/g;
var eng_kor_num = /[^a-zA-Zㄱ-ㅎ가-힣0-9]/g;
var num = /[^0-9]/g;
var eng = /[^a-zA-Z]/g;
var kor = /[ㄱ-ㅎ가-힣]/g;
var email = /[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i; ;
var emailf = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/;
var password = /^.*(?=.{6,20})(?=.*[0-9])(?=.*[a-zA-Z]).*$/;
var space = /\s/g;

function del(url) {
	if(confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.")) {
		hidden_ifrm.location.href = url;
	}

	return false;
}

function f_product_del(pt_idx) {
	if(confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.")) {
		$.post('./product_update.php', {act: 'delete', pt_idx: pt_idx}, function (data) {
			if(data=='Y') {
				alert('삭제되었습니다.');
				document.location.reload();
			}
		});
	}

	return false;
}

function f_post_del(url, idx) {
	if(confirm("정말 삭제하시겠습니까? 삭제된 자료는 복구되지 않습니다.")) {
		$.post(url, {act: 'delete', idx: idx}, function (data) {
			if(data=='Y') {
				alert('삭제되었습니다.');
				document.location.reload();
			}
		});
	}

	return false;
}

function retire(url) {
	if(confirm("정말 탈퇴하시겠습니까?")) {
		hidden_ifrm.location.href = url;
	}

	return false;
}

function update_confirm(txt, url) {
	if(confirm(txt)) {
		hidden_ifrm.location.href = url;
	}

	return false;
}

function comma_num(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function setCookie(cName, cValue, cDay) {
	var expire = new Date();
	expire.setDate(expire.getDate() + cDay);
	cookies = cName + '=' + escape(cValue) + '; path=/ ';
	if(typeof cDay != 'undefined') cookies += ';expires=' + expire.toGMTString() + ';';
	document.cookie = cookies;
}

function get_text_length(str, obj) {
	var len = 0;

	for(var i = 0;i < str.length;i++) {
		if(escape(str.charAt(i)).length==6) {
			len++;
		}
		len++;
	}

	if(len>0) {
		$(obj).html(len);
	}

	return false;
}

function f_checkbox_all(obj) {
	$('input:checkbox[name="'+obj+'[]"]').each(function() {
		if($(this).prop('checked')==true) {
			$(this).prop('checked', false);
		} else {
			$(this).prop('checked', true);
		}
	});

	return false;
}

function getCookie(cName) {
	cName = cName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cName);
	var cValue = '';
	if(start != -1){
		start += cName.length;
		var end = cookieData.indexOf(';', start);
		if(end == -1)end = cookieData.length;
		cValue = cookieData.substring(start, end);
	}
	return unescape(cValue);
}

function popup(url, wval, hval, tval, lval) {
	window.open(url,'popup','height='+hval+',width='+wval+',top='+tval+',left='+lval+',menubar=no,scrollbars=no,status=yes');
}

$(document).ready(function () {
	$(document).on("keyup", "input:text[numberOnly]", function() {$(this).val( $(this).val().replace(/[^0-9]/gi,"") );});
	$(document).on("keyup", "input:text[datetimeOnly]", function() {$(this).val( $(this).val().replace(/[^0-9:\-]/gi,"") );});
});

(function ($) {
	'use strict';
	$(function () {
		$('[data-toggle="offcanvas"]').on("click", function () {
			$('.sidebar-offcanvas').toggleClass('active')
		});
	});
})(jQuery);

(function ($) {
	'use strict';
	$(document).on('mouseenter mouseleave', '.sidebar .nav-item', function (ev) {
		var body = $('body');
		var sidebarIconOnly = body.hasClass("sidebar-icon-only");
		var sidebarFixed = body.hasClass("sidebar-fixed");
		if (!('ontouchstart' in document.documentElement)) {
			if (sidebarIconOnly) {
				if (sidebarFixed) {
					if (ev.type === 'mouseenter') {
						body.removeClass('sidebar-icon-only');
					}
				} else {
					var $menuItem = $(this);
					if (ev.type === 'mouseenter') {
						$menuItem.addClass('hover-open')
					} else {
						$menuItem.removeClass('hover-open')
					}
				}
			}
		}
	});
})(jQuery);

(function ($) {
	'use strict';
	$(function () {
		var body = $('body');
		var contentWrapper = $('.content-wrapper');
		var scroller = $('.container-scroller');
		var footer = $('.footer');
		var sidebar = $('.sidebar');
		sidebar.on('show.bs.collapse', '.collapse', function () {
			sidebar.find('.collapse.show').collapse('hide');
		});
		applyStyles();

		function addActiveClass(element) {
			if (current === "") {
				//for root url
				if (element.attr('href').indexOf("index.html") !== -1) {
					element.parents('.nav-item').last().addClass('active');
					if (element.parents('.sub-menu').length) {
						element.closest('.collapse').addClass('show');
						element.addClass('active');
					}
				}
			} else {
				//for other url
				if (element.attr('href').indexOf(current) !== -1) {
					element.parents('.nav-item').last().addClass('active');
					if (element.parents('.sub-menu').length) {
						element.closest('.collapse').addClass('show');
						element.addClass('active');
					}
					if (element.parents('.submenu-item').length) {
						element.addClass('active');
					}
				}
			}
		}
		var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
		$('.nav li a', sidebar).each(function () {
			var $this = $(this);
			addActiveClass($this);
		})

		function applyStyles() {
			if (!body.hasClass("rtl")) {
				if ($('.settings-panel .tab-content .tab-pane.scroll-wrapper').length) {
					const settingsPanelScroll = new PerfectScrollbar('.settings-panel .tab-content .tab-pane.scroll-wrapper');
				}
				if ($('.chats').length) {
					const chatsScroll = new PerfectScrollbar('.chats');
				}
				if (body.hasClass("sidebar-fixed")) {
					if ($('#sidebar').length) {
						var fixedSidebarScroll = new PerfectScrollbar('#sidebar .nav');
					}
				}
			}
		}
		$('[data-toggle="minimize"]').on("click", function () {
			if ((body.hasClass('sidebar-toggle-display')) || (body.hasClass('sidebar-absolute'))) {
				body.toggleClass('sidebar-hidden');
			} else {
				body.toggleClass('sidebar-icon-only');
			}
		});
		$(".form-check label,.form-radio label").append('<i class="input-helper"></i>');
		$('[data-toggle="horizontal-menu-toggle"]').on("click", function () {
			$(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
		});
		var navItemClicked = $('.horizontal-menu .page-navigation >.nav-item');
		navItemClicked.on("click", function (event) {
			if (window.matchMedia('(max-width: 991px)').matches) {
				if (!($(this).hasClass('show-submenu'))) {
					navItemClicked.removeClass('show-submenu');
				}
				$(this).toggleClass('show-submenu');
			}
		})
		$(window).scroll(function () {
			if (window.matchMedia('(min-width: 992px)').matches) {
				var header = $('.horizontal-menu');
				if ($(window).scrollTop() >= 70) {
					$(header).addClass('fixed-on-scroll');
				} else {
					$(header).removeClass('fixed-on-scroll');
				}
			}
		});
	});
})(jQuery);


function f_chag_seller(mt_idx) {
	$.post('./member_update.php', {act: 'chg_seller', mt_idx_t: mt_idx}, function (data) {
		if(data=='Y') {
			alert('판매자로 전환되었습니다.');
			document.location.reload();
		}
	});

	return false;
}

function f_retire_mem(mt_idx) {
	if(confirm("정말 탈퇴처리하겠습니까?")) {
		$.post('./member_update.php', {act: 'retire', mt_idx_t: mt_idx}, function (data) {
			if(data=='Y') {
				alert('관리자권한 회원탈퇴 처리되었습니다.');
				document.location.reload();
			}
		});
	}

	return false;
}

function f_copy_product(pt_idx) {
	if(confirm("선택된 상품으로 복사등록하시겠습니까?")) {
		alert(pt_idx);
	}

	return false;
}

function f_select_category(tt) {
	$.post('./product_update.php', {act: 'select_category', tt_t: tt}, function (data) {
		if(data) {
			$('#select_category_box').html(data);
		}
	});

	return false;
}

(function ($) {
	'use strict';
	$(function () {
		/* Code for attribute data-custom-class for adding custom class to tooltip */
		if (typeof $.fn.popover.Constructor === 'undefined') {
			throw new Error('Bootstrap Popover must be included first!');
		}
		var Popover = $.fn.popover.Constructor;
		// add customClass option to Bootstrap Tooltip
		$.extend(Popover.Default, {
			customClass: ''
		});
		var _show = Popover.prototype.show;
		Popover.prototype.show = function () {
			// invoke parent method
			_show.apply(this, Array.prototype.slice.apply(arguments));
			if (this.config.customClass) {
				var tip = this.getTipElement();
				$(tip).addClass(this.config.customClass);
			}
		};
		$('[data-toggle="popover"]').popover()
	});
})(jQuery);

function f_category_select_reset(ct_rlevel) {
	if(ct_rlevel==0) {
		$('#category_selectecd1').html('<li class="list-group-flush d-flex justify-content-between align-items-center product_category_list_group"><span class="pl-2 pb-2">중분류</span></li>');
		$('#category_selectecd2').html('<li class="list-group-flush d-flex justify-content-between align-items-center product_category_list_group"><span class="pl-2 pb-2">소분류</span></li>');
		$('#category_selectecd3').html('<li class="list-group-flush d-flex justify-content-between align-items-center product_category_list_group"><span class="pl-2 pb-2">세분류</span></li>');
	} else if(ct_rlevel==1) {
		$('#category_selectecd2').html('<li class="list-group-flush d-flex justify-content-between align-items-center product_category_list_group"><span class="pl-2 pb-2">소분류</span></li>');
		$('#category_selectecd3').html('<li class="list-group-flush d-flex justify-content-between align-items-center product_category_list_group"><span class="pl-2 pb-2">세분류</span></li>');
	} else if(ct_rlevel==2) {
		$('#category_selectecd3').html('<li class="list-group-flush d-flex justify-content-between align-items-center product_category_list_group"><span class="pl-2 pb-2">세분류</span></li>');
	}

	return false;
}

function f_category_select(ct_rlevel, ct_id) {
	$.post('./product_update.php', {act: 'category_rlevel', ct_rlevel: ct_rlevel, ct_id: ct_id}, function (data) {
		if(data) {
			$('#category_selectecd'+ct_rlevel).html(data);

			f_category_select_reset(ct_rlevel);
		}
	});

	return false;
}

function f_category_selected(ct_level, ct_id) {
	$('.category_selected').each(function(i, obj) {
		$('.category_selected').removeClass('category_selected_active');
	});
	$('#category_selected_'+ct_id).addClass('category_selected_active');

	$.post('./product_update.php', {act: 'category_selectecd', ct_level: ct_level, ct_id: ct_id}, function (data) {
		var json_data = JSON.parse(data);

		if(json_data.ca_name_breadcrumb_t) {
			$('#selected_category_t').html(json_data.ca_name_breadcrumb_t);
			$('#serach_category_txt').val('');
			$('#serach_category_box').hide();
			$('#ct_id').val(json_data.ct_id);
			$('#ct_pid').val(json_data.ct_pid);
		}

		if(json_data.ct_level) {
			f_category_select_reset(json_data.ct_level);
		} else {
			f_category_select_reset(ct_level);
		}
	});

	return false;
}

function f_search_category(stxt) {
	$('#serach_category_box').show();
	$.post('./product_update.php', {act: 'search_category', stxt: stxt}, function (data) {
		if(data) {
			$('#serach_category_box').html(data);
		}
	});

	return false;
}

function f_pt_selling_date_chk(chk_t) {
	if(chk_t=='Y') {
		$('#pt_selling_date_box').show();
		$('#pt_selling_date_box').css('list-style', 'none');
		$('#pt_selling_date_chk1').addClass('btn-info text-white');
		$('#pt_selling_date_chk2').removeClass('btn-info text-white');
	} else {
		$('#pt_selling_date_box').hide();
		$('#pt_selling_date_chk1').removeClass('btn-info text-white');
		$('#pt_selling_date_chk2').addClass('btn-info text-white');
	}
	$('#pt_selling_date_chk').val(chk_t);

	return false;
}

function f_pt_sale_chk(chk_t) {
	if(chk_t=='Y') {
		$('#f_pt_sale_box1').show();
		$('#f_pt_sale_box2').show();
		$('#f_pt_sale_box1').css('list-style', 'none');
		$('#f_pt_sale_box2').css('list-style', 'none');

		$('#f_pt_sale_btn1').addClass('btn-info text-white');
		$('#f_pt_sale_btn2').removeClass('btn-info text-white');
	} else {
		$('#f_pt_sale_box1').hide();
		$('#f_pt_sale_box2').hide();

		$('#f_pt_sale_btn1').removeClass('btn-info text-white');
		$('#f_pt_sale_btn2').addClass('btn-info text-white');
	}
	$('#pt_sale_chk').val(chk_t);

	return false;
}

function f_pt_sale_type_chk(chk_t) {
	if(chk_t=='Y') {
		$('#f_pt_sale_type_chk1').addClass('btn-info text-white');
		$('#f_pt_sale_type_chk2').removeClass('btn-info text-white');
	} else {
		$('#f_pt_sale_type_chk1').removeClass('btn-info text-white');
		$('#f_pt_sale_type_chk2').addClass('btn-info text-white');
	}
	$('#pt_sale_type_chk').val(chk_t);

	return false;
}

function f_pt_selling_date_range(nm, sd, ed) {
	var nm_t = Number(nm-1);

	$('#pt_selling_sdate').val(sd);
	$('#pt_selling_edate').val(ed);

	$('.c_pt_selling_date_range').each(function(i, obj) {
		if(nm_t==i) {
			$('#f_pt_selling_date_range'+nm).addClass('btn-info text-white');
		} else {
			$('#f_pt_selling_date_range'+Number(i+1)).removeClass('btn-info text-white');
		}
	});

	return false;
}

function f_pt_tax_type(nm) {
	var nm_t = Number(nm-1);

	$('.c_pt_tax_type').each(function(i, obj) {
		if(nm_t==i) {
			$('#f_pt_tax_type'+nm).addClass('btn-info text-white');
		} else {
			$('#f_pt_tax_type'+Number(i+1)).removeClass('btn-info text-white');
		}
	});
	$('#pt_tax_type').val(nm);

	return false;
}

function f_pt_option_chk_1(chk_t) {
	if(chk_t=='1') {
		$('#f_pt_option_chk1').addClass('btn-info text-white');
		$('#f_pt_option_chk2').removeClass('btn-info text-white');
		$('.c_pt_option_chk1').hide();
	} else {
		$('#f_pt_option_chk1').removeClass('btn-info text-white');
		$('#f_pt_option_chk2').addClass('btn-info text-white');
		$('.c_pt_option_chk1').show();
		$('.c_pt_option_chk1').css('list-style', 'none');
	}
	$('#pt_option_chk').val(chk_t);

	return false;
}

function f_pt_option_direct(chk_t) {
	if(chk_t=='3') {
		$('#f_pt_option_chk3').addClass('btn-info text-white');
		$('#f_pt_option_chk4').removeClass('btn-info text-white');
		$('.c_pt_option_chk2').hide();
	} else {
		$('#f_pt_option_chk3').removeClass('btn-info text-white');
		$('#f_pt_option_chk4').addClass('btn-info text-white');
		$('.c_pt_option_chk2').show();
		$('.c_pt_option_chk2').css('list-style', 'none');
	}
	$('#pt_option_direct').val(chk_t);

	return false;
}

function preview_image_sigle_selected(e) {
	var files = e.target.files;
	var filesArr = Array.prototype.slice.call(files);

	filesArr.forEach(function(f) {
		if(!f.type.match("image.*")) {
			alert("확장자는 이미지 확장자만 가능합니다.");
			return;
		}

		var reader = new FileReader();
		reader.onload = function(e) {
			$("#pt_image1_box").css('border', 'none');
			$("#pt_image1_box").html('<img src="'+e.target.result+'" />');
			$('#pt_image1_on').val(e.target.result)
		}
		reader.readAsDataURL(f);
	});
}

var sel_files = [];

function preview_image_multi_selected(e, obj_id) {
	var files = e.target.files;
	var filesArr = Array.prototype.slice.call(files);

	if(filesArr.lengths>9) {
		alert("추가이미지는 최대 9개까지 가능합니다.");
		return;
	} else {
		filesArr.forEach(function(f) {
			if(!f.type.match("image.*")) {
				alert("확장자는 이미지 확장자만 가능합니다.");
				return;
			}

			sel_files.push(f);

			var reader = new FileReader();
			reader.onload = function(e) {
				$("#pt_image"+obj_id+"_box").css('border', 'none');
				$("#pt_image"+obj_id+"_box").html('<img src="'+e.target.result+'" />');
			}
			reader.readAsDataURL(f);
		});
	}
}

function f_pat_kc_chk(chk_t) {
	if(chk_t=='Y') {
		$('#f_pat_kc_chk1').addClass('btn-info text-white');
		$('#f_pat_kc_chk2').removeClass('btn-info text-white');
		$('#f_pat_kc_chk_box').show();
	} else {
		$('#f_pat_kc_chk1').removeClass('btn-info text-white');
		$('#f_pat_kc_chk2').addClass('btn-info text-white');
		$('#f_pat_kc_chk_box').hide();
	}
	$('#pat_kc_chk').val(chk_t);

	return false;
}

function f_pat_used(chk_t) {
	if(chk_t=='N') {
		$('#f_pat_used1').addClass('btn-info text-white');
		$('#f_pat_used2').removeClass('btn-info text-white');
	} else {
		$('#f_pat_used1').removeClass('btn-info text-white');
		$('#f_pat_used2').addClass('btn-info text-white');
	}
	$('#pat_used').val(chk_t);

	return false;
}

function f_pat_child(chk_t) {
	if(chk_t=='Y') {
		$('#f_pat_child1').addClass('btn-info text-white');
		$('#f_pat_child2').removeClass('btn-info text-white');
	} else {
		$('#f_pat_child1').removeClass('btn-info text-white');
		$('#f_pat_child2').addClass('btn-info text-white');
	}
	$('#pat_child').val(chk_t);

	return false;
}

function f_ppt_chk(ppt_chk, pt_idx) {
	$.post('./product_provide_update.php', {act:'provide_content', ppt_chk: ppt_chk, pt_idx: pt_idx}, function (data) {
		if(data) {
			$('#ppt_content_box').html(data);
		}
	});

	return false;
}

function f_pdt_chk(chk_t) {
	if(chk_t=='Y') {
		$('#f_pdt_chk1').addClass('btn-info text-white');
		$('#f_pdt_chk2').removeClass('btn-info text-white');
		$('#pdt_chk_box').show();
	} else {
		$('#f_pdt_chk1').removeClass('btn-info text-white');
		$('#f_pdt_chk2').addClass('btn-info text-white');
		$('#pdt_chk_box').hide();
	}
	$('#pdt_chk').val(chk_t);

	return false;
}

function f_pdt_type(nm) {
	$('.c_pdt_type').each(function(i, obj) {
		var ii = Number(i+1);
		if(nm==ii) {
			$('#f_pdt_type'+ii).addClass('btn-info text-white');
		} else {
			$('#f_pdt_type'+ii).removeClass('btn-info text-white');
		}
	});
	$('#pdt_type').val(nm);

	return false;
}

function f_pdt_attritute(chk_t) {
	if(chk_t=='1') {
		$('#f_pdt_attritute1').addClass('btn-info text-white');
		$('#f_pdt_attritute2').removeClass('btn-info text-white');
	} else {
		$('#f_pdt_attritute1').removeClass('btn-info text-white');
		$('#f_pdt_attritute2').addClass('btn-info text-white');
	}
	$('#pdt_attritute').val(chk_t);

	return false;
}

function f_pdt_set_chk(chk_t) {
	if(chk_t=='Y') {
		$('#f_pdt_set_chk1').addClass('btn-info text-white');
		$('#f_pdt_set_chk2').removeClass('btn-info text-white');
	} else {
		$('#f_pdt_set_chk1').removeClass('btn-info text-white');
		$('#f_pdt_set_chk2').addClass('btn-info text-white');
	}
	$('#pdt_set_chk').val(chk_t);

	return false;
}

function f_pdt_price_type(pdt_pay_type, pt_idx) {
	$.post('./product_deliveryInfo_update.php', {act:'pay_type', pdt_pay_type: pdt_pay_type, pt_idx: pt_idx}, function (data) {
		$('#pdt_price_type_box').html(data);
	});

	return false;
}

function f_pdt_price_type_template(pdt_pay_type, ptl_idx) {
	$.post('./product_deliveryInfo_update.php', {act:'pay_type', pdt_pay_type: pdt_pay_type, ptl_idx: ptl_idx}, function (data) {
		$('#pdt_price_type_box').html(data);
	});

	return false;
}

function f_pdt_price_section_type(chk_t) {
	if(chk_t=='2') {
		$('#pdt_price_section_type2_box').show();
		$('#pdt_price_section_type3_box').hide();
	} else {
		$('#pdt_price_section_type2_box').hide();
		$('#pdt_price_section_type3_box').show();
	}

	return false;
}

function f_pdt_add_section_price_chk(chk_t) {
	if(chk_t=='Y') {
		$('#pdt_add_section_price_chk_box').show();
	} else {
		$('#pdt_add_section_price_chk_box').hide();
	}

	return false;
}

function f_pdt_add_section_price_type_chk(chk_t) {
	if(chk_t=='2') {
		$('#pdt_add_section_price_type_chk1_box').show();
		$('#pdt_add_section_price_type_chk2_box').hide();
	} else {
		$('#pdt_add_section_price_type_chk1_box').hide();
		$('#pdt_add_section_price_type_chk2_box').show();
	}

	return false;
}

function f_pdt_install_price(chk_t) {
	if(chk_t=='Y') {
		$('#f_pdt_install_price1').addClass('btn-info text-white');
		$('#f_pdt_install_price2').removeClass('btn-info text-white');
	} else {
		$('#f_pdt_install_price1').removeClass('btn-info text-white');
		$('#f_pdt_install_price2').addClass('btn-info text-white');
	}
	$('#pdt_install_price').val(chk_t);

	return false;
}

function f_pt_supplement_select(chk_t) {
	if(chk_t=='Y') {
		$('#f_pt_supplement_select1').addClass('btn-info text-white');
		$('#f_pt_supplement_select2').removeClass('btn-info text-white');
		$('#f_pt_supplement_select_box').show();
	} else {
		$('#f_pt_supplement_select1').removeClass('btn-info text-white');
		$('#f_pt_supplement_select2').addClass('btn-info text-white');
		$('#f_pt_supplement_select_box').hide();
	}
	$('#pt_supplement_select').val(chk_t);

	return false;
}

function f_pt_supplement_name_num(num) {
	$('#f_pt_supplement_input_box').html('');

	if(num>0) {
		for(var i=1;i<=num;i++) {
			$('#f_pt_supplement_input_box').append('<li class="row align-items-center mt-2"><div class="col-sm-4"><p>추가상품명</p><input type="text" name="pst_title[]" id="pst_title'+i+'" value="" class="form-control form-control-sm" /></div><div class="col-sm-3"><p>추가상품값</p><input type="text" name="pst_value[]" id="pst_value'+i+'" value="" class="form-control form-control-sm" /></div><div class="col-sm-3"><p>추가상품가</p><input type="text" name="pst_price[]" id="pst_price'+i+'" value="" numberOnly class="form-control form-control-sm" /></div></li>');
		}
	}
}

function f_ppbt_point_chk(chk_t) {
	if(chk_t=='Y') {
		$('#f_ppbt_point_chk1').addClass('btn-info text-white');
		$('#f_ppbt_point_chk2').removeClass('btn-info text-white');
	} else {
		$('#f_ppbt_point_chk1').removeClass('btn-info text-white');
		$('#f_ppbt_point_chk2').addClass('btn-info text-white');
	}
	$('#ppbt_point_chk').val(chk_t);

	return false;
}

function f_pt_card_free_interest(chk_t) {
	if(chk_t=='Y') {
		$('#f_pt_card_free_interest1').addClass('btn-info text-white');
		$('#f_pt_card_free_interest2').removeClass('btn-info text-white');
	} else {
		$('#f_pt_card_free_interest1').removeClass('btn-info text-white');
		$('#f_pt_card_free_interest2').addClass('btn-info text-white');
	}
	$('#pt_card_free_interest').val(chk_t);

	return false;
}

function f_pt_option_input_num(num) {
	$('#f_pt_option_input_box').html('');

	if(num>0) {
		for(var i=1;i<=num;i++) {
			$('#f_pt_option_input_box').append('<li class="row align-items-center mt-2"><div class="col-sm-4"><p>옵션명'+i+'</p><input type="text" name="pt_option_name'+i+'" id="pt_option_name'+i+'" value="" class="form-control form-control-sm" maxlength="50" placeholder="예)색상" /></div><div class="col-sm-8"><p>옵션값'+i+'</p><input type="text" name="pt_option_val'+i+'" id="pt_option_val'+i+'" value="" class="form-control form-control-sm" maxlength="100" placeholder="예)파랑,노랑,빨강 콤마로 구분해서 입력바랍니다." /></div></li>');
		}
	}
}

function f_pt_option_input_direct(num) {
	$('#f_pt_option_list_box').html('');

	if(num>0) {
		for(var i=1;i<=num;i++) {
			$('#f_pt_option_list_box').append('<li class="mt-2"><input type="text" name="pt_option_direct_val[]" id="pt_option_direct_val'+i+'" value="" class="form-control form-control-sm" maxlength="100" placeholder="예)색상" /></li>');
		}
	}
}

function f_pt_discount(price) {
	if($('#pt_selling_price').val()=='') {
		$('#pt_discount').val('');
		alert('판매가를 먼저 입력바랍니다.');
		$('#pt_selling_price').focus();
		return false;
	}

	if(price>0) {
		var pt_price = 0;
		var pt_price_cal = 0;
		var pt_selling_price = $('#pt_selling_price').val();
		var pt_discount = $('#pt_discount').val();

		if($('#pt_sale_type_chk').val()=='Y') {
			pt_price = (pt_selling_price - pt_discount);
			pt_price_cal = pt_discount;
		} else {
			if(pt_discount>=90) {
				alert('할인율은 90%를 넘을 수 없습니다.');
				return false;
			} else {
				pt_price_cal = (pt_selling_price*(pt_discount/100));
				pt_price_cal = Math.floor( pt_price_cal / 10 ) * 10;
				pt_price = (pt_selling_price - pt_price_cal);
				pt_price = Math.floor( pt_price / 10 ) * 10;
			}
		}

		if(pt_price<1) {
			$('#pt_price').val('');
			$('#pt_price_t1').html('0');
			$('#pt_price_t2').html('0');
			$('#pt_discount').val('');

			alert('판매가보다 할인가가 높을 수 없습니다. 할인가를 확인바랍니다.');
			return false;
		} else {
			$('#pt_price').val(pt_price);
			$('#pt_price_t1').html(comma_num(pt_price));
			$('#pt_price_t2').html(comma_num(pt_price_cal));
		}
	} else {
		alert('할인가는 0보다 크게 입력바랍니다.');
		return false;
	}

	return false;
}

function f_product_option_list(update_chk) {
	if($('#pt_option_name1').val()=='') {
		alert('옵션명1을 입력바랍니다.');
		$('#pt_option_name1').focus();
		return false;
	}
	if($('#pt_option_val1').val()=='') {
		alert('옵션값1을 입력바랍니다.');
		$('#pt_option_val1').focus();
		return false;
	}

	var pt_option_type_chk = '';
	$('input:radio[name="pt_option_type"]').each(function() {
		if($(this).prop('checked')==true) {
			pt_option_type_chk = $(this).val();
		}
	});

	$.post('./product_update.php', {
		act:'product_option_list',
		pt_option_name1: $('#pt_option_name1').val(),
		pt_option_name2: $('#pt_option_name2').val(),
		pt_option_name3: $('#pt_option_name3').val(),
		pt_option_val1: $('#pt_option_val1').val(),
		pt_option_val2: $('#pt_option_val2').val(),
		pt_option_val3: $('#pt_option_val3').val(),
		pt_option_type: pt_option_type_chk,
		update_chk: update_chk,
	}, function (data) {
		if(data!='error') {
			$('#product_option_list_box').html(data);
		} else {
			alert('잘못된 접근입니다.');
		}
	});

	return false;
}

function f_pat_origin(pat_origin_level, pat_origin2_value) {
	if(pat_origin2_value=='기타') {
		$('#pat_origin_box1').hide();
		$('#pat_origin_box2').show();
	} else {
		$('#pat_origin_box1').show();
		$('#pat_origin_box2').hide();

		if(pat_origin_level=='3') {
			var pat_origin1_value = $('#pat_origin1').val();
		}
		$.post('./product_update.php', {act:'pat_origin', pat_origin_level: pat_origin_level, pat_origin2_value: pat_origin2_value, pat_origin1_value: pat_origin1_value}, function (data) {
			if(data) {
				$('#pat_origin'+pat_origin_level).html(data);
			}
		});
	}

	return false;
}

function f_product_supplement_list(update_chk) {
	if(update_chk=='') {
		if($('#pst_title1').val()=='') {
			alert('추가상품명1을 입력바랍니다.');
			$('#pst_title1').focus();
			return false;
		}
		if($('#pst_value1').val()=='') {
			alert('추가상품값1을 입력바랍니다.');
			$('#pst_value1').focus();
			return false;
		}
		if($('#pst_price1').val()=='') {
			alert('추가상품가1을 입력바랍니다.');
			$('#pst_price1').focus();
			return false;
		}

		if($('#product_supplement_list_chk').val()=='N') {
			$('#product_supplement_list_chk').val('Y');
		} else {
			$('#product_supplement_list_chk').val('N');
		}

		var pst_title_t = $('input[name="pst_title[]"]').map(function(){
			return this.value;
		}).get();
		var pst_value_t = $('input[name="pst_value[]"]').map(function(){
			return this.value;
		}).get();
		var pst_price_t = $('input[name="pst_price[]"]').map(function(){
			return this.value;
		}).get();
	}

	$.post('./product_update.php', {
		act:'product_supplement_list',
		pst_title: pst_title_t,
		pst_value: pst_value_t,
		pst_price: pst_price_t,
		update_chk: update_chk,
	}, function (data) {
		if(data!='error') {
			$('#product_supplement_list_box').html(data);
		} else {
			alert('잘못된 접근입니다.');
		}
	});

	return false;
}

function f_pot_delete(obj_q) {
	var cnt = $('.c_pot_list ').length;

	if(cnt>1) {
		$('#pot_list_'+obj_q).remove();
	}


	return false;
}

function f_pst_delete(obj_q) {
	var cnt = $('.c_pst_list ').length;

	if(cnt>1) {
		$('#pst_list_'+obj_q).remove();
	}

	return false;
}

function f_ppbt_multi_pay_chk(chk_t) {
	if(chk_t=='Y') {
		$('#f_ppbt_multi_pay_chk1').addClass('btn-info text-white');
		$('#f_ppbt_multi_pay_chk2').removeClass('btn-info text-white');
		$('#f_ppbt_max_pay_man_box').show();
	} else {
		$('#f_ppbt_multi_pay_chk1').removeClass('btn-info text-white');
		$('#f_ppbt_multi_pay_chk2').addClass('btn-info text-white');
		$('#f_ppbt_max_pay_man_box').hide();
	}
	$('#ppbt_multi_pay_chk').val(chk_t);

	return false;
}

function f_ppbt_multi_pay_sale_chk1(chk_t) {
	if(chk_t=='Y') {
		$('#f_ppbt_multi_pay_sale_chk1_1').addClass('btn-info text-white');
		$('#f_ppbt_multi_pay_sale_chk1_2').removeClass('btn-info text-white');
	} else {
		$('#f_ppbt_multi_pay_sale_chk1_1').removeClass('btn-info text-white');
		$('#f_ppbt_multi_pay_sale_chk1_2').addClass('btn-info text-white');
	}
	$('#ppbt_multi_pay_sale_chk1').val(chk_t);

	return false;
}

function f_ppbt_multi_pay_sale_chk2(chk_t) {
	if(chk_t=='Y') {
		$('#f_ppbt_multi_pay_sale_chk2_1').addClass('btn-info text-white');
		$('#f_ppbt_multi_pay_sale_chk2_2').removeClass('btn-info text-white');
	} else {
		$('#f_ppbt_multi_pay_sale_chk2_1').removeClass('btn-info text-white');
		$('#f_ppbt_multi_pay_sale_chk2_2').addClass('btn-info text-white');
	}
	$('#ppbt_multi_pay_sale_chk2').val(chk_t);

	return false;
}

function f_ppbt_nointerest_chk(chk_t) {
	if(chk_t=='Y') {
		$('#f_ppbt_nointerest_chk1').addClass('btn-info text-white');
		$('#f_ppbt_nointerest_chk2').removeClass('btn-info text-white');
		$('#f_ppbt_nointerest_chk_box').show();
	} else {
		$('#f_ppbt_nointerest_chk1').removeClass('btn-info text-white');
		$('#f_ppbt_nointerest_chk2').addClass('btn-info text-white');
		$('#f_ppbt_nointerest_chk_box').hide();
	}
	$('#ppbt_nointerest_chk').val(chk_t);

	return false;
}

function f_ppbt_nointerest_term(chk_t) {
	$('.c_ppbt_nointerest_term').each(function(i, obj) {
		var ii = Number((i+1)*3);

		if(chk_t==ii) {
			$('#f_ppbt_nointerest_term'+ii).addClass('btn-info text-white');
		} else {
			$('#f_ppbt_nointerest_term'+ii).removeClass('btn-info text-white');
		}
	});
	$('#ppbt_nointerest_term').val(chk_t);

	return false;
}

function f_swipe_image(pt_idx) {
	$.post('./product_update.php', {act: 'swipe_image', pt_idx: pt_idx}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);

			$('#product-swiper').slick({
				dots: true,
				infinite: false,
				speed: 300,
				variableWidth: true,
					slidesToShow: 1,
			});

			$('#modal-default').modal();
		}
	});

	return false;
}

function f_review_swipe_image(rt_idx) {
	$.post('./review_update.php', {act: 'swipe_image', rt_idx: rt_idx}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);

			$('#product-swiper').slick({
				dots: true,
				infinite: false,
				speed: 300,
				variableWidth: true,
					slidesToShow: 1,
			});

			$('#modal-default').modal();
		}
	});

	return false;
}

function f_review_fitting_swipe_image(rt_idx) {
	$.post('./review_fitting_update.php', {act: 'swipe_image', rt_idx: rt_idx}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);

			$('#product-swiper').slick({
				dots: true,
				infinite: false,
				speed: 300,
				variableWidth: true,
					slidesToShow: 1,
			});

			$('#modal-default').modal();
		}
	});

	return false;
}

function f_review_content(rt_idx) {
	$.post('./review_update.php', {act: 'content_view', rt_idx: rt_idx}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);
			$('#modal-default').modal();
		}
	});

	return false;
}

function f_review_fitting_content(rft_idx) {
	$.post('./review_fitting_update.php', {act: 'content_view', rft_idx: rft_idx}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);
			$('#modal-default').modal();
		}
	});

	return false;
}

function f_pt_sale_now(chk_t) {
	if(chk_t=='Y') {
		$('#f_pt_sale_now_btn1').addClass('btn-info text-white');
		$('#f_pt_sale_now_btn2').removeClass('btn-info text-white');
	} else {
		$('#f_pt_sale_now_btn1').removeClass('btn-info text-white');
		$('#f_pt_sale_now_btn2').addClass('btn-info text-white');
	}
	$('#pt_sale_now').val(chk_t);

	return false;
}

function f_pt_show(chk_t) {
	if(chk_t=='Y') {
		$('#f_pt_show_btn1').addClass('btn-info text-white');
		$('#f_pt_show_btn2').removeClass('btn-info text-white');
	} else {
		$('#f_pt_show_btn1').removeClass('btn-info text-white');
		$('#f_pt_show_btn2').addClass('btn-info text-white');
	}
	$('#pt_show').val(chk_t);

	return false;
}

function f_sel_ct_id(sel_ct_level, sel_ct_id) {
	var nm_t = Number(sel_ct_level)+1;

	$.post('./product_update.php', {act: 'sel_ct_level', sel_ct_level: sel_ct_level, sel_ct_id: sel_ct_id}, function (data) {
		if(data) {
			$("#sel_ct_id"+nm_t).html(data);
		}
	});

	return false;
}

function f_qna_content(qt_idx) {
	$.post('./qna_update.php', {act: 'content_view', qt_idx: qt_idx}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);
			$('#modal-default').modal();
		}
	});

	return false;
}

function f_qna_seller_content(qt_idx) {
	$.post('./qna_seller_update.php', {act: 'content_view', qt_idx: qt_idx}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);
			$('#modal-default').modal();
		}
	});

	return false;
}

function f_search_seller(stxt) {
	$('#search_seller_box').show();
	$.post('./taxinvoice_update.php', {act: 'search_seller', stxt: stxt}, function (data) {
		if(data) {
			$('#search_seller_box').html(data);
		}
	});

	return false;
}

function f_search_seller_selected(slt_idx, slt_company_name, slt_company_num) {
	if(slt_idx) {
		$('#mt_seller_idx').val(slt_idx);
	}
	if(slt_company_name) {
		$('#slt_company_name').val(slt_company_name);
	}
	if(slt_company_num) {
		$('#slt_company_num').val(slt_company_num);
	}

	$('#search_seller').val('');
	$('#search_seller_box').html('');

	return false;
}

function f_view_order(ot_pcode) {
	$.post('./order_update.php', {act: 'view_order', ot_pcode: ot_pcode}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);
			$('#modal-default-size').css('max-width', '800px');
			$('#modal-default').addClass('modal-dialog-centered');
			$('#modal-default').addClass('modal-dialog-scrollable');
			$('#modal-default').modal();
		}
	});

	return false;
}

function f_checkbox_cnt() {
	var chk_cnt = 0;
	var ot_pcode = '';

	$('input:checkbox[name="chk_all[]"]').each(function() {
		if($(this).prop('checked')==true) {
			chk_cnt++;
			ot_pcode += $(this).val()+'|';
		}
	});

	if(chk_cnt<1) {
		alert('처리할 주문을 선택해주세요.');
		return false;
	}

	return ot_pcode;
}

function f_order_cancel(ct_status) {
	var ot_pcode = f_checkbox_cnt();

	if(ot_pcode=='') {
		return false;
	}

	$.post('./order_update.php', {act: 'cancel_modal', ot_pcode: ot_pcode, ct_status: ct_status}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);
			$('#modal-default').modal();
		}
	});

	return false;
}

function f_ot_status_chk(chg_status) {
	var ot_pcode = f_checkbox_cnt();

	if(ot_pcode=='') {
		return false;
	}

	$.post('./order_update.php', {act: 'status_chg', ot_pcode: ot_pcode, chg_status: chg_status}, function (data) {
		if(data=='Y') {
			alert('처리되었습니다.');
		} else {
			alert('잘못된 접근입니다.');
		}
		document.location.reload();
	});

	return false;
}

function f_order_delivery() {
	var ot_pcode = f_checkbox_cnt();

	if(ot_pcode=='') {
		return false;
	}

	$.post('./order_update.php', {act: 'delivery_modal', ot_pcode: ot_pcode}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);
			$('#modal-default-size').css('max-width', '800px');
			$('#modal-default').modal();
		}
	});

	return false;
}

function f_ct_delivery_type(t, obj_id) {
	if(t=='2') {
		$('#ct_delivery_com'+obj_id).attr("disabled", false);
		$('#ct_delivery_number'+obj_id).attr("disabled", false);
	} else {
		$('#ct_delivery_com'+obj_id).attr("disabled", true);
		$('#ct_delivery_number'+obj_id).attr("disabled", true);
	}

	return false;
}

function f_excel_delivery_upload() {
	$.post('./order_update.php', {act: 'excel_delivery_upload'}, function (data) {
		if(data) {
			$('#modal-default-content').html(data);
			$('#modal-default').modal();
		}
	});

	return false;
}

function f_order_search_date_range(nm, sd, ed) {
	$('#sel_search_sdate').val(sd);
	$('#sel_search_edate').val(ed);

	$('.c_pt_selling_date_range').removeClass('btn-info text-white');
	$('#f_order_search_date_range'+nm).addClass('btn-info text-white');

	return false;
}

function f_sel_ct_status(nm) {
	var nm_t = Number(nm-1);

	$('.c_sel_ct_status').each(function(i, obj) {
		if(nm_t==i) {
			$('#sel_ct_status'+nm).addClass('btn-info text-white');
		} else {
			$('#sel_ct_status'+Number(i+1)).removeClass('btn-info text-white');
		}
	});
	$('#sel_ct_status').val(nm);

	return false;
}

function f_sel_ct_delivery_type(nm) {
	var nm_t = Number(nm-1);

	$('.c_sel_ct_delivery_type').each(function(i, obj) {
		if(nm_t==i) {
			$('#sel_ct_delivery_type'+nm).addClass('btn-info text-white');
		} else {
			$('#sel_ct_delivery_type'+Number(i+1)).removeClass('btn-info text-white');
		}
	});
	$('#sel_ct_delivery_type').val(nm);

	return false;
}

function preview_image_multi_selected_store(e, obj_id) {
	var files = e.target.files;
	var filesArr = Array.prototype.slice.call(files);

	if(filesArr.lengths>5) {
		alert("추가이미지는 최대 5개까지 가능합니다.");
		return;
	} else {
		filesArr.forEach(function(f) {
			if(!f.type.match("image.*")) {
				alert("확장자는 이미지 확장자만 가능합니다.");
				return;
			}

			sel_files.push(f);

			var reader = new FileReader();
			reader.onload = function(e) {
				$("#srt_image"+obj_id+"_box").css('border', 'none');
				$("#srt_image"+obj_id+"_box").html('<img src="'+e.target.result+'" />');
			}
			reader.readAsDataURL(f);
		});
	}
}

function f_preview_image_delete(obj_id, obj_name) {
	var obj_t = obj_name+obj_id;

	if(obj_t) {
		$('#'+obj_t).val('');
		$('#'+obj_t+'_on').val('');
		$('#'+obj_t+'_del').hide();
		$('#'+obj_t+'_box').css('border', '1px dashed #ddd');
		$('#'+obj_t+'_box').html('<i class="mdi mdi-plus"></i>');
	}
}

function f_preview_image_selected(e, obj_id, obj_name) {
	var files = e.target.files;
	var filesArr = Array.prototype.slice.call(files);
	var obj_t = obj_name+obj_id;

	filesArr.forEach(function(f) {
		if(!f.type.match("image.*")) {
			alert("확장자는 이미지 확장자만 가능합니다.");
			return;
		}

		if(f.size>12000000) {
			alert("이미지는 10메가 이하만 가능합니다.");
			return;
		}

		var reader = new FileReader();
		reader.onload = function(e) {
			$("#"+obj_t+"_box").css('border', 'none');
			$("#"+obj_t+"_box").html('<img src="'+e.target.result+'" onerror="this.src=\'../images/noimg.png\'" />');
			$("#"+obj_t+"_del").show();
		}
		reader.readAsDataURL(f);
	});
}

function f_join_profile_del(obj_id, obj_name) {
	var obj_t = obj_name+obj_id;

	if(obj_t) {
		$('#'+obj_t).val('');
		$('#'+obj_t+'_del').hide();
		$("#"+obj_t+"_img").attr('src', '../images/noimg.png');
	}
}

function f_join_profile_select(e, obj_id, obj_name) {
	var files = e.target.files;
	var filesArr = Array.prototype.slice.call(files);
	var obj_t = obj_name+obj_id;

	filesArr.forEach(function(f) {
		if(!f.type.match("image.*")) {
			alert("확장자는 이미지 확장자만 가능합니다.");
			return;
		}

		if(f.size>12000000) {
			alert("이미지는 10메가 이하만 가능합니다.");
			return;
		}

		var reader = new FileReader();
		reader.onload = function(e) {
			$("#"+obj_t+"_img").attr('src', e.target.result);
			$("#"+obj_t+"_del").show();
		}
		reader.readAsDataURL(f);
	});
}
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
}

function retire(url) {
	if(confirm("정말 탈퇴하시겠습니까?")) {
		hidden_ifrm.location.href = url;
	}
}

function update_confirm(txt, url) {
	if(confirm(txt)) {
		hidden_ifrm.location.href = url;
	}
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

function gourl(url){
	if(url!= "") window.open(url);
}

$(document).ready(function () {
	$(document).on("keyup", "input:text[numberOnly]", function() {$(this).val( $(this).val().replace(/[^0-9]/gi,"") );});
	$(document).on("keyup", "input:text[datetimeOnly]", function() {$(this).val( $(this).val().replace(/[^0-9:\-]/gi,"") );});
});

function chk_password(str) {
	var pw = str;
	var num = pw.search(/[0-9]/g);
	var eng = pw.search(/[a-z]/ig);
	var spe = pw.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

	if(pw.length < 8 || pw.length > 16) {
		alert("8자리 ~ 16자리 이내로 입력해주세요.");
		return false;
	}
	if(pw.search(/₩s/) != -1) {
		alert("비밀번호는 공백업이 입력해주세요.");
		return false;
	}
	if(num < 0 || eng < 0 || spe < 0) {
		alert("영문,숫자,기호를 포함하여 입력해주세요.");
		return false;
	}

	return true;
}
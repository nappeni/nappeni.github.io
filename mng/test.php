<?
	include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";

	$toEmail = 'lcm790203@naver.com';
	$toName = 'lcm790203';

	$confirm_t = get_openssl_encrypt2($_POST['mt_id'], DECODEKEY, DECODEKEY_IV);

	$subject = '['.APP_TITLE.'] '.APP_AUTHOR.' 회원가입을 위한 인증메일입니다.';
	$content_t = '안녕하세요. '.APP_AUTHOR.'입니다.<br/><br/>회원가입을 위한 인증메일입니다.<br/><br/>아래 링크를 클릭하여 인증을 완료바랍니다.<br/><br/><p><a href="'.APP_DOMAIN.'/join_confirm.php?confirm='.$confirm_t.'">인증하기</a></p><br/><br/>플라이스쿨을 이용해 주셔서 감사합니다';
	$contents = '<div id="bg_gr" style="background:#f5f5f5;padding:20px;max-width:595px;"><div id="content" style="background:#fff; margin:0 auto; max-width:595px; box-sizing: border-box; padding:30px;  width:100%;"><h1 class="logo" style="margin-bottom: 20px; padding-bottom: 20px; text-align: center; border-bottom:1px solid #e3e3e3; margin-top:0;"><img src="'.MAIN_LOGO.'" style="width:200px;" /></h1><div class="cont"><div class="cont_text" style="text-align: left;padding:50px; line-height:1.5em; font-weight:normal; margin-bottom:20px; word-break: keep-all; font-size:14px;">'.$content_t.'</div></div></div><div id="footer" style="margin:0 auto; max-width:595px; padding:20px;"><div style=" display:flex; justify-content: space-between; "><div class="ft_info" style="font-size:13px; line-height: 1.6em; color:#9F9F9F; max-width:60%; word-break: keep-all;"><ul style="list-style: none; padding:0; margin:0; display:flex; flex-wrap: wrap; margin-bottom:10px;"><li>고객문의 : '.$st_info['st_kakao_channel'].'</b></li><span class="bar" style="padding:0 10px; color:#e3e3e3">|</span><li>채널 운영시간 : '.$st_info['st_kakao_channel_time'].'</li></ul></div></div><div class="ft_copy" style="font-size:13px; line-height: 1.5em; color:#9F9F9F;">Copyright ⓒ '.date("Y").'. '.APP_AUTHOR.' All Rights Reserved.</div></div></div>';

	$rtn = mailplug_send(MAIL_FROMNAME, MAIL_FROMEMAIL, $toEmail, $toName, $subject, $contents);

	printr($rtn);

	include $_SERVER['DOCUMENT_ROOT']."/tail_inc.php";
?>


<?
	define("APP_AUTHOR", "닥터마크");

	//상단타이틀, URL 설정
	define("APP_TITLE", '닥터마크');
	define("APP_DOMAIN", 'https://dmonster1705.cafe24.com');
	define("CDN_HTTP", 'https://dmonster1705.cafe24.com');
	define("DESIGN_HTTP", 'https://dmonster1705.cafe24.com/design');
	define("KEYWORDS", '닥터마크');
	define("DESCRIPTION", '닥터마크');
	define("DECODEKEY", 'JDNZvvR7zu');
	define("DECODEKEY_IV", '#@$%^&*()_+=-');
	define("SECRETKEY", 'AAAAB3NzaC1yc2EAAAABJQAAAQEAv6+cPJDNZvvR7zuLo9vK8xHt/ucEMdZhBxbiVow/Gopl0y+GSpHic01rUqIoj/XortnJWekObyeAqSGTHDXOOGxl7/9xJdtXpe2WIW1voIAgX6xwNcIPoLpdPat7g5CkrWWJ+k5JUYHycV+ue3HgMII0OCKC4ira0hURNohGiac22IfO5+XIjn8uPQdg4dpmgxJbokB4DjO2uO5e9EMU4wF1ucxpKF0FANYmvjijUpdjnfKmBA/dg/9Go4d9rUfnhmcv5QaVxUDFouveW9eCxDVkvo29tiWmDnWNynlpc2dDELvjm9gF35MAQacaggLVAoErAzm99oJen/JjbRSvMQ==');
	define("ADMIN_NAME", '닥터마크');

	//css, js 캐시 리셋
	$v_txt = "20211020_0320";

	define("MAIL_FROMNAME", 'flyschool');
	define("MAIL_FROMEMAIL", 'flyschool@flyschool.live');

	define("MAIN_LOGO", APP_DOMAIN.'/design/img/logo_color.png');

	//게시판 리스팅수
	$n_limit_num = 10;
	$study_limit_num = 8;

	$arr_file = array(
		'0' => '첨부파일1',
		'1' => '첨부파일2',
		'2' => '첨부파일3',
	);

	//이미지 업로드 가능 확장자
	$ct_image_ext = "jpg;png;gif;jpeg;bmp";

	//노이미지 링크
	$ct_no_img_url = DESIGN_HTTP."/img/th_noimg.png";

	//업로드 링크
	$ct_img_dir_r = "./images/uploads";
	$ct_img_dir_a = "../images/uploads";
	$ct_img_url = CDN_HTTP."/images/uploads";

	//엑셀다운로드 링크
	$ct_excel_dir_r = "./images/excel";
	$ct_excel_dir_a = "../images/excel";
	$ct_excel_url = CDN_HTTP."/images/excel";


function randomcode2($nmr_loops)
{
	$characters  = "0123456789";
	$characters .= "abcdefghijklmnopqrstuvwxyz";

	$string_generated = "";

	while ($nmr_loops--)
	{
		$string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
	}

	return $string_generated;
}
function sendMsg($msg, $reciver){ //msg = 메세지 내용 reciver = 수신자 번호
    //인증정보
    $sms_url = "https://apis.aligo.in/send/";
    $sms['user_id'] = "drmark21";
    $sms['key'] = "7ckv0m7gfce8k3t87lptrxe95xvh16kn";
    //전송정보 설정
    $_POST['msg'] = $msg;
    $_POST['receiver'] = $reciver; //수신번호
    $_POST['sender'] = "01071058983";
    $_POST['testmode_yn'] = 'Y'; //Y인경우 실제문자 전송X , 자동취소(환불) 처리
    $_POST['msg_type'] = 'SMS';
    //전송 정보
    $sms['msg'] = stripslashes($_POST['msg']);
    $sms['receiver'] = $_POST['receiver'];
    $sms['sender'] = $_POST['sender'];
    $sms['testmode_yn'] = empty($_POST['testmode_yn']) ? '' : $_POST['testmode_yn'];
    $sms['msg_type'] = $_POST['msg_type'];
    //전송실행
    $host_info = explode("/", $sms_url);
    $port = $host_info[0] == 'https:' ? 443 : 80;
    $oCurl = curl_init();
    curl_setopt($oCurl, CURLOPT_PORT, $port);
    curl_setopt($oCurl, CURLOPT_URL,$sms_url);
    curl_setopt($oCurl, CURLOPT_POST, 1);
    curl_setopt($oCurl, CURLOPT_RETUR0NTRANSFER, 1);
    curl_setopt($oCurl, CURLOPT_POSTFIELDS,$sms);
    curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_exec($oCurl);
    curl_close($oCurl);
}
?>

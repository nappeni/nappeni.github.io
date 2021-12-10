<?
	ob_start('ob_gzhandler');
	header("Content-Type: text/html; charset=utf-8");
	header("Access-Control-Allow-Origin: *");

	ini_set('session.cache_expire',86400);
	ini_set('session.gc_maxlifetime',86400);
	ini_set('session.use_trans_sid', 0);
	ini_set('url_rewriter.tags','');
	ini_set("session.gc_probability", 100);
	ini_set("session.gc_divisor", 100);

	session_save_path($_SERVER['DOCUMENT_ROOT'].'/sessions');
	session_cache_limiter('nocache, must_revalidate');
	session_set_cookie_params(0, "/");
	session_start();

	header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

	include $_SERVER['DOCUMENT_ROOT']."/db_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/config_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/config_arr_inc.php";
	include $_SERVER['DOCUMENT_ROOT']."/Mobile_Detect.php";
	include $_SERVER['DOCUMENT_ROOT']."/lib.mail.php";

	$detect_mobile = new Mobile_Detect;
	if($detect_mobile->isMobile()) {
		$chk_mobile = true;
	} else {
		$chk_mobile = false;
	}

	if($_SERVER['REMOTE_ADDR']=='220.77.25.19') {
		$chk_admin = true;
	} else {
		$chk_admin = false;
	}

	function alert($msg, $url="") {
		if($url == "") {
			$url = "history.go(-1)";
		} else {
			$url = "document.location.href = '".$url."'";
		}

		if($msg != "") {
			echo "<script type=\"text/javascript\">
					alert('".$msg."');".$url.";
				</script>";
		} else {
			echo "<script type=\"text/javascript\">
					".$url.";
				</script>";
		}
		exit;
	}

	function just_alert($msg) {
	    echo "<script type=\"text/javascript\">
			alert('".$msg."');
		</script>";
	}

	function alert_close($msg) {
	    echo "<script type=\"text/javascript\">
			alert('".$msg."');
			window.close();
		</script>";
	}

	function p_alert($msg, $url="") {
		if($url == "") {
			$url = "parent.location.reload()";
		} else {
			$url = "parent.document.location.href = '".$url."'";
		}

		if($msg != "") {
			echo "<script type=\"text/javascript\">
					alert('".$msg."');".$url.";
				</script>";
		} else {
			echo "<script type=\"text/javascript\">
					".$url.";
				</script>";
		}
		exit;
	}

	function p_confirm($msg, $url1, $url2) {
		echo "<script type=\"text/javascript\">
				if(confirm('".$msg."')) {
					parent.document.location.href = '".$url1."';
				} else {
					parent.document.location.href = '".$url2."';
				}
			</script>";
		exit;
	}

	function p_reload_to($url="") {
		if($url == "") {
			$url = "parent.location.reload()";
		} else {
			$url = "parent.document.location.href = '".$url."'";
		}

		echo "<script type=\"text/javascript\">
				".$url.";
			</script>";
		exit;
	}

	function gotourl($url) {
		$url = "document.location.href = '".$url."'";
		echo "<script type=\"text/javascript\">
				".$url.";
			</script>";
		exit;
	}

	function top_location_url($url) {
		$url = "top.location.href = '".$url."'";
		echo "<script type=\"text/javascript\">
				".$url.";
			</script>";
		exit;
	}

	function p_gotourl($url) {
		$url = "parent.document.location.href = '".$url."'";
		echo "<script type=\"text/javascript\">
				".$url.";
			</script>";
		exit;
	}

	function ps_gotourl($url) {
		$url = "opener.document.location.href = '".$url."'";
		echo "<script type=\"text/javascript\">
				".$url.";
			</script>";
		exit;
	}

	function page_listing($cur_page, $total_page, $url, $link_id="") {
        $retValue = '<div class="d-flex justify-content-center">';
        $retValue .= '	<nav>';
		$retValue .= '	<ul class="pagination fs_17 align-items-center">';
		if($cur_page > 1) {
			$retValue .= '<li class="page-item arrow"><a class="page-link fs_16" href="'.$url.($cur_page-1).$link_id.'" tabindex="-1"><i class="xi xi-angle-left"></i></a></li>';
		} else {
			$retValue .= '<li class="page-item arrow disabled"><a class="page-link fs_16" href="javascript:;" tabindex="-1"><i class="xi xi-angle-left"></i></a></li>';
		}
		$start_page = ( ( (int)( ($cur_page - 1 ) / 5 ) ) * 5 ) + 1;
		$end_page = $start_page + 5;
		if($end_page >= $total_page) $end_page = $total_page;
		if($total_page >= 1)
		    for ($k=$start_page;$k<=$end_page;$k++)
		        if($cur_page != $k) $retValue .= '<li class="page-item"><a class="page-link" href="'.$url.$k.$link_id.'">'.$k.'</a></li>';
		        else $retValue .= '<li class="page-item active"><a class="page-link" href="'.$url.$k.$link_id.'">'.$k.' <span class="sr-only">(current)</span></a></li>';

		if($cur_page < $total_page && $total_page > 1) {
			$retValue .= '<li class="page-item arrow disabled"><a class="page-link fs_16" href="'.$url.($cur_page+1).$link_id.'"><i class="xi xi-angle-right"></i></a></li>';
		} else {
			$retValue .= '<li class="page-item arrow disabled"><a class="page-link fs_16" href="javascript:;"><i class="xi xi-angle-right"></i></a></li>';
		}
		$retValue .= "</ul>";
        $retValue .= "</nav>";
        $retValue .= "</div>";

		return $retValue;
	}

    function page_listing2($cur_page, $total_page, $url, $link_id = "")
    {
        $retValue = "<nav aria-label=\"Page navigation\" class=\"margin-top-6 \" style='margin-right: auto; margin-left: auto; display: inline-block;'>";
        $retValue .= '<ul class="pagination">';

        if ($cur_page > 1) {
            $retValue .= '<li class="page-item">';
            $retValue .= '<a class="page-link" href="'.$url.($cur_page-1).$link_id.'" aria-label="Previous">';
            $retValue .= '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>';
            $retValue .= '</a>';
            $retValue .= '</li>';
        } else {
            $retValue .= '<li class="page-item disabled">';
            $retValue .= '<a class="page-link" href="'.$url.($cur_page-1).$link_id.'" aria-disabled="true">';
            $retValue .= '<span aria-hidden="true"><i class="fa fa-angle-left"></i></span>';
            $retValue .= '</a>';
            $retValue .= '</li>';
        }

        $start_page = (((int)(($cur_page - 1) / 5)) * 5) + 1;
        $end_page = $start_page + 5;
        if ($end_page >= $total_page) $end_page = $total_page;
        if ($total_page >= 1)
            for ($k = $start_page; $k <= $end_page; $k++)
                if ($cur_page != $k) $retValue .= "<li class=\"page-item\"><a class=\"page-link\" href=\"" . $url . $k . $link_id . "\">" . $k . "</a></li>";
                else $retValue .= "<li class=\"page-item\" aria-current=\"page\"><a class=\"page-link on\" href=\"" . $url . $k . $link_id . "\">" . $k . "</a></li>";

        if ($cur_page < $total_page && $total_page > 1) {
            $retValue .= '<li class="page-item">';
            $retValue .= '<a class="page-link" href="'.$url.($cur_page+1).$link_id.'" aria-label="Next">';
            $retValue .= '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>';
            $retValue .= '</a>';
            $retValue .= '</li>';
        } else {
            $retValue .= '<li class="page-item disabled">';
            $retValue .= '<a class="page-link" href="'.$url.($cur_page+1).$link_id.'" aria-disabled="true">';
            $retValue .= '<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>';
            $retValue .= '</a>';
            $retValue .= '</li>';
        }

        $retValue .= '</ul>';
        $retValue .= "</nav>";

        return $retValue;
    }

	function page_listing_xhr($cur_page, $total_page) {
		$retValue = '	<div class="d-flex pt-5 justify-content-center"><nav><ul class="pagination fs_20 align-items-center">';
		if($cur_page > 1) {
			$retValue .= '<li class="page-item arrow"><a class="page-link fs_16" href="javascript:f_study_list(\''.($cur_page-1).'\');" tabindex="-1"><i class="xi xi-angle-left"></i></a></li>';
		} else {
			$retValue .= '<li class="page-item arrow disabled"><a class="page-link fs_16" href="javascript:;" tabindex="-1"><i class="xi xi-angle-left"></i></a></li>';
		}
		$start_page = ( ( (int)( ($cur_page - 1 ) / 5 ) ) * 5 ) + 1;
		$end_page = $start_page + 5;
		if($end_page >= $total_page) $end_page = $total_page;
		if($total_page > 1)
		for ($k=$start_page;$k<=$end_page;$k++)
		if($cur_page != $k) $retValue .= '<li class="page-item"><a class="page-link" href="javascript:f_study_list(\''.$k.'\');">'.$k.'</a></li>';
		else $retValue .= '<li class="page-item active"><a class="page-link" href="javascript:f_study_list(\''.$k.'\');">'.$k.' <span class="sr-only">(current)</span></a></li>';

		if($cur_page < $total_page && $total_page > 1) {
			$retValue .= '<li class="page-item arrow disabled"><a class="page-link fs_16" href="javascript:f_study_list(\''.($cur_page+1).'\');"><i class="xi xi-angle-right"></i></a></li>';
		} else {
			$retValue .= '<li class="page-item arrow disabled"><a class="page-link fs_16" href="javascript:;"><i class="xi xi-angle-right"></i></a></li>';
		}
		$retValue .= "</ul></nav>";

		return $retValue;
	}

	function check_file_ext($filename, $allow_ext) {
		if($filename == "") return true;
		$ext = get_file_ext($filename);
		$allow_ext = explode(";", $allow_ext);
		$sw_allow_ext = false;
		for ($i=0; $i<count($allow_ext); $i++)
			if($ext == $allow_ext[$i])
			{
				$sw_allow_ext = true;
				break;
			}

		return $sw_allow_ext;
	}

	function upload_file($srcfile, $destfile, $dir) {
		if($destfile == "") return false;
		move_uploaded_file($srcfile, $dir.$destfile);
		chmod($dir.$destfile, 0666);

		return true;
	}

	function get_file_ext($filename) {
		if($filename == "") return "";
		$type = explode(".", $filename);
		$ext = strtolower($type[count($type)-1]);

		return $ext;
	}

	function cut_str($strSource,$iStart,$iLength,$tail="") {
		$iSourceLength = mb_strlen($strSource, "UTF-8");

		if($iSourceLength > $iLength) {
			return mb_substr($strSource, $iStart, $iLength, "UTF-8").$tail;
		} else {
			return $strSource;
		}
	}

	function mailer($fname, $fmail, $to, $tname, $subject, $content, $type="1", $file="", $charset="utf-8", $cc="", $bcc="") {
		//사용안함 2019-08-21
		global $Mail_sender;

		$Mail_sender->isSMTP();
		$Mail_sender->CharSet = 'UTF-8';
		$Mail_sender->SMTPDebug = 0;
		$Mail_sender->Debugoutput = 'html';
		$Mail_sender->Host = 'smtp.daum.net';
		$Mail_sender->Port = 465;
		$Mail_sender->SMTPSecure = 'ssl';
		$Mail_sender->SMTPAuth = true;
		$Mail_sender->Username = "";
		$Mail_sender->Password = "";
		$Mail_sender->setFrom($fmail, $fname);
		$Mail_sender->addAddress($to, $tname);
		$Mail_sender->Subject = $subject;
		$Mail_sender->msgHTML($content);

		if(!$Mail_sender->send()) {
			return 'Message could not be sent.';
			return 'Mailer Error: ' . $Mail_sender->ErrorInfo;
		} else {
			return 'Message has been sent';
		}
	}

	function mailer_new($fname, $fmail, $to, $tname, $subject, $content) {
		global $Mail_sender;

		$Mail_sender->clearAddresses();
		$Mail_sender->isSMTP();
		$Mail_sender->SMTPDebug = 0;
		$Mail_sender->CharSet = 'UTF-8';
		$Mail_sender->Encoding = 'base64';
		$Mail_sender->Debugoutput = 'html';
		$Mail_sender->Host = 'smtp.mailplug.co.kr';
		$Mail_sender->Port = 465;
		$Mail_sender->SMTPSecure = 'ssl';
		$Mail_sender->SMTPAuth = true;
		$Mail_sender->Username = "flyschool@flyschool.live";
		$Mail_sender->Password = "Minerva21!";
		//$Mail_sender->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');
		$Mail_sender->setFrom($fmail, $fname);
		$Mail_sender->addAddress($to);
		$Mail_sender->isHTML(true);
		$Mail_sender->Subject = $subject;
		$Mail_sender->Body = $content;

		$Mail_sender->setFrom($fmail, $fname);
		$Mail_sender->addAddress($to, $tname);
		$Mail_sender->Subject = $subject;
		$Mail_sender->msgHTML($content);

		if(!$Mail_sender->send()) {
			//return 'Message could not be sent.';
			return 'Mailer Error: ' . $Mail_sender->ErrorInfo;
		} else {
			return 'Message has been sent'.$Mail_sender->ErrorInfo;
		}
	}

	function mailplug_send($fname, $fmail, $to, $tname, $subject, $content) {
		global $Mail_sender;

		$Mail_sender->clearAddresses();
		$Mail_sender->isSMTP();
		$Mail_sender->SMTPDebug = 0;
		$Mail_sender->CharSet = 'UTF-8';
		$Mail_sender->Encoding = 'base64';
		$Mail_sender->Debugoutput = 'html';
		$Mail_sender->Host = 'smtp.mailplug.co.kr';
		$Mail_sender->Port = 465;
		$Mail_sender->SMTPSecure = 'ssl';
		$Mail_sender->SMTPAuth = true;
		$Mail_sender->Username = "flyschool@flyschool.live";
		$Mail_sender->Password = "Minerva21!";
		//$Mail_sender->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');
		$Mail_sender->setFrom($fmail, $fname);
		$Mail_sender->addAddress($to);
		$Mail_sender->isHTML(true);
		$Mail_sender->Subject = $subject;
		$Mail_sender->Body = $content;

		$Mail_sender->setFrom($fmail, $fname);
		$Mail_sender->addAddress($to, $tname);
		$Mail_sender->Subject = $subject;
		$Mail_sender->msgHTML($content);

		if(!$Mail_sender->send()) {
			//return 'Message could not be sent.';
			return 'Mailer Error: ' . $Mail_sender->ErrorInfo;
		} else {
			return 'Message has been sent'.$Mail_sender->ErrorInfo;
		}
	}

	/** @smtp Mail 보내기
	 *
	 * @param $fromName 보내는 사람 이름
	 * @param $fromEmail 보내는 사람 메일
	 * @param $toName 받는 사람 이름
	 * @param $toEmail 받는 사람 메일
	 * @param $subject 메일제목
	 * @param $contents 메일 내용
	 * @param $isDebug 디버깅할때 1로 해서 사용하세요.
	 * @return sendmail_flag 성공(true) 실패(false) 여부
	 */
	function sendMail($fromName, $fromEmail, $toName, $toEmail, $subject, $contents, $isDebug=0) {
		//Configuration
		$smtp_host = "smtp.gmail.com";
		$port = 587;
		$type = "text/html";
		$charSet = "UTF-8";

		//Open Socket
		$fp = @fsockopen($smtp_host, $port, $errno, $errstr, 1);
		if($fp){
			//Connection and Greetting
			$returnMessage = fgets($fp, 128);
			if($isDebug)
				print "CONNECTING MSG:".$returnMessage."\n";
			fputs($fp, "HELO YA\r\n");
			$returnMessage = fgets($fp, 128);
			if($isDebug)
				print "GREETING MSG:".$returnMessage."\n";

			// 이부분에 다음과 같이 로긴과정만 들어가면됩니다.
			fputs($fp, "auth login\r\n");
			fgets($fp,128);
			fputs($fp, base64_encode("")."\r\n");
			fgets($fp,128);
			fputs($fp, base64_encode("")."\r\n");
			fgets($fp,128);

			fputs($fp, "MAIL FROM: <".$fromEmail.">\r\n");
			$returnvalue[0] = fgets($fp, 128);
			fputs($fp, "rcpt to: <".$toEmail.">\r\n");
			$returnvalue[1] = fgets($fp, 128);

			if($isDebug){
				print "returnvalue:";
				print_r($returnvalue);
			}

			//Data
			fputs($fp, "data\r\n");
			$returnMessage = fgets($fp, 128);
			if($isDebug)
				print "data:".$returnMessage;
			fputs($fp, "Return-Path: ".$fromEmail."\r\n");
			$fromName = "=?".$fromName."?B?".base64_encode($fromName)."?=";
			fputs($fp, "From: ".$fromName." <".$fromEmail.">\r\n");
			fputs($fp, "To: <".$toEmail.">\r\n");
			$subject = "=?".$charSet."?B?".base64_encode($subject)."?=";

			fputs($fp, "Subject: ".$subject."\r\n");
			fputs($fp, "Content-Type: ".$type."; charset=\"".$charSet."\"\r\n");
			fputs($fp, "Content-Transfer-Encoding: base64\r\n");
			fputs($fp, "\r\n");
			$contents= chunk_split(base64_encode($contents));

			fputs($fp, $contents);
			fputs($fp, "\r\n");
			fputs($fp, "\r\n.\r\n");
			$returnvalue[2] = fgets($fp, 128);

			//Close Connection
			fputs($fp, "quit\r\n");
			fclose($fp);

			//Message
			if (strstr($returnvalue[0], "^250")&&strstr($returnvalue[1], "^250")&&strstr($returnvalue[2], "^250")){
				$sendmail_flag = true;
			}else {
				$sendmail_flag = false;
				print "NO :".$errno.", STR : ".$errstr;
			}
		}

		if (! $sendmail_flag){
			echo "메일 보내기 실패";
		}
		return $sendmail_flag;
	}

	function thumnail($file, $save_filename, $save_path, $max_width, $max_height) {
	   $img_info = getimagesize($file);
	   if($img_info[2] == 1)
	   {
			  $src_img = ImageCreateFromGif($file);
			  }elseif($img_info[2] == 2){
			  $src_img = ImageCreateFromJPEG($file);
			  }elseif($img_info[2] == 3){
			  $src_img = ImageCreateFromPNG($file);
			  }else{
			  return 0;
	   }
	   $img_width = $img_info[0];
	   $img_height = $img_info[1];

	   if($img_width > $max_width || $img_height > $max_height)
	   {
			  if($img_width == $img_height)
			  {
					 $dst_width = $max_width;
					 $dst_height = $max_height;
			  }elseif($img_width > $img_height){
					 $dst_width = $max_width;
					 $dst_height = ceil(($max_width / $img_width) * $img_height);
			  }else{
					 $dst_height = $max_height;
					 $dst_width = ceil(($max_height / $img_height) * $img_width);
			  }
	   }else{
			  $dst_width = $img_width;
			  $dst_height = $img_height;
	   }
	   if($dst_width < $max_width) $srcx = ceil(($max_width - $dst_width)/2); else $srcx = 0;
	   if($dst_height < $max_height) $srcy = ceil(($max_height - $dst_height)/2); else $srcy = 0;

	   if($img_info[2] == 1)
	   {
			  $dst_img = imagecreate($max_width, $max_height);
	   }else{
			  $dst_img = imagecreatetruecolor($max_width, $max_height);
	   }

	   $bgc = ImageColorAllocate($dst_img, 255, 255, 255);
	   ImageFilledRectangle($dst_img, 0, 0, $max_width, $max_height, $bgc);
	   ImageCopyResampled($dst_img, $src_img, $srcx, $srcy, 0, 0, $dst_width, $dst_height, ImageSX($src_img),ImageSY($src_img));

	   if($img_info[2] == 1)
	   {
			  ImageInterlace($dst_img);
			  ImageGif($dst_img, $save_path.$save_filename);
	   }elseif($img_info[2] == 2){
			  ImageInterlace($dst_img);
			  ImageJPEG($dst_img, $save_path.$save_filename);
	   }elseif($img_info[2] == 3){
			  ImagePNG($dst_img, $save_path.$save_filename);
	   }
	   @ImageDestroy($dst_img);
	   @ImageDestroy($src_img);
	}

	function thumnail_width($file, $save_filename, $save_path, $max_width) {
		$img_info = getimagesize($file);
		if($img_info[2] == 1) {
			$src_img = ImageCreateFromGif($file);
		} else if($img_info[2] == 2) {
			$src_img = ImageCreateFromJPEG($file);
		} else if($img_info[2] == 3) {
			$src_img = ImageCreateFromPNG($file);
		} else {
			return 0;
		}

		$img_width = $img_info[0];
		$img_height = $img_info[1];

		$dst_width = $max_width;
		$dst_height = round($dst_width*($img_height/$img_width));

		$srcx = 0;
		$srcy = 0;

		if($img_info[2] == 1) {
			$dst_img = imagecreate($dst_width, $dst_height);
		} else {
			$dst_img = imagecreatetruecolor($dst_width, $dst_height);
		}

		ImageCopyResampled($dst_img, $src_img, $srcx, $srcy, 0, 0, $dst_width, $dst_height, ImageSX($src_img),ImageSY($src_img));

		if($img_info[2] == 1) {
			ImageInterlace($dst_img);
			ImageGif($dst_img, $save_path.$save_filename);
		} else if($img_info[2] == 2) {
			ImageInterlace($dst_img);
			ImageJPEG($dst_img, $save_path.$save_filename);
		} else if($img_info[2] == 3) {
			ImagePNG($dst_img, $save_path.$save_filename);
		}
		@ImageDestroy($dst_img);
		@ImageDestroy($src_img);
	}

	function thumbnail_crop_center($file, $save_filename, $save_path, $max_width, $max_height) {
		//사이즈에 맞춰 채워 넣는 방식으로 수정, 아래 scale_image_fill 함수 참고 2015-04-21 이창민
		$img_info = getimagesize($file);

		if($img_info[2] == 1) {
			$src = ImageCreateFromGif($file);
		} else if($img_info[2] == 2) {
			$src = ImageCreateFromJPEG($file);
		} else if($img_info[2] == 3) {
			$src = ImageCreateFromPNG($file);
		} else {
			return 0;
		}

		$dst = imagecreatetruecolor($max_width, $max_height);
		imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));

		$src_width = imagesx($src);
		$src_height = imagesy($src);

		$dst_width = imagesx($dst);
		$dst_height = imagesy($dst);

		$new_width = $dst_width;
		$new_height = round($new_width*($src_height/$src_width));
		$new_x = 0;
		$new_y = round(($dst_height-$new_height)/2);

		$next = $new_height < $dst_height;

		if($next) {
			$new_height = $dst_height;
			$new_width = round($new_height*($src_width/$src_height));
			$new_x = round(($dst_width - $new_width)/2);
			$new_y = 0;
		}

		imagecopyresampled($dst, $src , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);

		if($img_info[2] == 1) {
			ImageInterlace($dst);
			ImageGif($dst, $save_path.$save_filename);
		} else if($img_info[2] == 2) {
			ImageInterlace($dst);
			ImageJPEG($dst, $save_path.$save_filename);
		} else if($img_info[2] == 3) {
			ImagePNG($dst, $save_path.$save_filename);
		}

		@ImageDestroy($dst_img);
		@ImageDestroy($src_img);
	}

	function scale_image_fill($src_image, $save_filename, $save_path, $max_width, $max_height) {
		$img_info = getimagesize($src_image);

		if($img_info[2] == 1) {
			$src = ImageCreateFromGif($src_image);
		} else if($img_info[2] == 2) {
			$src = ImageCreateFromJPEG($src_image);
		} else if($img_info[2] == 3) {
			$src = ImageCreateFromPNG($src_image);
		} else {
			return 0;
		}

		$dst = imagecreatetruecolor($max_width, $max_height);
		imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));

		$src_width = imagesx($src);
		$src_height = imagesy($src);

		$dst_width = imagesx($dst);
		$dst_height = imagesy($dst);

		$new_width = $dst_width;
		$new_height = round($new_width*($src_height/$src_width));
		$new_x = 0;
		$new_y = round(($dst_height-$new_height)/2);

		$next = $new_height < $dst_height;

		if($next) {
			$new_height = $dst_height;
			$new_width = round($new_height*($src_width/$src_height));
			$new_x = round(($dst_width - $new_width)/2);
			$new_y = 0;
		}

		imagecopyresampled($dst, $src , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);

		if($img_info[2] == 1) {
			ImageInterlace($dst);
			ImageGif($dst, $save_path.$save_filename);
		} else if($img_info[2] == 2) {
			ImageInterlace($dst);
			ImageJPEG($dst, $save_path.$save_filename);
		} else if($img_info[2] == 3) {
			ImagePNG($dst, $save_path.$save_filename);
		}

		@ImageDestroy($dst_img);
		@ImageDestroy($src_img);
	}

	function scale_image_fit($src_image, $save_filename, $save_path, $max_width, $max_height) {
		$img_info = getimagesize($src_image);

		if($img_info[2] == 1) {
			$src = ImageCreateFromGif($src_image);
		} else if($img_info[2] == 2) {
			$src = ImageCreateFromJPEG($src_image);
		} else if($img_info[2] == 3) {
			$src = ImageCreateFromPNG($src_image);
		} else {
			return 0;
		}

		$dst = imagecreatetruecolor($max_width, $max_height);
		imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));

		$src_width = imagesx($src);
		$src_height = imagesy($src);

		$dst_width = imagesx($dst);
		$dst_height = imagesy($dst);

		$new_width = $dst_width;
		$new_height = round($new_width*($src_height/$src_width));
		$new_x = 0;
		$new_y = round(($dst_height-$new_height)/2);

		$next = $new_height > $dst_height;

		if($next) {
			$new_height = $dst_height;
			$new_width = round($new_height*($src_width/$src_height));
			$new_x = round(($dst_width - $new_width)/2);
			$new_y = 0;
		}

		imagecopyresampled($dst, $src , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);

		if($img_info[2] == 1) {
			ImageInterlace($dst);
			ImageGif($dst, $save_path.$save_filename);
		} else if($img_info[2] == 2) {
			ImageInterlace($dst);
			ImageJPEG($dst, $save_path.$save_filename);
		} else if($img_info[2] == 3) {
			ImagePNG($dst, $save_path.$save_filename);
		}

		@ImageDestroy($dst_img);
		@ImageDestroy($src_img);
	}

	function encrypt($str, $key) {
		# Add PKCS7 padding.
		$block = mcrypt_get_block_size('des', 'ecb');
		if (($pad = $block - (strlen($str) % $block)) < $block) {
		  $str .= str_repeat(chr($pad), $pad);
		}

		return mcrypt_encrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
	}

	function decrypt($str, $key) {
		$str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);

		# Strip padding out.
		$block = mcrypt_get_block_size('des', 'ecb');
		$pad = ord($str[($len = strlen($str)) - 1]);
		if ($pad && $pad < $block && preg_match(
			  '/' . chr($pad) . '{' . $pad . '}$/', $str
												)
		   ) {
		  return substr($str, 0, strlen($str) - $pad);
		}
		return $str;
	}

	function get_openssl_encrypt($data) {
		$pass = DECODEKEY;
		$iv = DECODEKEY;

		$endata = @openssl_encrypt($data , "aes-256-cbc", $pass, true, $iv);
		$endata = base64_encode($endata);

		return $endata;
	}

	function get_openssl_decrypt($endata) {
		$pass = DECODEKEY;
		$iv = DECODEKEY;

		$data = base64_decode($endata);
		$dedata = @openssl_decrypt($data , "aes-256-cbc", $pass, true, $iv);

		return $dedata;
	}

	function get_text($str) {
		$source[] = "/</";
		$target[] = "&lt;";
		$source[] = "/>/";
		$target[] = "&gt;";
		$source[] = "/\'/";
		$target[] = "&#039;";

		return preg_replace($source, $target, strip_tags($str));
	}

	function cal_remain_days($s_date, $e_date) {
		if($e_date=="") return "0";

		$s_date_ex = explode("-", $s_date);
		$e_date_ex = explode("-", $e_date);

		$s_time = mktime(0, 0, 0, $s_date_ex[1], $s_date_ex[2], $s_date_ex[0]);
		$e_time = mktime(23, 59, 59, $e_date_ex[1], $e_date_ex[2], $e_date_ex[0]);

		if($s_time > $e_time) {
			$rtn = 0;
		} else {
			$result_time = ($e_time - $s_time) / (60*60*24);

			if($result_time < 0) {
				$rtn = 0;
			} else {
				$rtn = round($result_time);
			}
		}

		return $rtn;
	}

	function quote2entities($string,$entities_type='number') {
		$search = array("\"","'");
		$replace_by_entities_name = array("&quot;","&apos;");
		$replace_by_entities_number = array("&#34;","&#39;");
		$do = null;
		if ($entities_type == 'number') {
			$do = str_replace($search,$replace_by_entities_number,$string);
		} else if ($entities_type == 'name') {
			$do = str_replace($search,$replace_by_entities_name,$string);
		} else {
			$do = addslashes($string);
		}

		return $do;
	}

	function printr($arr_val) {
		echo "<pre>";
		print_r($arr_val);
		echo "</pre>";
	}

	function fnc_Day_Name($strDate){
		$strDate = substr($strDate,0,10);
		$days = array("일","월","화","수","목","금","토");
		$temp_day = date("w", strtotime($strDate));
		return $days[$temp_day];
	}

	function TimeType($time_t) {
		$hour = date("H", strtotime($time_t));
		$min  = date("i", strtotime($time_t));

		if ($hour > 12) {
			$hour = $hour - 12;
			$result = "오후 " . $hour. ":". $min;
		} else {
			$result = "오전 " . $hour. ":". $min;
		}

		return $result;
	}

	function DateType($strDate, $type="1"){
		if($strDate=="" || $strDate=="0000-00-00 00:00:00") {
			$strDate = "-";
		} else {
			if($type=="1") {
				$strDate = str_replace("-",".",substr($strDate,0,10));
			} else if($type=="2") {
				$strDate = str_replace("-",".",substr($strDate,0,16));
			} else if($type=="3") {
				$strDate = str_replace("-",".",substr($strDate,0,10))."&nbsp;(".fnc_Day_Name($strDate).")";
			} else if($type=="4") {
				$strDate = str_replace("-",".",substr($strDate,0,10))."&nbsp;(".fnc_Day_Name($strDate).")&nbsp;".substr($strDate,11,5);
			} else if($type=="5") {
				$strDate = str_replace("-",".",substr($strDate,2,8));
			} else if($type=="6") {
				$strDate = str_replace("-",".",substr($strDate,2,8))."&nbsp;(".fnc_Day_Name($strDate).")&nbsp;".substr($strDate,11,5);
			} else if($type=="7") {
				$strDate = substr($strDate,11,5);
			} else if($type=="8") {
				$strDate = str_replace("-",".",substr($strDate,2,8))."&nbsp;".substr($strDate,11,5);
			} else if($type=="9") {
				$strDate = str_replace("-",".",substr($strDate,2,8))."&nbsp;(".fnc_Day_Name($strDate).")<br/>".substr($strDate,11,5);
			} else if($type=="10") {
				$strDate = str_replace("-","년 ",substr($strDate,2,5))."월";
			} else if($type=="11") {
				$strDate_ex1 = explode(' ', $strDate);
				$strDate_ex2 = explode('-', $strDate_ex1[0]);

				$strDate = $strDate_ex2[0]."년 ".$strDate_ex2[1]."월 ".$strDate_ex2[2]."일";
			} else if($type=="12") {
				$strDate = str_replace("-",".",substr($strDate,2,8))."&nbsp;(".fnc_Day_Name($strDate).")";
			} else if($type=="13") {
				$strDate_ex1 = explode(' ', $strDate);
				$strDate_ex2 = explode('-', $strDate_ex1[0]);

				$strDate = $strDate_ex2[1]."월 ".$strDate_ex2[2]."일"."&nbsp;".fnc_Day_Name($strDate)."요일<br>".TimeType($strDate_ex1[1]);
			} else if($type=="14") {
				$strDate_ex1 = explode(' ', $strDate);
				$strDate_ex2 = explode('-', $strDate_ex1[0]);

				$strDate = $strDate_ex2[1]."월 ".$strDate_ex2[2]."일"."&nbsp;(".fnc_Day_Name($strDate).")";
			} else if($type=="15") {
				$strDate_ex1 = explode(' ', $strDate);

				$strDate = TimeType($strDate_ex1[1]);
			} else if($type=="16") {
				$strDate_ex1 = explode(' ', $strDate);
				$strDate_ex2 = explode('-', $strDate_ex1[0]);

				$strDate = $strDate_ex2[1]."월 ".$strDate_ex2[2]."일"."&nbsp;".fnc_Day_Name($strDate)."요일 ".TimeType($strDate_ex1[1]);
			} else if($type=="17") {
				$strDate_ex1 = explode(' ', $strDate);
				$strDate_ex2 = explode('-', $strDate_ex1[0]);

				$strDate = fnc_Day_Name($strDate)."요일 ".TimeType($strDate_ex1[1]);
			}
		}

		return $strDate;
	}

	function substr_star($str){
		$str_len = mb_strlen($str);
		$str_arr = str_split($str);

		$result = "";
		for($i=0 ; $i < $str_len ; $i++){
			if($i < 3){
				$result .= $str_arr[$i];
			}else{
				$result .= "*";
			}
		}
		return $result;
	}

	function mt_pw_make() {
		return substr(md5(time()), 0, 8);
	}

	function mt_sms_make() {
		return mt_rand(111111, 999999);
	}

	function save_remote_img_curl_fn($url, $dir, $tmpname) {
		$filename = '';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_NOBODY, true);

		curl_exec ($ch);

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($http_code == 200) {
			$filename = basename($url);
			if(preg_match("/\.(gif|jpg|jpeg|png)$/i", $filename)) {
				$filepath = $dir;
				@mkdir($filepath, '0755');
				@chmod($filepath, '0755');

				// 파일 다운로드
				$path = $filepath.'/'.$tmpname;
				$fp = fopen ($path, 'w');

				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $url );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
				curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
				curl_setopt( $ch, CURLOPT_FILE, $fp );
				curl_exec( $ch );
				curl_close( $ch );

				fclose( $fp );

				// 다운로드 파일이 이미지인지 체크
				if(is_file($path)) {
					$size = @getimagesize($path);
					if($size[2] < 1 || $size[2] > 3) {
						@unlink($path);
						$filename = '';
					} else {
						$ext = array(1=>'gif', 2=>'jpg', 3=>'png');
						$filename = $tmpname.'.'.$ext[$size[2]];
						rename($path, $filepath.'/'.$filename);
						//@chmod($filepath.'/'.$filename, '0644');
					}
				}
			}
		}

		return $filename;
	}

	function save_remote_img_curl($url, $dir, $mt_idx) {
		$filename = '';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_NOBODY, true);

		curl_exec ($ch);

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($http_code == 200) {
			$filename = basename($url);
			if(preg_match("/\.(gif|jpg|jpeg|png)$/i", $filename)) {
				//$tmpname = date('YmdHis').(microtime(true) * 10000);
				$tmpname = "mt_img_".$mt_idx."_".date("YmdHis");
				$filepath = $dir;
				@mkdir($filepath, '0755');
				@chmod($filepath, '0755');

				// 파일 다운로드
				$path = $filepath.'/'.$tmpname;
				$fp = fopen ($path, 'w');

				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $url );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
				curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
				curl_setopt( $ch, CURLOPT_FILE, $fp );
				curl_exec( $ch );
				curl_close( $ch );

				fclose( $fp );

				// 다운로드 파일이 이미지인지 체크
				if(is_file($path)) {
					$size = @getimagesize($path);
					if($size[2] < 1 || $size[2] > 3) {
						@unlink($path);
						$filename = '';
					} else {
						$ext = array(1=>'gif', 2=>'jpg', 3=>'png');
						$filename = $tmpname.'.'.$ext[$size[2]];
						rename($path, $filepath.'/'.$filename);
						@chmod($filepath.'/'.$filename, '0644');
					}
				}
			}
		}

		return $filename;
	}

	function save_remote_img_file($url, $dir, $mt_idx) {
		$filename = file_get_contents($url);
		$img_info = pathinfo($url);
		$tmpname = "mt_img_".$mt_idx."_".date("YmdHis").'.'.$img_info[extension];
		file_put_contents($dir."/".$tmpname, $filename);

		return $tmpname;
	}

	function save_facebook_profile_img($url, $dir, $mt_idx) {
		$filename = '';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_NOBODY, true);

		curl_exec ($ch);

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($http_code == 200) {
			$filename = basename($url);
			$filename_ex = explode("?", $filename);
			$filename = $filename_ex[0];
			if(preg_match("/\.(gif|jpg|jpeg|png)$/i", $filename)) {
				//$tmpname = date('YmdHis').(microtime(true) * 10000);
				$tmpname = "mt_img_".$mt_idx."_".date("YmdHis");
				$filepath = $dir;
				@mkdir($filepath, '0755');
				@chmod($filepath, '0755');

				// 파일 다운로드
				$path = $filepath.'/'.$tmpname;
				$fp = fopen ($path, 'w');

				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $url );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
				curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
				curl_setopt( $ch, CURLOPT_FILE, $fp );
				curl_exec( $ch );
				curl_close( $ch );

				fclose( $fp );

				// 다운로드 파일이 이미지인지 체크
				if(is_file($path)) {
					$size = @getimagesize($path);
					if($size[2] < 1 || $size[2] > 3) {
						@unlink($path);
						$filename = '';
					} else {
						$ext = array(1=>'gif', 2=>'jpg', 3=>'png');
						$filename = $tmpname.'.'.$ext[$size[2]];
						rename($path, $filepath.'/'.$filename);
						//@chmod($filepath.'/'.$filename, '0644');
					}
				}
			}
		}

		return $filename;
	}

	function inconv_post($s1, $s2, $arr) {
		foreach($arr as $key => $val) {
			$arr[$key] = iconv($s1, $s2, $val);
		}

		return $arr;
	}

	function date_diffrent($sdate, $edate) {
		$date1 = new DateTime($sdate);
		$date2 = new DateTime($edate);
		$diff = date_diff($date1, $date2);

		$return = "";
		if($diff->days==0) {
			if($diff->d==0) {
				if($diff->h==0) {
					if($diff->i==0) {
						$return = $diff->s."초";
					} else {
						$return = $diff->i."분";
					}
				} else {
					$return = $diff->h."시";
				}
			}
		} else {
			if($diff->days>7) {
				$return = round($diff->days/7)."주";
			} else {
				$return = $diff->days."일";
			}
		}

		return $return;
	}

	function save_parsing_img($url, $dir, $pt_size, $bt_idx, $img_num) {
		$filename = '';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_NOBODY, true);

		curl_exec ($ch);

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($http_code == 200) {
			$filename = basename($url);
			$filename_ex = explode("?", $filename);
			$filename = $filename_ex[0];
			if(preg_match("/\.(gif|jpg|jpeg|png)$/i", $filename)) {
				//$tmpname = date('YmdHis').(microtime(true) * 10000);
				$tmpname = "pt_img_".$pt_size."_".$bt_idx."_".$img_num;
				$filepath = $dir;
				@mkdir($filepath, '0755');
				@chmod($filepath, '0755');

				// 파일 다운로드
				$path = $filepath.'/'.$tmpname;
				$fp = fopen ($path, 'w');

				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $url );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
				curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
				curl_setopt( $ch, CURLOPT_FILE, $fp );
				curl_exec( $ch );
				curl_close( $ch );

				fclose( $fp );

				// 다운로드 파일이 이미지인지 체크
				if(is_file($path)) {
					$size = @getimagesize($path);
					if($size[2] < 1 || $size[2] > 3) {
						@unlink($path);
						$filename = '';
					} else {
						$ext = array(1=>'gif', 2=>'jpg', 3=>'png');
						$filename = $tmpname.'.'.$ext[$size[2]];
						rename($path, $filepath.'/'.$filename);
						//@chmod($filepath.'/'.$filename, '0644');
					}
				}
			}
		}

		return $filename;
	}

	function save_owner_img($url, $dir, $pt_barcode, $pt_idx) {
		$rtn_filename = '';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_NOBODY, true);

		curl_exec ($ch);

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($http_code == 200) {
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch, CURLOPT_HEADER, false );
			curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 3 );
			$raw = curl_exec( $ch );
			curl_close( $ch );

			if(stristr($url, 'product_image.php')) {
				$url_ex = explode("?img=", $url);
				$filename = $url_ex[1];
			} else {
				$url_info = pathinfo($url);
				$filename = $url_info[basename];
			}

			$path = $dir."/".$filename;

			$fp = fopen ($path, 'w');
			fwrite($fp, $raw);
			fclose( $fp );

			if(is_file($path)) {
				$size = @getimagesize($path);
				if($size[2] < 1 || $size[2] > 3) {
					@unlink($path);
					$rtn_filename = '';
				} else {
					$ext = array(1=>'gif', 2=>'jpg', 3=>'png');
					$rtn_filename = $pt_barcode."_".$pt_idx.'.'.$ext[$size[2]];
					rename($path, $dir.'/'.$rtn_filename);
				}
			}
		}

		return $rtn_filename;
	}

	function get_pt_file_url($pt_file, $mng_chk="") {
		global $ct_noimg_url, $ct_product_url, $ct_product_dir_a, $ct_product_dir_r;

		$pt_file_ex = explode("|", $pt_file);

		if($pt_file_ex[0]=="http") {
			$pt_file_ex_txt = strip_tags($pt_file_ex[1]);
		} else {
			if($mng_chk=="Y") {
				$pt_dir = $ct_product_dir_a;
			} else {
				$pt_dir = $ct_product_dir_r;
			}

			if(is_file($pt_dir."/".$pt_file_ex[0])) {
				$pt_file_ex_txt = $ct_product_url."/".$pt_file_ex[0];
			} else {
				$pt_file_ex_txt = $ct_noimg_url;
			}
		}

		return $pt_file_ex_txt;
	}

	function save_url_img($url, $dir, $tmp_nm) {
		$filename = '';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_NOBODY, true);

		curl_exec ($ch);

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if($http_code == 200) {
			$filename = basename($url);
			$filename_ex = explode("?", $filename);
			$filename = $filename_ex[0];
			if(preg_match("/\.(gif|jpg|jpeg|png)$/i", $filename)) {
				$tmpname = $tmp_nm;
				$filepath = $dir;

				// 파일 다운로드
				$path = $filepath.'/'.$tmpname;
				$fp = fopen ($path, 'w');

				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, $url );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, false );
				curl_setopt( $ch, CURLOPT_BINARYTRANSFER, true );
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 3 );
				curl_setopt( $ch, CURLOPT_FILE, $fp );
				curl_exec( $ch );
				curl_close( $ch );

				fclose( $fp );

				// 다운로드 파일이 이미지인지 체크
				if(is_file($path)) {
					$size = @getimagesize($path);
					if($size[2] < 1 || $size[2] > 3) {
						@unlink($path);
						$filename = '';
					} else {
						$ext = array(1=>'gif', 2=>'jpg', 3=>'png');
						$filename = $tmpname.'.'.$ext[$size[2]];
						rename($path, $filepath.'/'.$filename);
						//@chmod($filepath.'/'.$filename, '0644');
					}
				}
			}
		}

		return $filename;
	}

	function f_curl_post($url, $code) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "selfcode=".$code);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$rtn = curl_exec($ch);
		curl_close($ch);

		return $rtn;
	}

	function f_curl_post_field($url, $field) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		$rtn = curl_exec($ch);
		curl_close($ch);

		return $rtn;
	}

	function ex_title_chk($title) {
		global $arr_ex_title;

		$q = 0;
		foreach($arr_ex_title as $key => $val) {
			if(strstr($title, $val)) {
				$q++;
			}
		}

		if($q>0) {
			return "";
		} else {
			return $title;
		}
	}

	function get_time() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	function format_phone($phone) {
		$phone = preg_replace("/[^0-9]/", "", $phone);
		$length = strlen($phone);

		switch($length){
			case 11 :
				return preg_replace("/([0-9]{3})([0-9]{4})([0-9]{4})/", "$1-$2-$3", $phone);
			break;
			case 10:
				return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
			break;
			case 9:
				return preg_replace("/([0-9]{2})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
			break;
			default :
				return $phone;
			break;
		}
	}

	function delete_all($dir) {
		$d = @dir($dir);
		while ($entry = $d->read()) {
			if ($entry == "." || $entry == "..") continue;
			if (is_dir($entry)) delete_all($entry);
			else unlink($dir."/".$entry);
		}
	}

	function f_sms_send($receiver, $msg, $subject="", $rdate="", $rtime="") {
		$sms_url = "https://apis.aligo.in/send/";
		$sms['user_id'] = ALIGO_USER_ID;
		$sms['key'] = ALIGO_KEY;

		$host_info = explode("/", $sms_url);
		$port = $host_info[0] == 'https:' ? 443 : 80;

		$sms['msg'] = stripslashes($msg);
		$sms['receiver'] = $receiver;
		$sms['destination'] = '';
		$sms['sender'] = ALIGO_SENDER;
		$sms['rdate'] = $rdate;
		$sms['rtime'] = $rtime;
		$sms['testmode_yn'] = 'N';
		$sms['title'] = $subject;
		$sms['msg_type'] = 'SMS';

		$oCurl = curl_init();
		curl_setopt($oCurl, CURLOPT_PORT, $port);
		curl_setopt($oCurl, CURLOPT_URL, $sms_url);
		curl_setopt($oCurl, CURLOPT_POST, 1);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
		curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
		$ret = curl_exec($oCurl);
		curl_close($oCurl);

		return $ret;
	}

	function f_bizmsg_sms_send($receiver, $msg) {
		//$sms_url = "https://devtalkapi.lgcns.com/request/sms.json";
		$sms_url = "https://talkapi.lgcns.com/request/sms.json";
		$authToken = 'WyPADMKBoLmpx0vSL1L0eQ==';
		$serverName = 'lgechiller2019';
		$service = '2130066996';
		$callbackNo = '01099206297';

		$data = array();
		$data["service"] = $service;
		$data["message"] = $msg;
		$data["mobile"] = $receiver;
		$data["callbackNo"] = $callbackNo;

		$json_data = json_encode($data, JSON_UNESCAPED_SLASHES);
		$headers = array("Content-type: text/xml;", "authToken:".$authToken, "serverName:".$serverName);

		$oCurl = curl_init();
		curl_setopt($oCurl,CURLOPT_URL, $sms_url);
		curl_setopt($oCurl,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($oCurl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($oCurl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $json_data);
		curl_setopt($oCurl, CURLOPT_TIMEOUT, 3);
		$response = curl_exec($oCurl);
		$curl_errno = curl_errno($oCurl);
		$curl_error = curl_error($oCurl);
		curl_close($oCurl);

		return json_decode($response);
	}

	function f_bizmsg_sms_batch_send($receiver, $msg) {
		//$sms_url = "https://devtalkapi.lgcns.com/request/smsBatch.json";
		$sms_url = "https://talkapi.lgcns.com/request/smsBatch.json";
		$authToken = 'WyPADMKBoLmpx0vSL1L0eQ==';
		$serverName = 'lgechiller2019';
		$service = '2130066996';
		$callbackNo = '01099206297';

		$data = array();
		$data["service"] = $service;
		$data["message"] = $msg;
		$data["mobileList"] = $receiver;
		$data["callbackNo"] = $callbackNo;

		$json_data = json_encode($data, JSON_UNESCAPED_SLASHES);
		$headers = array("Content-type: text/xml;", "authToken:".$authToken, "serverName:".$serverName);

		$oCurl = curl_init();
		curl_setopt($oCurl,CURLOPT_URL, $sms_url);
		curl_setopt($oCurl,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($oCurl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($oCurl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $json_data);
		curl_setopt($oCurl, CURLOPT_TIMEOUT, 3);
		$response = curl_exec($oCurl);
		$curl_errno = curl_errno($oCurl);
		$curl_error = curl_error($oCurl);
		curl_close($oCurl);

		return json_decode($response);
	}

	//$result 성공: true, 실패: false  $msg 전달 문구  $data 배열 데이터
	function result_data($result, $msg, $data) {
		$arr = array();

		$arr['result'] = $result;
		$arr['msg'] = $msg;
		$arr['data'] = $data;

		$obj = json_encode($arr, JSON_UNESCAPED_UNICODE);

		return $obj;
	}



	function get_child_code() {
		global $DB;

		$unique = false;
		do {
			$mct_code = substr("C".strtoupper(md5(time())), 0, 8);
			$query = "select * from member_child_t where mct_code = '".$mct_code."'";
			$cnt = $DB->count_query($query);
			if ($cnt < 1) {
				$unique = true;
				break;
			}
		}
		while ($unique == false);

		return $mct_code;
	}

	function get_mem_info($mt_idx) {
		global $DB;

		$query = "
			select * from member_t
			where idx = '".$mt_idx."'
		";
		$row = $DB->fetch_query($query);

		return $row;
	}

	function get_member_child_info($mct_idx) {
		global $DB;

		$query = "
			select * from member_child_t
			where idx = '".$mct_idx."'
		";
		$row = $DB->fetch_query($query);

		return $row;
	}

	function get_setup_t_info() {
		global $DB;

		$query = "select * from setup_t where idx = '1'";
		$row = $DB->fetch_query($query);

		return $row;
	}

	function get_study_t_info($st_idx) {
		global $DB;

		$query = "select * from study_t where idx = '".$st_idx."'";
		$row = $DB->fetch_query($query);

		return $row;
	}

	function get_study_live_t_info($slt_idx) {
		global $DB;

		$query = "select * from study_live_t where idx = '".$slt_idx."'";
		$row = $DB->fetch_query($query);

		return $row;
	}

	function get_study_contents_t_info($sct_idx) {
		global $DB;

		$query = "select * from study_contents_t where idx = '".$sct_idx."'";
		$row = $DB->fetch_query($query);

		return $row;
	}

	function get_klat_info($mct_idx) {
		global $DB;

		$query = "select * from member_klat_t where mct_idx = '".$mct_idx."'";
		$row = $DB->fetch_query($query);

		return $row;
	}

	function get_bootom_ct_id($ct_id) {
		global $DB;

		$query = "
			select * from category_bottom_all
			where ct_id = '".$ct_id."'
		";
		$row = $DB->fetch_query($query);

		return $row['ct_id_txt'];
	}

	function get_order_info($ot_code) {
		global $DB;

		$query = "
			select * from order_t
			where ot_code = '".$ot_code."'
		";
		$row = $DB->fetch_query($query);

		return $row;
	}

	function get_bottom_all($ct_id) {
		global $DB;

		unset($list);
		$query = "select * from category_t where ct_pid = '".$ct_id."'";
		$list = $DB->select_query($query);

		$arr_ct_id_txt = array();
		$arr_ct_id_txt[] = $ct_id;
		if($list) {
			foreach($list as $row) {
				if($row['ct_id']) {
					$arr_ct_id_txt[] = $row['ct_id'];

					unset($list2);
					$query2 = "select * from category_t where ct_pid = '".$row['ct_id']."'";
					$list2 = $DB->select_query($query2);

					if($list2) {
						foreach($list2 as $row2) {
							if($row2['ct_id']) {
								$arr_ct_id_txt[] = $row2['ct_id'];

								unset($list3);
								$query3 = "select * from category_t where ct_pid = '".$row2['ct_id']."'";
								$list3 = $DB->select_query($query3);

								if($list3) {
									foreach($list3 as $row3) {
										if($row3['ct_id']) {
											$arr_ct_id_txt[] = $row3['ct_id'];

											unset($list4);
											$query4 = "select * from category_t where ct_pid = '".$row3['ct_id']."'";
											$list4 = $DB->select_query($query4);

											if($list4) {
												foreach($list4 as $row4) {
													if($row4['ct_id']) {
														$arr_ct_id_txt[] = $row4['ct_id'];
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}

		return $arr_ct_id_txt;
	}

	function send_notification($token_list, $title, $message, $clickAction="", $content_idx="") {
		//FCM 인증키
		$FCM_KEY = 'AAAA42ZAcJw:APA91bFWIfDIDXFAVGJ2Kizl69hh324hOQ_-0z-xGFRqo1euTtQMJZcM8J2hP2uQQwy3iJdCATn2tPmgAlzWOkoCqMDy5YCC-QaX3P2sfEHRAEBQ0uC3sve8fxdJbY6ZTRtSG5TvjR37';
		//FCM 전송 URL
		$FCM_URL = 'https://fcm.googleapis.com/fcm/send';

		//전송 데이터
		$fields = array (
			'registration_ids' => $token_list,
			'data' => array (
				'title' => $title,
				'message' => $message,
				'intent' => $clickAction,
				'content_idx' => $content_idx,
			),
			'notification' => array (
				'title' => $title,
				'body' => $message,
				'content_idx' => $content_idx,
				'badge' => 1,
			),
		);

		//설정
		$headers = array( 'Authorization:key='. $FCM_KEY, 'Content-Type:application/json' );

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $FCM_URL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if($result === false) {
			die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
		$obj = json_decode($result);

		return $obj;
	}

	function get_ot_code() {
		global $DB;

		$unique = false;
		do {
			$uid = substr("F".date("ymdHis", time()).strtoupper(md5(mt_rand())), 0, 16);
			$query = "select * from order_t where ot_code = '".$uid."'";
			$cnt = $DB->count_query($query);
			if ($cnt < 1) {
				$unique = true;
				break;
			}
		}
		while ($unique == false);

		return $uid;
	}

	function get_ot_pcode() {
		global $DB;

		$unique = false;
		do {
			$uid = substr("SP".date("ymdHis", time()).strtoupper(md5(mt_rand())), 0, 16);
			$query = "select * from cart_t where ot_pcode = '".$uid."'";
			$cnt = $DB->count_query($query);
			if ($cnt < 1) {
				$unique = true;
				break;
			}
		}
		while ($unique == false);

		return $uid;
	}

	function mt_id_pad($mt_id) {
		return str_pad(cut_str($mt_id, 0, 3, ''), 7, '****');
	}

	function get_mt_point($mt_idx) {
		global $DB;

		unset($list);
		$query = "select * from point_t where mt_idx = '".$mt_idx."'";
		$list = $DB->select_query($query);

		$mt_point = 0;

		if($list) {
			foreach($list as $row) {
				if($row['pt_type']=='P') {
					$mt_point += $row['pt_point'];
				} else {
					$mt_point -= $row['pt_point'];
				}
			}
		}

		return $mt_point;
	}

	function get_mct_point($mct_idx) {
		global $DB;

		unset($list);
		$query = "select * from point_t where mct_idx = '".$mct_idx."'";
		$list = $DB->select_query($query);

		$mct_point = 0;

		if($list) {
			foreach($list as $row) {
				if($row['pt_type']=='P') {
					$mct_point += $row['pt_point'];
				} else {
					$mct_point -= $row['pt_point'];
				}
			}
		}

		return $mct_point;
	}

	function push_mct_point($mt_idx, $mct_idx, $pt_type, $pt_class, $pt_point, $pt_content) {
		global $DB;

		unset($arr_query);
		$arr_query = array(
			"mt_idx" => $mt_idx,
			"mct_idx" => $mct_idx,
			"pt_type" => $pt_type,
			"pt_class" => $pt_class,
			"pt_point" => $pt_point,
			"pt_content" => $pt_content,
			"pt_wdate" => "now()",
		);

		$DB->insert_query('point_t', $arr_query);
		$_last_idx = $DB->insert_id();

		return $_last_idx;
	}

	function get_openssl_encrypt2($str, $secret_key='secret key', $secret_iv='secret iv') {
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 32);
		return str_replace("=", "", base64_encode(
			openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv))
		);
	}

	function get_openssl_decrypt2($str, $secret_key='secret key', $secret_iv='secret iv') {
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 32);
		return openssl_decrypt(
			base64_decode($str), "AES-256-CBC", $key, 0, $iv
		);
	}

	function get_image_url($pt_image, $no_img="") {
		global $ct_no_img1_url, $ct_img_url, $ct_img_dir_r;

		if($no_img) {
			$no_img_t = $no_img;
		} else {
			$no_img_t = $ct_no_img1_url;
		}

		if(is_file($ct_img_dir_r."/".$pt_image)) {
			$rtn = $ct_img_url."/".$pt_image."?v=".time();
		} else {
			$rtn = $no_img_t;
		}

		return $rtn;
	}

	function f_review_star($score) {
		$score = round($score);

		$rtn = '';
		for($q=1;$q<6;$q++) {
			if($q<=$score) {
				$rtn .= '<i class="xi xi-star fc_bl"></i>';
			} else {
				$rtn .= '<i class="xi xi-star fc_grddd"></i>';
			}
		}

		return $rtn;
	}

	$st_info = get_setup_t_info();
	$_SESSION['_st_kakao_channel'] = $st_info['st_kakao_channel'];
	$_SESSION['_st_kakao_channel_time'] = $st_info['st_kakao_channel_time'];
?>
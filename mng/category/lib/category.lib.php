<?php

//--------------------------------------------------------------------------------------------------

// 문자길이 자름
function cut_str1($text, $length, $suffix="…") {

    if (!$text) { return false; }
    if (!$length) { return $text; }

    $c = 0;
    $n = 0;
    $cut = 0;
    for ($i=0; $i<strlen($text); $i++) {
        $cut++;
        $ord = ord($text[$i]);
        if ($ord < '128') {
            $c++;
        } else {
            $n++;
            if ($n == '3') {
                $c++;
                $n = 0;
            }
        }
        if ($c >= $length) {
            break;
        }
    }
    $data = substr($text, 0, $cut);
    if ($c >= $length) {
        return $data.$suffix;
    } else {
        return $data;
    }
}
//--------------------------------------------------------------------------------------------------
// 필터1
function filter1($text, $html="0", $cut="") {

    if (!$text) { return false; }
    $text = stripslashes(strip_tags($text));
    $text = preg_replace("/&amp;/", "&", $text);
    if ($html == '0') {
        $text = preg_replace("/\&([a-z0-9]{1,20}|\#[0-9]{0,3});/i", "&#038;\\1;", $text);
    }
    $source[] = "/</";
    $target[] = "&lt;";
    $source[] = "/>/";
    $target[] = "&gt;";
    $source[] = "/\"/";
    $target[] = "&#034;";
    $source[] = "/\'/";
    $target[] = "&#039;";
    if ($html) {
        $source[] = "/\n/";
        $target[] = "<br/>";
    }
    $text = preg_replace($source, $target, $text);
    if ($cut) {
        return cut_str1($text, $cut, "...");
    } else {
        return $text;
    }
}
//--------------------------------------------------------------------------------------------------
// 분류
function shop_category($category_id) {

    global $g5;

    if ($category_id) { $category_id = preg_match("/^[0-9]+$/", $category_id) ? $category_id : ""; }

    if (!$category_id) {

        return false;

    }

    return sql_fetch(" select * from {$g5['category_table']} where c_id = '$category_id' ");

}
//--------------------------------------------------------------------------------------------------

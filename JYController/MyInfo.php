<?php 
include ("../lib_inc.php");
    class MyInfo{
        //포인트 값 가져오는 함수
        function getPoint(){
            $sql_query = "SELECT mt_point FROM member_t WHERE mt_id = '".$_SESSION['mt_id']."'";
            $DB = new DB();
            $DB -> __construct();
            $result = $DB -> select_query($sql_query, 0);
            $DB -> close();
            foreach($result as $row);
            return $row['mt_point'];
        }

        //할인코드 가져오는 함수
        function getDiscountCd(){
            $sql_query = "SELECT mt_discount_cd FROM member_t WHERE mt_id = '".$_SESSION['mt_id']."'";
            $DB = new DB();
            $DB -> __construct();
            $result = $DB -> select_query($sql_query, 0);
            $DB -> close();
            foreach($result as $row);
            return $row['mt_discount_cd'];
        }

        //이메일 가져오는 함수
        function getEmail(){
            $sql_query = "SELECT mt_email FROM member_t WHERE mt_id = '".$_SESSION['mt_id']."'";
            $DB = new DB();
            $DB -> __construct();
            $result = $DB -> select_query($sql_query, 0);
            $DB -> close();
            foreach($result as $row);
            return $row['mt_email'];
        }

        //휴대전화번호 가져오는 함수
        function getPhNum(){
            $sql_query = "SELECT mt_hp FROM member_t WHERE mt_id = '".$_SESSION['mt_id']."'";
            $DB = new DB();
            $DB -> __construct();
            $result = $DB -> select_query($sql_query, 0);
            $DB -> close();
            foreach($result as $row);
            return $row['mt_hp'];
        }

        //환불 계좌 정보 가져오기
        function getBankInfo(){
            $sql_query = "SELECT bk_uname, bk_name, bk_acount_num FROM member_t WHERE mt_id = '".$_SESSION['mt_id']."'";
            $DB = new DB();
            $DB -> __construct();
            $result = $DB -> select_query($sql_query, 0);
            $DB -> close();
            foreach($result as $row);
            return $row;
        }
    }
?>
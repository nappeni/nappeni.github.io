<?
	include "./head_inc.php";
	include "./head_menu_inc.php";
    $sql = "select code1, mt_name, name_mark, app_status, d_datetime from  d_app_domestic order by d_datetime limit 0, 10";
    $list1 = $DB->select_query($sql);
    $sql = "select * from o_app_domestic order by o_datetime desc limit 0, 10";
    $list2 = $DB->select_query($sql);
    $sql = "select * from inquiry_t order by qt_wdate limit 0, 10";
    $list3 = $DB->select_query($sql);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">국내 신규 출원</h4>
                <div class="form-group row">
                    <table class="table table-bordered" style="text-align: center;">
                        <tr>
                            <td class="nation-td co_td">접수번호</td>
                            <td class="nation-td co_td">담당자</td>
                            <td class="nation-td co_td">상표명</td>
                            <td class="nation-td co_td">진행상태</td>
                            <td class="nation-td co_td">접수일시</td>
                        </tr>
                        <?php if($list1){
                            foreach($list1 as $row){?>
                        <tr>
                            <td class="text-center"><?= $row['code1']?></td>
                            <td class="text-center"><?= $row['mt_name']?></td>
                            <td class="text-center"><?= $row['name_mark']?></td>
                            <td class="text-center">
                                <?php 
                                    switch($row['app_status']){
                                        case 1:
                                            echo "접수";
                                            break;
                                        case 2:
                                            echo "접수완료";
                                            break;
                                        case 3:
                                            echo "출원준비-1차 수정요청";
                                            break;
                                        case 4:
                                            echo "출원준비-2차 수정요청";
                                            break;
                                        case 5:
                                            echo "출원준비-3차 수정요청";
                                            break;
                                        case 6:
                                            echo "출원완료";
                                            break;
                                        case 7:
                                            echo "출원취소";
                                            break;
                                        case 8:
                                            echo "출원대기";
                                            break;
                                    }
                                ?>
                            </td>
                            <td class="text-center"><?= $row['d_datetime']?></td>
                        </tr>
                        <?php }
                        }?>
                    </table>
                </div>
                <br>
                <h4 class="card-title">해외 신규 출원</h4>
                <div class="form-group row">
                    <table class="table table-bordered" style="text-align: center;">
                        <tr>
                            <td class="nation-td co_td">아이디</td>
                            <td class="nation-td co_td">담당자</td>
                            <td class="nation-td co_td">상표명</td>
                            <td class="nation-td co_td">접수날짜</td>
                        </tr>
                        <?php if($list2){
                            foreach($list2 as $row){
                            $sql = "select mt_id from member_t where idx='".$row['mt_idx']."'";
                            $mt_idx = $DB->fetch_query($sql);?>
                        <tr>
                            <td class="text-center"><?= $mt_idx['mt_id']?></td>
                            <td class="text-center"><?= $row['m_name']?></td>
                            <td class="text-center"><?= $row['p_name']?></td>
                            <td class="text-center"><?= $row['o_datetime']?></td>
                        </tr>
                        <?php }
                        }?>
                    </table>
                </div>
                <br>
                <h4 class="card-title">1:1 문의</h4>
                <div class="form-group row">
                    <table class="table table-bordered" style="text-align: center;">
                        <tr>
                            <td class="nation-td co_td">이름</td>
                            <td class="nation-td co_td">아이디</td>
                            <td class="nation-td co_td">제목</td>
                            <td class="nation-td co_td">상태</td>
                            <td class="nation-td co_td">등록날짜</td>
                        </tr>
                        <?php if($list3){
                            foreach($list3 as $row){?>
                        <tr>
                            <td class="text-center"><?= $row['mt_name']?></td>
                            <td class="text-center"><?= $row['mt_id']?></td>
                            <td class="text-center"><?= $row['qt_title']?></td>
                            <td class="text-center">
                                <?php 
                                    if($row['qt_status']==1){
                                        echo "접수";
                                    }else{
                                        echo "답변 완료";
                                    }
                                ?>
                            </td>
                            <td class="text-center"><?= $row['qt_wdate']?></td>
                        </tr>
                        <?php }
                        }?>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?
	include "./foot_inc.php";
?>
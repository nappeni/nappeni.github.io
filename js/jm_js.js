var hostname = window.location.protocol + "//" + window.location.host;

function addComma(num){
    var regexp = /\B(?=(\d{3})+(?!\d))/g;
    return num.toString().replace(regexp, ',');
}

function gourl(url){
    location.href = url;
}
function submit_form1(){
    $("#form1").submit();
}
function submit_form2(){
    $("#form2").submit();
}
function save_session(strname,strval){
    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'save_session',
            strname:strname,
            strval:strval,
        },
        cache: false,
        success: function(data){
            console.log(data);
        }
    });
}
function ajax_post_file(page,frm,ele_origin_id){
    var params;
    var url;
    params = new FormData($('#'+frm).get(0));
    if(page=="domestic_step1"){
        url = "./upload_domestic_step1.php";
    }
    $.ajax({
        type: "POST",
        url: url,
        data: params,
        dataType:'html',
        enctype: 'multipart/form-data',
        contentType: false,
        processData: false,
        cache: false,

        success: function(data){
            //console.log(data);
            if(data==1){
                alert("파일이 첨부되지 않았습니다. 계속해서 첨부되지 않을 시 닥터마크에 문의 주시기 바랍니다.");
            }else{
                $("#"+ele_origin_id).val(data);
            }
        }
    });
}

function ajax_post_file2(page,frm,ele_origin_id){
    var params;
    var url;
    params = new FormData($('#'+frm).get(0));
    params.append("cate_act",ele_origin_id);
    if(page=="domestic_step3"){
        url = "./upload_domestic_step3.php";
    }
    $.ajax({
        type: "POST",
        url: url,
        data: params,
        dataType:'html',
        enctype: 'multipart/form-data',
        contentType: false,
        processData: false,
        cache: false,

        success: function(data){
            console.log(data);
            $("#"+ele_origin_id).val(data);
        }
    });
}

function dateFormat(date){
    let month = date.getMonth() + 1;
    let day = date.getDate();
    let hour = date.getHours();
    let minute = date.getMinutes();
    let second = date.getSeconds();

    month = month >= 10 ? month : '0' + month;
    day = day >= 10 ? day : '0' + day;
    hour = hour >= 10 ? hour : '0' + hour;
    minute = minute >= 10 ? minute : '0' + minute;
    second = second >= 10 ? second : '0' + second;

    return date.getFullYear() + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
}

function save_temporarily(strmode){
    if(strmode=="application_domestic"){
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'save_temporarily',
                strmode:strmode,
            },
            cache: false,
            success: function(data){
                alert("작성하신 내용이 임시저장 되었습니다.");
                console.log(data);
            }
        });
    }
}
function save_temporarily2(strmode){
    if(strmode=="application_domestic"){
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'save_temporarily',
                strmode:strmode,
            },
            cache: false,
            success: function(data){
                console.log(data);
            }
        });
    }
}

function del_cate1(catelv,ctid){
    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'del_cate1',
            catelv:catelv,
            ctid:ctid,
        },
        cache: false,
        success: function(data){
            console.log(data);
            location.reload();
        }
    });
}

function up_ele_cate(ct_level,ct_id,ct_pid=0){
    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'up_ele_cate',
            ct_level:ct_level,
            ct_id:ct_id,
            ct_pid:ct_pid,
        },
        cache: false,
        success: function(data){
            //console.log(data);
            location.reload();
        }
    });
}

function down_ele_cate(ct_level,ct_id,ct_pid=0){
    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'down_ele_cate',
            ct_level:ct_level,
            ct_id:ct_id,
            ct_pid:ct_pid,
        },
        cache: false,
        success: function(data){
            //console.log(data);
            location.reload();
        }
    });
}

function del_dadi_domestic(idx){
    if(confirm("선택하신 상품을 삭제하시겠습니까?")){
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'del_dadi_domestic',
                idx:idx,
            },
            cache: false,
            success: function(data){
                //console.log(data);
                location.reload();
            }
        });
    }
}

function del_dadi_domestic_all(mtidx){
    if(confirm("전체 상품을 삭제하시겠습니까?")){
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'del_dadi_domestic_all',
                mtidx:mtidx,
            },
            cache: false,
            success: function(data){
                //console.log(data);
                location.reload();
            }
        });
    }
}

function nohypen_input(strid){
    var strval = $("#"+strid).val();
    strval = strval.replaceAll("-","");
    $("#"+strid).val(strval);
}
function nohypen_save_session(strid,strname,strval){
    var strval2 = $("#"+strid).val();
    strval2 = strval2.replaceAll("-","");
    $("#"+strid).val(strval2);

    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'save_session',
            strname:strname,
            strval:strval,
        },
        cache: false,
        success: function(data){
            console.log(data);
        }
    });
}

function chk_mt_discount_cd(code_person_id){
    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'chk_mt_discount_cd',
            code_person_id:code_person_id,
        },
        cache: false,
        success: function(data){
            //console.log(data);
            if(Number(data)==1){
                alert("작성하신 코드의 회원을 찾을 수 없습니다. 추천인 코드를 다시 확인해주세요.");
            }else if(Number(data)==2){
                alert("해당 추천인 코드는 이미 사용하신 코드이므로 사용하실 수 없습니다.");
            }else if(Number(data)==3){
                alert("해당 추천인 코드는 사용 가능합니다.");
                $("#use_code_person_id").val("Y");
                var sum_price = $("#sum_price").val();
                var sale_price_mtcode = Number(sum_price) * 0.05;
                var sale_price_salecode = $("#sale_price_salecode").val();
                var sale_price_point = $("#sale_price_point").val();
                var sale_price_sum = Number(sale_price_mtcode)+Number(sale_price_salecode)+Number(sale_price_point);;

                var pay_price = Number(sum_price)-Number(sale_price_sum);

                $("#sale_price_mtcode").val(sale_price_mtcode);
                $("#view_sale_price_mtcode").html("- "+addComma(sale_price_mtcode)+"원");
                $("#sale_price_sum").val(sale_price_sum);
                $("#view_sale_price_sum").html("- "+addComma(sale_price_sum)+"원");

                $("#pay_price").val(pay_price);
                $("#view_pay_price").html(addComma(pay_price)+"원");
            }
        }
    });
}

function use_point_domestic(ot_use_point){
    var sum_price = $("#sum_price").val();
    var sale_price_mtcode = $("#sale_price_mtcode").val();
    var sale_price_salecode = $("#sale_price_salecode").val();

    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'chk_mypoint',
            ot_use_point:Number(ot_use_point),
        },
        cache: false,
        success: function(data){
            console.log(data);

            if(Number(data)==2){
                var sale_price_sum = Number(sale_price_mtcode)+Number(sale_price_salecode)+Number(ot_use_point);
                var pay_price = Number(sum_price)-Number(sale_price_sum);

                $("#sale_price_sum").val(sale_price_sum);
                $("#view_sale_price_sum").html("- "+addComma(sale_price_sum)+"원");

                $("#sale_price_point").val(ot_use_point);
                $("#view_sale_price_point").html("- "+addComma(Number(ot_use_point))+"원");

                $("#pay_price").val(pay_price);
                $("#view_pay_price").html(addComma(pay_price)+"원");
            }else{
                alert("입력하신 포인트가 보유하고 계신 포인트보다 높습니다.");
                ot_use_point = ot_use_point.substring(0,ot_use_point.length-1);
                $("#ot_use_point").val(ot_use_point);
            }

        }
    });

}

function use_point_domestic2(ot_use_point){
    var sum_price = $("#sum_price").val();
    var sale_price_salecode = $("#sale_price_salecode").val();

    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'chk_mypoint',
            ot_use_point:Number(ot_use_point),
        },
        cache: false,
        success: function(data){
            console.log(data);

            if(Number(data)==2){
                var sale_price_sum = Number(sale_price_salecode)+Number(ot_use_point);
                var pay_price = Number(sum_price)-Number(sale_price_sum);

                $("#sale_price_sum").val(sale_price_sum);
                $("#view_sale_price_sum").html("- "+addComma(sale_price_sum)+"원");

                $("#sale_price_point").val(ot_use_point);
                $("#view_sale_price_point").html("- "+addComma(Number(ot_use_point))+"원");

                $("#pay_price").val(pay_price);
                $("#view_pay_price").html(addComma(pay_price)+"원");
            }else{
                alert("입력하신 포인트가 보유하고 계신 포인트보다 높습니다.");
                ot_use_point = ot_use_point.substring(0,ot_use_point.length-1);
                $("#ot_use_point").val(ot_use_point);
            }

        }
    });

}

function use_allpoint_domestic(){
    var sum_price = $("#sum_price").val();
    var sale_price_mtcode = $("#sale_price_mtcode").val();
    var sale_price_salecode = $("#sale_price_salecode").val();

    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'use_myallpoint',
        },
        cache: false,
        success: function(data){
            //console.log(data);
            var mypoint = Number(data);
            var sale_price_sum = Number(sale_price_mtcode)+Number(sale_price_salecode)+mypoint;
            var pay_price = Number(sum_price)-Number(sale_price_sum);

            $("#ot_use_point").val(mypoint);

            $("#sale_price_sum").val(sale_price_sum);
            $("#view_sale_price_sum").html("- "+addComma(sale_price_sum)+"원");

            $("#sale_price_point").val(mypoint);
            $("#view_sale_price_point").html("- "+addComma(Number(mypoint))+"원");

            $("#pay_price").val(pay_price);
            $("#view_pay_price").html(addComma(pay_price)+"원");
        }
    });
}
function use_allpoint_domestic2(){
    var sum_price = $("#sum_price").val();
    var sale_price_salecode = $("#sale_price_salecode").val();

    $.ajax({
        type: "POST",
        url: hostname + "/get_ajax.php",
        data: {
            mode:'use_myallpoint',
        },
        cache: false,
        success: function(data){
            //console.log(data);
            var mypoint = Number(data);
            var sale_price_sum = Number(sale_price_salecode)+mypoint;
            var pay_price = Number(sum_price)-Number(sale_price_sum);

            $("#ot_use_point").val(mypoint);

            $("#sale_price_sum").val(sale_price_sum);
            $("#view_sale_price_sum").html("- "+addComma(sale_price_sum)+"원");

            $("#sale_price_point").val(mypoint);
            $("#view_sale_price_point").html("- "+addComma(Number(mypoint))+"원");

            $("#pay_price").val(pay_price);
            $("#view_pay_price").html(addComma(pay_price)+"원");
        }
    });
}

function check_all(f)
{
    var chk = document.getElementsByName("chk[]");

    for (i=0; i<chk.length; i++)
        chk[i].checked = f.chkall.checked;
}

function del_domestic(idx){
    if(confirm("해당 자료를 삭제하시겠습니까?")){
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'del_domestic',
                idx:idx,
            },
            cache: false,
            success: function(data){
                //console.log(data);
                location.reload();
            }
        });
    }
}

function del_domestic_item(idx){
    if(confirm("해당 자료를 삭제하시겠습니까?")){
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'del_domestic_item',
                idx:idx,
            },
            cache: false,
            success: function(data){
                //console.log(data);
                location.reload();
            }
        });
    }
}

function pay_inicis(ot_name,ot_mode,merchant_uid,pay_method,app_idx,app_item_idx,mt_idx,mt_email,mt_name,mt_hp,sum_price,sale_price_mtcode=0,sale_price_salecode=0,sale_price_point=0){
    IMP.init("imp11998291");

    var pay_price = Number(sum_price)-Number(sale_price_mtcode)-Number(sale_price_salecode)-Number(sale_price_point);
    if(pay_price<0){
        alert("결제금액이 0보다 작을 수 없습니다.");
        return false;
    }else if(pay_price>0){
        IMP.request_pay({
            pg : 'html5_inicis',
            pay_method : pay_method,
            merchant_uid: merchant_uid, //상점에서 생성한 고유 주문번호
            name : ot_name,
            amount : pay_price,
            buyer_email : mt_email,
            buyer_name : mt_name,
            buyer_tel : mt_hp,
            buyer_addr : '',
            buyer_postcode : ''
        }, function(response) {
            //결제 후 호출되는 callback함수
            if ( response.success ) {
                // 결제 성공 시 로직
                //console.log(response);

                var apply_num = response.apply_num;
                var bank_name = response.bank_name;
                var buyer_addr = response.buyer_addr;
                var buyer_email = response.buyer_email;
                var buyer_name = response.buyer_name;
                var buyer_postcode = response.buyer_postcode;
                var buyer_tel = response.buyer_tel;
                var od_status = response.status;

                var card_name = response.card_name;
                var card_number = response.card_number;
                var card_quota = response.card_quota;
                var currency = response.currency;
                var imp_uid = response.imp_uid;
                var merchant_uid = response.merchant_uid;
                var odname = response.name;
                var paid_amount = response.paid_amount;
                var paid_at = response.paid_at;
                var pay_method = response.pay_method;
                var pg_provider = response.pg_provider;
                var pg_tid = response.pg_tid;
                var receipt_url = response.receipt_url;

                var vbank_date = response.vbank_date;
                var vbank_holder = response.vbank_holder;
                var vbank_name = response.vbank_name;
                var vbank_num = response.vbank_num;

                $.ajax({
                    type: "POST",
                    url: hostname + "/get_ajax.php",
                    data: {
                        mode:'order_domestic',
                        ot_mode:ot_mode,
                        app_idx:app_idx,
                        app_item_idx:app_item_idx,
                        mt_idx:mt_idx,
                        apply_num:apply_num,
                        bank_name:bank_name,
                        buyer_addr:buyer_addr,
                        buyer_email:buyer_email,
                        buyer_name:buyer_name,
                        buyer_postcode:buyer_postcode,
                        buyer_tel:buyer_tel,
                        od_status:od_status,
                        card_name:card_name,
                        card_number:card_number,
                        card_quota:card_quota,
                        currency:currency,
                        imp_uid:imp_uid,
                        merchant_uid:merchant_uid,
                        odname:odname,
                        paid_amount:paid_amount,
                        paid_at:paid_at,
                        pay_method:pay_method,

                        sum_price:sum_price,
                        sale_price_mtcode:sale_price_mtcode,
                        sale_price_salecode:sale_price_salecode,
                        sale_price_point:sale_price_point,
                        pay_price:pay_price,

                        pg_provider:pg_provider,
                        pg_tid:pg_tid,
                        receipt_url:receipt_url,
                        vbank_date:vbank_date,
                        vbank_holder:vbank_holder,
                        vbank_name:vbank_name,
                        vbank_num:vbank_num,
                    },
                    cache: false,
                    success: function(data){
                        console.log(data);
                        submit_form1();
                    }
                });

            } else {
                // 결제 실패 시 로직
                alert(response.error_msg);
            }
        });
    }else{
        // 결제금액이 0원일 떄
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'order_domestic',
                ot_mode:ot_mode,
                app_idx:app_idx,
                app_item_idx:app_item_idx,
                mt_idx:mt_idx,
                apply_num:"",
                bank_name:"",
                buyer_addr:"",
                buyer_email:mt_email,
                buyer_name:mt_name,
                buyer_postcode:"",
                buyer_tel:mt_hp,
                od_status:"paid",
                card_name:"",
                card_number:"",
                card_quota:"",
                currency:"",
                imp_uid:"",
                merchant_uid:merchant_uid,
                odname:ot_name,
                paid_amount:pay_price,
                paid_at:"",
                pay_method:"point",

                sum_price:sum_price,
                sale_price_mtcode:sale_price_mtcode,
                sale_price_salecode:sale_price_salecode,
                sale_price_point:sale_price_point,

                pg_provider:"",
                pg_tid:"",
                receipt_url:"",
                vbank_date:"",
                vbank_holder:"",
                vbank_name:"",
                vbank_num:"",
            },
            cache: false,
            success: function(data){
                console.log(data);
                submit_form1();
            }
        });
    }

}

function cancel_app_item(idx){
    if(confirm("정말 출원을 포기 하시겠습니까? 출원 관련 결제 금액은 환불이 불가합니다.")){
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'cancel_app_item',
                idx:idx,
            },
            cache: false,
            success: function(data){
                //console.log(data);
                location.reload();
            }
        });
    }
}

function del_content(tbname,idx,strlink){
    if(confirm('해당 콘텐츠를 삭제하시겠습니까?')){
        $.ajax({
            type: "POST",
            url: hostname + "/get_ajax.php",
            data: {
                mode:'del_content',
                tbname:tbname,
                idx:idx,
            },
            cache: false,
            success: function(data){
                console.log(data);
                if(strlink){
                    location.href = strlink;
                }else{
                    location.reload();
                }
            }
        });
    }
}





$.datepicker.setDefaults({
    dateFormat: 'yy.mm.dd',
    prevText: '이전 달',
    nextText: '다음 달',
    monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
    monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
    dayNames: ['일', '월', '화', '수', '목', '금', '토'],
    dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
    dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
    showMonthAfterYear: true,
    yearSuffix: '년',
    //minDate: 0
});



$(function (){
    $(".datepicker").datepicker();

    $(".ele_chk").on("click", function (){
        if($(this).is(":checked")==false){
            $("#chkall").prop("checked", false);
        }
    })
});
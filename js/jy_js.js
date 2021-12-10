//join.php js 시작
var imgRoute = ' https://dmonster1705.cafe24.com/data/app_domestic/';
//아이디 중복확인 && 이메일 (회원가입)
var IdFlag = false;
function Check_Id() {
  //에러메시지 출력 실패 [0] 성공[1]
  var id = document.getElementById('id');
  var emailCheck = /[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]$/i;
  if (emailCheck.test(id.value)) {
    $.ajax({
      //아이디 중복확인
      url: '../JYController/join.php',
      data: { id: id.value, function: 'checkId' },
      type: 'post',
      dataType: 'json',
      success: function (result) {
        console.log(result['success']);
        //중복 아이다기 없으면 true, 있으면 flase
        if (result['success'] == '1') {
          document.getElementsByName('IdMsg')[0].style.display = 'none';
          document.getElementsByName('IdMsg')[1].style.display = 'block';
          IdFlag = true;
        } else if (result['success'] == '2') {
          document.getElementsByName('IdMsg')[0].style.display = 'block';
          document.getElementsByName('IdMsg')[0].textContent = '사용할 수 없는 아이디입니다.';
          document.getElementsByName('IdMsg')[1].style.display = 'none';
          alert('탈퇴한 회원입니다. 1년간 해당 계정으로 계정을 생성할 수 없습니다.');
          location.href = './index.php';
        } else {
          document.getElementsByName('IdMsg')[0].style.display = 'block';
          document.getElementsByName('IdMsg')[0].textContent = '사용할 수 없는 아이디입니다.';
          document.getElementsByName('IdMsg')[1].style.display = 'none';
        }
      },
    });
  } else {
    //이메일 형태
    document.getElementsByName('IdMsg')[0].style.display = 'block';
    document.getElementsByName('IdMsg')[0].textContent = '이메일을 입력해주세요';
    document.getElementsByName('IdMsg')[1].style.display = 'none';
  }
}
//비밀번호 조건 (회원가입, 비밀번호 찾기)
var passwdFlag = false;
function check_Pw() {
  //에러메시지 출력 글자수 [0] 공백[1] 조건[2] 비번사용가능[3]
  var passwd = document.getElementsByName('passwdBlind')[0].value;
  var num = passwd.search(/[0-9]/g);
  var eng = passwd.search(/[a-z]/gi);
  var spe = passwd.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);
  if (passwd.length < 8 || passwd.lenght > 20) {
    document.getElementsByName('PWMsg')[0].style.display = 'block';
    document.getElementsByName('PWMsg')[0].textContent = '8자리 ~ 20자리 이내로 입력해주세요.';
    document.getElementsByName('PWMsg')[1].style.display = 'none';
  } else if (passwd.search(/\s/) != -1) {
    document.getElementsByName('PWMsg')[0].style.display = 'block';
    document.getElementsByName('PWMsg')[0].textContent = '비밀번호는 공백 없이 입력해주세요.';
    document.getElementsByName('PWMsg')[1].style.display = 'none';
  } else if (num < 0 || eng < 0 || spe < 0) {
    document.getElementsByName('PWMsg')[0].style.display = 'block';
    document.getElementsByName('PWMsg')[0].textContent = '영문,숫자,특수문자를 혼합하여 입력해주세요.';
    document.getElementsByName('PWMsg')[1].style.display = 'none';
  } else {
    document.getElementsByName('PWMsg')[0].style.display = 'none';
    document.getElementsByName('PWMsg')[1].style.display = 'block';
    passwdFlag = true;
  }
}
//현재 비밀번호 입력란(계정관리)
function BlindNowSet() {
  //[0] 패스워드 input [2]패스워드 노출 버튼
  var passwordButton = document.getElementsByName('passwdNowBlind')[1].className;
  if (passwordButton == 'pw pw_off') {
    document.getElementsByName('passwdNowBlind')[0].type = 'text';
    document.getElementsByName('passwdNowBlind')[1].className = 'pw pw_on';
  } else {
    document.getElementsByName('passwdNowBlind')[0].type = 'password';
    document.getElementsByName('passwdNowBlind')[1].className = 'pw pw_off';
  }
}
//비밀번호 노출(회원가입/로그인/비밀번호 찾기/계정관리)
function BlindSet() {
  //[0] 패스워드 input [2]패스워드 노출 버튼
  var passwordButton = document.getElementsByName('passwdBlind')[1].className;
  if (passwordButton == 'pw pw_off') {
    document.getElementsByName('passwdBlind')[0].type = 'text';
    document.getElementsByName('passwdBlind')[1].className = 'pw pw_on';
  } else {
    document.getElementsByName('passwdBlind')[0].type = 'password';
    document.getElementsByName('passwdBlind')[1].className = 'pw pw_off';
  }
}
//비밀번호 찾기 재입력 노출버튼 (비밀번호 찾기/ 계정관리)
function BlindCkSet() {
  //[0] 패스워드 input [2]패스워드 노출 버튼
  var passwordButton = document.getElementsByName('passwdCkBlind')[1].className;
  if (passwordButton == 'pw pw_off') {
    document.getElementsByName('passwdCkBlind')[0].type = 'text';
    document.getElementsByName('passwdCkBlind')[1].className = 'pw pw_on';
  } else {
    document.getElementsByName('passwdCkBlind')[0].type = 'password';
    document.getElementsByName('passwdCkBlind')[1].className = 'pw pw_off';
  }
}
//비밀번호 비밀번호 재입력 값 확인 (비밀번호 찾기/ 계정관리)
var passwdCkFlag = false;
function checkPassword() {
  var passwd = document.getElementsByName('passwdBlind')[0].value;
  var passwdCk = document.getElementsByName('passwdCkBlind')[0].value;
  if (passwd === passwdCk) {
    document.getElementsByName('PWMsg')[2].style.display = 'none';
    document.getElementsByName('PWMsg')[3].style.display = 'block';
    passwdCkFlag = true;
  } else {
    document.getElementsByName('PWMsg')[2].textContent = '비밀번호가 다릅니다.';
    document.getElementsByName('PWMsg')[2].style.display = 'block';
    document.getElementsByName('PWMsg')[3].style.display = 'none';
  }
}
// //입력값 확인(이름/휴대번호/유선전화번호/reCAPTCHA?)
// function check_InputValue(value) {
//   var checkValue = document.getElementsByName('inputValue');
//   //[0] = 이름( 에러메세지 [0]), [1] = 휴대번호( 에러메세지 [1]), [2] = 유선전화( 에러메세지 [2])
//   switch (value) {
//     case 'name':
//       var checkName = /^[가-힣]{2,4}|[a-zA-Z]{2,10}\s[a-zA-Z]{2,10}$/;
//       if (checkName.test(checkValue[0].value)) {
//         document.getElementsByName('NameMsg')[0].style.display = 'none';
//       } else {
//         document.getElementsByName('NameMsg')[0].style.display = 'block';
//       }
//       break;
//     case 'phone':
//       var checkPhone = /^01(?:0|1|[6-9])(?:\d{3}|\d{4})\d{4}$/;
//       if (checkPhone.test(checkValue[1].value)) {
//         document.getElementsByName('NameMsg')[1].style.display = 'none';
//       } else {
//         document.getElementsByName('NameMsg')[1].style.display = 'block';
//       }
//       break;
//     case 'number':
//       var checkNum = /^\d{3}\d{3,4}\d{4}$/;
//       if (checkNum.test(checkValue[2].value)) {
//         document.getElementsByName('NameMsg')[2].style.display = 'none';
//       } else {
//         document.getElementsByName('NameMsg')[2].style.display = 'block';
//       }
//       console.log(checkNum.test(checkValue[2].value)); //결과 출력
//       break;
//   }
// }
//join.php js 끝

<?php
require('TOP.php');

?>


<title>회원가입</title>

<style type="text/css">
  body,select,option,button{font-size:16px}
  input{border:1px solid #999;font-size:14px;padding:5px 10px}
  input,button{vertical-align:middle}
  form{width:320px;margin:auto}
  span{font-size:14px;color:#f00}
  legend{font-size:20px;text-align:center}
  p span{display:block;margin-left:90px}
  button{cursor:pointer}
  .txt{display:inline-block;width:80px}
  .btn{background:#fff;border:1px solid #999;font-size:14px;padding:4px 10px}
  .btn_wrap{text-align:center}
</style>

<script type="text/javascript">
  // let regex_mail = new RegExp("([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\"\(\[\]!#-[^-~ \t]|(\\[\t -~]))+\")@([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])");
  function isEmail(asValue) {
    var regExp = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
  
    return regExp.test(asValue);
  }
 

  function isId(asValue) {
    var regExp = /^[a-z]+[a-z0-9]{8,19}$/g;
  
    return regExp.test(asValue);
  }

  function isPassword(asValue) {
    var regExp = /^(?=.*[a-zA-z])(?=.*[0-9])(?=.*[$`~!@$!%*#^?&\\(\\)\-_=+]).{8,20}$/;
  
    return regExp.test(asValue); // 형식에 맞는 경우 true 리턴
  }

  function register_check(){
    var u_id = document.getElementById("u_id");
    var u_nick = document.getElementById("u_nick");
    var u_email = document.getElementById("u_email");
    var pwd = document.getElementById("pwd");
    var access = 1;

    if(!isId(u_id.value)){
        var err_txt = document.querySelector(".err_id");
        err_txt.textContent = "아이디는 영어와 숫자를 사용할수 있고, 영어로 시작하는 8~20글자만 사용할 수 있습니다.";
        u_id.focus();
        access = 0;
    };


    if(!isPassword(pwd.value)){
        var err_txt = document.querySelector(".err_pwd");
        err_txt.textContent = "비밀번호는 영문 숫자 특수문자를 최소 1문자씩 조합해서 8~20글자 사이로 입력해 주세요.";
        pwd.focus();
        access = 0;

    };


    if(u_nick.value.length < 4 || u_nick.value.length > 11){
        var err_txt = document.querySelector(".err_nick");
        err_txt.textContent = "닉네임은 4~10글자만 입력할 수 있습니다.";
        u_nick.focus();
        access = 0;
        
    };


    if(!isEmail(u_email.value)){
      var err_txt = document.querySelector(".err_email");
      err_txt.textContent = "올바른 형식의 이메일을 입력해야 합니다."
      u_email.focus();
      access = 0;
        
    };

    if (access == 0){
      return false;
    };
  };

</script>
  
</head>
<body>
  <form name="login_form" action="register_ok.php" method="post" onsubmit="return register_check()">
    <fieldset>
      <legend>회원가입</legend>
      <p>
        <label for="u_id" class="txt">아이디</label>
        <input type="text" name="u_id" id="u_id" class="u_id" autofocus>
        <br>
        <span class="err_id"></span>
      </p>

      <p>
        <label for="u_email" class="txt">이메일</label>
        <input type="text" name="u_email" id="u_email" class="u_email" autofocus>
        <br>
        <span class="err_email"></span>
      </p>
    

      <p>
        <label for="u_nick" class="txt">닉네임</label>
        <input type="text" name="u_nick" id="u_nick" class="u_nick" autofocus>
        <!-- <button type="check" class="btn" onclick="history.back()">중복확인</button> -->
        <br>
        <span class="err_nick"></span>
      </p>

      <p>
        <label for="pwd" class="txt">비밀번호</label>
        <input type="password" name="pwd" id="pwd" class="pwd">
        <br>
        <span class="err_pwd"></span>
      </p>

      <p class="btn_wrap">
        <button type="button" class="btn" onclick="history.back()">이전으로</button>
        <button type="submit" class="btn">회원가입</button>
      </p>
    </fieldset>
  </form>
</body>
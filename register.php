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
  let regex = new RegExp("([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\"\(\[\]!#-[^-~ \t]|(\\[\t -~]))+\")@([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])");
  function register_check(){
    var u_id = document.getElementById("u_id");
    var u_nick = document.getElementById("u_nick");
    var u_email = document.getElementById("u_email");
    var pwd = document.getElementById("pwd");
    var access = 1;

    if( u_id.value.length < 8 || u_id.value.length > 20){
        var err_txt = document.querySelector(".err_id");
        err_txt.textContent = "아이디는 8~20글자만 입력할 수 있습니다.";
        u_id.focus();
        access = 0;
    };


    if( pwd.value.length < 8 || pwd.value.length > 20){
        var err_txt = document.querySelector(".err_pwd");
        err_txt.textContent = "비밀번호는 8~20글자만 입력할 수 있습니다.";
        pwd.focus();
        access = 0;

    };


    if(u_nick.value.length < 4 || u_nick.value.length > 11){
        var err_txt = document.querySelector(".err_nick");
        err_txt.textContent = "닉네임은 4~10글자만 입력할 수 있습니다.";
        u_nick.focus();
        access = 0;
        
    };


    if(!regex.test(u_email.value)){
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
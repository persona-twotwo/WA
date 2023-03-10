<?php 
  require "TOP.php";
  if($s_permit != 0){
    echo "<script>
        alert('이미 로그인 된 상태입니다.');
		    location.href='/';</script>";
  }
?>

<title>로그인</title>

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
  function login_check(){
    var u_id = document.getElementById("u_id");
    var pwd = document.getElementById("pwd");
    var access = 1 ;
    function isId(asValue) {
      var regExp = /^[a-z]+[a-z0-9]{8,19}$/g;
    
      return regExp.test(asValue);
    }

    function isPassword(asValue) {
      var regExp = /^(?=.*[a-zA-z])(?=.*[0-9])(?=.*[$`~!@$!%*#^?&\\(\\)\-_=+]).{8,20}$/;
    
      return regExp.test(asValue); // 형식에 맞는 경우 true 리턴
    }

    
    
    if(!isPassword(pwd.value)){
      var err_txt = document.querySelector(".err_pwd");
      err_txt.textContent = "올바른 비밀번호 형식이 아닙니다.";
      pwd.focus();
      access = 0;
      
    }else{
      var err_txt = document.querySelector(".err_pwd");
      err_txt.textContent = "";
    }

    if(!isId(u_id.value)){
        var err_txt = document.querySelector(".err_id");
        err_txt.textContent = "올바른 아이디 형식이 아닙니다.";
        u_id.focus();
        access = 0;
    }else{
      var err_txt = document.querySelector(".err_id");
      err_txt.textContent = "";
    }
    
    if (access == 0){
      return false;
    };
  };
</script>
  
</head>
<body>
  <form name="login_form" action="login_ok.php" method="post" onsubmit="return login_check()">
    <fieldset>
      <legend>로그인</legend>
      <p>
        <label for="u_id" class="txt">아이디</label>
        <input type="text" name="u_id" id="u_id" class="u_id" autofocus>
        <br>
        <span class="err_id"></span>
      </p>

      <p>
        <label for="pwd" class="txt">비밀번호</label>
        <input type="password" name="pwd" id="pwd" class="pwd">
        <br>
        <span class="err_pwd"></span>
      </p>

      <p class="btn_wrap">
        <button type="button" class="btn" onclick="history.back()">이전으로</button>
        <button type="submit" class="btn">로그인</button>
      </p>
    </fieldset>
  </form>
</body>
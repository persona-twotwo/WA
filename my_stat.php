<?php 
  require "db_connect.php";
  require "TOP.php";
  if($s_permit==0){
    echo "<script>
        alert('로그인 후 이용 가능합니다..');
	    location.href='/';</script>";
        exit;
  }
  $db = db_connect("db_board");
  $query = "SELECT id,nick,email from member where number=$s_idx";
  $result = mysqli_fetch_assoc(mysqli_query($db,$query));


?>

<title>내 정보</title>

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
  
</head>
<body>
  <form name="email_verification" action="email_verification.php" method="post">
    <fieldset>
      <legend>로그인</legend>
      <p>
        <input type="hidden" name="s_idx" value="<?php echo $s_idx; ?>" />
        <label for="u_id" class="txt">아이디</label>
        <input type="text" name="u_id" id="u_id" class="u_id" value=<?php echo $result['id'] ?> readonly >
        <br>
        <span class="err_id"></span>
      </p>

      <p>
        <label for="pwd" class="txt">닉네임</label>
        <input type="text" name="u_nick" id="u_nick" class="u_nick" value=<?php echo $result['nick'] ?> readonly>
        <br>
        <span class="err_pwd"></span>
      </p>
      <p>
        <label for="pwd" class="txt">이메일</label>
        <input type="text" name="u_mail" id="u_mail" class="u_mail" value=<?php echo $result['email'] ?> readonly>
        <br>
        <span class="err_pwd"></span>
      </p>
      <p class="btn_wrap">
        <button type="submit" class="btn">이메일 인증</button>
      </p>
    </fieldset>
  </form>
</body>
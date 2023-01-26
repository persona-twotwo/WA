<?php
/* 세션 실행 */
session_start();

/* 이전 페이지에서 값 가져오기 */
$u_id       = $_POST["u_id"];
$u_email    = $_POST["u_email"];
$u_nick     = $_POST["u_nick"];
$pwd        =  password_hash( $_POST["pwd"], PASSWORD_DEFAULT);
// echo "ID : ".$u_id." / PW : ".$pwd;


/* DB 접속 */
require "db_connect.php";
$db = db_connect("db_board");

/* 쿼리 작성 */
$querry = "SELECT * FROM member WHERE id='$u_id';";
$result = mysqli_num_rows(mysqli_query($db, $querry));
if ($result != 0){
    echo "
        <script type=\"text/javascript\">
        alert(\"사용중인 ID입니다.\");
        history.back();
        </script>
        ";
    exit;
}

$querry = "SELECT * FROM member WHERE nick='$u_nick';";
$result = mysqli_num_rows(mysqli_query($db, $querry));
if ($result != 0){
    echo "
        <script type=\"text/javascript\">
        alert(\"사용중인 닉네임입니다.\");
        history.back();
        </script>
        ";
    exit;
}

$querry = "SELECT * FROM member WHERE email='$u_email';";
$result = mysqli_num_rows(mysqli_query($db, $querry));
if ($result != 0){
    echo "
        <script type=\"text/javascript\">
        alert(\"사용중인 이메일입니다.\");
        history.back();
        </script>
        ";
    exit;
}


$querry = "INSERT INTO member (id, passwd, nick, email) values('$u_id', '$pwd', '$u_nick', '$u_email')";

/* 쿼리 전송(연결 객체) */
$result = mysqli_query($db, $querry);
echo "<script>
    alert('회원가입이 완료되었습니다. 로그인 해 주세요.');
    location.href = \"/login.php\";
</script>"


?>
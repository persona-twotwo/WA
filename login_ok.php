<?php
/* 세션 실행 */
session_start();

/* 이전 페이지에서 값 가져오기 */
$u_id = $_POST["u_id"];
$pwd = $_POST["pwd"];



/* DB 접속 */
require "db_connect.php";
$db = db_connect("db_board");

/* 쿼리 작성 */
$querry = "SELECT id, passwd, nick, number, permit FROM member WHERE id='$u_id';";
// echo $sql;
/* 쿼리 전송(연결 객체) */
$result = mysqli_fetch_array(mysqli_query($db, $querry));

/* DB에서 결과값 가져오기 */
// mysqli_fetch_row // 필드 순서
// mysqli_fetch_array // 필드명
// mysqli_num_rows // 결과행의 개수
// $num = mysqli_num_rows($result);

/* 조건 처리 */
if(!$result){ // 아이디가 존재하지 않으면
    // 메세지 출력 후 이전 페이지로 이동
    echo "
        <script type=\"text/javascript\">
            alert(\"일치하는 아이디가 없습니다.\");
            history.back();
        </script>
    ";
    exit;
} else{ // 아이디가 존재하면
    if(password_verify($user_passwd, $db_passwd)){
        echo "
            <script type=\"text/javascript\">
                alert(\"비밀번호가 일치하지 않습니다.\");
                history.back();
            </script>
        ";
    exit;
    } else{ // 비밀번호가 일치한다면
        // 세션 변수 생성
        // $_SESSION["세션변수명"] = 저장할 값;
        $_SESSION["s_idx"] = $result["number"];
        $_SESSION["s_name"] = $result["nick"];
        $_SESSION["s_id"] = $result["id"];
        $_SESSION["s_permit"] = $result["permit"];

        /* DB 연결 종료 */
        mysqli_close($db);

        /* 페이지 이동 */
        echo "
            <script type=\"text/javascript\">
                location.href = \"/\";
            </script>
        ";
    };
};

?>
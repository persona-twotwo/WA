<?php
    require('TOP.php');

    require('db_connect.php');
    $db = db_connect('db_board');
    $number = $_GET['number'];
    $query = "SELECT answer FROM qna WHERE number = $number";
    $result = mysqli_fetch_row(mysqli_query($db, $query))[0];
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
    $content = htmlspecialchars($_POST['content'], ENT_QUOTES);
    $secret = isset($_POST["secret"])?1:0;

    if ($s_permit < 1){
        echo "<script>
        alert('정회원 이상만 글을 수정할 수 있습니다.');
        location.href='/';</script>";
        exit;
    }
    if($result != 0){
        echo"<script>
        alert('답변이 달려 글을 수정할 수 없습니다.');
        history.go(-1);
        </script>";
    }
    if ($title && $content) {
        $query = "UPDATE qna SET title = '$title', content = '$content', secret='$secret' WHERE number=$number";
        // $result = mysqli_query($db, $query);
        $result = mysqli_query($db,$query);
        echo "<script>
        alert('수정이 완료되었습니다.');
        history.go(-2);</script>";
    } else {
        echo "<script>
        alert('수정이 실패했습니다.');
        history.back();</script>";
    }
?>
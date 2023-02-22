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

    if ($s_permit < 3){
        echo "<script>
        alert('관리자만 글을 수정할 수 있습니다.');
        location.href='/';</script>";
        exit;
    }
    
    if ($title && $content) {
        $query = "UPDATE qna SET answer_title='$title', answer_content='$content' WHERE number = '$number'";
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
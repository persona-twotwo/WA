<?php
    require('TOP.php');

    require('db_connect.php');
    $db = db_connect('db_board');
    $reply_number = $_GET['reply_number'];
    //각 변수에 write.php에서 input name값들을 저장한다
    $number = $_POST['number'];
    $content = $_POST['content'];
    if ($s_permit < 2){
        echo "<script>
        alert('정회원 이상만 댓글을 수정할 수 있습니다.');
        location.href='/';</script>";
        exit;
    }
    if ($content) {
        $query = "UPDATE comment SET  content = '$content' WHERE number=$reply_number";
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
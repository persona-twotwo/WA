<?php
    require('TOP.php');

    require('db_connect.php');
    $db = db_connect('db_board');
    $number = $_GET['number'];
    //각 변수에 write.php에서 input name값들을 저장한다
    $title = $_POST['title'];
    $content = $_POST['content'];
    if ($s_permit < 3){
        echo "<script>
        alert('관리자 이상만 공지를 수정할 수 있습니다.');
        location.href='/';</script>";
        exit;
    }
    if ($title && $content) {
        $query = "UPDATE notice SET title = '$title', content = '$content' WHERE number=$number";
        // $result = mysqli_query($db, $query);
        $result = mysqli_query($db,$query);
        echo "<script>
        alert('수정이 완료되었습니다.');
        history.go(-2);;</script>";
    } else {
        echo "<script>
        alert('수정이 실패했습니다.');
        history.back();</script>";
    }
?>
<?php
    require('TOP.php');

    require('db_connect.php');
    $db = db_connect('db_board');
    //각 변수에 write.php에서 input name값들을 저장한다
    $title = $_POST['title'];
    $content = $_POST['content'];
    $number = $_POST['number'];

    if ($s_permit < 3){
        echo "<script>
        alert('관리자만 답변을 작성할 수 있습니다.');
        location.href='/';</script>";
        exit;
    }


    if ($title && $content){
        $tmpfile =  $_FILES['b_file']['tmp_name'];
        $o_name = $_FILES['b_file']['name'];
        $dir = "upload/qna/".$number."/answer";
        $makeDir = mkdir($dir, 0777);
        $folder = $dir."/".$o_name;
        move_uploaded_file($tmpfile,$folder);
        $now =date("Y-m-d H:i:s");
        echo $now;
        $query = "UPDATE qna SET answer=1, answer_title='$title', answer_content='$content', answer_file='$o_name', answer_date='$now' WHERE number = '$number'";
        echo $query;
        $result = mysqli_query($db, $query);

        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='/qna.php';</script>";
    } 
    else {
        echo "<script>
        alert('글쓰기에 실패했습니다.');
        history.back();</script>";
    }
?>
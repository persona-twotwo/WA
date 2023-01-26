<?php
    require('TOP.php');

    require('db_connect.php');
    $db = db_connect('db_board');
    //각 변수에 write.php에서 input name값들을 저장한다
    $title = $_POST['title'];
    $content = $_POST['content'];

    
    if ($s_permit < 3){
        echo "<script>
        alert('관리자만 글을 작성할 수 있습니다.');
        location.href='/';</script>";
        exit;
    }
    if ($title && $content) {
        $number = mysqli_fetch_array(mysqli_query($db,"SELECT Auto_increment from information_schema.tables where table_schema = 'db_board' and table_name = 'notice'"))[0];
        $tmpfile =  $_FILES['b_file']['tmp_name'];
        $o_name = $_FILES['b_file']['name'];
        $dir = "upload/notice/".$number;
        $makeDir = mkdir($dir, 0777);
        $folder = $dir."/".$o_name;
        move_uploaded_file($tmpfile,$folder);
        $query = "INSERT INTO notice (writer_idx, title, content,file) values('$s_idx' ,'$title' , '$content','$o_name')";

        $result = mysqli_query($db, $query);
        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='/notice.php';</script>";
    } else {
        echo "<script>
        alert('글쓰기에 실패했습니다.');
        history.back();</script>";
    }
?>
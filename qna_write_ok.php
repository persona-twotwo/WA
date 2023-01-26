<?php
    require('TOP.php');

    require('db_connect.php');
    $db = db_connect('db_board');
    //각 변수에 write.php에서 input name값들을 저장한다
    $title = $_POST['title'];
    $content = $_POST['content'];
    $secret = isset($_POST["secret"])?1:0;

    if ($s_permit < 1){
        echo "<script>
        alert('로그인 하신 뒤 글을 작성할 수 있습니다.');
        location.href='/';</script>";
        exit;
    }


    if ($title && $content){
        $number = mysqli_fetch_array(mysqli_query($db,"SELECT Auto_increment from information_schema.tables where table_schema = 'db_board' and table_name = 'qna'"))[0];
        $tmpfile =  $_FILES['b_file']['tmp_name'];
        $o_name = $_FILES['b_file']['name'];
        $dir = "upload/qna/".$number;
        $makeDir = mkdir($dir, 0777);
        $folder = $dir."/".$o_name;
        move_uploaded_file($tmpfile,$folder);
        echo "ddd";
        $query = "INSERT INTO qna (writer_idx, title, content,file,secret) values('$s_idx' ,'$title' , '$content','$o_name',$secret)";
        echo "$query";
        $result = mysqli_query($db, $query);
        echo "ddd";

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
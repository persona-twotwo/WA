<?php
    require('TOP.php');

    require('db_connect.php');
    $db = db_connect('db_board');
    //각 변수에 write.php에서 input name값들을 저장한다
    $title = $_POST['title'];
    $content = $_POST['content'];
    if ($s_permit < 2){
        echo "<script>
        alert('정회원 이상만 글을 작성할 수 있습니다.');
        location.href='/';</script>";
        exit;
    }
    if ($title && $content) {
        echo "test<br>";

        $query = "INSERT INTO board (writer_idx, title, content) values('$s_idx' ,'$title' , '$content')";
        echo "result 완료<br/>$query<br/>";

        // $result = mysqli_query($db, $query);
        $result = $db->query($query);
        echo "result 완료<br/>$query<br/>";
        echo "$result<br/>";
        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='/';</script>";
    } else {
        echo "<script>
        alert('글쓰기에 실패했습니다.');
        history.back();</script>";
    }
?>
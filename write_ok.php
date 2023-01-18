<?php


    require('db_connect.php');
    $db = db_connect('db_board');
    //각 변수에 write.php에서 input name값들을 저장한다
    $username = $_POST['name'];
    $userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
    $title = $_POST['title'];
    $content = $_POST['content'];
    echo "$username , $userpw , $title , $content<br/>";
    if ($username && $userpw && $title && $content) {
        $query = "INSERT INTO board (id, passwd, title, content) values('$username' ,'$userpw' ,'$title' , '$content')";
        echo "쿼리문 작성 완료<br/>$query<br/>";
        // $result = mysqli_query($db, $query);
        $result = $db->query($query);
        echo "result 완료<br/>$query<br/>";
        echo "$result<br/>";
        echo "<script>
        alert('글쓰기 완료되었습니다.');
        location.href='index.php';</script>";
    } else {
        echo "<script>
        alert('글쓰기에 실패했습니다.');
        history.back();</script>";
    }
?>
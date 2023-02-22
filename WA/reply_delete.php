<?php
    require('TOP.php');
    require('db_connect.php');
    $db = db_connect('db_board');
    $number = $_POST['reply_number'];
    echo $number;
    $query = "UPDATE comment SET del = 1 WHERE number=$number";
    echo $number;

    $result = mysqli_query($db, $query);
    print_r($result);
    echo "<script>
        alert('삭제가 완료되었습니다.');
        history.back();</script>";
?>
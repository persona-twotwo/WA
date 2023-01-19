<?php
    require('TOP.php');
    require('db_connect.php');
    $db = db_connect('db_board');
    $number = $_GET['number'];
    $query = "SELECT title, number, content, writer_idx FROM board WHERE number = $number";
    $result = mysqli_fetch_array(mysqli_query($db, $query));
    $writer_idx =$result['writer_idx'];
    if(($s_idx != $writer_idx) && ($s_permit <3)){
        echo "<script>
        alert('작성자만 글을 삭제할 수 있습니다.');
        history.back();
        </script>";
        exit;
    }
    $query = "DELETE FROM board WHERE number = '$number'";
    print_r($query);
    $result = (mysqli_query($db, $query));
    echo "<script>
        alert('삭제가 완료되었습니다.');
        location.href = \"/\";
        </script>";
?>
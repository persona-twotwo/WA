<?php
    require('TOP.php');
    require ('db_connect.php');
    $db = db_connect('db_board');

    echo "Maria DB 연결 테스트<br>";
    if($db){
        echo "connect: success<br>";
    }else{
        echo "connect: failure<br>";
    }
    $result = mysqli_query($db,'SELECT VERSION() as VERSION');
    $data = mysqli_fetch_assoc($result);
    echo $data['VERSION'];
    

?>
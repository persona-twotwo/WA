<?php
    
    require('TOP.php');
    require "db_connect.php";
    $db = db_connect('db_board');
    $number =   $_GET['number'];
    $query = "SELECT EXISTS (select * from good where post_number = $number and user_number = $s_idx)";
    $result = mysqli_fetch_array(mysqli_query($db,$query))[0];
    if($result){
        $query = "DELETE FROM good WHERE post_number = $number and user_number = $s_idx ";
        $result = mysqli_query($db,$query);
        $query = "SELECT good FROM board WHERE number = $number";
        $count_good = mysqli_fetch_array(mysqli_query($db,$query))[0]-1;
        $query = "UPDATE board SET good = $count_good WHERE number = $number";
        $result = mysqli_query($db,$query);
    }
    else{
        $query = "INSERT INTO good (post_number, user_number) values($number, $s_idx)";
        $result = mysqli_query($db,$query);
        $query = "SELECT good FROM board WHERE number = $number";
        $count_good = mysqli_fetch_array(mysqli_query($db,$query))[0]+1;
        $query = "UPDATE board SET good = $count_good WHERE number = $number";
        $result = mysqli_query($db,$query);
    }
    echo "<script>
            location.href='/post_read.php?number=$number';</script>";
    
?>
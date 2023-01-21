<?php
require('TOP.php');
require "db_connect.php";
$db = db_connect('db_board');
$number =   $_GET['number'];
$content =   $_POST['content'];
$query = "INSERT INTO comment (writer_idx, board_number,content) values('$s_idx' ,'$number' , '$content')";
$result = mysqli_query($db,$query);
echo "<script>
        alert('댓글 작성이 완료되었습니다.');
        location.href='/post_read.php?number=$number';</script>";
?>
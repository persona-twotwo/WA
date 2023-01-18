<?php
    session_start();
    $s_id = isset($_SESSION["s_id"])? $_SESSION["s_id"]:"";
    $s_name = isset($_SESSION["s_name"])? $_SESSION["s_name"]:"";
    echo "$s_id  ,  $s_name <br>"
?>


<!DOCTYPE html>
<meta charset="UTF-8">
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" style="background-color:#F6F6F6">
    <link href="TOP.css" rel="stylesheet" type="text/css">
    <div class="menu">
        <nav class="clearfix">
            <ul class="clearfix">
                <li><a href="/">자유게시판</a></li>
                <li><a href="notice.php">공지사항</a></li>
                <li><a href="qna.php">Q&A</a></li>
                <li><a href="mariadb_test.php">About</a></li>
                <?php if (!$s_id){ ?>
                <li><a href="login.php">login</a></li>
                <li><a href="register.php">register</a></li>
                <?php } else{ ?>
                <li><a href="logout.php">logout</a></li>
                <li><a href="my_stat.php">status</a></li>
                <?php } ?>
                <li><a href="">Contact</a></li>
                <li><a href="info.php">info.php</a></li>
            </ul>
            <a id="pull" href="#"></a>
        </nav>
    </div>
</body>
<!-- <br/>
<br/> -->
<br/>
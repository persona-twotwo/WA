<?php
    session_start();
    $s_idx = isset($_SESSION["s_idx"])? $_SESSION["s_idx"]:"";
    $s_id = isset($_SESSION["s_id"])? $_SESSION["s_id"]:"";
    $s_name = isset($_SESSION["s_name"])? $_SESSION["s_name"]:"";
    $s_permit = isset($_SESSION["s_permit"])?$_SESSION["s_permit"]:0;
    $s_perm ="";
    switch ($s_permit){
        case 0 : 
            echo "$s_permit";
            $s_perm ="비회원";
            break;
        case 1 : 
            echo "test";
            $s_perm ="이메일 인증 필요";
            break;
        case 2 : 
            $s_perm ="정회원";
            break;
        case 3 : 
            $s_perm ="관리진";
            break;
        case 4 : 
            $s_perm ="총괄";
            break;
        }
    echo "$s_idx  ,  $s_name , $s_permit ,$s_perm<br>";
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
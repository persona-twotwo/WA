<!doctype html>
<?php 
    require('TOP.php');
    require('db_connect.php');
    $db = db_connect('db_board');
    
    $number = $_POST['number'];
    $content = $_POST['content'];
    $repler_idx = $_POST['repler_idx'];
    $reply_number = $_POST['reply_number'];
    if(($s_idx != $repler_idx)){
    echo "<script>
        alert('댓글 작성자만 댓글을 수정할 수 있습니다.');
        //history.back();
        </script>";
        exit;
    }

?>

<head>
    <meta charset="UTF-8">
    <title>댓글 수정</title>
    <link rel="stylesheet" type="text/css" href="write.css" />
</head>

<body>
    <div id="board_write">
        <h1><a>자유게시판</a></h1>
        <h2><a>댓글 수정</a></h2>
        <div id="write_area">
            <form action="reply_edit_ok.php?reply_number=<?php echo $reply_number ?>" method="post">
                <div class="wi_line"></div>
                <input type="hidden" name="number" value="<?php echo $number; ?>" />
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용" required><?php echo "$content"; ?></textarea>
                </div>
                <div class="bt_se">
                    <button type="submit">글 수정</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
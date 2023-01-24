<!doctype html>
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
        alert('작성자만 글을 수정할 수 있습니다.');
        history.back();
        </script>";
        exit;
    }
    $number = $result['number'];
    $title = $result['title'];
    $content = $result['content'];

?>

<head>
    <meta charset="UTF-8">
    <title>글 수정</title>
    <link rel="stylesheet" type="text/css" href="write.css" />
</head>

<body>
    <div id="board_write">
        <h1><a>자유게시판</a></h1>
        <h2><a>글 수정</a></h2>
        <div id="write_area">
            <form action="post_edit_ok.php?number=<?php echo $number ?>" method="post">
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" maxlength="100" required><?php echo "$title"; ?></textarea>
                </div>
                <div class="wi_line"></div>
                
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
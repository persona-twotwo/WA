<!doctype html>
<?php 
    require('TOP.php');
    require('db_connect.php');
?>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="write.css" />
</head>

<body>
    <div id="board_write">
        <h1><a>자유게시판</a></h1>
        <div id="write_area">
            <form action="post_write_ok.php" method="post" enctype="multipart/form-data">
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100"
                        required></textarea>
                </div>
                <div class="wi_line"></div>
                
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
                </div>
                <div id="in_file">
                    <input type="file" value="1" name="b_file" />
                </div>
                <div class="bt_se">
                    <button type="submit">글 작성</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
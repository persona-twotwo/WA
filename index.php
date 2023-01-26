<?php
require('TOP.php');

require('db_connect.php');
$db = db_connect('db_board');
?>

<!doctype html>

<head>
  <meta charset="UTF-8">
  <title>게시판</title>
  <link rel="stylesheet" type="text/css" href="style.css?112341" />
</head>

<body>
  <div id="board_area">
    <h1>자유게시판</h1>
    <h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4>
    <?php if($s_permit > 0){ ?>
      <div id="write_btn">
        <a href="post_write.php"><button>글쓰기</button></a>
      </div>
    <?php } ?>
    <table class="list-table">
      <thead>
        <tr>
          <th class="number">번호</th>
          <th class="title">제목</th>
          <th class="writer">글쓴이</th>
          <th class="date">작성일</th>
          <!-- 추천수 항목 추가 -->
          <th class="good">추천수</th>
          <th class="hit">조회수</th>
        </tr>
      </thead>
      <?php
      $db = db_connect('db_board');
      $query = "SELECT number, title, writer_idx, hit, date, good FROM board order by number DESC";
      $result = mysqli_query($db, $query);
      while ($board = mysqli_fetch_assoc($result)) {
      
        $title = $board["title"];
        ?>
        <tbody>
          <tr>
            <td class="number"><?php echo $board['number']; ?></td>
            <td class="title"><a href="post_read.php?number=<?php echo $board['number'];?>"><?php echo $title; ?></a></td>
            <td class="writer"><?php
            $writer_idx = $board['writer_idx'];
            $nickname = mysqli_fetch_array(mysqli_query($db, "SELECT nick FROM member WHERE number = '$writer_idx'"))[0];
            echo $nickname;
            ?></td>
            <td class="date"><?php echo $board['date'] ?></td>
            <td class="good"><?php echo $board['good'];?></td>
            <td class="hit"><?php echo $board['hit']; ?></td>
          </tr>
        </tbody>
      <?php } ?>
    </table>
    
  </div>
</body>

</html>
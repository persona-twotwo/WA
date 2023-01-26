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
    <h1>공지사항</h1>
    <h4>관리자만 작성 가능한 공지사항 게시판입니다.</h4>
    <?php if($s_permit > 2){ ?>
      <div id="write_btn">
        <a href="notice_write.php"><button>글쓰기</button></a>
      </div>
    <?php } ?>
    <table class="list-table">
      <thead>
        <tr>
          <th class="title">제목</th>
          <th class="writer">글쓴이</th>
          <th class="date">작성일</th>
          <!-- 추천수 항목 추가 -->
          <th class="hit">조회수</th>
        </tr>
      </thead>
      <?php
      $db = db_connect('db_board');
      $query = "SELECT number, title,writer_idx,hit,date FROM notice order by number DESC";
      $result = mysqli_query($db, $query);
      while ($board = mysqli_fetch_assoc($result)) {
      
        $title = $board["title"];
        ?>
        <tbody>
          <tr>
            <td class="title"><a href="notice_read.php?number=<?php echo $board['number'];?>"><?php echo $title; ?></a></td>
            <td class="writer"><?php
            $writer_idx = $board['writer_idx'];
            $nickname = mysqli_fetch_array(mysqli_query($db, "SELECT nick FROM member WHERE number = '$writer_idx'"))[0];
            echo $nickname;
            ?></td>
            <td class="date"><?php echo $board['date'] ?></td>
            <td class="hit"><?php echo $board['hit']; ?></td>
          </tr>
        </tbody>
      <?php } ?>
    </table>
    
  </div>
</body>

</html>
<?php
require('TOP.php');


require('db_connect.php');
$db = db_connect('db_board');



$query = "SELECT number, title, content FROM board";
$result = mysqli_query($db, $query);
// mysqli_free_result($result);

?>

<!doctype html>

<head>
  <meta charset="UTF-8">
  <title>게시판</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <div id="board_area">
    <h1>자유게시판</h1>
    <h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4>
    <table class="list-table">
      <thead>
        <tr>
          <th width="70">번호</th>
          <th width="500">제목</th>
          <th width="120">글쓴이</th>
          <th width="100">작성일</th>
          <!-- 추천수 항목 추가 -->
          <th width="100">추천수</th>
          <th width="100">조회수</th>
        </tr>
      </thead>
      <?php
      // board테이블에서 idx를 기준으로 내림차순해서 10개까지 표시
      $db = db_connect('db_board');
      $query = "SELECT number, title, content,id,hit,date FROM board";
      $result = mysqli_query($db, $query);
      while ($board = mysqli_fetch_assoc($result)) {
      
        //title변수에 DB에서 가져온 title을 선택
        $title = $board["title"];
        // if(strlen($title)>30)
        // { 
        //   //title이 30을 넘어서면 ...표시
        //   $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
        // }
        ?>
        <tbody>
          <tr>
            <td width="70"><?php echo $board['number']; ?></td>
            <td width="500"><a href="read.php?number=<?php echo $board['number'];?>">
                <?php echo $title; ?>
              </a></td>
            <td width="120"><?php echo $board['id'] ?></td>
            <td width="100">
              <?php echo $board['date'] ?>
            </td>
            <td width="100"><?php echo $board['good']; ?></td>
            <td width="100"><?php echo $board['hit']; ?></td>
          </tr>
        </tbody>
      <?php } ?>
    </table>
    <div id="write_btn">
      <a href="write.php"><button>글쓰기</button></a>
    </div>
  </div>
</body>

</html>
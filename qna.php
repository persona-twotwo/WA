<?php
require('TOP.php');

require('db_connect.php');
$db = db_connect('db_board');
?>

<!doctype html>

<head>
  <meta charset="UTF-8">
  <title>게시판</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <div id="board_area">
    <h1>Q&A</h1>
    <h4>질문과 답변글 형식으로 질문하는 곳 입니다.</h4>
    <?php if($s_permit > 1){ ?>
      <div id="write_btn">
        <a href="qna_write.php"><button>글쓰기</button></a>
      </div>
    <?php } ?>
    <table class="list-table">
      <thead>
        <tr>
          <th class="title">제목</th>
          <th class="writer">글쓴이</th>
          <th class="date">작성일</th>
          <th class="hit">조회수</th>
          <th class="answer">답변</th>
        </tr>
      </thead>
      <?php
      $db = db_connect('db_board');
      $query = "SELECT number, title,writer_idx,hit,date,answer,secret FROM qna order by number DESC";
    
      $result = mysqli_query($db, $query);
      while ($board = mysqli_fetch_assoc($result)) {
	      if(($board['secret']==0) || ($s_idx == $board['writer_idx']) ||($s_permit > 2) ) {
          
          $title = $board["title"];
          if($board['secret']){
            $title = "🔒".$title;
          }
        ?>
        <tbody>
          <tr>
            <td class="title"><a href="qna_read.php?number=<?php echo $board['number'];?>"><?php echo $title; ?></a></td>
            <td class="writer"><?php
            $writer_idx = $board['writer_idx'];
            $nickname = mysqli_fetch_array(mysqli_query($db, "SELECT nick FROM member WHERE number = '$writer_idx'"))[0];
            echo $nickname;
            ?></td>
            <td class="date"><?php echo $board['date'] ?></td>
            <td class="hit"><?php echo $board['hit']; ?></td>
            <td class="answer"><?php 
            if($board['answer']){
              echo "O";
            }
            else{
              echo "X";
            }
            ?></td>
          </tr>
        </tbody>
      <?php }} ?>
    </table>
    
  </div>
</body>

</html>
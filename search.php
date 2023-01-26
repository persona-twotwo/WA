<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");

require('TOP.php');

require('db_connect.php');
$db = db_connect('db_board');
$category = isset($_GET['$category'])?$_GET['$category']:0;
$search = isset($_GET['search'])?$_GET['search']:0;

switch ($_GET['search']) {
    case 0:
        $search = "title";
        break;
    case 1:
        $search = "content";
        break;
    case 2:
        $search = "nick";
    
        break;
}

$word = isset($_GET['word'])?$_GET['word']:"";
echo "<script>
function chk_form() {
    document.getElementById('category_search').submit()
}
</script>";
?>


<!doctype html>

<head>
  <meta charset="UTF-8">
  <title>게시판</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
  <div id="board_area">
    <h1>검색</h1>
    <h4>게시판 종류와 검색 기준을 선택해 검색할 수 있습니다.</h4>
    <div id="order">
      <form id=category_search class="button" action="search_ok.php" method="post">
        <select name='category'>
          <option value=0>전체 게시판</option>
          <option value=1>자유 게시판</option>
          <option value=2>공지 게시판</option>
          <option value=3>Q&A 게시판</option>
        </select>
        <select name='search'>
          <option value=0>제목</option>
          <option value=1>내용</option>
          <option value=2>작성자</option>
        </select>
        <input type="text" name="search_word" id="search_word" value="">
        <a href=# onclick="chk_form()">[검색]</a>
      </form>
    </div>
    <table class="list-table">
      <thead>
        <tr>
          <th class="number">게시판</th>
          <th class="title">제목</th>
          <th class="writer">글쓴이</th>
          <th class="date">작성일</th>
          <!-- 추천수 항목 추가 -->
          <th class="hit">조회수</th>
        </tr>
      </thead>
      <?php
      $db = db_connect('db_board');
        $querys = array();
        if($_GET['search']==2){
            $result = mysqli_query($db,"SELECT nick, number  FROM member WHERE nick LIKE '%".$word."%'");
            while($writer_idx = mysqli_fetch_assoc($result)['number']){
                switch($category){
                    case 1:
                        array_push($querys,"SELECT 0 as category ,title ,content, number, date, writer_idx, hit FROM board WHERE writer_idx = $writer_idx");
                        break;
                    case 2:
                        array_push($querys,"SELECT 1 as category ,title ,content, number, date, writer_idx, hit FROM notice WHERE writer_idx = $writer_idx");
                        break;
                    case 3:
                        array_push($querys,"SELECT 2 as category ,title ,content, number, date, writer_idx, hit FROM qna WHERE secret = 0 and writer_idx = $writer_idx");
                        break;
                    case 0:
                        array_push($querys,"SELECT 0 as category ,title ,content, number, date, writer_idx, hit FROM board WHERE writer_idx = $writer_idx");
                        array_push($querys,"SELECT 1 as category ,title ,content, number, date, writer_idx, hit FROM notice WHERE writer_idx = $writer_idx");
                        array_push($querys,"SELECT 2 as category ,title ,content, number, date, writer_idx, hit FROM qna WHERE secret = 0 and writer_idx = $writer_idx");
                        break;
                }
            }
        }
        else{
            switch($category){
                case 1:
                    array_push($querys,"SELECT 0 as category ,title ,content, number, date, writer_idx, hit FROM board WHERE $search LIKE '%$word%'");
                    break;
                case 2:
                    array_push($querys,"SELECT 1 as category ,title ,content, number, date, writer_idx, hit FROM notice WHERE $search LIKE '%$word%'");
                    break;
                case 3:
                    array_push($querys,"SELECT 2 as category ,title ,content, number, date, writer_idx, hit FROM qna WHERE secret=0 and $search LIKE '%$word%'");
                    break;
                case 0:
                    array_push($querys,"SELECT 0 as category ,title ,content, number, date, writer_idx, hit FROM board WHERE $search LIKE '%$word%'");
                    array_push($querys,"SELECT 1 as category ,title ,content, number, date, writer_idx, hit FROM notice WHERE $search LIKE '%$word%'");
                    array_push($querys,"SELECT 2 as category ,title ,content, number, date, writer_idx, hit FROM qna WHERE secret=0 and $search LIKE '%$word%'");
                    break;
            }

        }



        $query = implode(" UNION ", $querys);
        $query .= " ORDER BY date DESC";
        $result = mysqli_query($db, $query);
      while ($board = mysqli_fetch_assoc($result)) {
      
        $title = $board["title"];
        ?>
        <tbody>
            <tr>
            <td class="category"><?php 
            switch($board['category']){
                case 0:
                    $category_read = "post_read.php";
                    echo "자유게시판";
                    break;
                case 1:
                    $category_read = "notice_read.php";
                    echo "공지";
                    break;
                case 2:
                    $category_read = "qna_read.php";
                    echo "Q&A";
                    break;
            }
            
            ?></td>
            <td class="title"><a href="<?php echo $category_read."?number=".$board['number'];?>"><?php echo $title; ?></a></td>
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
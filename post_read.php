<?php
    require('TOP.php');
	require "db_connect.php";
    $db = db_connect("db_board");
    $number = $_GET['number'];
    $result = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM board WHERE number =$number"));
    $hit = $result['hit'] + 1;
    mysqli_query($db,"UPDATE board SET hit = '$hit' WHERE number = '$number'");
?>


<!doctype html>
<head>
<meta charset="UTF-8">
<!-- <title>게시판</title> -->
<title><?php echo $result['title'];?></title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	
    
    <!-- 글 표시 -->
<div id="board_read">
	<h2><?php echo $result['title']; ?></h2>
		<div id="user_info">
			<?php echo $result['id']; ?> <?php echo $result['date']; ?> 조회:<?php echo $hit; ?>
				<div id="bo_line"></div>
			</div>
			<div id="bo_content">
				<?php echo nl2br("$result[content]"); ?>
			</div>
	<!-- 목록, 수정, 삭제 -->
	<div id="bo_ser">
		<ul>
			<li><a href="post_good.php?number=<?php echo $result['number']; ?>">[추천 : <?php echo $result['good'] ?>]</a></li>
			<li><a href="/">[목록으로]</a></li>
			<li><a href="post_edit.php?number=<?php echo $result['number']; ?>">[수정]</a></li>
			<li><a href="post_del.php?number=<?php echo $result['number']; ?>">[삭제]</a></li>
		</ul>
	</div>
</div>
</body>
</html>
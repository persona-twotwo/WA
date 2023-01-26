<?php
    require('TOP.php');
	require "db_connect.php";
    $db = db_connect("db_board");
    $number = $_GET['number'];
	
	
	mysqli_query($db,"DELETE from hit where NOW() > expire_date");
	$result = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM notice WHERE number =$number"));
	$query = "SELECT EXISTS (select * from hit where post_number = $number and user_number = $s_idx and category = 2)";
	$hit = $result['hit'];
	if(!empty($s_idx)){
		if((mysqli_fetch_array(mysqli_query($db,$query))[0]==0)){
			$hit = $hit + 1;
			mysqli_query($db,"UPDATE notice SET hit = '$hit' WHERE number = '$number'");
			mysqli_query($db,"INSERT INTO hit (category, post_number, user_number) values(2,$number, $s_idx)");
		}

	}
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
			<?php
			$writer_idx = $result['writer_idx'];
            $nickname = mysqli_fetch_array(mysqli_query($db, "SELECT nick FROM member WHERE number = '$writer_idx'"))[0];
            echo $nickname; ?> <?php echo $result['date']; ?> 조회:<?php echo $hit; ?>
				<div id="bo_line"></div>
			</div>
			<div id="file_download">
				<?php 
    				if($result['file']!=''){ 
						$file_dir = "upload/notice/".$result['number']."/".$result['file'];
						?>

				파일 : <a href="<?php echo $file_dir ?>" download> <?php echo $result['file']?> </a>
				<?php  } ?>
			</div>
			<div id="bo_content">
				<?php echo nl2br("$result[content]"); ?>
			</div>
	<!-- 목록, 수정, 삭제 -->
	<div id="bo_ser">
		<ul>
			<li><a href="/notice.php">[목록으로]</a></li>
			<?php if($s_idx == $writer_idx){ ?>
				<li><a href="notice_edit.php?number=<?php echo $result['number']; ?>">[수정]</a></li>
			<?php } ?>
			<?php
			if(($s_permit >2) || ($s_idx == $writer_idx)){ ?>
			<li><a href="notice_del.php?number=<?php echo $result['number']; ?>">[삭제]</a></li>
			<?php }?>
		</ul>
	</div>
</div>



</body>
</html>
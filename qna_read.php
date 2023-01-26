<?php
    require('TOP.php');
	require "db_connect.php";
    $db = db_connect("db_board");
    $number = $_GET['number'];
	
	if($s_permit < 2) { 
		echo "<script>
        alert('로그인 한 후 접속 가능합니다.');
		location.href='/';</script>";
	}
	
	mysqli_query($db,"DELETE from hit where NOW() > expire_date");
	$result = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM qna WHERE number =$number"));
	$query = "SELECT EXISTS (select * from hit where post_number = $number and user_number = $s_idx)";
	$hit = $result['hit'];
	if(mysqli_fetch_array(mysqli_query($db,$query))[0]==0){
		$hit = $hit + 1;
		mysqli_query($db,"UPDATE qna SET hit = '$hit' WHERE number = '$number'");
		mysqli_query($db,"INSERT INTO hit (category, post_number, user_number) values(3,$number, $s_idx)");
		
	}

	if(($result['secret']==1) && (($s_idx != $result['writer_idx']) && ($s_permit <3)) ) { 
		echo "<script>
		alert('관리자만 접근 가능한 글 입니다.');
		location.href='/qna.php';</script>";
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
						$file_dir = "upload/qna/".$result['number']."/".$result['file'];
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
			<li><a href="/">[목록으로]</a></li>
			<?php if($s_idx == $writer_idx){ ?>
				<li><a href="qna_edit.php?number=<?php echo $result['number']; ?>">[수정]</a></li>
			<?php } ?>
			<?php
			if(($s_permit >2) || ($s_idx == $writer_idx)){ ?>
			<li><a href="qna_del.php?number=<?php echo $result['number']; ?>">[삭제]</a></li>
			<?php }
			if(($s_permit >2)&& ($result['answer']==0)){ 
			
				?>
			<li><a href="answer_write.php?number=<?php echo $result['number']; ?>">[답변작성]</a></li>
			<?php }?>
		</ul>
	</div>
</div>

<!--- 답글 불러오기 -->
<div class="reply_view">
<h3>답변</h3>
	 <!-- 글 표시 -->
<?php
if($result['answer']==0){
	echo "<h4>아직 답변이 없습니다</h4>";
}
else{
?>


<div id="board_read">
	<h2><?php echo $result['answer_title']; ?></h2>
		<div id="user_info"><?php echo $result['answer_date']; ?>
				<div id="bo_line"></div>
			</div>
			<div id="file_download">
				<?php 
    				if($result['file']!=''){ 
						$file_dir = "upload/qna/".$result['number']."/answer/".$result['answer_file'];
						?>

				파일 : <a href="<?php echo $file_dir ?>" download> <?php echo $result['answer_file']?> </a>
				<?php  } ?>
			</div>
			<div id="bo_content">
				<?php echo nl2br("$result[answer_content]"); ?>
			</div>
	<!-- 목록, 수정, 삭제 -->
	<div id="bo_ser">
		<ul>
			<?php
			if(($s_permit >2)){ ?>
			<li><a href="answer_edit.php?number=<?php echo $result['number']; ?>">[답변수정]</a></li>
			<li><a href="answer_del.php?number=<?php echo $result['number']; ?>">[답변삭제]</a></li>
			<?php }?>
		</ul>
	</div>
</div>
</div><!--- 댓글 불러오기 끝 -->
<?php } ?>
</body>
</html>
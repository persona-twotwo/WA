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
	$result = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM board WHERE number =$number"));
	$query = "SELECT EXISTS (select * from hit where post_number = $number and user_number = $s_idx)";
	$hit = $result['hit'];
	if(mysqli_fetch_array(mysqli_query($db,$query))[0]==0){
		$hit = $hit + 1;
		mysqli_query($db,"UPDATE board SET hit = '$hit' WHERE number = '$number'");
		mysqli_query($db,"INSERT INTO hit (category, post_number, user_number) values(1,$number, $s_idx)");

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
						$file_dir = "upload/default/".$result['number']."/".$result['file'];
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
			<li><a href="post_good.php?number=<?php echo $result['number']; ?>">[추천 : <?php 
			echo $result['good'];
			$query = "SELECT EXISTS (select * from good where post_number = $number and user_number = $s_idx)";
			if(mysqli_fetch_row(mysqli_query($db,$query))[0]){
				echo "❤️";
			}
			?>
			]</a></li>
			<li><a href="/">[목록으로]</a></li>
			<?php if($s_idx == $writer_idx){ ?>
				<li><a href="post_edit.php?number=<?php echo $result['number']; ?>">[수정]</a></li>
			<?php } ?>
			<?php
			if(($s_permit >2) || ($s_idx == $writer_idx)){ ?>
			<li><a href="post_del.php?number=<?php echo $result['number']; ?>">[삭제]</a></li>
			<?php }?>
		</ul>
	</div>
</div>

<!--- 댓글 불러오기 -->
<div class="reply_view">
	<h3>댓글목록</h3>
		<?php
			$query = "SELECT * FROM comment WHERE board_number='$number' order by number desc";
			$result = (mysqli_query($db,$query));
			while($reply= mysqli_fetch_assoc($result)){
				if($reply['del']==1){ 
					echo "<div class='dap_lo'>😢삭제된 댓글입니다.</div>";
					continue; 
					} ?>

		<div class="dap_lo">
			<div><b><?php 
			$repler_idx = $reply['writer_idx'];
            $nickname = mysqli_fetch_array(mysqli_query($db, "SELECT nick FROM member WHERE number = '$repler_idx'"))[0];
            echo $nickname;?></b></div>
			<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
			<div class="rep_me dap_to"><?php echo $reply['date']; ?></div>
			<div class="rep_me rep_menu">
				<div class="two_button"	>
					<?php if($s_idx ==  $repler_idx){ ?>
					<form  class="button" action="reply_edit.php" method="post">
						<input type="hidden" name="number" value="<?php echo $number; ?>" />
						<input type="hidden" name="content" value="<?php echo $reply['content']; ?>" />
						<input type="hidden" name="repler_idx" value="<?php echo $repler_idx; ?>" />
						<input type="hidden" name="reply_number" value="<?php echo $reply['number']; ?>" />
						<button type="submit">수정</button>
					</form>
					<!-- 댓글 삭제 -->
					<?php } if(($s_permit >2) || ($s_idx == $writer_idx)||($s_idx ==  $repler_idx)){ ?>
					<form class="button"action="reply_delete.php" method="post">
						<input type="hidden" name="repler_idx" value="<?php echo $reply['repler_idx']; ?>" />
						<input type="hidden" name="reply_number" value="<?php echo $reply['number']; ?>" />
						<button type="submit">삭제</button>
					</form>
					<?php } ?>
				</div>
				<!--  -->
			</div>
			<!-- 댓글 수정 폼 dialog -->
			<div class="dat_edit">
				<form method="post" action="reply_edit.php">
					<input type="hidden" name="reply_number" value="<?php echo $reply['number']; ?>" />
					<input type="hidden" name="board_number" value="<?php echo $number; ?>">
					<textarea name="content" class="dap_edit_t"><?php echo $reply['content']; ?></textarea>
					<input type="submit" value="수정하기" class="re_mo_bt">
				</form>
			</div>
			<!-- 댓글 삭제 비밀번호 확인 -->
			<div class='dat_delete'>
				
			</div>
		</div>
	<?php } ?>

	<!--- 댓글 입력 폼 -->
	<?php if ($s_permit >1) { ?>
	<div class="dap_ins">
		<form action="reply_ok.php?number=<?php echo $number; ?>" method="post">
			<div style="margin-top:10px; ">
				<textarea name="content" class="reply_content" id="re_content" ></textarea>
				<button id="rep_bt" class="re_bt">댓글</button>
			</div>
		</form>
	</div>
	<?php } ?>
</div><!--- 댓글 불러오기 끝 -->

</body>
</html>
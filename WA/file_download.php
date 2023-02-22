
<?php
  require('db_connect.php');
  $db = db_connect("db_board");


$cookieParams = session_get_cookie_params();
session_set_cookie_params(
    600, 
    $cookieParams["/"],
    $cookieParams["wa.prox.persona-twotwo.com"],
    true,  // make cookie HTTPS-only
    true   // make cookie HTTP-only
);

// Start the session
session_start();
$s_idx = isset($_SESSION["s_idx"])? $_SESSION["s_idx"]:"";
$s_id = isset($_SESSION["s_id"])? $_SESSION["s_id"]:"";
$s_name = isset($_SESSION["s_name"])? $_SESSION["s_name"]:"";
$s_permit = isset($_SESSION["s_permit"])?$_SESSION["s_permit"]:0;
$number = $_POST['option2'];
if ($s_permit < 2){
  echo "<script>
  alert('정회원 이상만 파일을 다운로드 받을 수 있습니다.');
  location.href='/';</script>";
  exit();
}
if($_POST['option1']=='2' || $_POST['option1']=='3' ){

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
		';</script>";
    exit();
	}
}
echo "test";

switch ($_POST['option1']) {
  case '0':
      $result = mysqli_fetch_array(mysqli_query($db,"SELECT file FROM board WHERE number =$number"))[0];
      $filename = "../upload/default/".$_POST['option2']."/".$result;
      break;
  case '1':
echo "test";
$result = mysqli_fetch_array(mysqli_query($db,"SELECT file FROM notice WHERE number =$number"))[0];
echo "test";
$filename = "../upload/notice/".$_POST['option2']."/".$result;
      break;
  case '2':
      $result = mysqli_fetch_array(mysqli_query($db,"SELECT file FROM qna WHERE number =$number"))[0];
      $filename = "../upload/qna/".$_POST['option2']."/".$result;
      break;
  case '3':
      $result = mysqli_fetch_array(mysqli_query($db,"SELECT answer_file FROM qna WHERE number =$number"))[0];
      $filename = "../upload/qna/".$_POST['option2']."/answer/".$result;
    break;
}
echo "test";

if (!file_exists($filename)) {
  die("파일이 존재하지 않습니다.");
}
echo "test";

// 다운로드를 위한 헤더 설정
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($filename));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filename));

// 출력 버퍼를 비우고 파일을 읽어 출력
ob_clean();
flush();
readfile($filename);
exit;



    ?>

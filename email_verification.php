<?php 
    require ('db_connect.php');

    require ('PHPMailer/src/Exception.php');
    require ('PHPMailer/src/PHPMailer.php');
    require ('PHPMailer/src/SMTP.php');
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    $s_idx = $_POST['s_idx'];
    $u_id = $_POST['u_id'];
    $u_nick = $_POST['u_nick'];
    $u_mail = $_POST['u_mail'];
    $code = substr(md5(microtime(true)),0,10);
    $db = db_connect('db_board');
    // echo $u_mail;

    $mail = new PHPMailer(true);
    // 디버그 모드(production 환경에서는 주석 처리한다.)
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    // SMTP 서버 세팅
    $mail->isSMTP();
    try {
        // 구글 smtp 설정
        $mail->Host = "smtp.gmail.com";
        // SMTP 암호화 여부
        $mail->SMTPAuth = true;
        // SMTP 포트
        $mail->Port = 465;
        // SMTP 보안 프초트콜
        $mail->SMTPSecure = "ssl";
        // gmail 유저 아이디
        $mail->Username = "koreaplayer99@gmail.com";
        // gmail 패스워드
        $mail->Password = google_password();
        // 인코딩 셋
        $mail->CharSet = 'utf-8'; 
        $mail->Encoding = "base64";
        
        // 보내는 사람
        $mail->setFrom('koreaplayer99@gmail.com', 'persona-twotwo 이메일 인증 시스템');
        // 받는 사람
        $mail->AddAddress("$u_mail", "$u_nick($u_id)"); 
        
        // 본문 html 타입 설정
        $mail->isHTML(true);
        // 제목
        $mail->Subject = $u_nick.'님의 인증메일';
        // 본문 (HTML 전용)
        $mail->Body    = '다음 링크를 눌러 이메일 인증을 완료하세요 <br>wa.prox.persona-twotwo.com/email_verification_ok.php?number='.$code.'<br>';
        // 본문 (non-HTML 전용)
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->Send();

    	mysqli_query($db,"DELETE from verification where NOW() > expire_date");
        $query = "SELECT EXISTS (select * from verification where user_number = $s_idx)";
        if(mysqli_fetch_array(mysqli_query($db,$query))[0] != 0){
        	mysqli_query($db,"DELETE from verification where user_number = $s_idx");
        }

        $query = "INSERT INTO verification (user_number, code) values($s_idx,'$code')";
        mysqli_query($db,$query);
        echo "<script>
        alert('10분 내로 이메일 속 링크를 눌러 인증하신 후 로그인 하세요');
        location.href='/logout.php';</script>";
        exit;
        
    }catch (Exception $e) {
        echo "<script>
        alert('오류가 발생하였습니다. 관리자에게 문의하세요.');
        location.href='/';</script>";
    }
?>
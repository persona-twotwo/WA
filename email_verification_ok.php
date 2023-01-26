<?php 
    require ('db_connect.php');

    $db = db_connect('db_board');
    $code = $_GET['number'];
    mysqli_query($db,"DELETE from verification where NOW() > expire_date");

    $query = "SELECT EXISTS (SELECT * from verification where  code ='$code')";
    if(mysqli_fetch_array(mysqli_query($db,$query))[0] != 0){
        $result = mysqli_fetch_assoc(mysqli_query($db,"SELECT * from verification where  code ='$code'"));
        $user_number = $result['user_number'];
        mysqli_query($db,"DELETE from verification where code ='$code'");

        $b_permit = mysqli_fetch_row(mysqli_query($db,"SELECT permit FROM member WHERE number = $user_number"))[0];
        if($b_permit<2){
            mysqli_query($db,"UPDATE member SET permit = 2 WHERE number = $user_number");
            echo "<script>
                alert('이메일 인증이 완료되었습니다. 로그인 후 이용해 주세요.');
                location.href = '/login.php';
                </script>";
            exit;
        }
        echo "<script>
            alert('이미 인증이 완료된 계정입니다.');
            location.href = '/';
            </script>";
        exit;
        
    }
    echo "<script>
        alert('인증 주소가 잘못되었습니다. 이메일 인증을 다시 시도하세요.');
        location.href = '/';
        </script>";
    exit;

   
?>
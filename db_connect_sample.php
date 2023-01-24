<!-- $db_hostname $db_username $db_password 를 올바르게 고친 후 파일 이름을 db_connect.php로 변경하세요 -->
<?php
function db_connect($db_database)
{
    header('Content-Type: text/html; charset=utf-8');
    // $db_hostname = 'localhost';
    // $db_hostname = '127.0.0.1';
    $db_hostname = '********'; //enter DB_IP
    $db_username = 'root';     //enter DB_ID
    $db_password = '********'; //enter DB_PW
    try {
        $db = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
      }
      catch(Exception $e) {
        echo 'Message: ' .$e->getMessage();
      }
    
    return $db;
}


?>
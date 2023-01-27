<?php
    require('TOP.php');
    require('db_connect.php');
    $db = db_connect('db_board');
    $number = $_GET['number'];
    $query = "SELECT title, number, content, writer_idx FROM board WHERE number = $number";
    $result = mysqli_fetch_array(mysqli_query($db, $query));
    $writer_idx =$result['writer_idx'];
    if(($s_idx != $writer_idx) && ($s_permit <3)){
        echo "<script>
        alert('작성자만 글을 삭제할 수 있습니다.');
        history.back();
        </script>";
        exit;
    }
    $query = "DELETE FROM board WHERE number = '$number'";
    mysqli_query($db, $query);
    $query = "DELETE FROM comment WHERE board_number = '$number'";
    mysqli_query($db, $query);
    $query = "DELETE FROM good WHERE post_number = '$number'";
    mysqli_query($db, $query);
    $del_dir = "upload/default/".$number;

    function rmdir_ok($dir) {
        $dirs = dir($dir);
        while(false !== ($entry = $dirs->read())) {
            if(($entry != '.') && ($entry != '..')) {
                if(is_dir($dir.'/'.$entry)) {
                      rmdir_ok($dir.'/'.$entry);
                } else {
                      @unlink($dir.'/'.$entry);
                }
            }
        }
        $dirs->close();
        @rmdir($dir);
    }
    if(is_dir($del_dir)){
        rmdir_ok($del_dir);
    }
    echo "<script>
        alert('삭제가 완료되었습니다.');
        location.href = '/';
        </script>";
?>
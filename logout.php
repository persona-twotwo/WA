<?php 
    session_start();

$_SESSION = array();

        echo "
            <script type=\"text/javascript\">
                location.href = \"/\";
            </script>
        ";
?>
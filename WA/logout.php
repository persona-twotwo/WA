<?php 
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
    session_unset();
    session_destroy();

        echo "
            <script type=\"text/javascript\">
                location.href = \"/\";
            </script>
        ";
?>
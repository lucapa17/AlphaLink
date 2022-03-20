<?php
    $_SESSION = array();
    session_destroy();
    setcookie(session_name(),'',time() - 42000, "/");
    
    header("Location: index.php");
?>
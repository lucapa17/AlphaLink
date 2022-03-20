<?php
    $con = new mysqli("localhost", "S4854973", "edinsonpocho722", "S4854973");
    if ($con->connect_errno) {
        header ("Refresh:2, url=index.php");
        error_log("Connection failed: " . $con->connect_error);
        exit("Qualcosa è andato storto, riprova");
    }
?>
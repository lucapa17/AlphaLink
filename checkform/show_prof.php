<?php
    if(!isset($_SESSION["login"])){
        header ("Location:login.php");
    }
    include 'database/database.php';
    $query="SELECT città, indirizzo, data_nascita, telefono FROM utenti WHERE id=? ";
    if(!($stmt=$con->prepare($query))){
        error_log("Prepare failed: (". $con->errno . ")" . $con->error);
        header ("Refresh:2, url=index.php");
        exit("Qualcosa è andato storto, riprova");
    }
    if(!$stmt->bind_param('i', $_SESSION["id"])){
        error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
        header ("Refresh:2, url=index.php");
        exit("Qualcosa è andato storto, riprova");
    }
    if(!$stmt->execute()){
        error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
        header ("Refresh:2, url=index.php");
        exit("Qualcosa è andato storto, riprova");
    }
    $res=$stmt->get_result();
    $row = $res->fetch_assoc();
?>    
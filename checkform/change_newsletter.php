<?php
    session_start();
    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
    }
    $newsletter = !($_SESSION['newsletter']);
    $id = $_SESSION['id'];

    include '../database/database.php';

    $query="UPDATE utenti SET newsletter=? WHERE id=?";
    if(!($stmt=$con->prepare($query))){
        error_log("Prepare failed: (". $con->errno . ")" . $con->error);
        header ("Refresh:2, url=../index.php");
        exit("Qualcosa è andato storto, riprova");
    }
    if(!$stmt->bind_param('ii', $newsletter, $id)){
        error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
        header ("Refresh:2, url=../index.php");
        exit("Qualcosa è andato storto, riprova");
    }
    if(!$stmt->execute()){
        error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
        header ("Refresh:2, url=../index.php");
        exit("Qualcosa è andato storto, riprova");
    }
    
    if($stmt->affected_rows===0){
        header ("Refresh:2, url=../index.php");
        exit("Qualcosa è andato storto, riprova");
    }
    $_SESSION['newsletter'] = $newsletter;
    if($newsletter == 1){
        $receiver = $_SESSION['email'];
        $title = "Benvenuto in AlphaLink";
        $body = "Ciao ".$_SESSION['firstname']." !\nGrazie per esserti iscritto/a alla nostra newsletter. \nVerrai informato per eventuali offerte e promozioni!";
        include '../mail/mail.php';
    }
    header("Location: ../show_profile.php");
?>
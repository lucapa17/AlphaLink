<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header ("Location: ../login.php");
    }
    
    include '../database/database.php';
    if (isset($_POST['id_ticket'])){
        $query = "DELETE FROM carrello WHERE id_carrello = ?";
        if(!($stmt=$con->prepare($query))){
            error_log("Prepare failed: (". $con->errno . ")" . $con->error);
            header ("Refresh:2, url=../index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        if(!$stmt->bind_param("i", $_POST['id_ticket'])){
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
            exit("eliminazione biglietto dal carrello fallita");
        }
        header("Location: ../cart.php");
    }
?>
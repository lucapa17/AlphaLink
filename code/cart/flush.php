<?php
    
    if(!isset($_SESSION["login"])){
        header ("Location:login.php");
    }
    
    $ok_delete = "";
    if (isset($_POST['delete'])){
        include 'database/database.php';
        $query = "DELETE FROM carrello WHERE id_utente = ?";
        if(!($stmt=$con->prepare($query))){
            error_log("Prepare failed: (". $con->errno . ")" . $con->error);
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        if(!$stmt->bind_param("i", $_SESSION["id"])){
            error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        if(!$stmt->execute()){
            error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        if($stmt->affected_rows===0){
            header ("Refresh:2, url=index.php");
            exit("svuotamento carrello fallito");
        }
        $ok_delete = "Tutti i biglietti nel carrello sono stati eliminati correttamente. Desideri
            comprare altri biglietti? <br> <a href='buy_ticket.php'><strong>Compra un nuovo biglietto</strong></a>";
    }

?>
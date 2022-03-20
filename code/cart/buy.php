<?php
    if(!isset($_SESSION["login"])){
        header ("Location:login.php");
    }
    $ok_buy = "";
    if (isset($_POST['buy'])) {
        include 'database/database.php';
        $query = "SELECT * FROM carrello WHERE id_utente=?";

        //inizio transazione
        $con->begin_transaction();

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
        $res = $stmt->get_result();
        while( $row = $res->fetch_assoc()){

            $query="INSERT INTO ordini (id_utente, prezzo, città_partenza, città_arrivo, codice, data, orario, passeggeri) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            if(!($stmt=$con->prepare($query))){
                error_log("Prepare failed: (". $con->errno . ")" . $con->error);
                $con->rollback();
                header ("Refresh:2, url=index.php");
                exit("Qualcosa è andato storto, riprova");
            }
            
            //creo stringa alfanumerica casuale di 8 caratteri per codice biglietto 
            $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $var_size = strlen($chars);
            $random_str = "";
            for( $x = 0; $x < 8; $x++ )
                $random_str = $random_str.$chars[ rand( 0, $var_size - 1 ) ];  
            
            if(!$stmt->bind_param("iisssssi", $_SESSION['id'], $row['prezzo'], $row['città_partenza'], $row['città_arrivo'], $random_str, $row['data'], $row['orario'], $row['passeggeri'])){
                error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
                $con->rollback();
                header ("Refresh:2, url=index.php");
                exit("Qualcosa è andato storto, riprova");
            }
            if(!$stmt->execute()){
                error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
                $con->rollback();
                header ("Refresh:2, url=index.php");
                exit("Qualcosa è andato storto, riprova");
            }
            if($stmt->affected_rows===0){
                $con->rollback();
                header ("Refresh:2, url=index.php");
                exit("Qualcosa è andato storto, riprova");
            }

            //invio biglietto via mail
            $receiver = $_SESSION['email'];
            $title = "Il tuo biglietto AlphaLink";
            $body = "Ciao ".$_SESSION['firstname']." !\nEcco tutti i dati del tuo biglietto per viaggiare con noi \n
                NOME: ".$_SESSION['firstname']."\n
                COGNOME: ".$_SESSION['lastname']."\n
                PARTENZA: ".$row['città_partenza']."\n
                DESTINAZIONE: ".$row['città_arrivo']."\n
                DATA: ".date("d-m-Y", strtotime($row['data']))."\n
                ORARIO: ".$row['orario']."\n
                PASSEGGERI: ".$row['passeggeri']."\n
                PREZZO: ".$row['prezzo']."€\n
                CODICE: ".$random_str;
            include 'mail/mail.php';
            
        }

        //rimuovo dal carrello i biglietti appena acquistati
        $query = "DELETE FROM carrello WHERE id_utente = ?";
        if(!($stmt=$con->prepare($query))){
            error_log("Prepare failed: (". $con->errno . ")" . $con->error);
            $con->rollback();
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        if(!$stmt->bind_param("i", $_SESSION["id"])){
            error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
            $con->rollback();
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        if(!$stmt->execute()){
            error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
            $con->rollback();
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        if($stmt->affected_rows===0){
            $con->rollback();
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        $con->commit();
        $ok_buy = "Acquisto avvenuto con successo <br> <a href='tickets.php'><strong>Vedi i tuoi biglietti</strong></a>";
    }


?>
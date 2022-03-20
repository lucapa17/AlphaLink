<?php
    if(!isset($_SESSION["login"])){
        header ("Location: login.php");
    }
    
    $error = "";
    $ok = "";

    if(isset($_POST['submit'])) {
        if(empty($_POST['voto'])){
            $error = "Non hai inserito nessun voto";
        }
        else if(empty($_POST['review'])){
            $error = "Non hai scritto nessun commento";
        }
        else {
            $vote = $_POST["voto"];
            $review = trim($_POST["review"]);
            $patternreview = "/^[a-zA-Z0-9èéàùòì:.,;*!'()?€ ]{1,256}$/";
            if(!preg_match($patternreview, $review)){
                $error = "Recensione deve essere al massimo di 256 caratteri e può contenere
                solo i seguenti caratteri speciali:  *!'()?€";
            }
            else {
                include 'database/database.php';
                $query="INSERT INTO valutazioni (id_utente, voto, commento, data_ora) VALUES(?, ?, ?, ?)";
                $DateTime = date('Y-m-d h:i:s ', time());
                if(!($stmt=$con->prepare($query))){
                    error_log("Prepare failed: (". $con->errno . ")" . $con->error);
                    header ("Refresh:2, url=index.php");
                    exit("Qualcosa è andato storto, riprova");
                }
                if(!$stmt->bind_param("iiss", $_SESSION["id"], $vote, $review, $DateTime)){
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
                    $error = "Spiacenti, si è verificato un errore, riprovare";
                }
                else{
                    $ok = "Recensione inviata correttamente. Vai al tuo <a href='show_profile.php'><strong>profilo</strong></a>";
                }
            }
        }
    }
?>
<?php 
        include 'database/database.php';
        $query = "SELECT firstname, commento, voto FROM valutazioni INNER JOIN utenti ON id=id_utente WHERE id_valutazione = ? OR id_valutazione = ? OR id_valutazione = ?";
        if(!($stmt=$con->prepare($query))){
            error_log("Prepare failed: (". $con->errno . ")" . $con->error);
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        //seleziono 3 valutazioni dal db di default per la pagina index
        $k1 = 85;
        $k2 = 86;
        $k3 = 87;

        if(!$stmt->bind_param('iii', $k1, $k2, $k3)){
			error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
		}

        if(!$stmt->execute()){
            error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
            header ("Refresh:2, url=index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        //mi salvo nome, commento e voto delle 3 valutazioni scelte
        $res=$stmt->get_result();

        $row = $res->fetch_assoc();
        $recensione1 = $row['commento'];
        $utente1 = $row['firstname'];
        $voto1 = $row['voto'];

        $row = $res->fetch_assoc();
        $recensione2 = $row['commento'];
        $utente2 = $row['firstname'];
        $voto2 = $row['voto'];
        
        $row = $res->fetch_assoc();
        $recensione3 = $row['commento'];
        $utente3 = $row['firstname'];
        $voto3 = $row['voto'];

    ?>
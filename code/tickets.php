<!DOCTYPE html>
<html lang="it">
<head>
    <title>I miei biglietti</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
</head>   
<body>
    <?php 
        include 'navbar.php';
    ?>
    <div class="container_page mt-3 text-center">
        <h1>Biglietti attivi</h1>
        <?php

            if(!isset($_SESSION["login"])){
                header ("Location:login.php");
            }
            include 'database/database.php';
            $query = "SELECT * FROM ordini WHERE id_utente = ? AND data >= ? ORDER BY data ASC";
            if(!($stmt=$con->prepare($query))){
                error_log("Prepare failed: (". $con->errno . ")" . $con->error);
                header ("Refresh:2, url=index.php");
                exit("Qualcosa è andato storto, riprova");
            }
            $todays_date = date("Y-m-d");
            if(!$stmt->bind_param("is", $_SESSION["id"], $todays_date)){
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
            $rowcount=$res->num_rows;
            if($rowcount!=0){
                echo "        
                    <div class='table-responsive py-1 px-4'>
                        <table class='table table-striped table-hover'>
                            <thead>
                                <tr>
                                <th scope='col'>Partenza</th>
                                <th scope='col'>Destinazione</th>
                                <th scope='col'>Data</th>
                                <th scope='col'>Orario</th>
                                <th scope='col'>Passeggeri</th>
                                <th scope='col'>Prezzo</th>
                                <th scope='col'>Codice</th>
                                </tr>
                            </thead>
                            <tbody>";
                while( $row = $res->fetch_assoc()){
                    echo "
                        <tr>
                            <td>".$row['città_partenza']."</td>
                            <td>".$row['città_arrivo']."</td>
                            <td>".date("d-m-Y", strtotime($row['data']))."</td>
                            <td>".$row['orario']."</td>
                            <td>".$row['passeggeri']."</td>
                            <td>".$row['prezzo']."€"."</td>
                            <td>".$row['codice']."</td>
                        </tr>";
                }
                echo "</tbody></table></div>";
            }
            else{
                echo "<h4>Non hai nessun biglietto attivo</h4>";
            }
        ?>
    </div>    
    <?php 
        include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
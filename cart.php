<!DOCTYPE html>
<html lang="it">
<head>
    <title>Carrello</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
</head>   
<body>
    <?php 
        include 'navbar.php';
        include 'cart/buy.php';
        include 'cart/flush.php';
    ?>
    <div class="container_page m-3 text-center">
        <h1>Il tuo carrello</h1>
        <?php
            include 'database/database.php';

            //cancello dal carrello tutti i biglietti con data passata
            $query = "DELETE FROM carrello WHERE id_utente = ? AND data < ?";
            $todays_date = date("Y-m-d");
            if(!($stmt=$con->prepare($query))){
                error_log("Prepare failed: (". $con->errno . ")" . $con->error);
                header ("Refresh:2, url=index.php");
                exit("Qualcosa è andato storto, riprova");
            }
            if(!$stmt->bind_param("is", $_SESSION['id'], $todays_date)){
                error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
                header ("Refresh:2, url=index.php");
                exit("Qualcosa è andato storto, riprova");
            }
            if(!$stmt->execute()){
                error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
                header ("Refresh:2, url=index.php");
                exit("Qualcosa è andato storto, riprova");
            }

            // visualizzo elementi presenti nel carrello dell'utente
            $query = "SELECT * FROM carrello WHERE id_utente=?";
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
            $res=$stmt->get_result();
            $rowcount=$res->num_rows;
            if($rowcount!=0){
                echo "        
                    <div class='table-responsive'>
                        <table class='table table-striped table-hover'>
                            <thead>
                                <tr>
                                <th scope='col'>Partenza</th>
                                <th scope='col'>Destinazione</th>
                                <th scope='col'>Data</th>
                                <th scope='col'>Orario</th>
                                <th scope='col'>Passeggeri</th>
                                <th scope='col'>Prezzo</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                $totale = 0;
                while( $row = $res->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>".$row['città_partenza']."</td>
                            <td>".$row['città_arrivo']."</td>
                            <td>".date("d-m-Y", strtotime($row['data']))."</td>
                            <td>".$row['orario']."</td>
                            <td>".$row['passeggeri']."</td>
                            <td>".$row['prezzo']."€</td>
                            <td>
                                <form action='cart/delete_ticket.php' method='post' name='delete_ticket'>
                                    <button type='submit' name='id_ticket' value ='".$row['id_carrello']."' id = 'id_ticket' ><img src='images/trash-fill.svg' alt='elimina elemento'></button>
                                </form>
                            </td>
                        </tr>";
                    $totale = $totale + $row['prezzo'];   
                }
                echo "</tbody></table></div>";
                echo "
                    <div class='container d-block text-center p-3'>
                        <div class='d-inline m-2 p-2 bg-dark text-white rounded-pill'>Totale:".$totale."€</div>
                        <form action='cart.php' method='post' name='buy' class = 'text-center d-inline'>
                            <button type='submit' name='buy' class='btn btn-primary rounded-pill m-2 p-2' id='button_review'>Acquista biglietti</button>
                        </form>
                        <form action='cart.php' method='post' name='delete' class = 'text-center d-inline'>
                            <button type='submit' name='delete'  class='btn btn-primary rounded-pill m-2 p-2' id='button_review'>Elimina carrello</button>
                        </form>
                </div>";
            }
            else{
                echo "<h3>Carrello Vuoto</h3>";
            }

            
            if($ok_buy != ""){
                echo "
                    <div class='container_alert d-flex justify-content-center align-items-center'>
                        <div class='alert alert-success mt-3' role='alert'>".$ok_buy."</div>
                    </div>
                    "; 
            }
            else if($ok_delete != ""){
                echo "
                <div class='container_alert d-flex justify-content-center align-items-center'>
                    <div class='alert alert-success mt-3' role='alert'>".$ok_delete."</div>
                </div>";
            } 
        ?>   
    </div>
    <?php  
        include 'footer.php';
    ?>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
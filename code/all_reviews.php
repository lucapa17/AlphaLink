<!DOCTYPE html>
<html lang="it">
<head>
    <title>Recensioni</title>
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
    <div class="container_page text-center">
        <h1 class="mt-3">Recensioni</h1>
        <?php
            include 'database/database.php';
            $query = "SELECT firstname, lastname, voto, commento, data_ora FROM valutazioni INNER JOIN utenti ON id=id_utente ORDER BY data_ora DESC";
            if(!($stmt=$con->prepare($query))){
                error_log("Prepare failed: (". $con->errno . ")" . $con->error);
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
                    <div class='table-responsive px-5'>
                        <table class='table table-striped table-hover'>
                            <thead>
                                <tr>
                                <th scope='col'>Utente</th>
                                <th scope='col'>Valutazione</th>
                                <th scope='col'>Commento</th>
                                <th scope='col'>Data</th>
                                </tr>
                            </thead>
                            <tbody>";
                while( $row = $res->fetch_assoc()){
                    echo "  
                        <tr>
                            <td>".$row['firstname']." ".$row['lastname']."</td>
                            <td class='cella_voto'>";
                                for($i=0; $i<$row['voto']; $i++){
                                    echo "<label class = 'recensioni'>&#9733;</label>";
                                }
                    echo"   </td>
                            <td class='cella_commento'>".$row['commento']."</td>
                            <td>".date("d-m-Y", strtotime($row['data_ora']))."</td>
                        </tr>";
                }
                echo "</tbody></table></div>";
            }
            else{
                echo "<h3>Non è presente alcuna recensione</h3>";
            }
        ?>
    </div>
    <?php 
        include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
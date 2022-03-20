<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Profilo</title>
</head>
<body>
    
    <?php
        include 'navbar.php';
    ?>
    <div class='container_page text-center'>
        <?php
            if(!isset($_SESSION['login'])){
                header("Location: login.php");
            }
            
            echo "<h3 class = 'text-center mt-3 mb-0'>Ciao ".$_SESSION['firstname']."! Ecco il tuo profilo</h3><br>";
            include 'database/database.php';
            $query = "SELECT città, indirizzo, data_nascita, telefono FROM utenti WHERE id=?";
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
            $rowcount = $res->num_rows;
            $row = $res->fetch_assoc();
            if($rowcount!=0) {
                if($row['data_nascita'] == NULL)
                    $data_nascita = "";
                else 
                    $data_nascita = date("d-m-Y", strtotime($row['data_nascita']));

                echo "        
                    <div class='table_profile d-flex justify-content-center align-items-center'>
                        <table class='table table-bordered table-striped  table-sm'><tbody>
                            <tr><td><h5>Nome</h5></td><td>".$_SESSION['firstname']."</td>
                            <tr><td><h5>Cognome</h5></td><td>".$_SESSION['lastname']."</td>
                            <tr><td><h5>Email</h5></td><td>".$_SESSION['email']."</td>
                            <tr><td><h5>Città</h5></td><td>".$row['città']."</td>
                            <tr><td><h5>Indirizzo</h5></td><td>".$row['indirizzo']."</td>
                            <tr><td><h5>Data di nascita</h5></td><td>".$data_nascita."</td>
                            <tr><td><h5>Telefono</h5></td><td>".$row['telefono']."</td>
                        </tbody></table>
                    </div>";
            }
            else {
                header ("Refresh:2, url=index.php");
                exit("Qualcosa è andato storto, riprova");
            }
        ?>
        <div class = "text-center d-inline ">
            <a class="btn btn-primary rounded-pill m-2 p-2" href="update_profile.php" role="button" id= "button_profile">Modifica profilo</a>
        </div>
        <div class = "text-center d-inline ">
            <a class="btn btn-primary rounded-pill m-2 p-2" href="update_password.php" role="button" id= "button_profile">Modifica password</a>
        </div>
        <div class = "text-center d-inline ">
            <a class="btn btn-primary rounded-pill m-2 p-2" href="tickets.php" role="button" id= "button_profile">I miei biglietti</a>
        </div>
        <div class = "text-center d-inline ">
            <a class="btn btn-primary rounded-pill m-2 p-2" href="my_reviews.php" role="button" id= "button_profile">Le mie recensioni</a>
        </div>
        <a href='checkform/change_newsletter.php' class='link d-block mx-4 my-4'>
            <?php
                if($_SESSION['newsletter'] == 1){
                    echo "<strong>Desideri disiscriverti dalla nostra newsletter?</strong>";
                }
                else {
                    echo "<strong>Desideri iscriverti alla nostra newsletter?</strong>";
                }
            ?>
        </a>
    </div>
    <?php 
        include 'footer.php';
    ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>

<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Modifica profilo</title>
</head>

<body>
    <?php
        include 'navbar.php';
        include 'checkform/update_prof.php';
        include 'checkform/show_prof.php';
    ?>
    <div class="d-flex justify-content-center align-items-center upprof-container">
        <form class="login-form text-center" action="update_profile.php" method="post" name="show_profile">
            <h1 class="mb-5 font-weight-light text-uppercase">Modifica profilo</h1>
            <div class="form-group">
                <label for="firstname" class="form-label">Nome*</label>
                <input type="text" class="form-control rounded-pill form-control-lg" id="firstname" name="firstname"  value = "<?php  echo $_SESSION['firstname'];  ?>">
            </div>
            <div class="form-group">
                <label for="lastname" class="form-label">Cognome*</label>
                <input type="text" class="form-control rounded-pill form-control-lg" id="lastname" name="lastname"  value = "<?php  echo $_SESSION['lastname'];  ?>" >
            </div>
            <div class="form-group">
                <label for="email" class="form-label">Email*</label>
                <input type="text" class="form-control rounded-pill form-control-lg" id="email" name="email"  value = "<?php  echo $_SESSION['email'];  ?>" >
            </div>
            <div class="form-group">
                <label for="città" class="form-label">Città</label>
                <input type="text" class="form-control rounded-pill form-control-lg" id="città" name="città"  value = "<?php  echo $row['città'];  ?>">
            </div>
            <div class="form-group">
                <label for="indirizzo" class="form-label">Indirizzo</label>
                <input type="text" class="form-control rounded-pill form-control-lg" id="indirizzo" name="indirizzo"  value = "<?php  echo $row['indirizzo']  ?>">
            </div>
            <div class="form-group">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" class="form-control rounded-pill form-control-lg" id="telefono" name="telefono"  value = "<?php  echo $row['telefono']  ?>">
            </div>
            <div class="form-group">
                <label for="data_nascita" class="form-label">Data di nascita</label>
                <input type="date" class="form-control rounded-pill form-control-lg" id="data_nascita" name="data_nascita" class="input" value = "<?php  echo $row['data_nascita'];  ?>">
            </div>
            <p class="mt-3 font-weight-normal">I campi con * sono obbligatori</p>
            <?php 
                if($error != ""){
                    echo '<div class="alert alert-danger mt-3" role="alert">'.$error.'</div>'; 
                }
                else if($ok != ""){
                    echo '<div class="alert alert-success mt-3" role="alert">'.$ok.'</div>'; 
                }
            ?>
            <button type="submit" name="submit" value="submit" class="btn mt-4 rounded-pill btn-lg btn-custom btn-block text-uppercase">Modifica</button>
            <p class="mt-3 font-weight-normal">
                Vuoi modificare la password? <a href="update_password.php"><strong>Modifica password</strong></a>
            </p>
        </form>
    </div>
    <?php 
        include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
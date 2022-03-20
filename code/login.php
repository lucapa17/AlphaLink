
<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <?php
        include 'navbar.php';
        include 'checkform/log.php';
    ?>
    <div class="d-flex justify-content-center align-items-center login-container">
        <form class="login-form text-center" action="login.php" method="post" name="login">
            <h1 class="mb-5 font-weight-light text-uppercase">Login</h1>
            <div class="form-group">
                <input type="email" id="email" name="email" class="form-control rounded-pill form-control-lg" placeholder="E-mail">
            </div>
            <div class="form-group">
                <input type="password" id="pass" name="pass" class="form-control rounded-pill form-control-lg" placeholder="Password">
            </div>
            <?php 
                if($error != ""){
                    echo '<div class="alert alert-danger mt-3" role="alert">'.$error.'</div>'; 
                }
            ?>
            <button type="submit" name="submit" value="submit" class="btn mt-5 rounded-pill btn-lg btn-custom btn-block text-uppercase">Login</button>
            <p class="mt-3 font-weight-normal">Non sei ancora registrato? <a href="registration.php"><strong>Registrati ora</strong></a></p>
        </form>
    </div>
    <?php 
        include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
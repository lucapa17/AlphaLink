<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Scrivi recensione</title>
</head>

<body>
    <?php
        include 'navbar.php';
        include 'reviews/write_review.php';

    ?>
    <div class="d-flex justify-content-center align-items-center review-container">
        <form class="login-form text-center" action="review.php" method="post" name="review">
            <h1 class="mb-5 font-weight-light text-uppercase">La tua recensione</h1>
            <div class="form-group">
                <textarea  name="review" class="form-control form-control-lg" placeholder="Scrivi la tua recensione (max 256 caratteri)"  rows="4"  ></textarea>
            </div>
            <div class="form-group">
                <p class="classificazione">
                    <input id="radio1" type="radio" name="voto" value="5">
                    <label class="review" for="radio1">&#9733;</label>
                    <input id="radio2" type="radio" name="voto" value="4">
                    <label class="review" for="radio2">&#9733;</label>
                    <input id="radio3" type="radio" name="voto" value="3">
                    <label class="review" for="radio3">&#9733;</label>
                    <input id="radio4" type="radio" name="voto" value="2">
                    <label class="review" for="radio4">&#9733;</label>
                    <input id="radio5" type="radio" name="voto" value="1">
                    <label class="review" for="radio5">&#9733;</label>        
                </p>


            </div>
            <?php 
                if($error != ""){
                    echo '<div class="alert alert-danger mt-3" role="alert">'.$error.'</div>'; 
                }
                else if($ok != ""){
                    echo '<div class="alert alert-success mt-3" role="alert">'.$ok.'</div>'; 
                }
            ?>
            <button type="submit" name="submit" class="btn mt-3 rounded-pill btn-lg btn-custom btn-block text-uppercase">Invia recensione</button>
            </form>
    </div>
    <?php 
        include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>

</html
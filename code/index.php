<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>AlphaLink</title>
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    <header class = "head-banner text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1>AlphaLink</h1>
                    <h2>Go further</h2>
                </div>
            </div>
        </div>
    </header>

    <section class = "sezione-icone bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class = "my-3">
                        <img src="images/bezier2.svg" alt="icona collegamento"  fill="currentColor" class="bi bi-bezier2" viewBox="0 0 16 16">
                        <div class="container my-3">
                            <h3>Veloce</h3>
                            <p class="lead mb-0 mt-2">Teletrasportati in ogni angolo del pianeta in pochi istanti</p>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class = "my-3">
                        <img src="images/emoji-smile.svg" alt="icona smile" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
                        <div class="container my-3">
                            <h3>Sicuro</h3>
                            <p class="lead mb-0 mt-2">Viaggia con assoluta sicurezza con la tua famiglia o per lavoro</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class = "my-3">
                        <img src="images/check-circle.svg" alt="icona sicurezza" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                        <div class="container my-3">
                            <h3>Facile</h3>
                            <p class="lead mb-0 mt-2">Acquista il tuo biglietto in pochi e semplici click</p>                           
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class = "bg-light text-center pb-5">
        <a class="btn btn-primary rounded-pill m-2 p-2" href="buy_ticket.php" role="button" id= "button_index">Acquista il tuo biglietto</a>
    </div>

    <?php
        include 'reviews/review_index.php';
    ?>
    <section class = "recensioni text-center bg-light">
        <div class="container">
            <div class="row">
                <h2>Cosa dicono i nostri clienti?</h2>
                <div class="row mt-4">
                    <div class="col-lg-4">
                        <div class="recensione mx-auto">
                            <img class = "img-fluid my-3" src="images/avatar2.png" alt="immagine avatar">
                            <h5><?php echo $utente3; ?></h5>
                            <?php
                                for($i=0; $i<$voto3; $i++){
                                    echo "<label class = 'recensioni'>&#9733;</label>";
                                }
                            ?>
                            <p class="font-weight-light my-3"><?php echo $recensione3; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="recensione mx-auto">
                            <img class = "img-fluid my-3" src="images/avatar3.png" alt="immagine avatar">
                            <h5><?php echo $utente2;  ?></h5>
                            <?php
                                for($i=0; $i<$voto2; $i++){
                                    echo "<label class = 'recensioni'>&#9733;</label>";
                                }
                            ?>
                            <p class="font-weight-light my-3"><?php echo $recensione2; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="recensione mx-auto">
                            <img class = "img-fluid my-3" src="images/avatar1.png" alt="immagine avatar">
                            <h5><?php echo $utente1; ?></h5>
                            <?php
                                for($i=0; $i<$voto1; $i++){
                                    echo "<label class = 'recensioni'>&#9733;</label>";
                                }
                            ?>
                            <p class="font-weight-light my-3"><?php echo $recensione1; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class = "bg-light text-center pt-3 pb-5">
                <a class="btn btn-primary rounded-pill m-2 p-2" href="all_reviews.php" role="button" id= "button_review">Vedi tutte le recensioni</a>
            </div>
        </div>
    </section>
    <?php 
        include 'footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
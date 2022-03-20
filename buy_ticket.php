
<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Acquista biglietto</title>
</head>

<body>
    <?php
        include 'navbar.php';
        include 'cart/addcart.php';

    ?>
    <div class="d-flex justify-content-center align-items-center buy-container">
        <form class="login-form text-center" action="buy_ticket.php" method="post" name="buy_ticket">
            <h1 class="mb-5 font-weight-light text-uppercase">Acquista Biglietto</h1>
            <div class="form-group">
                <input type="text" id="città_partenza" name="città_partenza" list="livesearch1" class="form-control rounded-pill form-control-lg" placeholder="Città partenza" onkeyup="livesearch1(this.value)" >
                <datalist id="livesearch1"></datalist>
            </div>
            <div class="form-group">
                <input type="text" id="città_arrivo" name="città_arrivo" list="livesearch2" class="form-control rounded-pill form-control-lg" placeholder="Città arrivo" onkeyup="livesearch2(this.value)">
                <datalist id="livesearch2"></datalist>
            </div>
            <div class="form-group">
                <input type="text" id="data" name="data" class="form-control rounded-pill form-control-lg" placeholder="Data" onfocus="(this.type='date')">
            </div>
            <div class="form-group">
                <select class="form-control rounded-pill form-control-lg" id="orario" name="orario" aria-label="Default select example">
                    <option selected value="">Seleziona fascia oraria</option>
                    <option value="00:00 - 01:00">00:00 - 01:00</option>
                    <option value="01:00 - 02:00">01:00 - 02:00</option>
                    <option value="02:00 - 03:00">02:00 - 03:00</option>
                    <option value="03:00 - 04:00">03:00 - 04:00</option>
                    <option value="04:00 - 05:00">04:00 - 05:00</option>
                    <option value="05:00 - 06:00">05:00 - 06:00</option>
                    <option value="06:00 - 07:00">06:00 - 07:00</option>
                    <option value="07:00 - 08:00">07:00 - 08:00</option>
                    <option value="08:00 - 09:00">08:00 - 09:00</option>
                    <option value="09:00 - 10:00">09:00 - 10:00</option>
                    <option value="10:00 - 11:00">10:00 - 11:00</option>
                    <option value="11:00 - 12:00">11:00 - 12:00</option>
                    <option value="12:00 - 13:00">12:00 - 13:00</option>
                    <option value="13:00 - 14:00">13:00 - 14:00</option>
                    <option value="14:00 - 15:00">14:00 - 15:00</option>
                    <option value="15:00 - 16:00">15:00 - 16:00</option>
                    <option value="16:00 - 17:00">16:00 - 17:00</option>
                    <option value="17:00 - 18:00">17:00 - 18:00</option>
                    <option value="18:00 - 19:00">18:00 - 19:00</option>
                    <option value="19:00 - 20:00">19:00 - 20:00</option>
                    <option value="20:00 - 21:00">20:00 - 21:00</option>
                    <option value="21:00 - 22:00">21:00 - 22:00</option>
                    <option value="22:00 - 23:00">22:00 - 23:00</option>
                    <option value="23:00 - 00:00">23:00 - 00:00</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control rounded-pill form-control-lg" id="passeggeri" name="passeggeri" aria-label="Default select example">
                    <option selected value="">Seleziona numero biglietti</option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                    <option value="6"> 6 </option>
                    <option value="7"> 7 </option>
                    <option value="8"> 8 </option> 
                </select>
            </div>
            <?php 
                if($error != ""){
                    echo '<div class="alert alert-danger mt-3" role="alert">'.$error.'</div>'; 
                }
                else if($ok != ""){
                    echo '<div class="alert alert-success mt-3" role="alert">'.$ok.'</div>'; 
                }
            ?>
            
            <button type="submit" name="submit" class="btn mt-3 rounded-pill btn-lg btn-custom btn-block text-uppercase">Aggiungi al carrello</button>
            </form>
    </div>
    <?php 
        include 'footer.php';
    ?>
    <script src = "javascript/utility.js"></script>
    <script src = "javascript/livesearch.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>

</html>
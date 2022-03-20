<nav class="navbar  navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo2.png" alt="logo" class="logo d-inline-block align-center">
            <strong>AlphaLink</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="nav navbar-nav">
                <li class='nav-item'>
                    <a class='nav-link active rounded-pill' aria-current='page' href='index.php'><img src='images/house-door-fill.svg' alt='home' class='d-inline-block align-center'> Home</a>
                </li>
            <?php
                ini_set('display_errors', false);
                ini_set('error_log', 'error/error.log');
                
                session_start();
                if(isset($_SESSION["login"])) {
                    echo   
                        "<li class='nav-item'>
                        <a class='nav-link active rounded-pill' aria-current='page' href='show_profile.php'><img src='images/person-fill.svg' alt='profilo'  class='d-inline-block align-center'> Profilo</a>
                        </li>";
                    echo   
                        "<li class='nav-item'>
                            <a class='nav-link active rounded-pill' aria-current='page' href='cart.php'><img src='images/cart-fill.svg' alt='carrello' class='d-inline-block align-center'> Carrello</a>
                        </li>";
                    echo   
                        "<li class='nav-item'>
                            <a class='nav-link active rounded-pill' aria-current='page' href='buy_ticket.php'>Acquista</a>
                        </li>";
                    echo   
                        "<li class='nav-item'>
                            <a class='nav-link active rounded-pill' aria-current='page' href='review.php'>Valutaci</a>
                        </li>";
                    echo   
                        "<li class='nav-item'>
                            <a class='nav-link active rounded-pill' aria-current='page' href='logout.php'>Logout</a>
                        </li>";
                }
                else {
                    echo   
                        "<li class='nav-item'>
                            <a class='nav-link active rounded-pill' aria-current='page' href='login.php'>Accedi</a>
                        </li>";
                    echo   
                        "<li class='nav-item'>
                            <a class='nav-link active rounded-pill' aria-current='page' href='registration.php'>Registrati</a>
                        </li>";
                }
                
            ?> 
            </ul>
        </div>
    </div>
</nav>
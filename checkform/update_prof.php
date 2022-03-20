<?php
	if(!isset($_SESSION["login"])) {
		header("Location: login.php");
	}
	$ok = "";
	$error = "";
	if (isset($_POST['submit'])) {
		if( empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) ) {
			$error = "Attenzione! Non hai inserito tutti i dati obbligatori, riprova!";
		}
		else {
			
			$nome = trim($_POST["firstname"]);
			$cognome = trim($_POST["lastname"]);
			$email = trim($_POST["email"]);

			if(empty($_POST["città"]))
				$città = NULL;
			else
				$città = trim($_POST["città"]);
			
			if(empty($_POST["indirizzo"]))
				$indirizzo = NULL;
			else
				$indirizzo = trim($_POST["indirizzo"]);
			
			if(empty($_POST["telefono"]))
				$telefono = NULL;
			else
				$telefono = trim($_POST["telefono"]);
			
			if(empty($_POST["data_nascita"]))
				$data_nascita = NULL;
			else
				$data_nascita = $_POST["data_nascita"];

			$patternnome = "/^[a-zA-Zòèàìéù' ]{2,30}$/";
			$patterncittà = "/^[a-zA-Zòèàìéù' ]{2,30}$/";
			$patternindirizzo = "/^[a-zA-Z0-9òèàìéù' ]{2,30}$/";
			$patterntelefono = "/^[0-9]{8,15}$/";
			$todays_date = date("Y-m-d");

			if(!preg_match($patternnome, $nome)){
				$error = "Nome inserito non valido!";
			}
			else if(!preg_match($patternnome, $cognome)){
				$error = "Cognome inserito non valido!";
			}
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error = "email non valida";
			}
			else if( (!empty($città)) && (!preg_match($patterncittà, $città)) ){
				$error = "città inserita non valida!";
			}
			else if( (!empty($indirizzo)) && (!preg_match($patternindirizzo, $indirizzo)) ){
				$error = "indirizzo non valido!";		
			}
			else if( (!empty($telefono)) && (!preg_match($patterntelefono, $telefono)) ) {
				$error = "Numero telefono non valido!";
			}
			else if ($todays_date <= $data_nascita){
				$error = "Attenzione! data di nascita non valida";
			}

			else {
				include 'database/database.php';
				$query="UPDATE utenti SET firstname=?, lastname=?, email=?, città=?, indirizzo=?, telefono=?, data_nascita=? WHERE id=?";
				if(!($stmt=$con->prepare($query))){
					error_log("Prepare failed: (". $con->errno . ")" . $con->error);
					header ("Refresh:2, url=index.php");
					exit("Qualcosa è andato storto, riprova");
				}
				if(!$stmt->bind_param('sssssssi', $nome, $cognome, $email, $città, $indirizzo, $telefono, $data_nascita, $_SESSION["id"])){
					error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
					header ("Refresh:2, url=index.php");
					exit("Qualcosa è andato storto, riprova");
				}
				if(!$stmt->execute()){
					if(($stmt->errno) == 1062){
						$error = "email già registrata";
					}
					else {
						error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
						header ("Refresh:2, url=index.php");
						exit("Qualcosa è andato storto, riprova");
					}
				}
				else if($stmt->affected_rows===0){
					$error = "Non hai modificato nulla!";
				}
				else {
					//aggiorno variabili in sessione
					$_SESSION['firstname']=$nome;
					$_SESSION['lastname']=$cognome;
					$_SESSION['email'] = $email;
					$ok = "Modifiche riuscite. Vai al tuo <a href='show_profile.php'><strong>profilo</strong></a>";
				}
			}
		}
	}	
?>

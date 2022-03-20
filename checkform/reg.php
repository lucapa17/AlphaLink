<?php

	$error = "";
	if (isset($_POST['submit'])){
		if( empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]) || empty($_POST["pass"]) || empty($_POST["confirm"]) ) {
			$error = "Attenzione! Non hai inserito tutti i dati, riprova!";
		} 
		else {
			$nome = trim($_POST["firstname"]);
			$cognome = trim($_POST["lastname"]);
			$email = trim($_POST["email"]);
			$pass = trim($_POST["pass"]);
			$confirm = trim($_POST["confirm"]);
			$newsletter = isset($_POST['newsletter']) ? $_POST['newsletter'] : 0;

			$patternnome = "/^[a-zA-Zòèàìéù' ]{2,30}$/";
			$patternpassword = "/^.{8,30}$/";

			if(!preg_match($patternnome, $nome)){
				$error = "Nome inserito non valido!";
			}
			else if(!preg_match($patternnome, $cognome)){
				$error = "Cognome inserito non valido!";
			}
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error = "email inserita non valida";
			}
			else if(!preg_match($patternpassword, $pass)){
				$error = "password deve contenere da 8 a 30 caratteri";
			}
			else if($pass != $confirm){
				$error = "Le due password non corrispondono";
			}
			else {
				include 'database/database.php';
				$password = password_hash($pass, PASSWORD_DEFAULT);
				$query="INSERT INTO utenti (firstname, lastname, email, pass, newsletter) VALUES(?, ?, ?, ?, ?)";
				if(!($stmt=$con->prepare($query))){
					error_log("Prepare failed: (". $con->errno . ")" . $con->error);
					header ("Refresh:2, url=index.php");
					exit("Qualcosa è andato storto, riprova");
				}
				if(!$stmt->bind_param("ssssi", $nome, $cognome, $email, $password, $newsletter)){
					error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
					header ("Refresh:2, url=index.php");
					exit("Qualcosa è andato storto, riprova");
				}
				if(!$stmt->execute()){
					// verifico che la mail non sia già registrata (error 1062)
					if(($stmt->errno) == 1062){
						$error = "Email già registrata";
					}
					else {
						error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
						header ("Refresh:2, url=index.php");
						exit("Qualcosa è andato storto, riprova");
					}
				}
				else if($stmt->affected_rows===0){
					$error = "Qualcosa è andato storto, riprova";
				}
				else{
					// salvo id dell'utente appena creato
					$id = $stmt->insert_id;
					//invio mail di benvenuto se utente è registrato alla newsletter
					if($newsletter == 1){
						$receiver = $email;
						$title = "Benvenuto in AlphaLink";
						$body = "Ciao ".$nome." !\nGrazie per esserti iscritto/a alla nostra newsletter. \nVerrai informato per eventuali offerte e promozioni!";
						include 'mail/mail.php';
					}
					//salvo dati in sessione
					$_SESSION['login']=true;
					$_SESSION['id']= $id;
					$_SESSION['firstname'] = $nome;
					$_SESSION['lastname']= $cognome;
					$_SESSION['newsletter'] = $newsletter;
					$_SESSION['email'] = $email;
					header("Location: index.php");
				}
			}
		}
	}
?>
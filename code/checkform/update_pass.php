<?php
	if(!isset($_SESSION["login"])) {
		header("Location: login.php");
	}
	$error = "";
    $ok = "";
	if (isset($_POST['submit'])){
		if( empty($_POST["pass"]) || empty($_POST["new_pass"]) || empty($_POST["confirm_pass"]) ) {
			$error = "Attenzione! Non hai inserito tutti i dati, riprova!";
		}
		else {
			//controllo dati in input
			$vecchia_password = trim($_POST["pass"]);
			$nuova_password = trim($_POST["new_pass"]);
			$conferma_password = trim($_POST["confirm_pass"]);

			$patternpassword = "/^.{8,30}$/";
			if(!preg_match($patternpassword, $vecchia_password)){
				$error = "Vecchia password errata";
			}
			else if(!preg_match($patternpassword, $nuova_password)){
				$error = "Nuova password non valida! Password deve contenere da 8 a 30 caratteri";
			}
			else if($nuova_password != $conferma_password){
				$error = "Le due password non corrispondono";
			}
			else if($nuova_password == $vecchia_password){
				$error = "Attenzione! La password inserita è uguale alla precedente";
			}
			else{
				include 'database/database.php';
				//verifico se la password vecchia è corretta
				$query="SELECT pass FROM utenti WHERE id=?";
				if(!($stmt=$con->prepare($query))){
					error_log("Prepare failed: (". $con->errno . ")" . $con->error);
					header ("Refresh:2, url=index.php");
					exit("Qualcosa è andato storto, riprova");
				}
				if(!$stmt->bind_param('i', $_SESSION["id"])){
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
				$row = $res->fetch_assoc();
			
				if(!password_verify($vecchia_password, $row['pass'])){
					$error = "Vecchia password errata";
				}
				else {
					$password = password_hash($nuova_password, PASSWORD_DEFAULT);
					$query="UPDATE utenti SET pass=? WHERE id=?";
					if(!($stmt=$con->prepare($query))){
						error_log("Prepare failed: (". $con->errno . ")" . $con->error);
						header ("Refresh:2, url=index.php");
						exit("Qualcosa è andato storto, riprova");
					}
					if(!$stmt->bind_param('si', $password, $_SESSION["id"])){
						error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
						header ("Refresh:2, url=index.php");
						exit("Qualcosa è andato storto, riprova");
					}
					if(!$stmt->execute()){
						error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
						header ("Refresh:2, url=index.php");
						exit("Qualcosa è andato storto, riprova");
					}
					if($stmt->affected_rows===0){
						$error = "Modifica non riuscita";
					}
					else {
						$ok = "Modifiche riuscite. Vai al tuo <a href='show_profile.php'><strong>profilo</strong></a>";
					}
				}
			}
		}
	}
?>
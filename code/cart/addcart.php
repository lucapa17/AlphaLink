<?php
	if(!isset($_SESSION["login"])) {
		header("Location: login.php");
	}
	$error = "";
	$ok = "";
	if (isset($_POST['submit'])){
		if( empty($_POST["città_partenza"]) || empty($_POST["città_arrivo"]) || empty($_POST["data"]) || empty($_POST["orario"]) || empty($_POST["passeggeri"])) {
			$error = "Attenzione! Non hai inserito tutti i dati";
		}
		else {
			//controllo dati in input prima di fare la query
			$città_partenza = trim($_POST["città_partenza"]);
			$città_arrivo = trim($_POST["città_arrivo"]);
			$data = $_POST["data"];
			$orario = $_POST["orario"];
			$passeggeri = $_POST["passeggeri"];
			
			$patterncittà = "/^[a-zA-Zòèàìéù' ]{2,30}$/";
			$todays_date = date("Y-m-d");

			if(!preg_match($patterncittà, $città_partenza)){
				$error = "Città di partenza non valida!";
			}
			else if(!preg_match($patterncittà, $città_arrivo)){
				$error = "Città di arrivo non valida!";
			}
			else if($città_arrivo == $città_partenza){
				$error = "Città di arrivo e partenza sono uguali";
			}
			else if ($todays_date > $data){
				$error = "Attenzione! Hai selezionato una data passata";
			}
			else if(($todays_date == $data) && (date("H",time()) >= substr($orario, 0, 2))){
				$error = "Attenzione! L'orario selezionato non è più disponibile";
			}
			else {
				include 'database/database.php';

				//inserisco biglietto nel carrello
				$query="INSERT INTO carrello (id_utente, prezzo, città_partenza, città_arrivo, data, orario, passeggeri) VALUES(?, ?, ?, ?, ?, ?, ?)";
				$prezzo = 50 * $passeggeri;

				if(!($stmt=$con->prepare($query))) {
					error_log("Prepare failed: (". $con->errno . ")" . $con->error);
					header ("Refresh:2, url=index.php");
					exit("Qualcosa è andato storto, riprova");
				}
				if(!$stmt->bind_param("iissssi", $_SESSION["id"], $prezzo, $città_partenza, $città_arrivo, $data, $orario, $passeggeri)){
					error_log("Binding parameters failed: (". $stmt->errno . ")" . $stmt->error);
					header ("Refresh:2, url=index.php");
					exit("Qualcosa è andato storto, riprova");
				}
				if(!$stmt->execute()){
					// verifico che le città inserite siano presenti nel db (error 1452)
					if(($stmt->errno) == 1452){
						$error = "Attenzione! Il percorso tra le due città non è disponibile";
					}
					else {
						error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);					
						header ("Refresh:2, url=index.php");
						exit("Qualcosa è andato storto, riprova");
					}
				}
				else if($stmt->affected_rows===0){
					$error = "inserimento fallito";
				}
				else{
					$ok = "Biglietto aggiunto al carrello correttamente. <a href='cart.php'><strong>Vai al carrello</strong></a>";
				}   
				
			}	
		}
	}

?>
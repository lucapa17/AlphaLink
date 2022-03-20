<?php
	$error = "";
	if (isset($_POST['submit'])){
		if( empty($_POST["email"]) || empty($_POST["pass"]) ) {
			$error = "Attenzione! Non hai inserito tutti i dati, riprova!";
		}
		else {
			//controllo dati in input prima di fare la query
			$email = trim($_POST["email"]);
			$pass = trim($_POST["pass"]);
			$patternpassword = "/^.{8,30}$/";

			if(!preg_match($patternpassword, $pass)){
				$error = "e-mail e/o password errate";
			}
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error = "e-mail e/o password errate";
			}
			else {
				include 'database/database.php';
				$query="SELECT * FROM utenti WHERE email=?";
				if(!($stmt=$con->prepare($query))){
					error_log("Prepare failed: (". $con->errno . ")" . $con->error);
					header ("Refresh:2, url=index.php");
					exit("Qualcosa è andato storto, riprova");
				}
				if(!$stmt->bind_param('s', $email)){
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
				$rowcount=$res->num_rows;
				if($rowcount!=0){
					if(password_verify($pass, $row['pass'])){
						//salvo dati in sessione
						$_SESSION['login']=true;
						$_SESSION['id']= $row['id'];
						$_SESSION['firstname'] = $row['firstname'];
						$_SESSION['lastname']=$row['lastname'];
						$_SESSION['newsletter'] = $row['newsletter'];
						$_SESSION['email'] = $email;
						header("Location: index.php");
					}
					else{
						//email trovata ma password errata
						$error = "e-mail e/o password errate";
					}
				}
				else {
					//email non trovata
					$error = "e-mail e/o password errate";
				}
			}
		}
	}
?>
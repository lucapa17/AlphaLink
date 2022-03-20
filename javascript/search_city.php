<?php
    $q = trim($_GET["q"]);
    $hint="";
    
    if (strlen($q)>0) {
        include '../database/database.php';
        $query = "SELECT nome_città FROM città WHERE nome_città LIKE '$q%' ORDER BY nome_città";
        if(!($stmt=$con->prepare($query))){
            error_log("Prepare failed: (". $con->errno . ")" . $con->error);
            header ("Refresh:2, url=../index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        if(!$stmt->execute()){
            error_log("Execute failed: (". $stmt->errno . ")" . $stmt->error);
            header ("Refresh:2, url=../index.php");
            exit("Qualcosa è andato storto, riprova");
        }
        $res=$stmt->get_result();
        while( $row = $res->fetch_assoc()) {
            if(($row['nome_città'])!=$q) {
                $hint = $hint."<option value='".$row['nome_città']."'>";
            }
        }
    }
    echo $hint;
?>
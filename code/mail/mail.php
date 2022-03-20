<?php

    if (!class_exists('PHPMailer\PHPMailer\Exception')){
        require 'PHPMailer.php';
        require 'SMTP.php';
        require 'Exception.php';
    }


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = "true";
    $mail->Port = "587";
    $mail->Username = "progettosaw21@gmail.com";
    $mail->Password = "edinsonpocho722";
    $mail->Subject = $title;
    $mail->SetFrom('progettosaw21@gmail.com', 'AlphaLink');
    $mail->Body = $body;
    $mail->addAddress($receiver);
    //if(
        $mail->Send();
        //echo "mail inviata"; ricorda mettere nel file di log
    //else
        //echo "errore";
    $mail->smtpClose();
?>
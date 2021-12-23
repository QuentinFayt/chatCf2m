<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST["loginInsc"]) && isset($_POST["nom"]) && isset($_POST["mdp"]) && isset($_POST["mdpConfirm"]) && isset($_POST["mail"])) {
    $loginInsc = userEntryProtection($_POST["loginInsc"]);
    $nom = userEntryProtection($_POST["nom"]);
    $mdp = userEntryProtection($_POST["mdp"]);
    $mdpConfirm = userEntryProtection($_POST["mdpConfirm"]);
    $usermail = strtolower(filter_var(userEntryProtection($_POST["mail"]), FILTER_VALIDATE_EMAIL));

    if ($loginInsc && $nom && $mdp && $mdpConfirm && $usermail) {
        $splitMail = explode("@", $usermail);

        if (count(explode(".", $splitMail[0])) === 2 && $splitMail[1] === "cf2000.onmicrosoft.com") {
            if ($mdp === $mdpConfirm) {
                $mail = new PHPMailer;

                $mail->IsSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "tls";
                $mail->Port       = 587;
                $mail->Username = MAIL;
                $mail->Password = MDP;

                $mail->setFrom("chat@cf2m.be", "chat");
                $mail->addAddress(MAIL, "Quentin");
                $mail->CharSet = 'UTF-8';
                $mail->Subject  = "Un nouvel utilisateur est sur le chat!";
                $mail->Body     = "https://quentin.webdev-cf2m.be/projets/exercices_persos/chatcf2m/public/?p=admin";

                $mail->send();
                $hashed = password_hash($mdp, PASSWORD_DEFAULT);
                userInscription($DB, $loginInsc, $nom, $hashed, $usermail);
            } else {
                $error = '<h2 class="error">Your password doesn\'t match!</h2>';
            }
        } else {
            $error = '<h2 class="error">Your mail isn\'t one of the CF2M!</h2>';
        }
    } else {
        $error = '<h2 class="error">Something went wrong!</h2>';
    }
}

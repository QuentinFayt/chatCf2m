<?php
if (isset($_POST["loginInsc"]) && isset($_POST["nom"]) && isset($_POST["mdp"]) && isset($_POST["mdpConfirm"]) && isset($_POST["mail"])) {
    $loginInsc = htmlspecialchars(strip_tags(trim($_POST["loginInsc"])), ENT_QUOTES);
    $nom = htmlspecialchars(strip_tags(trim($_POST["nom"])), ENT_QUOTES);
    $mdp = htmlspecialchars(strip_tags(trim($_POST["mdp"])), ENT_QUOTES);
    $mdpConfirm = htmlspecialchars(strip_tags(trim($_POST["mdpConfirm"])), ENT_QUOTES);
    $mail = strtolower(filter_var(htmlspecialchars(strip_tags(trim($_POST["mail"])), ENT_QUOTES), FILTER_VALIDATE_EMAIL));

    if ($loginInsc && $nom && $mdp && $mdpConfirm && $mail) {
        $splitMail = explode("@", $mail);

        if (count(explode(".", $splitMail[0])) === 2 && $splitMail[1] === "cf2000.onmicrosoft.com") {
            if ($mdp === $mdpConfirm) {
                $hashed = password_hash($mdp, PASSWORD_DEFAULT);
                $insertSQL = "INSERT INTO `users`(`login`, `displayedName`, `pwd`, `mailCF2M`) VALUES ('$loginInsc','$nom','$hashed','$mail');";

                mysqli_query($DB, $insertSQL);
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

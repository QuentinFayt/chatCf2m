<?php

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = htmlspecialchars(strip_tags(trim($_POST["login"])), ENT_QUOTES);
    $password = htmlspecialchars(strip_tags(trim($_POST["password"])), ENT_QUOTES);

    if (
        mysqli_fetch_row(mysqli_query($DB, "SELECT `login` FROM `users` WHERE `login` = '$login' AND `valideAccount`= 1"))[0] && password_verify($password, mysqli_fetch_row(mysqli_query($DB, "SELECT `pwd` FROM `users` WHERE `login` = '$login'"))[0])
    ) {
        $_SESSION["sessionID"] = session_id();
        $_SESSION["name"] = mysqli_fetch_row(mysqli_query($DB, "SELECT `displayedName` FROM `users` WHERE `login` = '$login'"))[0];
    } else {
        $wrongLog = true;
    }
}

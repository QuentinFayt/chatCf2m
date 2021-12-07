<?php

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = htmlspecialchars(strip_tags(trim($_POST["login"])), ENT_QUOTES);
    $password = htmlspecialchars(strip_tags(trim($_POST["password"])), ENT_QUOTES);

    if (
        mysqli_fetch_row(mysqli_query($DB, "SELECT `login` FROM `chatcf2m_users` WHERE `login` = '$login' AND `valideAccount`= 1"))[0] && password_verify($password, mysqli_fetch_row(mysqli_query($DB, "SELECT `pwd` FROM `chatcf2m_users` WHERE `login` = '$login'"))[0])
    ) {
        $_SESSION["sessionID"] = session_id();
        $_SESSION["name"] = mysqli_fetch_row(mysqli_query($DB, "SELECT `displayedName` FROM `chatcf2m_users` WHERE `login` = '$login'"))[0];
        $_SESSION["userID"] =  mysqli_fetch_row(mysqli_query($DB, "SELECT `users_id` FROM `chatcf2m_users` WHERE `login` = '$login'"))[0];
        $_SESSION["right"] =  mysqli_fetch_row(mysqli_query($DB, "SELECT `right` FROM `chatcf2m_users` WHERE `login` = '$login'"))[0];
        mysqli_query($DB, "UPDATE `chatcf2m_users` SET `online`= 1 WHERE `users_id` = " . $_SESSION["userID"] . " ;");
    } else {
        $wrongLog = true;
    }
}

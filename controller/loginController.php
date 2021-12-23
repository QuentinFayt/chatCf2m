<?php

if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = userEntryProtection($_POST["login"]);
    $password = userEntryProtection($_POST["password"]);

    if (
        loginVerification($DB, $login)["login"] && password_verify($password, passwordVerification($DB, $login)["pwd"])
    ) {
        $userInfo = getUserInfoForSession($DB, $login);
        $_SESSION["sessionID"] = session_id();
        $_SESSION["name"] = $userInfo["displayedName"];
        $_SESSION["userID"] =  $userInfo["users_id"];
        $_SESSION["right"] =  $userInfo["right"];
        setUserOnline($DB, (int) $_SESSION["userID"]);
        createEventToLogOut($DB, $_SESSION["name"], $_SESSION["userID"]);
    } else {
        $wrongLog = true;
    }
}

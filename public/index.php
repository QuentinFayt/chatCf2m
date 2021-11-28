<?php
session_start();
require_once "../config/config.php";
require "../model/dataFromDB.php";
require "../controller/loginController.php";
require "../model/inscriptionToDB.php";
require "../model/getMessages.php";
require "../model/getUsers.php";

include_once "../view/head.php";
include_once "../view/" . (isset($_SESSION["sessionID"]) ? "private/room" : "public/login") . ".php";

if (isset($_GET["p"]) && $_GET["p"] === "logout") {
    mysqli_query($DB, "UPDATE `users` SET `online`= 0 WHERE `id` = " . $_SESSION["userID"] . ";");
    session_unset();
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
    session_destroy();
    header("Location: ./");
}
include_once "../view/foot.php";

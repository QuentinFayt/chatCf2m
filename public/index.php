<?php
session_start();
require_once "../config/config.php";
require "../model/dbConnexion.php";
require "../controller/loginController.php";
require '../model/PHPMailer/src/Exception.php';
require '../model/PHPMailer/src/PHPMailer.php';
require '../model/PHPMailer/src/SMTP.php';
require "../model/inscriptionToDB.php";
require "../model/getUsers.php";
require "../model/userModel.php";
require "../controller/userController.php";
require "../model/deleteMessages.php";
require "../controller/messageController.php";


include_once "../view/head.php";
$users = getUsersForAdmin($DB);
if (isset($_SESSION["sessionID"]) && checkIfOnline($DB, $_SESSION["userID"])["online"] === "1") {
    include_once "../view/private/" . (isset($_GET["p"]) && $_GET["p"] === "admin" && $_SESSION["right"] === "1" ? "admin" : "room") . ".php";
} else {
    include_once "../view/public/login.php";
}
if ((isset($_GET["p"]) && $_GET["p"] === "logout") || (isset($_SESSION["sessionID"]) && $_SESSION["sessionID"] !== session_id())) {
    mysqli_query($DB, "UPDATE `chatcf2m_users` SET `online`= 0 WHERE `users_id` = " . $_SESSION["userID"] . ";");
    include "../controller/logoutController.php";
}
include_once "../view/foot.php";

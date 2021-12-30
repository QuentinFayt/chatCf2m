<?php
session_start();
require_once "../config/config.php";
require_once "../config/database.php";
require_once "../model/messagesModel.php";
require_once "../model/userModel.php";
require_once '../model/PHPMailer/src/Exception.php';
require_once '../model/PHPMailer/src/PHPMailer.php';
require_once '../model/PHPMailer/src/SMTP.php';
require_once "../controller/inscriptionToDB.php";
require_once "../controller/loginController.php";
require_once "../controller/userController.php";
require_once "../controller/messageController.php";

include_once "../view/head.php";
if (isset($_SESSION["sessionID"]) && checkIfOnlineById($DB, $_SESSION["userID"])["online"] === "1") {
    $users = getUsersForAdmin($DB);
    include_once "../view/private/" . (isset($_GET["p"]) && $_GET["p"] === "admin" && $_SESSION["right"] === "1" ? "admin" : "room") . ".php";
} else {
    include_once "../view/public/login.php";
}
if ((isset($_GET["p"]) && $_GET["p"] === "logout") || (isset($_SESSION["sessionID"]) && $_SESSION["sessionID"] !== session_id())) {
    setUserOnlineStatus($DB, $_SESSION["userID"], false);
    require_once "../controller/logoutController.php";
}
include_once "../view/foot.php";

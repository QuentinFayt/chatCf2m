<?php
session_start();
require_once "../../config/config.php";
require_once "../../config/database.php";
require_once "../../model/messagesModel.php";
require_once "../../model/userModel.php";

if (isset($_SESSION["sessionID"]) && $_SESSION["sessionID"] == session_id()) {
    if (isset($_GET["getMessagesOnLoad"])) {
        require "../../controller/controllerForJs/loadMessages.php";
    }
    if (isset($_GET["offsetToLoad"])) {
        $offset = (int) $_GET["offsetToLoad"];
        require "../../controller/controllerForJs/loadOlderMessages.php";
    }
    if (isset($_GET["getUsers"])) {
        require "../../controller/controllerForJs/loadUsers.php";
    }
    if (isset($_GET["lastMessageId"])) {
        $lastId = (int) $_GET["lastMessageId"];
        require "../../controller/controllerForJs/loadNewMessages.php";
    }
    if (isset($_GET["userId"])) {
        if ($_SESSION["userID"] === $_GET["userId"]) {
            $userId = $_SESSION["userID"];
            require "../../controller/controllerForJs/checkUsers.php";
        } else {
            require "../../controller/logoutController.php";
        }
    }
    if (isset($_POST["message"])) {
        if (checkIfOnlineById($DB, $_SESSION["userID"])["online"] === "1") {
            $message = htmlspecialchars(strip_tags($_POST["message"]), ENT_QUOTES);
            sendMessage($DB, $message);
        }
    }
}
